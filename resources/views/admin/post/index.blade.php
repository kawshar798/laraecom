@extends('admin.layouts.master')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Brand List</h5>
        <div class="header-elements">
            <div class="list-icons">
            
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add Post</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>

            </div>
        </div>
    </div>
    
    <table class="table category-list table-hover">
        <thead>
            <tr>
                <th>S.L</th>
                <th>Post Title</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $index=>$post)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>
                <img src="{{asset($post->image)}}" style="width:80px" alt="iamge"/>
                </td>
                <td>

                @if($post->status == 'Inactive')
                                       <span class="badge badge-warning ">Inactive</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                   @endif
                </td>
                <td>
                <button type="button" data-title="{{$post->title}}"   data-description="{{$post->body}}"  data-category="{{$post->category_id}}"  data-image="{{$post->image}}"    data-id="{{$post->id}}" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#addFees1">
                                        Edit</i>
                   </button>
                   <button  data-success_url="{{url('post/category')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/post/delete', $post->id) }}" class="btn btn-danger delete_brand"
                data-id="{{ $post->id }}"  title="Delete">Delete</button>

                @if($post->status == 'Inactive')
                <button  data-success_url="{{url('post/category')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/post/active', $post->id) }}" class="btn btn-success active_brand"
                data-id="{{ $post->id }}"  title="Active">Active</button>
                @else
                <button  data-success_url="{{url('post/category')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/post/inactive', $post->id) }}" class="btn btn-warning inactive_brand"
                data-id="{{ $post->id }}"  title="InActive">Inactive</button>
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
                                <!-- <form action="{{url('admin/post/store')}}" method="post" enctype="multipart/form-data" > -->
                                    <input type="hidden" class="success_url" value="{{url('admin/post')}}">
                                    <input type="hidden" class="submit_url" value="{{url('admin/post/store')}}">
                                    <input type="hidden" class="method" value="POST">
                                    <input type="hidden" class="id" name="id" value="">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control title_modal" id="koi" type="text" placeholder="Post Name" name="title">
                                                <span id="msg"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Post Category</label>
                                            <div class="col-sm-9">
                                                <select name="category_id" class="form-control category_modal">
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control description_modal" placeholder="Category Description" name="body" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control image_modal" type="file" placeholder="Post Image" name="image">
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
        $('#btn-save').html("Add  Post");
        $('#k').trigger("reset");
        $('#modalTitile').html("Add Post");
        $('#addFees').modal('show');
    });

    /*  When user click add user button */
    $('.edit-btn').on('click', function (e) {
            e.preventDefault();
            var id        = $(this).data("id");
            var name    = $(this).data("title");
            var category    = $(this).data("category");
            var image  = $(this).data("image");
            var description  = $(this).data("description");
            $('.title_modal').val(name);
            $('.description_modal').val(description);
            $('.category_modal').val(category);
            $('.id').val(id);
             
            var post_image = "<img src='"+ '{{asset('/')}}/'+image+"' height='100' width='100'>";
            
            if(post_image){
            $("#modal-input-image").html(post_image);
             }
            $('.k').trigger("reset");
            $('#modalTitile').html("Edit Post ");
            $('#btn-save').html("Update Post");
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
            url:"{{url('admin/post/store')}}",
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