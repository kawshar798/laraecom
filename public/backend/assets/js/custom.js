/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
$(document).ready(function(){// Setting datatable defaults
if (!$().DataTable) {
    console.warn('Warning - datatables.min.js is not loaded.');
    return;
}

// Setting datatable defaults
$.extend( $.fn.dataTable.defaults, {
    autoWidth: false,
    columnDefs: [{
        orderable: false,
        width: 100,
        targets: [ 5 ]
    }],
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    language: {
        search: '<span>Filter:</span> _INPUT_',
        searchPlaceholder: 'Type to filter...',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
    }
});


// Basic datatable
$('.category-list').DataTable();

$(document).on('click', '.delete_brand_button', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = $(this).data("url");
    var success_url = $(this).data("success_url");
    var token = $("meta[name='csrf-token']").attr("content");

    swal({
    title:"Are You Sure Delete this???",
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
});