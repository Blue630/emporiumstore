@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lazor Report</h1>
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
            <div class="alert alert-warning"><b>Lazor Report</b></div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Buyer Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @php 
                            $srn=1;
                        @endphp
                           @if($report)
                                
                                 @foreach($report as $allreport)
                                <tr>
                                <td>{{$srn}}</td>
                                <td>
                                
                               @php $wallet_detail=App\commonmodel::wallet_detail($allreport->token); @endphp
                               @if(!empty($wallet_detail)){{$wallet_detail->name}} ({{$wallet_detail->email}})@endif
                                </td>
                                <td>@if(!empty($wallet_detail)){{$wallet_detail->amount}} @endif</td>
                                
                                <td><a href="#" class="paybtn" id="{{$allreport->token}}">Make Done</a></td>
                                
                                
                            </tr>
                            @php $srn++ @endphp
                                @endforeach
                               
                           @endif
                            
                           
                            
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Buyer Name</th>
                                <th>Amount</th>
                                <th>Action</th>  
                            </tr>
                        </tfoot>


                    </table>

                  
                    
                </div>

            </div>

        </div>
    </section>

</div>
@section('script')

<script>
    $(document).ready(function() {
        $('.paybtn').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure want to complete ?')) {
                document.location.href = '{{url("/admin/walletupdate")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
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