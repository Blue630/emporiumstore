 @extends('vendor.layout.layout')
 @section('content')
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/vendor/manageorder')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">

          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              @if($orderdetail)
              Name: {{$orderdetail[0]->first_name}}&nbsp; {{$orderdetail[0]->last_name}}&nbsp;
              Email: {{$orderdetail[0]->email}}<br>
              companyname:  {{$orderdetail[0]->companyname}}<br>
              address:  {{$orderdetail[0]->address}}<br>
              city:  {{$orderdetail[0]->city}}<br>
              state:  {{$orderdetail[0]->state}}<br>
              OrderID:  {{$orderdetail[0]->orderid}}<br>
                Products Details<br>
                <tabel border="1" class="table table-bordered table-striped">
                <tr>
                        <td>Serail</td>
                        <td>Product</td>
                        <td>Qty</td>
                        <td>Price</td>
                        
                    </tr>
                    @php $srn=1;@endphp
                <!--Loop start-->
                @foreach($orderdetail as $orders)
                    <tr>
                        <td>{{$srn}}</td>
                        <td>{{$orders->productname}}</td>
                        <td>{{$orders->quantity}}</td>
                        <td>{{$orders->orderid}}</td>
                        
                    </tr>
                    @php $srn++;@endphp
                @endforeach
                </tabel>
                <!--Loop end-->
                
              @endif
               </div>

            </div>
            <div class="">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
           
           
          </div>

        </div>

      </div>
    </section>

  </div>
  
@endsection
  