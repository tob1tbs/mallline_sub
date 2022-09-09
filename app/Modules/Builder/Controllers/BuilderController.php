<?php

namespace App\Modules\Builder\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Builder\Models\Builder;

use Auth;

class BuilderController extends Controller
{

    public function __construct() {
        //
    }

    public function actionBuilderIndex() {
        if(Auth::check()) {
            if (view()->exists('builder.builder_index')) {

                $data = [
                ];
                
                return view('builder.builder_index', $data);
            } else {
                abort('404');
            }
        } else {
            return redirect()->route('actionUsersSignIn');            
        }
    }
}
