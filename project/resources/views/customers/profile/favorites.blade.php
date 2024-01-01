@extends('customers.layouts.master-one-col')

@section('head-tags')
<title>علاقه مندی ها </title>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- start body -->
<section class="">
    <section id="main-body-two-col" class="container-xxl body-container main-profile-container">
        <section class="row bg-white p-0 main-profile-info">
            <aside id="sidebar" class="sidebar p-0">


                <section class="sidebar-profile-background content-wrapper mb-3">
                    <!-- start sidebar nav-->
                    <section class="sidebar-nav">
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.orders') }}">سفارش های من</a></span>
                        </section>
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.address') }}">آدرس های من</a></span>
                        </section>
                        <section class="sidebar-nav-item sidebar-nav-on">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.favorite') }}">لیست علاقه مندی</a></span>
                        </section>
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.show') }}">ویرایش حساب</a></span>
                        </section>
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.my-tickets') }}">تیکت ها</a></span>
                        </section>
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="#">خروج از حساب کاربری</a></span>
                        </section>

                    </section>
                    <!--end sidebar nav-->
                </section>

            </aside>
            <main id="main-body" class="main-body mt-0 p-4">
                <section class="content-wrapper bg-white p-3 mb-2">

                    <!-- start vontent header -->
                    <section class="content-header mb-4">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>لیست علاقه های من</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->

                    @forelse(auth()->user()->products as $product)
                    
                    <section class="cart-item d-md-flex py-3">
                        <section class="cart-img cart-img-box align-self-start flex-shrink-1"><img src="{{ asset($product->image['indexArray']['medium']) }}" alt=""></section>
                        <section class="cart-info-box align-self-start">
                            <p class="fw-bold product-cart-title">کتاب اثر مرکب نوشته دارن هاردی</p>
                            <p class="product-cart-info"><i class="fa fa-store-alt cart-product-selected-warranty me-1"></i> <span> فروشنده : ای پی تویز </span></p>
                            <p class="product-cart-info"><i class="fas fa-city cart-product-selected-warranty me-1 "></i> <span>شهر : مشهد </span></p>
                            <p class="product-cart-info"><i class="fa fa-shopping-basket cart-product-selected-store me-1 "></i> <span>@if($product->marketable_number > 0)کالا موجود در انبار @else کالا ناموجود @endif</span></p>
                            <section class="button-add-remove-favorite-container">
                                <form action="{{ route('customers.sales-process.add-to-cart', $product) }}" method="post">
                                    @csrf
                                <button type="submit" class="btn">اضافه به سبد خرید</button>
                            </form>
                                <a class="btn" href="{{ route('customer.profile.favorite.delete', $product) }}">حذف از علاقه مندی ها</a>
                            </section>
                        </section>
                        <section class="cart-prices align-self-center flex-shrink-1">
                            @if(!empty($product->activeAmazingSale()))
                            <section class="text-muted old-price-text text-nowrap mb-1 text-center"> {{ priceFormat($product->price ) }} تومان</section>
                            <section class="cart-item-discount text-danger text-nowrap mb-1 text-center"> {{ priceFormat($product->price * ($product->activeAmazingSale()->percentage / 100)) }} تخفیف</section>
                            <section class="text-nowrap fw-bold">{{ priceFormat($product->price - ($product->price * ($product->activeAmazingSale()->percentage / 100))) }} تومان</section>
                            @else
                            <section class="text-nowrap fw-bold text-center">{{ priceFormat($product->price) }} تومان</section>
                            @endif
                        </section>
                    </section>
                    @empty
                    <section class="order-item">
                        <section class="d-flex justify-content-between">
                            <p>سفارشی یافت نشد</p>
                        </section>
                    </section>
                    @endforelse
                </section>
                <section class="button-add-all-favorite-container">
                 
                    <a class="btn add-all-to-cart" href="{{ route('customers.sales-process.add-all-to-cart') }}">اضافه تمامی علاقه مندی ها به سبد خرید</a>
                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->


@endsection
