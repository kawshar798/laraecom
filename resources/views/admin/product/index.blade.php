@extends('admin.layouts.master')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">product List</h5>
        <div class="header-elements">
            <div class="list-icons">
            
                        <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add product</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>

            </div>
        </div>
    </div>
    
    <table class="table category-list table-hover">
        <thead>
            <tr>
                <th>S.L</th>
                <th>Product Name</th>
                <th>Category </th>
                <th>Brand</th>
                <th>Product Code</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Selling Price</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($products as $index=>$product)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$product->name}}</td>
                <td>{{isset($product->category->name)?$product->category->name:''}}</td>
                <td>{{isset($product->brand->name)?$product->brand->name:''}}</td>
                <td>{{$product->code}}</td>
                <td>{{$product->quantity}}</td>
                <td>
                    <img style="width: 40px" src="{{asset($product->image_one)}}" alt="" />
                </td>
                <td>{{$product->selling_price}} ৳</td>
                <td>
                    @if($product->status == 'Inactive')
                                       <span class="badge badge-warning ">Inactive</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                   @endif
                </td>
                <td>
                <button type="button" data-name="{{$product->name}}" data-logo="{{$product->logo}}"  data-id="{{$product->id}}" class="btn btn-primary  edit-btn" data-toggle="modal" data-target="#addFees1">
                                        Edit</i>
                   </button>
                   <button  data-success_url="{{url('admin/product')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/product/delete', $product->id) }}" class="btn btn-danger delete_product"
                data-id="{{ $product->id }}"  title="Delete">Delete</button>

                @if($product->status == 'Inactive')
                <button  data-success_url="{{url('admin/product')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/product/active', $product->id) }}" class="btn btn-success active_product"
                data-id="{{ $product->id }}"  title="Active">Active</button>
                @else
                <button  data-success_url="{{url('admin/product')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/product/inactive', $product->id) }}" class="btn btn-warning inactive_product"
                data-id="{{ $product->id }}"  title="InActive">Inactive</button>
                @endif
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
     <!-- The Modal for Create -->
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
        $('#btn-save').html("Add product");
        $('#k').trigger("reset");
        $('#modalTitile').html("Add New product");
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
            $('#modalTitile').html("Edit product");
            $('#btn-save').html("Update product");
            $('#addFees').modal('show');
        });


        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
});

//Store product
$(document).on('submit', '.ajax-form-submit', function(e) {
        e.preventDefault();
        var submit_url = $(this).attr("submit_url");
        var success_url = $(this).attr("success_url");
        var fd = new FormData(document.getElementById("k"));
        $.ajax({
            method: 'POST',
            url:"{{url('admin/product/store')}}",
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

// product Active
$(document).on('click', '.active_product', function(e) {
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

// product Inactive
$(document).on('click', '.inactive_product', function(e) {
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



    // product Delete
$(document).on('click', '.delete_product', function(e) {
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