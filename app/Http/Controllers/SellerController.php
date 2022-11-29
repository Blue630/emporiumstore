<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Transaction;
// use App\commonmodel;
class SellerController extends Controller
{
    function index()
    {
    	return view('seller/index');
    }
    
    function withdrawfundrequestListing(){
    $user_id = auth()->user()->id;
    $withdrawfundrequests = DB::table('withdrawl_request')->where('user_id',$user_id)->orderBy('id','desc')->paginate(12);
    return view('seller/withdrawfundrequest',['withdrawfundrequests'=>$withdrawfundrequests]);
    }
    
    function withdrawfunds()
    {
    	return view('seller/withdrawfunds');
    }
    function getorderproduct(Request $req){
        //echo "<pre>";
        //print_r($_REQUEST);//die;
        $user_id = auth()->user()->id;
        $order_id = $_REQUEST['order_id'];
        $order_detail_id = $_REQUEST['order_data_id'];
        ?>
        <?php
        /*$transaction_history = DB::table('transaction_history')->join('products','products.id','transaction_history.product_id','transaction_history.order_detail_id')->where(array('transaction_history.seller_paid'=>0,'transaction_history.user_id'=>$user_id,'transaction_history.order_detail_id'=>$order_detail_id))->orderBy('transaction_history.id','desc')->get();*/
        
        $get_order_detail = DB::table('transaction_history')->where(array('order_detail_id'=>$order_detail_id,'user_id'=>$user_id))->get();
        foreach($get_order_detail as $get_order_detail_result)
        {
            $product_id = $get_order_detail_result->product_id;
            
        $get_product = DB::table('products')->where(array('id'=>$product_id))->get();
        foreach($get_product as $get_product_result)
        {
            $product_name = $get_product_result->name;
        
                /*        
                $transaction_history = DB::table('order_detail')->join('products','products.id','order_detail.product_id')->where(array('order_id'=>$order_detail_id,'seller_id'=>$user_id))->get();
                if(!empty($transaction_history))
                {
                foreach($transaction_history as $transaction_hisory_result)
                {
                $product_id = $transaction_hisory_result->product_id;
                $product_name = $transaction_hisory_result->name;
                $order_detail_id = $transaction_hisory_result->id;*/
                ?>
                <option value="<?php echo $product_id;?>" ><?php echo $product_name;?></option>
                <?php
                }
        }
        
    }
    function fetchprice(){
        $product_id = $_REQUEST['product_id'];
        $order_detail_id = $_REQUEST['orderdetailid'];
        $transaction_result = DB::table('transaction_history')->where(array('product_id'=>$product_id,'order_detail_id'=>$order_detail_id))->first();
        $price = $transaction_result->seller_amount;
        return $price;
    }
    function submitwithdrawrequest(Request $req)
    {
        $user_id = auth()->user()->id;
        $wallet = $_REQUEST['wallet'];
        $product_id = $_REQUEST['product_id'];
        $order_id = $_REQUEST['order_id'];
        $order_detail_id = $_REQUEST['orderdetailid'];
        $productid = implode(',' ,$_REQUEST['product_id']);
        $req_amount = $_REQUEST['req_amount'];
        $new_balance = $wallet - $req_amount;
        $balance_amount = $new_balance;
        
        /*if($req_amount>$wallet)
        {
            $currentURL = URL::to('/seller/dashboard');
            echo "<script>alert('Your request wallet amount is greater than actual wallet amount!')</script>";
            echo "<script>window.location.href='".$currentURL."'</script>";
            exit;
        }*/
        
        /*echo "<pre>";
        print_r($_REQUEST);
        die;*/
        
        $ticket = 'EMP';
        $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shuffle_str = str_shuffle($random_str);
        $request_number = $ticket.substr($shuffle_str,0,6);
        $addwithdrawlrequestData=array(
            'request_number'=>$request_number,
            'user_id'=>$user_id,
            'product_id'=>$productid,
            'order_detail_id'=>$order_detail_id,
            'name'=>$req->input('name'),
            'last_wallet_balance'=>$wallet,
            'email'=>$req->input('email'),
            'country'=>$req->input('country'),
            'state'=>$req->input('state'),
            'city'=>$req->input('city'),
            'pincode'=>$req->input('pincode'),
            'address'=>$req->input('address'),
            'req_amount'=>$req->input('req_amount'),
            'balance_amount'=>$balance_amount,
            'payment_gateway_type'=>$req->input('payment_gateway_type'),
            'payment_status'=>0,
            'created_date'=>date('Y-m-d H:i:s')
        );
        DB::table('withdrawl_request')->insert($addwithdrawlrequestData);
        $lastid = DB::getPdo()->lastInsertId();
        if($lastid!='')
        {
            $updateDate=array(
            'wallet'=>$balance_amount,
            );
            DB::table('users')->where('id',$user_id)->update($updateDate);
            
            
            /*$this->from=strtolower($req->input('email'));
            $dataset=array(
            'name'=>$req->input('name'),
            'email'=>strtolower($req->input('email')),
            'country'=>$req->input('country'),
            'state'=>$req->input('state'),
            'city'=>$req->input('city'),
            'pincode'=>$req->input('pincode'),
            'address'=>$req->input('address'),
            'payment_gateway_type'=>$req->input('payment_gateway_type'),
            'req_amount'=>$req->input('req_amount'),
            );
            $res=  Mail::send('front/sendmail/withdraw_fund_email',$data =
            [
            'dataset'=>$dataset 
            ],function($message){
            //return $data;
            $message->from($this->from,'Withdraw Fund Request');
            $message->to('djsaluja18@gmail.com','Withdraw Fund');
            $message->subject('Withdraw Fund Request');
            });*/
        }
        return back()->with('success','Successfully submit seller withdraw fund request');
    }
    function updatesellerprofile()
    {
    	return view('seller/updatesellerprofile');
    }
    function editseller(Request $req, $id)
    {
    $business_type=$_REQUEST['business_type'];
    if($business_type=="Business")
    {
    $updateDate=array(
    'first_name'=>$req->input('first_name'),
    'middle_name'=>$req->input('middle_name'),
    'last_name'=>$req->input('last_name'),
    'reg_business_name'=>$req->input('reg_business_name'),
    'off_business_mobile'=>$req->input('off_business_mobile'),
    'vat_number'=>$req->input('vat_number'),
    'business_reg_num'=>$req->input('business_reg_num'),
    'business_address'=>$req->input('business_address'),
    'business_agree'=>$req->input('business_agree'),
    'business_type'=>$req->input('business_type'),
    );
    }
    if($business_type=="Individual")
    {
    $updateDate=array(
    'first_name'=>$req->input('fname'),
    'middle_name'=>$req->input('mname'),
    'last_name'=>$req->input('lname'),
    'mobile'=>$req->input('mobile'),
    'alt_mobile_no'=>$req->input('alt_mobile_no'),
    'pincode'=>$req->input('pincode'),
    'state'=>$req->input('state'),
    'address'=>$req->input('address'),
    'ind_agree'=>$req->input('ind_agree'),
    'business_type'=>$req->input('business_type'),
    );
    }
    DB::table('sellers')->where('user_id',$id)->update($updateDate);
    return back()->with('success','Successfully updated Seller details');
    }
    function sellerlogin()
    {
    	return view('auth/login');
    }
    function deleteadditional($id,$product_id)
    {
        DB::table('additional')->where([['id', '=', $id],['product_id', '=', $product_id]])->delete();
        return back();   
    }
    function deletevariant($id,$product_id)
    {
        DB::table('product_detail')->where([['id', '=', $id],['product_id', '=', $product_id]])->delete();
        return back();   
    }
    /* ----   Pages Functions Starts Here ------ */
    // manage Page
    function manage_pages()
    {
        $page=DB::table('pages')->orderBy('id','desc')->get();
        return view('seller/pages/manage_pages',['page'=>$page]);
    }    
    function edit_aboutus(Request $req, $id)
    {
        if($req->isMethod('post'))
        {
            $updateDate=array(
                
                'page_name'=>$req->input('page_name'),
                'heading'=>$req->input('heading'),
                'content'=>$req->input('content'),
                'heading2'=>$req->input('heading2'),
                'heading3'=>$req->input('heading3'),
                'content2'=>$req->input('content2'),
                'heading4'=>$req->input('heading4'),
                'content3'=>$req->input('content3'),
                'updated_at'=>date('Y-m-d H:i:s')
            );        
            if($req->hasFile('banner_image'))
            {   
                $time=time();
                $file=$req->hasFile('banner_image');
                $updateDate['banner_image']=$time.'_'.$req->banner_image->getClientOriginalName();
                $imagename=$time.'_'.$req->banner_image->getClientOriginalName();
                $req->banner_image->move(public_path('pages/'),$imagename);
            }
            
            if($req->hasFile('heading2_image'))
            {   
                $time=time();
                $file=$req->hasFile('heading2_image');
                $updateDate['heading2_image']=$time.'_'.$req->heading2_image->getClientOriginalName();
                $imagename=$time.'_'.$req->heading2_image->getClientOriginalName();
                $req->heading2_image->move(public_path('pages/'),$imagename);
            }
            DB::table('pages')->where('id',$id)->update($updateDate);
            return back()->with('success','Successfully updated Option details');
        }
         $aboutusdetail=DB::table('pages')->where('id',$id)->first();
        return view('/seller/pages/edit_aboutus',['aboutusdetail'=>$aboutusdetail]);
    }
    
    function edit_content_page($id){
        $contactusdetail=DB::table('pages')->where('id',$id)->first();
        return view('/seller/pages/edit_contactus',['contactusdetail'=>$contactusdetail]);
    }
    
    function edit_content(Request $req, $id)
    {        
        if($req->isMethod('post'))
        {
            $updateDate=array(                
                'heading'=>$req->input('heading'),
                'description'=>$req->input('description'),
                'bottom_heading'=>$req->input('bottom_heading'),
                'updated_at'=>date('Y-m-d H:i:s')
            );
            if($req->hasFile('image'))
            {  
                $time=time();
                $file=$req->hasFile('image');
                $updateDate['image']=$time.'_'.$req->image->getClientOriginalName();
                $imagename=$time.'_'.$req->image->getClientOriginalName();
                $req->image->move(public_path('pages/'),$imagename);
            }
            DB::table('page_content')->where('id',$id)->update($updateDate);
            return back()->with('success','Successfully updated Option details');
        }
         $content=DB::table('page_content')->where('id',$id)->first();
        return view('/seller/pages/edit_content',['content'=>$content]);
    }
     /* ----   Pages Functions Ends Here ------ */
    // products
    function addprodouct(Request $req)
    {   
        $zipcode = array();
        $createdby=auth()->user()->id;        
        $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shuffle_str = str_shuffle($random_str);
        $scode = substr($shuffle_str,0,6);
        $ran = substr($shuffle_str,0,6);
        if($req->isMethod('post'))
        {
            // $this->validate($req,
            // [
            // 'name'=>'unique:products,name'
            // ],
            // [
            //     'name.unique'=>'Product Name Already Exist'
            // ]);
            $addData=array(
                'product_code'=>$scode,
                //'zipcode'=>$req->input('zipcode'),
                'zipcode' => implode(",",(array)$req->input('zipcode')),
                'catid'=>$req->input('catid'),
                'subcat_id'=>$req->input('subcat_id'),
                'name'=>$req->input('name'),
                'quantity'=>$req->input('quantity'),
                'price'=>$req->input('price'),
                'discount'=>$req->input('discount'),
                'discount_code_id'=>$req->input('discount_code_id'),
                'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('name').'_'.$ran))),
                'user_id'=>$createdby,
                'short_desc'=>$req->input('short_desc'),
                'description'=>$req->input('description'),
                'meta_title'=>$req->input('meta_title'),
                'meta_keyword'=>$req->input('meta_keyword'),
                'meta_description'=>$req->input('meta_description'),
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );

            if($req->hasFile('proimage'))
            {   
                $time=time();
                $file=$req->hasFile('proimage');
                $addData['image']=$time.'_'.$req->proimage->getClientOriginalName();
                $imagename=$time.'_'.$req->proimage->getClientOriginalName();
                $req->proimage->move(public_path('products/'),$imagename);
            }
            /*echo "<pre>";
            print_r($_REQUEST['var']);
            print_r($req->file('product_image'));
            echo "</pre>";die;*/
            //DB::enableQueryLog(); // Enable query log
            DB::table('products')->insert($addData);
            //dd(DB::getQueryLog()); // Show results of log
            $id = DB::getPdo()->lastInsertId();

            $variantcount = 0;
            foreach ($_REQUEST['var'] as $varArr) {
                $variantcount++;
                $serialize_data = serialize($varArr);
                DB::table('product_detail')->insert(
                    array(
                        'product_id'     =>   $id, 
                        'spec_detail'   =>   $serialize_data,
                        'created_at'=>date('Y-m-d H:i:s')
                    )
                    );
                $variantid = DB::getPdo()->lastInsertId();
                if($req->has('product_image')) {
                $time=time();
                $imageArr = $req->file('product_image')[$variantcount];
                foreach ($imageArr as $image) {
                $name = $time.'_'.$image->getClientOriginalName();
                $aa = $image;
                $aa->move(public_path('/product_image'), $name);
                    $data[] = $name;
                    DB::table('additional')->insert(
                    array(
                        'option_id' => $variantid,
                        'product_id'     =>   $id, 
                        'product_image'   =>   $name
                    )
                    );
                }
                }
            }
            //die;
            return back()->with('success','Successfully added product');
        }
        $cate=DB::table('category')->orderBy('id','desc')->get();
        $postal_code=DB::table('postal_code')->orderBy('id','desc')->get();
        return view('seller/product/add_product',['cate'=>$cate,'postal_code'=>$postal_code]);
        
    }

