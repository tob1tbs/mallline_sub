@extends('layout.layout')

@section('content')
<main class="main">
    <div class="container mb-30 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="table-responsive shopping-summery">
                    @if(count($wishlist_list) > 0)
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30"></th>
                                <th scope="col" colspan="2">{{ trans('site.product') }}</th>
                                <th scope="col">{{ trans('site.price') }}</th>
                                <th scope="col" class="text-center">{{ trans('site.stock') }}</th>
                                <th scope="col">{{ trans('site.action') }}</th>
                                <th scope="col" class="text-center">{{ trans('site.delete') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlist_list as $wishlist_item)
                            <tr class="pt-30 wishlist-item-{{ $wishlist_item->id }}">
                                <td class="custome-checkbox pl-30"></td>
                                <td class="image product-thumbnail pt-40"><img src="{{ $wishlist_item->getProductData->photo }}" alt="#" /></td>
                                <td class="product-des product-name">
                                    <h6><a class="product-name mb-10" href="{{ route('actionProductsView', $wishlist_item->product_id) }}">{{ $wishlist_item->getProductData->{"name_" . app()->getLocale()} }}</a></h6>
                                </td>
                                <td class="price" data-title="Price">
                                    @if(!empty($wishlist_item->getProductData->discount_price))
                                    <h3 class="text-brand">₾{{ $wishlist_item->getProductData->discount_price / 100 }}</h3>
                                    @else
                                    <h3 class="text-brand">₾{{ $wishlist_item->getProductData->getProductPrice->price / 100}}</h3>
                                    @endif
                                </td>
                                @if($wishlist_item->getProductData->count > 0)
                                <td class="text-center detail-info" data-title="Stock">
                                    <span class="stock-status in-stock mb-0"> {{ trans('site.on_stock') }} </span>
                                </td>
                                @else
                                <td class="text-center detail-info" data-title="Stock">
                                    <span class="stock-status out-stock mb-0" style="color: #f74b81;">{{ trans('site.no_stock') }}</span>
                                </td>
                                @endif
                                <td class="text-right" data-title="Cart">
                                    @if($wishlist_item->getProductData->count > 0)
                                    <button class="btn btn-sm" onclick="AddToCart({{ $wishlist_item->product_id }})">{{ trans('site.add_to_cart') }}</button>
                                    @else
                                    <button class="btn btn-sm btn-secondary"><i class="fi-rs-headset mr-5"></i>{{ trans('site.contact') }}</button>
                                    @endif
                                </td>
                                <td class="action text-center" data-title="Remove">
                                    <a href="javascript:;" onclick="RemoveFromWishlist({{ $wishlist_item->id }})" class="text-body text-right"><i class="fi-rs-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="container mb-80 mt-50">
                        <div class="alert alert-primary" role="alert">{{ trans('site.wishlist_is_empty') }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection