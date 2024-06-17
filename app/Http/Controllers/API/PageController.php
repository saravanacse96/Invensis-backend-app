<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PaymentTransactions;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PageController extends Controller
{
    public function index()
    {
        return response()->json(Page::all());
    }

    public function show(Page $page)
    {
        return response()->json($page);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'page_id' => 'required|exists:pages,id',
            'payment_method' => 'required',
        ]);

        $page = Page::find($request->page_id);

        if (!$page || $page->type !== 'Payment Page') {
            return response()->json(['error' => 'Invalid page type for payment'], 400);
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => intVal($page->price),
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function status(Request $request)
    {
        $request->validate([
            'page_id' => 'required|exists:pages,id',
            'paymentIntentId' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $page = Page::find($request->page_id);

        if (!$page || $page->type !== 'Payment Page') {
            return response()->json(['error' => 'Invalid page type for payment'], 400);
        }

        try {

            if ($request->status === 'succeeded') {
                $payment = new PaymentTransactions();
                $payment->payment_intent_id = $request->paymentIntentId;
                $payment->page_id = $request->page_id;
                $payment->amount = $request->price;
                $payment->currency = 'usd';
                $payment->description = $request->description;
                $payment->status = $request->status;
                $payment->save();
                return response()->json([
                    'message' => 'Payment successful!',
                    'payment_id' => $payment->id,
                ], 200);
            } else {
                return response()->json(['error' => 'Payment failed.'], 500);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success()
    {
        $page = Page::where("title", "Success")->where("type", "Normal Page")->first();

        if ($page) {
            return response()->json([
                'status' => 'success',
                'data' => $page,
                'message' => 'Success Page retrieved successfully.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Success Page not found.',
            ], 404);
        }
    }

    public function failure()
    {
        $page = Page::where("title", "Failure")->where("type", "Normal Page")->first();

        if ($page) {
            return response()->json([
                'status' => 'success',
                'data' => $page,
                'message' => 'Failure Page retrieved successfully.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failure Page not found.',
            ], 404);
        }
    }

}
