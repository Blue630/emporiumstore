<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use SendinBlue;
use GuzzleHttp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;

class FrontController extends Controller
{
/*public function __construct()
{
    Session::flush();
}*/
function insertseller(){    
    $user_id  = $_REQUEST['user_id'];
    $user_data = DB::table('users')->where(array('id'=>$user_id))->first();
    $user_email = $user_data->email;
    $user_password = $user_data->password;
    $user_showpassword = $user_data->showpassword;
    $user_name = $user_data->name;
    $user_image = $user_data->image;
    $user_status = $user_data->status;
    $u_id = $user_data->u_id;
    
    $seller_data = DB::table('sellers')->where('user_id',$user_id)->get();
    $seller_data_count = count($seller_data);
    if($seller_data_count==0)
    {
        /*$seller = 'SELLER';
        $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shuffle_str = str_shuffle($random_str);
        $u_id = $seller.substr($shuffle_str,0,6);*/
        
        /*$addUserData=array(
            'u_id'=>$u_id,
            'name'=>$user_name,
            'image'=>$user_image,
            'email'=>$user_email,
            'password'=>$user_password,
            'showpassword'=>$user_showpassword,
            'user_type'=>2,
            'is_auction'=>0,
            'is_active'=>0,
            'wallet'=>0,
            'status'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>NULL,
            'google_id'=>NULL,
            'is_admin'=>3
        );
        DB::table('users')->insert($addUserData);
        $lastid = DB::getPdo()->lastInsertId();       */ 
        
        $addSellerData=array(
            'u_id'=>$u_id,
            'business_type'=>'Individual',
            'user_id'=>$user_id,
            'email'=>$user_email,
            'status'=>1,
            'created_at'=>date('Y-m-d H:i:s')
        );
        DB::table('sellers')->insert($addSellerData);
    }
    else
    {
        /*$addSellerData=array(
            'user_id'=>$user_id,
            'business_type'=>'Individual',
            'email'=>$user_email
        );
        DB::table('sellers')->insert($addSellerData);*/
    }
}
public function products()
{
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$products = DB::table('products')->where(array('status'=>1))->orderBy('price',$orderby)->paginate(52);
        $products = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$products = DB::table('products')->where(array('status'=>1))->orderBy('id',$orderby)->paginate(52);
        $products = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){   
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$products = DB::table('products')->where(array('status'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $products = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$products = DB::table('products')->where(array('status'=>1))->orderBy('id','desc')->paginate(52);
        $products = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
    }
    return view('/front/products',['products'=>$products,'category'=>$category,'subcategory'=>$subcategory]);
}

public function suggestedproducts()
{
    if(Auth::check())
    {
    //var_dump(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="");die;
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();

        //$user_session = session('logged_user');
        $recentlyViewedProducts = array();
        $mostViewedProducts = array();
        //if(!empty($user_session)){
        if(Auth::check())
        {
        $user_id = auth()->user()->id;
        //$user_id = $user_session->id;
        $recentlyViewedProducts = DB::table('products')
        ->select('products.*')
        ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
        ->join('users','users.id','=','products.user_id')
        ->where('most_viewed_product.status', 1)
        ->where('users.status', 1)
        ->where('most_viewed_product.user_id', $user_id)
        ->orderBy('most_viewed_product.updated_at','desc')->limit(10)->get();
        $mostViewedProducts = DB::table('products')
        ->select('products.*')
        ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
        ->join('users','users.id','=','products.user_id')
        ->where('most_viewed_product.status', 1)
        ->where('users.status', 1)
        ->where('most_viewed_product.user_id', $user_id)
        ->orderBy('most_viewed_product.id',$orderby)->paginate(52);
        }
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        
        
        //$user_session = session('logged_user');
        $recentlyViewedProducts = array();
        $mostViewedProducts = array();
        if(Auth::check())
        {
        $user_id = auth()->user()->id;
        $recentlyViewedProducts = DB::table('products')
        ->select('products.*')
        ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
        ->join('users','users.id','=','products.user_id')
        ->where('most_viewed_product.status', 1)
        ->where('users.status', 1)
        ->where('most_viewed_product.user_id', $user_id)
        ->orderBy('most_viewed_product.updated_at','desc')->limit(10)->get();
        $mostViewedProducts = DB::table('products')
        ->select('products.*')
        ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
        ->join('users','users.id','=','products.user_id')
        ->where('most_viewed_product.status', 1)
        ->where('users.status', 1)
        ->where('most_viewed_product.user_id', $user_id)
        ->orderBy('most_viewed_product.id',$orderby)->paginate(52);
        }
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){   
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        
        
        //$user_session = session('logged_user');
        $recentlyViewedProducts = array();
        $mostViewedProducts = array();
        if(Auth::check())
        {
        $user_id = auth()->user()->id;
        $recentlyViewedProducts = DB::table('products')
        ->select('products.*')
        ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
        ->join('users','users.id','=','products.user_id')
        ->where('most_viewed_product.status', 1)
        ->where('users.status', 1)
        ->where('most_viewed_product.user_id', $user_id)
        ->orderBy('most_viewed_product.updated_at','desc')->limit(10)->get();
        $mostViewedProducts = DB::table('products')
        ->select('products.*')
        ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
        ->join('users','users.id','=','products.user_id')
        ->where('most_viewed_product.status', 1)
        ->where('users.status', 1)
        ->where('most_viewed_product.user_id', $user_id)->whereIn('product_id', $newproductid)
        ->orderBy('most_viewed_product.counter','desc')->paginate(52);
        }
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        
        
        //$user_session = session('logged_user');
        $recentlyViewedProducts = array();
        $mostViewedProducts = array();
        if(Auth::check())
        {
        $user_id = auth()->user()->id;        
        $mostViewedProducts = DB::table('products')
        ->select('products.*')
        ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
        ->join('users','users.id','=','products.user_id')
        ->where('most_viewed_product.status', 1)
        ->where('users.status', 1)
        ->where('most_viewed_product.user_id', $user_id)
        ->orderBy('most_viewed_product.counter','desc')->paginate(52);
        }
    }
    return view('/front/suggested-products',['mostViewedProducts'=>$mostViewedProducts,'category'=>$category,'subcategory'=>$subcategory]);
    }
    else
    {
        return view('/front/login');
    }
}

    
public function categories(Request $req)
{
    //$categories = DB::table('category')->get();
    $categories = DB::table('category')->where(array('status'=>1))->orderBy('id','desc')->paginate(52);
    return view('/front/categories',['categories'=>$categories]);
}

public function seasonalproducts()
{
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$seasonalproducts = DB::table('products')->where(array('status'=>1,'season'=>1))->orderBy('price',$orderby)->paginate(52);
        $seasonalproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.season'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);

    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$seasonalproducts = DB::table('products')->where(array('status'=>1,'season'=>1))->orderBy('id',$orderby)->paginate(52);
        $seasonalproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.season'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$seasonalproducts = DB::table('products')->where(array('status'=>1,'season'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $seasonalproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.season'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$seasonalproducts = DB::table('products')->where(array('status'=>1,'season'=>1))->orderBy('id','desc')->paginate(52);
        $seasonalproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.season'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);   
    }
    return view('/front/seasonal-products',['seasonalproducts'=>$seasonalproducts,'category'=>$category,'subcategory'=>$subcategory]);
}

