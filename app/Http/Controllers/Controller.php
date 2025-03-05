<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function store_product(Request $request){

        //we can use validator here to validate input field
        $product_name = $request->input('product_name');
    $rate = $request->input('rate');
    $available_stocks = $request->input('available_stocks');
    
    
    if ($request->hasFile('image')) {
       $image = $request->file('image');
       $imageName = $image->getClientOriginalName(); 
       $imagePath = $image->storeAs('public/images', $imageName); 
    } else {
        $imagePath = null;
    }
    
    // Create new product 
    $product = new Product();
    $product->product_name = $product_name;
    $product->rate = $rate;
    $product->available_stocks = $available_stocks;
    $product->image = $imageName;
    
    // Save the product in the database
    $product->save();

    return redirect('/dashboard')->with('success', 'Product added successfully!');
    }

    public function  add_to_cart($productId){
            $user=Auth::user()->id;
            $cart=Cart::create([
                'user_id'=>$user,
                'product_id'=>$productId
            ]);
            if($cart->id){
                return redirect()->back()->with('success', 'Product added  to cart!');
            }
    }
}
