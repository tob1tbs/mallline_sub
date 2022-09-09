function AddToCart(product_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/cart/add",
        type: "POST",
        data: {
        	product_id: product_id,
            quantity: parseInt($(".item-quantity-"+product_id).val()),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                toastr.options = {
                  "closeButton": true,
                  "positionClass": "toast-bottom-right",
                }
                if(data['errors'] == true) {
                     toastr.warning(data['message'][0]);
                } else {
                    $(".header-cart-body, .cart-item-count, .cart-price-total").html('');
                    $(".cart-item-count").append(data['CartQuantity']);
                    $(".cart-price-total").append((data['CartTotal'] / 100).toFixed(2));
                    html = `<ul class="header-cart-body">`;
                    $.each(data['CartData'], function(key, value) {
                    html +=`
                        <li class="cart-item-`+value['id']+`">
                            <div class="shopping-cart-img">
                                <a href="products_single.html"><img alt="Molline" src="`+value['attributes']['photo']+`" /></a>
                            </div>
                            <div class="shopping-cart-title">
                                <h4><a href="products_single.html">`+value['name']+`</a></h4>
                                <h4><span>`+value['quantity']+` × </span>₾ `+value['price']+`</h4>
                            </div>
                            <div class="shopping-cart-delete">
                                <a href="javascript:;" onclick="RemoveFromCart(`+value['id']+`)"><i class="fi-rs-cross-small"></i></a>
                            </div>
                        </li>`;
                    });
                    html += `
                    </ul>
                    <div class="shopping-cart-footer">
                        <div class="shopping-cart-total">
                            <h4>ჯამი: <span class="cart-price-total">₾ `+(data['CartTotal']).toFixed(2)+`</span></h4>
                        </div>
                        <div class="shopping-cart-button">
                            <a href="/cart" class="outline">კალათა</a>
                            <a href="/checkout">ჩექაუთი</a>
                        </div>
                    </div>`;
                    $(".cart-body").html('').append(html);
                    toastr.success(data['message']);
                }
            }
        }
    });
}

function ClearCart() {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/cart/clear",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                $(".header-cart-body, .cart-item-count, .cart-price-total").html('');
                $(".cart-item-count").append(data['CartQuantity']);
                $(".cart-price-total").append((data['CartTotal']).toFixed(2));
                $(".cart-body").html('').append(`
                    <div class="alert alert-primary text-center" role="alert" style="margin-bottom: 0">`+data['translate']['empty_cart']+`</div>
                `);
                $(".cart-body-s").html('').append(`
                    <div class="container mb-80 mt-50">
                        <div class="alert alert-primary" role="alert">`+data['translate']['empty_cart']+`</div>
                    </div>
                `);
            }
        }
    });
}

function RemoveFromCart(product_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/cart/remove",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_id: product_id,
        },
        success: function(data) {
            if(data['status'] == true) {
                $(".cart-item-count, .cart-price-total").html('');
                $(".cart-item-count").append(data['CartQuantity']);
                $(".cart-price-total").append((data['CartTotal']).toFixed(2));
                $(".cart-item-s-"+product_id).remove();
                $(".cart-item-"+product_id).remove();
                if(data['CartData'].length < 1) {
                    $(".cart-body").html('').append(`
                        <div class="alert alert-primary text-center" role="alert" style="margin-bottom: 0">`+data['translate']['empty_cart']+`</div>
                    `);
                    $(".cart-body-s").html('').append(`
                        <div class="container mb-80 mt-50">
                            <div class="alert alert-primary" role="alert">`+data['translate']['empty_cart']+`</div>
                        </div>
                    `);
                }
            }
        }
    });
}

function ProductQuickView(product_id) {
	$.ajax({
        dataType: 'json',
        url: "/main/ajax/quick/",
        type: "GET",
        data: {
        	product_id: product_id,
        },
        success: function(data) {
        	$(".quiq-view-heading, .quick-view-slider, .quick-view-thumbs, .quiq-current-price, .quiq-old-price, .quantity-quiq, .sale-percent-badge, .product-stock-badge").html('');
            if(data['status'] == true) {
                
                photo_html = `
                <figure class="border-radius-10">
                    <img src="`+data['ProductData']['photo']+`" alt="product image">
                </figure>
                `;

                if(data['ProductData']['discount_price'] > 0) {
                    $(".sale-percent-badge").append(`<span class="stock-status in-stock">`+data['ProductData']['discount_percent']+` %</span>`);
                    $(".quiq-current-price").append(data['ProductData']['discount_price'] / 100+' ₾');
                    $(".quiq-old-price").append(data['ProductData']['get_product_price']['price'] / 100+' ₾');
                } else {
                    $(".quiq-current-price").append(data['ProductData']['get_product_price']['price'] / 100+' ₾');
                }

                thumb_html = `
                    <div><img src="`+data['ProductData']['photo']+`" alt="product image" /></div>
                `;

                if(data['ProductData']['count'] > 0) {
                    $(".quantity-quiq").append(`
                        <div class="detail-qty border radius">
                            <a href="javascript:;" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                            <input type="number" value="1" class="qty-val item-quantity-`+data['ProductData']['id']+`">
                            <a href="javascript:;" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                        </div>
                        <div class="product-extra-link2">
                            <button type="button" class="button button-add-to-cart" onclick="AddToCart(`+data['ProductData']['id']+`)"><i class="fi-rs-shopping-cart"></i>`+data['translate']['add_to_cart']+`</button>
                        </div>
                    `);
                } else {
                    $(".product-stock-badge").append('<span class="stock-status out-stock mb-1" style="color: #f74b81;">'+data['translate']['out_of_stock']+'</span>');
                }
                $.each(data['ProductData']['get_product_gallery'], function(key, value) {
                    photo_html += `
                        <figure class="border-radius-10">
                            <img src="`+value['path']+`" alt="product image">
                        </figure>
                    `;

                    thumb_html += `
                        <div><img src="`+value['path']+`" alt="product image" /></div>
                    `;
                });

                $(".quick-view-slider").append(photo_html);
                $(".quick-view-thumbs").append(thumb_html);
            	$(".quiq-view-heading").append(data['ProductData']['name_ge']);
                $('.detail-qty').each(function () {
                    var qtyval = parseInt($(this).find(".qty-val").val(), 10);

                    $('.qty-up').on('click', function (event) {
                        event.preventDefault();
                        qtyval = qtyval + 1;   
                        $(this).prev().val(qtyval);
                    });

                     $(".qty-down").on("click", function (event) {
                         event.preventDefault(); 
                         qtyval = qtyval - 1;
                         if (qtyval > 1) {
                             $(this).next().val(qtyval);
                         } else {
                             qtyval = 1;
                             $(this).next().val(qtyval);
                         }
                     });
                });

                $('.product-image-slider').slick('unslick').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: false,
                    asNavFor: '.slider-nav-thumbnails',
                });

                $('.slider-nav-thumbnails').slick('unslick').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '.product-image-slider',
                    dots: false,
                    focusOnSelect: true,
                    
                    prevArrow: '<button type="button" class="slick-prev"><i class="fi-rs-arrow-small-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fi-rs-arrow-small-right"></i></button>'
                });

       			$("#quickViewModal").modal('show');
            }
        }
    });
}

function ProductCompare(product_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/compare/add",
        type: "POST",
        data: {
            product_id: product_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                if(data['errors'] == true) {
                    toastr.warning(data['message']);   
                } else {
                    toastr.success(data['message']);   
                }
            }
        }
    });
}

function AddToWishlis(product_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/wishlist/add",
        type: "POST",
        data: {
            product_id: product_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                if(data['errors'] == true) {
                    toastr.warning(data['message'][0]);   
                } else {
                    toastr.success(data['message'][0]);   
                }
            }
        }
    });
}

function RemoveFromCompare(product_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/compare/remove",
        type: "POST",
        data: {
            product_id: product_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                location.reload();
            }
        }
    });   
}

