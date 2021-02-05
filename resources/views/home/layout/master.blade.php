


    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <base href="{{asset('')}}">
        <title>@yield('title')</title>
        <title>@yield('description')</title>
        <link rel="icon" href="public/uploads/logobg/logo.png" type="image/png" sizes="16x16">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=158121739091971&autoLogAppEvents=1" nonce="aLCPlLu9"></script>
        @stack('facescript')
        <link rel="stylesheet" href="public/home/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="public/home/style/index.css?v={{time()}}">
        <script src="public/home/script/jquery-3.5.1.min.js"></script>
        <script src="public/home/script/popper.min.js"></script>
        <script src="public/home/bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" href="public/home/fontawesome/css/all.min.css">
        <script src="public/home/script/script.js?v={{time()}}"></script>
        @stack('javascript')
    </head>
    
    <body>
        
        <div id="container-all" >
            @yield('banner')
            
            <section id="home"> 
                @yield('header')
            </section>
        </div>
        <div id="wrap-content">
            @yield('content')
        </div>
        @include('home.layout.footer')      
          
    </body>
    @stack('script')
    
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover({html: true});
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script>
        $(document).ready(function() {
            var remember = $.cookie('rememberLogAuth');
            if (remember == 'true') 
            {
                var email = $.cookie('emailLogAuth');
                var password = atob($.cookie('passwordLogAuth'));
                $('#emailLogAuth').val(email);
                $('#passwordLogAuth').val(password);
                $('#rememberLogAuth').prop('checked', true);
            }
            $("#loginLogAuth").submit(function() {
                if ($('#rememberLogAuth').is(':checked')) {
                    var email = $('#emailLogAuth').val();
                    var password = btoa($('#passwordLogAuth').val());
                    $.cookie('emailLogAuth', email, { expires: 365 });
                    $.cookie('passwordLogAuth', password, { expires: 365 });
                    $.cookie('rememberLogAuth', true, { expires: 365 });
                }
            
            });

            $("#resetLogAuth").click(function() {
                $.cookie('emailLogAuth', null);
                $.cookie('passwordLogAuth', null);
                $.cookie('rememberLogAuth', null);
            });

        });
    </script>
    </html>