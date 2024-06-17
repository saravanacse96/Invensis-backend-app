<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Payment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $pages = Page::all();
        $payment_val = Page::where('type', 'Payment Page')->count();
        $normal_val = Page::where('type', 'Normal Page')->count();
        $payments = Payment::all();
        return view('admin.dashboard', compact(['pages', 'payment_val', 'normal_val', 'payments']));
    }
}
