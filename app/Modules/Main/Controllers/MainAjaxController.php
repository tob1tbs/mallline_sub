<?php

namespace App\Modules\Main\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Main\Models\Main;
use App\Modules\Main\Models\Wishlist;
use App\Modules\Main\Models\Compare;
use App\Modules\Products\Models\Product;

use Cart;
use Auth;
use Session;
use Cookie;
use Response;
use Validator;

use Carbon\Carbon;

class MainAjaxController extends Controller
{

    public function __construct() {
        //
    }

    public function ajaxGeneralAddToCart(Request $Request) {
        if($Request->isMethod('POST')) {
            $Product = new Product();
            $ProductData = $Product::find($Request->product_id);

            if(!empty($ProductData->discount_price)) {
                $Price = $ProductData->discount_price;
            } else {
                $Price = $ProductData->getProductPrice->price;
            }

            if(is_numeric($Request->quantity)) {
                if(isset($Request->quantity) AND empty($Request->quantity)) {
                    $Quantity = 1;
                } else {
                    $Quantity = $Request->quantity;
                }
            } else {
                $Quantity = 1;
            }

            if($ProductData->count <= $Quantity) {
                return Response::json(['status' => true, 'errors' => true, 'message' => [0 => 'ნაშთის რაოდენობა ნაკლებია მოთხოვნილზე!']]);
            } else{ 
               Cart::add([
                    'id' => $ProductData->id,
                    'name' => $ProductData->name_ge,
                    'price' => $Price / 100,
                    'quantity' => $Quantity,
                    'attributes' => [
                        'photo' => $ProductData->photo,
                    ],
                ]);

                $CartData = Cart::getContent();
                return Response::json([
                    'status' => true, 
                    'errors' => false, 
                    'CartData' => Cart::getContent(),
                    'CartQuantity' => Cart::getTotalQuantity(),
                    'CartTotal' => Cart::getSubTotal(),
                    'message' => 'პროდუქტი დაემატა კალათაში',
                ]);
            }
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxGeneralClearCart(Request $Request) {
        if($Request->isMethod('POST')) {
            
            Cart::clear();

            return Response::json([
                'status' => true, 
                'CartData' => Cart::getContent(),
                'CartQuantity' => Cart::getTotalQuantity(),
                'CartTotal' => Cart::getSubTotal(),
                'translate' => [
                    'empty_cart' => trans('site.your_cart_is_empty'),
                ],
            ]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxGeneralQuantityCart(Request $Request) {
        if($Request->isMethod('POST') & $Request->item_id > 0) {
            Cart::update($Request->item_id, [
                'quantity' => [
                      'relative' => false,
                      'value' => $Request->quantity,
                ],
            ]);

            if($Request->quantity <= 0) {
                Cart::remove($Request->item_id);
            }

            return Response::json([
                'status' => true, 
                'CartData' => Cart::getContent(),
                'CartQuantity' => Cart::getTotalQuantity(),
                'CartTotal' => Cart::getSubTotal(),
                'ItemCount' => $Request->quantity,
                'translate' => [
                    'empty_cart' => trans('site.your_cart_is_empty'),
                ],
            ]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxGeneralRemoveFromCart(Request $Request) {
        if($Request->isMethod('POST')) {

            Cart::remove($Request->product_id);

            return Response::json([
                'status' => true, 
                'CartData' => Cart::getContent(),
                'CartQuantity' => Cart::getTotalQuantity(),
                'CartTotal' => Cart::getSubTotal(),
                'translate' => [
                    'empty_cart' => trans('site.your_cart_is_empty'),
                ],
            ]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxGeneralProductQuickView(Request $Request) {
        if($Request->isMethod('GET')) {

            $Product = new Product();
            $ProductData = $Product::find($Request->product_id)->load('getProductGallery')->load('getCategoryData')->load('getProductPrice');

            return Response::json([
                'status' => true, 
                'ProductData' => $ProductData, 
                'translate' => [
                    'out_of_stock' => trans('site.no_stock'),
                    'add_to_cart' => trans('site.add_to_cart'),
                ]]);
            
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxGeneralProductCompare(Request $Request) {
        if($Request->isMethod('POST')) {

            $Compare = new Compare();
            $Compare->session_id = Cookie::get()['laravel_session'];
            $Compare->product_id = $Request->product_id;
            $Compare->save();

            return Response::json(['status' => true, 'errors' => false, 'message' => 'ნივთი წარმატებით დაემატა შედარების სიაში !!!'], 200);

        } else {
            return Response::json(['status' => false, 'errors' => true, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxGeneralProductCompareRemove(Request $Request) {
        if($Request->isMethod('POST')) {

            $Compare = new Compare();
            $Compare::find($Request->product_id)->delete();

            return Response::json(['status' => true, 'errors' => false, 'message' => 'ნივთი წარმატებით წაიშალა შედარების სიიდან !!!'], 200);
        } else {
            return Response::json(['status' => false, 'errors' => true, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxMainWishlistAdd(Request $Request) {
        if($Request->isMethod('POST')) {
            
            $Product = new Product();
            $ProductData = $Product::find($Request->product_id);

            $Wishlist = new Wishlist();
            $WishlistData = $Wishlist::where('product_id', $Request->product_id);

            if(Auth::check() == true) {
                $WishlistData = $WishlistData->where('user_id', Auth::user()->id)->where('session_id', Cookie::get()['laravel_session']);
                $Auth = Auth::user()->id;
            } else {
                $WishlistData = $WishlistData->where('session_id', Cookie::get()['laravel_session']);
                $Auth = 0;
            }

            $WishlistData = $WishlistData->where('deleted_at_int', '!=', 0)->get();

            if(count($WishlistData) > 0) {
                return Response::json(['status' => true, 'message' => [0 => 'აღნიშნული პროდუქტი უკვე დამატაბულია სურვილების სიაში!']]);
            } else {
                $Wishlist = new Wishlist();
                $Wishlist->user_id = $Auth;
                $Wishlist->product_id = $Request->product_id;
                $Wishlist->session_id = Cookie::get()['laravel_session'];
                $Wishlist->save();

                return Response::json(['status' => true, 'message' => [0 => 'პროდუქტი დაემატა სურვილების სია.']]);
            };
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!'], 200);
        }
    }

    public function ajaxMainWishlistRemove(Request $Request) {
        if($Request->isMethod('POST')) {
            
            $Wishlist = new Wishlist();
            $WishlistData = $Wishlist::find($Request->product_id)->update([
                'deleted_at_int' => 0,
                'deleted_at' => Carbon::now(),
            ]);

            return Response::json(['status' => true]);
        }
    }

    public function ajaxSendContact(Request $Request) {
        if($Request->isMethod('POST')) {
            return Response::json(['status' => true]);
        } else {
            return Response::json(['status' => true, 'redirect_url' => route('actionUsersSignIn')]);
        }
    }

    public function ajaxCheckoutSubmit(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'delivery_city' => 'აღნიშნული ელ-ფოსტა დაკავებულია!',
                'billing_address' => 'აღნიშნული ელ-ფოსტა დაკავებულია!',
                'payment-method' => 'აღნიშნული ელ-ფოსტა დაკავებულია!',
            );
            $validator = Validator::make($Request->all(), [
                'delivery_city' => 'required|max:255',
                'billing_address' => 'required|max:255',
                'payment-method' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => false, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                dd($Request->all());
            }
        } else {
            return Response::json(['status' => true]);
        }
    }

    public function ajaxSubscribe(Request $Request) {
        $validator = Validator::make($Request->all(), [
            'subscribe_email' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Response::json(['status' => true, 'errors' => true, 'message' => [0 =>  trans('site.subsctibe_required')]]);
        } else {
            return Response::json(['status' => true, 'errors' => false, 'message' => [0 =>  trans('site.subsctibe_success')]]);
        }
    }
}
