<?php

namespace App\Modules\Products\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Products\Models\Product;

use Response;

class ProductsAjaxController extends Controller
{

    public function __construct() {
        //
    }

    public function ajaxProductGetFilterUrl(Request $Request) {
        $url = $Request->current_url.'&price_from='.$Request->price_from.'&price_to='.$Request->price_to;
        return Response::json(['status' => true , 'redirect_url' => $url]);
    }
}
