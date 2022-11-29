<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class CheckoutController extends Controller
{
    
    // cart view
    public function index()
    {   
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $cartid = '';
            $aminities = '';
            if(isset($_REQUEST['cartid']) && $_REQUEST['cartid']!="")
            {
            $cartid = $_REQUEST['cartid']; 
            $newcartid = array();
            $newcartid = implode(',', $cartid);
            $aminities = explode(",",$newcartid);
            
            foreach ($aminities as $aminvalue) {
            $updateData=array(
                'movetocheckout'=>1
            );
            DB::table('cart')->where(array('id'=>$aminvalue,'user_id'=>$user_id))->update($updateData);
            }
            }

            
            if(Auth::check())
            {
               $user_id = auth()->user()->id;
            }
            $cart = DB::table('cart')->where(array('user_id'=>$user_id,'status'=>1,'movetocheckout'=>1))->get();
            return view('/front/checkout',['cart'=>$cart]);
        }
        else
        {
            return view('/front/login');
        }
        
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
    /*public function updateitem()
    {
        $cart_id = $_REQUEST['id'];
        $user_id = $_REQUEST['user_id'];
        $quantity = $_REQUEST['quantity'];
        $cartdata=DB::table('cart')->where('id',$cart_id)->first();
        $price = $cartdata->sellprice;
        $totalamount = $quantity*$price;
        $product_id = $cartdata->product_id;
        $checkCashback = DB::table('cashbacks')->select('*')->whereRaw('FIND_IN_SET('.$product_id.',product_id)')->first();
        if(!empty($checkCashback))
        {
            $cashback = $checkCashback->cashback;
        }
        else
        {
            $cashback = 0;
        }
        $updated_cashback_amount = $totalamount*$cashback/100;
        $updateData=array(
            'cashback'=>$updated_cashback_amount,
            'quantity'=>$quantity,
            'totalamount'=>$totalamount,
            'created_at'=>date('Y-m-d H:i:s'),
            'status'=>1
        );
        DB::table('cart')->where(array('id'=>$cart_id, 'user_id'=>$user_id))->update($updateData);
        return back()->with('success','Successfully updated Cart');
    }*/
    public function updateitem()
    {
        $cart_id = $_REQUEST['id'];
        $user_id = $_REQUEST['user_id'];
        $quantity = $_REQUEST['quantity'];
        $cartdata=DB::table('cart')->where('id',$cart_id)->first();
        $price = $cartdata->sellprice;
        $totalamount = $quantity*$price;
        $product_id = $cartdata->product_id;
        $checkCashback = DB::table('cashbacks')->select('*')->whereRaw('FIND_IN_SET('.$product_id.',product_id)')->first();
        if(!empty($checkCashback))
        {
            $cashback = $checkCashback->cashback;
        }
        else
        {
            $cashback = 0;
        }
        $updated_cashback_amount = $totalamount*$cashback/100;

        if($cartdata->discount_percent=='')
        {
            $discount_amount = 0;
            $discount_percent = '';
            $newtotalamount = $totalamount-$discount_amount;
        }
        else
        {
            $discount_percent = $cartdata->discount_percent;
            $discount_amount = $totalamount*$discount_percent/100;
            $newtotalamount = $totalamount-$discount_amount;
        }
        $updateData=array(
            'cashback'=>$updated_cashback_amount,
            'quantity'=>$quantity,
            'discount_amount'=>$discount_amount,
            'totalamount'=>$newtotalamount,
            'created_at'=>date('Y-m-d H:i:s'),
            'status'=>1
        );
        DB::table('cart')->where(array('id'=>$cart_id, 'user_id'=>$user_id))->update($updateData);
        return back()->with('success','Successfully updated Cart');
    }
    
    
    public function removediscount()
    {
        $cart_id = $_REQUEST['id'];
        $user_id = $_REQUEST['user_id'];
        $quantity = $_REQUEST['quantity'];
        $cartdata=DB::table('cart')->where('id',$cart_id)->first();
        $discount_amount = $cartdata->discount_amount;
        $newtotalamount = $cartdata->totalamount + $discount_amount;
        $updateData=array(
            'discount_code_id'=>NULL,
            'discount_amount'=>0,
            'discount_percent'=>NULL,
            'totalamount'=>$newtotalamount,
        );
        DB::table('cart')->where(array('id'=>$cart_id, 'user_id'=>$user_id))->update($updateData);
        return back()->with('success','Successfully updated Cart');
    }
    
    
    /*public function discountcart()
    {   
        if(Session()->has('logged_user'))
        {
            $user_session = session('logged_user');
            $user_id = $user_session->id;
        
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
                $cartdata=DB::table('cart')->where(array('user_id'=>$user_id,'movetocheckout'=>1,'status'=>1))->get();
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
    }*/
    public function discountcart()
    {   
        if(Auth::check())
        {
        $user_id = auth()->user()->id;
        
        if(isset($_REQUEST['discountcode']) && $_REQUEST['discountcode']!="")
        {
        $discountcode = $_REQUEST['discountcode'];
        $discountdata=DB::table('coupons')->where('code',$discountcode)->where('end_date', '>=', date('Y-m-d'))->first();
        if(!$discountdata)
        {
            echo "Invalid Coupon";
        }
        else
        {
        //echo "Coupon hai";die;
        $coupon_id = $discountdata->id;
        $coupon_percent = $discountdata->percent;
        $cart_id = $_REQUEST['cart_id'];
        $cartdata=DB::table('cart')->where('id',$cart_id)->first();
        $product_id = $cartdata->product_id;
        $quantity = $cartdata->quantity;
        $sellprice = $cartdata->sellprice;
        $totalamount = $cartdata->totalamount;
        $checkcoupononproduct=DB::table('products')->where(array('discount_code_id'=>$coupon_id,'id'=>$product_id))->get();
        $count = count($checkcoupononproduct);
        if($count==0)
        {
            echo "Invalid Coupon";
        }
        else
        {
            //echo "APPLY";die;
            $updated_discount_amount = $totalamount*$coupon_percent/100;
            $newtotalamount = $totalamount-$updated_discount_amount;
            $updateData=array(
            'discount_percent'=>$coupon_percent,
            'discount_amount'=>$updated_discount_amount,
            'totalamount'=>$newtotalamount
            );
            DB::table('cart')->where(array('id'=>$cart_id, 'user_id'=>$user_id))->update($updateData);
        }
        }
        }
        }
    }
    function paynow(){
        $amount = $_REQUEST['amount'];
        $user_id = $_REQUEST['user_id'];
        return view('/front/paynow');
    }
    /*function paynow(){
        $amount = $_REQUEST['amount'];
        $first_name = $_REQUEST['first_name'];
        $email = $_REQUEST['email'];
        $address = $_REQUEST['address'];
        $address2 = $_REQUEST['address2'];
        $user_id = $_REQUEST['user_id'];
        $phoneno = $_REQUEST['phoneno'];
        $city = $_REQUEST['city'];
        $country = $_REQUEST['country'];
        $state = $_REQUEST['state'];
        $pincode = $_REQUEST['pincode'];
        return view('/front/paynow',['country'=>$country,'address2'=>$address2,'city'=>$city,'state'=>$state,'pincode'=>$pincode,'phoneno'=>$phoneno,'user_id'=>$user_id,'amount'=>$amount,'first_name'=>$first_name,'email'=>$email,'address'=>$address]);
        return view('/front/paynow');
    }*/
}