public function todaydeal()
{
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$todaydealproducts = DB::table('products')->where(array('status'=>1,'todaydeal'=>1))->orderBy('price',$orderby)->paginate(52);
        $todaydealproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.todaydeal'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$todaydealproducts = DB::table('products')->where(array('status'=>1,'todaydeal'=>1))->orderBy('id',$orderby)->paginate(52);
        $todaydealproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.todaydeal'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$todaydealproducts = DB::table('products')->where(array('status'=>1,'todaydeal'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $todaydealproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.todaydeal'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$todaydealproducts = DB::table('products')->where(array('status'=>1,'todaydeal'=>1))->orderBy('id','desc')->paginate(52);
        $todaydealproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.todaydeal'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
    }
    return view('/front/today-deal',['todaydealproducts'=>$todaydealproducts,'category'=>$category,'subcategory'=>$subcategory]);
}




public function trending()
{
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$trendingproducts = DB::table('products')->where(array('status'=>1,'trending'=>1))->orderBy('price',$orderby)->paginate(52);
        $trendingproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.trending'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$trendingproducts = DB::table('products')->where(array('status'=>1,'trending'=>1))->orderBy('id',$orderby)->paginate(52);
        $trendingproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.trending'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$trendingproducts = DB::table('products')->where(array('status'=>1,'trending'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $trendingproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.trending'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$trendingproducts = DB::table('products')->where(array('status'=>1,'trending'=>1))->orderBy('id','desc')->paginate(52);
        $trendingproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.trending'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
    }
    return view('/front/trending',['trendingproducts'=>$trendingproducts,'category'=>$category,'subcategory'=>$subcategory]);
}


    
public function featuredproduct()
{
    return view('/front/featured-products');
}
    
public function justlaunched()
{
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$justlaunchedproducts = DB::table('products')->where(array('status'=>1))->orderBy('price',$orderby)->paginate(52);
        $justlaunchedproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$justlaunchedproducts = DB::table('products')->where(array('status'=>1))->orderBy('id',$orderby)->paginate(52);
        $justlaunchedproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$justlaunchedproducts = DB::table('products')->where(array('status'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $justlaunchedproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$justlaunchedproducts = DB::table('products')->where(array('status'=>1))->orderBy('id','desc')->paginate(52);
        $justlaunchedproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
    }
    return view('/front/just-launched',['justlaunchedproducts'=>$justlaunchedproducts,'category'=>$category,'subcategory'=>$subcategory]);
}

public function weeklydeals(Request $req)
{
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$weeklydealsproduct = DB::table('products')->where(array('status'=>1,'weeklydeal'=>1))->orderBy('price',$orderby)->paginate(52);
        $weeklydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.weeklydeal'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$weeklydealsproduct = DB::table('products')->where(array('status'=>1,'weeklydeal'=>1))->orderBy('id',$orderby)->paginate(52);
        $weeklydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.weeklydeal'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$weeklydealsproduct = DB::table('products')->where(array('status'=>1,'weeklydeal'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $weeklydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.weeklydeal'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$weeklydealsproduct = DB::table('products')->where(array('status'=>1,'weeklydeal'=>1))->orderBy('id','desc')->paginate(52);
        $weeklydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.weeklydeal'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
    }
    return view('/front/weekly-deals',['weeklydealsproduct'=>$weeklydealsproduct,'category'=>$category,'subcategory'=>$subcategory]);
}
    
public function monthlydeals(Request $req)
{
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$monthlydealsproduct = DB::table('products')->where(array('status'=>1,'monthlydeal'=>1))->orderBy('price',$orderby)->paginate(52);
        $monthlydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.monthlydeal'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$monthlydealsproduct = DB::table('products')->where(array('status'=>1,'monthlydeal'=>1))->orderBy('id',$orderby)->paginate(52);
        $monthlydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.monthlydeal'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$monthlydealsproduct = DB::table('products')->where(array('status'=>1,'monthlydeal'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $monthlydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.monthlydeal'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$monthlydealsproduct = DB::table('products')->where(array('status'=>1,'monthlydeal'=>1))->orderBy('id','desc')->paginate(52);
        $monthlydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.monthlydeal'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    return view('/front/deal-of-the-month',['monthlydealsproduct'=>$monthlydealsproduct,'category'=>$category,'subcategory'=>$subcategory]);
}
    
