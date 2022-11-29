<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Str;
class VendorController extends Controller
{

    public function dashboard()
    {   
        return view('vendor/dashboard/dashboard');
    }
    function vendorregister(Request $req)
    {
        if($req->isMethod('post'))
        {
            // return $req->all();
            $active=0;
            if($req->user_type=='1'){$active=2;}
            if($req->user_type=='0'){$active=1;}
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
                'created_date'=>date('Y-m-d'),
                'status'=>$active
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
            if(DB::table('vendor_retailer')->insert($addData))
            {
                return back()->with('success','Successfully created your vendor acoount');
            }
            else
            {
                return back()->with('error','Unable to register. Please try again');
            }
            
        }
        return view('vendor/vendor-register');
    } 
    function vendorprofile($storeslug)
    {
        // return $storeslug;
        //$createdby=Session()->get('logged_vendor')->id;
        $vendordetail=DB::table('vendor_retailer')->where('storeslug',$storeslug)->first();
        $createdby=$vendordetail->id;
        $vendorproduct=DB::table('products')->where(array('createdby'=>$createdby))->whereIn('status',array(1,2))->orderBy('id','desc')->get();
        return view('vendor/vendor-profile',['vendordetail'=>$vendordetail,'vendorproduct'=>$vendorproduct]);
    }
    
    
    function upload_image($file,$time)
    {
        $imagename=$time.'_'.$file->getClientOriginalName();
        $file->move(public_path('vendor/'),$imagename);
    }

    // products
    function addprodouct(Request $req)
    {   
        $createdby=Session()->get('logged_vendor')->id;
        if($req->isMethod('post'))
        {   
            $this->validate($req,
            [
            'productnumber'=>'unique:products,productnumber'
            ],
            [
                'productnumber.unique'=>'Product Number Already Exist'
            ]);
            $addData=array(
                'catid'=>$req->input('catid'),
                'price'=>$req->input('price'),
                'productnumber'=>$req->input('productnumber'),
                'createdby'=>$createdby,
                'created_at'=>date('Y-m-d'),
                'status'=>1
            );
            DB::table('products')->insert($addData);
            return back()->with('success','Successfully added product');
        }
        $cate=DB::table('category')->orderBy('id','desc')->get();
        return view('vendor/product/add_product',['cate'=>$cate]);
        
    }

    function manageproduct()
    {   
        $createdby=Session()->get('logged_vendor')->id;
        // $product=DB::table('products')->where(array('createdby'=>$createdby))->whereIn('status',array(1,2))->orderBy('id','desc')->get();
        $product=DB::table('products')->where(array('createdby'=>$createdby))->whereIn('status',array(1,2))->orderBy('id','desc')->get();
        // return $product;
        return view('vendor/product/manage_product',['product'=>$product]);  
    }

    function editproduct(Request $req, $id)
    {
        if($req->isMethod('post'))
        {
            $updateData=array(
                'catid'=>$req->input('catid'),
                'price'=>$req->input('price'),
                'productnumber'=>$req->input('productnumber'),
                'updated_at'=>date('Y-m-d'),
                'status'=>1
            );
            DB::table('products')->where('id',$id)->update($updateData);
            return back()->with('success','Successfully updated product');
        }
        $productdetail=DB::table('products')->where('id',$id)->first();
        $cate=DB::table('category')->orderBy('id','desc')->get();
        return view('vendor/product/edit_product',['productdetail'=>$productdetail,'cate'=>$cate]);
    }

    function manageorder()
    {
        $order=DB::table('order_history')->where('usertype','site')->orderBy('id','desc')->get();
        $buyerorder=DB::table('order_history')->where('usertype','buyer')->orderBy('id','desc')->get();

        
        return view('vendor/order/manageorder',['order'=>$order,'buyerorder'=>$buyerorder]);
    }
    function orderdetails($orderid)
    {
        //return $orderid;
        $orderdetail=DB::table('order_history')->where('orderid',$orderid)->get();
        //return $orderdetail;
        return view('vendor/order/orderdetail',['orderdetail'=>$orderdetail]);
    }

    function storeupdate(Request $req)
    {       
        $id=Session()->get('logged_vendor')->id;
        if($req->IsMethod('post'))
        {   
                $updateData=array('storedetail'=>$req->storedetail);
                DB::table('vendor_retailer')->where('id',$id)->update($updateData);
                return back()->with('success','Updated Store Details');
        }
        $storedata=DB::table('vendor_retailer')->where('id',$id)->first();
        // return $storedata;
        return view('vendor/store/storeinfo',['storedata'=>$storedata]);
    }

     // send porting code
     function sendportingcode(Request $req)
     {
         $this->sendto=strtolower($req->sendto);
         $prodnumber=$req->prodnumber;
         $portingcode=$req->portingcode;
         $dataset=array('prodnumber'=>$prodnumber,'portingcode'=>$portingcode);
         $res=  Mail::send('vendor/mailer/porting',$data =
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
         $createdby=Session()::get('logged_vendor')->id;
         $data = array_map('str_getcsv', file($path));
         $i=0;
         foreach($data as $alldata)
         {   if($i!=0){
             
                 $productnumber=$alldata[0];
                 $catid=$alldata[1];
                 $price=$alldata[2];
                 $createdby=$createdby;
                 $created_at=date('Y-m-d');
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
        return view('vendor/order/managebuyerorder',['order'=>$order,'buyerorder'=>$buyerorder]);
    }

}
