<!DOCTYPE html>
<html data-style-switcher-options="{'changeLogo': false, 'borderRadius': 0, 'colorPrimary': '#099CF4', 'colorSecondary': '#0C61E0', 'colorTertiary': '#2baab1', 'colorQuaternary': '#383f48'}">
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Probe Bangladesh Official</title>
    <meta name="keywords" content="Prove Official"/>
    <meta name="description" content="Prove bangladesh website">
    <meta name="author" content="okler.net">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('public/img/favicon.png')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Roboto&display=swap|Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400"
          rel="stylesheet" type="text/css')}}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/animate/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/owl.carousel/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/theme-elements.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/theme-blog.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/theme-shop.css')}}">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/rs-plugin/css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/rs-plugin/css/layers.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/rs-plugin/css/navigation.css')}}">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    {!!Html::style('public/custom/js/plugins/select/select2.min.css')!!}

    
    <!--datepicker-->
    
    {!!Html::style('public/custom/js/plugins/datepicker/datepicker3.css')!!}
    

    <!-- Demo CSS -->

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/skins/skin-corporate-8.css')}}">


    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">

    <!-- Head Libs -->
    

</head>
<body>
<div class="body">
    <header id="header"
            data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 164, 'stickySetTop': '-164px', 'stickyChangeLogo': false}">
        <div class="header-body border-0">
            <!--top header start-->
            <div class="header-top header-top-default border-bottom-0 bg_color">
                <div class="container">
                    <div class="header-row py-2">
                        <div class="header-column justify-content-start">
                            <div class="header-row">
                                <nav class="header-nav-top">
                                    <ul class="nav nav-pills text-uppercase text-2">
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="nav-link pl-0 text-light " href="">
                                                PROBE INDIA
                                            </a>
                                        </li>
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="nav-link text-light  pr-0" href="">
                                                INDIA:+9530123654
                                            </a>
                                        </li>
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="nav-link text-light  pr-0" href="">
                                                BANGLADESH:+88016784555
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header-column justify-content-end pull-right">
                            <div class="header-row">
                                <nav class="header-nav-top">
                                    <ul class="nav nav-pills text-uppercase text-2">
                                        <li class="nav-item nav-item-anim-icon ">
                                            <a class="nav-link pl-0 text-light " href="">
                                               APPOINTMENT
                                            </a>
                                        </li>
                                        <li class="nav-item nav-item-anim-icon ">
                                            <a class="nav-link text-light  pr-0" href="">
                                                HOME COLLECTION
                                            </a>
                                        </li>
                                         @if (Auth::Check())
                                          <li class="nav-item nav-item-anim-icon ">
                                           <div class="dropdown">
                                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                               <span class="userName">{{Auth::User()->name}}</span>
                                              </button>
                                              <div class="dropdown-menu profile-menu" aria-labelledby="dropdownMenuButton" style="transform: translate3d(-107px, 45px, 12px);">
                                                <a class="dropdown-item" href="{{url('patient-order')}}">My Orders</a>
                                                <a class="dropdown-item" href="{{url('patient-profile')}}">Profile</a>
                                                 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Signout
                                                  </a>
                                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                      {{ csrf_field() }}
                                                  </form>
                                              </div>
                                            </div>
                                        </li> 
                                        @else
                                        <li class="nav-item nav-item-anim-icon ">
                                            <a class="nav-link text-light  pr-0"  href="{{URL::to('login-form')}}">
                                                LOGIN
                                            </a>
                                        </li>
                                         <li class="nav-item nav-item-anim-icon ">
                                            <a class="nav-link text-light  pr-0"  href="{{URL::to('register-form')}}">
                                                REGISTER
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!--end top header start-->

            <div class="header-container container">
                <div class="header-row py-3">
                    <div class="header-column justify-content-start w-50 order-md-1 d-md-flex">
                        <div class="header-row">
                            <div class="header-logo">
                                <a href="{{URL::to('/')}}">
                                    <img alt="Probe" src="{{ asset('public/frontend/img/prob.png') }}" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav-bar header-nav-bar-top-border bg_light">
                <div class="header-container container">
                    <div class="header-row">
                        <div class="header-column">
                            <div class="header-row justify-content-end">
                                <div class="header-nav p-0">
                                    <div class="header-nav header-nav-line header-nav-divisor header-nav-spaced justify-content-lg-center">
                                        <div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                            <nav class="collapse">
                                                <ul class="nav nav-pills flex-column flex-lg-row" id="mainNav">
                                                     <li class="dropdown dropdown-mega">
                                                        <a class="dropdown-item dropdown-toggle active" href="{{URL::to('/')}}">HOME </a>
                                                    </li>

                                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle " href="#"> ABOUT US </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="{{url('about')}}">Company</a></li>
                                                            <li class="dropdown-submenu"><a href="{{url('about')}}">Management</a></li>
                                                            <li class="dropdown-submenu"><a href="{{url('about')}}">Milestone</a></li>
                                                            <li class="dropdown-submenu"><a href="{{url('about')}}">Investor</a></li>
                                                            <li class="dropdown-submenu"><a href="{{url('about')}}">CSR</a></li>
                                                        </ul>
                                                    </li>

                                                    <li class="dropdown dropdown-mega">
                                                        <a class="dropdown-item dropdown-toggle" href="">SERVICES </a>
                                                    </li>

                                                    <li class="dropdown">
                                                        <a class="dropdown-item dropdown-toggle" href="">PARTNERS</a>
                                                        <ul class="dropdown-menu">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Hospital</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Clinic</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Diagnostic Center</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Corporate</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Brand Ambassador</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="dropdown-item dropdown-toggle" href=""> OUR
                                                            CENTER </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">India</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Bangladesh</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="dropdown-item dropdown-toggle" href="{{url('http://franchise.probebangladesh.com/franchise-register')}}" target="__blank"> FRANCHISE</a>
                                                    </li>
                                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle"href=""> NEWS </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Event</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Blogs</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="{{url('news-page')}}">News</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Success Story</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a class="dropdown-item dropdown-toggle" href="">CONTACT</a>
                                                        <ul class="dropdown-menu">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="{{url('contact-us')}}">Contact Us</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="">Carrer</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="">Feedback</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                   
                                                </ul>
                                            </nav>
                                        </div>
                                         <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav"><i class="fas fa-bars"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')
    <div class="cart-box">
        <a href="{{url('view-cart')}}">
            <div class="total-item">
                <i class="fa fa-shopping-bag"></i><br>
                <?php
                    $contents=Cart::getContent();
                    $jsonContent = json_decode($contents);
                ?>
                @if(isset($jsonContent) && !empty($jsonContent))
                <b>{{count(Cart::getContent())}} Items</b>
                @else
                <b>0 Items</b>
                @endif
            </div>
            <div class="total-amount">
                @if(Cart::getSubTotal() !='')
                <b>{{Cart::getSubTotal()}} TK</b>
                @else
                <b>0 TK</b>
                @endif
            </div>
        </a>
    </div>
    <footer id="footer">
        <div class="container">
            <div class="row py-4 my-4 footer_bottom">
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <h5 class="text-3 mb-3">ABOUT US</h5>
                    <p class="links">
                        PROBE is one of the leading reference Laboratories in Bangladesh
                        that ensures precision, accuracy & quality at all steps with
                        full-service flexibility in a changing healthcare environment.</p>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0 popular_links">
                    <h5 class="text-3 mb-3">Popular Link</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="media imp-links pb-1"><a class="links" class="" href="{{url('/')}}">Home</a></li>
                        <li class="media imp-links pb-1"><a class="links" href="{{url('/')}}">Partners</a></li>
                        <li class="media imp-links pb-1"><a class="links" href="{{url('http://franchise.probebangladesh.com/franchise-register')}}" traget="__blank">Franchise</a></li>
                        <li class="media imp-links pb-1"><a  class="links" href="{{url('/')}}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-md-0">
                    <h5 class="text-3 mb-3">CONTACT US / CUSTOMER SERVICE</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 pb-1 links">
                                <p class="text-3 text-color-light opacity-8 mb-1 footer_contact">
                                    <span class="links">House No.9,Road No.1 Block-F,
                                        Janata Co-operative,Houseing Society Ltd,
                                        Ring Road Adabar,Dhaka-1207,Bangladesh.
                                    </span>
                                </p>
                                <h6 class="footer_contact for_patient">For Patient:</h6>
                                <p class="footer_contact links">Mobile:+8801942559895 <br>Email:contact.alok@gmail.com</p>
                                <h6 class="footer_contact for_patient">For Partner:</h6>
                                <p class="footer_contact links">Mobile:+8801875314620<br>Email:contact.alok@gmail.com</p>

                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-2 social_links">
                    <h5 class="text-3 mb-3">Social Links</h5>
                    <p class="social-links">
                        <a href="https://www.facebook.com/PROBEBD/" target="__blank">
                            <span class="py-2 mr-1 mb-2 links">
                                <span class="fa fa-facebook-square"></span>
                                 FACEBOOK
                            </span>
                         </a>
                        <br><a href="#">
                            <span class="py-2 mr-1 mb-2 links"><span class="fa fa-twitter-square"></span> TWITTER</span>
                        </a>
                        <br><a href="#">
                            <span class="py-2 mr-1 mb-2 links"><span class="fa fa-youtube-square"></span> YOUTUBE</span>
                        </a>
                        <br><a href="#">
                            <span class="py-2 mr-1 mb-2 links"><span class="fa fa-linkedin-square"></span> LINKED IN</span>
                        </a>
                        <br><a href="#">
                            <span class="py-2 mr-1 mb-2 links"><span class="fa fa-whatsapp"></span> WHATSAPP</span>
                        </a>
                        
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row py-4">
                    <div class="col-lg-2 d-flex align-items-center justify-content-center justify-content-lg-start mb-2 mb-lg-0">
                        <a href="#" class="logo pr-0 pr-lg-3">
                            <img alt="Porbe Bangladesh Official" src="{{ asset('public/frontend/img/prob.png') }}" class="opacity-5" height="33">
                        </a>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
                        <p>© Copyright 2019. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end">
                        <nav id="sub-menu">
                            <ul>
                                <li><i class="fas fa-angle-right"></i><a href="#"
                                                                         class="ml-1 text-decoration-none"> FAQ's</a>
                                </li>
                                <li><i class="fas fa-angle-right"></i><a href="#"
                                                                         class="ml-1 text-decoration-none"> Sitemap</a>
                                </li>
                                <li><i class="fas fa-angle-right"></i><a href="#"
                                                                         class="ml-1 text-decoration-none"> Contact
                                        Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>