public function bestsellerproduct($slug)
{
    $seller_data = DB::table('users')->where(array('u_id'=>$slug))->first();
    $seller_id = $seller_data->id;
    
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$bestsellerproduct = DB::table('products')->where(array('user_id'=>$seller_id,'status'=>1))->orderBy('price',$orderby)->paginate(52);
        $bestsellerproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.user_id'=>$seller_id,'products.status'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$bestsellerproduct = DB::table('products')->where(array('user_id'=>$seller_id,'status'=>1))->orderBy('id',$orderby)->paginate(52);
        $bestsellerproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.user_id'=>$seller_id,'products.status'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$bestsellerproduct = DB::table('products')->where(array('user_id'=>$seller_id,'status'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $bestsellerproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.user_id'=>$seller_id,'products.status'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        //$bestsellerproduct = DB::table('products')->where(array('user_id'=>$seller_id,'status'=>1))->orderBy('id','desc')->paginate(52);
        $bestsellerproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.user_id'=>$seller_id,'products.status'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
    }
    return view('/front/best-seller-product',['bestsellerproduct'=>$bestsellerproduct,'category'=>$category,'subcategory'=>$subcategory]);
}
public function toprated(Request $req)
{
    return view('/front/top-rated');
}
public function subscribeandsave(Request $req)
{
    return view('/front/subscribe-save');
}
public function bestsellers(Request $req)
{
    return view('/front/best-sellers');
}

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
            $message->to('support@emporiumstore.co.uk','KEEP IN TOUCH');
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
    if(Auth::check())
    {
    $user_id = auth()->user()->id;
    return view('/front/welcome-seller');
    }
    else
    {
    return view('/front/seller-login');
    }
}

public function myaccount()
{
    /*if(Session()->has('logged_user'))
    {*/
    if(Auth::check())
    {
        return view('/front/my-account');
    }
    else
    {
        return view('/front/login');
    }
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
public function emporiumterms()
{
    return view('/front/emporium-terms');
}

public function success(Request $req)
{
    //echo "<pre>";
    //print_r($_REQUEST);die;
    if(Auth::check())
    {
    $buyer_id = auth()->user()->id;
    //if(Session()->has('logged_user'))
    //{
    //$user_session = session('logged_user');
    //$buyer_id = $user_session->id;
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
        'user_id'=>$buyer_id,
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
        $payment_status = $_REQUEST['payment_status'];
        $custom = $_REQUEST['custom'];
        $updateData=array(
        'payment_status'=>$payment_status,
        );
        DB::table('orders')->where(array('transaction_id'=>$custom))->update($updateData);
        $order = DB::table('orders')->where(array('transaction_id'=>$custom))->first();
        $orderid = $order->id;
        $updateorderidData=array(
        'orderid'=>$orderid,
        );
        DB::table('payment_response')->where(array('custom'=>$custom))->update($updateorderidData);
        $order_id = $order->id;
        $buyer_id = $order->buyer_id;
        $user = DB::table('users')->where(array('id'=>$buyer_id))->first();
        $buyer_name = $user->name;
        $buyer_email = $user->email;
        /*$sellerids = array();
        $order_detail = DB::table('order_detail')->where(array('order_id'=>$orderid))->get();
        foreach ($order_detail as $order_detail_value) 
        {
            $order_seller_id = $order_detail_value->seller_id;
            if(!in_array($order_seller_id, $sellerids))
            {
            $sellerids[] = $order_seller_id;*/
                if($payment_status=='Success')
                {
                    $this->from=strtolower($buyer_email);
                    $dataset=array(
                        'email'=>strtolower($buyer_email),
                        //'sellerid'=>$order_seller_id
                    );
                    $res=  Mail::send('front/sendmail/ordermail',
                    $data =
                    [
                    'dataset'=>$dataset,
                    'orderid'=>$orderid,
                    //'sellerids'=>$sellerids
                    ],function($message){
                    //return $message;
                    $message->from('support@emporiumstore.co.uk','Order Success');
                    $message->to($this->from,'Order Success');
                    $message->subject('Order Success');
                    });
                }
            /*}
        }*/
    }
    else
    {
        $Msg = "Your Session Has Expired!";
    }
        return view('/front/success');
    }
}

function addmoney(){
    return view('/front/addmoney');
}

function stripewalletresponse(){
    return view('/front/stripewalletresponse');
}

function bidPayment(){
    return view('/front/bid-payment');
}


function bidPaymentResponse(Request $req)
{
    /*if(Session()->has('logged_user'))
    {
    $user_session = session('logged_user');*/
    if(Auth::check())
    {
    $buyer_id = auth()->user()->id;
    //$buyer_id = $user_session->id;
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
    
    $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shuffle_str = str_shuffle($random_str);
    $oid = "BID".substr($shuffle_str,0,10);
    if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']!="")
    {
        $addData = array(
        'user_id'=>$buyer_id,
        'orderid'=>$oid,
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
    }
    return view('/front/bid-payment-response');
    }
}





function walletresponse(Request $req)
{
    /*if(Session()->has('logged_user'))
    {
    $user_session = session('logged_user');
    $buyer_id = $user_session->id;*/
    if(Auth::check())
    {
    $buyer_id = auth()->user()->id;
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
    
    $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shuffle_str = str_shuffle($random_str);
    $oid = "BUYERWALLET".substr($shuffle_str,0,10);
    if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']!="")
    {
        $addData = array(
        'user_id'=>$buyer_id,
        'orderid'=>$oid,
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
    }
    return view('/front/walletresponse');
    }
}

public function websiteterms()
{
    return view('/front/website-terms');
}

public function coupon()
{
    /*if(Session()->has('logged_user'))
    {*/
    if(Auth::check())
    {
        $coupons = DB::table('coupons')->where('status',1)->get();
        return view('/front/coupon',['coupons'=>$coupons]);
    }
    else
    {
        return view('/front/login');
    }
}

public function addaddress(Request $req)
{
    if($req->isMethod('post'))
    {
    $addData=array(
     'user_id'=>$req->input('user_id'), 
     'address'=>$req->input('address'),
     'address2'=>$req->input('address2'),
     'country'=>$req->input('country'),
     'city'=>$req->input('city'),
     'pincode'=>$req->input('pincode'),
     'state'=>$req->input('state'),
     'phoneno'=>$req->input('phoneno'),
     'created_at'=>date('Y-m-d')
        ); 
    DB::table('addresses')->insert($addData);
    return back()->with('success','Address added successfully'); 
    }
    return view('/front/add-address');
}

function editaddress(Request $req, $id)
{
    if(Auth::check())
    {
    $user_id = auth()->user()->id;
    if($req->isMethod('post'))
    {
        $updateDate=array(
            'user_id'=>$req->input('user_id'), 
            'address'=>$req->input('address'),
            'address2'=>$req->input('address2'),
            'city'=>$req->input('city'),
            'country'=>$req->input('country'),
            'pincode'=>$req->input('pincode'),
            'state'=>$req->input('state'),
            'phoneno'=>$req->input('phoneno'),
            'updated_at'=>date('Y-m-d')
        );
        DB::table('addresses')->where('id',$id)->update($updateDate);
        return back()->with('success','Successfully updated user address detail.');
    }
    $addressdetail=DB::table('addresses')->where(array('id'=>$id,'user_id'=>$user_id))->first();
    return view('/front/add-address',['addressdetail'=>$addressdetail]);
    }
    else
    {
        return view('/front/login');
    }
}

public function registeration(Request $req)
{
    $user_type = $req->input('user_type');
    $last_inserted_user_id = DB::table('buyers')->orderBy('id', 'desc')->first();
    if($user_type==3)
    {
        $buyer = 'BUYER';
        // $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $shuffle_str = str_shuffle($random_str);
        // $u_id = $buyer.substr($shuffle_str,0,6);
        $name = $req->input('name'); 
        $is_admin = 2;
        /*$buyer_data = [
            "uid" =>$u_id,
            ];
        DB:: table('buyers')->insertGetId($buyer_data);*/
        if($req->isMethod('post'))
        {
            $this->validate($req,
            [
            'email'=>'unique:users,email',
            'password' => 'required',
            ],
            [
                'email.unique'=>'Email Already Exist',
            ]);
            $password = $_REQUEST['password'];
            $newpassword = Hash::make($password);
            $addData=array(
            'u_id'=>$buyer . $last_inserted_user_id->id,
            'showpassword'=>$password,
            'is_admin'=>$is_admin, 
            'user_type'=>$req->input('user_type'),
            'email'=>$req->input('email'),
            'name'=>$req->input('name'),
            'password'=>$newpassword,
            'status'=>1,
            'created_at'=>date('Y-m-d')
            );
            // $userid=DB::table('users')->insertGetId($addData);
            return view('front/buyer-otp',$addData);
            //return back()->with('success','Successfully created account');
        }
    }
    else
    {
        $seller = 'SELLER';
        // $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $shuffle_str = str_shuffle($random_str);
        // $u_id = $seller.substr($shuffle_str,0,6);
        $is_admin = 3;
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
            'u_id'=>$seller . $last_inserted_user_id->id,
            'showpassword'=>$password,
            'is_admin'=>$is_admin, 
            'name'=>$req->input('name'),
            'user_type'=>$req->input('user_type'),
            'email'=>$req->input('email'),
            //'phone'=>$req->input('phone'),
            'password'=>$newpassword,
            'status'=>2,
            'created_at'=>date('Y-m-d')
            ); 
            return view('front/enter-otp',$addData);
        }
    }
}

function buyerotpverification(Request $req)
{
    $u_id = $_REQUEST['u_id'];
    $is_admin = $_REQUEST['is_admin'];
    $user_type = $_REQUEST['user_type'];
    $password = $_REQUEST['password'];
    $show_password = $_REQUEST['showpassword'];
    $email = $_REQUEST['email'];
    $name = $_REQUEST['name'];
    $buyer_data = [
        "uid" =>$u_id,
        ];
    DB:: table('buyers')->insertGetId($buyer_data);
    $addData=array(
    'u_id'=>$u_id,
    'showpassword'=>$show_password,
    'is_admin'=>$is_admin, 
    'user_type'=>$user_type,
    'email'=>$email,
    'showpassword'=>$show_password,
    'password'=>$password,
    'name'=>$name,
    'status'=>1,
    'created_at'=>date('Y-m-d')
    );
    $userid=DB::table('users')->insertGetId($addData);
    require '/home/u825973534/domains/emporiumstore.co.uk/public_html/vendor/sb/vendor/autoload.php';

    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
        new GuzzleHttp\Client(),
        $config
    );
    $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
    $createContact['email'] = $email;
    $createContact['listIds'] = [1];
    $createContact->setUpdateEnabled(true);
    try {
        $result = $apiInstance->createContact($createContact);
        //print_r($result);
    } catch (Exception $e) {
            //print_r($e);
        echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
    }
    $address_data_user_id = [
        "user_id" =>$userid,
        "is_main_address"=>1
        ];
    $user_address_id=DB:: table('addresses')->insertGetId($address_data_user_id);
    //return back()->with('success','Successfully created account');
    return redirect('/login')->with('success', 'Successfully created account!');
}
function sendotp(Request $req)
{
    $verify_pto = $_REQUEST['verify_pto'];
    $this->from=strtolower($req->input('email'));
    $dataset=array('email'=>strtolower($req->input('email')));
    $res=  Mail::send('front/sendmail/regmail',$data =
    [
    'dataset'=>$dataset,
    'otp'=>$verify_pto
    ],function($message){
         //return $message;
        $message->from('info@emporiumstore.co.uk','Email Vertification');
        $message->to($this->from,'Email Vertification');
        $message->subject('Email Vertification');
    });
}

