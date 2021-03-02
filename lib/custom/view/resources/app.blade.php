<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('aimeos_header')
<title></title>
<!-- Vendor CSS Files --> 
<!-- Main Style CSS File -->

<link rel="stylesheet" href="{{ sardes_url('assets/css/vendor/bootstrap.min.css') }}">

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ sardes_url('assets/images/favicon.ico')}}">
<!-- CSS
	============================================ --> 
<!-- Ion Icon -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/vendor/ion-fonts.css')}}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/vendor/bootstrap.min.css')}}">
<!-- Fontawesome -->
<link rel="stylesheet" href="{{ sardes_url('assets/font-awesome.min.css')}}">
<!-- <link rel="stylesheet" href="{{asset('/fe/assets/css/vendor/font-awesome.min.css')}}"> --> 
<!-- Fontawesome Star -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/vendor/fontawesome-stars.min.css')}}">
<!-- Slick CSS -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/plugins/slick.css')}}">
<!-- Animation -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/plugins/animate.css')}}">
<!-- jQuery Ui -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/plugins/jquery-ui.min.css')}}">
<!-- Nice Select -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/plugins/nice-select.css')}}">
<!-- Timecircles -->
<link rel="stylesheet" href="{{ sardes_url('assets/css/plugins/timecircles.css')}}">
<!-- Swordbros -->
<link rel="stylesheet" href="{{ sardes_url('theme.css')}}?_v=<?=time()?>">
<link rel="stylesheet" href="{{ sardes_url('aimeos.css')}}">
<!--<link rel="stylesheet" href="{{asset('/fe/assets/css/style.min.css')}}">-->
<script src="{{ sardes_url('assets/js/vendor/jquery-1.12.4.min.js') }}"></script> 
<script src="{{ sardes_url('theme.js') }}?_v=0.0.1"></script> 



<!-- test 1.0.5 --> 

<?php 
    $locale = \Route::current()->parameter('locale','');
    if(!$locale) $locale = \Request::input('locale','ru');
    $currency = \Route::current()->parameter('currency','');
    if(!$currency) $currency = \Request::input('currency','RUB');
?>
<script>
   var locale_selector = 'locale=<?=$locale?>&currency=<?=$currency?>'
</script>
@yield('aimeos_header')
@yield('aimeos_styles')
</head>
<body class="template-color-3 bg-smoke_color">

<div class="main-wrapper boxed-layout bg-white_color">

 <header class="main-header_area">
        <div class="header-top_area d-none d-lg-block">
            <div class="container">
                <div class="header-top_nav">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="ht-menu">
                            <?php  echo sardes_top_categories(); ?>
                            </div>
                        </div>
                        <div class="header-search_area d-none d-lg-block col-lg-4">
                            <div class="d-none d-sm-block"> @yield('top_search_module') </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="header-top_right">
                                <div class="ht-menu">
                                    <ul>
                                        @yield('locale_selector_module')
                                        
                                        @if (Auth::guest())
                                        <li class="select-dropdown user"> <a href="{{ route('login') }}">{{__('auth.Loginbutton')}} / {{__('auth.Register')}} </a> 
								                                         
                                            
                                        </li>
                                                                           
                                        @else
                                      <li class="select-dropdown dropdown">@if (Auth::user()->name ) <a href="#" > {{ Auth::user()->name }}
                                            <i class="ion-chevron-down"></i></a> @else <a href="#">{{ Auth::user()->email }}<i class="ion-chevron-down"></i></a>
                                    @endif  <ul class="ht-dropdown "> <li class="select-item">
                                                <a class="nav-link" href="{{  route('aimeos_shop_account',['site'=>Route::current()->parameter('site','default'),'locale'=>Route::current()->parameter('locale','en'),'currency'=>Route::current()->parameter('currency','EUR')])}}" title="Profile">{{__('pagination.Profile')}}</a>
                                            </li>
                                            <li class="select-item">
                                                <form id="logout" action="/logout" method="POST" style="display: none">
                                                    {{csrf_field()}}
                                                </form>
                                                <a class="nav-link" href="javascript: document.getElementById('logout').submit();">{{__('pagination.Logout')}}</a></li>
                                        </ul>
                                    </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-middle_nav">
							<div class="mobile-menu_wrap d-inline-block d-lg-none">
                                <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                <i class="ion-android-menu"></i>
                                </a>
                            </div>
                            <div class="header-logo_area"><a href="/"><img src="{{ sardes_url('assets/img/palto-logo.png')}}" alt="Header Logo" style="max-width: 200px; vertical-align: middle"></a>
                                

                            </div>
							
							<div class="mobile-search" > @yield('top_search_module') </div>
                            <div class="basket_block"> @yield('basket_module') </div>
                        </div>
                        <div class="mobile-search-bar d-block d-sm-none" style="margin-bottom: 10px"> @yield('top_search_module') </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="global-overlay"></div>
    </header>
    
    <!-- Main Header Area End Here -->
		
    <div class="main-content"> 
    <?php  echo \Aimeos\Shop\Facades\Shop::get('swordbros/sardes/header')->getBody() ?>

        @yield('aimeos_body')
		

    </div>
    <?php  echo sardes_footer(); ?>
