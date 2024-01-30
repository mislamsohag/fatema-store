<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function CustomerPage(){
        return view('pages.dashboard.customer-page');
    }

    
    // Customer Create
    function CustomerCreate(Request $request){
        $user_id=$request->header('id');

        return Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'user_id'=>$user_id,
        ]);
    }

    // Individual User Customers List
    function CustomerList(Request $request){
        $user_id=$request->header('id');
        return Customer::where('user_id','=', $user_id)->get();
    }

    // Customer Delete
    function CustomerDelete(Request $request){
        $user_id=$request->header('id');
        $customer_id=$request->input('id');

        return Customer::where('user_id', $user_id)->where('id',$customer_id)->delete();
    }

    // Single Customer By Id
    function SingleCustomer(Request $request){
        $user_id=$request->header('id');
        $customer_id=$request->input('id');

        return Customer::where('user_id', $user_id)->where('id',$customer_id)->first();
    }

    // Customer Update
    function CustomerUpdate(Request $request){
        $user_id=$request->header('id');
        $customer_id=$request->input('id');
        return Customer::where('user_id', $user_id)->where('id', $customer_id)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'user_id'=>$user_id,
        ]);
    }
}