function otpverification(Request $req)
{
    $u_id = $_REQUEST['u_id'];
    $is_admin = $_REQUEST['is_admin'];
    $user_type = $_REQUEST['user_type'];
    $password = $_REQUEST['password'];
    $showpassword = $_REQUEST['showpassword'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $business_type = $_REQUEST['business_type'];
    
    $addData=array(
    'u_id'=>$u_id,
    'showpassword'=>$password,
    'is_admin'=>$is_admin, 
    'name'=>$name,
    'user_type'=>$user_type,
    'email'=>$email,
    'password'=>$password,
    'showpassword'=>$showpassword,
    'business_type'=>$business_type,
    );
    return view('front/more-about-your-seller',$addData);
}
function moreaboutyouseller(Request $req)
{
    $u_id = $_REQUEST['u_id'];
    $is_admin = $_REQUEST['is_admin'];
    $user_type = $_REQUEST['user_type'];
    $password = $_REQUEST['password'];
    $showpassword = $_REQUEST['showpassword'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $business_type = $_REQUEST['business_type'];
    
    $addData=array(
    'u_id'=>$u_id,
    'showpassword'=>$password,
    'is_admin'=>$is_admin, 
    'name'=>$name,
    'user_type'=>$user_type,
    'email'=>$email,
    'password'=>$password,
    'showpassword'=>$showpassword,
    'business_type'=>$business_type,
    );
    if($business_type=='Individual')
    {
        $addData['fname'] = $_REQUEST['fname'];
        $addData['mname'] = $_REQUEST['mname'];
        $addData['lname'] = $_REQUEST['lname'];
        $addData['mobile'] = $_REQUEST['mobile'];
        $addData['alt_mobile_no'] = $_REQUEST['alt_mobile_no'];
        $addData['pincode'] = $_REQUEST['pincode'];
        $addData['state'] = $_REQUEST['state'];
        $addData['address'] = $_REQUEST['address'];
        $addData['ind_agree'] = $_REQUEST['ind_agree'];
        $addData['u_id'] = $_REQUEST['u_id'];
    }
    elseif ($business_type=='Business') 
    {
        $addData['first_name'] = $_REQUEST['first_name'];
        $addData['last_name'] = $_REQUEST['last_name'];
        $addData['middle_name'] = $_REQUEST['middle_name'];
        $addData['reg_business_name'] = $_REQUEST['reg_business_name'];
        $addData['off_business_mobile'] = $_REQUEST['off_business_mobile'];
        $addData['vat_number'] = $_REQUEST['vat_number'];
        $addData['business_reg_num']  = $_REQUEST['business_reg_num'];
        $addData['business_address'] = $_REQUEST['business_address'];
        $addData['business_agree'] = $_REQUEST['business_agree'];               
        $addData['u_id'] = $_REQUEST['u_id'];               
    }
    return view('front/about-your-store',$addData);
}

function aboutyourstore(Request $req)
{
    $u_id = $_REQUEST['u_id'];
    $is_admin = $_REQUEST['is_admin'];
    $user_type = $_REQUEST['user_type'];
    $password = $_REQUEST['password'];
    $showpassword = $_REQUEST['showpassword'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $business_type = $_REQUEST['business_type'];
    $addData = array(
    'u_id'=>$u_id,
    'showpassword'=>$showpassword,
    'is_admin'=>$is_admin, 
    'name'=>$name,
    'user_type'=>$user_type,
    'email'=>$email,
    'password'=>$password,
    'status'=>1,
    'created_at'=>date('Y-m-d')
    );
    $userid=DB:: table('users')->insertGetId($addData);
    
    require '/home/u825973534/domains/emporiumstore.co.uk/public_html/vendor/sb/vendor/autoload.php';
    //require __DIR__ . '/../vendor/sb/vendor/autoload.php';
    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
        new GuzzleHttp\Client(),
        $config
    );
    $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
    $createContact['email'] = $email;
    $createContact['listIds'] = [1];
    $createContact->setUpdateEnabled(true);
    try {
        $result = $apiInstance->createContact($createContact);
        //print_r($result);
    } catch (Exception $e) {
            //print_r($e);
        echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
    }
    $user_id = DB::getPdo()->lastInsertId();        
    if($business_type=='Individual')
    {
        $u_id = $_REQUEST['u_id'];
        $storename = $_REQUEST['storename'];
        $product_category = $_REQUEST['product_category'];
        $arrange_product = implode(',', $_REQUEST['arrange_product']);
        $no_product_list = $_REQUEST['no_product_list'];
        $fname = $_REQUEST['fname'];
        $mname = $_REQUEST['mname'];
        $lname = $_REQUEST['lname'];
        $mobile = $_REQUEST['mobile'];
        $alt_mobile_no = $_REQUEST['alt_mobile_no'];
        $ind_agree = $_REQUEST['ind_agree'];
        $state = $_REQUEST['state'];
        $pincode = $_REQUEST['pincode'];
        $address = $_REQUEST['address'];
        $addsellerData = array(
        'storename'=>$storename,
        'product_category'=>$product_category,
        'arrange_product'=>$arrange_product,
        'no_product_list'=>$no_product_list,
        'u_id'=>$u_id,
        'user_id'=>$user_id,
        'business_type'=>$business_type,
        'email'=>$email,
        'first_name'=>$fname,
        'middle_name'=>$mname,
        'last_name'=>$lname,
        'mobile'=>$mobile,
        'alt_mobile_no'=>$alt_mobile_no,
        'ind_agree'=>$ind_agree,
        'state'=>$state,
        'pincode'=>$pincode,
        'address'=>$address,
        'status'=>1,
        'created_at'=>date('Y-m-d'),
        );
        $selleruserid=DB:: table('sellers')->insertGetId($addsellerData);
    }
    elseif ($business_type=='Business') 
    {
        $u_id = $_REQUEST['u_id'];
        $storename = $_REQUEST['storename'];
        $product_category = $_REQUEST['product_category'];
        $arrange_product = implode(',', $_REQUEST['arrange_product']);
        $no_product_list = $_REQUEST['no_product_list'];
        $reg_business_name = $_REQUEST['reg_business_name'];
        $off_business_mobile = $_REQUEST['off_business_mobile'];
        $vat_number = $_REQUEST['vat_number'];
        $business_reg_num = $_REQUEST['business_reg_num'];
        $business_address = $_REQUEST['business_address'];
        $first_name = $_REQUEST['first_name'];
        $middle_name = $_REQUEST['middle_name'];
        $last_name = $_REQUEST['last_name'];
        $business_agree = $_REQUEST['business_agree'];
        $addsellerData = array(
        'storename'=>$storename,
        'product_category'=>$product_category,
        'arrange_product'=>$arrange_product,
        'no_product_list'=>$no_product_list,
        'u_id'=>$u_id,
        'user_id'=>$user_id,
        'business_type'=>$business_type,
        'email'=>$email,
        'reg_business_name'=>$reg_business_name,
        'off_business_mobile'=>$off_business_mobile,
        'vat_number'=>$vat_number,
        'business_reg_num'=>$business_reg_num,
        'business_address'=>$business_address,
        'first_name'=>$first_name,
        'middle_name'=>$middle_name,
        'last_name'=>$last_name,
        'business_agree'=>$business_agree,
        'status'=>1,
        'created_at'=>date('Y-m-d'),
        );
        $selleruserid=DB:: table('sellers')->insertGetId($addsellerData);
    }
    //return back()->with('success','Successfully created account');
    return redirect('/login')->with('success', 'Successfully created account!');
}

public function newsletter(Request $req)
{
    $email = $_REQUEST['email'];
    require '/home/u825973534/domains/emporiumstore.co.uk/public_html/vendor/sb/vendor/autoload.php';

    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
        new GuzzleHttp\Client(),
        $config
    );
    $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
    $createContact['email'] = $email;
    $createContact['listIds'] = [1];
    $createContact->setUpdateEnabled(true);
    try {
        $result = $apiInstance->createContact($createContact);
        //print_r($result);
    } catch (Exception $e) {
            //print_r($e);
        echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
    }
    return redirect('/')->with('success', 'Successfully Subscribed!');
}

public function subscribealert(Request $req)
{
    $email = $_REQUEST['email'];
    require '/home/u825973534/domains/emporiumstore.co.uk/public_html/vendor/sb/vendor/autoload.php';

    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
        new GuzzleHttp\Client(),
        $config
    );
    $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
    $createContact['email'] = $email;
    $createContact['listIds'] = [1];
    $createContact->setUpdateEnabled(true);
    try {
        $result = $apiInstance->createContact($createContact);
        //print_r($result);
    } catch (Exception $e) {
            //print_r($e);
        echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
    }
    //return redirect('/')->with('success', 'Successfully Subscribed!');
    return back()->with('success','Successfully Subscribed!');
}
    
