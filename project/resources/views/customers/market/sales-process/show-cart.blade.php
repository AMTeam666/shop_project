@extends('customers.layouts.master-two-col')

@section('head-tags')
<title>سبد خرید شما</title>
@endsection


@section('content')

<!-- start cart -->
<section class="mb-4">
    <section class="container-xxl bg-white cart-main-box" >
        <section class="row">
            <section class="col">
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>سبد خرید شما</span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                <section class="row mt-4">
                    <section class="mb-3">
                            <form action="" id="cart_items" method="post" class="content-wrapper  p-3 rounded-2">
                                @csrf
                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp
                            @if($cartItems->count() > 0)
                                @foreach ($cartItems as $cartItem)
                                @php
                                    $totalProductPrice += $cartItem->cartItemProductPrice();
                                    $totalDiscount += $cartItem->cartItemProductDiscount();
                                @endphp

                            <section class="cart-item d-md-flex py-3">
                                <section class="cart-img align-self-start flex-shrink-1">
                                    <img src="{{ asset($cartItem->product->image['indexArray']['large']) }}" alt="">
                                </section>
                                <section class="align-self-start w-100">
                                    <p class="fw-bold product-cart-title">{{ $cartItem->product->name }}</p>
                                    <p class="product-cart-info"><i class="fa fa-store-alt cart-product-selected-warranty me-1"></i> <span> فروشنده : ای پی تویز </span></p>
                                    <p class="product-cart-info"><i class="fas fa-city cart-product-selected-warranty me-1 "></i> <span>شهر : مشهد </span></p>
                                    @if ($cartItem->product->marketable_number > 0)
                                    <p class="product-cart-info"><i class="fa fa-shopping-basket cart-product-selected-store me-1 "></i> <span></span>کالا موجود در انبار </p> 
                                    @else
                                    <p class="product-cart-info"><i class="fa fa-shopping-basket cart-product-selected-store me-1 "></i> <span></span>کالا ناموجود</p> 
                                    @endif
                                    <section>
                                        <section class="cart-total-product-number d-inline-block ">
                                            <button class="cart-number cart-number-down" type="button">-</button>
                                            <input class="number" name="number[{{ $cartItem->id }}]" data-product-price={{ $cartItem->cartItemProductPrice() }} data-product-discount={{ $cartItem->cartItemProductDiscount() }}  type="number" min="1" max="5" step="1" value="{{ $cartItem->number }}" readonly="readonly">
                                            <button class="cart-number cart-number-up" type="button">+</button>
                                        </section>
                                        <a class="remove-item-product text-decoration-none cart-delete" href="{{ route('customers.sales-process.remove-from-cart', $cartItem) }}"><i class="fa fa-trash-alt"></i> حذف از سبد</a>
                                    </section>
                                </section>
                                <section class=" cart-prices align-self-end flex-shrink-1">
                                    @if(!empty($cartItem->product->activeAmazingSale()))
                                    <section class="text-muted old-price-text text-nowrap mb-1 text-center"> {{ priceFormat($cartItem->product->price ) }} تومان</section>
                                    <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف {{ priceFormat($cartItem->cartItemProductDiscount()) }}</section>
                                    <section class="text-nowrap fw-bold">{{ priceFormat($cartItem->cartItemFinalPrice()) }} تومان</section>
                                    @else
                                    <section class="text-nowrap fw-bold">{{ priceFormat($cartItem->cartItemProductPrice()) }} تومان</section>
                                    @endif
                                </section>
                            </section>
                            @endforeach
                      
                        </form>

                    </section>
                    <section class="box-cart-item-total-price">
                        <section class="content-wrapper  p-3 rounded-2 cart-total-price">
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                <p class="text-muted" id="total_product_price">{{ priceFormat($totalProductPrice) }} تومان</p>
                            </section>

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">تخفیف کالاها</p>
                                <p class="text-danger fw-bolder" id="total_discount">{{ priceFormat($totalDiscount) }} تومان</p>
                            </section>
                            <section class="border-bottom mb-3"></section>
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">جمع سبد خرید</p>
                                <p class="fw-bolder" id="total_price">{{ priceFormat($totalProductPrice - $totalDiscount) }} تومان</p>
                            </section>

                            <p class="my-3">
                                <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                            </p>


                            <section class="">
                                <button onclick="document.getElementById('cart_items').submit()"  class="btn btn-danger py-3 button-complete-order w-100">تکمیل فرآیند خرید</button>
                            </section>
                            @else
                            <h2>محصولی داخل سبد خرید شما نمیباشد</h2>
                        @endif
                        </section>
                    </section>
                </section>
            </section>
        </section>

    </section>
</section>
<!-- end cart -->

@endsection


@section('script')

<script>
    $(document).ready(function(){
        bill();

        $('.cart-number').click(function() {
            bill();
        })
    })


    function bill() {
        var total_product_price = 0;
        var total_discount = 0;
        var total_price = 0;

        $('.number').each(function() {
            var productPrice = parseFloat($(this).data('product-price'));
            var productDiscount = parseFloat($(this).data('product-discount'));
            var number = parseFloat($(this).val());

            total_product_price += productPrice * number;
            total_discount += productDiscount * number;
        })

        total_price = total_product_price - total_discount;

        $('#total_product_price').html(toFarsiNumber(total_product_price));
        $('#total_discount').html(toFarsiNumber(total_discount));
        $('#total_price').html(toFarsiNumber(total_price));


        function toFarsiNumber(number)
        {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }

    }

</script>


<script>
    $('.product-add-to-favorite button').click(function() {
       var url = $(this).attr('data-url');
       var element = $(this);
       $.ajax({
           url : url,
           success : function(result){
            if(result.status == 1)
            {
                $(element).children().first().addClass('text-danger');
                $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
            }
            else if(result.status == 2)
            {
                $(element).children().first().removeClass('text-danger')
                $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
            }
            else if(result.status == 3)
            {
                $('.toast').toast('show');
            }
           }
       })
    })
</script>

@endsection
