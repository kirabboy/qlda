<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CMS Manage Project</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('libs/toastr/toastr.min.css') }}">

    <link href="{{ asset('libs/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css?1674944402') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('libs/Parsley/parsley.css') }}">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

@yield('content')

<!-- Libs JS -->
<!-- Tabler Core -->
<script src="{{ asset('dist/js/tabler.min.js?1674944402') }}" defer></script>
<script src="{{ asset('dist/js/demo.min.js?1674944402') }}" defer></script>
<script src="{{ asset('libs/js/jquery.min.js') }}"></script>
<script src="{{ asset('libs/Parsley/parsley.min.js') }}"></script>
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
        toastr["success"]("{{ Session::get('success') }}", "{{ __('Notification') }}")
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
        toastr["error"]("{{ Session::get('error') }}", "{{ __('Notification') }}")
    @endif
</script>

<script>
    function showPassword(params) {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#validate_form').parsley();
    })
</script>
</body>

</html>