function productdetail($slug)
{
    //return $slug;
    $product = DB::table('products')->where('slug',$slug)->first();
    $product_id[] = $product->id;
    $category_id = $product->catid;
    $subcategory_id = $product->subcat_id;
    $productdetail=DB::table('products')->where('id',$product_id)->first();
    $similarproduct = DB::table('products')->where(array('catid'=>$category_id,'status'=>1))->whereNotIn('id', $product_id)->get();
    $boughttogetherproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.catid'=>$category_id,'products.subcat_id'=>$subcategory_id,'products.status'=>1,'users.status'=>1))->orderBy('products.id','desc')->get();
    $recentlyviewed = '';
    //$variantdetail=DB::table('product_detail')->where('product_id',$product_id)->get();       
    //$user_session = session('logged_user');
    if(Auth::check())
    {
    $user_id = auth()->user()->id;
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
    //$user_session = session('logged_user');
    $recentlyViewedProducts = array();
    $mostViewedProducts = array();
    if(Auth::check())
    {
    $user_id = auth()->user()->id;
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

public function fourzerofour(Request $req)
{
    return view('front/404');
}

public function calculateVarient(Request $req)
{
    $resultQury = DB::table('product_detail')->where('product_id',$req->product_id)->where('spec_detail', 'like', '%'.$req->optionvalue.'%')->first();
    $pdata = unserialize($resultQury->spec_detail);
    return $pdata['vprice'].'-'.$resultQury->id;
}

public function getvariantimage(Request $req)
{
    $currentURL = url('/');
    $product_id = $_REQUEST['product_id'];
    $variantId = $_REQUEST['variantId'];
    ?>
    <div class="big_image position-relative">
    <?php
    $resultQury = DB::table('additional')->where('product_id',$product_id)->where('option_id',$variantId)->first();
    ?>
    <img style="height:555px;object-fit: contain" src="<?php echo $currentURL;?>/public/product_image/<?php echo $resultQury->product_image?>" class="w-100" alt="dhj">
    
    <i data-feather="zoom-in"></i>
    </div>
    <div class="small_images row row-cols-lg-6 row-col-3 gx-2">
    <?php
    $b = 0;
    $resultQury = DB::table('additional')->where('product_id',$product_id)->where('option_id',$variantId)->get();
    foreach ($resultQury as $alladditional2) 
    {
    $b++;
    ?>
    <div class="col">
    <div class="smallimage_list" data-id="img<?php echo $b;?>" data-src="<?php echo $currentURL;?>/public/product_image/<?php echo $alladditional2->product_image?>">
    <img style="height:93px;" src="<?php echo $currentURL;?>/public/product_image/<?php echo $alladditional2->product_image?>" class="img-fluid" alt="">
    </div>
    </div>
    <?php
    }
    ?>
    </div>
    <div class="lightbox_gallery">
    <?php
    $c = 0;
    $resultQury = DB::table('additional')->where('product_id',$product_id)->where('option_id',$variantId)->get();
    foreach ($resultQury as $alladditional3) 
    {
    $c++;
    ?>
    <a href="<?php echo $currentURL;?>/public/product_image/<?php echo $alladditional3->product_image?>" data-id="img<?php echo $c;?>" data-lightbox="lightbox">&nbsp;</a>
    <?php
    }
    ?>
    </div>
    <?php
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
        //$categoryproduct = DB::table('products')->where(array('catid'=>$category->id,'status'=>1))->orderBy('price',$orderby)->paginate(52);

        $categoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.catid'=>$category->id,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);

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
        
        //$categoryproduct = DB::table('products')->where(array('catid'=>$category->id,'status'=>1))->orderBy('id',$orderby)->paginate(52);

        $categoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.catid'=>$category->id,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);

        $cate = DB::table('category')->orderBy('id','desc')->get();
        $subcategory = DB::table('sub_category')->where('cat_id',$category->id)->orderBy('id','desc')->get();
    }
    if(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        //dd($query);die;
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) {
            //echo"<br>".$v;
            //$new[]= "spec_detail LIKE '%".$v."%'";
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        //$categoryproduct = DB::table('products')->where(array('status'=>1,'catid'=>$category->id))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        
        $categoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.catid'=>$category->id,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);

        $cate = DB::table('category')->orderBy('id','desc')->get();
        $subcategory = DB::table('sub_category')->where('cat_id',$category->id)->orderBy('id','desc')->get();
    }
    }
    else
    {
        $category = DB::table('category')->where('slug',$slug)->first();
        $categoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.catid'=>$category->id,'products.status'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
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
        //$subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->orderBy('price',$orderby)->paginate(52);
        $subcategoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.catid'=>$cat_id,'products.subcat_id'=>$subcategories->id,'products.status'=>1,'users.status'=>1))->orderBy('products.price',$orderby)->paginate(52);
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
        //$subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->orderBy('id',$orderby)->paginate(52);
        $subcategoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.catid'=>$cat_id,'products.subcat_id'=>$subcategories->id,'products.status'=>1,'users.status'=>1))->orderBy('products.id',$orderby)->paginate(52);
        $subcate = DB::table('sub_category')->orderBy('id','desc')->get();
        $subcategory = DB::table('sub_category')->where('cat_id',$cat_id)->orderBy('id','desc')->get();
    }
    else if(!empty($_GET))
    {
        $query = DB::table('product_detail');
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
                if($v)
                {
                    $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
                }
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
        //$subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->whereIn('id', $newproductid)->orderBy('id','desc')->paginate(52);
        $subcategoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.catid'=>$cat_id,'products.subcat_id'=>$subcategories->id,'products.status'=>1,'users.status'=>1))->whereIn('products.id', $newproductid)->orderBy('products.id','desc')->paginate(52);
        $subcate = DB::table('sub_category')->orderBy('id','desc')->get();
        $subcategory = DB::table('sub_category')->where('cat_id',$cat_id)->orderBy('id','desc')->get();
        }
    }
    else
    {
        $subcategories = DB::table('sub_category')->where('slug',$slug)->first();
        $cat_id = $subcategories->cat_id;
        $category = DB::table('category')->where('id',$cat_id)->first();
        //$subcategoryproduct = DB::table('products')->where(array('catid'=>$cat_id,'subcat_id'=>$subcategories->id,'status'=>1))->orderBy('id','desc')->paginate(52);
        //DB::enableQueryLog();
        $subcategoryproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.catid'=>$cat_id,'products.subcat_id'=>$subcategories->id,'products.status'=>1,'users.status'=>1))->orderBy('products.id','desc')->paginate(52);
        //dd(DB::getQueryLog());
        $subcate = DB::table('sub_category')->orderBy('id','desc')->get();
        $subcategory = DB::table('sub_category')->where('cat_id',$cat_id)->orderBy('id','desc')->get();
    }
    return view('/front/subcategory',['subcategories'=>$subcategories,'subcategoryproduct'=>$subcategoryproduct,'subcate'=>$subcate,'category'=>$category,'subcategory'=>$subcategory]);
}

