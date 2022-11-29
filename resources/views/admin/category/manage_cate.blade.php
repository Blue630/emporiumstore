@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/add_cate')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add New</a></li>

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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Category</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Show in Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php 
                            $srn=1;
                        @endphp
                           @if($cate)
                                @foreach($cate as $allcate)
                                <tr>
                                <td>{{$srn}}</td>
                                <td>{{$allcate->catname}}</td>
                                <td>{{date('d-m-Y',strtotime($allcate->created_date))}}</td>
                                <td>
                                    <?php
                                    if($allcate->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/admin/inactivecategory')}}/{{$allcate->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/admin/activecategory')}}/{{$allcate->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><a href="{{url('/admin/edit_cate')}}/{{$allcate->id}}">Edit</a> &nbsp; <a href="#" class="delete_btn" id="{{$allcate->id}}">Delete</a></td>
                                <td><input type="checkbox" <?php echo ($allcate->show_in_menu == 1)? "checked":"" ?> class="showInMenu" catid="{{$allcate->id}}"></td>
                            </tr>
                            @php $srn++ @endphp
                                @endforeach
                           @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Category</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Show in Menu</th>
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
    });
</script>
<script>
    /*$(document).ready(function() {*/
        $('.delete_btn').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure want to delete ?')) {
                document.location.href = '{{url("/admin/deletecategory")}}' + '/' + id;
            } else {
                return false;
            }
        });
    /*});*/
    
    $(".showInMenu").change(function(){
        let showinmenu;
        let catid = $(this).attr("catid");
        if($(this).is(':checked')){
            showinmenu = 1;
        }else{
            showinmenu = 0;
        }
        
        $.ajax({
        type: "post",
        url: "{{url('admin/cat-show-in-menu')}}",
        data:{"catid":catid, _token: '{{csrf_token()}}',"showinmenu":showinmenu},
        success: function(data){
       alert(data);
       location.reload();
        }
        })
    })
</script>
@stop @endsection