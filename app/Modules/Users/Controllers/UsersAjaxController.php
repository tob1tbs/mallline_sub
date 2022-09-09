<?php

namespace App\Modules\Users\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Users\Models\User;

use Response;
use Validator;
use Hash;
use Auth;

class UsersAjaxController extends Controller
{

    public function __construct() {
       
    }

    public function ajaxUserSignUp(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => trans('site.place_enter_all_required_fields'),
                'user_email.unique' => trans('site.current_email_is_busy'),
                'user_phone.unique' => trans('site.current_phone_is_busy'),
                'user_personal_id.unique' => trans('site.current_personal_id_is_busy'),
                'user_password.min' => trans('site.password_lengh_min'),
                'user_conf_password.same' => trans('site.password_dont_mach'),
            );
            $validator = Validator::make($Request->all(), [
                'user_name' => 'required|max:255',
                'user_lastname' => 'required|max:255',
                'user_personal_id' => 'required|max:255|unique:new_customers,personal_number',
                'user_bday' => 'required|max:255',
                'user_email_p' => 'required|max:255|unique:new_customers,email',
                'user_phone' => 'required|max:255|unique:new_customers,phone',
                'user_password' => 'min:6|same:user_conf_password|required_with:user_password',
                'user_conf_password' => 'required',
                'user_term_policy' => 'required',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => false, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {

                $User = new User();
                $User->name = $Request->user_name;
                $User->lastname = $Request->user_lastname;
                $User->personal_number = $Request->user_personal_id;
                $User->bdate = $Request->user_bday;
                $User->phone = $Request->user_phone;
                $User->email = $Request->user_email_p;
                $User->password = Hash::make($Request->user_password);
                $User->save();

                return Response::json([
                    'status' => true, 
                    'message' => [0 => 'თქვენ წარმატებით გაიარეთ რეგისტრაცია !!!'],
                    'redirect_url' => route('actionUsersSignIn'),
                ]);
            }
        } else {
            return Response::json(['status' => false, 'message' => [0 => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან.']], 200);
        }
    }

    public function ajaxUserSignIn(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'ელ-ფოსტა ან პაროლი არასწორია',
            );
            $validator = Validator::make($Request->all(), [
                'user_email' => 'required',
                'user_password' => 'required',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => [0 => trans('site.incorect_email_or_password')]], 200);
            } else {
                if(Auth::attempt(['email' => $Request->user_email, 'password' => $Request->user_password, 'deleted_at_int' => 1, 'active' => 1], $Request->user_remember_me)) {
                    return Response::json(['status' => true, 'errors' => false]);
                } else {
                    return Response::json(['status' => true, 'errors' => true, 'message' => [0 =>  trans('site.incorect_email_or_password')]]);
                }
            }
        } else {
            return Response::json(['status' => false, 'message' => [0 => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან.']], 200);
        }
    }

    public function ajaxUserUpdate(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეავსოთ ყველა აუცილებელი ველი',
                'user_email.unique' => 'აღნიშნული ელ-ფოსტა დაკავებულია!',
                'user_phone.unique' => 'აღნიშნული ტელეფონის ნომერი დაკავებულია!',
                'user_personal_number.unique' => 'აღნიშნული პირადი ნომერი დაკავებულია!',
            );
            $validator = Validator::make($Request->all(), [
                'user_name' => 'required|max:255',
                'user_lastname' => 'required|max:255',
                'user_personal_number' => 'required|max:255|unique:new_customers,personal_number,'.Auth::user()->id,
                'user_bdate' => 'required|max:255',
                'user_email' => 'required|max:255|unique:new_customers,email,'.Auth::user()->id,
                'user_phone' => 'required|max:255|unique:new_customers,phone,'.Auth::user()->id,
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => false, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $User = new User();
                $User::find(Auth::user()->id)->update([
                    'name' => $Request->user_name,
                    'lastname' => $Request->user_lastname,
                    'personal_number' => $Request->user_personal_number,
                    'bdate' => $Request->user_bdate,
                    'phone' => $Request->user_phone,
                    'email' => $Request->user_email,
                ]);

                return Response::json(['status' => true, 'message' => [0 =>' პროფილი წარმატებით დარედაქტირდა']]);
            }
        } else {
            return Response::json(['status' => false, 'message' => [0 => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან.']], 200);
        }
    }

    public function ajaxUserUpdatePassword(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეავსოთ ყველა აუცილებელი ველი',
            );
            $validator = Validator::make($Request->all(), [
                'npassword' => 'required|max:255|same:cpassword|required_with:npassword',
                'cpassword' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => false, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $User = new User();
                $User::find(Auth::user()->id)->update([
                    'password' => Hash::make($Request->npassword),
                ]);

                return Response::json(['status' => true, 'message' => [0 =>' პროფილი წარმატებით დარედაქტირდა']]);
            }
        } else {
            return Response::json(['status' => false, 'message' => [0 => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან.']], 200);
        }
    }

    public function ajaxUserRestore(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეავსოთ ყველა აუცილებელი ველი',
            );
            $validator = Validator::make($Request->all(), [
                'user_phone' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => false, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $User = new User();
                $UserData = $User::where('phone', $Request->user_phone)->first();
                if($UserData) {
                    return Response::json(['status' => true]);
                } else {
                    return Response::json(['status' => false, 'message' => [0 =>'მომხმარებელი აღნიშნული ტელეფონის ნომერით ვერ მოიძებნა!']]);
                }
            }
        } else {
            return Response::json(['status' => false, 'message' => [0 => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან.']], 200);
        }
    }

    public function ajaxUserRestoreSubmit(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეავსოთ ყველა აუცილებელი ველი',
            );
            $validator = Validator::make($Request->all(), [
                'code_1' => 'required|max:1',
                'code_2' => 'required|max:1',
                'code_3' => 'required|max:1',
                'code_4' => 'required|max:1',
                'code_5' => 'required|max:1',
                'code_6' => 'required|max:1',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => false, 'message' => [0 => 'უსაფრთხოების კოდის ფორმატი არასწორია']], 200);
            } else {
                return Response::json(['status' => true], 200);
            }
        }
    }
}
