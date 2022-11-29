<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
// use App\commonmodel;
class SellerController extends Controller
{
    function index()
    {
    	return view('seller/index');
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
        $createdby=auth()->user()->id;
        $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shuffle_str = str_shuffle($random_str);
        $scode = substr($shuffle_str,0,6);
        if($req->isMethod('post'))
        {
            $this->validate($req,
            [
            'name'=>'unique:products,name'
            ],
            [
                'name.unique'=>'Product Name Already Exist'
            ]);
            $addData=array(
                'product_code'=>$scode,
                'catid'=>$req->input('catid'),
                'subcat_id'=>$req->input('subcat_id'),
                'name'=>$req->input('name'),
                'quantity'=>$req->input('quantity'),
                'price'=>$req->input('price'),
                'is_discount'=>$req->input('is_discount'),
                'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('name')))),
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
            DB::table('products')->insert($addData);
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
        return view('seller/product/add_product',['cate'=>$cate]);
        
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
        $specdata=DB::table('specifications')->where('cat_id',$parent_id)->get();
        if(!empty($specdata))
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
                        <select name="var[1][<?php echo $value->slug;?>]" data-attr="<?php echo $value->slug;?>" class="form-control">
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
        }
        if($parent_id!="5")
        {
        ?>
        <div class="row clearfix">
            <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                Color</label>
            <div class="col-8">
                
                <select name="var[1][colors]" data-attr="colors"class="form-control">
                    <option value="">--Select Color--</option>
                    <?php
                    $specs_id = 3;
                    $optiondata=DB::table('options')->where('specs_id',$specs_id)->get();
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
        ?>
        <div class="row clearfix">
        <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                Price</label>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">€</span>
                    </div>
                    <input type="text" data-attr="vprice" name="var[1][vprice]" class="form-control" placeholder="Price">
                </div>
            </div>
        </div>
        <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                Gallery Image</label>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group mb-3">
                    <!-- <input type="file" id="product_image" name="product_image[]" class="form-control" multiple> -->
                    <input type="file" data-attr="product_image" name="product_image[1][]" class="form-control" multiple>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <input type="button" value="Add More"  onClick="addRow()" />
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
        ->orderBy("id","desc")->paginate(10);
        $cate=DB::table('category')->orderBy('id','desc')->get();
        $subcate=DB::table('sub_category')->orderBy('id','desc')->get();
        return view('seller/product/manage_product',['product'=>$product,'cate'=>$cate]);
    }

    function editproduct(Request $req, $id)
    {
        $createdby=auth()->user()->id;  
        if($req->isMethod('post'))
        {
            $updateData=array(
                //'product_code'=>$req->input('product_code'),
                'catid'=>$req->input('catid'),
                'subcat_id'=>$req->input('subcat_id'),
                'name'=>$req->input('name'),
                'quantity'=>$req->input('quantity'),
                'price'=>$req->input('price'),
                'is_discount'=>$req->input('is_discount'),
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
        return view('seller/product/edit_product',['productdetail'=>$productdetail,'cate'=>$cate,'subcate'=>$subcate]);
    }

    // user list
    function manageusers()
    {
        $users=DB::table('userregister')->where('status',1)->orderBy('id','desc')->get();
        return view('seller/userlist/manage_user',['users'=>$users]);
    }
    // order list
    function manageorder()
    {
        $order=DB::table('order_history')->where('usertype','site')->orderBy('id','desc')->get();
        $buyerorder=DB::table('order_history')->where('usertype','buyer')->orderBy('id','desc')->get();

        return view('seller/order/manageorder',['order'=>$order,'buyerorder'=>$buyerorder]);
    }
    function orderdetails($orderid)
    {
        //return $orderid;
        $orderdetail=DB::table('order_history')->where('orderid',$orderid)->get();
        //return $orderdetail;
        return view('seller/order/orderdetail',['orderdetail'=>$orderdetail]);
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
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";die;*/
        foreach($data as $alldata)
        {   
            if($i!=0)
            {            
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
                $product_code=$alldata[19];
                $createdby=0;
                $created_at=date('Y-m-d H:i:s');
                DB::table('products')
                ->updateOrInsert(
                    ['name' => $product_name],
                    ['slug' => $product_slug, 'image' => $product_image,'catid'=>$product_catid,'subcat_id'=>$product_subcatid,'price'=>$product_price,'quantity'=>$product_quantity,'short_desc'=>$product_short_desc,'description'=>$product_description,'user_id'=>$user_id,'is_featured'=>$featured_product,'is_auction'=>$auction_product,'is_active'=>$active_product,'is_subscribed'=>$subscribed_product,'is_discount'=>$discount_product,'meta_title'=>$meta_title,'meta_keyword'=>$meta_keyword,'meta_description'=>$meta_description,'status'=>1,'created_at'=>$created_at,'product_code'=>$product_code]
                );
            }
            /*$id = DB::getPdo()->lastInsertId();
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
            }*/
            $i++;
        }
        return back()->with('success','Successfully uploaded data');
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
}