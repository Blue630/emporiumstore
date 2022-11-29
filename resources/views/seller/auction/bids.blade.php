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
                 <form name="sortbyfrm" id="sortbyfrm" method="post" action="{{url('seller/bids')}}/{{$auction_id}}">
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
      <select class="form-control bid_status" name="bid_status" bid_id="{{$bid->bid_id}}" email="{{$bid->email}}" username="{{$bid->uname}}" product="{{$bid->pname}}"  @php echo(!empty($bid->bidding_id))? "disabled":"" @endphp >
                                    <option @php echo($bid->bstatus == 1)? "selected":"" @endphp value="1">Bid Place</option>
                                    <option @php echo($bid->bstatus == 2)? "selected":"" @endphp value="2">Bid Awarded (Due for Payment)</option>
                                    <option @php echo($bid->bstatus == 3)? "selected":"" @endphp value="3">Bid Proceed</option>
                                    <option @php echo($bid->bstatus == 4)? "selected":"" @endphp value="4">Bid Decline</option> 
                                    <option @php echo($bid->bstatus == 5)? "selected":"" @endphp value="5">Bid Expired</option>
                                    <option @php echo($bid->bstatus == 6)? "selected":"" @endphp value="6">Bid Close</option>
                                    </select>
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
    $(document).ready(function() {
        $('.delete_btn').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure want to delete ?')) {
                document.location.href = '{{url("/seller/deleteauction")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
    
    $(".bid_status").change(function(){
        let status = $(this).val();
        let bid_id = $(this).attr("bid_id");
        let email = $(this).attr("email");
        let username = $(this).attr("username");
        let product_name = $(this).attr("product");
        let bid_amount = $(this).parent().parent().find(".bid_amount").text();
        let bid_date = $(this).parent().parent().find(".bid_date").text();
        
        
     if (confirm('Are you sure want to change status ?')) { 
    $.ajax({
    type: "post",
    url: "{{url('seller/update-bid-status')}}",
    data:{"bid_id":bid_id,"status":status,"email":email,"username":username,"product_name":product_name,"bid_amount":bid_amount,"bid_date":bid_date, _token: '{{csrf_token()}}'},
    success: function(data){
        alert("Status Updated");
    window.location.reload();
    }
    })
     }
    })
    
</script>
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