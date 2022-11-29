@extends('front.layout.layout') 
    @section('content')
            <div id="main">
                <div class="section section-bg-53 section-cover pt-10 pb-10">
                    <div class="bg-overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <h2 class="fz-70 white"><b>Buyer Login</b></h2>
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
                                <h2 class="fz-24 text-center"><b>Buyer Login</b></h2>
                                <form class="login" action="{{url('buyer-login')}}" method="post">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                        @if($error=Session()->get('error'))<div class="alert alert-danger">{{$error}}</div>@endif
                                            <label for="username">Username or email address <span class="required">*</span></label>
                                            <input type="text" class="input-text" name="email" id="email" value="" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="password">Password <span class="required">*</span></label>
                                            <input class="input-text" type="password" name="password" id="password" />
                                        </div>
                                        <div class="col-md-12">
                                            <!-- <a class="btn btn-bg-dark mb-1" href="#">Login</a> -->
                                            <input type="submit" value="Login" class="btn btn-bg-dark mb-1">
                                            <a href="#">Lost your password?</a>
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