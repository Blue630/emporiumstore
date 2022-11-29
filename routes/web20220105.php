<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



// Route::get('/', function () {



//     return view('front/index');

// });

Route::get('/','IndexController@index');

// Route::get('/products','FrontController@product_list');

Route::match(['get','post'],'/products','FrontController@product_list');

Route::get('/products/{id}','FrontController@filterproduct');

Route::get('/category/{id}','FrontController@categoryproduct');

Route::get('/subcategory/{id}','FrontController@subcategoryproduct');

Route::get('/front/addwishlist/', 'FrontController@addwishlist');

Route::get('/products/price/{price}','FrontController@filterproductprice');

Route::get('/about-us','FrontController@aboutus');

Route::get('/terms','FrontController@terms');

Route::get('/cookies','FrontController@cookies');

Route::get('/seller-login','FrontController@seller_login');

Route::get('/welcome-seller','FrontController@welcome_seller');

//Route::get('/product-detail','FrontController@product_deatail');

Route::get('/product-detail/{id}','FrontController@productdetail');

Route::post('/product-varient-data','FrontController@calculateVarient');
Route::post('/addtocart','FrontController@addtocart');
Route::match(['get','post'],'/addaddress','FrontController@addaddress');
Route::match(['get','post'],'/editaddress/{id}','FrontController@editaddress');
Route::post('/checkpincode','FrontController@checkPinCode');



Route::match(['get','post'],'/contact-us','FrontController@contactus');

Route::get('/privacy-policy','FrontController@privacypolicy');

Route::match(['get','post'],'/registeration','FrontController@registeration');

Route::get('/cart','FrontController@cart');

Route::get('/verifiedemail/{id}','FrontController@verifiedemail');

Route::post('/search','FrontController@search');

// Route::post('/filter_seach','FrontController@filter_seach');



Route::get('/login','LoginController@userlogin');

Route::post('/dologin','LoginController@dologin');

Route::get('/userlogout','LoginController@userlogout');

Route::get('/forget-password','LoginController@forget_password');

Route::post('/forget_password_mail','LoginController@forget_password_mail');



// cart url
Route::get('cart','CartController@index');
//Route::get('cart/addtoCart/','CartController@addtoCart');
Route::post('cart/addtoCart/','CartController@addtoCart');
Route::post('cart/updateitem/','CartController@updateitem');
Route::post('cart/discountcart/','CartController@discountcart');
Route::get('cart/removeitem/{id}','CartController@removeitem');
Route::get('/checkout','CartController@checkout');
Route::get('cart/BuytoCart/{id}','CartController@BuytoCart');


// payment by razorpay

Route::post('/payment','RazorpayController@payment');

Route::get('/payWithRazorpay','RazorpayController@payWithRazorpay');

Route::get('/thankyou','RazorpayController@thankyou');





Auth::routes();



//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

//Route::get('/admin', 'LoginController@login')->name('home');



// admin url

// Route::auth();

///////////////////////////////Admin//////////////////////////////

Route::post('/admin/sendportingcode','AdminController@sendportingcode');

// order manage



