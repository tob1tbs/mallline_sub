@extends('layout.layout')

@section('content')
<main class="main">
    <form id="checkout_form" class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <h4 class="mb-30">{{ trans('site.order_detail') }}</h4>
                    <div method="post">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" required="" name="fname" placeholder="სახელი *" value="{{ Auth::user()->name }}" disabled>
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" required="" name="lname" placeholder="გვარი *" value="{{ Auth::user()->lastname }}" disabled>
                            </div>
                        </div>
                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select class="form-control select-active w-100" name="delivery_city">
                                        <option value="" selected disabled>აირჩიეთ ქალაქი</option>
                                        @foreach($city_list as $item)
                                        <option value="{{ $item->id }}">{{ $item->name_ge }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" name="billing_address" required="" placeholder="მისამართი *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input required="" type="text" name="phone" placeholder="ტელეფონი *" value="{{ Auth::user()->phone }}" disabled>
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" type="text" name="email" placeholder="ელ.ფოსტა *" value="{{ Auth::user()->email }}" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" name="delivery_comment" id="delivery_comment" placeholder="დამატებითი ინფორმაცია"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>{{ trans('site.my_order') }}</h4>
                        <h6 class="text-muted">{{ trans('site.total') }} : <span class="text-brand2">{{ Cart::getTotal() }}₾</span> </h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                                @if(count(Cart::getContent()) > 0)
                                    @foreach(Cart::getContent() as $cart_item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="@if(!empty($cart_item['attributes']['photo'])) {{ $cart_item['attributes']['photo'] }} @endif" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a href="{{ route('actionProductsView', $cart_item->id) }}" class="text-heading">{{ $cart_item->name }}</a></h6></span>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{ $cart_item->quantity }}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">₾{{ $cart_item->price }}</h4>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="payment-form" class="delivery-payment-methods">
                    <h4 class="mb-20">გადახდის დეტალები</h4>
                    <h3 class="last-steps__sub-title">აირჩიეთ გადახდის მეთოდი</h2>
                    <div class="purchase-radio-wrap">
                        <div class="purchase-radio">
                            <input id="card-pay" value="card" type="radio" name="payment-method" checked>
                            <div class="purchase-radio__overlay">
                                <svg id="Group_2844" data-name="Group 2844" xmlns="http://www.w3.org/2000/svg" width="28.642" height="25.532" viewBox="0 0 28.642 25.532">
                                    <path id="Path_194" data-name="Path 194" d="M191.27,36.976l-17.542-3.712a1.383,1.383,0,0,0-1.635,1.064l-.333,2.142L192,40.753l.333-2.142A1.383,1.383,0,0,0,191.27,36.976Z" transform="translate(-163.721 -33.234)" />
                                    <path id="Path_195" data-name="Path 195" d="M20.172,168.836a1.4,1.4,0,0,0-1.714-.969l-3.33.924L7.277,167.13l-.863,4.079-5.395,1.5A1.4,1.4,0,0,0,.05,174.42l3.04,10.955a1.4,1.4,0,0,0,1.714.969l17.439-4.839a1.4,1.4,0,0,0,.969-1.714l-.522-1.881,1.956.414a1.383,1.383,0,0,0,1.635-1.064l1.237-5.847-7.045-1.491Zm2.014,5.568.431-2.038a.569.569,0,0,1,.673-.438l2.038.432a.569.569,0,0,1,.438.673l-.431,2.038a.569.569,0,0,1-.673.438l-2.038-.431A.569.569,0,0,1,22.186,174.4Zm-20.863-.6,4.826-1.339,11.387-3.16,1.225-.34a.255.255,0,0,1,.067-.009.263.263,0,0,1,.25.188l.144.518.451,1.624L1.738,176.259l-.595-2.142A.261.261,0,0,1,1.323,173.8Zm20.8,6.295a.262.262,0,0,1-.179.317L4.5,185.251a.253.253,0,0,1-.067.009.263.263,0,0,1-.25-.188l-1.773-6.39L20.345,173.7l1.094,3.941Z" transform="translate(0 -160.863)" />
                                    <path id="Path_196" data-name="Path 196" d="M92.208,445.017a.569.569,0,0,0-.7-.4l-2.037.565a.569.569,0,0,0-.395.7l.565,2.036a.569.569,0,0,0,.7.395l2.037-.565a.569.569,0,0,0,.4-.7Z" transform="translate(-84.889 -425.349)" />
                                  </svg>
                                <span>ბარათით გადახდა</span>
                            </div>
                        </div>
                        <div class="purchase-radio">
                            <input id="cash-pay" type="radio" value="cash" name="payment-method">
                            <div class="purchase-radio__overlay" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.404" height="28.005" viewBox="0 0 22.404 28.005">
                                    <path id="cash-payment" d="M69.6,38.168v5.37a.467.467,0,0,0,.467.467H85.934a.467.467,0,0,0,.467-.467v-11.2a2.341,2.341,0,0,0-.275-1.1l-3.459-6.486V16.467A.467.467,0,0,0,82.2,16H70.065a.467.467,0,0,0-.467.467V18.1l-5.274,1.651a.467.467,0,0,0-.306.585ZM69,22.2l-.279-.891.874-.274v7.752l-1.791-5.724.891-.279A.467.467,0,0,0,69,22.2ZM85.468,32.336V43.071h-2.8a4.206,4.206,0,0,1-4.2-4.112.467.467,0,0,0-.072-.35l-3.027-4.481a1.4,1.4,0,1,1,2.32-1.568l.008.012,2.725,3.771a.467.467,0,0,0,.378.193h1.4a.467.467,0,0,0,.467-.467V26.735L85.3,31.677A1.406,1.406,0,0,1,85.468,32.336ZM73.332,39.8H72.4V20.2h.933a.467.467,0,0,0,.467-.467V18.8h4.667v.933a.467.467,0,0,0,.467.467h.933V33.981l-1.409-1.95a2.354,2.354,0,0,0-.18-.23,2.8,2.8,0,1,0-3.813.451,2.341,2.341,0,0,0,.13,2.4L77.535,39a5.1,5.1,0,0,0,.561,2.2H73.8v-.933A.467.467,0,0,0,73.332,39.8Zm1.89-8.393c-.056.038-.109.078-.161.12a1.867,1.867,0,1,1,2.471-.292,2.334,2.334,0,0,0-2.31.172Zm-4.69-14.477h11.2V35.6h-.695l-.239-.33V19.734a.467.467,0,0,0-.467-.467H79.4v-.933a.467.467,0,0,0-.467-.467h-5.6a.467.467,0,0,0-.467.467v.933h-.933a.467.467,0,0,0-.467.467V40.271a.467.467,0,0,0,.467.467h.933v.933a.467.467,0,0,0,.467.467h5.379a5.176,5.176,0,0,0,1.01.933H70.532ZM69.6,19.083v.978l-1.6.5a.467.467,0,0,0-.306.585l.279.891-.891.279a.467.467,0,0,0-.306.585L69.6,31.917v3.126L65.049,20.507Z" transform="translate(-63.997 -16)" />
                                </svg>
                                <span>ქეშით გადახდა</span>
                            </div>
                        </div>
                        <div class="purchase-radio">
                            <input id="installment-pay" type="radio" value="installment" name="payment-method">
                            <div class="purchase-radio__overlay" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="19.297" height="22.011" viewBox="0 0 19.297 22.011">
                                    <path id="invoices" d="M38.368,7.418a4.749,4.749,0,1,0,4.749-4.749A4.755,4.755,0,0,0,38.368,7.418Zm8.775,0a4.026,4.026,0,1,1-4.026-4.026A4.03,4.03,0,0,1,47.143,7.418ZM43.117,4.975a.362.362,0,0,1,.362.362V5.49A1.087,1.087,0,0,1,44.2,6.513a.362.362,0,1,1-.724,0,.362.362,0,1,0-.724,0V6.66a.36.36,0,0,0,.254.345l.432.135A1.081,1.081,0,0,1,44.2,8.176v.146a1.087,1.087,0,0,1-.859,1.062V9.5a.362.362,0,1,1-.724,0V9.287a1.086,1.086,0,0,1-.588-.964.362.362,0,1,1,.724,0,.362.362,0,1,0,.724,0V8.176a.36.36,0,0,0-.254-.345L42.793,7.7a1.081,1.081,0,0,1-.762-1.036V6.513a1.087,1.087,0,0,1,.724-1.023V5.337A.362.362,0,0,1,43.117,4.975ZM49,14.564v4.614a2.536,2.536,0,0,1-2.533,2.533H32.533A2.536,2.536,0,0,1,30,19.178V1.447A1.449,1.449,0,0,1,31.447,0h11.76a1.449,1.449,0,0,1,1.447,1.447.362.362,0,0,1-.724,0,.725.725,0,0,0-.724-.724H31.447a.725.725,0,0,0-.724.724V19.178a1.811,1.811,0,0,0,1.809,1.809H44.694a2.525,2.525,0,0,1-.763-1.809V13.524a.362.362,0,0,1,.724,0v5.654a1.809,1.809,0,1,0,3.618,0V14.564a.725.725,0,0,0-.724-.724H46.012a.362.362,0,1,1,0-.724H47.55A1.449,1.449,0,0,1,49,14.564ZM33.166,9.725a.362.362,0,0,1,.362-.362H36.6a.362.362,0,0,1,0,.724H33.528A.362.362,0,0,1,33.166,9.725Zm0-4.071a.362.362,0,0,1,.362-.362H36.6a.362.362,0,0,1,0,.724H33.528A.362.362,0,0,1,33.166,5.654ZM41.489,13.8a.362.362,0,0,1-.362.362h-7.6a.362.362,0,0,1,0-.724h7.6A.362.362,0,0,1,41.489,13.8Zm0,3.8a.362.362,0,0,1-.362.362h-7.6a.362.362,0,0,1,0-.724h7.6A.362.362,0,0,1,41.489,17.595Z" transform="translate(-29.85 0.15)"   />
                                  </svg>
                                <span>განვადება</span>
                            </div>
                        </div>
                        <div class="purchase-radio">
                            <input id="account-pay" type="radio" value="bank-acc" name="payment-method">
                            <div class="purchase-radio__overlay" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.582" height="21.001" viewBox="0 0 20.582 21.001">
                                    <g id="surface1" transform="translate(-0.089 -4.001)">
                                      <path id="Path_197" data-name="Path 197" d="M.475,5.8a.85.85,0,0,0-.013.126v.864a.856.856,0,0,0,.556.8V8.862a.8.8,0,0,0,.761.8V17a.8.8,0,0,0-.761.8v1.267a.866.866,0,0,0-.556.807v.845A.286.286,0,0,0,.747,21H20a.285.285,0,0,0,.285-.285v-.845a.866.866,0,0,0-.556-.807V17.79a.8.8,0,0,0-.761-.8V9.658a.8.8,0,0,0,.761-.8V7.591a.857.857,0,0,0,.556-.8V5.933a.83.83,0,0,0-.013-.126.284.284,0,0,0,.23-.52L10.5.034a.286.286,0,0,0-.267,0l-10,5.249a.285.285,0,0,0,.234.52ZM1.589,8.086v-.44H4.881v.436ZM8.919,9.66V17a.8.8,0,0,0-.761.8v1.214H5.448V17.8a.8.8,0,0,0-.761-.8V9.658a.8.8,0,0,0,.761-.8V7.646H8.154V8.86a.8.8,0,0,0,.761.8Zm-.19-1.574v-.44h3.292v.436ZM16.059,9.66V17a.8.8,0,0,0-.761.8v1.214h-2.71V17.8a.8.8,0,0,0-.761-.8V9.658a.8.8,0,0,0,.761-.8V7.646h2.706V8.86a.8.8,0,0,0,.761.8Zm-.19-1.574v-.44h3.292v.436Zm3.292,10.49v.436h-3.3v-.436Zm-7.14,0v.436h-3.3v-.436ZM9.2,9.093H8.953a.228.228,0,0,1-.228-.228V8.657h3.292v.208a.228.228,0,0,1-.228.228Zm2.057.571V17H9.486V9.663ZM9.2,17.569h2.588a.228.228,0,0,1,.228.228V18H8.725V17.8a.228.228,0,0,1,.228-.228ZM4.877,18.576v.436H1.585v-.436ZM1.585,8.87V8.657H4.877v.208a.228.228,0,0,1-.228.228H1.807a.228.228,0,0,1-.223-.23Zm2.531.8V17H2.346V9.663ZM1.585,17.8a.228.228,0,0,1,.228-.228H4.649a.228.228,0,0,1,.228.228v.207H1.585Zm18.129,2.08v.559H1.029v-.559a.3.3,0,0,1,.295-.3H19.418a.3.3,0,0,1,.295.289Zm-.556-2.08v.207H15.865V17.8a.228.228,0,0,1,.228-.228h2.841a.228.228,0,0,1,.223.223ZM16.626,17V9.663H18.4V17ZM19.158,8.87a.228.228,0,0,1-.228.228H16.1a.228.228,0,0,1-.228-.228V8.657h3.292ZM10.371.6l8.5,4.468h-17ZM1.029,5.933a.285.285,0,0,1,.285-.285H19.428a.285.285,0,0,1,.285.285V6.8a.285.285,0,0,1-.285.285H1.314A.285.285,0,0,1,1.029,6.8Zm0,0" transform="translate(0 4)" />
                                    </g>
                                </svg>
                                <span>საბანკო ანგარიშით</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-payment">
                        <h2 class="bank-payment__title">აირჩიეთ ბანკი</h2>
                        <div class="bank-payment-radios">
                            <div class="bank-payment-radio">
                                <div class="bank-payment-radio__content">
                                    <img src="assets\imgs\theme\checkout\bog.png" alt="">
                                    საქართველოს ბანკი
                                </div>
                                <input type="radio" value="card-bog" name="card-payment">
                               <span class="bank-payment-radio__sign"> &check; </span>
                            </div>
                            <div class="bank-payment-radio">
                                <div class="bank-payment-radio__content">
                                    <img src="{{ asset('assets\imgs\theme\checkout\tbc.png') }}" alt="">
                                    თიბისი ბანკი
                                </div>
                                <input type="radio" value="card-tbc" name="card-payment">
                               <span class="bank-payment-radio__sign"> &check; </span>
                            </div>
                        </div>
                    </div>
                    <div class="installment-payment hidden">
                        <h2 class="bank-payment__title">აირჩიეთ ბანკი</h2>
                        <div class="bank-payment-radios">
                            <div class="bank-payment-radio">
                                <div class="bank-payment-radio__content">
                                    <img  src="assets\imgs\theme\checkout\bog.png" alt="">
                                    საქართველოს ბანკი
                                </div>
                                <input type="radio" value="installment-bog" name="installment-bank">
                               <span class="bank-payment-radio__sign"> &check; </span>
                            </div>
                            <div class="bank-payment-radio">
                                <div class="bank-payment-radio__content">
                                    <img  src="{{ asset('assets\imgs\theme\checkout\tbc.png') }}" alt="">
                                    საქართველოს ბანკი
                                </div>
                                <input type="radio" value="installment-bog" name="installment-bank">
                               <span class="bank-payment-radio__sign"> &check; </span>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" onclick="CheckoutSubmit()" class="btn btn-fill-out btn-block mt-30">გადახდა<i class="fi-rs-sign-out ml-15"></i></a>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection

@section('js')
<script src="{{ asset('assets/scripts/main_scripts.js') }}"></script>
@endsection