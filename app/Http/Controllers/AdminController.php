<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
// use App\commonmodel;
class AdminController extends Controller
{
//
function index()
{
return view('admin/index');
}

function adminlogin()
{
return view('auth/login');
}

/*Featured Product Package Seller Start*/
function add_featured_package(Request $req)
{
if($req->isMethod('post'))
{
$addData=array(
'price'=>$req->input('price'),
'status'=>1,
//'created_at'=>date('Y-m-d H:i:s')
);
DB::table('featured_package')->insert($addData);
return back()->with('success','Successfully added price for featured package');
}
return view('admin/featured_package/add_featured_package');
}
function manage_featured_package()
{
$featured_package=DB::table('featured_package')->orderBy('id','desc')->get();
return view('admin/featured_package/manage_featured_package',['featured_package'=>$featured_package]);
}

function edit_featured_package(Request $req, $id)
{        
if($req->isMethod('post'))
{
$updateDate=array(
'price'=>$req->input('price'),
'status'=>1
//'updated_at'=>date('Y-m-d H:i:s')
);

DB::table('featured_package')->where('id',$id)->update($updateDate);
return back()->with('success','Successfully updated featured package detail.');
}

$featured_packagedetail=DB::table('featured_package')->where('id',$id)->first();
return view('/admin/featured_package/edit_featured_package',['featured_packagedetail'=>$featured_packagedetail]);
}

function inactivefeatured_package($id)
{
DB::table('featured_package')->where('id',$id)->update(array('status'=>0));
return back();
}
function activefeatured_package($id)
{
DB::table('featured_package')->where('id',$id)->update(array('status'=>1));
return back();
}
/* Featured package product seller end*/

function add_slider(Request $req)
{
if($req->isMethod('post'))
{
$addData=array(
'url'=>$req->input('url'),
'created_date'=>date('Y-m-d H:i:s')
);
if($req->hasFile('image'))
{   
$time=time();
$file=$req->hasFile('image');
$addData['image']=$time.'_'.$req->image->getClientOriginalName();
$imagename=$time.'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('slider/'),$imagename);
}
DB::table('sliders')->insert($addData);
return back()->with('success','Successfully added slider');
}
return view('admin/slider/add_slider');
}
function manage_slider()
{
$slider=DB::table('sliders')->orderBy('id','desc')->get();
return view('admin/slider/manage_slider',['slider'=>$slider]);
}

function edit_slider(Request $req, $id)
{        
if($req->isMethod('post'))
{
$updateDate=array(
'url'=>$req->input('url'),
'modifiled_date'=>date('Y-m-d H:i:s')
);
if($req->hasFile('image'))
{   
$time=time();
$file=$req->hasFile('image');
$updateDate['image']=$time.'_'.$req->image->getClientOriginalName();
$imagename=$time.'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('slider/'),$imagename);
}
DB::table('sliders')->where('id',$id)->update($updateDate);
return back()->with('success','Successfully updated slider detail.');
}

$sliderdetail=DB::table('sliders')->where('id',$id)->first();
return view('/admin/slider/edit_slider',['sliderdetail'=>$sliderdetail]);
}
function deleteslider($id)
{
DB::table('sliders')->where('id',$id)->delete();
return back();
}
function inactiveslider($id)
{
DB::table('sliders')->where('id',$id)->update(array('status'=>0));
return back();
}
function activeslider($id)
{
DB::table('sliders')->where('id',$id)->update(array('status'=>1));
return back();
}

/* ----   Category Functions Starts Here ------ */


function add_cate(Request $req)
{
if($req->isMethod('post'))
{
$this->validate($req,
[    
'catname'=>'unique:category,catname'
]);
$addData=array(
'catname'=>$req->input('catname'),
'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('catname')))),
'cat_slug'=>Str::slug($req->input('catname'),'-'),
'created_date'=>date('Y-m-d H:i:s')
);
if($req->hasFile('categoryimg'))
{   
$time=time();
$file=$req->hasFile('categoryimg');
$addData['categoryimg']=$time.'_'.$req->categoryimg->getClientOriginalName();
$this->upload_catimage($req->categoryimg,$time);
}
DB::table('category')->insert($addData);
return back()->with('success','Successfully added category');
}
return view('admin/category/add_cate');
}


// manage category
function manage_cate()
{
$cate=DB::table('category')->orderBy('id','desc')->get();
return view('admin/category/manage_cate',['cate'=>$cate]);
}

// edit category
function edit_cate(Request $req, $id)
{

if($req->isMethod('post'))
{
/*$this->validate($req,
[
'catname'=>'unique:category,catname'
],
[
'catname.unique'=>'This category already exist'
]);*/
$updateDate=array(
'catname'=>$req->input('catname'),
'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('catname')))),
'cat_slug'=>Str::slug($req->input('catname'),'-'),
'modifiled_date'=>date('Y-m-d H:i:s')
);
if($req->hasFile('categoryimg'))
{   
$time=time();
$file=$req->hasFile('categoryimg');
$updateDate['categoryimg']=$time.'_'.$req->categoryimg->getClientOriginalName();
$this->upload_catimage($req->categoryimg,$time);
}
DB::table('category')->where('id',$id)->update($updateDate);
return back()->with('success','Successfully updated category details');
}

$catedetail=DB::table('category')->where('id',$id)->first();
return view('/admin/category/edit_cate',['catedetail'=>$catedetail]);
}



public function CategoryShowInMenu(Request $req){
$showinmenu = $req->showinmenu;
$showcount = DB::table('category')->where('show_in_menu',1)->where('status',1)->count();
if($showinmenu == 1){
if($showcount >= 3){

echo 'Three categories are selected Already';
}else{
DB::table('category')->where('id',$req->catid)->update(['show_in_menu' => $showinmenu]);
echo 'Category Selected Successfully';
}
}else{
DB::table('category')->where('id',$req->catid)->update(['show_in_menu' => $showinmenu]);
echo 'Category  UnSelected Successfully';
}

}


function deletecategory($id)
{
DB::table('category')->where('id',$id)->delete();
return back();
}
function inactivecategory($id)
{
DB::table('category')->where('id',$id)->update(array('status'=>0));
return back();
}
function activecategory($id)
{
DB::table('category')->where('id',$id)->update(array('status'=>1));
return back();
}


/* ----   Category Functions Ends Here ------ */


/* ----   Subcategory Functions Starts Here ------ */

// Add Subcategory
function add_subcat(Request $req)
{

if($req->isMethod('post'))
{
$this->validate($req,
[
'subcat'=>'unique:sub_category,name'
],
[
'subcat.unique'=>'This subcategory already exist'
]);
$addData=array(
'name'=>$req->input('subcat'),
'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('subcat')))),
'created_date'=>date('Y-m-d H:i:s'),
'cat_id'=>$req->input('cat')
);
if($req->hasFile('subcatimg'))
{   
$time=time();
$file=$req->hasFile('subcatimg');
$addData['image']=$time.'_'.$req->subcatimg->getClientOriginalName();
$imagename=$time.'_'.$req->subcatimg->getClientOriginalName();
$req->subcatimg->move(public_path('subcategory/'),$imagename);
}
DB::table('sub_category')->insert($addData);
return back()->with('success','Successfully added Subcategory');
}
return view('admin/subcategory/add_subcat');
}






// manage category
function manage_subcat()
{
$subcategory=DB::table('sub_category')->orderBy('id','desc')->get();
return view('admin/subcategory/manage_subcat',['subcategory'=>$subcategory]);
}




function edit_subcat(Request $req, $id)
{
if($req->isMethod('post'))
{
/*$this->validate($req,
[
'subcat'=>'unique:sub_category,name'
],
[
'subcat.unique'=>'This subcategory already exist'
]);*/
$updateDate=array(

'name'=>$req->input('subcat'),
'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('subcat')))),
'cat_id'=>$req->input('cat'),
'modifiled_date'=>date('Y-m-d H:i:s')
);

if($req->hasFile('subcatimg'))
{   
$time=time();
$file=$req->hasFile('subcatimg');
$updateDate['image']=$time.'_'.$req->subcatimg->getClientOriginalName();
$imagename=$time.'_'.$req->subcatimg->getClientOriginalName();
$req->subcatimg->move(public_path('subcategory/'),$imagename);
}

DB::table('sub_category')->where('id',$id)->update($updateDate);
return back()->with('success','Successfully updated Subcategory details');
}
$subcatdetail=DB::table('sub_category')->where('id',$id)->first();
return view('/admin/subcategory/edit_subcat',['subcatdetail'=>$subcatdetail]);
}




function deletesubcat($id)
{
DB::table('sub_category')->where('id',$id)->delete();
return back();
}


/* ----   Subcategory Functions Ends Here ------ */



/* ----   Specification Functions Starts Here ------ */

// Add specifications
function add_specs(Request $req)
{
$catArr = array();
if($req->isMethod('post'))
{
$this->validate($req,
[
'specs'=>'unique:specifications,name'
],
[
'specs.unique'=>'Specification name already exist'
]);
$addData=array(
'name'=>$req->input('specs'),
'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('specs')))),
'created_at'=>date('Y-m-d H:i:s'),
'cat_id' => implode(",",(array)$req->input('cat')),
);
if($req->hasFile('specsimg'))
{   
$time=time();
$file=$req->hasFile('specsimg');
$addData['image']=$time.'_'.$req->specsimg->getClientOriginalName();
$imagename=$time.'_'.$req->specsimg->getClientOriginalName();
$req->specsimg->move(public_path('specifications/'),$imagename);
}
DB::table('specifications')->insert($addData);
return back()->with('success','Successfully added Specification');
}
return view('admin/specification/add_specs');
}






// manage Specification
function manage_specs()
{
$specification=DB::table('specifications')->orderBy('id','desc')->get();
return view('admin/specification/manage_specs',['specification'=>$specification]);
}




function edit_specs(Request $req, $id)
{
$catArr = array();
if($req->isMethod('post'))
{
/*$this->validate($req,
[
'specs'=>'unique:specifications,name'
],
[
'specs.unique'=>'Specification name already exist'
]);*/
$updateDate=array(

'name'=>$req->input('specs'),
'slug' => str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower($req->input('specs')))),
'cat_id' => implode(",",(array)$req->input('cat')),
'updated_at'=>date('Y-m-d H:i:s')
);

if($req->hasFile('specsimg'))
{   
$time=time();
$file=$req->hasFile('specsimg');
$updateDate['image']=$time.'_'.$req->specsimg->getClientOriginalName();
$imagename=$time.'_'.$req->specsimg->getClientOriginalName();
$req->specsimg->move(public_path('specifications/'),$imagename);
}

DB::table('specifications')->where('id',$id)->update($updateDate);
return back()->with('success','Successfully updated Subcategory details');
}
$specsdetail=DB::table('specifications')->where('id',$id)->first();
return view('/admin/specification/edit_specs',['specsdetail'=>$specsdetail]);
}




