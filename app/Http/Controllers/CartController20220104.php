<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CartController extends Controller
{
    
    // cart view
    public function index()
    {   
        $cartitem = \Cart::getContent();
        if($cartitem->count()==0)
        {
            return redirect('/product-list');
        }
        return view('front/cart');
    }
    // Add to cart
    public function addtoCart($id)
    {
        // $product = DB::table('products')->where('id',$id)->first();

        //     if(!$product) {abort(404);}
        //     $data=array(
        //     'id' => $product->id,
        //     'name' => $product->productnumber,
        //     'price' => $product->price,
        //     'quantity' => 1,
        //     'attributes'=>array('vendorid'=>$product->createdby)
        //     );
        //     \Cart::add($data);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
        $cartitem = \Cart::getContent();
        //print_r($cartitem);die;
        $existarr=array();
        if(!empty($cartitem))
        {   foreach($cartitem as $item){
            array_push($existarr,$item->id);
            }
        }
        //print_r($existarr);die;
        if(!(in_array($id,$existarr)))
        {
        $product = DB::table('products')->where('id',$id)->first();

            if(!$product) {abort(404);}
            $data=array(
            'id' => $product->id,
            'name' => $product->productnumber,
            'price' => $product->price,
            'quantity' => 1,
            'attributes'=>array('vendorid'=>$product->createdby)
            );
            \Cart::add($data);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        else
        {
            return back();
        }
    }

    // remove cart item
    public function removeitem($id)
    {
      \Cart::remove($id);
      return redirect()->back()->with('success', 'Successfully remove cart item');
    }

    public function  checkout()
    {   
        $cartitem = \Cart::getContent();
        if($cartitem->count()==0)
        {
            return redirect('/product-list');
        }
        if(Session()->has('logged_user'))
        {
            $user_id=Session()->get('logged_user')->id;
            $userdetail=DB::table('userregister')->where('id',$user_id)->first();
            return view('/front/checkout',['userdetail'=>$userdetail]);
        }
        if(Session()->has('logged_buyer'))
        {
            $user_id=Session()->get('logged_buyer')->id;
            $userdetail=DB::table('vendor_retailer')->where('id',$user_id)->first();
            return view('/front/checkout',['userdetail'=>$userdetail]);
        }

    }
        public function BuytoCart($id)
        {   
            $product = DB::table('products')->where('id',$id)->first();
            if(!$product) {abort(404);}
            $data=array(
            'id' => $product->id,
            'name' => $product->productnumber,
            'price' => $product->price,
            'quantity' => 1,
            'attributes'=>array('vendorid'=>$product->createdby)
            );
            \Cart::add($data);
            return redirect('/checkout');
        }
        
    
}
