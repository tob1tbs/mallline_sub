@extends('layout.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/slider-range.css')}}">
@endsection

@section('content')
<main class="main">
    <div class="page-header">
        <div class="container">
            <div class="archive-header"> 
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <h1 class="mb-15 Center">{{ trans('site.all_products') }}</h1>
                        <div class="breadcrumb">
                            <a href="{{ route('actionMainIndex') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{ trans('site.home') }}</a>
                            <span></span> {{ trans('site.your_cart_is_empty') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-50">
        <div class="row">
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">{{ trans('site.by_price') }}</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="slider-range" class="mb-20"></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">{{ trans('site.from') }}: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                <div class="caption">{{ trans('site.to') }}: <strong id="slider-range-value2" class="text-brand"></strong></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">{{ trans('site.by_category') }}</h5>
                    <ul>
                        @foreach($product_category_list as $category_item)
                        <li>
                            <a href="{{ url()->current().'?'.http_build_query(array_merge(request()->except('page'),['category_id' => $category_item->id])) }}">{{ json_decode($category_item->name)->{app()->getLocale()} }}</a><span class="count">{{ $category_item->getProductData()->count() }}</span>
                        </li>
                         @endforeach
                    </ul>
                </div>
                @if(count($product_options) > 0)
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-0">{{ trans('site.parameters') }}</h5>
                    <form method="GET" action="{{ request()->fullUrl() }}" class="list-group">
                        <div class="list-group-item mb-10 mt-10">
                            @foreach($product_options as $option_item)
                            <label class="fw-900">{{ json_decode($option_item->name)->ge }}</label>
                            @foreach($option_item->optionValues as $value_item)
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="option[{{ $value_item->option_key }}]" id="value_{{ $value_item->id }}" value="" />
                                <label class="form-check-label" for="value_{{ $value_item->id }}"><span>{{ json_decode($value_item->name)->{app()->getLocale()} }}</span></label>
                                <br />
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                        <button class="btn btn-sm btn-default" type="submit"><i class="fi-rs-filter mr-5"></i> ფილტრაცია</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10 d-flex justify-content-between">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>{{ trans('site.show') }}:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> @if(empty(request()->show)) 20 @else {{ request()->show }} @endif <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    @foreach($show_list as $k => $v)
                                    <li>
                                        <a class="@if($k == request()->show) active @endif" href="{{ url()->current().'?'.http_build_query(array_merge(request()->except('page'),['show' => $k])) }}">{{ $v }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>{{ trans('site.sort_by') }}:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> @if(empty(request()->sort)) {{ $sort_list['DATE_NEW'][app()->getLocale()] }} @else {{ $sort_list[request()->sort][app()->getLocale()] }} @endif <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    @foreach($sort_list as $k => $v)
                                    <li><a class="@if($k == request()->sort) active @endif" href="{{ url()->current().'?'.http_build_query(array_merge(request()->except('page'),['sort' => $k])) }}">{{ $v[app()->getLocale()] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @if(count($product_list) > 0)
                    @foreach($product_list as $product_item)
                    <div class="col-lg-2-4 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('actionProductsView', $product_item->product_id) }}">
                                        <img class="default-img" src="{{ $product_item->photo }}" alt="" />
                                        @if(count($product_item->getProductGallery))
                                        <!-- <img class="hover-img" src="{{ $product_item->getProductGallery[0]->path }}" alt="" /> -->
                                        @endif
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="{{ trans('site.add_to_wishlist') }}" class="action-btn" href="javascript:;" onclick="AddToWishlis({{ $product_item->product_id }})"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="{{ trans('site.compare') }}" class="action-btn" href="javascript:;" onclick="ProductCompare({{ $product_item->product_id }})"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="{{ trans('site.quiq_view') }}" class="action-btn" onclick="ProductQuickView({{ $product_item->product_id }})"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if(!empty($product_item['discount_price']) && $product_item['discount_percent'])
                                    <span class="sale">-{{ $product_item['discount_percent'] }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{ route('actionProductsIndex', $product_item->getCategoryData->id) }}">{{ json_decode($product_item->getCategoryData->name)->{app()->getLocale()} }}</a>
                                </div>
                                <h2><a href="{{ route('actionProductsView', $product_item->id) }}">{{ $product_item->{"name_" . app()->getLocale()} }}</a></h2>
                                <!-- <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div> -->
                                <div>
                                    <span class="font-small text-muted">By <a href="">MollineFood</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    @if(!empty($product_item->discount_price))
                                    <div class="product-price">
                                        <span>₾{{ $product_item->discount_price / 100 }}</span>
                                        <span class="old-price">₾{{ $product_item->price / 100}}</span>
                                    </div>
                                    @else
                                    <div class="product-price">
                                        <span>₾{{ $product_item->price / 100}}</span>
                                    </div>
                                    @endif
                                    @if($product_item->count < 1)
                                    <span class="stock-status out-stock mb-0" style="color: #f74b81;">{{ trans('site.no_stock') }}</span>
                                    @else
                                    <div class="add-cart" onclick="AddToCart({{ $product_item->product_id }})">
                                        <a class="add" href="javascript:;"><i class="fi-rs-shopping-cart mr-5"></i>{{ trans('site.add_to_cart') }} </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-primary" style="margin-left: 13px;" role="alert">{{ trans('site.product_list_is_empty') }}</div>
                    @endif
                </div>
                {{ $product_list->links('vendor.custom') }}
            </div>
        </div>
    </div>
</main>
@endsection
@php 
    
    if(request()->has('price_from')) {
        $min = request()->price_from;
    } else {
        $min = $product_all->min('price') / 100;
    }
    
    if(request()->has('price_to')) {
        $max = request()->price_to;
    } else {
        $max = $product_all->max('price') / 100;
    }

@endphp
@section('js')
<script type="text/javascript">
    if ($("#slider-range").length) {
        $(".noUi-handle").on("click", function () {
            $(this).width(50);
        });
        var rangeSlider = document.getElementById("slider-range");
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: "₾"
        });
        noUiSlider.create(rangeSlider, {
            start: [{{ $min }}, {{ $max }}],
            step: 1,
            range: {
                min: [{{ $product_all->min('price') / 100 }}],
                max: [{{ $product_all->max('price') / 100 }}]
            },
            format: moneyFormat,
            connect: true
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            document.getElementById("slider-range-value1").innerHTML = values[0];
            document.getElementById("slider-range-value2").innerHTML = values[1];
            document.getElementsByName("min-value").value = moneyFormat.from(values[0]);
            document.getElementsByName("max-value").value = moneyFormat.from(values[1]);
        });

        rangeSlider.noUiSlider.on("change", function (values, handle) {
            $.ajax({
                dataType: 'json',
                url: "/products/ajax/price",
                type: "GET",
                data: {
                    price_from: moneyFormat.from(values[0]),
                    price_to: moneyFormat.from(values[1]),
                    current_url: '{{ url()->current().'?'.http_build_query(array_merge(request()->except('page', 'price_from', 'price_to'))) }}',
                },
                success: function(data) {
                    if(data['status'] == true) {
                        window.location.href = data['redirect_url'];
                    }
                }
            });
        });
    }
</script>
@endsection