function addwishlist()
{
    if(Auth::check())
    {
    $user_id = auth()->user()->id;
    }
    //$user_session = session('logged_user');
    //$user_id = $user_session->id;
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
        $message->from('support@emporiumstore.co.uk','Log Zero Technologies');
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
    $product = DB::table('products')->where('status',1)->where('name','LIKE', "%{$searchdata}%")->orderBy('id','desc')->paginate(52);
    return view('front/search',['product'=>$product,'searchdata'=>$searchdata]);
}
public function checkPinCode(Request $req)
{
    $product_id = $req->product_id;
    $zipcode = $req->pincode;
    $prdData = DB::table('products')
                      ->select('user_id')
                      ->where('id', $product_id)
                      ->first();
    $postalcode=DB::table('postal_code')->select('*')->where('zipcode',$zipcode)->where('seller_id',$prdData->user_id)->first();
    //$postalcodecount = count($postalcode);
    if(!empty($postalcode))
    {
    $checkPinCode = DB::table('products')
                      ->select('id')
                      ->whereRaw('FIND_IN_SET('.$postalcode->id.',zipcode)')
                      ->where('id', $product_id)
                      ->get();
    echo json_encode(array($checkPinCode, $postalcode->cost));
    }
    else{
        echo 0;
    }
    exit;
}

public function ordermail(Request $req,$id)
{
    $myorderid = $id;
    return view('front/ordermail',['myorderid'=>$myorderid]);
}

public function ForgetPasswordEmail()
{
    return view('front/forget-password-email');
}

public function ForgetPasswordOTP(Request $request)
{
    return view('front/forget-password-otp',['emailid'=>$request->emailid]);
}

function ForgetPasswordSendotp(Request $req)
{
    $verify_pto = $_REQUEST['verify_pto'];
    //$user_session = session('logged_user');
    
    $this->from=strtolower($req->email);
    $dataset=array('email'=>strtolower($req->email));
    $res=  Mail::send('front/sendmail/regmail',$data =
    [
    'dataset'=>$dataset,
    'otp'=>$verify_pto
    ],function($message){
         //return $message;
        $message->from('info@emporiumstore.co.uk','Email Vertification');
        $message->to($this->from,'Email Vertification');
        $message->subject('Email Vertification');
    });
    return redirect('/front/create-new-password.blade.php',['emailid'=>$req->email]);
}

public function sendNewPasswordPage(Request $request)
{ 
    return view('front/create-new-password',['emailid'=>$request->email]);
}

