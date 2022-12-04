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
Route::get('/deleteimage/{id}','FrontController@deleteimage');
Route::get('/products/{id}','FrontController@filterproduct');
Route::get('/category/{id}','FrontController@categoryproduct');
Route::get('/subcategory/{id}','FrontController@subcategoryproduct');
Route::get('/front/addwishlist/', 'FrontController@addwishlist');
Route::get('/products/price/{price}','FrontController@filterproductprice');
Route::get('/about-us','FrontController@aboutus');
Route::get('/website-terms','FrontController@websiteterms');
Route::get('/products','FrontController@products');
Route::get('/404','FrontController@fourzerofour');
Route::get('/categories','FrontController@categories');
Route::get('/today-deal','FrontController@todaydeal');
Route::get('/trending','FrontController@trending');
Route::get('/suggested-products','FrontController@suggestedproducts');
Route::get('/featured-products','FrontController@featuredproduct');
Route::get('/just-launched','FrontController@justlaunched');
Route::get('/weekly-deals','FrontController@weeklydeals');
Route::get('/seasonal-products','FrontController@seasonalproducts');
Route::get('/deal-of-the-month','FrontController@monthlydeals');
Route::get('/best-sellers','FrontController@bestsellers');
Route::get('/subscribe-save','FrontController@subscribeandsave');
Route::get('/top-rated','FrontController@toprated');
Route::get('/auction-listing','FrontController@auction');
Route::get('/auction-detail/{id}','FrontController@auctionDetail');
Route::match(['get','post'],'/add-bid','FrontController@addBid');
Route::match(['get','post'],'/mybids','FrontController@myBids');
Route::get('/best-seller-product/{id}','FrontController@bestsellerproduct');
Route::get('/coupon','FrontController@coupon');
Route::get('/terms','FrontController@terms');
Route::get('/emporium-terms','FrontController@emporiumterms');
Route::get('/my-account','FrontController@myaccount');
Route::get('/cookies','FrontController@cookies');
Route::get('/seller-login','FrontController@seller_login');
Route::get('/welcome-seller','FrontController@welcome_seller');
Route::get('/product-detail/{id}','FrontController@productdetail');


Route::post('/product-varient-data','FrontController@calculateVarient');
Route::post('/getvariantimage','FrontController@getvariantimage');
Route::post('/addtocart','FrontController@addtocart');

Route::post('/insertseller','FrontController@insertseller');

Route::match(['get','post'],'/addaddress','FrontController@addaddress');
Route::match(['get','post'],'/editaddress/{id}','FrontController@editaddress');
Route::post('/checkpincode','FrontController@checkPinCode');
Route::match(['get','post'],'/paynow','CheckoutController@paynow');
Route::match(['get','post'],'/addmoney','FrontController@addmoney');
Route::match(['get','post'],'/bidpayment','FrontController@bidPayment');
//08-01-22
Route::match(['get','post'],'/moreaboutyouseller','FrontController@moreaboutyouseller');
Route::match(['get','post'],'/aboutyourstore','FrontController@aboutyourstore');
Route::match(['get','post'],'/otpverification','FrontController@otpverification');
Route::match(['get','post'],'/buyerotpverification','FrontController@buyerotpverification');
Route::get('/front/sendotp/', 'FrontController@sendotp');

Route::match(['get','post'],'/contact-us','FrontController@contactus');
Route::get('/privacy-policy','FrontController@privacypolicy');
Route::match(['get','post'],'/registeration','FrontController@registeration');
Route::match(['get','post'],'/newsletter','FrontController@newsletter');
Route::match(['get','post'],'/subscribealert','FrontController@subscribealert');
Route::get('/verifiedemail/{id}','FrontController@verifiedemail');
//Route::post('/search','FrontController@search');
Route::match(['get','post'],'/search','FrontController@search');
// Route::post('/filter_seach','FrontController@filter_seach');
Route::get('/login','LoginController@userlogin');
Route::post('/dologin','LoginController@dologin');


Route::get('google',function(){
return view('front/googleAuth');
});
Route::get('/redirect/{service}', 'GoogleLoginController@redirect');
Route::get('/callback/{service}', 'GoogleLoginController@callback');


