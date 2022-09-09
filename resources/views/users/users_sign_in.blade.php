@extends('layout.layout')

@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('actionMainIndex') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{ trans('site.home') }}</a>
                <span></span> {{ trans('site.sign-in') }}
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="{{ asset('assets/imgs/page/login-1.png') }}" alt="">
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white ">
                                    <div class="heading_s1 ">
                                        <h1 class="mb-25">{{ trans('site.sign-in') }}</h1>
                                        <p class="mb-30">{{ trans('site.dont_have_acc') }}: <a href="{{ route('actionUsersSignUp') }}">{{ trans('site.place_sign_up') }}</a></p>
                                    </div>
                                    <form id="user_signInPage">
                                        <div class="form-group">
                                            <input type="text" name="user_email" id="user_email" class="check-input" placeholder="{{ trans('site.user_email') }} *" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="user_password" id="user_password" class="check-input" placeholder="{{ trans('site.user_password') }} *" />
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="user_remember_me" id="user_remember_me" value="1">
                                                    <label class="form-check-label" for="user_remember_me"><span>{{ trans('site.user_remember_me') }}</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="{{ route('actionUsersRestore') }}">{{ trans('site.user_password_restore') }}</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-heading btn-block hover-up" onclick="UserSignInSubmitPage()">{{ trans('site.user_login_button') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')

@endsection