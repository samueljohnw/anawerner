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
        $course = Course::find($id);

        return $request->user()->checkout(['price_1QVeqH4t1cavPEy4K1E74Jtx' => 1], [
        'success_url' => route('page.SingleSuccess').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('page.cancel'),
        'metadata' => ['price_id' => 'price_1QVeqH4t1cavPEy4K1E74Jtx','user_id' => $request->user()->id],
    ]);
       
        // return view('page.landing.payment',['course'=>$course]);

    }

    function subscribe(Request $request, $plan = null){
        
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
        // $course = Course::find($id);
        
        return $request->user()->checkout($price_id, [
        'success_url' => route('page.SingleSuccess').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('page.cancel'),
        'metadata' => ['price_id' => $price_id,'user_id' => $request->user()->id],
    ]);
    }

    function recordPayment($course = null, $ch_id = null)
    {
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

    // function singlePurchase(Request $request){

    //     $course = Course::find($request->id);

    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //         try {
    //             // Retrieve or Create Customer by Email
    //             $existingCustomer = Customer::all(['email' => $request->email, 'limit' => 1])->data[0] ?? null;
            
    //             if ($existingCustomer) {
    //                 $customer = $existingCustomer;
            
    //                 // Attach the PaymentMethod to the existing Customer
    //                 $paymentMethod = PaymentMethod::retrieve($request->pm['id']);
    //                 $paymentMethod->attach(['customer' => $customer->id]);
    //             } else {
    //                 // Create a new Customer with the provided PaymentMethod
    //                 $customer = Customer::create([
    //                     'email' => $request->email,
    //                     'payment_method' => $request->pm['id'],
    //                 ]);
    //             }
            
    //             // Create and Confirm a PaymentIntent
    //             $paymentIntent = PaymentIntent::create([
    //                 'amount' => $course->price*100, // Amount in cents ($23.00)
    //                 'currency' => 'usd',
    //                 'payment_method' => $request->pm['id'],
    //                 'description' => $course->title. ' - Ana Werner Ministries',
    //                 'receipt_email' => $request->email,
    //                 'customer' => $customer->id, // Associate with the Customer
    //                 'confirm' => true, // Automatically confirm the PaymentIntent
    //                 'return_url' => env('APP_URL').'/seer-school',

    //             ]);
    //             // dd($paymentIntent);
    //             // Upon Successful Stripe Payment Record the Users Information In the App
    //             // Create User if Doesn't Exists
    //             $user = User::firstOrNew(['email' =>  $request->email]);
    //             $user->name = $request->name;
    //             $user->save();
                
    //             // Attach course to user with additional pivot data
    //             $user->course()->syncWithoutDetaching([
    //                 $course->id => ['ch_id' => $paymentIntent->latest_charge],
    //             ]);

    //             return response()->json(['status' => 'success', 'paymentIntent' => $paymentIntent]);
    //         } catch (\Stripe\Exception\CardException $e) {
    //             // Handle card-related errors
    //             return response()->json(['status' => 'error', 'message' => $e->getError()->message]);
    //         } catch (\Exception $e) {
    //             // Handle other errors
    //             return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    //         }

    // }

}
