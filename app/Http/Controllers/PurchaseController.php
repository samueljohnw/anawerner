<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Course;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\PaymentIntent;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    // protected $id = 1;

    function show($id, Request $request){
        if (!is_numeric($id) || !Course::find($id)) {
            abort(404, 'Course not found');
        }
         
        $course = Course::find($id);
        $price_id = $course->price_id;

        return $request->user()->checkout([$price_id => 1], [
        'success_url' => route('page.SingleSuccess').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('page.cancel'),
        'metadata' => ['price_id' => 'price_1QVeqH4t1cavPEy4K1E74Jtx','user_id' => $request->user()->id],
    ]);
       
        // return view('page.landing.payment',['course'=>$course]);

    }

    function subscribe(Request $request, $plan = null){
        if (!$plan || !in_array($plan, ['SEERS_SOARING', 'EAGLES_SPOT'])) {
            abort(400, 'Invalid or missing plan parameter');
        }
        
        // $plan = 'SEERS_SOARING';
        
        return $request->user()
            ->newSubscription('default', env($plan))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('page.SubscribeSuccess').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('page.cancel'),
            ]);
    }
    
    function singlePurchase(Request $request, $price_id = null){
        if (!$price_id || !str_starts_with($price_id, 'price_')) {
            abort(400, 'Invalid or missing price ID parameter');
        }
        // $course = Course::find($id);
        
        return $request->user()->checkout($price_id, [
        'success_url' => route('page.SingleSuccess').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('page.cancel'),
        'metadata' => ['price_id' => $price_id,'user_id' => $request->user()->id],
    ]);
    }

    function recordPayment($course = null, $ch_id = null)
    {
        if (!$course || !$ch_id) {
            return 'invalid_parameters';
        }
        
        if (!auth()->check()) {
            return 'unauthorized';
        }
        // Check if a purchase with this charge ID already exists
        $existingPurchase = Purchase::where('ch_id', $ch_id)->first();
        
        if ($existingPurchase) {
            // Payment already recorded, don't create duplicate
            return 'already_recorded';
        }

        // Create new payment record
        $payment = new Purchase;
        $payment->user_id = auth()->id();
        $payment->course_id = $course->id;
        $payment->ch_id = $ch_id;
        $payment->save();

        return 'success';
    }



}
