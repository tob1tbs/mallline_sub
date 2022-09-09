<?php

namespace App\Modules\Main\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Main\Models\Main;
use App\Modules\Main\Models\Slider;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\ProductCategory;
use App\Modules\Main\Models\Wishlist;
use App\Modules\Main\Models\Compare;
use App\Modules\Main\Models\DeliveryCity;
use App\Modules\Main\Models\PaymentCategory;
use App\Modules\Main\Models\Contact;
use App\Modules\Main\Models\Text;

use Cookie;
use Auth;
use Cart;

class MainController extends Controller
{

    public function __construct() {
        //
    }

    public function actionMainIndex() {
        if (view()->exists('main.main_index')) {

            $Product = new Product();
            $ProductData = $Product::where('deleted_at_int', '!=', 0)->where('active', 1)->get();

            $ProductCategory = new ProductCategory();
            $ProductCategoryList = $ProductCategory::where('deleted_at_int','!=', 0)->where('active', 1)->where('parent_id', 0)->where('id', '!=', 1)->get();

            $ProductList = [];

            foreach($ProductCategoryList as $Item) {
                $ProductList[$Item->id] = [
                    'id' => $Item->id,
                    'name' => $Item->name,
                    'products' =>  [],
                ];

                foreach($ProductData as $ProductItem) {
                    if($Item->id == $ProductItem->category_id) {
                        $ProductList[$ProductItem->category_id]['products'][] = $ProductItem;
                    }
                }
            }

            $Slider = new Slider();
            $SliderList = $Slider::where('active', 1)->where('deleted_at_int', '!=', 0)->get();
            $data = [
                'product_list' => $ProductList,
                'slider_list' => $SliderList,
            ];
            
            return view('main.main_index', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainCart() {
        //
        if (view()->exists('main.main_cart')) {

            $data = [
            ];
            
            return view('main.main_cart', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainAboutUs() {
        //
        if (view()->exists('main.main_about')) {

            $Text = new Text();
            $TextData = $Text::find(1);

            $data = [
                'text_data' => $TextData,
            ];
            
            return view('main.main_about', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainContact() {
        //
        if (view()->exists('main.main_contact')) {

            $Contact = new Contact();
            $ContactList =  $Contact::all();

            foreach($ContactList as $item) {
                $ContactArray[$item->key] = $item->value;
            }

            $data = [
                'contact_data' => $ContactArray,
            ];
            
            return view('main.main_contact', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainHowToBuy() {
        //
        if (view()->exists('main.main_howtobuy')) {

            $data = [
            ];
            
            return view('main.main_howtobuy', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainPrivacy() {
        //
        if (view()->exists('main.main_privacy')) {

            $data = [
            ];
            
            return view('main.main_privacy', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainTerms() {
        //
        if (view()->exists('main.main_terms')) {

            $data = [
            ];
            
            return view('main.main_terms', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainWishlist() {
        if (view()->exists('main.main_wishlist')) {

            $Wishlist = new Wishlist();
            $WishlistData = $Wishlist;

            if(Auth::check() == true) {
                $WishlistData  = $Wishlist->where('user_id', Auth::user()->id)->orWhere('session_id', Cookie::get()['laravel_session']);
            } else {
                $WishlistData  = $Wishlist->where('session_id', Cookie::get()['laravel_session']);
            }

            $WishlistData = $Wishlist->where('deleted_at_int', '!=', 0)->get();

            // dd($WishlistData);

            $data = [
                'wishlist_list' => $WishlistData,
            ];
            
            return view('main.main_wishlist', $data);
        } else {
            abort('404');
        }
    }

    public function actionMainCheckout() {
        if(Auth::check() AND count(Cart::getContent()) > 0) {
            if (view()->exists('main.main_checkout')) {

                $DeliveryCity = new DeliveryCity();
                $DeliveryCityList = $DeliveryCity::where('deleted_at_int', '!=', 0)->where('active', 1)->get();

                $PaymentCategory = new PaymentCategory();
                $PaymentCategoryList = $PaymentCategory::where('deleted_at_int', '!=', 0)->where('active', 1)->get();

                $data = [
                    'city_list' => $DeliveryCityList,
                    'payment_category_list' => $PaymentCategoryList,
                ];
                
                return view('main.main_checkout', $data);
            } else {
                abort('404');
            }
        } else {
            return redirect()->route('actionUsersSignIn');
        }
    }

    public function actionMainCompare(Request $Request) {
        if (view()->exists('main.main_compare')) {

            $Compare = new Compare();
            $CompareList = $Compare::where('deleted_at_int', '!=', 0)->where('session_id', Cookie::get()['laravel_session'])->orderBy('id', 'DESC')->limit(2)->get();

            $data = [
                'compare_list' => $CompareList,
            ];
            
            return view('main.main_compare', $data);
        } else {
            abort('404');
        }
    }
}
