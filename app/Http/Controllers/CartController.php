<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class CartController extends Controller
{
    
    // cart view
    public function index()
    {   
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $cart = DB::table('cart')->where(array('user_id'=>$user_id,'status'=>1))->get();
            return view('/front/cart',['cart'=>$cart]);
        }
        else
        {
            return view('/front/login');
        }
    }
    
    public function boughtaddtoCart()
    {
        $product_id = $_REQUEST['product_id'];
        $user_id = $_REQUEST['user_id'];
        $checkCashback = DB::table('cashbacks')->select('*')->whereRaw('FIND_IN_SET('.$product_id.',product_id)')->first();
        if(!empty($checkCashback))
        {
        $cashback = $checkCashback->cashback;
        }
        else
        {
        $cashback = 0;
        }
        $sellerid = DB::table('products')->where(array('id'=>$product_id,'status'=>1))->first();
        $seller_id = $sellerid->user_id;
        $checkPostalCost = DB::table('postal_code')->select('*')->whereRaw('FIND_IN_SET('.$seller_id.',seller_id)')->first();
        if(!empty($checkPostalCost))
        {
            $delivery_charges = $checkPostalCost->cost;
        }
        else
        {
            $delivery_charges = 0;
        }
        $getvariantid = DB::table('product_detail')->where(array('product_id'=>$product_id,'status'=>1))->first();
        $variantIds = $getvariantid->id;        
        $token = $_REQUEST['_token'];
        $variantarray = $getvariantid->spec_detail;
        $new_unseriealized_array = unserialize($variantarray);
        $price = $new_unseriealized_array['vprice'];
        $quantity = $_REQUEST['quantity'];

        $product_cashback_amount = $price*$cashback/100;
        $totalamount = $price*$quantity;
        $user_id = $_REQUEST['user_id'];
        $cart = DB::table('cart')->where(array('user_id'=>$user_id,'product_id'=>$product_id,'variant_id'=>$variantIds,'status'=>1))->get();
        $cartcount = count($cart);
        if($cartcount==0)
        {
        $addCartData=array(
                'product_id'=>$product_id,
                'variant_id'=>$variantIds,
                '_token' => $token,
                'cashback'=>$product_cashback_amount,
                'delivery_charges'=>$delivery_charges,
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

    // Add to cart
    public function addtoCart()
    {
        //echo "<pre>";
        //print_r($_REQUEST);
        //echo "<pre>";
        //die;
        $product_cashback = $_REQUEST['cashback'];
        $product_id = $_REQUEST['product_id'];
        $zipcode = $_REQUEST['pincode'];
        $prdData = DB::table('products')
                        ->select('user_id')
                        ->where('id', $product_id)
                        ->first();
        $postalcode=DB::table('postal_code')->select('*')->where('zipcode', 'like', explode(' ', $zipcode)[0] . '%')->where('seller_id',$prdData->user_id)->first();
        $delivery_charges = 0;
        if(!empty($postalcode)) {
            $checkPinCode = DB::table('products')
                ->select('id')
                ->whereRaw('FIND_IN_SET('.$postalcode->id.',zipcode)')
                ->where('id', $product_id)
                ->get();
            $delivery_charges = $postalcode->cost;
        }
        $variantIds = $_REQUEST['variantIds'];
        $token = $_REQUEST['_token'];
        $variantarray1 = $_REQUEST['variantarray'];
        $variantarray = serialize($variantarray1);
        $whereRaw = "";
        //echo "<pre>";
        //print_r($variantarray1);
        foreach($variantarray1 as $i=> $variantarrayvalue) {

            if($i>0)
            {
                $whereRaw .= " AND ";
            }
            //$whereRaw .= "specs_detail like '%".$variantarrayvalue."%'";
            $whereRaw .= "spec_detail like '%\"".$variantarrayvalue."\"%'";
        }
        $productdetail = DB::table('product_detail')->where('product_id',$product_id)->whereRaw($whereRaw)->first();
        if(empty($productdetail))
        {
            echo "no";
        }
        else
        {
        $quantity = $_REQUEST['quantity'];
        $price = $_REQUEST['price'];
        $product_cashback_amount = $price*$product_cashback/100;
        $totalamount = $price*$quantity;
        $user_id = $_REQUEST['user_id'];
        $cart = DB::table('cart')->where(array('user_id'=>$user_id,'product_id'=>$product_id,'variant_id'=>$variantIds,'status'=>1))->get();
        $cartcount = count($cart);
        if($cartcount==0)
        {
        $addCartData=array(
                'product_id'=>$product_id,
                'variant_id'=>$variantIds,
                '_token' => $token,
                'cashback'=>$product_cashback_amount,
                'delivery_charges'=>$delivery_charges,
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
        $totalamount = $quantity*$price;
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
        $discount_percent = $cartdata->discount_percent;
        $price = $cartdata->sellprice;
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
        $totalamount = $quantity*$price;
        //$discount_amount = $totalamount*$discount_percent/100;
        //$newtotalamount = $totalamount-$discount_amount;
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
            'discount_code_id'=>$coupon_id,
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
    }
}