</div>
@yield('aimeos_scripts')
<script type="text/javascript">
$( ".mobile-search .search-button" ).click(function() {
		
	$('.header-logo_area').fadeToggle();
  $( ".catalog-filter-search .value" ).slideToggle( );

});
</script>



</body>

<!-- Modernizer JS --> 
<script src="{{ sardes_url('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script> 
<!-- Popper JS --> 
<script src="{{ sardes_url('assets/js/vendor/popper.min.js') }}"></script> 
<!-- Bootstrap JS --> 
<script src="{{ sardes_url('assets/js/vendor/bootstrap.min.js') }}"></script> 
<!-- Slick Slider JS --> 
<script src="{{ sardes_url('assets/js/plugins/slick.min.js') }}"></script> 
<!-- Barrating JS --> 
<script src="{{ sardes_url('assets/js/plugins/jquery.barrating.min.js') }}"></script> 
<!-- Counterup JS --> 
<script src="{{ sardes_url('assets/js/plugins/jquery.counterup.js') }}"></script> 
<!-- Nice Select JS --> 
<script src="{{ sardes_url('assets/js/plugins/jquery.nice-select.js') }}"></script> 
<!-- Sticky Sidebar JS --> 
<script src="{{ sardes_url('assets/js/plugins/jquery.sticky-sidebar.js') }}"></script> 
<!-- Jquery-ui JS --> 
<script src="{{ sardes_url('assets/js/plugins/jquery-ui.min.js') }}"></script> 
<script src="{{ sardes_url('assets/js/plugins/jquery.ui.touch-punch.min.js') }}"></script> 
<!-- Theia Sticky Sidebar JS --> 
<script src="{{ sardes_url('assets/js/plugins/theia-sticky-sidebar.min.js') }}"></script> 
<!-- Waypoints JS --> 
<script src="{{ sardes_url('assets/js/plugins/waypoints.min.js') }}"></script> 
<!-- jQuery Zoom JS --> 
<script src="{{ sardes_url('assets/js/plugins/jquery.zoom.min.js') }}"></script> 
<!-- Timecircles JS --> 
<script src="{{ sardes_url('assets/js/plugins/timecircles.js') }}"></script> 
<script src="{{ sardes_url('assets/js/main.js') }}"></script> 
<!-- Swordbros JS --> 
<script src="https://paltoru3.tulparstudyo.net/js/swordbros.js?_t1611260992"></script> 

</div>

<script type="text/javascript" src="https://paltoru3.tulparstudyo.net/packages/aimeos/shop/themes/jquery-ui.custom.min.js"></script>

<div class="menu-overlay"></div>
</body>
</html>
