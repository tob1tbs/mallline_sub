@extends('layout.layout')

@section('content')
<main class="main pages">
    <div class="page-content pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white ">
                                        <div class="heading_s1 Center">
                                            <h1 class="mb-25 text-brand2">შექმენი მაღაზია</h1>
                                        </div>
                                        <form action="#" class="flex">
                                            <p class="mt-10 mb-10 bold">დაშვებული სიმბოლოები არის 'a'-დან 'z'-მდე და ციფრები ინტერვალის გარეშე</p>
                                            <div class="form-group">
                                                <input type="text" name="subdomain" id="subdomain" placeholder="მაღაზიის სახელი" onkeyup="ShowSubdomain()">
                                                <button type="button" onclick="CheckSubdomain()" class="btn-block button">შემოწმება</button>
                                            </div>
                                            <div class="domaincard mb-20 mt-20">
                                                <div class="card-header">
                                                   <p class="text-brand bold mt-10">შემოწმება</p>
                                                </div>
                                                <div class="card-body bg-transparent">
                                                    <p class="mb-15 bold">თქვენი მაღაზიის დომენის სახელი ასე გამოიყურება:</p>
                                                    <span class="mt-10 text-brand bold"><span class="text-brand bold subdomain-text"></span>.mallline.ge</span>
                                                </div>
                                            </div>
                                            <div class="form-group mb-30 block">
                                                <button type="button" onclick="SubmitBuilder()" class="btn-fill-out btn-block hover-up right button">სცადე უფასოდ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-none d-lg-block">
                                <div class="heading_s1 Center">
                                    <h1 class="mb-5 text-brand2">ღირებულება</h1>
                                </div>
                                <div class="card-login mt-50">
                                    <div class="leftside2">
                                        <h3 class="mb-5">პლატფორმით სარგებლობა</h3>
                                        <p class="mb-30 text-brand">უფასოა 30 დღის განმავლობაში</p>
                                    </div>
                                    <div class="leftside2"> 
                                        <h3 class="mb-5">კონტაქტის გაფორმებიდან</h3>
                                        <p class="mb-30 text-brand">თვეში 99 ლარი</p>
                                    </div>
                                    <div class="leftside2">
                                        <h3 class = "mb-5"> ჩვენი უპირატესობები </h3>
                                        <ul>
                                            <li> სრული წვდომა ფუნქციონალზე</li>
                                            <li> საბანკო ბარათებით</li>
                                            <li> საბანკო გადარიცხვა(ინვოისით) </li>
                                            <li> ვებ-გვერდის ნებისმიერ ენაზე შექმნის შესაძლებლობა </li>
                                            <li> ინტეგრაცია ადგილობრივ საკურიერო კომპანიებთან </li>
                                        </ul>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<style type="text/css">
    .button {
        font-size: 16px;
        font-weight: 500;
        padding: 8px 40px;
        color: #ffffff;
        border: none;
        background-color: #2491e0;
        border: 1px solid #29A56C;
        border-radius: 10px;
    }
</style>
@endsection

@section('js')
<script type="text/javascript">
    function ShowSubdomain() {
        $(".subdomain-text").html($("#subdomain").val())
    }

    function CheckSubdomain() {
        $.ajax({
            dataType: 'json',
            url: "/builder/ajax/check",
            type: "GET",
            data: {
                subdomain: $("#subdomain").val(),
            },
            success: function(data) {
                if(data['status'] == true) {
                    if(data['errors'] == true) {
                        toastr.warning(data['message']);   
                    } else {
                        toastr.success(data['message']);   
                    }
                }
            }
        });
    }

    function SubmitBuilder() {
        $.ajax({
            dataType: 'json',
            url: "/builder/ajax/submit",
            type: "POST",
            data: {
                subdomain: $("#subdomain").val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                // $("#preloader-active").show();
                // $(".preloader-text").show();
            },
            success: function(data) {
                // $("#preloader-active").hide();

                if(data['status'] == true) {

                }
            }
        });
    }
</script>
@endsection