@extends('customers.layouts.master-two-col')

@section('body-class', 'body-product')

@section('head-tags')
<title>{{ $product->name }}</title>
@endsection

@section('content')

@if(session('error'))
<div class="alert alert-seccess">
    {{ session('error') }}
</div>
@endif
@if(session('success'))
<div class="alert alert-danger">
    {{ session('success') }}
</div>
@endif
<!-- start cart -->
<section class="mb-4 product-main">
    <section class="container-xxl product-main-container">
        <section class="">
            <section class="col">


                <section class="d-flex w-100">
                    <!-- start product info -->
                    <section class="product-info-container p-3 ">

                        <section class="content-wrapper p-3 rounded-2 mb-4">

                            <!-- start vontent header -->
                            <section class="product-info">
                                <section class="product-name-container text-center">
                                    <h2 class="text-primary">{{ $product->name }}</h2>
                                </section>
                            </section>
                            <section class="my-4">
                                <p><i class="fa fa-store-alt cart-product-selected-warranty me-1"></i> <span> فروشنده :
                                        {{ $product->store->store_name }} </span></p>
                                <p class="border-bottom border-secondary"><i class="fas fa-city cart-product-selected-warranty me-1 "></i> <span>شهر : {{ $product->store->addresses->first()->city->name }}
                                    </span></p>
                                <p><i class="fa fa-shopping-basket cart-product-selected-store me-1 "></i> <span>
                                        @if ($product->marketable_number > 0)
                                        کالا موجود در انبار
                                        @else
                                        کالا ناموجود
                                        @endif
                                    </span></p>
                            </section>
                            <section class="">
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالا</p>
                                        <p class="text-muted">{{ priceFormat($product->price) }}<span class="small">تومان</span></p>
                                    </section>
                                    @if ($product->activeAmazingSale() != null)
                                    @php
                                    $amazingSale = $product->activeAmazingSale();
                                    $discount = $product->price * ($amazingSale->percentage / 100);
                                    @endphp
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالا</p>
                                        <p class="text-danger fw-bolder">{{ priceFormat($discount) }}<span class="small">تومان</span></p>
                                    </section>
                                    @endif
                                    <section class="border-bottom mb-3"></section>
                                    @if ($product->activeAmazingSale() != null)
                                    <section class="d-flex justify-content-end align-items-center">
                                        <p class="fw-bolder">{{ priceFormat($product->price - $discount) }} <span class="small">تومان</span></p>
                                    </section>
                                    @else
                                    <section class="d-flex justify-content-end align-items-center">
                                        <p class="fw-bolder">{{ priceFormat($product->price) }}<span class="small">تومان</span></p>
                                    </section>
                                    @endif
                                </section>
                            </section>
                            <section>
                                <section class="cart-product-number d-inline-block ">
                                    <form action="{{ route('customers.sales-process.add-to-cart', $product) }}" method="POST">
                                    <button class="cart-number-down" type="button">-</button>
                                    <input class="" name="number" type="number" min="1" max="5" step="1" value="1" readonly="readonly">
                                    <button class="cart-number-up" type="button">+</button>
                                </section>
                            </section>
                            <section class="button-add-to-cart-container">
                              
                                    @csrf
                                <button type="submit" class="btn d-block button-add-to-cart">افزودن به سبد خرید</button>
                                </form>
                            </section>
                            <p>
                                @guest
                                <section class="product-add-to-favorite  position-relative" style="top: 0">
                                    <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی">
                                        <i class="fa fa-heart"></i><span>اضافه از علاقه مندی</span>
                                    </button>
                                </section>
                                @endguest
                                @auth
                                @if ($product->user->contains(auth()->user()->id))
                                <section class="product-add-to-favorite  position-relative" style="top: 0">
                                    <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                        <i class="fa fa-heart text-danger"></i><span>حذف از علاقه مندی</span>
                                    </button>
                                </section>
                                @else
                                <section class="product-add-to-favorite position-relative" style="top: 0">
                                    <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه به علاقه مندی">
                                        <i class="fa fa-heart"></i><span>اضافه از علاقه مندی</span>
                                    </button>
                                </section>
                                @endif
                                @endauth
                            </p>

                        </section>

                    </section>
                    <!-- end product info -->


                    <!-- start image gallery -->
                    <section class="product-gallery-container">
                        <section class="content-wrapper p-3 rounded-2 ">
                            <section class="product-gallery d-flex">
                                <section class="product-gallery-selected-image mb-3">
                                    @php
                                    $imageGalley = $product->images()->get();
                                    $images = collect();
                                    $images->push($product->image);
                                    foreach ($imageGalley as $image) {
                                    $images->push($image->image);
                                    }
                                    @endphp
                                    <img src="{{ asset($images->first()['indexArray']['large']) }}" alt="">
                                </section>
                                <section class="product-gallery-thumbs d-flex flex-column align-items-center">
                                    @foreach ($images as $key => $image)
                                    <img class="product-gallery-thumb" src="{{ asset($image['indexArray']['medium']) }}" alt="" data-input="{{ asset($image['indexArray']['large']) }}">
                                    @endforeach
                                </section>

                            </section>
                        </section>
                    </section>
                    <!-- end image gallery -->




                </section>

            </section>
        </section>

    </section>