Route::group(['prefix'=>'admin','middleware'=> ['auth','is_admin']], function ()

 {

	$val=1;

	if(request()->segment('1')=='home' && $val==1)

	{

		// echo "<script>alert('test');</script>";

		//echo auth()->user()->is_admin;

		echo "<script>document.location.href='admin/home'</script>";

	}

    Route::get('/home','HomeController@adminHome');

    Route::get('/logout','LoginController@logout');

    

    //  subscription

    Route::match(['get','post'],'/addsubscription','AdminController@addsubscription');

    Route::get('/managesubscription','AdminController@managesubscription');

    Route::match(['get','post'],'/editsubscription/{id}','AdminController@editsubscription');

    Route::get('/inactivesubscription/{id}','AdminController@inactivesubscription');

    Route::match(['get','post'],'/activesubscription/{id}','AdminController@activesubscription');

    

    //  cashback

    Route::match(['get','post'],'/addcashback','AdminController@addcashback');

    Route::get('/managecashback','AdminController@managecashback');

    Route::match(['get','post'],'/editcashback/{id}','AdminController@editcashback');

    Route::get('/inactivecashback/{id}','AdminController@inactivecashback');

    Route::match(['get','post'],'/activecashback/{id}','AdminController@activecashback');



    //  coupon

    Route::match(['get','post'],'/addcoupon','AdminController@addcoupon');

    Route::get('/managecoupon','AdminController@managecoupon');

    Route::match(['get','post'],'/editcoupon/{id}','AdminController@editcoupon');

    Route::get('/inactivecoupon/{id}','AdminController@inactivecoupon');

    Route::match(['get','post'],'/activecoupon/{id}','AdminController@activecoupon');

    

    //  commission

    Route::match(['get','post'],'/addcommission','AdminController@addcommission');

    Route::get('/managecommission','AdminController@managecommission');

    Route::match(['get','post'],'/editcommission/{id}','AdminController@editcommission');

    Route::get('/inactivecommission/{id}','AdminController@inactivecommission');

    Route::match(['get','post'],'/activecommission/{id}','AdminController@activecommission');

    

    //  pages

    Route::get('/manage_pages','AdminController@manage_pages');

    Route::match(['get','post'],'/edit_aboutus/{id}','AdminController@edit_aboutus');

    Route::match(['get','post'],'/edit_contactus/{id}','AdminController@edit_content_page');

    Route::match(['get','post'],'/edit_content/{id}','AdminController@edit_content');

    

    //  category

    Route::match(['get','post'],'/add_cate','AdminController@add_cate');

    Route::get('/manage_cate','AdminController@manage_cate');

    Route::match(['get','post'],'/edit_cate/{id}','AdminController@edit_cate');

    Route::get('/activecategory/{id}','AdminController@activecategory');

    Route::get('/inactivecategory/{id}','AdminController@inactivecategory');

    Route::match(['get','post'],'/cat-show-in-menu','AdminController@CategoryShowInMenu');



    //  subcategory

    Route::match(['get','post'],'/add_subcat','AdminController@add_subcat');

    Route::get('/manage_subcat','AdminController@manage_subcat');

    Route::match(['get','post'],'/edit_subcat/{id}','AdminController@edit_subcat');



    //  specification

    Route::match(['get','post'],'/add_specs','AdminController@add_specs');

    Route::get('/manage_specs','AdminController@manage_specs');

    Route::match(['get','post'],'/edit_specs/{id}','AdminController@edit_specs');



    //  options

    Route::match(['get','post'],'/add_option','AdminController@add_option');

    Route::get('/manage_option','AdminController@manage_option');

    Route::match(['get','post'],'/edit_option/{id}','AdminController@edit_option');



   //  products

   Route::match(['get','post'],'/addproduct','AdminController@addprodouct');

   Route::get('/manageproduct','AdminController@manageproduct');

   Route::get('/vendorproduct/{id}','AdminController@vendorproduct');

   Route::match(['get','post'],'/editproduct/{id}','AdminController@editproduct');

   Route::get('updatecahsback', 'AdminController@updatecahsback');

    //Route::get('/deleteproduct/{id}','AdminController@deleteproduct');



   //userlist

   Route::get('/manageusers','AdminController@manageusers');   

   Route::post('/importcsvproduct','AdminController@importcsvproduct');

   Route::get('/deleteproduct/{id}','AdminController@deleteproduct');

   Route::get('/deletecategory/{id}','AdminController@deletecategory');

   

   //Seller

   Route::match(['get','post'],'/seller','AdminController@sellerListing');

   Route::match(['get','post'],'/seller-details','AdminController@sellerDetails');   



   //Buyer

   Route::match(['get','post'],'/buyers','AdminController@buyerListing');

   Route::match(['get','post'],'/buyer-details','AdminController@buyerDetails'); 

   // order manage

    Route::match(['get','post'],'manageorder','AdminController@manageorder');   

    Route::match(['get','post'],'manageorder/details/{orderid}','AdminController@orderdetails'); 

    Route::match(['get','post'],'orderdetails/{id}','AdminController@orderDetails');

    

     // Auction

    Route::match(['get','post'],'/addauction','AdminController@addauction');

    Route::get('/manageauction','AdminController@manageauction');

    Route::match(['get','post'],'/editauction/{id}','AdminController@editauction');

    Route::get('getsubcat', 'AdminController@getsubCat');

    Route::get('getproduct', 'AdminController@getproduct');

    Route::get('getspecification', 'AdminController@getSpecification');

    Route::get('/inactiveauction/{id}','AdminController@inactiveauction');

    Route::match(['get','post'],'/activeauction/{id}','AdminController@activeauction');









 });







////////////////////Seller Admin//////////////////////////

Route::group(['prefix'=>'seller','middleware'=> ['auth','is_seller']], function ()

 {

  $val=2;

  if(request()->segment('1')=='home' && $val==2)

    {

    // echo "<script>alert('test');</script>";

    echo "<script>document.location.href='seller/dashboard'</script>";

    }



Route::get('/dashboard','HomeController@adminHome');

Route::get('/logout','LoginController@logout');



// order manage

Route::match(['get','post'],'manageorder','SellerController@manageorder');   

Route::match(['get','post'],'manageorder/details/{orderid}','SellerController@orderdetails'); 

Route::match(['get','post'],'orderdetails/{id}','SellerController@orderDetails');

 

  //  products

  Route::match(['get','post'],'/addproduct','SellerController@addprodouct');

  Route::get('/manageproduct','SellerController@manageproduct');

  //Route::get('/vendorproduct/{id}','SellerController@vendorproduct');

  Route::match(['get','post'],'/editproduct/{id}','SellerController@editproduct');   

  Route::get('getsubcat', 'SellerController@getsubCat');

  Route::get('getspecification', 'SellerController@getSpecification');

  Route::get('/inactiveproduct/{id}','SellerController@inactiveproduct');

  Route::match(['get','post'],'/activeproduct/{id}','SellerController@activeproduct');   

  //Route::post('addprodouct', 'SellerController@addproduct');

  //Route::get('/deleteproduct/{id}','SellerController@deleteproduct');

Route::get('donwload-file', 'SellerController@downloadFile');



  //  auction

  Route::match(['get','post'],'/addauction','SellerController@addauction');

  Route::get('/manageauction','SellerController@manageauction');

  Route::match(['get','post'],'/editauction/{id}','SellerController@editauction');

  Route::get('getsubcat', 'SellerController@getsubCat');

  Route::get('getproduct', 'SellerController@getproduct');

  Route::get('getspecification', 'SellerController@getSpecification');

  Route::get('/inactiveauction/{id}','SellerController@inactiveauction');

  Route::match(['get','post'],'/activeauction/{id}','SellerController@activeauction');



   //userlist

   Route::get('/manageusers','SellerController@manageusers');   

   Route::post('/importcsvproduct','SellerController@importcsvproduct');

   Route::get('/deleteproduct/{id}','SellerController@deleteproduct');

   Route::get('/deletecategory/{id}','SellerController@deletecategory');

   Route::get('/deleteadditional/{id}/{product_id}','SellerController@deleteadditional');

   Route::get('/deletevariant/{id}/{product_id}','SellerController@deletevariant');

 });





