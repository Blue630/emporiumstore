<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\frontmodel\Product;
use DB;
class IndexController extends Controller
{
    public function index()
    {
      $slider = DB::table('sliders')->where('status',1)->orderBy('id','desc')->get();
      
      $category = DB::table('category')->where('status',1)->orderBy('id','desc')->limit(10)->get();

      $product = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where('products.status',1)->where('users.status',1)->orderBy('id','desc')->limit(10)->get();
      
      $todaydealproducts = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.todaydeal'=>1,'users.status'=>1))->orderBy('id','desc')->limit(10)->get();
      
      $weeklydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.weeklydeal'=>1,'users.status'=>1))->orderBy('id','desc')->limit(10)->get();
      
      $monthlydealsproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.monthlydeal'=>1,'users.status'=>1))->orderBy('id','desc')->limit(10)->get();
      
      $seasonalproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.season'=>1,'users.status'=>1))->orderBy('id','desc')->limit(10)->get();
      
      $topratedproduct = DB::table('review')->where('rating','>=',3)->groupBy('product_id')->limit(10)->get();
      
      $featuredproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.status'=>1,'products.is_featured'=>1,'users.status'=>1))->orWhere('is_admin_featured',1)->orderBy('id','desc')->limit(10)->get();

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
                          ->where('products.status', 1)
                          ->where('users.status', 1)
                          ->where('most_viewed_product.status', 1)
                          ->where('most_viewed_product.user_id', $user_id)
                          ->orderBy('most_viewed_product.updated_at','desc')->limit(10)->get();
      $mostViewedProducts = DB::table('products')
                          ->select('products.*')
                          ->join('most_viewed_product', 'most_viewed_product.product_id', '=', 'products.id')
                          ->join('users','users.id','=','products.user_id')
                          ->where('most_viewed_product.status', 1)
                          ->where('products.status', 1)
                          ->where('users.status', 1)
                          ->where('most_viewed_product.user_id', $user_id)
                          ->orderBy('most_viewed_product.counter','desc')->limit(10)->get();
      }
      return view('front/index',['slider'=>$slider,'featuredproduct'=>$featuredproduct,'seasonalproduct'=>$seasonalproduct,'topratedproduct'=>$topratedproduct,'monthlydealsproduct'=>$monthlydealsproduct,'weeklydealsproduct'=>$weeklydealsproduct,'todaydealproducts'=>$todaydealproducts,'category'=>$category, 'recentlyViewedProducts'=>$recentlyViewedProducts,'mostViewedProducts'=>$mostViewedProducts]);
    }
}