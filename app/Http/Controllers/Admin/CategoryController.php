<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function Index(){
        $data = Category::latest()->get();
        return view('admin.allcategory',compact('data'));
    }
    

    public function AddCategory(){
        return view('admin.addcategory');
    }



    public function StoreCategory(Request $request){
        $request->validate([
            'category_name' => ['required', 'unique:categories'],
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name,))
        ]);

        return redirect()->route('allcategory')->with('message','Category Added Successfuly!');
    }



    public function EditCategory($id){
        $category_info=Category::findOrFail($id);
        return view('admin.editcategory')->with(compact('category_info'));
    }



    public function UpdateCategory(Request $request){
        $request->validate([
            'category_name' => ['required', 'unique:categories'],
        ]);
        Category::findOrFail($request->id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name,))
        ]);
        return redirect()->route('allcategory')->with('message','Category Updated Successfuly!');
    }



    public function DeleteCategory($id){
        Category::findOrFail($id)->delete();
        return redirect()->route('allcategory')->with('message','Category Deleted Successfuly!');
    }


}
