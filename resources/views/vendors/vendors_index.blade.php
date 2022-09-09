@extends('layout.layout')

@section('content')
<main class="main pages mb-80">
    <div class="page-content pt-50 mb-80">
        <div class="container">
            <div class="archive-header-2 text-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="მოძებნეთ მომწოდებლები (სახელით ან პირადობით)..." />
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-50">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>ამჟამად ჩვენთან რეგისტრირებულია <strong class="text-brand">780+</strong> მომწოდებელი</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>მაჩვენე:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">ყველა</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>დალაგება:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> სიახლით <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a href="#">რეიტინგით</a></li>
                                        <li><a href="#">პროდუქციით</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row vendor-grid">
                    @foreach($vendors_list as $vendor)
                    <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img">
                                    <a href="vendor-details.html">
                                        <img class="default-img" src="assets/imgs/vendor/vendor-1.png" alt="" />
                                    </a>
                                </div>
                       
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="d-flex justify-content-between align-items-end mb-30">
                                    <div>
                              
                                        <h4 class="mb-5"><a href="vendor-details.html">Nature Food</a></h4>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <span class="font-small total-product">380 პროდუქცია</span>
                                    </div>
                                </div>
                                <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-muted">
                                        <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>მისამართი: </strong> <span>Tbilisi, Georgia</span></li>
                                        <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>საკონტაქტო:</strong><span>+995 555 555 555</span></li>
                                    </ul>
                                </div>
                                <a href="vendor-details.html" class="btn btn-xs">მაღაზიის ნახვა <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            {{ $vendors_list->links('vendor.custom') }}
            </div>
        </div>
    </div>
</main>
@endsection