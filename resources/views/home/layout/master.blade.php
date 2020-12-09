


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
                
                <div id="wrap-content">
                    @yield('content')
                </div>
            </section>
        </div>
        @include('home.layout.footer')      
          
    </body>
    
    </html>