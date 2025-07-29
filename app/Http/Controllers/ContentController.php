<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PurchaseController;
use App\Models\Course;
use App\Models\Purchase;
use App\Models\Slide;
use Stripe\Stripe;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Stripe\PaymentIntent;

class ContentController extends Controller
{
    function home() {
        $today = Carbon::today();

        $events = Event::where('end_day', '>=', $today)
        ->get()
        ->sortBy(function ($event) use ($today) {
            return abs($today->diffInDays(Carbon::parse($event->start_day), false));
        })
        ->take(3);
        
        $sliders = Slide::all();

        return view('home', [
            'events' => $events,
            'card' => 1,
            'sliders' => $sliders
        ]);  
    }

    function about() {
        return view('page.about');  
    }

    function books() {
        return view('page.books');  
    }

    function training() {
        return view('page.training');  
    }

    function course(string $type, string $course =null, string $session=null)  {
        $courseController = new CourseController;
        return $courseController->index($type,$course,$session);
    }

    function eaglesnetwork() {
        return view('page.eaglesnetwork');  
    }

    function plans() {
        return view('page.plans');  
    }

    function SubscribeSuccess(Request $request) {
        if (!$request->has('session_id')) {
            return redirect()->route('page.home');
        }
        
        $sessionId = $request->get('session_id');
        if ($sessionId === null) {
            return redirect()->route('page.home');
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);
        if ($session->payment_status !== 'paid') {
            return redirect()->route('page.home');
        }
        
        $subscriptionId = $session->subscription;
        if ($subscriptionId === null) {
            return redirect()->route('page.home');
        }
        
        // Get subscription details from Stripe
        $subscription = Cashier::stripe()->subscriptions->retrieve($subscriptionId);
        $customerId = $session->customer;
        $customer = Cashier::stripe()->customers->retrieve($customerId);
        
        // Find user based on customer email
        $user = \App\Models\User::where('email', $customer->email)->first();
        if (!$user) {
            return redirect()->route('page.home');
        }
        
        // Cancel any existing active subscriptions (user can only have 1 active subscription)
        $activeSubscriptions = $user->subscriptions()->where('stripe_status', 'active')->get();
        foreach ($activeSubscriptions as $activeSubscription) {
            if ($activeSubscription->stripe_id !== $subscription->id) {
                try {
                    $activeSubscription->cancel();
                } catch (\Exception $e) {
                    \Log::warning('Failed to cancel existing subscription', [
                        'subscription_id' => $activeSubscription->stripe_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }
        
        // Sync subscription with Laravel Cashier (this will create/update the subscription record)
        $subscriptionRecord = $user->subscriptions()->updateOrCreate(
            ['stripe_id' => $subscription->id],
            [
                'type' => $session->metadata->subscription_name ?? 'Mentorship',
                'stripe_status' => $subscription->status,
                'stripe_price' => $subscription->items->data[0]->price->id,
                'quantity' => $subscription->items->data[0]->quantity,
                'trial_ends_at' => $subscription->trial_end ? Carbon::createFromTimestamp($subscription->trial_end) : null,
                'ends_at' => null,
                'created_at' => Carbon::createFromTimestamp($subscription->created),
                'updated_at' => Carbon::now(),
            ]
        );
        
        // Find the corresponding course for this subscription
        $subscriptionName = $session->metadata->subscription_name ?? 'default';
        $course = null;
        
        if ($subscriptionName === 'Seers Soaring') {
            $course = Course::where('title', 'Seers Soaring')->first();
        } elseif ($subscriptionName === 'The Eagles Spot') {
            $course = Course::where('title', 'The Eagles Spot')->first();
        }
        
        // Record subscription transaction in purchase table
        if ($course) {
            $subscriptionTransactionId = 'sub_' . $subscription->id;
            $existingPurchase = Purchase::where('ch_id', $subscriptionTransactionId)->first();
            // dd($course);
            if (!$existingPurchase) {
                $purchase = new Purchase();
                $purchase->user_id = $user->id;
                $purchase->course_id = $course->id;
                $purchase->ch_id = $subscriptionTransactionId;
                $purchase->created_at = Carbon::createFromTimestamp($subscription->created);
                $purchase->updated_at = Carbon::now();
                $purchase->save();
            }
        }
        
        // Prepare subscription details for the view
        $subscriptionDetails = [
            'customer_name' => $user->name ?? 'Subscriber',
            'customer_email' => $user->email,
            'subscription_name' => $session->metadata->subscription_name ?? 'Subscription',
            'amount_paid' => $session->amount_total / 100, // Convert from cents
            'currency' => strtoupper($session->currency),
            'subscription_date' => Carbon::createFromTimestamp($subscription->created)->format('F j, Y g:i A'),
            'subscription_id' => $subscription->id,
            'billing_cycle' => $subscription->items->data[0]->price->recurring->interval ?? 'month',
        ];
        
        return view('page.subscription-success', [
            'subscriptionDetails' => $subscriptionDetails
        ]);
    }

    function SingleSuccess(Request $request) {
        
        if (!$request->has('session_id')) {
            return redirect()->route('page.home');
        }
        
        $sessionId = $request->get('session_id');
        if ($sessionId === null) {return;}

        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);
        if ($session->payment_status !== 'paid') {return;}

        $paymentIntentId = $session->payment_intent;
        
        $paymentIntent = Cashier::stripe()->paymentIntents->retrieve($paymentIntentId);
        $chargeId = $paymentIntent->latest_charge;

        $priceId = $session['metadata']['price_id'] ?? null;
        if ($priceId === null) {return;}   

        $course = Course::where('price_id',$priceId)->first();
        
        // Check if payment was already recorded and get existing purchase if it exists
        $existingPurchase = Purchase::where('ch_id', $chargeId)->first();
        
        if (!$existingPurchase) {
            // Only record payment if it doesn't already exist
            $purchaseController = new PurchaseController;
            $purchaseController->recordPayment($course, $chargeId);
            $purchaseDate = Carbon::now()->format('F j, Y g:i A');
        } else {
            // Use the existing purchase date
            $purchaseDate = $existingPurchase->created_at->format('F j, Y g:i A');
        }
        
        // Get customer details from session
        $customerEmail = $session->customer_details->email ?? 'N/A';
        $customerName = $session->customer_details->name ?? 'N/A';
        
        // Get payment amount
        $amountPaid = $session->amount_total / 100; // Convert from cents to dollars
        
        // Prepare purchase details for the success page
        $purchaseDetails = [
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'course_title' => $course->title ?? 'N/A',
            'amount_paid' => $amountPaid,
            'currency' => strtoupper($session->currency ?? 'usd'),
            'purchase_date' => $purchaseDate,
            'charge_id' => $chargeId,
            'session_id' => $sessionId,
            'is_repeat_visit' => $existingPurchase ? true : false
        ];

        return view('page.success', ['purchaseDetails' => $purchaseDetails]);

    }

    function cancel() {
        return view('page.cancel');
    }

    function welcome(){
        return view('page.welcome');  
    }

    function schoolLanding() {
        return view('page.landing.school');
    }
}
