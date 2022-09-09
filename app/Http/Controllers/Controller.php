<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showList() {
        $show_list = [
            '20' => '20',
            '40' => '40',
            '60' => '60',
            '80' => '80',
            '100' => '100',
        ];

        return $show_list;
    }

    public function sortList() {
        $sort_list = [
            'DATE_NEW' => [
                'ge' => 'ახალ დამატებული',
                'en' => 'New date',
            ],
            'DATE_OLD' => [
                'ge' => 'ძველ დამატებული',
                'en' => 'Old date',
            ],
            'ASC' => [
                'ge' => 'ფასი ზრდადობით',
                'en' => 'From low price',
            ],
            'DESC' => [
                'ge' => 'ფასი კლებადობით',
                'en' => 'From high price',
            ],
        ];

        return $sort_list;
    }


}
