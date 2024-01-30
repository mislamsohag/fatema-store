<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    function ProductPage(){
        return view('pages.dashboard.product-page');
    }


    // Product Store/create
    function Store(Request $request){
        $user_id=$request->header('id');
        $img=$request->file('img');

        // image name make
        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="images/products/{$img_name}";

        //image upload on local folder
        $img->move(public_path('images/products/'),$img_name);

        return Product::create([
            'user_id'=>$user_id,
            'category_id'=>$request->input('category_id'),
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'img_url'=>$img_url
        ]);

    }

    // All Products
    function ProductList(Request $request){
        $user_id=$request->header('id');
        return Product::where('user_id', $user_id)->get();
    }

    // Product Delete
    function Delete(Request $request){
        $user_id=$request->header('id');
        $product_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);

        return Product::where('user_id', $user_id)->where('id',$product_id)->delete();
    }


    // Single Product
    function SingleProduct(Request $request){
        $user_id=$request->header('id');
        $product_id=$request->input('id');

        return Product::where('user_id', $user_id)->where('id', $product_id)->first();
    }


    // Product Update
    function Update(Request $request){
        $user_id=$request->header('id');
        $product_id=$request->input('id');

        if($request->hasFile('img')){

            $img=$request->file('img');

            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="images/products/{$img_name}";

            $img->move(public_path('images/products'),$img_name);

            // delete old image
            $file_path=$request->input('file_path');
            File::delete($file_path);

            return Product::where('user_id', $user_id)->where('id', $product_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'img_url'=>$img_url,
                'category_id'=>$request->input('category_id')
            ]);

        }else{

            return Product::where('user_id', $user_id)->where('id', $product_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'category_id'=>$request->input('category_id')
            ]);
        }
    }
}
