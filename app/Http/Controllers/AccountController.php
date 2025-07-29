<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchase;
use Laravel\Cashier\Cashier;
use Carbon\Carbon;

class AccountController extends Controller
{

    public function index()
    {
        // Redirect to home if not authenticated
        if (!auth()->check()) {
            return redirect()->route('page.home')->with('error', 'Please log in to access your account.');
        }
        
        $user = auth()->user();
        
        // Get user's purchases with course details
        $purchases = $user->purchases()->with('course')->orderBy('created_at', 'desc')->get();
        
        // Get active subscriptions using Cashier
        $activeSubscriptions = $user->subscriptions()
            ->where('stripe_status', 'active')
            ->get()
            ->map(function ($subscription) {
                // Get subscription details from Stripe
                $stripeSubscription = $subscription->asStripeSubscription();
                
                // Check if subscription is cancelled (has ends_at date)
                $isCancelled = !is_null($subscription->ends_at);
                
                return [
                    'id' => $subscription->id,
                    'type' => $subscription->type,
                    'status' => $isCancelled ? 'cancelled' : $subscription->stripe_status,
                    'created_at' => $subscription->created_at,
                    'current_period_end' => $stripeSubscription->current_period_end ? 
                        Carbon::createFromTimestamp($stripeSubscription->current_period_end) : null,
                    'cancel_at_period_end' => $stripeSubscription->cancel_at_period_end ?? false,
                    'ends_at' => $subscription->ends_at,
                    'is_cancelled' => $isCancelled,
                    'stripe_price' => $subscription->stripe_price,
                    'quantity' => $subscription->quantity ?? 1,
                ];
            });

        // Get cancelled/past subscriptions
        $pastSubscriptions = $user->subscriptions()
            ->whereIn('stripe_status', ['canceled', 'incomplete', 'past_due'])
            ->get()
            ->map(function ($subscription) {
                try {
                    $stripeSubscription = $subscription->asStripeSubscription();
                    return [
                        'id' => $subscription->id,
                        'type' => $subscription->type,
                        'status' => $subscription->stripe_status,
                        'created_at' => $subscription->created_at,
                        'ended_at' => $subscription->ends_at,
                        'stripe_price' => $subscription->stripe_price,
                    ];
                } catch (\Exception $e) {
                    return [
                        'id' => $subscription->id,
                        'type' => $subscription->type,
                        'status' => $subscription->stripe_status,
                        'created_at' => $subscription->created_at,
                        'ended_at' => $subscription->ends_at,
                        'stripe_price' => $subscription->stripe_price,
                    ];
                }
            });

        // Get payment methods
        $paymentMethods = [];
        try {
            if ($user->hasStripeId()) {
                $paymentMethods = $user->paymentMethods()->map(function ($paymentMethod) {
                    return [
                        'id' => $paymentMethod->id,
                        'type' => $paymentMethod->type,
                        'card' => $paymentMethod->card ?? null,
                    ];
                })->toArray();
            }
        } catch (\Exception $e) {
            // Handle case where payment methods can't be retrieved
            $paymentMethods = [];
        }

        return view('page.account', compact('user', 'purchases', 'activeSubscriptions', 'pastSubscriptions', 'paymentMethods'));
    }

    public function updateProfile(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('page.home')->with('error', 'Please log in to access your account.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function cancelSubscription(Request $request, $subscriptionId)
    {
        if (!auth()->check()) {
            return redirect()->route('page.home')->with('error', 'Please log in to access your account.');
        }
        
        $user = auth()->user();
        $subscription = $user->subscriptions()->findOrFail($subscriptionId);

        if ($subscription->stripe_status === 'active') {
            $subscription->cancel();
            return back()->with('success', 'Subscription has been cancelled.');
        }

        return back()->with('error', 'Unable to cancel subscription.');
    }

    public function resumeSubscription(Request $request, $subscriptionId)
    {
        if (!auth()->check()) {
            return redirect()->route('page.home')->with('error', 'Please log in to access your account.');
        }
        
        $user = auth()->user();
        $subscription = $user->subscriptions()->findOrFail($subscriptionId);

        if ($subscription->onGracePeriod()) {
            $subscription->resume();
            return back()->with('success', 'Subscription resumed successfully.');
        }

        return back()->with('error', 'Unable to resume subscription.');
    }

    public function downloadInvoice(Request $request, $invoiceId)
    {
        if (!auth()->check()) {
            return redirect()->route('page.home')->with('error', 'Please log in to access your account.');
        }
        
        $user = auth()->user();
        
        try {
            return $user->downloadInvoice($invoiceId, [
                'vendor' => 'Ana Werner Ministries',
                'product' => 'Subscription',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Invoice not found.');
        }
    }

    public function getInvoices()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $user = auth()->user();
        $invoices = [];

        try {
            if ($user->hasStripeId()) {
                $invoices = $user->invoices()->map(function ($invoice) {
                    return [
                        'id' => $invoice->id,
                        'date' => Carbon::createFromTimestamp($invoice->created)->format('M d, Y'),
                        'total' => '$' . number_format($invoice->total / 100, 2),
                        'status' => $invoice->status,
                        'hosted_invoice_url' => $invoice->hosted_invoice_url,
                    ];
                })->toArray();
            }
        } catch (\Exception $e) {
            $invoices = [];
        }

        return response()->json($invoices);
    }
}