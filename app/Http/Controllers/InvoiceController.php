<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function InvoicePage(){
        return view('pages.dashboard.invoice-page');
    }
    public function SalePage(){
        return view('pages.dashboard.sale-page');
    }
}
