@extends('customers.layouts.master-one-col')

@section('background-image')
<div class="snow-backgound-1" style="background: url({{ asset('backgrounds/snow.png') }}); position:absolute; top: 0; left: 0; width: 100%;  height: 380vh; background-position: 0 0; background-size: 70em; animation: snowfall1 50s linear infinite; z-index: -1;"></div>

@endsection
@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <!-- start slideshow -->
    <section class="container-xxl container-banner-slideshow-top">
        <section class="row banner-slideshow-top">
            <section class="col-md-8 pe-md-1 col-banner-slideshop-top">
                <section id="slideshow" class="owl-carousel owl-theme">
                    @foreach($slideShowImages as $slideShowImage)
                    <section class="item"><a class="w-100 d-block h-auto text-decoration-none" href="#"><img class="w-100 rounded-2 d-block h-auto" src="{{ asset($slideShowImage->image) }}" alt=""></a></section>
                    @endforeach
                </section>
            </section>
        </section>
    </section>
    <!-- end slideshow -->



       <!-- start category lazy load -->
       <section class="mb-3 pt-3">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <section class="content-wrapper p-3 top-category-box container-lazyload-box">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="">
                                <h2 class="content-header-title text-center">
                                    <span class=""> دسته بندی ها</span>
                                </h2>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme lazyload-category-outer">
                                @foreach($categories as $category)
                                <section class="item">
                                    <section class="lazyload-item-wrapper">
                                        <section class="category-lazyload">
                                            <a class="category-lazyload-link" href="{{ route('customers.category.show', $category) }}">
                                                <section class="category-lazyload-image">
                                                    <img class="" src="{{ $category->image['indexArray']['medium'] }}" alt="">
                                                </section>
                                            </a>
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


      <!-- start age range  -->
        
      <section class="container-age-range">
        <section class="content-header">
            <section class="">
                <h2 class="content-header-title text-center">
                    <span class=""> رنج سنی</span>
                </h2>
            </section>
        </section>
        <ul>
            <li><a href="#" title="Age 0 to 3"><img class="age-range-image" src="{{ asset('age-range/0-1-sal-boy-v03.jpg') }}" alt="Age 0 to 3"></a></li>
            <li><a href="#" title="Age 3 to 5"><img class="age-range-image" src="{{ asset('age-range/1-3-sal-girl-v03.jpg') }}" alt="Age 3 to 5"></a></li>
            <li><a href="#" title="Age 5 to 8"><img class="age-range-image" src="{{ asset('age-range/3-5-sal-boy-v03.jpg') }}" alt="Age 5 to 8"></a></li>
            <li><a href="#" title="Age 8 to 11"><img class="age-range-image" src="{{ asset('age-range/5-8-sal-girl-v03.jpg') }}" alt="Age 8 to 11"></a></li>
            <li><a href="#" title="Age 11 upper"><img class="age-range-image" src="{{ asset('age-range/8-12-sal-boy-v03.jpg') }}" alt="Age 11 upper"></a></li>
        </ul>
    </section>

     <!-- end age range  -->


      <!-- start ads section -->
      <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                @foreach($middleBanners as $middleBanner)
                <section class="col-12 col-md-6 mt-2 mt-md-0"><img class="d-block rounded-2 w-100" src="{{ $middleBanner->image }}" alt=""></section>
                @endforeach
            </section>

        </section>
    </section>
    <!-- end ads section -->


     <!-- start product lazy load -->
     <section class="mb-3 pt-3">
        <section class="container-xxl" >
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
                        <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                @foreach($mostVisitedProducts as $mostVisitedProduct)
                                <section class="item">
                                    <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            @auth
                                            <form action="{{ route('customers.sales-process.add-to-cart', $mostVisitedProduct) }}" method="POST">
                                            @csrf
                                                <section class="product-add-to-cart"><button class="btn btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></button></section>
                                            </form>
                                            @endauth
                                            @guest
                                            <section class="product-add-to-favorite">
                                                <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </section>
                                            @endguest
                                            @auth
                                                @if ($mostVisitedProduct->user->contains(auth()->user()->id))
                                                <section class="product-add-to-favorite">
                                                    <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                                        <i class="fa fa-heart text-danger"></i>
                                                    </button>
                                                </section>
                                                @else
                                                <section class="product-add-to-favorite">
                                                    <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه به علاقه مندی">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </section>
                                                @endif
                                            @endauth
                                            
                                            @php
                                                $productPrice = $mostVisitedProduct->price;
                                                $productDiscount = empty($mostVisitedProduct->activeAmazingSale()) ? 0 : $productPrice * ($mostVisitedProduct->activeAmazingSale()->percentage / 100);
                                            @endphp
                                            <span class="product-link ">
                                                <section class="product-image">
                                                    <img class="" src="{{ asset($mostVisitedProduct->image['indexArray']['medium']) }}" alt="">
                                                </section>
                                                <section class="product-colors"></section>
                                                <section class="product-name"><h3>{{ $mostVisitedProduct->name }}</h3></section>
                                                <section class="product-price-wrapper">
                                                    @if(!$mostVisitedProduct->activeAmazingSale() == null)
                                                    <section class="product-discount">
                                                        <span class="product-old-price">{{ priceFormat($mostVisitedProduct->price) }} تومان</span>
                                                    </section>
                                                  
                                                    @endif
                                                    <section class="product-price">{{ priceFormat($mostVisitedProduct->price - $productDiscount)  }} تومان</section>
                                                </section>
                                                @if(!$mostVisitedProduct->activeAmazingSale() == null)
                                                <section class="product-discount-percent" >
                                                    <span class="product-discount-amount">{{ $mostVisitedProduct->activeAmazingSale()->percentage }}%</span>
                                                    <span class="product-discount-amount-text">off</span>
                                                </section>
                                                @endif
                                            </span>
                                            <section class="product-button-container text-center">
                                                <a class="product-button btn btn-info w-100" href="{{ route('customer.market.product', $mostVisitedProduct) }}"> مشاهده </a>
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


    @if(!empty($bottomBanner))
      <!-- start ads section -->
      <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4">
                <section class="col"><img class="d-block rounded-2 w-100" src="assets/images/ads/one-col-1.jpg" alt=""></section>
            </section>

        </section>
    </section>
    <!-- end ads section -->
    @endif



        <!-- start brand part-->
        <section class="brand-part mb-4 py-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex align-items-center">
                                <h2 class="content-header-title">
                                    <span>برندهای ویژه</span>
                                </h2>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="brands-wrapper py-4" >
                            <section class="brands dark-owl-nav owl-carousel owl-theme">

                                @foreach($brands as $brand)
                                <section class="item">
                                    <section class="brand-item">
                                        <a href="#"><img class="rounded-2" src="{{ $brand->logo }}" alt=""></a>
                                    </section>
                                </section>
                                @endforeach
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        <!-- end brand part-->

        <section class="mb-3 pt-3">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper p-3 top-category-box container-product-box">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="">
                                    <h2 class="content-header-title text-center">
                                        <span class="">محتوی سایت</span>
                                    </h2>
                                </section>
                            </section>
                            <section class="container-main-content">
                                <a href="{{ route('customer.content.cartoon.index') }}">
                                    <section class="main-cartoons">
                                        <img src="{{ asset('customers-assets/images/main-content/cartoons/cartoons.jpg') }}" alt="انمیشین ها">
                                        <div class="aside-cartoons">
                                            <h1 class="d-block">انمیشین ها</h1>
                                            <p>مجموعه انمیشین های جذاب و دیدنی</p>
                                        </div>
                                    </section>
                                </a>
                                <a href="{{ route('customer.content.posts.index') }}">
                                    <section class="main-posts">
                                        <img src="{{ asset('customers-assets/images/main-content/posts/content.jpg') }}" alt="مقاله ها">
                                        <div class="aside-posts">
                                            <h1 class="d-block">مقاله ها</h1>
                                            <p>مقاله های کاربردی و جالب</p>
                                        </div>
                                    </section>
                                </a>
                                <a href="#">
                                    <section class="main-learning">
                                        <img src="{{ asset('customers-assets/images/main-content/learning/learning.jpg') }}" alt="آموزش ها">
                                        <div class="aside-learning">
                                            <h1 class="d-block">ویدیو های آموزشی</h1>
                                            <p>ویدیو های آنباکینگ و آموزش اسباب بازی ها</p>
                                        </div>
                                    </section>
                                </a>
                            </section>


    <section class="position-fixed p-4 flex-row-reverse" style="z-index: -1; right: 0; top: 3rem; width: 26rem; max-width: 80%;">
    
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <strong class="mr-auto">فروشگاه</strong>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
                <strong class="ml-auto">
                    خب کونی خان محترم .. الان میزنی علاقه مندی ها من اینو بزارمش تو کص بیبیت ؟؟
                    <br>
                    <a href="{{ route('auth.customer.register-form') }}" class="text-dark">
                        بزن رو این تا بدونم کدون کونی هستی
                    </a>
                </strong>             
             </div>
          </div>
          
    </section>

    @include('admin.alerts.sweetalert.success')



@endsection

@section('script')

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

@endsection