function UpdateQuantityPlus(item_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/cart/quantity",
        type: "POST",
        data: {
            quantity: parseInt($(".item-quantity-"+item_id).val()) + 1,
            item_id: item_id ,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                
                if(data['CartData'].length < 1) {
                    $(".cart-body").html('').append(`
                        <div class="alert alert-primary text-center" role="alert" style="margin-bottom: 0">`+data['translate']['empty_cart']+`</div>
                    `);
                    $(".cart-body-s").html('').append(`
                        <div class="container mb-80 mt-50">
                            <div class="alert alert-primary" role="alert">`+data['translate']['empty_cart']+`</div>
                        </div>
                    `);
                }

                $(".header-cart-body, .cart-item-count, .cart-price-total, .cart-body-page").html('');
                $(".cart-item-count").append(data['CartQuantity']);
                $(".cart-price-total").append((data['CartTotal'] / 100).toFixed(2));
                html = `<ul class="header-cart-body">`;
                $.each(data['CartData'], function(key, value) {
                html +=`
                    <li class="cart-item-`+value['id']+`">
                        <div class="shopping-cart-img">
                            <a href="products_single.html"><img alt="Molline" src="`+value['attributes']['photo']+`" /></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="products_single.html">`+value['name']+`</a></h4>
                            <h4><span>`+value['quantity']+` × </span>₾ `+value['price']+`</h4>
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="javascript:;" onclick="RemoveFromCart(`+value['id']+`)"><i class="fi-rs-cross-small"></i></a>
                        </div>
                    </li>`;

                    $(".cart-body-page").append(`
                        <tr class="pt-30 cart-item-s-`+value['id']+`">
                            <td class="custome-checkbox pl-30"></td>
                            <td class="image product-thumbnail pt-40"><img src="`+value['attributes']['photo']+`" alt="#"></td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="products_single.html">`+value['name']+`</a></h6>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">₾`+value['price'].toFixed(2)+`</h4>
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink ">
                                    <div class="detail-qty border radius">
                                        <a href="javascript:;" onclick="UpdateQuantityMinus(`+value['id']+`)" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="number" value="`+value['quantity']+`" class="qty-val item-quantity-`+value['id']+`">
                                        <a href="javascript:;" onclick="UpdateQuantityPlus(`+value['id']+`)" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-brand total-price-`+value['id']+`">₾`+(value['quantity'] * value['price']).toFixed(2)+`</h4>
                            </td>
                            <td class="action text-center" data-title="წაშლა"><a href="javascript:;" onclick="RemoveFromCart(`+value['id']+`)" class="text-body"><i class="fi-rs-trash"></i></a></td>
                        </tr>
                    `);
                    $('.detail-qty').each(function () {
                        var qtyval = parseInt($(this).find(".qty-val").val(), 10);

                        $('.qty-up').on('click', function (event) {
                            event.preventDefault();
                            qtyval = qtyval + 1;   
                            $(this).prev().val(qtyval);
                        });

                         $(".qty-down").on("click", function (event) {
                             event.preventDefault(); 
                             qtyval = qtyval - 1;
                             if (qtyval > 1) {
                                 $(this).next().val(qtyval);
                             } else {
                                 qtyval = 1;
                                 $(this).next().val(qtyval);
                             }
                         });
                    });
                });
                html += `
                </ul>
                <div class="shopping-cart-footer">
                    <div class="shopping-cart-total">
                        <h4>ჯამი: <span class="cart-price-total">₾ `+(data['CartTotal']).toFixed(2)+`</span></h4>
                    </div>
                    <div class="shopping-cart-button">
                        <a href="/cart" class="outline">კალათა</a>
                        <a href="/checkout">ჩექაუთი</a>
                    </div>
                </div>`;
                $(".cart-body").html('').append(html);
            }
        }
    });
}