</section>
<!-- end cart -->

<!-- start description, features-->
<section class="mb-4">
    <section class="container-xxl">
        <section class="">
            <section class="">
                <section class="content-wrapper rounded-2 shadow-none">

                    <section class="py-4 d-flex">

                        <!-- start introduction + vontent header -->
                        <section class="product-introduction-container">

                            <section id="introduction" class="content-header mt-2">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">
                                خلاصه کتاب اثر مرکب «انتخاب‌های شما تنها زمانی معنی دار است که آنها را به دلخواه به
                                رؤیاهای خود متصل کنید. انتخاب‌های شایسته و انگیزشی، همان‌هایی هستند که شما به عنوان هدف
                                خود و هسته اصلی زندگی خود در بالاترین ارزش‌های خود تعین می‌کنید. شما باید چیزی را
                                بخواهید و می‌دانید که چرا شما آن را می‌خواهید یا به راحتی می‌توانید آن از دست بدهید.»
                                «اولین گام در جهت تغییر، آگاهی است. اگر می‌خواهید از جایی که هستید به جایی که می‌خواهید
                                بروید، باید با درک انتخاب‌هایی که شما را از مقصد مورد نظر خود دور می‌کنند، شروع کنید.»
                                «فرمول کامل برای به دست آوردن خوش شانسی: آماده‌سازی (رشد شخصی) + نگرش (باور / ذهنیت) +
                                فرصت (چیز خوبی که راه را هموار می‌کند) + اقدام (انجام کاری در مورد نظر) = شانس» «ما همه
                                می‌توانیم انتخاب‌های بسیار خوبی داشته باشیم. ما می‌توانیم همه چیز را کنترل کنیم. این در
                                توانایی ماست که همه چیز را تغییر دهیم. به جای اینکه غرق در گذشته شویم، باید دوباره انرژی
                                خود را جمع کنیم، می‌توانیم از تجربیات گذشته برای حرکت‌های مثبت و سازنده استفاده کنیم.»
                                برای ایجاد تغییر، ما نیاز به این داریم که عادات و رفتار خوب را ایجاد کنیم، که در کتاب از
                                آن به عنوان تکانش یاد می شود. تکانش بدین معنی که با ریتم منظم و دائمی و ثبات قدم همراه
                                باشید. حرکت های افراطی و تفریطی، موضع های عجله ای و جوگیر شدن و عدم ریتم مناسب موجب
                                خواهد شد که ثبات قدم نداشته باشیم و حتی شاید از مسیر اصلی دور شویم و تکانش ما با لرزه
                                های فراوان و یا حتی سکون و سکوت مواجه شود. واقعیت رهرو آن است که آهسته و پیوسته رود
                                اینجا پدیدار می گردد و باید همیشه بدانیم هیچ چیز مثل عدم ثبات قدم و نداشتن ریتم مناسب در
                                زمان تغییر، نمی تواند تکانش را با مشکل مواجه کند! متن بالا شاید بهترین خلاصه ای باشد که
                                می شود از کتاب نوشت!
                            </section>

                        </section>


                        <!-- start features + vontent header -->
                        <section class="product-features-container">

                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-product-features ">
                                    @foreach ($product->metas()->get() as $meta)
                                    <tr>
                                        <td>{{ $meta->meta_key }}</td>
                                        <td>{{ $meta->meta_value }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                @php
                                $tags = explode(',', $product->tags);
                                @endphp

                                @foreach ($tags as $tag)
                                <a class="text-decoration-none" href="#">{{ $tag }}</a>
                                @endforeach
                            </section>

                        </section>
                    </section>

                </section>
            </section>
        </section>
    </section>
</section>

<!-- start COMMENTS-->
<section class="mb-4">
    <section class="container-xxl">
        <section class="">
            <section class="">
                <section class="content-wrapper bg-white p-3 rounded-2">

                    <section class="py-4">

                        <!-- start vontent header -->
                        <section id="comments" class="content-header mt-2 mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    دیدگاه ها
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <section class="product-comments mb-4"> @auth
                            <button class="accordion_add_comment">افزودن دیدگاه <i class="fa fa-plus"></i></button>
                            @endauth
                            @guest
                            <span>برای نظر دادن ابتدا در سایت ثبت نام کنید <a class="text-decoration-none" href="{{ route('auth.customers.login-register-form') }}">ثبت نام / ورود</a></span>
                            @endguest
                            <!-- start add comment Modal -->

                            <div class="panel_add_comment">
                                <section class="comment-add-wrapper">
                                    <!-- start add comment Modal -->

                                    <section class="" id="">
                                        <section class="">
                                            <section class="">
                                                <section class="">
                                                    <form class="" action="{{ route('customer.market.add-comment', $product) }}" method="POST">
                                                        @csrf
                                                        <section class="col-12 mb-2">
                                                            <label for="comment" class="form-label mb-1">دیدگاه شما</label>
                                                            <textarea name="body" class="form-control form-control-sm" id="comment" placeholder="دیدگاه شما ..." rows="15"></textarea>
                                                        </section>
                                                </section>
                                                <section class="py-1 text-center">
                                                    <button type="submit" class="btn btn-sm btn-primary w-25 button-sumbit-comment">ثبت دیدگاه</button>
                                                </section>
                                            </form>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                            </div>
            
                            @foreach ($product->activeComments()->reverse() as $activeComment)
                            <section class="product-comment">
                                <section class="product-comment-header d-flex justify-content-between">

                                    @php
                                    $author = $activeComment->user()->first();
                                    @endphp
                                    <section class="product-comment-title">
                                        @if (empty($author->first_name) && empty($author->last_name))
                                        ناشناس
                                        @else
                                        {{ $author->first_name . ' ' . $author->last_name }}
                                        @endif
                                    </section>
                                    <section class="product-comment-date">
                                        {{ jalaliDate($activeComment->created_at) }}
                                    </section>
                                </section>
                                <section class="product-comment-body @if ($activeComment->answers()->count() > 0) border-bottom @endif">
                                    {!! $activeComment->body !!}
                                    <section class="product-comment-vote text-end ">
                                        <a href="#"><i class="fa fa-thumbs-down text-danger"></i></a>
                                        <a href="#"><i class="fa fa-thumbs-up text-success"></i></a>
                                    </section>
                                </section>

                                @foreach ($activeComment->answers()->get() as $commentAnswer)
                                <section class="product-comment ms-5 border-bottom-0">
                                    <section class="product-comment-header d-flex justify-content-between">
                                        @php
                                        $author = $commentAnswer->user()->first();
                                        @endphp
                                        <section class="product-comment-title">
                                            ادمین
                                        </section>
                                        <section class="product-comment-date">
                                            {{ jalaliDate($commentAnswer->created_at) }}
                                        </section>
                                    </section>
                                    <section class="product-comment-body @if ($commentAnswer->answers()->count() > 0) border-bottom @endif">
                                        {!! $commentAnswer->body !!}
                                    </section>
                                </section>
                                @endforeach
                            </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
</section>
</section>
</section>
<!-- end description, features and comments -->

<!-- start product lazy load -->
<section class="mb-3 pt-3">
    <section class="container-xxl">
        <section class="row">
            <section class="col">
                <section class="content-wrapper p-3 top-category-box container-product-box">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="">
                            <h2 class="content-header-title text-center">
                                <span class="">پر فروش ها</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="lazyload-wrapper">
                        <section class="lazyload light-owl-nav owl-carousel owl-theme">
                            @foreach ($relatedProducts as $relatedProduct)
                            <section class="item">
                                <section class="lazyload-item-wrapper">
                                    <section class="product">
                                        @auth
                                        <form action="{{ route('customers.sales-process.add-to-cart', $relatedProduct) }}" method="POST">
                                            @csrf
                                            <section class="product-add-to-cart"><button class="btn btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></button>
                                            </section>
                                        </form>
                                        @endauth
                                        @guest
                                        <section class="product-add-to-favorite">
                                            <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $relatedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        </section>
                                        @endguest
                                        @auth
                                        @if ($relatedProduct->user->contains(auth()->user()->id))
                                        <section class="product-add-to-favorite">
                                            <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $relatedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                                <i class="fa fa-heart text-danger"></i>
                                            </button>
                                        </section>
                                        @else
                                        <section class="product-add-to-favorite">
                                            <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $relatedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه به علاقه مندی">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        </section>
                                        @endif
                                        @endauth

                                        @php
                                        $productPrice = $relatedProduct->price;
                                        $productDiscount = empty($relatedProduct->activeAmazingSale()) ? 0 :
                                        $productPrice * ($relatedProduct->activeAmazingSale()->percentage / 100);
                                        @endphp
                                        <span class="product-link ">
                                            <section class="product-image">
                                                <img class="" src="{{ asset($relatedProduct->image['indexArray']['medium']) }}" alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{ $relatedProduct->name }}</h3>
                                            </section>
                                            <section class="product-price-wrapper">
                                                @if (!$relatedProduct->activeAmazingSale() == null)
                                                <section class="product-discount">
                                                    <span class="product-old-price">{{
                                                        priceFormat($relatedProduct->price) }}
                                                        تومان</span>
                                                </section>
                                                @endif
                                                <section class="product-price">
                                                    {{ priceFormat($relatedProduct->price - $productDiscount) }}
                                                    تومان</section>
                                            </section>
                                            @if (!$relatedProduct->activeAmazingSale() == null)
                                            <section class="product-discount-percent">
                                                <span class="product-discount-amount">{{
                                                    $relatedProduct->activeAmazingSale()->percentage }}%</span>
                                                <span class="product-discount-amount-text">off</span>
                                            </section>
                                            @endif
                                        </span>
                                        <section class="product-button-container text-center">
                                            <a class="product-button btn btn-info w-100" href="{{ route('customer.market.product', $relatedProduct) }}">
                                                مشاهده </a>
                                        </section>

                                    </section>
                                </section>
                            </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>

<!-- end product lazy load -->

@endsection

@section('script')

{{-- <script>
    $(document).ready(function(){
          bill();
          //input color
        $('input[name="color"]').change(function(){
            bill();
        })
        //guarantee
        $('select[name="guarantee"]').change(function(){
            bill();
        })
         //number
         $('.cart-number').click(function(){
            bill();
        })
        })
    
        function bill() {
            if($('input[name="color"]:checked').length != 0){
                var selected_color = $('input[name="color"]:checked');
               $("#selected_color_name").html(selected_color.attr('data-color-name'));
            }
    
            //price computing
            var selected_color_price = 0;
            var selected_guarantee_price = 0;
            var number = 1;
            var product_discount_price = 0;
            var product_original_price = parseFloat($('#product_price').attr('data-product-original-price'));
    
            if($('input[name="color"]:checked').length != 0)
            {
                selected_color_price = parseFloat(selected_color.attr('data-color-price'));
            }
    
            if($('#guarantee option:selected').length != 0)
            {
                selected_guarantee_price = parseFloat($('#guarantee option:selected').attr('data-guarantee-price'));
            }
    
            if($('#number').val() > 0)
            {
                number = parseFloat($('#number').val());
            }
    
            if($('#product-discount-price').length != 0)
            {
                product_discount_price = parseFloat($('#product-discount-price').attr('data-product-discount-price'));
            }
    
            //final price
            var product_price = product_original_price + selected_color_price + selected_guarantee_price;
            var final_price = number * (product_price - product_discount_price);
            $('#product-price').html(toFarsiNumber(product_price));
            $('#final-price').html(toFarsiNumber(final_price));
        }
    
        function toFarsiNumber(number)
        {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }
    
</script> --}}


