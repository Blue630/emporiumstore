@extends('front.layout.layout') 
    @section('content')
            <div id="main">
                <div class="section section-bg-53 section-cover pt-10 pb-10">
                    <div class="bg-overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <h2 class="fz-70 white"><b>Become a Partner</b></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section pb-6">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6 pt-5 pb-5">
                            @if($success=Session::get('success'))
                            <p style="color:green;"><b>{{$success}}</b></p>
                            @endif

                            @if($error=Session::get('error'))
                                <p style="color:red"><b>{{$error}}</b></p>
                            @endif
                                <!--<h2 class="fz-24 text-center"><b>Become a Partner</b></h2>-->
                                <form class="login" action="{{url('vendor-register')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="username">Name <span class="required">*</span></label>
                                            <input type="text" class="input-text" name="name" id="name" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="email">Email <span class="required">*</span>  {{$errors->first('email')}}</label>
                                            <input type="email" class="input-text" name="email" id="email" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phone">Phone <span class="required">*</span></label>
                                            <input type="number" class="input-text" name="phone" id="phone" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="password">Password <span class="required">*</span></label>
                                            <input class="input-text" type="password" name="password" id=""required  />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="password">Confirm Password <span class="required">*</span> {{$errors->first('cpassword')}}</label>
                                            <input class="input-text" type="password" name="confirmpass" id="" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="sname">Store Name <span class="required">*</span></label>
                                            <input type="text" class="input-text" name="storename" id="storename" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="address">Address <span class="required">*</span></label>
                                            <input type="text" class="input-text" name="address" id="address" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="stype">Select Type<span class="required">*</span></label> <select name="user_type" id="user_type" required>
                                                <option value="1">Seller</option>
                                                <option value="0">Buyer</option>
                                            </select>                                          

                                        </div>
                                        <div class="col-md-12">
                                            <label for="aadharcard">Aadhar Card <span class="required">*</span></label>
                                            <input type="file" class="input-text" name="adharcarimg" id="adharcarimg" required/>
                                        </div>  
                                        <div class="col-md-12">
                                            <label for="pancard">Pan Card <span class="required">*</span></label>
                                            <input type="file" class="input-text" name="pancardimg" id="pancardimg" required/>
                                        </div>                                          
                                        <div class="col-md-12">
                                            <!-- <a class="btn btn-bg-dark mb-1" href="#">Submit</a> -->
                                            <input type="submit" value="Submit" class="btn btn-bg-dark mb-1">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection