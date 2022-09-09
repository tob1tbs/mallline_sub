<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title>Molline.ge</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    @yield('css')
</head>
<body>
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <div class="product-image-slider quick-view-slider">
                                    
                                </div>
                                <div class="slider-nav-thumbnails quick-view-thumbs">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <div class="product-stock-badge">
                                    
                                </div>
                                <div class="sale-percent-badge">
                                    
                                </div>
                                <h3 class="title-detail"><a href="" class="text-heading quiq-view-heading"></a></h3>
                                <div class="font-xs mt-20">
                                    <ul>
                                        <li class="mb-5">{{ trans('site.vendor') }}: <span class="text-brand">Molline</span></li>
                                    </ul>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price quiq-current-price text-brand">₾38</span>
                                        <span>
                                            <span class="old-price quiq-old-price font-md ml-15">₾52</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink quantity-quiq">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="number" value="0" class="qty-val">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="button" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('include.header')
    @yield('content')
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('assets/imgs/theme/mallline.png') }}" alt="" />
                </div>
                <div class="loader loader--style2" title="1">
                    <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                       width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                    <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
                      <animateTransform attributeType="xml"
                        attributeName="transform"
                        type="rotate"
                        from="0 25 25"
                        to="360 25 25"
                        dur="0.6s"
                        repeatCount="indefinite"/>
                      </path>
                    </svg>
                </div>  
                <div class="preloader-text" style="display: none;">მიმდინარეობს მაღაზიის შექმნა გთხოვთ არ გათიშოთ აღნიშნული ფანჯარა, პროცესი ძალიან მალე დასრულდება.</div>
            </div>
        </div>
    </div>
    <footer class="main">
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">{{ trans('site.company') }}</h4>
                        <ul class="footer-list mb-sm-4 mb-md-0">
                            <li><a href="{{ route('actionMainAboutUs') }}">{{ trans('site.about_us') }}</a></li>
                            <li><a href="{{ route('actionMainPrivacy') }}">{{ trans('site.privacy') }}</a></li>
                            <li><a href="{{ route('actionMainTerms') }}">{{ trans('site.terms') }}</a></li>
                            <li><a href="{{ route('actionMainContact') }}">{{ trans('site.contact') }}</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">{{ trans('site.corporate') }}</h4>
                        <ul class="footer-list mb-sm-4 mb-md-0">
                            <li><a href="{{ route('actionVendorsIndex') }}">{{ trans('site.vendors') }}</a></li>
                            <li><a href="{{ route('actionVendorsGuide') }}">{{ trans('site.vendors_guide') }}</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">{{ trans('site.quick_links') }}</h4>
                        <ul class="footer-list mb-sm-4 mb-md-0">
                            <li><a href="{{ route('actionMainWishlist') }}">{{ trans('site.wishlist') }}</a></li>
                            <li><a href="{{ route('actionMainCompare') }}">{{ trans('site.compare') }}</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">{{ trans('site.subscribe') }}</h4>
                        <form class="form-subcriber d-flex">
                            <input type="email" class="footerform" id="subscribe_email" name="subscribe_email" placeholder="{{ trans('site.subscribe_email') }}" tabindex="0">
                            <button class="btn" id="footerformbtn" type="button" onclick="SubscribeButton()" tabindex="0">{{ trans('site.subscribe_button') }}</button>
                        </form>
                        <div class="mobile-social-icon">
                            @if(!empty($parametersArray['facebook']))
                            <a href="{{ $parametersArray['facebook'] }}"><img src="{{ url('assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                            @endif
                            @if(!empty($parametersArray['instagram']))
                            <a href="{{ $parametersArray['instagram'] }}"><img src="{{ url('assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                            @endif
                            @if(!empty($parametersArray['youtube']))
                            <a href="{{ $parametersArray['youtube'] }}"><img src="{{ url('assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                    <p class="font-sm mb-0 Center">&copy; 2022, Molline.ge | {{ trans('site.all_right_reserved') }}</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/main.js?v=5.2') }}"></script>
    <script src="{{ asset('assets/js/shop.js?v=5.2') }}"></script>
    @yield('js')
    <script src="{{ asset('assets/scripts/global.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/users_scripts.js') }}"></script>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '435205588210356',
          cookie     : true,
          xfbml      : true,
          version    : '{api-version}'
        });
          
        FB.AppEvents.logPageView();   
          
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>