function UpdateQuantityMinus(item_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/cart/quantity",
        type: "POST",
        data: {
            quantity: parseInt($(".item-quantity-"+item_id).val()) - 1,
            item_id: item_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                
                if(data['CartData'].length < 1) {
                    $(".cart-body").html('').append(`
                        <div class="alert alert-primary text-center" role="alert" style="margin-bottom: 0">`+data['translate']['empty_cart']+`</div>
                    `);
                    $(".cart-body-s").html('').append(`
                        <div class="container mb-80 mt-50">
                            <div class="alert alert-primary" role="alert">`+data['translate']['empty_cart']+`</div>
                        </div>
                    `);
                }

                $(".header-cart-body, .cart-item-count, .cart-price-total, .cart-body-page").html('');
                $(".cart-item-count").append(data['CartQuantity']);
                $(".cart-price-total").append((data['CartTotal'] / 100).toFixed(2));
                html = `<ul class="header-cart-body">`;
                $.each(data['CartData'], function(key, value) {
                html +=`
                    <li class="cart-item-`+value['id']+`">
                        <div class="shopping-cart-img">
                            <a href="products_single.html"><img alt="Molline" src="`+value['attributes']['photo']+`" /></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="products_single.html">`+value['name']+`</a></h4>
                            <h4><span>`+value['quantity']+` × </span>₾ `+value['price']+`</h4>
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="javascript:;" onclick="RemoveFromCart(`+value['id']+`)"><i class="fi-rs-cross-small"></i></a>
                        </div>
                    </li>`;

                    $(".cart-body-page").append(`
                        <tr class="pt-30 cart-item-s-`+value['id']+`">
                            <td class="custome-checkbox pl-30"></td>
                            <td class="image product-thumbnail pt-40"><img src="`+value['attributes']['photo']+`" alt="#"></td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="products_single.html">`+value['name']+`</a></h6>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">₾`+value['price'].toFixed(2)+`</h4>
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink ">
                                    <div class="detail-qty border radius">
                                        <a href="javascript:;" onclick="UpdateQuantityMinus(`+value['id']+`)" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="number" value="`+value['quantity']+`" class="qty-val item-quantity-`+value['id']+`">
                                        <a href="javascript:;" onclick="UpdateQuantityPlus(`+value['id']+`)" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-brand total-price-`+value['id']+`">₾`+(value['quantity'] * value['price']).toFixed(2)+`</h4>
                            </td>
                            <td class="action text-center" data-title="წაშლა"><a href="javascript:;" onclick="RemoveFromCart(`+value['id']+`)" class="text-body"><i class="fi-rs-trash"></i></a></td>
                        </tr>
                    `);
                    $('.detail-qty').each(function () {
                        var qtyval = parseInt($(this).find(".qty-val").val(), 10);

                        $('.qty-up').on('click', function (event) {
                            event.preventDefault();
                            qtyval = qtyval + 1;   
                            $(this).prev().val(qtyval);
                        });

                         $(".qty-down").on("click", function (event) {
                             event.preventDefault(); 
                             qtyval = qtyval - 1;
                             if (qtyval > 1) {
                                 $(this).next().val(qtyval);
                             } else {
                                 qtyval = 1;
                                 $(this).next().val(qtyval);
                             }
                         });
                    });
                });
                html += `
                </ul>
                <div class="shopping-cart-footer">
                    <div class="shopping-cart-total">
                        <h4>ჯამი: <span class="cart-price-total">₾ `+(data['CartTotal']).toFixed(2)+`</span></h4>
                    </div>
                    <div class="shopping-cart-button">
                        <a href="/cart" class="outline">კალათა</a>
                        <a href="/checkout">ჩექაუთი</a>
                    </div>
                </div>`;
                $(".cart-body").html('').append(html);
            }
        }
    });
}


function RemoveFromWishlist(product_id) {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/wishlist/remove",
        type: "POST",
        data: {
            product_id: product_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                $(".wishlist-item-"+product_id).remove();
            }
        }
    });   
}

function SubscribeButton() {
    $.ajax({
        dataType: 'json',
        url: "/main/ajax/subscribe",
        type: "POST",
        data: {
            subscribe_email: $("#subscribe_email").val(),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                if(data['errors'] == true) {
                    toastr.warning(data['message'][0]);   
                } else {
                    toastr.success(data['message'][0]);   
                }
            }
        }
    }); 
}