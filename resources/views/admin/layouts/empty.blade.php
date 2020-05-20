<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('public/backend/assets/global/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset("public/backend/assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("public/backend/assets/css/bootstrap_limitless.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("public/backend/assets/css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("public/backend/assets/css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("public/backend/assets/css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('public/backend/assets/global/js/main/jquery.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/global/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/global/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('public/backend/assets/global/js/plugins/visualization/d3/d3.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/global/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
    <script src="{{asset('public/backend/assets/global/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/global/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/global/js/plugins/pickers/daterangepicker.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script src="{{asset('public/backend/assets/js/app.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body>
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Login card -->

                @yield('content')
            <!-- /login card -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
        @if(Session::has('messege'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
    }
    @endif
</script>

<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you Want to delete?",
            text: "Once Delete, This will be Permanently Delete!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
    });
</script>

</body>
</html>
