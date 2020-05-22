@extends('admin.layouts.master')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Brand List</h5>
        <div class="header-elements">
            <div class="list-icons">
            
                        <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add Brand</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>

            </div>
        </div>
    </div>
    
    <table class="table category-list table-hover">
        <thead>
            <tr>
                <th>S.L</th>
                <th>Brand Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $index=>$brand)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$brand->name}}</td>
                <td>{{$brand->slug}}</td>
                <td>

                    <img src="{{asset($brand->logo)}}" style="width:50px" />
                </td>
                <td>

                @if($brand->status == 'Inactive')
                                       <span class="badge badge-warning ">Inactive</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                   @endif
                </td>
                <td>
                <button type="button" data-name="{{$brand->name}}" data-logo="{{$brand->logo}}"  data-id="{{$brand->id}}" class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#addFees1">
                                        Edit</i>
                   </button>
                   <button  data-success_url="{{url('admin/brand')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/brand/delete', $brand->id) }}" class="btn btn-danger delete_brand"
                data-id="{{ $brand->id }}"  title="Delete">Delete</button>

                @if($brand->status == 'Inactive')
                <button  data-success_url="{{url('admin/brand')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/brand/active', $brand->id) }}" class="btn btn-success active_brand"
                data-id="{{ $brand->id }}"  title="Active">Active</button>
                @else
                <button  data-success_url="{{url('admin/brand')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/brand/inactive', $brand->id) }}" class="btn btn-warning inactive_brand"
                data-id="{{ $brand->id }}"  title="InActive">Inactive</button>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
     <!-- The Modal for Create -->
     <div class="modal" id="addFees">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                </tbody>
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalTitile"></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form class="ajax-form-submit"   id="k" enctype="multipart/form-data" method="POST">
                                <!-- <form action="{{url('admin/brand/store')}}" method="post" enctype="multipart/form-data" > -->
                                    <input type="hidden" class="success_url" value="{{url('admin/brand')}}">
                                    <input type="hidden" class="submit_url" value="{{url('admin/brand/store')}}">
                                    <input type="hidden" class="method" value="POST">
                                    <input type="hidden" class="id" name="id" value="">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control name_modal" id="koi" type="text" placeholder="Brand Name" name="name">
                                                <span id="msg"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="logo" value="" class="form-control logo_modal" id="brand_logo">
                                                <div id="modal-input-image"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="btn-save"></button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
</div>
</div>

@endsection
@section('footerScripts')
    @parent
    <script>
    $(document).ready(function () {
        $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-pink-400'
        });

  /*  When user click add user button */
        $('#create-new-user').click(function () {
        $('#btn-save').html("Add Brand");
        $('#k').trigger("reset");
        $('#modalTitile').html("Add New Brand");
        $('#addFees').modal('show');
    });

    /*  When user click add user button */
    $('.edit-btn').on('click', function (e) {
            e.preventDefault();
            var id        = $(this).data("id");
            var name    = $(this).data("name");
            var logo  = $(this).data("logo");
            $('.name_modal').val(name);
            $('.id').val(id);
            var category_image = "<img src='"+ '{{asset('/')}}/'+logo+"' height='100' width='100'>";
            
            if(logo){
            $("#modal-input-image").html(category_image);
             }

            $('.k').trigger("reset");
            $('#modalTitile').html("Edit Brand");
            $('#btn-save').html("Update Brand");
            $('#addFees').modal('show');
        });


        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
});

//Store Brand
$(document).on('submit', '.ajax-form-submit', function(e) {
        e.preventDefault();
        var submit_url = $(this).attr("submit_url");
        var success_url = $(this).attr("success_url");
        var fd = new FormData(document.getElementById("k"));
        $.ajax({
            method: 'POST',
            url:"{{url('admin/brand/store')}}",
            data:fd,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.success == true) {
                    $('#addFees').modal('hide');
                    toastr.success(result.messege);
                    location.reload(success_url);

                } else {
                    toastr.error(result.messege);
                }
            },
        });
    });

// Brand Active
$(document).on('click', '.active_brand', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = $(this).data("url");
    var success_url = $(this).data("success_url");
    var token = $("meta[name='csrf-token']").attr("content");

    swal({
    title:"Are You Sure Active this?",
    // text: " ",
    icon: 'warning',
    buttons: true,
    dangerMode: true,
}).then(willDelete => {
    if (willDelete) {
        $.ajax(
{
  url: url,
  success_url:success_url,
  type: 'PUT',
  data: {
    _token: token,
        id: id
},
success: function(result) {
    if (result.success == true) {
        toastr.success(result.messege);
        // setTimeout(function(){
          location.reload(success_url);
        // },  2000);
    } else {
        toastr.error(result.messege);
    }
},
});
    }
});
});

// Brand Inactive
$(document).on('click', '.inactive_brand', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = $(this).data("url");
    var success_url = $(this).data("success_url");
    var token = $("meta[name='csrf-token']").attr("content");

    swal({
    title:"Are You Sure Inactive this?",
    // text: " ",
    icon: 'warning',
    buttons: true,
    dangerMode: true,
}).then(willDelete => {
    if (willDelete) {
        $.ajax(
{
  url: url,
  success_url:success_url,
  type: 'PUT',
  data: {
    _token: token,
        id: id
},
success: function(result) {
    if (result.success == true) {
        toastr.success(result.messege);
        // setTimeout(function(){
          location.reload(success_url);
        // },  2000);
    } else {
        toastr.error(result.messege);
    }
},
});
    }
});
});



    // Brand Delete
$(document).on('click', '.delete_brand', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = $(this).data("url");
    var success_url = $(this).data("success_url");
    var token = $("meta[name='csrf-token']").attr("content");

    swal({
    title:"Are You Sure Delete this?",
    // text: " ",
    icon: 'warning',
    buttons: true,
    dangerMode: true,
}).then(willDelete => {
    if (willDelete) {
        $.ajax(
{
  url: url,
  success_url:success_url,
  type: 'DELETE',
  data: {
    _token: token,
        id: id
},
success: function(result) {
    if (result.success == true) {
        toastr.success(result.messege);
        // setTimeout(function(){
          location.reload(success_url);
        // },  2000);
    } else {
        toastr.error(result.messege);
    }
},
});
    }
});
});


</script>
@stop