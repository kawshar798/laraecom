@extends('admin.layouts.master')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Coupon List</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>

            </div>
        </div>
    </div>
    
    <table class="table newslettertable table-hover" id="newslettertable">
        <thead>
            <tr>
                <th>S.L</th>
                <th>Email</th>
                <th>Subscribe date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($newsletters as $index=>$newsletter)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$newsletter->email}}</td>
                <td>{{$newsletter->email}}</td>
                <td>
                <button  data-success_url="{{url('admin/newsletter')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/newsletter/delete', $newsletter->id) }}" class="btn btn-danger delete_brand"
                data-id="{{ $newsletter->id }}"  title="Delete">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    

</div>
</div>

@endsection
@section('footerScripts')
    @parent
    <script>
    $(document).ready(function () {

        // Category list show
$('.newslettertable').DataTable();
        $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-pink-400'
        });
    /*  When user click add user button */
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
            url:"{{url('admin/coupon/store')}}",
            data:fd,
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