function updateOldPassword(Request $req)
{
    $email = $req->email;
    $user_data = DB::table('users')->where('email',$email)->orderBy('id','desc')->first();
    $user_type = $user_data->user_type;
    $password = $req->password;
    //print_r($req);die;
    if($user_type==1 || $user_type==2)
    {
        $newpassword = Hash::make($password);
        $data = [
        "password"=>$newpassword,
        "showpassword"=>$password
    ];
    $product = DB::table('users')->where('email',$email)->update($data);
    }
    else
    {
    $encryptedpassword = md5($req->password);
    
    $data = [
        "password"=>$encryptedpassword,
        "showpassword"=>$password
    ];
    $product = DB::table('users')->where('email',$email)->update($data);
    }
    return redirect('/login');
}


public function auction(Request $req)
{   
    date_default_timezone_set('Asia/Kolkata');
    $date_time = date("Y-m-d H:i:s");
    
    if(isset($_REQUEST['sortby']) && $_REQUEST['sortby']!="" && $_REQUEST['sortby']!="")
    {
        $orderby = "";
        if($_REQUEST['sortby'] == "lowtohigh")
        {
            $orderby = "desc";
        }
        if($_REQUEST['sortby'] == "hightolow")
        {
            $orderby = "asc";
        }
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        $auctionsproducts = DB::table('auctions')->select('*', 'auctions.id as aid')->join('products', 'auctions.product_id', '=', 'products.id')->where(array('auctions.status'=>1))->where('auctions.auction_time','>=',$date_time)->whereNull('auctions.bidding_id')->orderBy('products.price',$orderby)->paginate(52);
    }
    elseif(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder']!="" && $_REQUEST['sortby']=="")
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
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        $auctionsproducts = DB::table('auctions')->select('*', 'auctions.id as aid')->join('products', 'auctions.product_id', '=', 'products.id')->where(array('auctions.status'=>1))->where('auctions.auction_time','>=',$date_time)->whereNull('auctions.bidding_id')->orderBy('auctions.id',$orderby)->paginate(52);
    }
    elseif(!empty($_GET))
    {
        if(isset($_GET['sortbyorder'])=='' && isset($_GET['sortby'])=='')
        {
        $query = DB::table('product_detail');
        foreach ($_GET as $key=>$val) 
        {
            if($key!="page"){
            foreach ($val as $k => $v) 
            {
            if($v)
            {
                $query->orWhere('spec_detail','LIKE','%"'.$v.'"%');
            }
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
        $newproductid = explode(',',$newproduct_id);
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        $auctionsproducts = DB::table('auctions')->select('*', 'auctions.id as aid')->join('products', 'auctions.product_id', '=', 'products.id')->where(array('auctions.status'=>1))->where('auctions.auction_time','>=',$date_time)->whereIn('products.id', $newproductid)->whereNull('auctions.bidding_id')->orderBy('auctions.id','desc')->paginate(52);
    }
    }
    else
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        $auctionsproducts = DB::table('auctions')->select('*', 'auctions.id as aid')->join('products', 'auctions.product_id', '=', 'products.id')->where(array('auctions.status'=>1))->where('auctions.auction_time','>=',$date_time)->whereNull('auctions.bidding_id')->orderBy('auctions.id','desc')->paginate(52);
    }
    return view('/front/auction-listing',['auctionsproducts'=>$auctionsproducts,'category'=>$category,'subcategory'=>$subcategory]);
}


public function auctionDetail($id)
{
    
        $category = DB::table('category')->get();
        $subcategory = DB::table('sub_category')->get();
        $auctiondetail = DB::table('auctions')->select('*', 'auctions.id as aid' ,'auctions.created_at as acreated_at','products.id as pid')->join('products', 'auctions.product_id', '=', 'products.id')->where(array('auctions.status'=>1,'auctions.id'=>$id))->first();
    
    return view('/front/auction-detail',['auctiondetail'=>$auctiondetail,'category'=>$category,'subcategory'=>$subcategory]);
}

public function addBid(Request $req){
        //$user = $req->session()->all();
        if(Auth::check())
        {
        $user_type = auth()->user()->user_type;
        $user_id = auth()->user()->id;
        if($user_type == '3')
        {
        $existbid = DB::table('biddings')->where(array('user_id'=>$user_id,'auction_id'=>$req->auction_id))->count();
        
        if($existbid == 0){
        $data = [
            "auction_id"=>$req->auction_id,
            "user_id"=>$user_id,
            "product_id"=>$req->product_id,
            "bid"=>$req->bid_amount,            
            ];
        
        DB::table('biddings')->insert($data);
        return back()->with('success','Your bid added successfully'); 
        }
        return $this->auctionDetail($req->auction_id);
        }
        }
        else
        {
            return redirect('/login');
        }
    
}


public function myBids(Request $req){
    $user = Auth::check();
    if(Auth::check())
    {
        $user_type = auth()->user()->user_type;
        $user_id = auth()->user()->id;
    //$user = $req->session()->all();
   if($user_type == '3' || $user_type == '2')
   {
    $bids = DB::table('biddings')->select('*', 'biddings.user_id as bid_user_id', 'auctions.id as aid' ,'auctions.created_at as acreated_at','products.id as pid','biddings.status as bstatus','biddings.id as bidid')->join('products', 'biddings.product_id', '=', 'products.id')->join('auctions', 'auctions.id', '=', 'biddings.auction_id')->where('biddings.user_id',$user_id)->get();    
    return view('/front/mybids',['bids'=>$bids]);    
    }
    else{
        return view('/front/my-account',['user'=>$user]);
    }
    }
    else
    {
         return redirect('/login');
    }
    
    
}

public function stripesuccess(Request $req)
{
    $stripeToken = $_REQUEST['stripeToken'];
    return view('/front/stripesuccess',['stripeToken'=>$stripeToken]);   
}

function deleteimage($id)
{
$updateData['image']=NULL;
DB::table('buyers')->where('id',$id)->update($updateData);
DB::table('sellers')->where('id',$id)->update($updateData);
return back();
}


}