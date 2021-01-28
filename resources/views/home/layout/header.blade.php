@php
    $categories = DB::table('categories')->where([['parent',0],['status',1]])->orderBy('sort','asc')->orderBy('id','asc')->get();
    $chunkcategories = $categories->chunk(4);
    $emagazine = DB::table('informations')->where([['status',1],['type',5]])->first();
    $bestidol = DB::table('informations')->where([['status',1],['type',6]])->first();
@endphp
<header class="header-wrapper">    
    <div class="mobile">
        <div class="mobile-header">
            <div class="mobile-logo">
                <a href="/"><img src="public/uploads/logobg/logo.png?v={{time()}}" alt="logo"></a>
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
                    <a href="https://www.instagram.com/bestkwave" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UC_O4llmSE8PsyRIVODiglrw" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.facebook.com/BestKwave" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/BestkWave" target="_blank"><i class="fab fa-twitter"></i></a>
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
                            <a href="page/advertisement" class="dropdown-item">Advertising Cooperation</a> 
                        </div>
                    </div>
                    <div class="right br-0"><a href="subscribe/form">SUBSCRIBE</a></div>
                    <div id="google_translate_element"></div>
                </div>
            </div>
            
        </div>
        <div class="main-header-menu" id="main-menu">
            <div id="logo-fixed" class="header-logo">
                <div  class="logo text-center">
                    {{-- <div class="slogan"> Tạp chí chuyên nghiệp Việt Nam </div> --}}
                    <a href="/" style="height: 200px;"><img src="public/uploads/logobg/logo.png?v={{time()}}" alt="logo"></a>
                </div>
            </div>
            <nav id="main-menu-fixed" class="main-menu">
                <ul class="menu-list">
                    @foreach ($chunkcategories[0] as $item)
                        <li class="menu-item"><a href="category/{{$item->slug}}">{{$item->title}}</a></li>
                    @endforeach
                </ul>
                <ul class="menu-list menu-list-right">
                    @foreach ($chunkcategories[1] as $item)
                        <li class="menu-item"><a href="category/{{$item->slug}}">{{$item->title}}</a></li>
                    @endforeach
                    @isset($emagazine)
                        <li class="menu-item"><a href="{{$emagazine->link}}" target="_blank">E-MAGAZINE</a></li>                        
                    @endisset
                    @isset($bestidol)
                        <li class="menu-item"><a href="idol/statistic">BEST-IDOL</a></li>                        
                    @endisset
                </ul>
            </nav>
        </div>
    </div>
     
</header>