function deletespecs($id)
{
DB::table('specifications')->where('id',$id)->delete();
return back();
}


/* ----   Specification Functions Ends Here ------ */




/* ----   Option Functions Starts Here ------ */

// Add Option
function add_option(Request $req)
{

if($req->isMethod('post'))
{
$this->validate($req,
[
'option'=>'unique:options,name'
],
[
'option.unique'=>'Option name already exist'
]);
$addData=array(
'name'=>$req->input('option'),
'created_at'=>date('Y-m-d H:i:s'),
'specs_id'=>$req->input('specs')
);
if($req->hasFile('image'))
{   
$time=time();
$file=$req->hasFile('image');
$addData['image']=$time.'_'.$req->image->getClientOriginalName();
$imagename=$time.'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('option/'),$imagename);
}
DB::table('options')->insert($addData);
return back()->with('success','Successfully added Option');
}
return view('admin/option/add_option');
}






// manage Option
function manage_option()
{
$option=DB::table('options')->orderBy('id','desc')->get();
return view('admin/option/manage_option',['option'=>$option]);
}




function edit_option(Request $req, $id)
{
if($req->isMethod('post'))
{
/*$this->validate($req,
[
'option'=>'unique:options,name'
],
[
'option.unique'=>'Option name already exist'
]);*/
$updateDate=array(

'name'=>$req->input('option'),
'specs_id'=>$req->input('specs'),
'updated_at'=>date('Y-m-d H:i:s')
);
if($req->hasFile('image'))
{   
$time=time();
$file=$req->hasFile('image');
$updateDate['image']=$time.'_'.$req->image->getClientOriginalName();
$imagename=$time.'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('option/'),$imagename);
}

DB::table('options')->where('id',$id)->update($updateDate);
return back()->with('success','Successfully updated Option details');
}
$optiondetail=DB::table('options')->where('id',$id)->first();
return view('/admin/option/edit_option',['optiondetail'=>$optiondetail]);
}




function deleteoption($id)
{
DB::table('options')->where('id',$id)->delete();
return back();
}


/* ----   Option Functions Ends Here ------ */






/* ----   Pages Functions Starts Here ------ */



// manage Page
function manage_pages()
{
$page=DB::table('pages')->orderBy('id','desc')->get();
return view('admin/pages/manage_pages',['page'=>$page]);
}




