@extends('layout.layout')

@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('actionMainIndex') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{ trans('site.home') }}</a>
                <span></span> {{ trans('site.my_account') }}
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    @if(empty(Auth::user()->personal_number) OR empty(Auth::user()->phone))
                    <div class="alert alert-primary text-center" role="alert">ვებგვერდის სრულყოფილად გამოსაყენებლად გთხოვთ შეიყვანოთ შემდეგი ველები: @if(empty(Auth::user()->personal_number)) <b>პირადი ნომერი</b> @endif, @if(empty(Auth::user()->phone)) <b>ტელეფონის ნომერი</b> @endif</div>
                    @endif
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>{{ trans('site.acc_details') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#orders-tab" role="tab" aria-controls="orders-tab" aria-selected="false">
                                            <i class="fi-rs-shopping-bag mr-10"></i>{{ trans('site.my_orders') }}</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('actionUsersLogout') }}"><i class="fi-rs-sign-out mr-10"></i>{{ trans('site.logout') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="post" id="user_update">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card-header px-0">
                                                            <h5>{{ trans('site.acc_details') }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{ trans('site.user_name') }}<span class="required">*</span></label>
                                                        <input class="form-control" name="user_name" id="user_name" type="text" value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{ trans('site.user_lastname') }}<span class="required">*</span></label>
                                                        <input class="form-control" name="user_lastname" id="user_lastname" value="{{ Auth::user()->lastname }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{ trans('site.user_bday') }}<span class="required">*</span></label>
                                                        <input class="form-control" name="user_bdate" id="user_bdate" type="date" value="{{ Auth::user()->bdate }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{ trans('site.user_personal_id') }}<span class="required">*</span></label>
                                                        <input class="form-control" name="user_personal_number" id="user_personal_number" value="{{ Auth::user()->personal_number }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{ trans('site.user_phone') }}<span class="required">*</span></label>
                                                        <input class="form-control" name="user_phone" id="user_phone" type="text" value="{{ Auth::user()->phone }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{ trans('site.user_email') }}<span class="required">*</span></label>
                                                        <input class="form-control" name="user_email" id="user_email" type="email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-fill-out submit font-weight-bold" onclick="UserUpdateSubmit()">{{ trans('site.save') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form class="mt-3" id="user_update_password">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card-header px-0">
                                                            <h5>{{ trans('site.update_password') }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>{{ trans('site.new_password') }} <span class="required">*</span></label>
                                                        <input class="form-control" name="npassword" type="password" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>{{ trans('site.confirm_password') }} <span class="required">*</span></label>
                                                        <input class="form-control" name="cpassword" type="password" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-fill-out submit font-weight-bold" onclick="UserUpdatePasswordSubmit()">{{ trans('site.save') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">{{ trans('site.my_orders') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ trans('site.order_number') }} #</th>
                                                            <th>{{ trans('site.date') }}</th>
                                                            <th>{{ trans('site.status') }}</th>
                                                            <th>{{ trans('site.amount') }}</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>#1357</td>
                                                            <td>March 45, 2020</td>
                                                            <td>Processing</td>
                                                            <td>$125.00 for 2 item</td>
                                                            <td><a href="#" class="btn-small d-block">{{ trans('site.details') }}</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
<script type="text/javascript" src="{{ asset('assets/scripts/users_scripts.js') }}"></script>
@endsection