    function getsubCat(Request $request)
    {
        $parent_id = $request->catId;
        ?>
        <option value="">--Select Sub Category--</option>
        <?php
        $data=DB::table('sub_category')->where('cat_id',$parent_id)->get();

        if(!empty($data))
        {
            foreach ($data as $value) {
                ?>
                <option value="<?php echo $value->id;?>" > <?php echo $value->name;?></option>
                <?php
            }
        }
        else
        {
            echo "<option>No Subcategory Found</option>";
        }
    }
    function getproduct(Request $request)
    {
        $seller_id=auth()->user()->id;
        $parent_id = $request->subcatId;
        ?>
        <option value="">--Select Product--</option>
        <?php
        $data=DB::table('products')->where(array('subcat_id'=>$parent_id,'user_id'=>$seller_id))->get();

        if(!empty($data))
        {
            foreach ($data as $value) {
                ?>
                <option value="<?php echo $value->id;?>" > <?php echo $value->name;?></option>
                <?php
            }
        }
        else
        {
            echo "<option>No Product Found</option>";
        }
    }
    
    function stripesuccess(Request $req)
    {
        return view('seller/subscription/stripesuccess');
    }
    
    function success(Request $req)
    {
        $seller_id=auth()->user()->id;
        $PayerId = $_REQUEST['PayerID'];
        $payer_email = $_REQUEST['payer_email'];
        $first_name = $_REQUEST['first_name'];
        $payer_status = $_REQUEST['payer_status'];
        $last_name = $_REQUEST['last_name'];
        $address_name = $_REQUEST['address_name'];
        $address_street = $_REQUEST['address_street'];
        $address_city = $_REQUEST['address_city'];
        $address_country_code = $_REQUEST['address_country_code'];
        $residence_country = $_REQUEST['residence_country'];
        $txn_id = $_REQUEST['txn_id'];
        $mc_currency = $_REQUEST['mc_currency'];
        $mc_gross = $_REQUEST['mc_gross'];
        $protection_eligibility = $_REQUEST['protection_eligibility'];
        $payment_gross = $_REQUEST['payment_gross'];
        $payment_status = $_REQUEST['payment_status'];
        $pending_reason = $_REQUEST['pending_reason'];
        $payment_type = $_REQUEST['payment_type'];
        $handling_amount = $_REQUEST['handling_amount'];
        $shipping = $_REQUEST['shipping'];
        $quantity = $_REQUEST['quantity'];
        $txn_type = $_REQUEST['txn_type'];
        $payment_date = $_REQUEST['payment_date'];
        $custom = $_REQUEST['custom'];
        $notify_version = $_REQUEST['notify_version'];
        $verify_sign = $_REQUEST['verify_sign'];
        if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']!="")
        {
            $addData = array(
            'user_id'=>$seller_id,
            'PayerID'=>$PayerId,
            'payer_email'=>$payer_email,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'payer_status'=>$payer_status,
            'address_name'=>$address_name,
            'address_street'=>$address_street,
            'address_city'=>$address_city,
            'address_country_code'=>$address_country_code,
            'residence_country'=>$residence_country,
            'txn_id'=>$txn_id,
            'mc_currency'=>$mc_currency,
            'mc_gross'=>$mc_gross,
            'protection_eligibility'=>$protection_eligibility,
            'payment_gross'=>$payment_gross,
            'payment_status'=>$payment_status,
            'pending_reason'=>$pending_reason,
            'payment_type'=>$payment_type,
            'handling_amount'=>$handling_amount,
            'shipping'=>$shipping,
            'quantity'=>$quantity,
            'txn_type'=>$txn_type,
            'payment_date'=>$payment_date,
            'custom'=>$custom,
            'notify_version'=>$notify_version,
            'verify_sign'=>$verify_sign
            );
            DB::table('payment_response')->insert($addData);
            $random_str1 = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffle_str1 = str_shuffle($random_str1);
            $oid = "SUBSCRIBE".substr($shuffle_str1,0,5);
            $updateData=array(
            'orderid'=>$oid,
            );
            DB::table('payment_response')->where(array('custom'=>$custom))->update($updateData);
        }
        else
        {
            $Msg = "Your Session Has Expired!";
        }
        return view('seller/subscription/success');
    }
    
    function getSpecification(Request $request)
    {
        $parent_id = $request->catId;
        ?>
        <label>Attributes</label>
        <div id="attributes_clones">
        <div class="clone1"> 
            <hr>
        <div class="dlete_row">x</div>
        <?php
        $specdata = DB::table('specifications')
        ->select('*')
        ->whereRaw('FIND_IN_SET('.$parent_id.',cat_id)')
        ->get();
                          
        //$specdatas = DB::table('specifications')->whereIn('cast_id', array( 9))->get();
        //$specdata = DB::table('specifications')->whereIn('cast_id', array($parent_id))->get();

        //$specdata=DB::table('specifications')->where('cat_ids',$parent_id)->get();
        if(!empty($specdata[0]))
        {
            foreach ($specdata as $value) {
                $specs_id = $value->id;
                $specs_name = $value->slug;
                $optiondata=DB::table('options')->where('specs_id',$specs_id)->get();
                if(!empty($optiondata))
                {
                ?>
                <div class="row clearfix">
                    <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                        <?php echo $value->name;?></label>
                    <div class="col-8">                        
                        <select name="var[1][<?php echo $value->slug;?>]" data-attr="<?php echo $value->slug;?>" class="form-control" required>
                            <option value="">--Select <?php echo $value->name;?>--</option>
                            <?php
                            foreach($optiondata as $optionvalue)
                            {
                            ?>
                            <option value="<?php echo $optionvalue->name;?>"><?php echo $optionvalue->name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
                }
            }        
        ?>
        <script>
         $(document).ready(function() {
      $("#attributes_clones select").change(function(){
         var getVal = $(this).val();
         
         if(getVal!=null){
       $("#attributes_clones select").removeAttr('required');   
        $(this).attr('required',true); 
         }
         else if(!getVal)
         {
         alert('empty');
       $("#attributes_clones select").each(function(){
        $(this).attr('required',true);
       });              
         }
          else
          {
               alert('empty');
       $("#attributes_clones select").each(function(){
        $(this).attr('required',true);
       });   
          }
      });
   });
        </script>
        <div class="row clearfix">
        <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                Price</label>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">£</span>
                    </div>
                    <input type="text" data-attr="vprice" name="var[1][vprice]" class="form-control" placeholder="Price" required>
                </div>
            </div>
        </div>
        <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                Gallery Image</label>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group mb-3">
                    <!-- <input type="file" id="product_image" name="product_image[]" class="form-control" multiple> -->
                    <input type="file" data-attr="product_image" name="product_image[1][]" class="form-control" multiple required>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <input type="button" value="Add More"  onClick="addRow()" />|-|0
        <?php
        }
        else
        {
            echo "Please ask admin to add specifications & options for this category.|-|1";
        }
        ?>
    <?php
    }

    function manageproduct(Request $request)
    {
        $user_id = auth()->user()->id;
        $product = DB::table('products')->where([
            [function ($query) use ($request){
                if($term = $request->keyword ){
                    $query->orWhere('name', 'Like', '%'.$term.'%')->orWhere('price','Like','%'.$term.'%')->orWhere('quantity','Like','%'.$term.'%')->orWhere('product_code','Like','%'.$term.'%')->get();
                }
                /*else if($date = $request->daterange)
                {
                    echo "date";
                    $dateRangeArr = explode('-',$date);
                    $startDate = trim($dateRangeArr[0]);
                    $endDate = trim($dateRangeArr[1]);
                    $date1 = date_format(date_create_from_format("m/d/Y",$startDate),"Y-m-d");
                    $date2 = date_format(date_create_from_format("m/d/Y",$endDate),"Y-m-d");
                    $filterDate1 = $date1;
                    $filterDate2 = $date2;
                }*/
                else
                {
                    $orderbycategoryid = "";
                    if(isset($_REQUEST['sortbycategoryid']) && $_REQUEST['sortbycategoryid']!="")
                    {
                        $sortbycategoryids = $request->sortbycategoryid;
                        $query->orWhere('catid', 'Like', '%'.$sortbycategoryids.'%')->get();
                    }
                }
            }]
        ])
        ->where('user_id',$user_id)->orderBy("id","desc")->paginate(10);
        $cate=DB::table('category')->orderBy('id','desc')->get();
        $subcate=DB::table('sub_category')->orderBy('id','desc')->get();
        return view('seller/product/manage_product',['product'=>$product,'cate'=>$cate]);
    }
    
    function updatefeaturedproduct(Request $request)
    {
        $currentDate = date('Y-m-d');
        $is_featured = isset($_REQUEST['is_featured']) ? "1" : "0";
        $product_id = $request->id;
        $seller_id = auth()->user()->id;
        $checkexpiredate=DB::table('seller_featured_subscription')->where(array('seller_id'=>$seller_id))->first();
        if(!empty($checkexpiredate))
        {
            $end_date = $checkexpiredate->end_date;
        }
        $countfeaturedproduct=DB::table('products')->where(array('user_id'=>$seller_id,'is_featured'=>1))->get()->count();
        if($countfeaturedproduct<=4 && $end_date >= $currentDate)
        {
            if($product_id!="")
            {
                $updateData=array(
                'is_featured'=>$is_featured,
                'updated_at'=>date('Y-m-d H:i:s')
                );
                DB::table('products')->where('id',$product_id)->update($updateData);
                
                $updateData=array(
                'status'=>$is_featured
                );
                DB::table('subscribe_products')->where('id',$product_id)->update($updateData);
                
                $addData = array(
                'user_id'=>$seller_id,
                'product_id'=>$product_id,
                'duration'=>15,
                'created_at'=>date('Y-m-d'),
                'status'=>$is_featured
                );
                DB::table('subscribe_products')->insert($addData);
                return back()->with('success','Successfully updated product');
            }
        }
        elseif($is_featured==0)
        {
            if($product_id!="")
            {
                $updateData=array(
                'is_featured'=>$is_featured,
                'updated_at'=>date('Y-m-d H:i:s')
                );
                DB::table('products')->where('id',$product_id)->update($updateData);
                
                $updateData=array(
                'status'=>$is_featured
                );
                DB::table('subscribe_products')->where('id',$product_id)->update($updateData);
                
                $addData = array(
                'user_id'=>$seller_id,
                'product_id'=>$product_id,
                'duration'=>15,
                'created_at'=>date('Y-m-d'),
                'status'=>$is_featured
                );
                DB::table('subscribe_products')->insert($addData);
                return back()->with('success','Successfully updated product');
            }
        }
        else
        {
            $currentURL = 'https://development-review.net/emporium/seller/manageproduct';//die;
            echo "<script>alert('You reached your limit')</script>";
            echo "<script>window.location.href='".$currentURL."'</script>";
            exit;
        }
    }

    function editproduct(Request $req, $id)
    {
        $zipcode = array();
        $createdby=auth()->user()->id;  
        if($req->isMethod('post'))
        {
            $updateData=array(
                //'product_code'=>$req->input('product_code'),
                'zipcode' => implode(",",(array)$req->input('zipcode')),
                'catid'=>$req->input('catid'),
                'subcat_id'=>$req->input('subcat_id'),
                'name'=>$req->input('name'),
                'quantity'=>$req->input('quantity'),
                'price'=>$req->input('price'),
                'discount'=>$req->input('discount'),
                'discount_code_id'=>$req->input('discount_code_id'),
                'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('name')))),
                'user_id'=>$createdby,
                'short_desc'=>$req->input('short_desc'),
                'description'=>$req->input('description'),
                'meta_title'=>$req->input('meta_title'),
                'meta_keyword'=>$req->input('meta_keyword'),
                'meta_description'=>$req->input('meta_description'),
                'updated_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            
            if($req->hasFile('proimage'))
            {   
                $time=time();
                $file=$req->hasFile('proimage');
                $updateData['image']=$time.'_'.$req->proimage->getClientOriginalName();
                $imagename=$time.'_'.$req->proimage->getClientOriginalName();
                $req->proimage->move(public_path('products/'),$imagename);
            }
            $vcount = count($_REQUEST['var']);

            $var_count = 0;
            //echo $vcount;die;
            //echo "<pre>";
            //print_r($_REQUEST['var']);die;
            foreach ($_REQUEST['var'] as $key=>$varArr) {
                $var_count++;
                $serialize_data = serialize($varArr);
                

                $variantone = isset($varArr['variant_id'])?$varArr['variant_id']:"";
                //check variant id exist or not

                $pd=DB::table('product_detail')->where('product_id',$id)->get();
                $new_pd = array();
                foreach ($pd as $pdvalue) {
                    $new_pd[] = $pdvalue->id;
                }
                /*echo "<pre>";
                print_r($new_pd);
                echo "</pre>";die;*/
                //get exisitng variant id in new_pd

                if(in_array($variantone,$new_pd))
                {
                    //print_r($req->file('product_image'));die;
                    $affected = DB::table('product_detail')->where('id', $variantone)->update(['spec_detail' => $serialize_data]);

                    if($req->has('product_image')) {
                    $time=time();
                    if(isset($req->file('product_image')[$var_count]))
                    {
                    $imageArr = $req->file('product_image')[$var_count];
                    foreach ($imageArr as $image) {
                    $name = $time.'_'.$image->getClientOriginalName();
                    $aa = $image;
                    $aa->move(public_path('/product_image'), $name);
                        $data[] = $name;
                        DB::table('additional')->insert(
                        array(
                            'option_id' => $_REQUEST['var'][$var_count]['variant_id'],
                            'product_id'     =>   $id, 
                            'product_image'   =>   $name
                        )
                        );
                    }
                    }
                    }
                }
                else{
                    DB::table('product_detail')->insert(
                    array(
                        'product_id'     =>   $id, 
                        'spec_detail'   =>   $serialize_data,
                        'created_at'=>date('Y-m-d H:i:s')
                )
                );
                $variantid = DB::getPdo()->lastInsertId();
                if($req->has('product_image')) {
                $time=time();
                $imageArr = $req->file('product_image')[$vcount];
                foreach ($imageArr as $image) {
                $name = $time.'_'.$image->getClientOriginalName();
                $aa = $image;
                $aa->move(public_path('/product_image'), $name);
                    $data[] = $name;
                    DB::table('additional')->insert(
                    array(
                        'option_id' => $variantid,
                        'product_id'     =>   $id, 
                        'product_image'   =>   $name
                    )
                    );
                }
                }
                }
            }//die;
            DB::table('products')->where('id',$id)->update($updateData);
            return back()->with('success','Successfully updated product');
        }
        $productdetail=DB::table('products')->where('id',$id)->first();
        $cate=DB::table('category')->orderBy('id','desc')->get();
        $subcate=DB::table('sub_category')->orderBy('id','desc')->get();
        $variantdetail=DB::table('product_detail')->orderBy('id','desc')->get();
        $additionaldetail=DB::table('additional')->orderBy('id','desc')->get();
        $postal_code=DB::table('postal_code')->orderBy('id','desc')->get();
        return view('seller/product/edit_product',['productdetail'=>$productdetail,'cate'=>$cate,'subcate'=>$subcate,'postal_code'=>$postal_code]);
    }

    // user list
    function manageusers()
    {
        $users=DB::table('userregister')->where('status',1)->orderBy('id','desc')->get();
        return view('seller/userlist/manage_user',['users'=>$users]);
    }
    // order list
    /*function manageorder()
    {
        $order=DB::table('order_history')->where('usertype','site')->orderBy('id','desc')->get();
        $buyerorder=DB::table('order_history')->where('usertype','buyer')->orderBy('id','desc')->get();

        return view('seller/order/manageorder',['order'=>$order,'buyerorder'=>$buyerorder]);
    }*/
    /*function orderdetails($orderid)
    {
        //return $orderid;
        $orderdetail=DB::table('order_history')->where('orderid',$orderid)->get();
        //return $orderdetail;
        return view('seller/order/orderdetail',['orderdetail'=>$orderdetail]);
    }*/
    
    // order list
   function manageorder(Request $request)
   {       
       $user_id =  auth()->user()->id;
       
            $orders = DB::table('orders')->select('*','users.name as bname','products.name as pname','orders.id as ouid','orders.track_id as track_id','users.u_id as buid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity','products.image as pimage')->join('order_detail','orders.id','order_detail.order_id')->join('products','products.id','order_detail.product_id')->join('users','users.id','orders.buyer_id')->where("order_detail.seller_id",$user_id)->where([
                [function ($query) use ($request){
                    if($request->filled('order_status')){
                       
                        $query->Where('orders.status', $request->order_status);
                    }
        
                    if($request->filled('date')){
        
                        // dd($request);
                        $query->orWhere('orders.created_at', 'like', '%' . $request->date . '%');
                        
                    }
                    if($request->filled('search')){
                    
                        $query->orWhere('orders.oid', 'like', '%' . $request->search . '%');
                        
                        $query->orWhere('products.name', 'like', '%' . $request->search . '%');
                        $query->orWhere('products.product_code', 'like', '%' . $request->search . '%');
                        $query->orWhere('users.name', 'like', '%' . $request->search . '%');
                        $query->orWhere('order_detail.quantity', 'like', '%' . $request->search . '%');
                        $query->orWhere('orders.totalamount', 'like', '%' . $request->search . '%');   
                    }
                    
                }]
            ])->orderBy("orders.id","desc")->paginate(10);

        return view('seller/order/manageorder',['orders'=>$orders]);
    }
    
    function updateOrderStatus(Request $req){
        
        DB::table('orders')->where("id",$req->order_id)->update(["status"=>$req->status]);
    }
    
    
    function orderDetails($orderid)
    {
        $orderdetail = DB::table('order_detail')->select('*','users.name as bname','addresses.address as baddress','products.name as pname','orders.oid as ouid','orders.uid as buid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity')->join('orders','orders.id','order_detail.order_id')->join('users','users.id','orders.buyer_id')->join('products','products.id','order_detail.product_id')->join('buyers','buyers.uid','orders.uid')->join('sellers','sellers.user_id','order_detail.seller_id')->join('product_detail','product_detail.id','order_detail.variant_id')->join('addresses','addresses.id','orders.address_id')->Where('orders.id', $orderid)->first();

$orders = DB::table('order_detail')->select('*','users.name as bname','addresses.address as baddress','products.name as pname','orders.oid as ouid','orders.uid as buid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity')->join('orders','orders.id','order_detail.order_id')->join('users','users.id','orders.buyer_id')->join('products','products.id','order_detail.product_id')->join('buyers','buyers.uid','orders.uid')->join('sellers','sellers.user_id','order_detail.seller_id')->join('product_detail','product_detail.id','order_detail.variant_id')->join('addresses','addresses.id','orders.address_id')->Where('orders.id', $orderid)->get();


        return view('seller/order/orderdetail',['orderdetail'=>$orderdetail],['orders'=>$orders]);
    }
    // send porting code
    /*function sendportingcode(Request $req)
    {
        $this->sendto=strtolower($req->sendto);
        $prodnumber=$req->prodnumber;
        $portingcode=$req->portingcode;
        $dataset=array('prodnumber'=>$prodnumber,'portingcode'=>$portingcode);
        $res=  Mail::send('seller/mailer/porting',$data =
                [
                'dataset'=>$dataset 
                ],
                function($message){
                $message->from('djsaluja18@gmail.com','Log Zero Technologies');
                $message->to($this->sendto,'Porting Code');
                $message->subject('Porting Code');
            });
            DB::table('order_history')->where(array('productname'=>$prodnumber))->update(array('porting_status'=>1));
            return back()->with('success','Successfully send porting code');
            
    }*/

   function importcsvproduct(Request $req)
    {
        $path = $req->file('importcsv')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $i=0;
        foreach($data as $alldata)
        {   
            if($i!=0)
            {            
                $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $shuffle_str = str_shuffle($random_str);
                $scode = substr($shuffle_str,0,6);
                $product_name=$alldata[0];
                $product_slug=$alldata[1];
                $product_image=$alldata[2];
                $product_catid=$alldata[3];
                $product_subcatid=$alldata[4];
                $product_price=$alldata[5];
                $product_quantity=$alldata[6];
                $product_short_desc=$alldata[7];
                $product_description=$alldata[8];
                $user_id = auth()->user()->id;
                $featured_product=$alldata[10];
                $auction_product=$alldata[11];
                $active_product=$alldata[12];
                $subscribed_product=$alldata[13];
                $discount_product=$alldata[14];
                $meta_title=$alldata[15];
                $meta_keyword=$alldata[16];
                $meta_description=$alldata[17];
                $status=$alldata[18];
                $product_code=$scode;
                $createdby=0;
                $created_at=date('Y-m-d H:i:s');
                $spec_detail=$alldata[19];
                $varients_imgs=$alldata[20];
                DB::table('products')
                ->updateOrInsert(
                    ['name' => $product_name],
                    ['slug' => $product_slug, 'image' => $product_image,'catid'=>$product_catid,'subcat_id'=>$product_subcatid,'price'=>$product_price,'quantity'=>$product_quantity,'short_desc'=>$product_short_desc,'description'=>$product_description,'user_id'=>$user_id,'is_featured'=>$featured_product,'is_auction'=>$auction_product,'is_active'=>$active_product,'is_subscribed'=>$subscribed_product,'discount'=>$discount_product,'meta_title'=>$meta_title,'meta_keyword'=>$meta_keyword,'meta_description'=>$meta_description,'status'=>1,'created_at'=>$created_at,'product_code'=>$product_code]
                );
                $id = DB::getPdo()->lastInsertId();

// Making Specification array proper to serialize the data

$varients_arr = explode("|",$spec_detail);
$varient_img_arr = explode("|",$varients_imgs);
foreach($varients_arr as $mainkey=>$varient){

$specs = array();
$specs_arr = explode(",",$varient);
foreach($specs_arr as $key=>$specs_a){
$spec_arr = explode(":",$specs_a);
$specs[$spec_arr[0]] = $spec_arr[1];
}
    
    
DB::table('product_detail')->insert(
array(
'product_id'     =>   $id, 
'spec_detail'   =>   serialize($specs),
'created_at'=>date('Y-m-d H:i:s')
)
);
$variantid = DB::getPdo()->lastInsertId();

// Inserting Images per Varient
$varient_imgs = explode(",",$varient_img_arr[$mainkey]);

foreach($varient_imgs as $varient_img){

    DB::table('additional')->insert(
        array(
        'option_id' => $variantid,
        'product_id'     =>   $id, 
        'product_image'   =>   $varient_img
        )
        );

}
}
       
              }
            $i++;
        }
        return back()->with('success','Successfully uploaded data');
    }
    function importcsvpostal(Request $req){
        $path = $req->file('importcsv')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $i=0;
        foreach($data as $alldata)
        {   
            if($i!=0)
            {
                /*$zipcode=$alldata[0];
                $name=$alldata[1];
                $cost=$alldata[2];
                $seller_id=auth()->user()->id;
                DB::table('postal_code')
                ->Insert(
                    ['zipcode' => $zipcode],
                    ['name' => $name, 'cost' => $cost,'seller_id'=>$seller_id]
                );*/
                $addData=array(
                'zipcode'=>$alldata[0],
                'name'=>$alldata[1],
                'cost'=>$alldata[2],
                'seller_id'=>auth()->user()->id
                );
                DB::table('postal_code')->updateOrInsert($addData);
                $id = DB::getPdo()->lastInsertId();
            }
            $i++;
        }
        return back()->with('success','Successfully uploaded data');
    }
    public function downloadFile()
    {
        $myFile = public_path("download/Import-product-sample-file.csv");
        return response()->download($myFile);
    }
     function managebuyerorder()
    {
        $order=DB::table('order_history')->where('usertype','site')->orderBy('id','desc')->get();
        $buyerorder=DB::table('order_history')->where('usertype','buyer')->orderBy('id','desc')->get();
        return view('seller/order/managebuyerorder',['order'=>$order,'buyerorder'=>$buyerorder]);
    }
    
     function managebuyer()
    {
        $vendor=DB::table('users')->where('user_type','2')->whereIn('status',array(1,2))->orderBy('id','desc')->get();
        $buyer=DB::table('users')->where('user_type','3')->whereIn('status',array(1,2))->orderBy('id','desc')->get();
        return view('seller/vendor/managebuyer',['vendor'=>$vendor,'buyer'=>$buyer]);
    }
    
     function deleteuser($id)
    {
        //return $id;
        DB::table('userregister')->where('id',$id)->update(array('status'=>0));
        return back();
    }

    function inactiveproduct($id)
    {
        DB::table('products')->where('id',$id)->update(array('status'=>0));
        return back();
    }
    function activeproduct($id)
    {
        DB::table('products')->where('id',$id)->update(array('status'=>1));
        return back();
    }
    
    function vendor_buyer_details($id)
    {
    $vendordetail=DB::table('users')->where(array('id'=>$id))->first();
    return view('seller/vendor/vendordetails',['vendordetail'=>$vendordetail]);
    }

    function deleteproduct($id)
    {
        DB::table('products')->where('id',$id)->update(array('status'=>0));
        return back();
    }

    function vendorregister(Request $req)
    {
        if($req->isMethod('post'))
        {
            // return $req->all();
            $this->validate($req,
            [
            'email'=>'unique:users,email',
            'password' => 'required',
            'confirmpass'=>'required_with:password|same:password'

            ],
            [
                'email.unique'=>'Already exist email',
                'confirmpass.same'=>'Confirm password mismatch'
            ]);
            $addData=array(
                'name'=>$req->name,
                'email'=>strtolower($req->email),
                'phone'=>$req->phone,
                'password'=>md5($req->password),
                'confirmpass'=>$req->confirmpass,
                'storename'=>$req->storename,
                'storeslug'=>Str::slug($req->storename,'-'),
                'address'=>$req->address,
                'user_type'=>$req->user_type,
                'created_date'=>date('Y-m-d H:i:s'),
                'status'=>1
            );

            if($req->hasFile('adharcarimg'))
            {   
                $time=time();
                $file=$req->hasFile('adharcarimg');
               $addData['adharcarimg']=$time.'_'.$req->adharcarimg->getClientOriginalName();
                $this->upload_image($req->adharcarimg,$time);
            }
            if($req->hasFile('pancardimg'))
            {   
                $time=time();
                $file=$req->hasFile('pancardimg');
                $addData['pancardimg']=$time.'_'.$req->pancardimg->getClientOriginalName();
                $this->upload_image($req->pancardimg,$time);
            }
            if($lastid=DB::table('users')->insertGetId($addData))
            {
                // return back()->with('success','Successfully created your vendor acoount');
                $this->send_add_message($lastid);
            }
            else
            {
                return back()->with('error','Unable to register. Please try again');
            }
            
        }
    } 

    function upload_catimage($file,$time)
    {
        $imagename=$time.'_'.$file->getClientOriginalName();
        $file->move(public_path('category/'),$imagename);
    }

    function upload_image($file,$time)
    {
        $imagename=$time.'_'.$file->getClientOriginalName();
        $file->move(public_path('vendor/'),$imagename);
    }

    function send_add_message($id)
    {
        $vendordetail=DB::table('users')->where(array('id'=>$id))->first();
            $this->name=$vendordetail->name;
            $res=  Mail::send('seller/mailer/approvevendor',$data =
            [
            'vendordetail'=>$vendordetail 
            ],function($message){
                // return $data;
                $message->from('djsaluja18@gmail.com','Log Zero Technologies');
                $message->to('dheeraj.saluja@logzerotechnologies.com',$this->name);
                $message->subject('Approval Notification');
            });  
            // DB::table('users')->where('id',$id)->update(array('status'=>1));
            
            return back()->with('success','Successfully send approval details');
    }

    function dailysale()
    {
        $dt=date('Y-m-d');
        // $dailysale=DB::table('order_history')->where(array('created_date'=>$dt))->get();
        //   return $dailysale=DB::table('order_history')->get()->groupBy('vendor_id');
           $dailysale=DB::table('order_history')
                 ->select('vendor_id', DB::raw('count(*) as total'))
                 ->groupBy('vendor_id')
                 ->get();
        return view('seller/vendor/dailysale',['dailysale'=>$dailysale]);
    }

    function dailybuy()
    {
        $dt=date('Y-m-d');
        // $dailysale=DB::table('order_history')->where(array('created_date'=>$dt))->get();
        //   return $dailysale=DB::table('order_history')->get()->groupBy('vendor_id');
           $dailysale=DB::table('order_history')
                ->where('usertype','buyer')
                 ->select('user_id', DB::raw('count(*) as total'))
                 ->groupBy('user_id')
                 ->get();
        return view('seller/vendor/dailybuy',['dailysale'=>$dailysale]);
    }

    function addfaq(Request $req)
    {
        $seller_id=auth()->user()->id;
        if($req->isMethod('post'))
        { 
            $this->validate($req,
            [
            'question'=>'unique:faq,question'
            ],
            [
                'question.unique'=>'This question Already Exist'
            ]);
            $addData=array(
                'seller_id'=>$seller_id,
                'product_id'=>$req->input('product_id'),
                'question'=>$req->input('question'),
                'answer'=>$req->input('answer'),
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            DB::table('faq')->insert($addData);
            return back()->with('success','Successfully added faq');
        }
        return view('seller/faq/add_faq');
    }
    function editfaq(Request $req, $id)
    {
        $seller_id=auth()->user()->id;
        if($req->isMethod('post'))
        {
            $updateData=array(
                'product_id'=>$req->input('product_id'),
                'question'=>$req->input('question'),
                'answer'=>$req->input('answer'),
                'updated_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            DB::table('faq')->where('id',$id)->update($updateData);
            return back()->with('success','Successfully updated faq');
        }
        $faqdetail=DB::table('faq')->where('id',$id)->first();
        $products=DB::table('products')->where('user_id',$seller_id)->orderBy('id','desc')->get();
        return view('seller/faq/edit_faq',['faqdetail'=>$faqdetail,'products'=>$products]);
    }
    function managefaq(Request $request)
    {
        $seller_id = auth()->user()->id;
        $faq = DB::table('faq')->where('seller_id',$seller_id)->orderBy("id","desc")->paginate(10);
        //$subcate=DB::table('sub_category')->orderBy('id','desc')->get();
        return view('seller/faq/manage_faq',['faq'=>$faq]);
    }

    function deletefaq($id)
    {
        DB::table('faq')->where('id',$id)->update(array('status'=>0));
        return back();
    }
    function inactivefaq($id)
    {
        DB::table('faq')->where('id',$id)->update(array('status'=>0));
        return back();
    }
    function activefaq($id)
    {
        DB::table('faq')->where('id',$id)->update(array('status'=>1));
        return back();
    }
    function addauction(Request $req)
    {
        $createdby=auth()->user()->id;

        if($req->isMethod('post'))
        {
            $this->validate($req,
            [
            'product_id'=>'unique:auctions,product_id'
            ],
            [
                'product_id.unique'=>'This Product already exist under auction'
            ]);
            $auction_time = strtotime($req->input('auction_time'));
            $new_date = date('Y-m-d H:i:s', $auction_time);  
            $addData=array(
                'catid'=>$req->input('catid'),
                'subcat_id'=>$req->input('subcat_id'),
                'product_id'=>$req->input('product_id'),
                'auction_time'=>date('Y-m-d H:i:s', $auction_time),
                'minimum_cost'=>$req->input('minimum_cost'),
                //'auto_close_bid'=>$close_bid,
                'user_id'=>$createdby,
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            DB::table('auctions')->insert($addData);
            $id = DB::getPdo()->lastInsertId();
            return back()->with('success','Successfully added auction');
        }
        $cate=DB::table('category')->orderBy('id','desc')->get();
        $subcate=DB::table('sub_category')->orderBy('id','desc')->get();
        $product=DB::table('products')->orderBy('id','desc')->get();
        return view('seller/auction/add_auction',['cate'=>$cate,'subcate'=>$subcate,'product'=>$product]);
    }
    function editauction(Request $req, $id)
    {
        $createdby=auth()->user()->id;  
        if($req->isMethod('post'))
        {
            $auction_time = strtotime($req->input('auction_time'));
            $new_date = date('Y-m-d H:i:s', $auction_time);  
            $updateData=array(
                'catid'=>$req->input('catid'),
                'subcat_id'=>$req->input('subcat_id'),
                'product_id'=>$req->input('product_id'),
                'auction_time'=>date('Y-m-d H:i:s', $auction_time),
                'minimum_cost'=>$req->input('minimum_cost'),
                //'auto_close_bid'=>$close_bid,
                'user_id'=>$createdby,
                'updated_at'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            DB::table('auctions')->where('id',$id)->update($updateData);
            return back()->with('success','Successfully updated auction');
        }
        $auctiondetail=DB::table('auctions')->where('id',$id)->first();
        $products=DB::table('products')->orderBy('id','desc')->get();
        $cate=DB::table('category')->orderBy('id','desc')->get();
        $subcate=DB::table('sub_category')->orderBy('id','desc')->get();
        return view('seller/auction/edit_auction',['auctiondetail'=>$auctiondetail,'products'=>$products,'cate'=>$cate,'subcate'=>$subcate]);
    }
    function manageauction(Request $request)
    {
        $user_id = auth()->user()->id;
        $auction = DB::table('auctions')->where([
            [function ($query) use ($request){
                if($term = $request->keyword){
                    $query->orWhere('minimum_cost', 'Like', '%'.$term.'%')->get();
                }
                elseif($dateres = $request->date){
                 $query->orWhere('auction_time', 'Like', '%'.$dateres.'%')->get();   
                }
                else
                {
                    $orderbycategoryid = "";
                    if(isset($_REQUEST['sortbycategoryid']) && $_REQUEST['sortbycategoryid']!="")
                    {
                        $sortbycategoryids = $request->sortbycategoryid;
                        $query->orWhere('catid', 'Like', '%'.$sortbycategoryids.'%')->get();
                    }
                }
            }]
        ])
        ->where('user_id',$user_id)->orderBy("id","desc")->paginate(10);
        $productdetail=DB::table('products')->orderBy('id','desc')->get();
        $cate=DB::table('category')->orderBy('id','desc')->get();
        $subcate=DB::table('sub_category')->orderBy('id','desc')->get();
        return view('seller/auction/manage_auction',['cate'=>$cate,'auction'=>$auction,'productdetail'=>$productdetail]);
    }
    function deleteauction($id)
    {
        DB::table('auctions')->where('id',$id)->update(array('status'=>0));
        return back();
    }
    function inactiveauction($id)
    {
        DB::table('auctions')->where('id',$id)->update(array('status'=>0));
        return back();
    }
    function activeauction($id)
    {
        DB::table('auctions')->where('id',$id)->update(array('status'=>1));
        return back();
    }
    function managesubscription()
    {
        $user_id = auth()->user()->id;
        return view('seller/subscription/manage_subscription',['user_id'=>$user_id]);
    }
    function managefeatureproductsubscription()
    {
        $user_id = auth()->user()->id;
        return view('seller/featuredsubscription/manage_featuredsubscription',['user_id'=>$user_id]);
    }
    function addfeaturedsubscription()
    {
        return view('/seller/featuredsubscription/subscribefeaturedproduct');
    }
    function stripethankyou(Request $req)
    {
        return view('/seller/featuredsubscription/stripethankyou');
    }
    function thankyou(Request $req)
    {
        $seller_id=auth()->user()->id;
        $PayerId = $_REQUEST['PayerID'];
        $payer_email = $_REQUEST['payer_email'];
        $first_name = $_REQUEST['first_name'];
        $payer_status = $_REQUEST['payer_status'];
        $last_name = $_REQUEST['last_name'];
        $address_name = $_REQUEST['address_name'];
        $address_street = $_REQUEST['address_street'];
        $address_city = $_REQUEST['address_city'];
        $address_country_code = $_REQUEST['address_country_code'];
        $residence_country = $_REQUEST['residence_country'];
        $txn_id = $_REQUEST['txn_id'];
        $mc_currency = $_REQUEST['mc_currency'];
        $mc_gross = $_REQUEST['mc_gross'];
        $protection_eligibility = $_REQUEST['protection_eligibility'];
        $payment_gross = $_REQUEST['payment_gross'];
        $payment_status = $_REQUEST['payment_status'];
        $pending_reason = $_REQUEST['pending_reason'];
        $payment_type = $_REQUEST['payment_type'];
        $handling_amount = $_REQUEST['handling_amount'];
        $shipping = $_REQUEST['shipping'];
        $quantity = $_REQUEST['quantity'];
        $txn_type = $_REQUEST['txn_type'];
        $payment_date = $_REQUEST['payment_date'];
        $custom = $_REQUEST['custom'];
        $notify_version = $_REQUEST['notify_version'];
        $verify_sign = $_REQUEST['verify_sign'];
        if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']!="")
        {
            $addData = array(
            'user_id'=>$seller_id,
            'PayerID'=>$PayerId,
            'payer_email'=>$payer_email,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'payer_status'=>$payer_status,
            'address_name'=>$address_name,
            'address_street'=>$address_street,
            'address_city'=>$address_city,
            'address_country_code'=>$address_country_code,
            'residence_country'=>$residence_country,
            'txn_id'=>$txn_id,
            'mc_currency'=>$mc_currency,
            'mc_gross'=>$mc_gross,
            'protection_eligibility'=>$protection_eligibility,
            'payment_gross'=>$payment_gross,
            'payment_status'=>$payment_status,
            'pending_reason'=>$pending_reason,
            'payment_type'=>$payment_type,
            'handling_amount'=>$handling_amount,
            'shipping'=>$shipping,
            'quantity'=>$quantity,
            'txn_type'=>$txn_type,
            'payment_date'=>$payment_date,
            'custom'=>$custom,
            'notify_version'=>$notify_version,
            'verify_sign'=>$verify_sign
            );
            DB::table('payment_response')->insert($addData);
            $random_str1 = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffle_str1 = str_shuffle($random_str1);
            $oid = "FEATUREDSUBSCRIPTION".substr($shuffle_str1,0,5);
            $updateData=array(
            'orderid'=>$oid,
            );
            DB::table('payment_response')->where(array('custom'=>$custom))->update($updateData);
        }
        else
        {
            $Msg = "Your Session Has Expired!";
        }
        return view('seller/featuredsubscription/thankyou');
    }
    
    function addsubscription()
    {
        return view('/seller/subscription/subscribenow');
    }
    
    function productRating($product_id){
        return view('/seller/product/product-rating',["product_id"=>$product_id]);
    }
     
     function updateTrackid(Request $request){
         
         $track_id = $request->track_id;
         $order_id = $request->order_id;
         
         DB::table('orders')->where('id',$order_id)->update(array('track_id'=>$track_id));
         return back();
         
         
     }
     
     function wallet(Request $request)
     {
         $user_id = auth()->user()->id;
          $transactions =DB::table('transaction_history')->where('user_id',$user_id)->where([
                [function ($query) use ($request){
                  
                    if(!empty($request->transaction_type)){
                    $query->orWhere('type', '=', $request->transaction_type);
                    
                    }
                    $current_date = date("Y-m-d");
                   $compare_date = $current_date.' - '.$current_date;
                    if(!empty($request->selected_date) && $request->selected_date != $compare_date){
                       $dates = explode(" - ",$request->selected_date);
                       if(empty($dates[0])){
                           $dates[1] = '';
                       }
                        $query->whereBetween('created_at', [$dates[0],$dates[1]]);
                        
                        
                    }
                    if($request->filled('search')){
                        $query->orWhere('amount', 'like', '%' . $request->search . '%');
                         $query->orWhere('transaction_id', 'like', '%' . $request->search . '%');
                        $query->orWhere('seller_amount', 'like', '%' . $request->search . '%');
                        $query->orWhere('status', 'like', '%' . $request->search . '%');   
                    }
                    
                }]
            ])->orderBy("id","desc")->paginate(200);
         return view('seller/wallet',["transactions"=>$transactions]);
     }
     
     
     
     public function Bids(Request $request,$auction_id){
     
        $bids = DB::table('biddings')->select('*', 'auctions.id as aid','biddings.id as bid_id','biddings.status as bstatus','auctions.created_at as acreated_at','biddings.created_at as bcreated_at','users.name as uname','products.name as pname')->join('users','users.id','biddings.user_id')->join('auctions', 'auctions.id', '=', 'biddings.auction_id')->join('products', 'biddings.product_id', '=', 'products.id')->where('biddings.auction_id',$auction_id)->where([
                [function ($query) use ($request){
                 
                    if($request->filled('keyword')){
                        $query->orWhere('users.u_id', 'like', '%' . $request->keyword . '%');
                         $query->orWhere('users.name', 'like', '%' . $request->keyword . '%');
                        $query->orWhere('biddings.bid', 'like', '%' . $request->keyword . '%');
                        $query->orWhere('biddings.created_at', 'like', '%' . $request->keyword . '%');   
                    }
                    if($request->filled('bid_status_filter')){
         $query->Where('biddings.status',$request->bid_status_filter);
                    }
                    if($request->filled('date')){
                          $query->orWhere('biddings.created_at', 'like', '%' . $request->date . '%');
                    }
                    
                }]
            ])->orderBy("biddings.id","desc")->paginate(20);
    
        
       
       
       return view('seller/auction/bids',["bids"=>$bids,"auction_id"=>$auction_id]);
     } 
     
     
    public function updateBidStatus(Request $request){
        
        $update_data = [
            'status' =>$request->status,
            ];
        if($request->status == 2){    
            $this->name = $request->username;
             $this->email = $request->email;
        $mail_data = [
            "product_name"=>$request->product_name,
            "bid"=>$request->bid_amount,
            "bid_date"=>$request->bid_date,
            "username"=>$request->username,
            ];    
            
        $res=  Mail::send('seller/mailer/bid-award-email',$data =
            [
            'mail_data'=>$mail_data, 
            ],function($message){
                $message->from('djsaluja18@gmail.com','Emporium');
                $message->to($this->email,$this->name);
                $message->subject('Bid Awarded');
            });
        }    
        
        DB::table('biddings')->where('id',$request->bid_id)->update($update_data);
    }
    function managecoupon(Request $request)
    {
        $seller_id = auth()->user()->id;
        $coupon = DB::table('coupons')->where('seller_id',$seller_id)->orderBy("id","desc")->paginate(10);
        return view('seller/coupon/manage_coupon',['coupon'=>$coupon]);
    }
}