function edit_aboutus(Request $req, $id)
{
if($req->isMethod('post'))
{
$updateDate=array(

'page_name'=>$req->input('page_name'),
'heading'=>$req->input('heading'),
'content'=>$req->input('content'),
'short_desc'=>$req->input('short_desc'),
'heading2'=>$req->input('heading2'),
'heading3'=>$req->input('heading3'),
'content2'=>$req->input('content2'),
'content6'=>$req->input('content6'),
'content4'=>$req->input('content4'),
'content5'=>$req->input('content5'),
'heading4'=>$req->input('heading4'),
'content3'=>$req->input('content3'),
'content7'=>$req->input('content7'),
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
return view('/admin/pages/edit_aboutus',['aboutusdetail'=>$aboutusdetail]);
}

function edit_content_page($id){
$contactusdetail=DB::table('pages')->where('id',$id)->first();
return view('/admin/pages/edit_contactus',['contactusdetail'=>$contactusdetail]);
}

function edit_content(Request $req, $id)
{

if($req->isMethod('post'))
{   
// dd($req);

$updateDate=array(

'heading'=>$req->input('heading'),
'description'=>$req->input('description'),
'bottom_heading'=>$req->input('bottom_heading'),
'heading_url'=>$req->input('heading_url'),
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
return view('/admin/pages/edit_content',['content'=>$content]);
}







/* ----   Pages Functions Ends Here ------ */






// products
function addprodouct(Request $req)
{
if($req->isMethod('post'))
{
$addData=array(
'catid'=>$req->input('catid'),
'price'=>$req->input('price'),
'productnumber'=>$req->input('productnumber'),
'createdby'=>0,
'created_at'=>date('Y-m-d H:i:s')
);
DB::table('products')->insert($addData);
return back()->with('success','Successfully added product');
}
$cate=DB::table('category')->orderBy('id','desc')->get();
return view('admin/product/add_product',['cate'=>$cate]);

}

// function manageproduct()
// {
//     $product=DB::table('products')->where(array('createdby'=>0,'status'=>1))->orderBy('id','desc')->get();
//     return view('admin/product/manage_product',['product'=>$product]);  
// }



function manageproduct(Request $request)
{

$term = $request->keyword;

$product = DB::table('products')->select('*','products.name as pname','products.id as pid','products.status as pstatus')
->join('users','products.user_id','users.id')
->where('products.name','LIKE','%'.$term.'%')
->orWhere('products.price','LIKE','%'.$term.'%')
->orWhere('products.quantity','LIKE','%'.$term.'%')
->orWhere('users.u_id','LIKE','%'.$term.'%')
->orWhere('users.name','LIKE','%'.$term.'%')
->orderBy("products.id","desc")->paginate(10);


if(!empty($request->sortbycategoryid)){
$sortbycategoryids = $request->sortbycategoryid;
$product = DB::table('products')->select('*','products.name as pname','products.id as pid','products.status as pstatus')
->join('users','products.user_id','users.id')
->Where('products.catid', 'Like', '%'.$sortbycategoryids.'%')
->orderBy("products.id","desc")->paginate(10);
}
elseif(!empty($request->sortbydeals)){
$sortbydeals = $request->sortbydeals;
if($sortbydeals==1)
{
$col_name = 'todaydeal';
$val = 1;
}
elseif($sortbydeals==2)
{
$col_name = 'weeklydeal';
$val = 1;
}
elseif($sortbydeals==3)
{
$col_name = 'monthlydeal';
$val = 1;
}
elseif($sortbydeals==4)
{
$col_name = 'season';
$val = 1;
}
elseif($sortbydeals==5)
{
$col_name = 'trending';
$val = 1;
}
$product = DB::table('products')->select('*','products.name as pname','products.id as pid','products.status as pstatus')
->join('users','products.user_id','users.id')
->Where("products.$col_name", 'Like', '%'.$val.'%')
->orderBy("products.id","desc")->paginate(10);
}
$sortbystatus = $request->sortbystatus;
if($sortbystatus!="")
{
$sortbystatus = $request->sortbystatus;
if($sortbystatus==1)
{
$col_name = 'status';
$val = 1;
}
elseif($sortbystatus==0)
{
$col_name = 'status';
$val = 0;
}
$product = DB::table('products')->select('*','products.name as pname','products.id as pid','products.status as pstatus')
->join('users','products.user_id','users.id')
->Where("products.$col_name", 'Like', '%'.$val.'%')
->orderBy("products.id","desc")->paginate(10);
}

$cate=DB::table('category')->orderBy('id','desc')->get();
$subcate=DB::table('sub_category')->orderBy('id','desc')->get();
return view('admin/product/manage_product',['product'=>$product,'cate'=>$cate]);
}


/*function editproduct(Request $req, $id)
{
if($req->isMethod('post'))
{
$updateData=array(
'catid'=>$req->input('catid'),
'price'=>$req->input('price'),
'productnumber'=>$req->input('productnumber'),
'createdby'=>0,
'updated_at'=>date('Y-m-d H:i:s')
);
DB::table('products')->where('id',$id)->update($updateData);
return back()->with('success','Successfully updated product');
}
$productdetail=DB::table('products')->where('id',$id)->first();
$cate=DB::table('category')->orderBy('id','desc')->get();
return view('admin/product/edit_product',['productdetail'=>$productdetail,'cate'=>$cate]);
}*/


function editproduct(Request $req, $id)
{
    $zipcode = array();
    //$createdby=auth()->user()->id;  
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
            //'user_id'=>$createdby,
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
            else
            {
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
    return view('admin/product/edit_product',['productdetail'=>$productdetail,'cate'=>$cate,'subcate'=>$subcate,'postal_code'=>$postal_code]);
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
    
    ?>
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
    <input type="button" value="Add More"  onClick="addRow()" />
<?php
}

function updateproduct(Request $request)
{
$todaydeal = isset($_REQUEST['todaydeal']) ? "1" : "0";
$weeklydeal = isset($_REQUEST['weeklydeal']) ? "1" : "0";
$monthlydeal = isset($_REQUEST['monthlydeal']) ? "1" : "0";
$seasondeal = isset($_REQUEST['season']) ? "1" : "0";
$trendingdeal = isset($_REQUEST['trending']) ? "1" : "0";
$is_admin_featured = isset($_REQUEST['is_admin_featured']) ? "1" : "0";
$product_id = $request->id;
//$todaydeal = $request->todaydeal;
if($product_id!="")
{
$updateData=array(
'todaydeal'=>$todaydeal,
'weeklydeal'=>$weeklydeal,
'monthlydeal'=>$monthlydeal,
'season'=>$seasondeal,
'trending'=>$trendingdeal,
'is_admin_featured'=>$is_admin_featured,
'updated_at'=>date('Y-m-d H:i:s')
);
DB::table('products')->where('id',$product_id)->update($updateData);
return back()->with('success','Successfully updated product');   
}
}

// user list
function manageusers()
{
$users=DB::table('userregister')->where('status',1)->orderBy('id','desc')->get();
return view('admin/userlist/manage_user',['users'=>$users]);
}
// order list
function manageorder(Request $request)
{       


$orders = DB::table('order_detail')->select('*','sellers.u_id as su_id','users.name as bname','products.name as pname','orders.id as ouid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity','products.image as pimage')->join('orders','orders.id','order_detail.order_id')->join('users','users.id','orders.buyer_id')->join('products','products.id','order_detail.product_id')->join('sellers','sellers.user_id','order_detail.seller_id')->where([
[function ($query) use ($request){
if($request->filled('order_status')){

$query->Where('orders.status', $request->order_status);
}

if($request->filled('date')){
//echo $request->date;
// dd($request);
$query->orWhere('orders.created_at', $request->date);

}

if($request->filled('search')){

$query->orWhere('orders.oid', 'like', '%' . $request->search . '%');
$query->orWhere('sellers.u_id', 'like', '%' . $request->search . '%');
$query->orWhere('products.name', 'like', '%' . $request->search . '%');
$query->orWhere('products.product_code', 'like', '%' . $request->search . '%');
$query->orWhere('users.name', 'like', '%' . $request->search . '%');
$query->orWhere('order_detail.quantity', 'like', '%' . $request->search . '%');
$query->orWhere('orders.totalamount', 'like', '%' . $request->search . '%');   
}

}]
])->orderBy("orders.id","desc")->paginate(10);

return view('admin/order/manageorder',['orders'=>$orders]);
}
function orderDetails($orderid)
{
$orderdetail = DB::table('order_detail')->select('*','sellers.u_id as su_id','users.name as bname','products.name as pname','orders.oid as ouid','orders.uid as buid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity','addresses.address as baddress')->join('orders','orders.id','order_detail.order_id')->join('users','users.id','orders.buyer_id')->join('products','products.id','order_detail.product_id')->join('buyers','buyers.uid','orders.uid')->join('sellers','sellers.user_id','order_detail.seller_id')->join('product_detail','product_detail.id','order_detail.variant_id')->join('addresses','addresses.id','orders.address_id')->Where('order_detail.order_id', $orderid)->first();

$orders = DB::table('order_detail')->select('*','sellers.u_id as su_id','users.name as bname','products.name as pname','orders.oid as ouid','orders.uid as buid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity','addresses.address as baddress')->join('orders','orders.id','order_detail.order_id')->join('users','users.id','orders.buyer_id')->join('products','products.id','order_detail.product_id')->join('buyers','buyers.uid','orders.uid')->join('sellers','sellers.user_id','order_detail.seller_id')->join('product_detail','product_detail.id','order_detail.variant_id')->join('addresses','addresses.id','orders.address_id')->Where('order_detail.order_id', $orderid)->get();



return view('admin/order/orderdetail',['orderdetail'=>$orderdetail],['orders'=>$orders]);
}





function managevendor()
{
$vendor=DB::table('vendor_retailer')->where('user_type','1')->whereIn('status',array(1,2))->orderBy('id','desc')->get();
$buyer=DB::table('vendor_retailer')->where('user_type','0')->whereIn('status',array(1,2))->orderBy('id','desc')->get();
return view('admin/vendor/managevendor',['vendor'=>$vendor,'buyer'=>$buyer]);
}

function deletevendor($id)
{
$updateData=array('status'=>0);
DB::table('vendor_retailer')->where('id',$id)->update($updateData);
return back();
}

function approvevendor($id)
{
$vendordetail=DB::table('vendor_retailer')->where(array('id'=>$id))->first();
$this->to=strtolower($vendordetail->email);
$this->name=$vendordetail->name;
$res=  Mail::send('admin/mailer/approvevendor',$data =
[
'vendordetail'=>$vendordetail 
],function($message){
// return $data;
$message->from('djsaluja18@gmail.com','Log Zero Technologies');
$message->to($this->to,$this->name);
$message->subject('Approval Notification');
});  
DB::table('vendor_retailer')->where('id',$id)->update(array('status'=>1));

return back()->with('success','Successfully send approval details');
}

function vendorproduct($id)
{
$product=DB::table('products')->where('createdby',$id)->orderBy('id','desc')->get();
return view('admin/vendor/vendorproduct',['product'=>$product]);  
}
// send porting code
function sendportingcode(Request $req)
{
$this->sendto=strtolower($req->sendto);
$prodnumber=$req->prodnumber;
$portingcode=$req->portingcode;
$dataset=array('prodnumber'=>$prodnumber,'portingcode'=>$portingcode);
$res=  Mail::send('admin/mailer/porting',$data =
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

}

function importcsvproduct(Request $req)
{
$path = $req->file('importcsv')->getRealPath();
$data = array_map('str_getcsv', file($path));
$i=0;
foreach($data as $alldata)
{   if($i!=0){

$productnumber=$alldata[0];
$catid=$alldata[1];
$price=$alldata[2];
$createdby=0;
$created_at=date('Y-m-d H:i:s');
DB::table('products')
->updateOrInsert(
['productnumber' => $productnumber],
['catid' => $catid, 'price' => $price,'createdby'=>$createdby,'created_at'=>$created_at]
);
}
$i++;
}
return back()->with('success','Successfully uploaded data');
}

function managebuyerorder()
{
$order=DB::table('order_history')->where('usertype','site')->orderBy('id','desc')->get();
$buyerorder=DB::table('order_history')->where('usertype','buyer')->orderBy('id','desc')->get();

return view('admin/order/managebuyerorder',['order'=>$order,'buyerorder'=>$buyerorder]);
}

function managebuyer()
{
$vendor=DB::table('vendor_retailer')->where('user_type','1')->whereIn('status',array(1,2))->orderBy('id','desc')->get();
$buyer=DB::table('vendor_retailer')->where('user_type','0')->whereIn('status',array(1,2))->orderBy('id','desc')->get();
return view('admin/vendor/managebuyer',['vendor'=>$vendor,'buyer'=>$buyer]);
}

function deleteuser($id)
{
//return $id;
DB::table('userregister')->where('id',$id)->update(array('status'=>0));
return back();
}

function vendor_buyer_details($id)
{
$vendordetail=DB::table('vendor_retailer')->where(array('id'=>$id))->first();
return view('admin/vendor/vendordetails',['vendordetail'=>$vendordetail]);
}

function deleteproduct($id)
{
DB::table('products')->where('id',$id)->delete();
DB::table('additional')->where('product_id',$id)->delete();
DB::table('product_detail')->where('product_id',$id)->delete();
return back();
}


function vendorregister(Request $req)
{
if($req->isMethod('post'))
{
// return $req->all();
$this->validate($req,
[
'email'=>'unique:vendor_retailer,email',
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
if($lastid=DB::table('vendor_retailer')->insertGetId($addData))
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
$vendordetail=DB::table('vendor_retailer')->where(array('id'=>$id))->first();
$this->name=$vendordetail->name;
$res=  Mail::send('admin/mailer/approvevendor',$data =
[
'vendordetail'=>$vendordetail 
],function($message){
// return $data;
$message->from('djsaluja18@gmail.com','Log Zero Technologies');
$message->to('dheeraj.saluja@logzerotechnologies.com',$this->name);
$message->subject('Approval Notification');
});  
// DB::table('vendor_retailer')->where('id',$id)->update(array('status'=>1));

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
return view('admin/vendor/dailysale',['dailysale'=>$dailysale]);
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
return view('admin/vendor/dailybuy',['dailysale'=>$dailysale]);
}

// BUYER MODULE FUNCTION STARTS HERE  --------

function buyerListing(Request $request){
if($request->filled('change_buyer_id') && $request->filled('change_status')){
$change_buyer_id = $request->change_buyer_id;

$updateData=array(
'status'=>$request->change_status
);
DB::table('buyers')->where('uid',$change_buyer_id)->update($updateData);
DB::table('users')->where('u_id',$change_buyer_id)->update($updateData);
return back()->with('success','Successfully updated user status');
}

if($request->filled('delete_buyer_id')){
$delete_buyer_id = $request->delete_buyer_id;
DB::table('buyers')->where('uid', $delete_buyer_id)->delete();

}

$buyer = DB::table('buyers')->select('*','buyers.status as bstatus','users.created_at as ucreatedat')->join('users', 'users.u_id', '=', 'buyers.uid')->join('addresses', 'addresses.user_id', '=', 'users.id')->where([
[function ($query) use ($request){
if($request->filled('buyer_status'))
{
    $query->Where('buyers.status', $request->buyer_status);
}

if($request->filled('date')){

// dd($request);
$query->orWhere('buyers.created_at', 'like', '%' . $request->date . '%');

}
if($request->filled('search')){

$query->orWhere('buyers.uid', 'like', '%' . $request->search . '%');
$query->orWhere('users.name', 'like', '%' . $request->search . '%');
$query->orWhere('users.email', 'like', '%' . $request->search . '%');
$query->orWhere('buyers.phone', 'like', '%' . $request->search . '%');
$query->orWhere('addresses.address', 'like', '%' . $request->search . '%');
$query->orWhere('addresses.pincode', 'like', '%' . $request->search . '%');
}

}]
])->orderBy("buyers.id","desc")->paginate(10);


return view('admin/buyer/buyer-listing',['buyers'=>$buyer]);
}


function buyerDetails(Request $request){
$buyer_id = $request->buyer_id;
$details = DB::table('buyers')->select('*','buyers.image as bimage')->join('users', 'users.u_id', '=', 'buyers.uid')->join('addresses', 'addresses.user_id', '=', 'users.id')->where('uid', $buyer_id)->first();
if($details->is_subscription == "1"){
$subscription = 'Yes';
}else{
$subscription = 'No';
}


$buyer_details = '<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname" style="padding-top:12px">Image : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span>&nbsp;
<a href="'.asset("public/front/img/".$details->bimage).'" target="_blank">
<img src="'.asset("public/front/img/".$details->bimage).'" class="img-responsive VD-img" alt="Image" width="60">
</a>
</span> 
</div>

</div>

<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">State : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$details->state.'</span>      
</div>

</div>

<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">District : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$details->city.'</span>
</div>        

</div>

<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">Subscription : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$subscription.'</span>
</div>        

</div>

<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">Subscription Amount : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp; '.$details->subscription_amount.'</span>
</div>

</div>';

return $buyer_details;
}

// BUYER MODULE FUNCTION ENDS HERE  --------


function withdrawfundrequestListing(){
$withdrawfundrequests = DB::table('withdrawl_request')->orderBy('id','desc')->paginate(12);
return view('admin/withdrawfundrequest',['withdrawfundrequests'=>$withdrawfundrequests]);
}


// SELLER MODULE FUNCTION STARTS HERE  --------

function sellerListing(Request $request){


if($request->filled('change_seller_id') && $request->filled('change_status')){
$change_seller_id = $request->change_seller_id;
$change_status = $request->change_status;
DB::table('sellers')->where('u_id', $change_seller_id)->update(['status' => $change_status]);
DB::table('users')->where('u_id', $change_seller_id)->update(['status' => $change_status]);

}

if($request->filled('delete_seller_id')){
$delete_seller_id = $request->delete_seller_id;
DB::table('sellers')->where('u_id', $delete_seller_id)->delete();

}

$sellers = DB::table('sellers')->where([
[function ($query) use ($request){
if($request->filled('seller_status')){

$query->Where('status', $request->seller_status);
}

if($request->filled('date')){
echo $request->date;
// dd($request);
$query->orWhere('created_at', 'like', '%' . $request->date . '%');

}
if($request->filled('search')){

$query->orWhere('u_id', 'like', '%' . $request->search . '%');
$query->orWhere('email', 'like', '%' . $request->search . '%');
$query->orWhere('phone', 'like', '%' . $request->search . '%');
$query->orWhere('address', 'like', '%' . $request->search . '%');
$query->orWhere('pincode', 'like', '%' . $request->search . '%');
}

}]
])->orderBy("id","desc")->paginate(10);


return view('admin/seller/seller-listing',['sellers'=>$sellers]);
}


function sellerDetails(Request $request){
$seller_id = $request->seller_id;
$details = DB::table('sellers')->where('u_id', $seller_id)->first();
if($details->is_subscription == "1"){

$subscription_details = DB::table('seller_subscriptions')->where('seller_id', $details->user_id)->first();

$subscription = 'Yes';
$amount = $subscription_details->amount;
$duration = $subscription_details->duration .'Months';
}else{

$subscription = 'No';
$amount = '';
$duration = '';
}



$seller_details = '     
<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname" style="padding-top:12px">Image : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span>&nbsp;
<a href="'.asset("public/front/img/".$details->image).'" target="_blank">
<img src="'.asset("public/front/img/".$details->image).'" class="img-responsive VD-img" alt="Image" width="60">
</a>
</span> 
</div>

</div>


<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">Storename : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$details->storename.'</span>      
</div>

</div>


<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">Business Reg No : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$details->business_reg_num.'</span>      
</div>

</div>

<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">VAT No : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$details->vat_number.'</span>      
</div>

</div>

<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">State : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$details->state.'</span>      
</div>

</div>



<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">Subscription : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp;'.$subscription.'</span>
</div>        

</div>';


if(!empty($amount)){    
$seller_details .= '<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">Subscription Amount : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp; '.$amount.'</span>
</div>

</div>';
}

if(!empty($duration)){     
$seller_details .= '<div class="row">

<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<p class="VD-fieldname">Subscription Duration : </p>
</div>
<div class="col-6 col-md-6 col-sm-6 col-xs-6 VD-column">
<span class="VD-fieldvalue">&nbsp; '.$duration.' </span>
</div>        

</div>';
}
return $seller_details;
}

// SELLER MODULE FUNCTION ENDS HERE  --------


function addsubscription(Request $req)
{
if($req->isMethod('post'))
{
$addData=array(
'plan_name'=>$req->input('plan_name'),
'duration'=>$req->input('duration'),
'product_limit'=>$req->input('product_limit'),
'price'=>$req->input('price'),
'created_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
DB::table('subscriptions')->insert($addData);
$id = DB::getPdo()->lastInsertId();
return back()->with('success','Successfully added subscription');
}
return view('admin/subscription/add_subscription');
}
function editsubscription(Request $req, $id)
{
if($req->isMethod('post'))
{
$updateData=array(
'plan_name'=>$req->input('plan_name'),
'duration'=>$req->input('duration'),
'product_limit'=>$req->input('product_limit'),
'price'=>$req->input('price'),
'updated_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
DB::table('subscriptions')->where('id',$id)->update($updateData);
return back()->with('success','Successfully updated subscription');
}
$subscriptiondetail=DB::table('subscriptions')->where('id',$id)->first();
return view('admin/subscription/edit_subscription',['subscriptiondetail'=>$subscriptiondetail]);
}
function managesubscription(Request $request)
{
$subscription = DB::table('subscriptions')->where([
[function ($query) use ($request){
if($term = $request->keyword){
$query->orWhere('plan_name', 'Like', '%'.$term.'%')->get();
}
}]
])
->orderBy("id","desc")->paginate(10);
return view('admin/subscription/manage_subscription',['subscription'=>$subscription]);
}
function inactivesubscription($id)
{
DB::table('subscriptions')->where('id',$id)->update(array('status'=>0));
return back();
}
function activesubscription($id)
{
DB::table('subscriptions')->where('id',$id)->update(array('status'=>1));
return back();
}

function addcommission(Request $req)
{
if($req->isMethod('post'))
{
$addData=array(
'commission'=>$req->input('commission'),
'created_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
DB::table('commissions')->insert($addData);
$id = DB::getPdo()->lastInsertId();
return back()->with('success','Successfully added commission');
}
return view('admin/commission/add_commission');
}
function editcommission(Request $req, $id)
{
if($req->isMethod('post'))
{
$updateData=array(
'subscription_commission'=>$req->input('subscription_commission'),
'commission'=>$req->input('commission'),
'updated_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
DB::table('commissions')->where('id',$id)->update($updateData);
return back()->with('success','Successfully updated commission');
}
$commissiondetail=DB::table('commissions')->where('id',$id)->first();
return view('admin/commission/edit_commission',['commissiondetail'=>$commissiondetail]);
}
function managecommission(Request $request)
{
$commission = DB::table('commissions')->where([
[function ($query) use ($request){
if($term = $request->keyword){
$query->orWhere('commission', 'Like', '%'.$term.'%')->get();
}
}]
])
->orderBy("id","desc")->paginate(10);
return view('admin/commission/manage_commission',['commission'=>$commission]);
}
function inactivecommission($id)
{
DB::table('commissions')->where('id',$id)->update(array('status'=>0));
return back();
}
function activecommission($id)
{
DB::table('commissions')->where('id',$id)->update(array('status'=>1));
return back();
}
function addcashback(Request $req)
{
if($req->isMethod('post'))
{
$this->validate($req,
[
'catid'=>'unique:cashbacks,catid'
],
[
'catid.unique'=>'Cashback for this category already exist'
]);
//echo "<pre>";print_r($_REQUEST);echo "</pre>";die;
$user_id = $req->input('user_id');
$user_ids = implode(",",(array)$user_id);
$subcat_id = $req->input('subcat_id');
$subcat_ids = implode(",",(array)$subcat_id);
$product_id = $req->input('product_id');
$product_ids = implode(",",(array)$product_id);
$addData=array(
'user_id'=>$user_ids,
'catid'=>$req->input('catid'),
'subcat_id'=>$subcat_ids,
'product_id'=>$product_ids,
'cashback'=>$req->input('cashback'),
'created_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
DB::table('cashbacks')->insert($addData);
$id = DB::getPdo()->lastInsertId();
return back()->with('success','Successfully added commission');
}
$cate=DB::table('category')->orderBy('id','desc')->get();
$subcate=DB::table('sub_category')->orderBy('id','desc')->get();
//$seller=DB::table('users')->where('user_type',2)->orderBy('id','desc')->get();
$seller=DB::table('sellers')->orderBy('id','desc')->get();
$product=DB::table('products')->orderBy('id','desc')->get();
return view('admin/cashback/add_cashback',['seller'=>$seller,'cate'=>$cate,'subcate'=>$subcate,'prodcut'=>$product]);
}
function editcashback(Request $req, $id)
{
if($req->isMethod('post'))
{
/*$this->validate($req,
[
'catid'=>'unique:cashbacks,catid'
],
[
'catid.unique'=>'Cashback for this category already exist'
]);*/
$user_id = $req->input('user_id');
$user_ids = implode(",",(array)$user_id);
$subcat_id = $req->input('subcat_id');
$subcat_ids = implode(",",(array)$subcat_id);
$product_id = $req->input('product_id');
$product_ids = implode(",",(array)$product_id);
$updateData=array(
'user_id'=>$user_ids,
'catid'=>$req->input('catid'),
'subcat_id'=>$subcat_ids,
'product_id'=>$product_ids,
'cashback'=>$req->input('cashback'),
'created_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
DB::table('cashbacks')->where('id',$id)->update($updateData);
return back()->with('success','Successfully updated cashback');
}
$cashbackdetail=DB::table('cashbacks')->where('id',$id)->first();
$cate=DB::table('category')->orderBy('id','desc')->get();
$subcate=DB::table('sub_category')->orderBy('id','desc')->get();
//$seller=DB::table('users')->where('user_type',2)->orderBy('id','desc')->get();
$seller=DB::table('sellers')->orderBy('id','desc')->get();
$product=DB::table('products')->orderBy('id','desc')->get();
return view('admin/cashback/edit_cashback',['seller'=>$seller,'cate'=>$cate,'subcate'=>$subcate,'prodcut'=>$product,'cashbackdetail'=>$cashbackdetail]);
}
function managecashback(Request $request)
{
$cashback = DB::table('cashbacks')->where([
[function ($query) use ($request){
if($term = $request->keyword){
$query->orWhere('cashback', 'Like', '%'.$term.'%')->get();
}
}]
])
->orderBy("id","desc")->paginate(10);
return view('admin/cashback/manage_cashback',['cashback'=>$cashback]);
}
function managefeature(Request $request)
{
$feature = DB::table('subscribe_products')->where('status',1)->orderBy("id","desc")->paginate(10);
return view('admin/feature/manage_feature',['feature'=>$feature]);
}
function getsubCat(Request $request)
{
$parent_id = $request->catId;
?>
<select class="multi2" id="subcat_id" multiple style="width:100%;" name="subcat_id[]" >
<!-- <option value="">--Select Sub Category--</option> -->
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
?>
</select>
<?php
}
function getproduct(Request $request)
{
$parent_id = $request->subcatId;
?>
<select class="multi3" id="product_id" multiple style="width:100%;" name="product_id[]" >
<!-- <option value="">--Select Product--</option> -->
<?php
$data=DB::table('products')->where('subcat_id',$parent_id)->get();

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
?>
</select>
<?php
}
function inactivecashback($id)
{
DB::table('cashbacks')->where('id',$id)->update(array('status'=>0));
return back();
}
function activecashback($id)
{
DB::table('cashbacks')->where('id',$id)->update(array('status'=>1));
return back();
}
function deletecashback($id)
{
DB::table('cashbacks')->where('id',$id)->delete();
return back();
}
function addcoupon(Request $req)
{
if($req->isMethod('post'))
{
$this->validate($req,
[
'name'=>'unique:coupons,name'
],
[
'name.unique'=>'Discount Coupon already exist'
]);
$addData=array(
'seller_id'=>$req->input('seller_id'),
'name'=>$req->input('name'),
'code'=>$req->input('code'),
'percent'=>$req->input('percent'),
'start_date'=>$req->input('start_date'),
'end_date'=>$req->input('end_date'),
'created_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
if($req->hasFile('image'))
{   
$time=time();
$file=$req->hasFile('image');
$addData['image']=$time.'_'.$req->image->getClientOriginalName();
$imagename=$time.'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('coupons/'),$imagename);
}
DB::table('coupons')->insert($addData);
$id = DB::getPdo()->lastInsertId();
return back()->with('success','Successfully added coupon');
}
return view('admin/coupon/add_coupon');
}
function editcoupon(Request $req, $id)
{
if($req->isMethod('post'))
{
/*$this->validate($req,
[
'name'=>'unique:coupons,name'
],
[
'name.unique'=>'Discount Coupon already exist'
]);*/
$updateData=array(
'seller_id'=>$req->input('seller_id'),
'name'=>$req->input('name'),
'code'=>$req->input('code'),
'percent'=>$req->input('percent'),
'start_date'=>$req->input('start_date'),
'end_date'=>$req->input('end_date'),
'updated_at'=>date('Y-m-d H:i:s'),
'status'=>1
);
if($req->hasFile('image'))
{   
$time=time();
$file=$req->hasFile('image');
$updateData['image']=$time.'_'.$req->image->getClientOriginalName();
$imagename=$time.'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('coupons/'),$imagename);
}
DB::table('coupons')->where('id',$id)->update($updateData);
return back()->with('success','Successfully updated coupon');
}
$coupondetail=DB::table('coupons')->where('id',$id)->first();
return view('admin/coupon/edit_coupon',['coupondetail'=>$coupondetail]);
}
function managecoupon(Request $request)
{
$coupon = DB::table('coupons')->where([
[function ($query) use ($request){
if($term = $request->keyword){
$query->orWhere('code', 'Like', '%'.$term.'%')->get();
}
if($term = $request->keyword){
$query->orWhere('name', 'Like', '%'.$term.'%')->get();
}
}]
])
->orderBy("id","desc")->paginate(10);
return view('admin/coupon/manage_coupon',['coupon'=>$coupon]);
}
function inactivecoupon($id)
{
DB::table('coupons')->where('id',$id)->update(array('status'=>0));
return back();
}
function activecoupon($id)
{
DB::table('coupons')->where('id',$id)->update(array('status'=>1));
return back();
}






// AUCTION FUNCTIONS STARTS HERE <<<<<<<


function addauction(Request $req)
{
$createdby=auth()->user()->id;

if($req->isMethod('post'))
{
/* $auto_close_bid = $req->input('auto_close_bid');
if($auto_close_bid=='on')
{
$close_bid = 1;
}
else
{
$close_bid = 0;
} */
$auction_time = strtotime($req->input('auction_time'));
$new_date = date('Y-m-d H:i:s', $auction_time);  
$addData=array(
'catid'=>$req->input('catid'),
'subcat_id'=>$req->input('subcat_id'),
'product_id'=>$req->input('product_id'),
'auction_time'=>date('Y-m-d H:i:s', $auction_time),
'minimum_cost'=>$req->input('minimum_cost'),
// 'auto_close_bid'=>$close_bid,
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
return view('admin/auction/add_auction',['cate'=>$cate,'subcate'=>$subcate,'product'=>$product]);
}
function editauction(Request $req, $id)
{
$createdby=auth()->user()->id;  
if($req->isMethod('post'))
{
/* $auto_close_bid = $req->input('auto_close_bid');
if($auto_close_bid=='on')
{
$close_bid = 1;
}
else
{
$close_bid = 0;
} */
$auction_time = strtotime($req->input('auction_time'));
$new_date = date('Y-m-d H:i:s', $auction_time);  
$updateData=array(
'catid'=>$req->input('catid'),
'subcat_id'=>$req->input('subcat_id'),
'product_id'=>$req->input('product_id'),
'auction_time'=>date('Y-m-d H:i:s', $auction_time),
'minimum_cost'=>$req->input('minimum_cost'),
// 'auto_close_bid'=>$close_bid,
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
return view('admin/auction/edit_auction',['auctiondetail'=>$auctiondetail,'products'=>$products,'cate'=>$cate,'subcate'=>$subcate]);
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
->orderBy("id","desc")->paginate(10);
$productdetail=DB::table('products')->orderBy('id','desc')->get();
$cate=DB::table('category')->orderBy('id','desc')->get();
$subcate=DB::table('sub_category')->orderBy('id','desc')->get();
return view('admin/auction/manage_auction',['cate'=>$cate,'auction'=>$auction,'productdetail'=>$productdetail]);
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

function productRating($product_id){
return view('/admin/product/product-rating',["product_id"=>$product_id]);
}


// AUCTION FUNCTION ENDS HERE >>>>>>>>


function wallet(Request $request)
{
$user_id = auth()->user()->id;
$transactions =DB::table('transaction_history')->where('admin_amount','!=',0)->where([
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
return view('admin/wallet',["transactions"=>$transactions]);
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




return view('admin/auction/bids',["bids"=>$bids,"auction_id"=>$auction_id]);
} 



public function ordersDetail(Request $request){
    
    
    
    
$orderdetail =DB::table('order_detail')->select('*','sellers.u_id as su_id','users.name as bname','products.name as pname','orders.oid as ouid','orders.uid as buid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity','addresses.address as baddress','transaction_history.id as trans_id','transaction_history.created_at as tdate')->join('orders','orders.id','order_detail.order_id')->join('users','users.id','orders.buyer_id')->join('products','products.id','order_detail.product_id')->join('buyers','buyers.uid','orders.uid')->join('sellers','sellers.user_id','order_detail.seller_id')->join('product_detail','product_detail.id','order_detail.variant_id')->join('addresses','addresses.id','orders.address_id')->join('transaction_history','transaction_history.order_detail_id','order_detail.id')->where('admin_amount','!=',0)->where([
[function ($query) use ($request){

if(!empty($request->transaction_type)){

if($request->transaction_type == 1){
    $cashback =DB::table('cart')->select('*',DB::raw('GROUP_CONCAT(product_id) as products_id'),DB::raw('GROUP_CONCAT(orderid) as order_id'))->where('cashback_paid','=',1)->first();
    
    $cashback_array = explode(',',$cashback->products_id);
    $cashback_order_id_array = explode(',',$cashback->order_id);
    $query->whereIn('order_detail.product_id', $cashback_array)->whereIn('orders.id', $cashback_order_id_array);
}   
else if($request->transaction_type == 4){
    $cashback =DB::table('cart')->select('*',DB::raw('GROUP_CONCAT(product_id) as products_id'),DB::raw('GROUP_CONCAT(orderid) as order_id'))->where('cashback_paid','=',0)->first();
    $cashback_array = explode(',',$cashback->products_id);
    $cashback_order_id_array = explode(',',$cashback->order_id);
    $query->whereIn('products.id', $cashback_array)->whereIn('orders.id', $cashback_order_id_array);
}else{
    // $query->whereIn('type', $request->transaction_type);
    $query->orWhere('type', 'IN', $request->transaction_type);
} 

    
    


}
$current_date = date("Y-m-d");
$compare_date = $current_date.' - '.$current_date;
if(!empty($request->selected_date) && $request->selected_date != $compare_date){
$dates = explode(" - ",$request->selected_date);
if(empty($dates[0])){
$dates[1] = '';
}
$query->whereBetween('orders.created_at', [$dates[0],$dates[1]]);
}
// if($request->filled('search')){
// $query->orWhere('amount', 'like', '%' . $request->search . '%');
// $query->orWhere('transaction_id', 'like', '%' . $request->search . '%');
// $query->orWhere('seller_amount', 'like', '%' . $request->search . '%');
// $query->orWhere('status', 'like', '%' . $request->search . '%');   
// }
}]
])->orderBy("order_detail.id","desc")->paginate(20);
    
    
    return view('admin/orders-detail',["orderdetail"=>$orderdetail]);
}

/*Update Payment Withdraw Status*/
function updatewithdrawfund(Request $request)
{
    /*echo "<pre>";
    print_r($_REQUEST);die;*/
    //'created_at'=>date("d-m-Y H:i:s")
    $payment_status = $_REQUEST['payment_status'];
    $withdraw_transaction_id = $_REQUEST['withdraw_transaction_id'];
    $pay_date = date("d-m-Y H:i:s");
    $request_id = $_REQUEST['id'];
    $order_id = $_REQUEST['order_detail_id'];
    $product_id = $_REQUEST['product_id'];
    $ex = explode(',', $product_id);
    foreach($ex as $pid)
    {
        /*$get_order_detail = DB::table('order_detail')->where(array('order_id'=>$order_id,'product_id'=>$pid))->first(); */
        $get_order_detail = DB::table('order_detail')->where(array('id'=>$order_id,'product_id'=>$pid))->first();
        $order_detail_id = $get_order_detail->id;
        $updatetransactionData=array(
        'seller_paid'=>$payment_status,
        'seller_pay_id'=>$withdraw_transaction_id,
        'seller_paid_on'=>date("d-m-Y H:i:s"),
        );
        DB::table('transaction_history')->where(array('product_id'=>$pid,'order_detail_id'=>$order_detail_id))->update($updatetransactionData);
    }
        if($request_id!="")
        {
            $updatewithdrawData=array(
            'payment_status'=>$payment_status,
            'withdraw_transaction_id'=>$withdraw_transaction_id,
            'pay_date'=>date("d-m-Y H:i:s")
            );
            DB::table('withdrawl_request')->where('id',$request_id)->update($updatewithdrawData);
            
            $get_withdrawl_request = DB::table('withdrawl_request')->where(array('id'=>$request_id))->first();
            
            $last_wallet_balance = $get_withdrawl_request->last_wallet_balance;
            $req_amount = $get_withdrawl_request->req_amount;
            $seller_id = $get_withdrawl_request->user_id;
            
            if($payment_status==0){
            $updateuserData=array(
            'wallet'=>$last_wallet_balance
            );
            DB::table('users')->where('id',$seller_id)->update($updateuserData);
            }
            return back()->with('success','Successfully updated payment withdraw status');
        }
    }
    
public function PaymentUpdatePage($main_id,$type){

    return view('admin/payment-update',["id"=>$main_id,"type"=>$type]);
    
}  

public function PaymentUpdate(Request $request){
    
    
    
    $date = date("d-m-Y H:i:s");
    
    if($request->type == 1){
        
        $seller_data = DB::table('transaction_history')->where('id',$request->id)->first();
        $user_id = $seller_data->user_id;
        $amount = $seller_data->seller_amount;
        
        $updateData = [
            "seller_paid"=>1,
            "seller_paid_on"=>$date,
            "seller_pay_id"=>$request->transaction_id,
            ];
        
        DB::table('transaction_history')->where('id',$request->id)->update($updateData);
        
        
        
    }
    else if($request->type ==2){
       
        $buyer_data = DB::table('cart')->where('id',$request->id)->first();
        $user_id = $buyer_data->user_id;
        $amount = $buyer_data->cashback;
       
       $updateData = [
            "cashback_paid"=>1,
            "cashback_paid_on"=>$date,
            "cashback_pay_id"=>$request->transaction_id,
            ];
       DB::table('cart')->where('id',$request->id)->update($updateData);
        
    }
    
       $user_data = DB::table('users')->where('id',$user_id)->first();
       $last_wallet_amount = $user_data->wallet;
       
       if($request->type == 1){
           $final_amount = $last_wallet_amount - $amount;
           
       }else if($request->type ==2){
           
           $final_amount = $last_wallet_amount + $amount;
       }
       
       DB::table('users')->where('id',$user_id)->update(array("wallet"=>$final_amount));
    return back()->with('success','Payment Status Updated');
}  


public function downloadproductsample()
{
    /*$profileusers=DB::table('profiles')->get();
    $profileuserscount = count($profileusers);
    if($profileuserscount>0)
    {*/
    $delimiter = ","; 
    $filename = "product_sample" . date('Y-m-d') . ".csv"; 
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
    // Set column headers 

    $fields = array('name', 'slug', 'image', 'catid', 'subcat_id', 'price', 'quantity', 'short_desc', 'description', 'user_id', 'is_featured', 'is_auction', 'is_active', 'is_subscribed', 'is_discount', 'meta_title', 'meta_keyword', 'meta_description', 'status', 'spec_detail', 'Product Image');
    fputcsv($f, $fields, $delimiter); 
    /*foreach($profileusers as $profileusers_result)
    {*/
    $lineData = array(); 
    fputcsv($f, $lineData, $delimiter); 
    /*}*/ 
    // Move back to beginning of file 
    fseek($f, 0); 
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    //output all remaining data on a file pointer 
    fpassthru($f); 
/*    }*/
    exit; 
}
    
}