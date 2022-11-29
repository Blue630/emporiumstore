@extends('front.layout.layout') 
    @section('content')  
            <div id="main">
                <div class="section section-bg-53 section-cover pt-10 pb-10">
					<div class="bg-overlay"></div>
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="text-center">
									<h2 class="fz-70 white"><b>{{$vendordetail->storename}}</b></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="section pt-5 pb-10 text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 wow wobble" data-wow-duration="2s" data-wow-delay="0.5s">
                                <h2 class="fz-30 mb-3">{{$vendordetail->storename}}</h2>
                                {!! $vendordetail->storedetail !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section section-cover section-bg-52 pt-10 pb-10">
                    <div class="bg-overlay-white"></div>
                    <div class="container-fluid">
                        <div class="row">
                        @if($vendorproduct)
                                    @foreach($vendorproduct as $allproduct)
                                    <div class="col-md-3 mb-3 wow flipInX" data-wow-duration="2s" data-wow-delay="0.5s">
                                        <div class="item-div">
                                            <div class="content-box text-center">
                                                <div class="content-box-1">
                                                    <h2>{{$allproduct->productnumber}}</h2>
                                                    <p><b>Price:</b> <i class="fa fa-inr"></i> {{$allproduct->price}}/-</p>
                                                    <div class="row pt-4">
                                                        <div class="col-sm-6 col-6">
                                                            <a href="#" class="btn btn-rounded btn-bg-dark"><span>Enquiry Now</span></a>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                            <a href="{{url('/cart/addtoCart')}}/{{$allproduct->id}}" class="btn btn-rounded btn-bg-dark">Add to Card</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                    
                                   
                                </div>
                    </div>
                </div>
            </div>
          @endsection