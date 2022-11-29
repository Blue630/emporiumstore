@extends('admin.layout.layout') @section('content')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Orders</h1>
</div>
<!-- /.col -->
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Dashboard</li>
</ol>
</div>
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
<form method="post" action="{{url('/seller/manageorder')}}">
@csrf
<div class="row">


<?php
if($_REQUEST=="")
{
?>
<div class="col-sm-3 sortby">
<div class="flt-lft">
<label>Filter by:
<select class="form-control" name="order_status">
    <option selected="selected" value="">Status</option>
    <option value="1">Processing</option>
    <option value="2">Order in Transit</option>
    <option value="3">Order Delivered</option>
    <option value="4">Cancelled</option>
</select>   
</label>
</div>
</div>
<?php
}
else
{
$processselect  = "";
$transistselect = "";
$deliveredselected = "";
$cancelledselected = "";
//$order_status = $_REQUEST['order_status'];
if($_REQUEST=='page')
{
if($_REQUEST['order_status']==1)
{
    $processselect = "selected";
}
if($_REQUEST['order_status']==2)
{
    $transistselect = "selected";
}
if($_REQUEST['order_status']==3)
{
    $deliveredselected = "selected";
}
if($_REQUEST['order_status']==4)
{
    $cancelledselected = "selected";
}
}
?>
<div class="col-sm-3 sortby">
<div class="flt-lft">
<label>Filter by:
<select class="form-control" name="order_status">
    <option value="">Status</option>
    <option <?php echo $processselect;?> value="1">Processing</option>
    <option <?php echo $transistselect;?> value="2">Order in Transit</option>
    <option <?php echo $deliveredselected;?> value="3">Order Delivered</option>
    <option <?php echo $cancelledselected;?> value="4">Cancelled</option>
</select>   
</label>
</div>
</div>
<?php
}
?>
    


<div class="col-sm-4 date-pickme">
<div class="flt-lft">
<label class="d-flex align-items-center">Date Range:
<div class="input-group ml-2">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="far fa-calendar-alt"></i>
</span>
</div>
<input type="date" class="form-control float-right" name="date">
</div>
</label>
</div>
</div>
<div class="col-sm-3 search-ord">
<input type="text" class="form-control" placeholder="Search" name="search">
</div>
<div class="col-sm-2">
<button type="submit" class="btn btn-block btn-primary">Go!</button>
</div>
</div>
</form>
<div class="" style="display: block;width: 100%;overflow-x: auto;">
<table class="table table-bordered">
<thead>
<tr>
<th>Order ID</th>
<th>Product Name</th>
<th>Product ID</th>
<th>Thumbnail</th>
<th>Buyer Name</th>
<th>Quantity</th>
<th>Amount</th>
<th>Date</th>
<!--<th>Message</th>-->
<th>Status</th>
<th>Track id</th>
<th>Action</th>
</tr>
</thead>
<tbody>

@foreach($orders as $key=>$order)
@php
@endphp
<tr>
<td>{{$order->oid}}</td>
<td>{{$order->pname}}</td>
<td>{{$order->product_code}}</td>
<td><a href="{{asset('public/products')}}/{{$order->pimage}}" target="_blank"><img style="width:60px;height:60px" src="{{asset('public/products')}}/{{$order->pimage}}" alt="Product Image"></a></td>
<td>{{$order->bname}}</td>
<td>{{$order->oquantity}}</td>
<td>{{$order->totalamount}}</td>
<td>{{$order->ocreated_at}}</td>
<!--<td><a href="#" data-toggle="modal" data-target="#modal-default"><i class="far fa-comments"></i></a></td>-->
<td>
<select class="form-control order_status" order="{{$order->ouid}}" name="orders_status" style="width:160px">
    <option @php echo($order->ostatus == 1)? "selected":"" @endphp value="1">Processing</option>
    <option @php echo($order->ostatus == 2)? "selected":"" @endphp value="2">Order in Transit</option>
    <option @php echo($order->ostatus == 3)? "selected":"" @endphp value="3">Order Delivered</option>
    <option @php echo($order->ostatus == 4)? "selected":"" @endphp value="4">Cancelled</option>
</select>    
</td>
<td><form method="post" action="{{url('/update-trackid')}}">
   @csrf
    <input type="hidden" name="order_id" value="{{$order->order_id}}">
<input type="text" class="form-control" name="track_id" value="{{$order->track_id}}">
<br>
<input type="submit" class="btn btn-primary" value="Update">
</form></td>
<td><a href="{{url('/seller/orderdetails')}}/{{$order->ouid}}">View Details</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div class="row">
<div class="col-sm-12 col-md-5">
<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 entries</div>
</div>
<div class="col-sm-12 col-md-7">
<div class="table_page flt-rght">
{{ $orders->links() }}
</div>
</div>
</div>
</div>
<!-- /.card-body -->
</div>

</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>

<div class="modal fade" id="modal-default">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Chat</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="chatbody">
<div class="panel panel-primary">
<div class="panel-body msg_container_base">
<div class="row msg_container base_sent">
<div class="col-md-10 col-xs-10">
<div class="messages msg_sent">
<p>that mongodb thing looks good, huh? tiny master db, and huge document store</p>
<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
</div>
</div>
<div class="col-md-2 col-xs-2 avatar">
<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
</div>
</div>
<div class="row msg_container base_receive">
<div class="col-md-2 col-xs-2 avatar">
<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
</div>
<div class="col-md-10 col-xs-10">
<div class="messages msg_receive">
<p>that mongodb thing looks good, huh? tiny master db, and huge document store</p>
<time datetime="2009-11-13T20:00">Timothy • 51 min</time>
</div>
</div>
</div>
</div>
<div class="panel-footer">
<div class="input-group">
<input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
<span class="input-group-btn">
<button class="btn btn-primary btn-sm" id="btn-chat"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
</span>
</div>
</div>
</div>
</div>
</div>
<!--<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button>
</div>-->
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
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
<script>
$(document).ready(function() {
$('.delete_btn').click(function() {
var id = $(this).attr('id');
if (confirm('Are you sure want to delete ?')) {
document.location.href = '{{url("/seller/")}}' + '/' + id;
} else {
return false;
}
});
});
</script>
<script>
$(document).ready(function(){
$('.portingcode').click(function(){
let id=$(this).attr('id');
//alert(id);
let proname=$('#proname_'+id).val();
let toemail=$('#toemail_'+id).val();
$('#prodnumber').val(proname);
$('#sendto').val(toemail);
});
});

$(".order_status").change(function(){
    let status = $(this).val();
    let order_id = $(this).attr('order');
    if (confirm("Are you sure you want to update status ?") == true) {
  
        $.ajax({
    type: "post",
    url: "{{url('seller/update-order-status')}}",
    data:{"status":status,"order_id":order_id, _token: '{{csrf_token()}}'},
    success: function(data){
    window.location.reload();
    }
    })
    
} 
})

</script>
@stop 

@endsection