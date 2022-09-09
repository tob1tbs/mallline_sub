<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use View;
use Auth;

use App\Modules\Main\Models\Navigation;
use App\Modules\Main\Models\ParameterSocial;
use App\Modules\Products\Models\ProductCategory;

class ComposerViewProvider extends ServiceProvider
{
    
    public function register()
    {
        //
        View::composer('*', function($view) {
            $Navigation = new Navigation();
            $NavigationList = $Navigation::where('deleted_at_int', '!=', 0)->where('active', 1)->orderBy('sortable', 'ASC')->get();

            $ProductCategory = new ProductCategory();
            $ProductCategoryList = $ProductCategory::where('deleted_at_int', '!=', 0)->where('active', 1)->where('id', '!=', 1)->where('parent_id', 0)->orderBy('sortable', 'ASC')->get();

            $ParameterSocial = new ParameterSocial();
            $ParameterSocialData = $ParameterSocial::where('deleted_at_int', '!=', 0)->where('active', 1)->get();

            foreach($ParameterSocialData as $ParameterSocialItem) {
                $ParameterArray[$ParameterSocialItem->key] = $ParameterSocialItem->value;
            }

            $view->with('parametersArray', $ParameterArray);
            $view->with('navigation_list', $NavigationList);
            $view->with('category_list', $ProductCategoryList);
        });
    }

    
    public function boot()
    {
        //
    }
}
