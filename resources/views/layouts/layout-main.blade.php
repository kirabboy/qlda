<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard</title>
    
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css?1685976846') }}" rel="stylesheet" />

    <link href="{{ asset('libs/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('libs/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/Parsley/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">



    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        #column_basic {
            height: 50vh;
        }

        #pie_gradient {
            height: 50vh;
        }
    </style>
</head>

<body>
    <div class="page">

        @yield('content')

    </div>
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>

    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
    <script src="{{ asset('libs/js/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('libs/Parsley/parsley.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>

    <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js?1685976846') }}" defer></script>

    <script src="{{ asset('libs/fontaswesome/fontaswesome.js') }}"></script>

    @stack('scripts')

    <!-- Toast Plugin -->
    <script src="{{ asset('libs/toastr/toastr.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"]("{{ Session::get('success') }}", "Thông báo")
        @endif
        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["error"]("{{ Session::get('error') }}", "Thông báo")
        @endif
    </script>


    <!-- Ckeditor & Ckfinder-->
    <script>
        CKEDITOR.replace('ckeditor-content', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}'
        });
    </script>
    @include('ckfinder::setup')



    <script src="{{ asset('libs/hightchart/highcharts.js') }}"></script>
    <script src="{{ asset('libs/hightchart/exporting.js') }}"></script>
    <script src="{{ asset('libs/hightchart/export-data.js') }}"></script>
    <script src="{{ asset('libs/hightchart/accessibility.js') }}"></script>


    <script src="{{ asset('assets/js/char.js') }}"></script>
    <script src="{{ asset('assets/js/char1.js') }}"></script>


    <script src="{{ asset('libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>