@php
    $categories = DB::table('categories')->where([['parent',0],['status',1]])->get();
    $emagazine = DB::table('informations')->where([['status',1],['type',5]])->first();
@endphp
<header class="header-wrapper layout-two-check" >
    <div class="mobile">
        <div class="mobile-header">
            <div class="mobile-logo ">
                <a href="/"><img src="public/uploads/logobg/logo.png" alt="logo"></a>
            </div>
            <div id="mobile-right" class="mobile-right">
                <a href="subscribe/form" class="subscribe">subscribe</a>
                <div class="icon">
                    <i class="fas fa-bars showicon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="desktop">
        <div class="second-header ">
            <div class="second-header-left" id="social">
                <div class="social">
                    <a href="https://www.instagram.com/bestkwave"><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                    <a href="https://www.facebook.com/BestKwave"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/BestkWave"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div id="second-header-right">
                <div class="second-header-right">
                    <div class="right">
                        <div class="form">
                            <div id="form">
                                <form action="search" method="POST" >
                                    @csrf
                                    <input name="search" type="text" class="input" placeholder="search"> 
                                    <button class="button"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="icon-search"> <i class="fas fa-search"></i> </div>
                    </div>
                    <div class="dropdown right"> SIDE MENU
                        <div class="dropdown-menu" id="drop_link">
                            <a href="page/about" class="dropdown-item">About us</a> 
                            <a href="page/advertisement" class="dropdown-item">Hợp tác quảng cáo</a> 
                        </div>
                    </div>
                    <div class="right br-0"><a href="subscribe/form">SUBSCRIBE</a></div>
                    <div id="google_translate_element"></div>
                </div>
            </div>
            
        </div>
        <div class="two-header-menu" id="main-menu">
            <div id="logo-fixed" class="header-logo">
                <div  class="logo">
                    <a href="/"><img src="public/uploads/logobg/logo.png" alt="logo"></a>
                </div>
            </div>
            <nav id="main-menu-fixed" class="main-menu">
                <ul class="menu-list">
                    @foreach ($categories as $item)
                        <li class="menu-item"><a href="category/{{$item->slug}}">{{$item->title}}</a></li>
                    @endforeach
                    @isset($emagazine)
                        <li class="menu-item"><a href="{{$emagazine->link}}">E-MAGAZINE</a></li>                        
                    @endisset
                </ul>
                
            </nav>
        </div>
    </div>
</header>