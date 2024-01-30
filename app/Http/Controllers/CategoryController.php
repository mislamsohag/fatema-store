<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Category Page View
    function CategoryView(){
        return view('pages.dashboard.category-page');
    }

    // Category Lis show
    function CategoryList(Request $request){
        $user_id=$request->header('id');
        return Category::where('user_id','=', $user_id)->get();
    }

    // Category Create By Modal
    function CategoryCreate(Request $request){
        $user_id=$request->header('id');
        $name=$request->input('name');

        return Category::create([
            'name'=>$name,
            'user_id'=>$user_id
        ]);
    }

    // Category Delete By Modal
    function CategoryDelete(Request $request){
        $user_id=$request->header('id');
        $category_id=$request->input('id');

       return Category::where('id', $category_id)->where('user_id', $user_id)->delete();
    }

    // Single Category Show for Update by modal
    function CategoryById(Request $request){
        $user_id=$request->header('id');
        $category_id=$request->input('id');

       return Category::where('id', $category_id)->where('user_id', $user_id)->first();
    }


    // Category Update
    function CategoryUpdate(Request $request){
        $user_id=$request->header('id');
        $category_id=$request->input('id');
        $category_name=$request->input('name');

        return Category::where('id', $category_id)->where('user_id', $user_id)
        ->update([
            'name'=>$category_name,
        ]);
    }

}
