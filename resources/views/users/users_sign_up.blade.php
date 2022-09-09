@extends('layout.layout')

@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('actionMainIndex') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{ trans('site.home') }}</a>
                <span></span> {{ trans('site.sign-up') }}
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto pt-30">
                    <div class="row">
                        <div class="col-lg-7 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1 Center">
                                        <h1 class="mb-40 text-brand2">{{ trans('site.sign-up') }}</h1>
                                    </div>
                                    <form id="user_signUp" class="flex">
                                        <div class="form-group">
                                            <input type="text" class="check-input" name="user_name" id="user_name" placeholder="{{ trans('site.name') }}" />
                                            <input type="text" class="check-input" name="user_lastname" id="user_lastname" placeholder="{{ trans('site.lastname') }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="check-input" name="user_personal_id" id="user_personal_id" placeholder="{{ trans('site.user_personal_id') }}" />
                                            <input type="email" class="check-input" name="user_email_p" id="user_email_p" placeholder="{{ trans('site.user_email') }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" class="check-input" name="user_phone" id="user_phone" placeholder="{{ trans('site.user_phone') }}" />
                                            <input type="date" name="user_bday" class="check-input" id="user_bday" placeholder="{{ trans('site.user_bday') }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="check-input" name="user_password" id="user_password" placeholder="{{ trans('site.user_password') }}" />
                                            <input type="password" class="check-input" name="user_conf_password" id="user_conf_password" placeholder="{{ trans('site.confirm_password') }}" />
                                        </div>
                                        <div class="login_footer form-group mb-30 mt-30">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input check-input" type="checkbox" name="user_term_policy" id="user_term_policy" value="1">
                                                    <label class="form-check-label" for="user_term_policy"><span><a href="{{ route('actionMainTerms') }}">{{ trans('site.user_terms') }}</a></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-30 pb-30">
                                            <button type="button" class="btn btn-fill-out btn-block hover-up font-weight-bold" onclick="UserSignUpSubmit()">{{ trans('site.sign-up') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 pr-30 d-lg-block">
                            <div class="card-login mt-130">
                                <a href="{{ route('actionFacebookRedirect') }}" class="social-login facebook-login">
                                    <img src="{{ asset('assets/imgs/theme/icons/logo-facebook.svg') }}" alt="">
                                    <span>Continue with Facebook</span>
                                </a>
                                <a href="{{ route('actionGoogleRedirect') }}" class="social-login google-login">
                                    <img src="{{ asset('assets/imgs/theme/icons/logo-google.svg') }}" alt="">
                                    <span>Continue with Google</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<style type="text/css">
    .input-error {
        border: 1px solid red !important;
    }
</style>
@endsection

@section('js')

@endsection