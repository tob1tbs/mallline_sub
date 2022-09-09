@extends('layout.layout')

@section('content')
<main class="main pages">
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="row align-items-center mb-50">
                        <div class="col-lg-6">
                            <img src="{{ asset('assets/imgs/page/about-1.png') }}" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4" />
                        </div>
                        <div class="col-lg-6">
                            <div class="pl-25">
                                <h2 class="mb-30">კეთილი იყოს თქვენი მობრძანება მოლაინში</h2>
                                {!! $text_data->{"text_" . app()->getLocale()} !!}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection