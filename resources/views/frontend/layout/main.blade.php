<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>
        @hasSection('title')
            @yield('title') |
        @endif
        BidMyTrip
    </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/logo1.png') }}">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/flaticon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/plugin.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <script async src="{{ asset('frontend/js/invisible.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js') }}"></script>

    @stack('styles')
</head>

<body>
    <div id="preloader1">
        <div id="status1"></div>
    </div>
    @include('frontend.includes.header')

    @yield('content')



    @include('frontend.includes.footer')
    <div id="back-to-top">
        <a href="javascript:void(0)"></a>
    </div>
    <script data-cfasync="false" src="{{ asset('frontend/js/email-decode.min.js') }}"></script>
    <script src="{{ asset('lib/jquery-3.6.2.js') }}"></script>

    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('frontend/js/plugin.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/main-1.js') }}"></script>
    <script src="{{ asset('frontend/js/preloader.js') }}"></script>
    <script src="{{ asset('frontend/js/custom-swiper2.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('lib/jquery_validate/jquery.validate.js') }}"></script>
    {{-- <script src="{{ asset('frontend/js/custom-countdown.js') }}"></script> --}}
    <script type="text/javascript">
        (function() {
            window['__CF&#8377;cv&#8377;params'] = {
                r: '6e15de60ec5e4c85',
                m: 'gHA6a4hzfKXqumvSW5fNpbHzxQPZrbFNQWOVhqe3GJA-1645508311-0-ARA6+1BgjnuFtzbk0VSB0e5LR2TScCicQ0zoc1GsI0FqRZVsnyuz8z/yiJnA7ZKORndrFmkabbOzZyOkYqJhy+a+WjsDAd3xQ16uMkGTtrrQ7A6bg0JQEOCmlNsbbOTC4Su+QHaPqeSVRlPS/Ywl9jp9r2jNKPsDtsn+3rp7bBHV',
                s: [0xb9e4737c46, 0xe251addc64],
                u: '/cdn-cgi/challenge-platform/h/b'
            }
        })();
    </script>
    <script>
        $(document).ready(function() {
            $(".accordion1").click(function() {
                $(this).toggleClass("active");
                $(this).next().slideToggle();
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
