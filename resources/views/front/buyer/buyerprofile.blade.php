@extends('front.layout.layout') 
    @section('content')
            <div id="main">
                <div class="section section-bg-53 section-cover pt-10 pb-10">
                    <div class="bg-overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <h2 class="fz-70 white"><b>Book VIP Number</b></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section pb-6 pt-6">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4 pb-4">
                                <img src="@if($buyerdetail->profile_img){{asset('/public/uploads/buyer')}}/{{$buyerdetail->profile_img}}@else{{asset('/public/uploads/buyer')}}/{{'demo.jpg'}}@endif" class="img-fluid img-thumbnail w-100">
                                @php 
                                    $wall=array();
                                    $wallnew=array();
                                @endphp
                                @if(!empty($wallet_his))
                                    @foreach($wallet_his as $history)
                                        @php array_push($wall,$history->payment_id);@endphp
                                    @endforeach
                                @endif
                                @if(!empty($order_detail))
                                @php $wallet=0;@endphp
                                  @php $totalprice=0;@endphp
                                        @foreach($order_detail as $allorder)
                                        @php 
                                       
                                         if(!(in_array($allorder->payment_id,$wall))){
                                           $totalprice=$allorder->total;
                                           $wallet=($wallet+(($totalprice*10)/100));
                                           array_push($wallnew,$allorder->payment_id);
                                         } 
                                         
                                        @endphp
                                        @endforeach
                                    
                                    <p ><b>Wallet Balance(INR):</b> <span style="color:green">@if($buyerdetail->wallet_status==0){{$wallet}}.00/ @else {{"00"}}@endif</span></p>
                                    <form action="{{url('/wallet_request')}}" method="post">
                                    @csrf
                                    <input type="submit" value="Redmee">
                                    <input type="hidden" value="{{$wallet}}" name="wallet_redmee" id="wallet_redmee" required>
                                    
                                    @if($wallnew)
                                         @foreach($wallnew as $all)
                                         <input type="hidden" value="{{$all}}" name="payment[]">
                                         @endforeach
                                    @endif
                                    
                                    </form>
                                @endif        
                            </div>
                            <div class="col-sm-8">
                                <p><b>Name:</b>@if($buyerdetail->name){{$buyerdetail->name}}@endif<button class="btn btn-rounded btn-bg-dark" style="float: right;" data-toggle="modal" data-target="#exampleModalCenter"><a href="#" style="color: #fff;">Edit Profile</a></button> </p>
                                <p><b>Email:</b> @if($buyerdetail->email){{$buyerdetail->email}}@endif</p>
                                <p><b>Phone:</b> +91 @if($buyerdetail->phone){{$buyerdetail->phone}}@endif</p>
                                <p><b>Store Name:</b> @if($buyerdetail->storename){{$buyerdetail->storename}}@endif</p>
                                <p><b>Bio:</b> @if($buyerdetail->storedetail){{$buyerdetail->storedetail}}@endif </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            @if(!empty($order_detail))
                                <table class="table shop-cart">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Product</th>
                                            <th class="product-name">Price</th>
                                            <th class="product-subtotal">Total(10%)</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                   
                                    @php $totalprice=0;@endphp
                                        @foreach($order_detail as $allorder)
                                        <tr class="cart_item">
                                            <td class="product-name" data-title="Product">
                                                <a href="#">{{$allorder->productname}}</a>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <span class="amount"><i class="fa fa-inr"></i>{{$allorder->total}}</span>
                                            </td>
                                            <td class="product-subtotal" data-title="SubTotal">
                                                <span class="amount"><i class="fa fa-inr"></i>{{$allorder->total}}</span>
                                            </td>
                                        </tr>
                                        @php $totalprice=$totalprice+$allorder->total;@endphp
                                            @endforeach
                                        
                                       
                                    </tbody>
                                    <tfoot style="background: #eee;">
                                        <tr>
                                            <th class="product-thumbnail">Product</th>
                                            <th class="product-name">&nbsp;</th>
                                            <th class="product-subtotal">Total Price {{$totalprice}}/-</th>
                                        </tr>
                                    </tfoot>
                                   
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{url('/buyprofileupdate')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="buyer_id" value="@if($buyerdetail->id){{$buyerdetail->id}}@endif">
            <div class="form-group">
              <label>Profile Image</label>
            <input type="file" class="form-control" id="profile_img" name="profile_img" >
            </div>

            <div class="form-group">
              <label>Description</label>
           <textarea name="storedetail" id="storedetail" cols="30" rows="10" class="form-control">@if($buyerdetail->storedetail){{$buyerdetail->storedetail}}@endif</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
     
    </div>
  </div>
</div>
            @endsection

            <!-- Button trigger modal -->