Route::get('/userlogout','LoginController@userlogout');
Route::get('/forget-password','LoginController@forget_password');
Route::post('/forget_password_mail','LoginController@forget_password_mail');
Route::post('/success','FrontController@success');
Route::post('/walletresponse','FrontController@walletresponse');
Route::post('/stripewalletresponse','FrontController@stripewalletresponse');
Route::post('/stripesuccess','FrontController@stripesuccess');
Route::post('/bid-payment-response','FrontController@bidPaymentResponse');
// cart url
Route::get('cart','CartController@index');
Route::post('cart/boughtaddtoCart/','CartController@boughtaddtoCart');
Route::post('cart/addtoCart/','CartController@addtoCart');
Route::post('cart/updateitem/','CartController@updateitem');
Route::post('cart/discountcart/','CartController@discountcart');
Route::get('cart/removeitem/{id}','CartController@removeitem');
//checkout url
Route::any('checkout','CheckoutController@index');
Route::post('checkout/addtoCart/','CheckoutController@addtoCart');
Route::post('checkout/updateitem/','CheckoutController@updateitem');

Route::post('checkout/removediscount/','CheckoutController@removediscount');

Route::post('checkout/discountcart/','CheckoutController@discountcart');
Route::get('checkout/removeitem/{id}','CheckoutController@removeitem');
// Buyer Routes
Route::get('/update-profile','BuyerController@buyerProfileUpdatePage');
Route::post('/update-userdetails','BuyerController@UpdateUserDetais');
Route::post('/update-userimage','BuyerController@UpdateUserImage');
Route::post('/update-user-primaryaddress','BuyerController@UpdatePrimaryAddress');
Route::get('/remove-product-from-wishlist/{id}','BuyerController@RemoveProductFromWishlist');
Route::get('/wishlist','BuyerController@fetchWishlist');
Route::get('/myorders','BuyerController@myOrders');
Route::post('/cancel-order','BuyerController@cancelOrder');
Route::get('/order-detail/{id}','BuyerController@orderDetail');
Route::get('/ordermail/{id}','FrontController@ordermail');

Route::post('/rate-product','BuyerController@rateProduct');

Route::post('/rate-unrated-product','BuyerController@rateUnratedProduct');

Route::post('/load-more-reviews','BuyerController@loadMoreReviews');
Route::post('/sortby-review','BuyerController@sortByReview');
Route::post('/like-dislike-review','BuyerController@likeDislkeReview');


Route::get('/forget-password-email','FrontController@ForgetPasswordEmail');
Route::post('front/forget-password-otp','FrontController@ForgetPasswordOTP');
Route::post('front/forgetpassword-sendotp', 'FrontController@ForgetPasswordSendotp');
Route::post('/send-create-new-password', 'FrontController@sendNewPasswordPage');
Route::post('/front/update-old-password', 'FrontController@updateOldPassword');
Route::post('/update-trackid', 'SellerController@updateTrackid');



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
// if(request()->segment('1')=='home' && $val==1)
// {
// // echo "<script>alert('test');</script>";
// //echo auth()->user()->is_admin;
// echo "<script>document.location.href='admin/home'</script>";
// }
Route::get('/home','HomeController@adminHome');
Route::get('/logout','LoginController@logout');

//  subscription
Route::match(['get','post'],'/addsubscription','AdminController@addsubscription');
Route::get('/managesubscription','AdminController@managesubscription');
Route::match(['get','post'],'/editsubscription/{id}','AdminController@editsubscription');
Route::get('/inactivesubscription/{id}','AdminController@inactivesubscription');
Route::match(['get','post'],'/activesubscription/{id}','AdminController@activesubscription');


//Route::get('/manageproduct','/downloadproductsample','AdminController@downloadproductsample');

Route::match(['get','post'],'/downloadproductsample','AdminController@downloadproductsample');

//Route::get('/manageproduct/downloadproductsample', [AdminController::class, 'downloadproductsample']);
//  cashback
Route::match(['get','post'],'/addcashback','AdminController@addcashback');
Route::get('/managefeature','AdminController@managefeature');
Route::get('/managecashback','AdminController@managecashback');
Route::match(['get','post'],'/editcashback/{id}','AdminController@editcashback');
Route::get('/inactivecashback/{id}','AdminController@inactivecashback');
Route::match(['get','post'],'/activecashback/{id}','AdminController@activecashback');
Route::get('/deletecashback/{id}','AdminController@deletecashback');
Route::get('/deletesubcat/{id}','AdminController@deletesubcat');
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