<!--customer add modal-->
<div id="login-modal" class="modal fade log_model" tabindex="-3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                 <h4 class="modal-title">LOGIN HERE</h4> 
                <button type="button" class="close common_header" data-dismiss="modal" aria-hidden="true">×</button> 
               
            </div> 
            <div class="modal-body">  
            <form action="{{url('patient-login')}}" method="POST" enctype="multipart/form-data">
             @csrf           
                <div class="row">  
                    <div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="field-5" class="control-label lebal_name">Name</label> 
                            <input type="text" class="form-control" id="field-5" name="username" required=""> 
                        </div> 
                    </div> 
                    <div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="field-6" class="control-label lebal_name">Password</label> 
                            <input type="Password" class="form-control" id="field-6" name="password" required=""> 
                        </div> 
                    </div>   
                  <div class="modal-footer col-md-12 pull-right"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Submit</button> 
                </div> 
             </div> 
              </form>
           </div> 
         </div> 
       </div>
    </div><!-- /.modal -->
</div>

<!-- Vendor -->
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
{!!Html::script('public/custom/js/ams.js')!!}
<script src="{{asset('public/frontend/vendor/jquery.appear/jquery.appear.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.cookie/jquery.cookie.min.js')}}"></script>

<script src="{{asset('public/frontend/vendor/popper/umd/popper.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/common/common.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.gmap/jquery.gmap.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.lazyload/jquery.lazyload.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/isotope/jquery.isotope.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/vide/jquery.vide.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/vivus/vivus.min.js')}}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{asset('public/frontend/js/theme.js')}}"></script>

<!-- Current Page Vendor and Views -->
<script src="{{asset('public/frontend/vendor/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Theme Custom -->
<script src="https://preview.oklerthemes.com/porto/7.6.0/js/custom.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
{!!Html::script('public/custom/js/plugins/select/select2.min.js')!!}
{!!Html::script('public/custom/js/plugins/datepicker/bootstrap-datepicker.js')!!}
<script src="{{asset('public/frontend/vendor/modernizr/modernizr.min.js')}}"></script>
<!-- Theme Initialization Files -->
<script src="{{asset('public/frontend/js/theme.init.js')}}"></script>
@yield('scripts')
@section('scripts')
<script type="text/javascript">
    $(function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-42715764-5', 'auto');
    ga('send', 'pageview');
</script>
@endsection

@include('sweet::alert')

</body>
</html>