<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\shipping_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //
    public function CategoryPage($id){
        $category=Category::findOrFail($id);
        $products=Product::where('product_category_id',$id)->latest()->get();
        return view('user.layouts.category',compact('category','products'));
    }

    
    public function SingleProduct($id){
        $product=Product::findOrFail($id);
        $related_products=Product::where('product_subcategory_id',$product->product_subcategory_id)->get();
        return view('user.layouts.product',compact('product','related_products'));
    }
    
    public function AddToCart(){
        $user_id=Auth::id();
        $cart_items=Cart::where('user_id',$user_id)->get();
        return view('user.layouts.add-to-cart',compact('cart_items'));
    }

    public function AddProductToCart(Request $request){
        $product_id=$request->id;
        $product_price=$request->price;
        $product_quantity=$request->quantity;
        Cart::insert([
          'product_id' => $product_id,
          'price' => $product_price,
          'quantity' => $product_quantity,
          'user_id' => Auth::id(),
        ]);

        return redirect()->route('addtocart')->with('message','Your item added successfuly!');
    }

    public function RemoveItemCart($id){
        Cart::findOrFail($id)->delete();
        return redirect()->route('addtocart')->with('message','Item Removed Successfuly!');
    }

    public function AddShippingAddress(Request $request){
        $request->validate([
            'phone_number' => ['required'],
            'city_name' => ['required'],
            'postal_code' => ['required'],
        ]);

        shipping_info::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('checkout')->with('message','');
    }
    
    public function GetShippingAddress(){
        return view('user.layouts.shippingaddress');
    }
    
    public function Checkout(){
        return view('user.layouts.checkout');
    }
    public function UserProfile(){
        return view('user.layouts.user-profile');
    }


    public function NewRelease(){
        return view('user.layouts.new-release');
    }

    public function TodaysDeal(){
        return view('user.layouts.todays-deal');
    }

    public function CustomService(){
        return view('user.layouts.custom-service');
    }


    public function PendingOrders(){
        return view('user.layouts.pending-orders');
    }

    public function History(){
        return view('user.layouts.history');
    }
    
}
