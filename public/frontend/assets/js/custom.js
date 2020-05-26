//Newsletter 
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    
    });
    });
    
    $(document).on('submit', '#newsletter_id', function(e) {
       
        e.preventDefault();
        var submit_url = $(this).attr("submit_url");
        var success_url = $(this).attr("success_url");
        var fd = new FormData(document.getElementById("newsletter_id"));
        $.ajax({
            method: 'POST',
            url:"{{url('newsletter/store')}}",
            data:fd,
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.success == true) {
                    toastr.success(result.messege);
                    location.reload(success_url);
                } else {
                    toastr.error(result.messege);
                }
            },
        });
    });
  