// WithdrawFunds
Route::get('updatewithdrawfund', 'AdminController@updatewithdrawfund');

//  slider
Route::match(['get','post'],'/add_slider','AdminController@add_slider');
Route::get('/manage_slider','AdminController@manage_slider');
Route::match(['get','post'],'/edit_slider/{id}','AdminController@edit_slider');
Route::get('/activeslider/{id}','AdminController@activeslider');
Route::get('/inactiveslider/{id}','AdminController@inactiveslider');
Route::get('/deleteslider/{id}','AdminController@deleteslider');

//  featured_package
Route::match(['get','post'],'/add_featured_package','AdminController@add_featured_package');
Route::get('/manage_featured_package','AdminController@manage_featured_package');
Route::match(['get','post'],'/edit_featured_package/{id}','AdminController@edit_featured_package');
Route::get('/activefeatured_package/{id}','AdminController@activefeatured_package');
Route::get('/inactivefeatured_package/{id}','AdminController@inactivefeatured_package');

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
Route::match(['get','post'],'/product-rating/{id}','AdminController@productRating');
Route::get('/activeproduct/{id}','AdminController@activeproduct');
Route::get('/inactiveproduct/{id}','AdminController@inactiveproduct');

Route::get('/deleteoption/{id}','AdminController@deleteoption');
Route::get('/deletespecs/{id}','AdminController@deletespecs');
Route::get('updateproduct', 'AdminController@updateproduct');
//userlist
Route::get('/manageusers','AdminController@manageusers');   
Route::post('/importcsvproduct','AdminController@importcsvproduct');
Route::get('/deleteproduct/{id}','AdminController@deleteproduct');
Route::get('/deletecategory/{id}','AdminController@deletecategory');

//Seller
Route::match(['get','post'],'/seller','AdminController@sellerListing');
Route::match(['get','post'],'/seller-details','AdminController@sellerDetails'); 
Route::match(['get','post'],'/withdrawfundrequest','AdminController@withdrawfundrequestListing');
//Buyer
Route::match(['get','post'],'/buyers','AdminController@buyerListing');
Route::match(['get','post'],'/buyer-details','AdminController@buyerDetails'); 
// order manage
Route::match(['get','post'],'manageorder','AdminController@manageorder');   
Route::match(['get','post'],'manageorder/details/{orderid}','AdminController@orderdetails'); 
Route::match(['get','post'],'orderdetails/{id}','AdminController@orderDetails');
Route::match(['get','post'],'orders-detail','AdminController@ordersDetail');
Route::match(['get','post'],'vendor-payment_update/{id}/{type}','AdminController@PaymentUpdatePage');
Route::match(['get','post'],'buyer-cashback-update/{id}/{type}','AdminController@PaymentUpdatePage');
Route::match(['get','post'],'update-payment-details','AdminController@PaymentUpdate');


// Auction
Route::match(['get','post'],'/addauction','AdminController@addauction');
Route::get('/manageauction','AdminController@manageauction');
Route::match(['get','post'],'/editauction/{id}','AdminController@editauction');
Route::get('getsubcat', 'AdminController@getsubCat');
Route::get('getproduct', 'AdminController@getproduct');
Route::get('getspecification', 'AdminController@getSpecification');

Route::get('/inactiveauction/{id}','AdminController@inactiveauction');
Route::match(['get','post'],'/activeauction/{id}','AdminController@activeauction');
Route::get('/deletevariant/{id}/{product_id}','AdminController@deletevariant');
Route::match(['get','post'],'/wallet', 'AdminController@wallet');
Route::match(['get','post'],'/bids/{id}','AdminController@Bids');
Route::get('/deleteadditional/{id}/{product_id}','AdminController@deleteadditional');

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
Route::match(['get','post'],'/withdrawfundrequest','SellerController@withdrawfundrequestListing');
Route::match(['get','post'],'manageorder/details/{orderid}','SellerController@orderdetails'); 

Route::match(['get','post'],'/update-order-status','SellerController@updateOrderStatus'); 

Route::match(['get','post'],'/updatesellerprofile', 'SellerController@updatesellerprofile');

