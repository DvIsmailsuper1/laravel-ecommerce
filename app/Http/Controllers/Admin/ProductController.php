<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class ProductController extends Controller
{
    //
    public function Index(){
        $products=Product::latest()->get();
        return view('admin.allproduct',compact('products'));
    }

    public function AddProduct(){
        $categories=Category::latest()->get();
        $subcategories=Subcategory::latest()->get();
        return view('admin.addproduct',compact('categories','subcategories'));
    }

    public function Store(Request $request){
        $request->validate([
            'product_name' => ['required', 'unique:products'],
            'price' => ['required'],
            'quantity' => ['required'],
            'product_short_des' => ['required'],
            'product_long_des' => ['required'],
            'product_category_id' => ['required'],
            'product_subcategory_id' => ['required'],
            'product_img'=>['required','image','mimes:jpeg,png,jpg,gif,svg','max:1000'],
        ]);

        $image=$request->file('product_img');
        $image_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$image_name);
        $image_url='upload/' . $image_name;

        $category_name=Category::where('id',$request->product_category_id)->value('category_name');
        $subcategory_name=SubCategory::where('id',$request->product_subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_img' => $image_url,
            'slug' => strtolower(str_replace(' ','-',$request->product_name,))
        ]);

        Category::where('id',$request->product_category_id)->increment('product_count',1);
        SubCategory::where('id',$request->product_subcategory_id)->increment('product_count',1);

        return redirect()->route('allproduct')->with('message','Product Added Successfuly!');
    }

    public function EditImage($id){
      $productinfo =Product::findOrFail($id);
      return view('admin.editproductimg',compact('productinfo'));
    }

    public function UpdateImage(Request $request){
        $request->validate([
            'product_img'=>['required','image','mimes:jpeg,png,jpg,gif,svg','max:1000'],
        ]);

        $id=$request->id;

        $image=$request->file('product_img');
        $image_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$image_name);
        $image_url='upload/' . $image_name;

        

        
        Product::findOrFail($id)->update([
            'product_img' => $image_url,
        ]);

        return redirect()->route('allproduct')->with('message','Product Image Updated Successfuly!');

    }

    public function EditProduct($id){
        $productinfo =Product::findOrFail($id);
        return view('admin.editproduct',compact('productinfo'));
    }

    public function UpdateProduct(Request $request){
        $request->validate([
            'product_name' => ['required', 'unique:products'],
            'price' => ['required'],
            'quantity' => ['required'],
            'product_short_des' => ['required'],
            'product_long_des' => ['required'],
        ]);

        Product::findOrFail($request->id)->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'slug' => strtolower(str_replace(' ','-',$request->product_name,))
        ]);

        return redirect()->route('allproduct')->with('message','Product Updated Successfuly!');
    }

    public function DeleteProduct($id){
        $cat_id=Product::where('id',$id)->value('product_category_id');
        $subcat_id=Product::where('id',$id)->value('product_subcategory_id');
        Product::findOrFail($id)->delete();
        Category::where('id',$cat_id)->decrement('product_count',1);
        SubCategory::where('id',$subcat_id)->decrement('product_count',1);
        return redirect()->route('allproduct')->with('message','Product Deleted Successfuly!');
    }
}
