@extends('layout.layout')

@section('content')
<main class="main pages">
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12 m-auto pt-30">
                    <div class="login_wrap widget-taber-content background-white">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <img class="border-radius-15" src="{{ asset('assets/imgs/page/forgot_password.svg') }}" alt="" />
                                <h2 class="mb-15 mt-15">{{ trans('site.forgot_your_password') }}</h2>
                                <p class="mb-30">{{ trans('site.forgot_your_password_text') }}</p>
                            </div>
                            <form id="password_restore">
                                <div class="form-group">
                                    <input type="text" name="user_phone" id="user_phone" placeholder="{{ trans('site.restore_phone') }} *" />
                                </div>
                                <div class="form-group pb-30">
                                    <button type="button" class="btn btn-heading btn-block hover-up" onclick="PasswordRestore()">{{ trans('site.continue') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> 
<div class="modal fade custom-modal" id="resetpasswordmodal" tabindex="-1" aria-labelled aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">                      
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30 Center">
                            <h3 class="mb-15 mt-15">დაადასტურეთ ტელეფონის ნომერი</h3>
                            <label class="form-check-label"><span>გთხოვთ შეიყვანეთ კოდი რაც გამოგიგზავნეთ თქვენს ტელეფონის ნომერზე</span></label>
                            <form id="restore_code_form">
                                <div class="otp-field mt-20">
                                    <input type="text" maxlength="1" name="code_1">
                                    <input type="text" maxlength="1" name="code_2">
                                    <input type="text" maxlength="1" name="code_3">
                                    <input type="text" maxlength="1" name="code_4">
                                    <input type="text" maxlength="1" name="code_5">
                                    <input type="text" maxlength="1" name="code_6">
                                </div>
                                <div class="form-group mt-20 mb-20">
                                    <button type="button" class="btn btn-heading btn-block hover-up" onclick="SubmitRestoreCode()" class="resetbtn">დადასტურება</button>
                                </div>
                                <div class="form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <span>არ მიგიღიათ კოდი?  <a href="#0">ხელახლა გაგზავნა</a></span></label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection