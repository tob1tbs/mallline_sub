@extends('layout.layout')

@section('content')
<main class="main">
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                @if(count($compare_list) > 0)
                <div class="table-responsive">
                    <table class="table text-center table-compare">
                        <tbody>
                            <tr class="pr_image">
                                <td class="text-muted font-sm fw-600 font-heading mw-200">{{ trans('site.photo') }}</td>
                                @if(!empty($compare_list[0]))
                                <td class="row_img"><img src="{{ $compare_list[0]->getProductData->photo }}" alt="compare-img" /></td>
                                @endif
                                @if(!empty($compare_list[1]))
                                <td class="row_img"><img src="{{ $compare_list[1]->getProductData->photo }}" alt="compare-img" /></td>
                                @endif
                            </tr>
                            <tr class="pr_title">
                                <td class="text-muted font-sm fw-600 font-heading">{{ trans('site.name') }}</td>
                                @if(!empty($compare_list[0]))
                                <td class="product_name">
                                    <h6><a href="shop-product-full.html" class="text-heading">{{ $compare_list[0]->getProductData->{"name_" . app()->getLocale()} }}</a></h6>
                                </td>
                                @endif
                                @if(!empty($compare_list[1]))
                                <td class="product_name">
                                    <h6><a href="shop-product-full.html" class="text-heading">{{ $compare_list[1]->getProductData->{"name_" . app()->getLocale()} }}</a></h6>
                                </td>
                                @endif
                            </tr>
                            <tr class="pr_price">
                                <td class="text-muted font-sm fw-600 font-heading">{{ trans('site.price') }}</td>
                                @if(!empty($compare_list[0]))
                                <td class="product_price">
                                    @if($compare_list[0]->getProductData->discount_price > 0)
                                    <h4 class="price text-brand">₾{{ $compare_list[0]->getProductData->discount_price / 100 }}</h4>
                                    @else
                                    <h4 class="price text-brand">₾{{ $compare_list[0]->getProductData->getProductPrice->price / 100 }}</h4>
                                    @endif
                                </td>
                                @endif
                                @if(!empty($compare_list[1]))
                                <td class="product_price">
                                    @if($compare_list[1]->getProductData->discount_price > 0)
                                    <h4 class="price text-brand">₾{{ $compare_list[1]->getProductData->discount_price / 100 }}</h4>
                                    @else
                                    <h4 class="price text-brand">₾{{ $compare_list[1]->getProductData->getProductPrice->price / 100 }}</h4>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            <!-- <tr class="pr_rating">
                                <td class="text-muted font-sm fw-600 font-heading">რეიტინგი</td>
                                <td>
                                    <div class="rating_wrap">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="rating_num">(121)</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="rating_wrap">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="rating_num">(35)</span>
                                    </div>
                                </td>
                            </tr> -->
                            <tr class="pr_stock">
                                <td class="text-muted font-sm fw-600 font-heading">{{ trans('site.status') }}</td>
                                @if(!empty($compare_list[0]))
                                <td class="row_stock">
                                    @if($compare_list[0]->getProductData->count > 0)
                                    <span class="stock-status in-stock mb-0">{{ trans('site.on_stock') }}</span>
                                    @else
                                    <span class="stock-status out-stock mb-0">{{ trans('site.no_stock') }}</span>
                                    @endif
                                </td>
                                @endif
                                @if(!empty($compare_list[1]))
                                <td class="row_stock">
                                    @if($compare_list[1]->getProductData->count > 0)
                                    <span class="stock-status in-stock mb-0">{{ trans('site.on_stock') }}</span>
                                    @else
                                    <span class="stock-status out-stock mb-0">{{ trans('site.no_stock') }}</span>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            <tr class="pr_add_to_cart">
                                <td class="text-muted font-sm fw-600 font-heading">{{ trans('site.purchase') }}</td>
                                <td class="row_btn">
                                    @if($compare_list[0]->getProductData->count > 0)
                                    <button class="btn btn-sm" onclick="AddToCart({{ $compare_list[0]->getProductData->id }})"><i class="fi-rs-shopping-bag mr-5"></i>{{ trans('site.add_to_cart') }}</button>
                                    @else
                                    <button class="btn btn-sm btn-secondary"><i class="fi-rs-headset mr-5"></i>კონტაქტი</button>
                                    @endif
                                </td>
                                @if(!empty($compare_list[1]))
                                <td class="row_btn">
                                    @if($compare_list[1]->getProductData->count > 0)
                                    <button class="btn btn-sm" onclick="AddToCart({{ $compare_list[1]->getProductData->id }})"><i class="fi-rs-shopping-bag mr-5"></i>{{ trans('site.add_to_cart') }}</button>
                                    @else
                                    <button class="btn btn-sm btn-secondary"><i class="fi-rs-headset mr-5"></i>კონტაქტი</button>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            <tr class="pr_remove text-muted">
                                <td class="text-muted font-md fw-600"></td>
                                <td class="row_remove">
                                    <a href="javascript:;" class="text-muted" onclick="RemoveFromCompare({{ $compare_list[0]->id }})"><i class="fi-rs-trash mr-5"></i><span>{{ trans('site.delete') }}</span> </a>
                                </td>
                                @if(!empty($compare_list[1]))
                                <td class="row_remove">
                                    <a href="javascript:;" onclick="RemoveFromCompare({{ $compare_list[1]->id }})" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>{{ trans('site.delete') }}</span> </a>
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-primary text-center" role="alert">{{ trans('site.compare_list_is_empty') }}</div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection