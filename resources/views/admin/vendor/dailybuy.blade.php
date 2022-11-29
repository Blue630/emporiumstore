@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daily Buy Report</h1>
                </div>
                @if($success=Session::get('success'))
                <div class="alert alert-success">{{$success}}</div>
                @endif
              
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
            <div class="alert alert-warning"><b>Daily Buy Report</b></div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Vendor Name</th>
                                <th>Today Sale</th>
                                <th>Total Sale</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @php 
                            $srn=1;
                        @endphp
                           @if($dailysale)
                                
                                 @foreach($dailysale as $allsale)
                                <tr>
                                <td>{{$srn}}</td>
                                <td>
                                
                               @php $vendor=App\commonmodel::findbuyer($allsale->user_id); @endphp
                               @if(!empty($vendor)){{$vendor->name}} ({{$vendor->email}})@endif
                                </td>
                                <td> @php $todaysale=App\commonmodel::todaybuy($allsale->user_id); @endphp {{$todaysale}}</td>
                                <td> {{$allsale->total}}</td>
                                
                                
                            </tr>
                            @php $srn++ @endphp
                                @endforeach
                               
                           @endif
                            
                           
                            
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                 <th>S.No.</th>
                                <th>Vendor Name</th>
                                <th>Today Sale</th>
                                <th>Total Sale</th>   
                            </tr>
                        </tfoot>


                    </table>

                  
                    
                </div>

            </div>

        </div>
    </section>

</div>
@section('script')

<!-- page script -->
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).ready(function() {
        $('#example1').DataTable();
        $('#example2').DataTable();
    });
</script>

   
 
@stop @endsection