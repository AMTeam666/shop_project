@extends('customers.layouts.master-one-col')

@section('head-tags')
<title>سفارشات شما</title>
@endsection

@section('content')
<!-- start body -->
<section class="">
    <section id="" class="container-xxl body-container main-profile-container">
        <section class="row bg-white p-0 main-profile-info">
            <aside id="sidebar" class="sidebar p-0">
                <section class="content-wrapper sidebar-profile-background mb-3">
                    <!-- start sidebar nav-->
                    <section class="sidebar-nav">
                        <section class="sidebar-nav-item sidebar-nav-on">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.orders') }}">سفارش های من</a></span>
                        </section>
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.address') }}">آدرس های من</a></span>
                        </section>
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.favorite') }}">لیست علاقه مندی</a></span>
                        </section>
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.show') }}">اطلاعات حساب</a></span>
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
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>سفارش های من</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->

                    {{-- btn-sm mx-1 w-100 --}}
                    <section class="d-flex justify-content-center my-4 status-tags">
                        @if ($type == null)
                        <a href="{{ route('customer.profile.orders', 'type=0') }}" id="unpayed" class="btn btn-info btn-sm mx-1 w-100 " style=" margin-top: 15px">
                            <label for="unpayed" class="">پرداخت نشده</label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=3') }}" id="payd" class="btn btn-warning btn-sm mx-1 w-100 " style=" margin-top: 15px">
                            <label for="payd" class="">تایید شده</label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=2') }}" id="payd" class="btn btn-success btn-sm mx-1 w-100 " style=" margin-top: 15px">
                            <label for="payd" class="">ارسال شده</label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=4') }}" id="cancled" class="btn btn-danger btn-sm mx-1 w-100" style=" margin-top: 15px">
                            <label for="cancled" class="">باطل شده </label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=5') }}" id="returned" class="btn btn-dark btn-sm mx-1 w-100 " style=" margin-top: 15px">
                            <label for="returned" class="">برگشت داده شده</label>
                        </a>
                        @else
                        <a href="{{ route('customer.profile.orders', 'type=0') }}" id="unpayed" class="btn btn-info btn-sm mx-1 w-100 " @if( $type==0 ) style="" @else style=" margin-top: 15px" @endif>
                            <label for="unpayed" class="">پرداخت نشده</label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=3') }}" id="payd" class="btn btn-warning btn-sm mx-1 w-100 " @if( $type==3 ) style="" @else style=" margin-top: 15px" @endif>
                            <label for="payd" class="">تایید شده</label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=2') }}" id="payd" class="btn btn-success btn-sm mx-1 w-100 " @if( $type==2 ) style="" @else style=" margin-top: 15px" @endif>
                            <label for="payd" class="">ارسال شده</label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=4') }}" id="cancled" class="btn btn-danger btn-sm mx-1 w-100" @if( $type==4 ) style="" @else style=" margin-top: 15px" @endif>
                            <label for="cancled" class="">باطل شده </label>
                        </a>
                        <a href="{{ route('customer.profile.orders', 'type=5') }}" id="returned" class="btn btn-dark btn-sm mx-1 w-100 " @if( $type==5 ) style="" @else style=" margin-top: 15px" @endif>
                            <label for="returned" class="">برگشت داده شده</label>
                        </a>
                        @endif
                    </section>


                    <section class="order-wrapper">
                        @forelse ($orders as $order)
                        <section class="order-item">
                            <section class="d-flex justify-content-between">
                                <section>
                                    <section class="order-item-date"><i class="fa fa-calendar-alt"></i>{{ jalaliDate($order->created_at) }}</section>
                                    <section class="order-item-id"><i class="fa fa-id-card-alt"></i>کد سفارش : {{ $order->id }}</section>
                                    <section class="order-item-status"><i class="fa fa-clock"></i>{{ $order->paymentStatusValue }}</section>
                                    <section class="order-item-products">
                                        @foreach($order->orderItems()->get() as $product)
                                        <a href="#"><img src="{{ asset($product->singleProduct->image['indexArray']['medium']) }}" alt=""></a>
                                        @endforeach
                                    </section>
                                </section>
                            </section>
                            <section class="button-edit-delete-address-container">
                                @if ($type == 0)
                                <button class="btn">پرداخت</button>
                                @elseif ($type == 2)
                                <button class="btn ">جزییات سفارش</button>
                                @elseif($type == 3)
                                <button class="btn">پیگیری سفارش</button>
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
                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->
@endsection

@section('script')

@endsection
