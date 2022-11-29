@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
    <div class="row gx-5 contactchats">
        <?php
        foreach($contact as $allcontact){
            ?>
        <div class="col-lg-6">
            <div class="chat_connect  shadow p-5 text-center">
                <i data-feather="headphones"></i>
                <h2>{{$allcontact->heading}}</h2>
                <small>{{strip_tags($allcontact->description)}}</small>
                <div class="devider"></div>
                <a href="{{$allcontact->heading_url}}" target="_blank" class="ft-medium">{{$allcontact->bottom_heading}}</a>
            </div>
        </div>
        <?php
    }
     ?>
    </div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px "></div>
@include('front.include.footer')
@yield('footer')
