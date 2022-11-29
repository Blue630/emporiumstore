<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class FrontController extends Controller
{
    public function contactus(Request $req)
    {
        if($req->isMethod('post'))
        {
            $this->from=strtolower($req->input('email'));
            $dataset=array('name'=>$req->input('name'),
            'email'=>strtolower($req->input('email')),
            'phone'=>$req->input('phone'),
            'subject'=>$req->input('subject'),
            'message'=>$req->input('message'));
            $res=  Mail::send('front/sendmail/contact_email',$data =
            [
            'dataset'=>$dataset 
            ],function($message){
                // return $data;
                $message->from($this->from,'KEEP IN TOUCH');
                $message->to('djsaluja18@gmail.com','KEEP IN TOUCH');
                $message->subject('KEEP IN TOUCH');
            });
            //session()->flash('success','Successfully send your enquiry. Thank you.');
            //return redirect(url()->previous().'#contact'); 
            return back()->with('success','Successfully send your enquiry. Thank you.');        
        }
        //return view('/front/contact-us');
        $contact = DB::table('page_content')->where('page_id',2)->orderBy('id','asc')->get();
        return view('/front/contact-us',['contact'=>$contact]);
        //return back()->with('success','Successfully send your enquiry. Thank you.');
    }
    public function aboutus()
    {
        //return view('/front/about-us');
        $about = DB::table('pages')->where('page_name','About us')->orderBy('id','desc')->first();
        return view('/front/about-us',['about'=>$about]);
    }
    public function cookies()
    {
        return view('/front/cookies');
    }
    public function seller_login()
    {
        return view('/front/seller-login');
    }
    public function welcome_seller()
    {
        return view('/front/welcome-seller');
    }
    public function product_detail()
    {
        return view('/front/product-detail');
    }
    public function privacypolicy()
    {
        return view('/front/privacy-policy');
    }
    public function faq()
    {
        return view('/front/faq');
    }
    public function terms()
    {
        return view('/front/terms');
    }
    public function addaddress(Request $req)
    {
        if($req->isMethod('post'))
        {
        $addData=array(
         'user_id'=>$req->input('user_id'), 
         'address'=>$req->input('address'),
         'city'=>$req->input('city'),
         'pincode'=>$req->input('pincode'),
         'landmark'=>$req->input('landmark'),
         'street'=>$req->input('street'),
         'state'=>$req->input('state'),
         'alt_mobile_no'=>$req->input('alt_mobile_no'),
         'created_at'=>date('Y-m-d')
            ); 
        //DB::table('auctions')->insert($addData);
        DB::table('addresses')->insert($addData);
        return back()->with('success','Address added successfully'); 
        }
        return view('/front/add-address');
    }
    function editaddress(Request $req, $id)
    {
        if($req->isMethod('post'))
        {
            $updateDate=array(
                'user_id'=>$req->input('user_id'), 
                'address'=>$req->input('address'),
                'city'=>$req->input('city'),
                'pincode'=>$req->input('pincode'),
                'landmark'=>$req->input('landmark'),
                'street'=>$req->input('street'),
                'state'=>$req->input('state'),
                'alt_mobile_no'=>$req->input('alt_mobile_no'),
                'updated_at'=>date('Y-m-d')
            );
            DB::table('addresses')->where('id',$id)->update($updateDate);
            return back()->with('success','Successfully updated user address detail.');
        }       
        $addressdetail=DB::table('addresses')->where('id',$id)->first();
        return view('/front/add-address',['addressdetail'=>$addressdetail]);
    }
    public function registeration(Request $req)
    {
        $user_type = $req->input('user_type');
        if($user_type==3)
        {
            $buyer = 'BUYER';
            $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffle_str = str_shuffle($random_str);
            $u_id = $buyer.substr($shuffle_str,0,6);
            $is_admin = 2;
        }
        else
        {
            $seller = 'SELLER';
            $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffle_str = str_shuffle($random_str);
            $u_id = $seller.substr($shuffle_str,0,6);
            $is_admin = 3;
        }
        if($req->isMethod('post'))
        {
            $this->validate($req,
            [
            'email'=>'unique:users,email',
            'password' => 'required',
            //'cpassword'=>'required_with:password|same:password'
            ],
            [
                'email.unique'=>'Email Already Exist',
                //'cpassword.same'=>'Confirm password mismatch'
            ]);
        $password = $_REQUEST['password'];
        $newpassword = Hash::make($password);
        $addData=array(
         'u_id'=>$u_id,
         'showpassword'=>$password,
         'is_admin'=>$is_admin, 
         'user_type'=>$req->input('user_type'),
         'email'=>$req->input('email'),
         //'phone'=>$req->input('phone'),
         'password'=>$newpassword,
         //'cpassword'=>$req->input('cpassword'),
         'status'=>1,
         'created_at'=>date('Y-m-d')
            ); 
            //print_r($addData);die;
            $userid=DB:: table('users')->insertGetId($addData);
            //$userid=DB:: table('userregister')->insertGetId($addData);
            //return $userid;
            //return redirect('/create-ehr/'.$userid);
            //$this->emailverification($userid);
            return back()->with('success','Successfully created account'); 
        }
        return view('front/registeration');
    }
    function productdetail($slug){
        //return $slug;
        $product = DB::table('products')->where('slug',$slug)->first();
        $product_id[] = $product->id;
        $category_id = $product->catid;
        $subcategory_id = $product->subcat_id;
        $productdetail=DB::table('products')->where('id',$product_id)->first();
        $similarproduct = DB::table('products')->where(array('catid'=>$category_id,'status'=>1))->whereNotIn('id', $product_id)->get();
        $boughttogetherproduct = DB::table('products')->where(array('catid'=>$category_id,'subcat_id'=>$subcategory_id,'status'=>1))->get();
        $recentlyviewed = '';
        //$variantdetail=DB::table('product_detail')->where('product_id',$product_id)->get();       
        $user_session = session('logged_user');
        if(!empty($user_session)){
            $user_id = $user_session->id;
            $resultQury = DB::table('most_viewed_product')->where('product_id',$product->id)->where('user_id',$user_id)->first();
            $counter=0;
            if($resultQury){
                $counter = $resultQury->counter;
                $viewData=array('user_id'=>$user_id,'product_id'=>$product->id,'counter'=>$counter+1);
                DB:: table('most_viewed_product')->where('id',$resultQury->id)->update($viewData);
            }else{
                $viewData = array('user_id'=>$user_id,'product_id'=>$product->id,'counter'=>1);
                //print_r($viewData); exit;
                DB:: table('most_viewed_product')->insert($viewData);
            }
        }
        $user_session = session('logged_user');
        $recentlyViewedProducts = array();
        $mostViewedProducts = array();
        if(!empty($user_session))
        {
        $user_id = $user_session->id;
        $recentlyViewedProducts = DB::table('products')
                          ->select('products.*')
                          ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
                          ->where('most_viewed_product.status', 1)
                          ->where('most_viewed_product.user_id', $user_id)
                          ->orderBy('most_viewed_product.updated_at','desc')
                          ->get();
        }
        return view('front/product-detail',['recentlyViewedProducts'=>$recentlyViewedProducts,'boughttogetherproduct'=>$boughttogetherproduct,'similarproduct'=>$similarproduct,'productdetail'=>$productdetail]);
    }
    
    public function calculateVarient(Request $req)
    {    
    $resultQury = DB::table('product_detail')->where('product_id',$req->product_id)->where('spec_detail', 'like', '%'.$req->optionvalue.'%')->first();
    $pdata = unserialize($resultQury->spec_detail);
    return $pdata['vprice'];
    }
    public function addtocart(Request $req)
    {    
    $resultQury = DB::table('product_detail')->where('product_id',$req->product_id)->where('spec_detail', 'like', '%'.$req->optionvalue.'%')->first();
    $pdata = unserialize($resultQury->spec_detail);
    echo "<pre>";
    print_r($pdata);
    echo "</pre>";die;
    }
    // product by category
    function categoryproduct($slug)
    {
        if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="")
        {
            $orderby = "";
            if($_REQUEST['sortby'] == "lowtohigh")
            {
                $orderby = "asc";
            }
            if($_REQUEST['sortby'] == "hightolow")
            {
                $orderby = "desc";
            }
            $category = DB::table('category')->where('slug',$slug)->first();
            
            $categoryproduct = DB::table('products')->where(array('catid'=>$category->id,'status'=>1))->orderBy('price',$orderby)->paginate(12);
            $cate = DB::table('category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$category->id)->orderBy('id','desc')->get();
        }
        if(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
        {
            $orderby = "";
            if($_REQUEST['sortbyorder'] == "asc")
            {
                $orderby = "asc";   
            }
            if($_REQUEST['sortbyorder'] == "desc")
            {
                $orderby = "desc";   
            }
            $category = DB::table('category')->where('slug',$slug)->first();
            
            $categoryproduct = DB::table('products')->where(array('catid'=>$category->id,'status'=>1))->orderBy('id',$orderby)->paginate(12);
            $cate = DB::table('category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$category->id)->orderBy('id','desc')->get();
        }
        if(!empty($_REQUEST))
        {
            if(isset($_REQUEST['sortbyorder'])=='' && isset($_REQUEST['sortby'])=='')
            {
            $query = DB::table('product_detail');
            //dd($query);die;
            foreach ($_REQUEST as $key=>$val) 
            {
                foreach ($val as $k => $v) {
                //echo"<br>".$v;
                //$new[]= "spec_detail LIKE '%".$v."%'";
                if($v)
                {
                    $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
                }
                }
            }
            $result = $query->get();
            $addsubqry='';
            $newproduct_id='';
            foreach ($result as $productresult) {
                $productid[] = $productresult->product_id;
                $newproduct_id = implode(',', $productid);
            }
            $category = DB::table('category')->where('slug',$slug)->first();
            //echo $addsubqry .= " AND catid=$category->id AND id IN ($newproduct_id)";
            //echo "select * from products where status=1 $addsubqry";
            $newproductid = explode(',',$newproduct_id);
            $categoryproduct = DB::table('products')->where(array('status'=>1,'catid'=>$category->id))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(12);
            $cate = DB::table('category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$category->id)->orderBy('id','desc')->get();
        }
        }
        else
        {
            $category = DB::table('category')->where('slug',$slug)->first();
            $categoryproduct = DB::table('products')->where(array('catid'=>$category->id,'status'=>1))->orderBy('id','desc')->paginate(12);
            $cate = DB::table('category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$category->id)->orderBy('id','desc')->get();
        }
        return view('/front/category',['category'=>$category,'categoryproduct'=>$categoryproduct,'cate'=>$cate,'subcategory'=>$subcategory]);
    }
    function subcategoryproduct($slug)
    {
        if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="")
        {
            $orderby = "";
            if($_REQUEST['sortby'] == "lowtohigh")
            {
                $orderby = "asc";
            }
            if($_REQUEST['sortby'] == "hightolow")
            {
                $orderby = "desc";
            }
            $subcategories = DB::table('sub_category')->where('slug',$slug)->first();
            $cat_id = $subcategories->cat_id;
            $category = DB::table('category')->where('id',$cat_id)->first();
            $subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->orderBy('price',$orderby)->paginate(12);
            $subcate = DB::table('sub_category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$cat_id)->orderBy('id','desc')->get();
        }
        if(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
        {
            $orderby = "";
            if($_REQUEST['sortbyorder'] == "asc")
            {
                $orderby = "asc";   
            }
            if($_REQUEST['sortbyorder'] == "desc")
            {
                $orderby = "desc";   
            }
            $subcategories = DB::table('sub_category')->where('slug',$slug)->first();
            $cat_id = $subcategories->cat_id;
            $category = DB::table('category')->where('id',$cat_id)->first();
            $subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->orderBy('id',$orderby)->paginate(12);
            $subcate = DB::table('sub_category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$cat_id)->orderBy('id','desc')->get();
        }
        else if(!empty($_REQUEST))
        {
            $query = DB::table('product_detail');
            if(isset($_REQUEST['sortbyorder'])=='' && isset($_REQUEST['sortby'])=='')
            {
            foreach ($_REQUEST as $key=>$val) 
            {
                foreach ($val as $k => $v) 
                {
                    if($v)
                    {
                        $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
                    }
                }
            }
            $result = $query->get();
            $addsubqry='';
            $newproduct_id='';
            foreach($result as $productresult) 
            {
                $productid[] = $productresult->product_id;
                $newproduct_id = implode(',', $productid);
            }
            $subcategories = DB::table('sub_category')->where('slug',$slug)->first();
            $cat_id = $subcategories->cat_id;
            $category = DB::table('category')->where('id',$cat_id)->first();
            //echo $addsubqry .= " AND catid=$category->id AND id IN ($newproduct_id)";
            //echo "select * from products where status=1 $addsubqry";
            $newproductid = explode(',',$newproduct_id);
            $subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(12);
            $subcate = DB::table('sub_category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$cat_id)->orderBy('id','desc')->get();
            }
        }
        else
        {
            $subcategories = DB::table('sub_category')->where('slug',$slug)->first();
            $cat_id = $subcategories->cat_id;
            $category = DB::table('category')->where('id',$cat_id)->first();
            $subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->orderBy('id','desc')->paginate(12);
            $subcate = DB::table('sub_category')->orderBy('id','desc')->get();
            $subcategory = DB::table('sub_category')->where('cat_id',$cat_id)->orderBy('id','desc')->get();
        }
        return view('/front/subcategory',['subcategories'=>$subcategories,'subcategoryproduct'=>$subcategoryproduct,'subcate'=>$subcate,'category'=>$category,'subcategory'=>$subcategory]);
    }
    function addwishlist()
    {
        $user_session = session('logged_user');
        $user_id = $user_session->id;
        //echo $user_id = auth()->user()->id;//die;
        if(isset($_REQUEST['product_id']) && $_REQUEST['product_id']!="")
        {
            $product_id = $_REQUEST['product_id'];
            $query_chkdup = DB::table('wishlist')->where('product_id',$product_id)->where('user_id',$user_id)->get();
            $count = count($query_chkdup);
            //dd($query_chkdup);die;
            if($count>0)
            {
                echo $msg = "Product Already Present in your Wishlist!";
                //return back()->with('error','Product Already Present in your Wishlist!');
            }
            else
            {
                $addData=array(
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'addeddate'=>date('Y-m-d H:i:s'),
                'status'=>1
                );
                DB::table('wishlist')->insert($addData);
                echo $msg = "Product Successfully Added to Wishlist!";
                //return back()->with('success','Product Successfully Added to Wishlist!');
            }
        }
        else
        {
            echo $msg = "Product ID does not matched!";
            //return back()->with('error','Product ID dose not matched!');
        }
    }
    // filter product by price
    function filterproductprice($price)
    {
        $pricerang=explode('-',$price);
        $start=$pricerang[0];
        if($start==500000)
        {
          $end=0; 
        }
        else{ $end=$pricerang[1];}
        // $cat=DB::table('category')->where('cat_slug',$slug)->first();
        // return $cat->id;
        $filter;
        if($start==500000)
        {
            $filter=DB::table('products')->where('price', '>=',$start)->where('status',1)->orderBy('id','desc')->paginate(9); 
        }
        else{
        $filter=DB::table('products')->where('price', '>=',$start)->where('price','<=',$end)->where('status',1)->orderBy('id','desc')->paginate(9);
        }
        //return $filter;
        $cate=DB::table('category')->orderBy('id','desc')->get();
        return view('/front/products',['product'=>$filter,'cate'=>$cate]);
    }
    function emailverification($userid)
    {
        $user=DB::table('userregister')->where('id',$userid)->first();
        $this->to=strtolower($user->email);
        $dataset=array('id'=>$user->id);
        $res=  Mail::send('front/sendmail/regmail',$data =
        [
        'dataset'=>$dataset 
        ],function($message){
            // return $data;
            $message->from('djsaluja18@gmail.com','Log Zero Technologies');
            $message->to($this->to,'Email Vertification');
            $message->subject('Email Vertification');
        });
        return back()->with('success','Successfully Created account and send activation link on email'); 
    }
    function verifiedemail($id)
    {
        DB::table('userregister')->where('id',$id)->update(array('status'=>1));
        //return view('front/login');
        return redirect('/login')->with('success','Your email successfully verified.');
    }
    function search(Request $req)
    {
        // return $req->all();
        $searchdata=$req->searchdata;
        $product=DB::table('products')->where('status',1)->where('productnumber','LIKE', "%{$searchdata}%")->get();
        // return $product;
        return view('front/search',['product'=>$product]);
    }
    public function checkPinCode(Request $req){
        $product_id = $req->product_id;
        $zipcode = $req->pincode;
        $postalcode=DB::table('postal_code')->select('id')->where('zipcode',$zipcode)->first();
        //$postalcodecount = count($postalcode);
        if(!empty($postalcode))
        {
        $checkPinCode = DB::table('products')
                          ->select('id')
                          ->whereRaw('FIND_IN_SET('.$postalcode->id.',zipcode)')
                          ->where('id', $product_id)
                          ->get();
        echo $count = count($checkPinCode);
        }
        else{
            echo 0;
        }
        exit;
    }
}