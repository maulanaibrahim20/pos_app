<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Fastkart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Fastkart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ url('/assets') }}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('/assets') }}/images/favicon.png" type="image/x-icon">
    <title>Fastkart - Dashboard</title>

    @include('layouts.admin.components.style-css')
    <link href="{{ asset('custom/css/backend.css') }}" rel="stylesheet" />
    <link href="{{ asset('custom/css/datatable-lokal.min.css') }}" rel="stylesheet" />


</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.admin.header')
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.admin.sidebar')
            <!-- Page Sidebar Ends-->

            <!-- index body start -->
            <div class="page-body">
                @yield('content')
                <!-- Container-fluid Ends-->

                <!-- footer start-->
                @include('layouts.admin.footer')
                <!-- footer End-->
            </div>
            <!-- index body end -->

        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End-->

    <!-- Modal Start -->
    <div class="modal modal-blur fade" id="ajaxModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@yield('modal_title')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-message"></div>
                    <div class="modal_content">
                        <center><img id="img-loader" src="{{ url('custom/svg/loading.svg') }}" height="40"
                                alt="Loading.." /></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    @include('layouts.admin.components.style-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('custom/js/jquery.form.min.js') }}"></script>

    <script src="{{ asset('custom/js/backend.js') }}"></script>
    <script src="{{ asset('addons/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('custom/js/datatable-lokal.min.js') }}"></script>



</body>

</html>
