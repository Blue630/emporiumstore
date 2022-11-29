<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class CartController extends Controller
{
    
    // cart view
    public function index()
    {   
        if(Session()->has('logged_user'))
        {
            $user_session = session('logged_user');
            $user_id = $user_session->id;
        }
        $cart = DB::table('cart')->where(array('user_id'=>$user_id,'status'=>1))->get();
        return view('/front/cart',['cart'=>$cart]);
    }

    // Add to cart
    public function addtoCart()
    {
        //echo "<pre>";
        //print_r($_REQUEST);die;
        $product_id = $_REQUEST['product_id'];
        $variantIds = $_REQUEST['variantIds'];
        $token = $_REQUEST['_token'];
        $variantarray = serialize($_REQUEST['variantarray']);
        $quantity = $_REQUEST['quantity'];
        $price = $_REQUEST['price'];
        $totalamount = $price*$quantity;
        $user_id = $_REQUEST['user_id'];
        $cart = DB::table('cart')->where(array('user_id'=>$user_id,'product_id'=>$product_id,'variant_id'=>$variantIds))->get();
        $cartcount = count($cart);
        if($cartcount==0)
        {
        $addCartData=array(
                'product_id'=>$product_id,
                'variant_id'=>$variantIds,
                '_token' => $token,
                'spec_detail'=>$variantarray,
                'quantity'=>$quantity,
                'sellprice'=>$price,
                'totalamount'=>$totalamount,
                'user_id'=>$user_id,
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            DB::table('cart')->insert($addCartData);
        }
        else
        {
            $user_id = $_REQUEST['user_id'];
            $quantity = $_REQUEST['quantity'];
            $product_id = $_REQUEST['product_id'];
            $variantIds = $_REQUEST['variantIds'];
            $cart = DB::table('cart')->where(array('user_id'=>$user_id,'product_id'=>$product_id,'variant_id'=>$variantIds))->first();
            $cart_id = $cart->id;
            $oldquantity = $cart->quantity;
            $newquantity = $oldquantity+$quantity;
            //die;
            $cartdata=DB::table('cart')->where('id',$cart_id)->first();
            $price = $cartdata->sellprice;
            $totalamount = $newquantity*$price;
            $updateData=array(
                'quantity'=>$newquantity,
                'totalamount'=>$totalamount,
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            DB::table('cart')->where(array('id'=>$cart_id, 'user_id'=>$user_id))->update($updateData);
            return back()->with('success','Successfully updated Cart');

        }
    }

    // remove cart item
    public function removeitem($id)
    {
        DB::table('cart')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'Successfully remove cart item');
    }
    public function updateitem()
    {
        $cart_id = $_REQUEST['id'];
        $user_id = $_REQUEST['user_id'];
        $quantity = $_REQUEST['quantity'];
        $cartdata=DB::table('cart')->where('id',$cart_id)->first();
        $price = $cartdata->sellprice;
        $totalamount = $quantity*$price;
        $updateData=array(
            'quantity'=>$quantity,
            'totalamount'=>$totalamount,
            'created_at'=>date('Y-m-d H:i:s'),
            'status'=>1
        );
        DB::table('cart')->where(array('id'=>$cart_id, 'user_id'=>$user_id))->update($updateData);
        return back()->with('success','Successfully updated Cart');
    }
    public function discountcart()
    {   
        if(Session()->has('logged_user'))
        {
            $user_session = session('logged_user');
            $user_id = $user_session->id;
        }
        if(isset($_REQUEST['discountcode']) && $_REQUEST['discountcode']!="")
        {
        //echo $crrdate = date('Y-m-d');
        $discountcode = $_REQUEST['discountcode'];
        $discountdata=DB::table('coupons')->where('code',$discountcode)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->get();
        $TotlNums = count($discountdata);
        //print_r($TotlNums);die;
            if($TotlNums>0)
            {
                foreach ($discountdata as $discountvalue) {
                $percent = $discountvalue->percent;
                $code = $discountvalue->code;
                }
                $cartdata=DB::table('cart')->where('user_id',$user_id)->get();
                foreach ($cartdata as $cartvalue) {
                    $totalamount = $cartvalue->totalamount;
                }
                $carttotalamountwithoutdiscount = $cartdata->sum('totalamount');
                $discount_amount = $carttotalamountwithoutdiscount*$percent/100;
                $carttotalamountafterdiscount = $carttotalamountwithoutdiscount-$discount_amount;
                return $new_discount_amount = $discount_amount.'-'.$carttotalamountafterdiscount;
            }
            else
            {
                echo $msg = "Invalid Code!";
            }
        }
    }
    function paynow(){
        $amount = $_REQUEST['amount'];
        $first_name = $_REQUEST['first_name'];
        $email = $_REQUEST['email'];
        $address = $_REQUEST['address'];
        $user_id = $_REQUEST['user_id'];
        $alt_mobile_no = $_REQUEST['alt_mobile_no'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $pincode = $_REQUEST['pincode'];
        return view('/front/paynow',['city'=>$city,'state'=>$state,'pincode'=>$pincode,'alt_mobile_no'=>$alt_mobile_no,'user_id'=>$user_id,'amount'=>$amount,'first_name'=>$first_name,'email'=>$email,'address'=>$address]);
    }
}