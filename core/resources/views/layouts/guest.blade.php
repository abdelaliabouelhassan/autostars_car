<!DOCTYPE HTML>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>@yield('title','AutoStars')</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <!-- CSS
        ================================================== -->
        <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/bootstrap-theme.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/vendor/prettyphoto/css/prettyPhoto.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/vendor/owl-carousel/css/owl.carousel.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/vendor/owl-carousel/css/owl.theme.css')}}" rel="stylesheet" type="text/css">
        <!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"><!-- CUSTOM STYLESHEET FOR STYLING -->
        <!-- Color Style -->
        <link href="{{asset('assets/colors/color1.css')}}" rel="stylesheet" type="text/css">

        {{-- custom css --}}
        @yield('header')
      

        <!-- SCRIPTS
        ================================================== -->
        <script src="{{ asset('assets/js/modernizr.js') }}"></script><!-- Modernizr -->
        
    </head>
    <body class="home header-v2">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
        <div class="body">
            <!-- Start Site Header -->
            <div class="site-header-wrapper">
                <header class="site-header">
                    <div class="container sp-cont">
                        <div class="site-logo">
                            <h1><a href="{{route('accueil',request()->query())}}"><img src="{{asset('assets/images/logo.png')}}" alt="Logo"></a></h1>
                        </div>
                        <div class="topnav dd-menu toggle-menu">
                            <ul class="top-navigation sf-menu">
                                <li><a href="{{route('accueil',request()->query())}}">Accueil</a> </li>
                                <li class="megamenu"><a href="{{route('voitures.index')}}">Voitures</a></li>
                                <li><a href="{{route('apropos')}}">À propos</a></li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                                <li><a href="{{route('mentions_legales')}}">Mentions légales</a></li>
                        
                        </div>
                        <div class="header-right">
                            @guest
                                <div class="user-login-panel">
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#loginModal">Admin</a>
                                </div>
                                <a href="#" class="visible-sm visible-xs" id="menu-toggle"><i class="fa fa-bars"></i></a>
                            @endguest
                            @auth
                                <div class="user-login-panel logged-in-user">
                                    <a href="#" class="user-login-btn" id="userdropdown" data-toggle="dropdown">
                                        <img src="{{asset('assets/images/account_avatar.png')}}">
                                        <span class="user-informa">
                                            <span class="meta-data">Welcome</span>
                                            <span class="user-name">{{Auth::user()->name}}</span>
                                        </span>
                                        <span class="user-dd-dropper"><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="userdropdown">
                                        <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                                        <li><a href="{{route('dashboard.account')}}">Mon Compte</a></li>
                                        <li>
                                            <a  href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                        Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endauth

                        </div>
                    </div>
                </header>
                <!-- End Site Header -->
            </div>
            
            <div class="main-section">
                @yield('content')
            </div>
            
            <!-- Start site footer -->
            <footer class="site-footer">
                <div class="site-footer-top">
                    <div class="container">
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-6 footer_widget widget text_widget">
                                <h4 class="widgettitle">Á propos d' AutoStars</h4>
                                <p>Chez Garage Autostars, notre objectif est de vous offrir une expérience d'achat exceptionnelle. Notre équipe de vente est là pour vous aider à trouver la voiture parfaite, adaptée à vos besoins, votre budget et votre style de vie. Nous sommes fiers de notre réputation d'excellence dans la vente de voitures.</p>
                            </div>
                            <div class="col-md-6 col-sm-6 footer_widget widget  ">
                                <h4 class="widgettitle">Contact</h4>
                                <div class=" row">
                                    <div class="col-md-6 footer-widget-contact">
                                        <div class="footer-widget-contact-item">
                                            <div class="text-primary footer-widget-contact-item-icon">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <div class="footer-widget-contact-item-info">
                                                <div class="text-primary"><strong>Adress :</strong> </div>
                                                <div>123 Rue de Rivoli, 75001 Paris, France</div>
                                            </div>
                                        </div>
                                        <div class="footer-widget-contact-item">
                                            <div class="text-primary footer-widget-contact-item-icon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="footer-widget-contact-item-info">
                                                <div class="text-primary"><strong>Téléphone :</strong> </div>
                                                <div>1800-989-990</div>
                                            </div>
                                        </div>
                                        <div class="footer-widget-contact-item">
                                            <div class="text-primary footer-widget-contact-item-icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <div class="footer-widget-contact-item-info">
                                                <div class="text-primary"><strong>Email :</strong> </div>
                                                <div> info@autostars.com</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 footer-widget-contact">
                                        <div class="footer-widget-contact-item">
                                            <div class="text-primary footer-widget-contact-item-icon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <div class="footer-widget-contact-item-info">
                                                <div class="text-primary"><strong>Horaires d'ouverture :</strong> </div>
                                                <div> Lun - Sam : 06h00 - 20h00</div>
                                            </div>
                                        </div>
                                        <div class="footer-widget-contact-item">
                                            <a  href="{{route('contact')}}" class="btn btn-lg btn-block btn-primary ">Messager</a>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            
                           
                           
                        </div>
                    </div>
                </div>
                <div class="site-footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 copyrights-left">
                                <p>&copy; {{ date('Y') }} AutoStars. All Rights Reserved</p>
                            </div>
                            <div class="col-md-6 col-sm-6 copyrights-right">
                                <ul class="social-icons social-icons-colored pull-right">
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End site footer -->
        </div>
        @guest
        {{-- login modal --}}
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Login to your account</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="login">
                            @csrf
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="email" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember">
                                <label>Remember</label>
                            </div>
                            <input type="submit" class="btn btn-primary" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endguest

        
        

        <script src="{{ asset('assets/js/jquery-2.0.0.min.js') }}"></script> <!-- Jquery Library Call -->
        <script src="{{ asset('assets/vendor/prettyphoto/js/prettyphoto.js') }}"></script> <!-- PrettyPhoto Plugin -->
        <script src="{{ asset('assets/js/ui-plugins.js') }}"></script> <!-- UI Plugins -->
        <script src="{{ asset('assets/js/helper-plugins.js') }}"></script> <!-- Helper Plugins -->
        <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script> <!-- Owl Carousel -->
        <script src="{{ asset('assets/vendor/password-checker.js') }}"></script> <!-- Password Checker -->
        <script src="{{ asset('assets/js/bootstrap.js') }}"></script> <!-- UI -->
        <script src="{{ asset('assets/js/init.js') }}"></script> <!-- All Scripts -->
        <script src="{{ asset('assets/vendor/flexslider/js/jquery.flexslider.js') }}"></script> <!-- FlexSlider -->
    </body>
</html>