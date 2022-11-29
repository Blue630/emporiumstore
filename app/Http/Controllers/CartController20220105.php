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
        /*$query_chkdup = DB::table('cart')->where('product_id',$product_id)->where('user_id',$user_id)->get();
        $count = count($query_chkdup);
        //dd($query_chkdup);die;
        if($count>0)
        {
            echo $msg = "Product Already Present in Cart!";
        }*/
        $product_id = $_REQUEST['product_id'];
        $token = $_REQUEST['_token'];
        $variantarray = serialize($_REQUEST['variantarray']);
        /*$query = DB::table('product_detail');
        foreach ($variantarray as $key=>$val) 
        {
            foreach ($val as $k => $v) {
            //echo"<br>".$v;
            //$new[]= "spec_detail LIKE '%".$v."%'";
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
            }
        }*/
        $quantity = $_REQUEST['quantity'];
        $price = $_REQUEST['price'];
        $totalamount = $price*$quantity;
        $user_id = $_REQUEST['user_id'];
        $addCartData=array(
                'product_id'=>$product_id,
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
                echo $carttotalamountafterdiscount;
                //$AmountAfterDiscount = $subtotal - (($subtotal*$_SESSION['sesDisPercent'])/100);
                //$_SESSION['amounttopay2'] = $AmountAfterDiscount;
            }
            else
            {
                echo $msg = "Invalid Code!";
            }
        }
    }
}