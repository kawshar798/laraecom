@extends('admin.layouts.master')
@section('content')
<div class="content">
<!-- Hover rows -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Category List</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>

            </div>
        </div>
    </div>
    <table class="table category-list table-hover">
        <thead>
            <tr>
                <th>S.L</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Parent</th>
                <th>Featured</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index=>$catgory)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$catgory->name}}</td>
                <td>{{$catgory->slug}}</td>
                <td>{{$catgory->parent_id}}</td>
                <td>{{$catgory->featured}}</td>
                <td><span class="badge badge-success">{{$catgory->status}}</span></td>
                <td class="text-center">
                <a href="#" class="btn btn-primary">Edit</a>
                <!-- <a href="#"  id="delete" class="btn btn-danger">Delete</a> -->
                <!-- <a href="{{ url('admin/category/delete', $catgory->id) }}" data-id="{{ $catgory->id }}  class="btn delete_brand_button btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">
   Delete
</a> -->

<button  data-success_url="{{url('admin/category')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/category/delete', $catgory->id) }}" class="btn btn-danger delete_brand_button"
 data-id="{{ $catgory->id }}"  title="Delete">Delete</button>

                <a href="#" class="btn btn-success">Active</a>
                <a href="#" class="btn btn-warning">Inactive</a>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
<!-- /hover rows -->
</div>
@endsection

@section('footerScripts')
    @parent
    <script>


        $(document).ready(function(){// Setting datatable defaults
        // if (!$().DataTable) {
        //     console.warn('Warning - datatables.min.js is not loaded.');
        //     return;
        // }

        // // Setting datatable defaults
        // $.extend( $.fn.dataTable.defaults, {
        //     autoWidth: false,
        //     columnDefs: [{
        //         orderable: false,
        //         width: 100,
        //         targets: [ 5 ]
        //     }],
        //     dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        //     language: {
        //         search: '<span>Filter:</span> _INPUT_',
        //         searchPlaceholder: 'Type to filter...',
        //         lengthMenu: '<span>Show:</span> _MENU_',
        //         paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        //     }
        // });
        // // Basic datatable
        // $('.category-list').DataTable();
    


//     $(document).on('click', '.delete_brand_button', function(e) {
//             e.preventDefault();
//             var id = $(this).data("id");
//             var url = $(this).data("url");
//             var success_url = $(this).data("success_url");
//             var token = $("meta[name='csrf-token']").attr("content");

//             swal({
//             title:"Are You Sure Delete this???",
//             // text: " ",
//             icon: 'warning',
//             buttons: true,
//             dangerMode: true,
//         }).then(willDelete => {
//             if (willDelete) {
//                 $.ajax(
//         {
//           url: url,
//           success_url:success_url,
//           type: 'DELETE',
//           data: {
//             _token: token,
//                 id: id
//         },
//         success: function(result) {
//             if (result.success == true) {
//                 toastr.success(result.messege);
//                 // setTimeout(function(){
//                   location.reload(success_url);
//                 // },  2000);
//             } else {
//                 toastr.error(result.messege);
//             }
//         },
//     });
//             }
//         });


// });
    
    });




    </script>
@stop