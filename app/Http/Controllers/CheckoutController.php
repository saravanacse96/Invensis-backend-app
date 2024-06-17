<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout(Page $page)
    {
        return view('checkout', compact('page'));
    }

    public function process(Request $request)
    {

        $request->validate([
            'stripeToken' => 'required',
            'page_id' => 'required|exists:pages,id',
        ]);

        $page = Page::findOrFail($request->page_id);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => IntVal($page->price), // amount in dollars
                'currency' => 'usd',
                'description' => $page->description,
                'source' => $request->stripeToken,
            ]);

            if ($charge) {
                Payment::create([
                    'stripe_charge_id' => $charge->id,
                    'page_id' => $page->id,
                    'amount' => $page->price,
                    'currency' => 'usd',
                    'description' => $page->description,
                    'status' => $charge->status,
                ]);
            }

            // Payment was successful
            return redirect()->route('payment.success');
        } catch (\Exception $ex) {
            // Payment failed
            // dd( $ex);
            return redirect()->route('payment.failure')->withErrors(['message' => 'Payment failed']);
        }
    }
    public function success()
    {
        $page = Page::where("title", "Success")->where("type", "Normal Page")->first();
        return view('payment.success', compact('page'));

    }
    public function failure()
    {
        $page = Page::where("title", "Failure")->where("type", "Normal Page")->first();
        return view('payment.failure', compact('page'));

    }

}