Route::match(['get','post'],'/withdrawfunds', 'SellerController@withdrawfunds');

Route::match(['get','post'],'/product-rating/{id}','SellerController@productRating');  

Route::match(['get','post'],'orderdetails/{id}','SellerController@orderDetails');
Route::post('/success','SellerController@success');
Route::post('/stripesuccess','SellerController@stripesuccess');
//  products
Route::match(['get','post'],'/addproduct','SellerController@addprodouct');
Route::get('/manageproduct','SellerController@manageproduct');
Route::get('updatefeaturedproduct', 'SellerController@updatefeaturedproduct');
Route::match(['get','post'],'/editproduct/{id}','SellerController@editproduct');

Route::match(['get','post'],'/editseller/{id}','SellerController@editseller');

Route::post('/submitwithdrawrequest', 'SellerController@submitwithdrawrequest');

Route::match(['get','post'],'/product-rating/{id}','SellerController@productRating');

Route::get('getsubcat', 'SellerController@getsubCat');
Route::get('getorderproduct', 'SellerController@getorderproduct');
Route::get('getspecification', 'SellerController@getSpecification');

Route::post('fetchprice', 'SellerController@fetchprice');

Route::get('/inactiveproduct/{id}','SellerController@inactiveproduct');
Route::match(['get','post'],'/activeproduct/{id}','SellerController@activeproduct');   
//Route::post('addprodouct', 'SellerController@addproduct');
//Route::get('/deleteproduct/{id}','SellerController@deleteproduct');
Route::get('donwload-file', 'SellerController@downloadFile');

// faq
Route::match(['get','post'],'/addfaq','SellerController@addfaq');
Route::get('/managefaq','SellerController@managefaq');
Route::match(['get','post'],'/editfaq/{id}','SellerController@editfaq');
Route::get('/inactivefaq/{id}','SellerController@inactivefaq');
Route::match(['get','post'],'/activefaq/{id}','SellerController@activefaq');

//Coupon
Route::get('/managecoupon','SellerController@managecoupon');

//  auction
Route::match(['get','post'],'/addauction','SellerController@addauction');
Route::get('/manageauction','SellerController@manageauction');
Route::match(['get','post'],'/editauction/{id}','SellerController@editauction');
Route::match(['get','post'],'/bids/{id}','SellerController@Bids');
Route::match(['get','post'],'/update-bid-status','SellerController@updateBidStatus');



Route::get('getsubcat', 'SellerController@getsubCat');
Route::get('getproduct', 'SellerController@getproduct');
Route::get('getspecification', 'SellerController@getSpecification');
Route::get('/inactiveauction/{id}','SellerController@inactiveauction');
Route::match(['get','post'],'/activeauction/{id}','SellerController@activeauction');

// purchase featured susbscription
Route::get('/managefeatureproductsubscription','SellerController@managefeatureproductsubscription');
Route::match(['get','post'],'/subscribefeaturedproduct','SellerController@addfeaturedsubscription');
Route::post('/thankyou','SellerController@thankyou');
Route::post('/stripethankyou','SellerController@stripethankyou');

// purchase susbscription
Route::get('/managesubscription','SellerController@managesubscription');
Route::match(['get','post'],'/addsubscription','SellerController@addsubscription');
Route::match(['get','post'],'/subscribenow','SellerController@addsubscription');

//userlist
Route::get('/manageusers','SellerController@manageusers');   
Route::post('/importcsvproduct','SellerController@importcsvproduct');
Route::post('/importcsvpostal','SellerController@importcsvpostal');
Route::get('/deleteproduct/{id}','SellerController@deleteproduct');
Route::get('/deletecategory/{id}','SellerController@deletecategory');
Route::get('/deleteadditional/{id}/{product_id}','SellerController@deleteadditional');
Route::get('/deletevariant/{id}/{product_id}','SellerController@deletevariant');
Route::match(['get','post'],'/wallet', 'SellerController@wallet');

});

//=========================================== Buyer ====================================
Route::match(['get','post'],'buyer-login','BuyerloginController@buyerlogin'); //from websitelink
Route::group(['middleware' => 'is_buyer'], function () {
Route::get('buyer-profile','BuyerController@buyerprofile'); //from websitelink
Route::post('buyprofileupdate','BuyerController@buyprofileupdate'); 
//from websitelink

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