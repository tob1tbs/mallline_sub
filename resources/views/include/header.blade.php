<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="{{ route('actionMainWishlist') }}">{{ trans('site.heading_text_1') }}</a></li>
                            <li><a href="{{ route('actionMainHowToBuy') }}">{{ trans('site.heading_text_2') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block" style="overflow: hidden; position: relative; height: 14px;">
                            <ul style="position: absolute; margin: 0px; padding: 0px; top: 0px;">
                                <li style="margin: 0px; padding: 0px;"></li>
                                <!-- <li style="margin: 0px; padding: 0px;">დარეგისტრირდი და მიიღე უფასო მიწოდება</li> -->
                                <!-- <li style="margin: 0px; padding: 0px;">აქცია გაგრძელდება 1 სექტემბრამდე</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>
                                @if(app()->getLocale() == 'ge')
                                <a class="language-dropdown-active" href="javascript:;"><img src="{{ asset('assets/imgs/theme/geo.png') }}" alt=""> {{ trans('site.lang_ge') }} <i class="fi-rs-angle-small-down"></i></a>
                                @else
                                <a class="language-dropdown-active" href="javascript:;"><img src="{{ asset('assets/imgs/theme/en.png') }}" alt=""> {{ trans('site.lang_en') }} <i class="fi-rs-angle-small-down"></i></a>
                                @endif
                                <ul class="language-dropdown">
                                    <li>
                                        @if(app()->getLocale() == 'ge')
                                        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}"><img src="{{ asset('assets/imgs/theme/en.png') }}" alt="">{{ trans('site.lang_en') }}</a>
                                        @else
                                        <a href="{{ LaravelLocalization::getLocalizedURL('ge') }}"><img src="{{ asset('assets/imgs/theme/geo.png') }}" alt="">{{ trans('site.lang_ge') }}</a>
                                        @endif
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('actionMainIndex') }}"><img src="{{ url('assets/imgs/theme/mallline.png') }}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{ route('actionProductsIndex') }}" method="GET">
                            <select class="select-active" name="category_id"  style="font-size: 12px;">
                                <option value="" style="font-size: 12px;">{{ trans('site.categories') }}</option>
                                @foreach($category_list as $category_item)
                                <option value="{{ $category_item->id }}" @if($category_item->id == request()->category_id) selected @endif style="font-size: 12px;"> {{ json_decode($category_item->name)->{app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="search_query" placeholder="{{ trans('site.search_query') }}"  value="{{ request()->search_query }}">
                            <button id="search"><span class="fi-rs-search"></span></button>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('actionMainCompare') }}">
                                    <img class="svgInject"  src="{{ asset('assets/imgs/theme/icons/compare.png') }}" />
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="javascript:;"  id="cartdp">
                                    <img alt="Molline" src="{{ asset('assets/imgs/theme/icons/Component21.png') }}" />
                                    <span class="pro-count blue cart-item-count">{{ Cart::getTotalQuantity() }}</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 cart-body" id="cart-dropdown">
                                    @if(count(Cart::getContent()) > 0)
                                    <ul class="header-cart-body">
                                        @foreach(Cart::getContent() as $cart_item)
                                        <li class="cart-item-{{$cart_item->id}}">
                                            <div class="shopping-cart-img">
                                                <a href="{{ route('actionProductsView', $cart_item->id) }}"><img alt="Molline" src="@if(!empty($cart_item['attributes']['photo'])) {{ $cart_item['attributes']['photo'] }} @endif" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{ route('actionProductsView', $cart_item->id) }}">{{ $cart_item->name }}</a></h4>
                                                <h4><span>{{ $cart_item->quantity }} × </span>₾ {{ $cart_item->price}}</h4>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="javascript:;" onclick="RemoveFromCart({{ $cart_item->id }})"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>{{ trans('site.sum') }}: <span class="cart-price-total">₾ {{ number_format(Cart::getTotal(), 2) }}</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('actionMainCart') }}" class="outline">{{ trans('site.cart') }}</a>
                                            <a href="{{ route('actionMainCheckout') }}">{{ trans('site.checkout') }}</a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="alert alert-primary text-center" role="alert" style="margin-bottom: 0;">{{ trans('site.your_cart_is_empty') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                @if(Auth::check() == false)
                                <a href="javascript:;" id="account">
                                    <img class="svgInject" alt="Molline" src="{{ asset('assets/imgs/theme/icons/Component20.png') }}" />
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown" id="account-dropdown">
                                    <form method="post" class="fmhover" id="user_signIn">
                                        <div class="form-group">
                                            <input type="text" id="user_email" name="user_email" placeholder="{{ trans('site.user_email') }} *" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="user_password" name="user_password" placeholder="{{ trans('site.password') }} *" />
                                        </div>
                                        <div class="login_footer form-group mb-20">
                                            <div class="chek-form">
                                            </div>
                                            <a class="text-muted" href="{{ route('actionUsersRestore') }}">{{ trans('site.user_password_restore') }}</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="fmhoverbtn1" type="button" onclick="UserSignInSubmit()">{{ trans('site.sign-in') }}</button>
                                            <button type="button" id="fmhoverbtn2" onclick="javascript:location.href = '{{ route('actionUsersSignUp') }}'">{{ trans('site.sign-up') }}</button>
                                        </div>
                                        <p class="fmhoveran">{{ trans('site.or') }}</p>
                                        <div class="form-group Center">
                                            <button type="button" id="fmhoverbtn3" onclick="javascript:location.href = '{{ route('actionFacebookRedirect') }}'">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <g>
                                                        <path fill="#4267b2" stroke="null"  d="m297.061454,170.770307l0,-50.7383c0,-22.905479 5.060513,-34.49139 40.617274,-34.49139l44.612416,0l0,-85.22969l-74.442807,0c-91.222402,0 -121.319136,41.815816 -121.319136,113.595196l0,56.864184l-59.927126,0l0,85.22969l59.927126,0l0,255.689069l110.532254,0l0,-255.689069l75.108664,0l10.121026,-85.22969l-85.22969,0z"></path>
                                                    </g>
                                                </svg>    
                                            </button>
                                            <button type="button" id="fmhoverbtn4" onclick="javascript:location.href = '{{ route('actionGoogleRedirect') }}'">
                                                <svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <path d="M17.64,9.20454545 C17.64,8.56636364 17.5827273,7.95272727 17.4763636,7.36363636 L9,7.36363636 L9,10.845 L13.8436364,10.845 C13.635,11.97 13.0009091,12.9231818 12.0477273,13.5613636 L12.0477273,15.8195455 L14.9563636,15.8195455 C16.6581818,14.2527273 17.64,11.9454545 17.64,9.20454545 L17.64,9.20454545 Z" fill="#4285F4"></path>
                                                        <path d="M9,18 C11.43,18 13.4672727,17.1940909 14.9563636,15.8195455 L12.0477273,13.5613636 C11.2418182,14.1013636 10.2109091,14.4204545 9,14.4204545 C6.65590909,14.4204545 4.67181818,12.8372727 3.96409091,10.71 L0.957272727,10.71 L0.957272727,13.0418182 C2.43818182,15.9831818 5.48181818,18 9,18 L9,18 Z" fill="#34A853"></path>
                                                        <path d="M3.96409091,10.71 C3.78409091,10.17 3.68181818,9.59318182 3.68181818,9 C3.68181818,8.40681818 3.78409091,7.83 3.96409091,7.29 L3.96409091,4.95818182 L0.957272727,4.95818182 C0.347727273,6.17318182 0,7.54772727 0,9 C0,10.4522727 0.347727273,11.8268182 0.957272727,13.0418182 L3.96409091,10.71 L3.96409091,10.71 Z" fill="#FBBC05"></path>
                                                        <path d="M9,3.57954545 C10.3213636,3.57954545 11.5077273,4.03363636 12.4404545,4.92545455 L15.0218182,2.34409091 C13.4631818,0.891818182 11.4259091,0 9,0 C5.48181818,0 2.43818182,2.01681818 0.957272727,4.95818182 L3.96409091,7.29 C4.67181818,5.16272727 6.65590909,3.57954545 9,3.57954545 L9,3.57954545 Z" fill="#EA4335"></path>
                                                        <path d="M0,0 L18,0 L18,18 L0,18 L0,0 Z"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @else
                                <a href="{{ route('actionUsersIndex') }}">
                                    <img class="svgInject" alt="Molline" src="{{ asset('assets/imgs/theme/icons/Component20.png') }}" />
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('actionMainIndex') }}"><img src="{{ asset('assets/imgs/theme/mallline.png') }}" alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="{{ route('actionBuilderIndex') }}">
                            <span class="fi-rs-apps"></span> <span class="et">{{ trans('site.build_shop') }} </span> 
                        </a>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                @foreach($navigation_list as $navigation_item)
                                <li><a href="{{ route($navigation_item->url) }}">{{ json_decode($navigation_item->title)->{app()->getLocale()} }}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
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
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('actionMainWishlist') }}">
                                <img class="svgInject"  src="{{ asset('assets/imgs/theme/icons/compare.png') }}" />
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('actionMainCart') }}">
                                <img alt="Molline" src="{{ url('assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count cart-item-count white">{{ Cart::getTotalQuantity() }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="{{ asset('assets/imgs/theme/mallline.png') }}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('actionProductsIndex') }}" method="GET">
                    <input type="text" name="search_query" placeholder="{{ trans('site.search_query') }}"  value="{{ request()->search_query }}">
                    <button id="search"><span class="fi-rs-search"></span></button>
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <nav>
                    <ul class="mobile-menu font-heading">
                        @foreach($navigation_list as $navigation_item)
                        <li class="menu-item-has-children">
                            <a href="{{ route($navigation_item->url) }}">{{ json_decode($navigation_item->title)->{app()->getLocale()} }}</a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15"></h6>
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
            <div class="site-copyright"> 2022 © Molline. All rights reserved.</div>
        </div>
    </div>
</div>
<style type="text/css">
    .select2-dropdown .select2-search--dropdown .select2-search__field {
        font-size: 12px;
    }

    #fmhoverbtn4{
        background: white;
        border: none;
        width: 40%;
        margin-right: 0.5rem;
    }
    #fmhoverbtn4:hover{
      background-color: #d9f2f9 !important;
    }
</style>