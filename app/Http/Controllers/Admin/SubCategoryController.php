<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function index(){
        $data=Subcategory::latest()->get();
        return view('admin.allsubcategory',compact('data'));
    }

    public function AddSubCategory(){
        $categories=Category::latest()->get();
        return view('admin.addsubcategory',compact('categories'));
    }

    public function Store(Request $request){

        $request->validate([
            'subcategory_name' => ['required', 'unique:subcategories'],
            'category_id' => ['required'],
        ]);
        
        $category_id = $request->category_id;
        $category_name=Category::where('id',$category_id)->value('category_name');
        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'category_name' => $category_name,
            'category_id' => $category_id,
            'slug' => strtolower(str_replace(' ','-',$request->subcategory_name,))
        ]);

        Category::where('id',$category_id)->increment('subcategory_count',1);

        return redirect()->route('allsubcategory')->with('message','SubCategory Added Successfuly!');
    }

    public function EditSubcat($id){
        $subcategory_info=Subcategory::findOrFail($id);
        return view('admin.editsubcategory')->with(compact('subcategory_info'));
    }

    public function Update(Request $request){
        $request->validate([
            'subcategory_name' => ['required', 'unique:subcategories'],
        ]);

        SubCategory::findOrFail($request->id)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ','-',$request->subcategory_name,))
        ]);

        return redirect()->route('allsubcategory')->with('message','Sub Category Updated Successfuly!');
    }

    public function DeleteSubcat($id){
        $subcat_id=Subcategory::where('id',$id)->value('category_id');
        Subcategory::findOrFail($id)->delete();
        Category::where('id',$subcat_id)->decrement('subcategory_count',1);
        return redirect()->route('allsubcategory')->with('message','Sub Category Deleted Successfuly!');
    }
}
