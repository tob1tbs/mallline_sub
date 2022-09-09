@extends('layout.layout')

@section('content')
<main class="main pages">
    <div class="page-content pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="mb-50">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="contact-from-area padding-20-row-col">
                                    <h1 class="text-brand mb-10">{{ trans('site.contact_info') }}</h1>
                                    <h4 class="mb-10">{{ trans('site.write_us') }}</h4>
                                    <form class="contact-form-style mt-30" id="contact_form">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="input-style mb-20">
                                                    <input name="name" placeholder="{{ trans('site.name') }}" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="telephone" placeholder="{{ trans('site.phone') }}" type="tel" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="email" placeholder="{{ trans('site.contact_email') }}" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="textarea-style mb-30">
                                                    <textarea name="message" placeholder="{{ trans('site.message') }}"></textarea>
                                                </div>
                                                <button class="submit submit-auto-width" type="button" onclick="SendContact()">{{ trans('site.send') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                            <div class="col-lg-5 pl-50 d-lg-block d-none">
                                <div class="card-login mt-100">
                                    <div class="leftside">
                                        <h3 class="mb-5">{{ trans('site.phone') }}</h3>
                                        <p class="mb-30">{{ $contact_data['phone'] }}</p>
                                    </div>
                                    <div class="leftside"> 
                                        <h3 class="mb-5">{{ trans('site.email') }}</h3>
                                        <p class="mb-30">{{ $contact_data['email'] }}</p>
                                    </div><!-- 
                                    <div class="leftside">
                                        <h3 class="mb-5">{{ trans('site.address') }}</h3>
                                        <p class="mb-30">გურამიშვილის ქ.34. თბილისი, საქართველო</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script src="{{ asset('assets/scripts/main_scripts.js') }}"></script>
@endsection