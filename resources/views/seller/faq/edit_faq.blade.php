@extends('admin.layout.layout')
 @section('content')
@php
use App\Product;
@endphp
<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Auction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/seller/managefaq')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <div class="container">
            <?php
            if($errors->first('question')!="")
            {
            ?>
            <div class="alert alert-danger">{{$errors->first('question')}}</div>
            <?php
            }
            ?>
            </div>
            @if($msg=Session::get('success'))
            <div class="alert alert-success">{{$msg}}</div>
            @endif
            <form method="post" action="{{url('seller/editfaq')}}/{{$faqdetail->id}}" enctype="multipart/form-data" onsubmit="onSubmit">
              @csrf
            <div class="content">
            <div class="container-fluid">
            <div class="card card-default">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product</label>
                            <select id="product_id" style="width: 100%;" name="product_id" class="form-control">
                                <option value="" >Select Product</option>
                                @if($products)
                                @foreach($products as $allproduct)
                                <option value="{{$faqdetail->product_id}}" @if($faqdetail->product_id==$allproduct->id){{"selected"}}@endif>{{$allproduct->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Question</label>
                            <textarea id="question" class="form-control ckeditor" name="question" > @if($faqdetail){{$faqdetail->question}}@endif
                                </textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea id="answer" class="form-control ckeditor" name="answer" > @if($faqdetail){{$faqdetail->answer}}@endif
                                </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                <div class="form-group">
                <button type="submit" class="btn_submit btn btn-primary">Submit</button>
                </div>
                </div>                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
</script>
@endsection