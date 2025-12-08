<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('admin')}}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{asset('admin')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{asset('admin')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{asset('admin')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />

    <!-- loader-->
    <link href="{{asset('admin')}}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{asset('admin')}}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('admin')}}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('admin')}}/assets/css/app.css" rel="stylesheet">
    <link href="{{asset('admin')}}/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/header-colors.css" />
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/toastr.min.css" />
    <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('vendor.partials.left_sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('vendor.partials.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('vendor')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('vendor.partials.footer')
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    @include('vendor.partials.right_sidebar')
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{asset('admin')}}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{asset('admin')}}/assets/js/jquery.min.js"></script>
    <script src="{{asset('admin')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{asset('admin')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{asset('admin')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <script src="{{asset('admin')}}/assets/js/toastr.min.js">
    </script>
    <script src="{{ asset('admin') }}/assets/plugins/input-tags/js/tagsinput.js"></script>
    <script src="{{asset('admin')}}/assets/js/sweetalert.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/tinymce.min.js" referrerpolicy="origin">
    </script>


    <script src="{{asset('admin')}}/assets/js/index.js"></script>
    //
    <!--app JS-->
    <script src="{{asset('admin')}}/assets/js/app.js"></script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
      tinymce.init({
        selector: '#mytextarea'
        });

    </script>

    <script>
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }

        @if (Session::has('type'))


        let type = "{{ session('type','info') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ session('message') }}")
                break;
            case 'success':
                toastr.success("{{ session('message') }}")
                break;
            case 'warning':
                toastr.warning("{{ session('message') }}")
                break;
            case 'error':
                toastr.error("{{ session('message') }}")
                break;
        }
        @endif

    </script>
</body>

</html>