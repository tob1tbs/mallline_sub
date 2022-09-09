@extends('layout.layout')

@section('content')
<section class="home-slider style-2 position-relative">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="home-slide-cover">
                    <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                        @foreach($slider_list->whereNull('is_banner') as $slider_item)
                        <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ $slider_item->path }})">
                            <div class="bg-gradient"></div>
                            <div class="slider-content">
                                <h1 class="display-2 mb-40">
                                    {{ json_decode($slider_item->text)->{'small_text_'.app()->getLocale()} }}
                                </h1>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="slider-arrow hero-slider-1-arrow"></div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-xl-block">
                @foreach($slider_list->whereNotNull('is_banner')->random(1) as $slider_item)
                <div class="banner-img style-3 animated animated" style="background-image: url({{ $slider_item->path }})">
                    <div class="bg-gradient"></div>
                    <div class="banner-text mt-50">
                        <h2 class="mb-50">
                            {{ json_decode($slider_item->text)->{'small_text_'.app()->getLocale()} }}
                        </h2>
                        @if(!empty($slider_item->url))
                        <a href="{{ $slider_item->url }}" class="btn btn-xs">{{ trans('site.shop_now') }}<i class="fi-rs-arrow-small-right"></i></a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="featured section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                    <div class="banner-icon">
                        <img src="{{ asset('assets/imgs/theme/icons/price-tag.png') }}" alt="" />
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">{{ trans('site.badge_1_heading') }}</h3>
                        <p>{{ trans('site.badge_1_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                    <div class="banner-icon">
                        <img src="{{ asset('assets/imgs/theme/icons/fast-delivery.png') }}" alt="" />
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">{{ trans('site.badge_2_heading') }}</h3>
                        <p>{{ trans('site.badge_2_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                    <div class="banner-icon">
                        <img src="{{ asset('assets/imgs/theme/icons/hand-shake.png') }}" alt="" />
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">{{ trans('site.badge_3_heading') }}</h3>
                        <p>{{ trans('site.badge_3_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                    <div class="banner-icon">
                        <img src="{{ asset('assets/imgs/theme/icons/new-product.png') }}" alt="" />
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">{{ trans('site.badge_4_heading') }}</h3>
                        <p>{{ trans('site.badge_4_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                    <div class="banner-icon">
                        <img src="{{ asset('assets/imgs/theme/icons/exchange.png') }}" alt="" />
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">{{ trans('site.badge_5_heading') }}</h3>
                        <p>{{ trans('site.badge_5_body') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@foreach($product_list as $product_item)
    @if(count($product_item['products']) > 0)
    <section class="popular-categories section-padding">
        <div class="container">
            <div class="section-title">
                <div class="title">
                  <img src="{{ url('assets\imgs\theme\icons\Group 6820.png') }}" class="titleleftimg" style="width: 15%">  <h3>{{ json_decode($product_item['name'])->{app()->getLocale()} }} |</h3>  <a href="{{ route('actionProductsIndex', 'category_id='.$product_item['id']) }}" class="allprod">{{ trans('site.all_products') }}</a>
                </div>
                <div class="slider-arrow slider-arrow-{{ $product_item['id'] }} flex-right carausel-{{ $loop->index }}-columns-arrow" id="carausel-{{ $loop->index }}-columns-arrows"></div>
            </div>
            <div class="carausel-9-columns-cover position-relative">
                <div class="carausel-9-columns" id="carausel-9-columns">
    	           @foreach($product_item['products'] as $product_data)
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="{{ route('actionProductsView', $product_data['id']) }}">
                                    <img class="default-img" src="{{ $product_data['photo'] }}" alt="" />
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="{{ trans('site.add_to_wishlist') }}" class="action-btn" href="javascript:;" onclick="AddToWishlis({{ $product_data['id'] }})"><i class="fi-rs-heart"></i></a>
                                <a aria-label="{{ trans('site.compare') }}" class="action-btn" href="javascript:;" onclick="ProductCompare({{$product_data['id']}})"><i class="fi-rs-shuffle"></i></a>
                                <a aria-label="{{ trans('site.quiq_view') }}" class="action-btn" onclick="ProductQuickView({{ $product_data['id'] }})"><i class="fi-rs-eye"></i></a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">
                                @if(!empty($product_data['discount_price']) && $product_data['discount_percent'])
                                <span class="sale">{{ $product_data['discount_percent'] }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <h2><a href="{{ route('actionProductsView', $product_data['id']) }}">{{ $product_data['name_'.app()->getLocale()] }}</a></h2>
                            <div>
                                <span class="font-small text-muted">By <a href="javascript:;">MollineFood</a></span>
                            </div>
                            <div class="product-card-bottom">
                                @if(!empty($product_data['discount_price']))
                                <div class="product-price">
                                    <span>{{ $product_data->discount_price / 100 }} ₾</span>
                                    <span class="old-price">{{ $product_data->getProductPrice->price / 100 }} ₾</span>
                                </div>
                                @else
                                <div class="product-price">
                                    <span>₾{{ $product_data->getProductPrice->price / 100}}</span>
                                </div>
                                @endif
                                @if($product_data['count'] < 1)
                                <span class="stock-status out-stock mb-0" style="color: #f74b81;">{{ trans('site.no_stock') }}</span>
                                @else
                                <div class="add-cart" onclick="AddToCart({{ $product_data['id'] }})">
                                    <a class="add" href="javascript:;"><i class="fi-rs-shopping-cart mr-5"></i>{{ trans('site.add_to_cart') }} </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endforeach
@endsection

@section('js')

@endsection