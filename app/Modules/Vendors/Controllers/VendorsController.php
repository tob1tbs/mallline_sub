<?php

namespace App\Modules\Vendors\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Vendors\Models\Vendor;

class VendorsController extends Controller
{

    public function __construct() {
        //
    }

    public function actionVendorsIndex() {
        if (view()->exists('vendors.vendors_index')) {

            $Vendor = new Vendor();
            $VendorsList = $Vendor::where('active', 1)->where('deleted_at_int', '!=', 0)->paginate(10);

            $data = [
                'vendors_list' => $VendorsList,
            ];
            
            return view('vendors.vendors_index', $data);
        } else {
            abort('404');
        }
    }

    public function actionVendorsGuide() {
        if (view()->exists('vendors.vendors_index')) {

            $data = [
            ];
            
            return view('vendors.vendors_index', $data);
        } else {
            abort('404');
        }
    }
}
