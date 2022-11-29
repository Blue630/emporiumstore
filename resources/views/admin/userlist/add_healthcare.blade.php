@extends('admin.layout.layout')

 @section('content')
 <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Healthcare</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/manage_healthcare')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            @if($msg=Session::get('success'))
            <div class="alert alert-success">{{$msg}}</div>
            @endif
            <form method="post" action="{{url('admin/insert_healthcare')}}" enctype="multipart/form-data">
              @csrf
            <div class="row">
              
              <div class="col-md-12">

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" id="name" class="form-control">
                </div>

                  <div class="form-group">
                    <label>About Healthcare</label>
                  <textarea name="details" id="details" cols="30" rows="10" class="form-control"></textarea>
                  </div>

                  <div class="form-group">
                  <label>Facebook link</label>
                  <input type="text" name="facebook_url" id="facebook_url" class="form-control">
                </div>

                <div class="form-group">
                  <label>Skpe Id</label>
                  <input type="text" name="skype_url" id="skype_url" class="form-control">
                </div>

                <div class="form-group">
                  <label>Twitter link</label>
                  <input type="text" name="twitter_url" id="twitter_url" class="form-control">
                </div>


                <div class="form-group">
                  <label>Speciality</label>
                  <input type="text" name="speciality" id="speciality" class="form-control">
                </div>


                <div class="form-group">
                  <label>Education</label>
                  <textarea name="education" id="education" cols="30" rows="10" class="form-control"></textarea>
                </div>


                <div class="form-group">
                  <label>Experience</label>
                  <textarea name="exper" id="exper" cols="30" rows="10" class="form-control"></textarea>
                </div>


                <div class="form-group">
                  <label>Dob</label>
                  <input type="text" name="dob" id="dob" class="form-control">
                </div>


                <div class="form-group">
                  <label>Age</label>
                  <input type="text" name="age" id="age" class="form-control">
                </div>


                <div class="form-group">
                  <label>Height</label>
                  <input type="text" name="height" id="height" class="form-control">
                </div>



                <div class="form-group">
                  <label>Eyes</label>
                  <input type="text" name="eyes" id="eyes" class="form-control">
                </div>



                <div class="form-group">
                  <label>Website url</label>
                  <input type="text" name="website_url" id="website_url" class="form-control">
                </div>

                <div class="form-group">
                  <label>Profile Image</label>
                 <input type="file" name="image" id="image" class="form-control">
                </div>


              </div>

            </div>
            <div class="">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
           
          </div>

        </div>

      </div>
    </section>

  </div>

  @section('script')
  <script>
    CKEDITOR.replace( 'details' );    
</script>
  @stop
@endsection
  