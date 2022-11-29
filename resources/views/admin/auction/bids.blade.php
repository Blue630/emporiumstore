@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<style>
.content-header .breadcrumb {
margin-left: 20px;
}
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Bids</h1>
    </div>
    <!-- /.col -->
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
                <div class="card-body">
                 <form name="sortbyfrm" id="sortbyfrm" method="post" action="{{url('admin/bids')}}/{{$auction_id}}">
@csrf
                <div class="row">
                <div class="col-sm-4 sortby">
                <div class="flt-lft">
                <label>Status :
                <select class="form-control" name="bid_status_filter" id="bid_status_filter" >
                <option value="">Choose</option>
                <option value="1">Bid Place</option>
                <option value="2">Bid Awarded (Due for Payment)</option>
                <option value="3">Bid Proceed</option>
                <option value="4">Bid Decline</option> 
                <option value="5">Bid Expired</option>
                <option value="6">Bid Close</option>
                </select>
                </label>
                </div>
                </div>
                <div class="col-sm-4 date-pickme">
                <div class="flt-lft">
                <label class="d-flex align-items-center">Date:
                <div class="input-group ml-2">
                <input type="date" name="date" class="form-control float-right">
                </div>
                </label>
                </div>
                </div>
                <div class="col-sm-3 search-ord">
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Search..">
                </div>
                <div class="col-sm-1">
                <button type="submit" class="btn btn-block btn-primary">Go!</button>
                </div>
                </div>
                </form>
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                               
                                <th>User Id</th>
                                <th>Username</th>
                                <th>Bid Amount</th>
                                <th>Bid Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $srn=1;
                            @endphp
                            @if($bids)
                            @foreach($bids as $bid)
                         
                            <tr>
                               
                                <td>{{$bid->u_id}}</td>
                                <td>{{$bid->uname}}</td>
                                <td class="bid_amount">{{$bid->bid}}</td>
                                <td class="bid_date">{{$bid->bcreated_at}}</td>
                             
                                 <td>
   @php echo($bid->bstatus == 1)? "Bid Place":"" @endphp
   @php echo($bid->bstatus == 2)? "Bid Awarded (Due for Payment)":"" @endphp
   @php echo($bid->bstatus == 3)? "Bid Proceed":"" @endphp
   @php echo($bid->bstatus == 4)? "Bid Decline":"" @endphp
   @php echo($bid->bstatus == 5)? "Bid Expired":"" @endphp
   @php echo($bid->bstatus == 6)? "Bid Close":"" @endphp
                                 
                                </td>
                            </tr>
                            @php $srn++ @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $bids->links() !!}
                    </div>
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
@section('script')

<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
@stop @endsection