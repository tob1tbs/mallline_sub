<?php

namespace App\Modules\Products\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\ProductCategory;
use App\Modules\Products\Models\ProductOption;

class ProductsController extends Controller
{

    public function __construct() {
        //
    }

    public function actionProductsIndex(Request $Request) {
        //
        if (view()->exists('products.products_index')) {

            $ProductCategory = new ProductCategory();
            $ProductCategoryList = $ProductCategory::where('deleted_at_int', '!=', 0)->where('id', '!=', 1)->where('parent_id', 0)->where('active', 1)->get();

            $Product = new Product();
            $ProductAll = $Product::rightJoin('new_product_price', 'new_product_price.product_id', '=', 'new_products.id')->get();
            $ProductList = $Product::select('new_products.*', 'new_product_price.*', 'new_product_price.id as price_id')->where('new_products.deleted_at_int', '!=', 0)->where('new_products.active', 1)->leftJoin('new_product_price', 'new_product_price.product_id', '=', 'new_products.id');

            $ProductOption = new ProductOption();

            if(!empty($Request->search_query)) {
                $ProductList = $ProductList->where('new_products.name_ge', 'LIKE', '%'.$Request->search_query.'%')
                                            ->orWhere('new_products.name_en', 'LIKE', '%'.$Request->search_query.'%');
            }

            if(!empty($Request->sale)) {
                $ProductList = $ProductList->whereNotNull('new_products.discount_price');
            }

            if(!empty($Request->category_id)) {
                $ProductList = $ProductList->where('category_id', $Request->category_id);

                $ProductOptionList = $ProductOption::where('category_id', $Request->category_id)->where('type', 'select')->where('deleted_at_int', '!=', 0)->where('active', 1)->get();
            } else {
                $ProductOptionList = [];                
            }

            if($Request->has('option')) {
                
            }

            if(!empty($Request->sort)) {
                if($Request->sort == 'DATE_NEW') {
                    $ProductList = $ProductList->orderBy('new_products.id', 'DESC');
                }

                if($Request->sort == 'DATE_OLD') {
                    $ProductList = $ProductList->orderBy('new_products.id', 'ASC');
                }

                if($Request->sort == 'DESC') {
                    $ProductList = $ProductList->orderBy('new_product_price.price', 'ASC');
                }

                if($Request->sort == 'ASC') {
                    $ProductList = $ProductList->orderBy('new_product_price.price', 'DESC');
                }
            } else {
                $ProductList = $ProductList->orderBy('new_products.id', 'DESC');
            }

            if($Request->has('price_from')) {
                $ProductList = $ProductList->where('new_product_price.price', '>=', $Request->price_from * 100);
            }

            if($Request->has('price_to')) {
                $ProductList = $ProductList->where('new_product_price.price', '<=', $Request->price_to * 100);
            }


            if(!empty($Request->show) && $Request->show != 20) {
                $ProductList = $ProductList->paginate($Request->show);
            } else {
                $ProductList = $ProductList->paginate(20);
            }

            $data = [
                'product_list' => $ProductList,
                'product_all' => $ProductAll,
                'product_options' => $ProductOptionList,
                'product_category_list' => $ProductCategoryList,
                'show_list' => $this->showList(),
                'sort_list' => $this->sortList(),
            ];
            
            return view('products.products_index', $data);
        } else {
            abort('404');
        }
    }

    public function actionProductsView(Request $Request) {
        if (view()->exists('products.products_view')) {

            $Product = new Product();
            $ProductData = $Product::find($Request->product_id);

            $RelatedProducts = $Product::where('category_id', $ProductData->category_id)->where('deleted_at_int', '!=', 0)->where('active', 1)->get();

            $data = [
                'product_data' => $ProductData,
                'related_product' => $RelatedProducts,
            ];
            
            return view('products.products_view', $data);
        } else {
            abort('404');
        }
    }
}
