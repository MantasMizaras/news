<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function Index(){
        $category = DB::table('categories')->orderBy('id', 'desc')->paginate(2);
        return view('backend.category.index',compact('category'));
    }

    public function AddCategory(){
        return view('backend.category.create');
    }

    public function StoreCategory(Request $request){
        $validatedData = $request->validate([
            'category_en' => 'required|unique:categories|max:255',
            'category_hin' => 'required|unique:categories|max:255',
        ]);

        $data = array();
        $data['category_en'] = $request->category_en;
        $data['category_hin'] = $request->category_hin;
        DB::table('categories')->insert($data);

        $notification = array(
         'message' => "Category inserted successfully",
        'alert-type' => 'success'
        );

        return Redirect()-> route('categories')->with($notification);
    }
}