// ================================ vendor url==========================================================

$seg1=request()->segment(1);

// echo $seg1;die;

Route::match(['get','post'],'vendor-login','VendorloginController@vendorlogin'); //from websitelink

//Route::match(['get','post'], $seg1.'/vendor-login','VendorloginController@vendorlogin'); //from email Link 

Route::match(['get','post'],'vendor-register','VendorController@vendorregister');

Route::get('vendor-profile/{storeslug}','VendorController@vendorprofile');

Route::group(['middleware' => 'is_vendor'], function () {

Route::get('vendor/dashboard','VendorController@dashboard');



Route::match(['get','post'],'/vendor/addproduct','VendorController@addprodouct');

Route::get('/vendor/manageproduct','VendorController@manageproduct');

Route::match(['get','post'],'/vendor/editproduct/{id}','VendorController@editproduct');



// order manage

Route::get('/vendor/manageorder','VendorController@manageorder');   

Route::get('/vendor/manageorder/details/{orderid}','VendorController@orderdetails');

Route::post('/vendor/sendportingcode','VendorController@sendportingcode');

Route::post('/vendor/importcsvproduct','VendorController@importcsvproduct');

Route::get('/vendor/managebuyerorder','VendorController@managebuyerorder');

//store

Route::match(['get','post'],'/vendor/storeupdate','VendorController@storeupdate');



Route::get('/vendor/vendorlogout','VendorloginController@vendorlogout');



});



//=========================================== Buyer ====================================

Route::match(['get','post'],'buyer-login','BuyerloginController@buyerlogin'); //from websitelink

Route::group(['middleware' => 'is_buyer'], function () {

Route::get('buyer-profile','BuyerController@buyerprofile'); //from websitelink

Route::post('buyprofileupdate','BuyerController@buyprofileupdate'); //from websitelink

Route::post('wallet_request','BuyerController@wallet_request'); //from websitelink

// Route::get('cart/BuytoCart/{id}','CartController@BuytoCart'); 





Route::get('/buyerlogout','BuyerloginController@buyerlogout'); //buyer logout

});

Route::get('/db_dump_drop', function(){

   $tables = [

      'category',

      'failed_jobs',

      'migrations',

      'order_history',

      'password_resets',

      'products',

      'userregister',

      'users',

      'vendor_retailer'

   ];

   foreach($tables as $table)

   {

       Schema::drop(''.$table.'');

   }

  

});



Route::get('/db_dump', function () {

  

   $get_all_table_query = "SHOW TABLES";

   $result = DB::select(DB::raw($get_all_table_query));



   $tables = [

       'category',

       'failed_jobs',

       'migrations',

       'order_history',

       'password_resets',

       'products',

       'userregister',

       'users',

       'vendor_retailer'

   ];



   $structure = '';

   $data = '';

   foreach ($tables as $table) {

       $show_table_query = "SHOW CREATE TABLE " . $table . "";



       $show_table_result = DB::select(DB::raw($show_table_query));



       foreach ($show_table_result as $show_table_row) {

           $show_table_row = (array)$show_table_row;

           $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";

       }

       $select_query = "SELECT * FROM " . $table;

       $records = DB::select(DB::raw($select_query));



       foreach ($records as $record) {

           $record = (array)$record;

           $table_column_array = array_keys($record);

           foreach ($table_column_array as $key => $name) {

               $table_column_array[$key] = '`' . $table_column_array[$key] . '`';

           }



           $table_value_array = array_values($record);

           $data .= "\nINSERT INTO $table (";



           $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";



           foreach($table_value_array as $key => $record_column)

               $table_value_array[$key] = addslashes($record_column);



           $data .= "('" . implode("','", $table_value_array) . "');\n";

       }

   }

   $file_name = __DIR__ . '/../vendor/laravel/code' . date('y_m_d') . '.sql';

   $file_handle = fopen($file_name, 'w +');



   $output = $structure . $data;

   fwrite($file_handle, $output);

   

   fclose($file_handle);

   echo "DB backup ready";

});