<script>
    $('.product-add-to-favorite button').click(function() {
        var url = $(this).attr('data-url');
        var element = $(this);
        $.ajax({
            url: url
            , success: function(result) {
                if (result.status == 1) {
                    $(element).children().first().addClass('text-danger');
                    $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                    $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                } else if (result.status == 2) {
                    $(element).children().first().removeClass('text-danger')
                    $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                    $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
                } else if (result.status == 3) {
                    $('.toast').toast('show');
                }
            }
        })
    })

</script>

<script>
    //start product introduction, features and comment
    $(document).ready(function() {
        var s = $("#introduction-features-comments");
        var pos = s.position();
        $(window).scroll(function() {
            var windowpos = $(window).scrollTop();

            if (windowpos >= pos.top) {
                s.addClass("stick");
            } else {
                s.removeClass("stick");
            }
        });
    });
    //end product introduction, features and comment

</script>
<script>
    var acc = document.getElementsByClassName("accordion_add_comment");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active_add_comment");
            var panel_add_comment = this.nextElementSibling;
            if (panel_add_comment.style.maxHeight) {
                panel_add_comment.style.maxHeight = null;
            } else {
                panel_add_comment.style.maxHeight = panel_add_comment.scrollHeight + "px";
            }
        });
    }

</script>

@endsection
