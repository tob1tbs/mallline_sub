@extends('layout.layout')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
@endsection

@section('content')
<main class="main">
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{ $product_data->photo }}" alt="product image" />
                                    </figure>
                                    @foreach($product_data->getProductGallery as $gallery_item)
                                    <figure class="border-radius-10">
                                        <img src="{{ $gallery_item->path }}" alt="product image" />
                                    </figure>
                                    @endforeach
                                </div>
                                <div class="slider-nav-thumbnails">
                                    <div><img src="{{ $product_data->photo }}" alt="product image" /></div>
                                    @foreach($product_data->getProductGallery as $gallery_item)
                                    <div><img src="{{ $gallery_item->path }}" alt="product image" /></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                @if($product_data['count'] < 1)
                                <span class="stock-status out-stock mb-2" style="color: #f74b81;">არ არის მარაგში</span>
                                @endif
                                @if(!empty($product_data->discount_price))
                                <span class="stock-status in-stock"> {{ $product_data->discount_percent }}% </span>
                                @endif
                                <a class="action-btn hover-up"><img src="{{ asset('assets/imgs/theme/icons/chat.png') }}" alt=""></a>
                                <h2 class="title-detail">{{ $product_data->{"name_" . app()->getLocale()} }}</h2>
                                <!-- <div class="product-detail-rating">
                                    <ul class="float-start">
                                        <li class="mb-5">გამყიდველი: <a href="">Molline Food Store</a></li>
                                    </ul>
                                </div> -->
                                @if(!empty($product_data->discount_price))
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">₾{{ $product_data->discount_price / 100 }}</span>
                                        <span>
                                            <span class="old-price font-md ml-15">₾{{ $product_data->getProductPrice->price / 100 }}</span>
                                        </span>
                                    </div>
                                </div>
                                @else
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">₾{{ $product_data->getProductPrice->price / 100 }}</span>
                                    </div>
                                </div>
                                @endif
                                <div class="detail-extralink">
                                    @if($product_data['count'] > 0)
                                    <div class="detail-qty border radius">
                                        <a href="javascript:;" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="number" value="1" class="qty-val item-quantity-{{ $product_data->id }}">
                                        <a href="javascript:;" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    @endif
                                    <div class="product-extra-link2">
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" onclick="AddToWishlis({{ $product_data->id }})"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href="compare.html"><i class="fi-rs-shuffle"></i></a>
                                        @if($product_data['count'] > 0)
                                        <button type="button" class="button button-add-to-cart" onclick="AddToCart({{ $product_data->id }})"><i class="fi-rs-shopping-cart"></i>{{ trans('site.add_to_cart') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">{{ trans('site.additionl_info') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">{{ trans('site.customer_reviews') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                    </div>
                                    {!! json_decode($product_data->description)->ge !!}                                        
                                    <!-- <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>ადექი</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H (წინა უკანა ბორბალი)</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> -->
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="mb-30 Center">მომხმარებელთა შეფასებები</h4>
                                            <div class="d-flex mb-30 justify-content-center">
                                                <div class="product-rate d-inline-block mr-15">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <h6>4.8 out of 5</h6>
                                            </div>
                                            <div class="comment-list">
                                                <div class="single-comment justify-content-between d-flex">
                                                    <div class="user justify-content-between d-flex">
                                                        <div class="thumb text-center">
                                                            <img src="assets/imgs/blog/author-4.png" alt="" />
                                                            <a href="#" class="font-heading text-brand">Gemma</a>
                                                        </div>
                                                        <div class="desc">
                                                            <div class="d-flex justify-content-between mb-10">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                </div>
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width: 80%"></div>
                                                                </div>
                                                            </div>
                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-form">
                                    <h4 class="mb-30 Center">შეფასების დამატება</h4>
                                    <form action="">
                                        <input class="star star-5" id="star-5" type="radio" name="star" value="1">
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="star" value="2">
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="star" value="3">
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="star" value="4">
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="star" value="5">
                                        <label class="star star-1" for="star-1"></label>
                                    </form>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <form class="form-contact comment_form" action="#" id="commentForm">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="name" id="name" type="text" placeholder="სახელი" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="email" id="email" type="email" placeholder="ელ.ფოსტა" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="დაწერეთ კომენტარი"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="button button-contactForm">დამატება</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <section class="popular-categories section-padding mt-60">
                        <div class="container no-padding">
                            <div class="section-title">
                                <div class="title">
                                <img src="{{ url('assets\imgs\theme\icons\Group 6820.png') }}" class="titleleftimg">  <h3>{{ trans('site.related_products') }} |</h3>  <a href="{{ route('actionProductsView', $product_data->category_id) }}" class="allprod">{{ trans('site.all_products') }}</a>
                                </div>
                                <div class="slider-arrow slider-arrow-2 flex-right carausel-9-columns-arrow" id="carausel-9-columns-arrows"></div>
                            </div>
                            <div class="carausel-9-columns-cover position-relative">
                                <div class="carausel-9-columns" id="carausel-9-columns">
                                    @if(count($related_product) > 0)
                                    @foreach($related_product as $product_data)
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('actionProductsView', $product_data->id) }}">
                                                    <img class="default-img" src="{{ $product_data->photo }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="{{ trans('site.add_to_wishlist') }}" class="action-btn" href="javascript:;" onclick="AddToWishlis({{ $product_data->id }})"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="{{ trans('site.compare') }}" class="action-btn" href=""><i class="fi-rs-shuffle"></i></a>
                                                <a aria-label="{{ trans('site.quiq_view') }}" class="action-btn" onclick="ProductQuickView({{ $product_data->id }})"><i class="fi-rs-eye"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if(!empty($product_data->discount_price) && $product_data->discount_percent)
                                                <span class="sale">{{ $product_data->discount_percent }}%</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="{{ route('actionProductsView', $product_data->id) }}">{{ $product_data->{"name_" . app()->getLocale()} }}</a></h2>
                                            <div>
                                                <span class="font-small text-muted">By <a href="javascript:;">MollineFood</a></span>
                                            </div>
                                            <div class="product-card-bottom">
                                                @if(!empty($product_data->discount_price))
                                                <div class="product-price">
                                                    <span>{{ $product_data->discount_price / 100 }} ₾</span>
                                                    <span class="old-price">{{ $product_data->getProductPrice->price / 100 }} ₾</span>
                                                </div>
                                                @else
                                                <div class="product-price">
                                                    
                                                </div>
                                                @endif
                                                <div class="add-cart" onclick="AddToCart({{ $product_data->id }})">
                                                    <a class="add" href="javascript:;"><i class="fi-rs-shopping-cart mr-5"></i>{{ trans('site.add_to_cart') }} </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection