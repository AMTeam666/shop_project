@extends('customers.layouts.master-one-col')

@section('head-tags')
    <title>اطلاعات حساب</title>
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
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.favorite') }}">لیست علاقه مندی</a></span>
                            </section>
                            <section class="sidebar-nav-item sidebar-nav-on">
                                <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.show') }}">اطلاعات حساب</a></span>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.my-tickets') }}">تیکت ها</a></span>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="#">خروج از حساب</a></span>
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
                                    <span>اطلاعات حساب</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        <section class="row">
                            <section class="col-6 border-bottom mb-2 py-2">
                                <section class="field-title">نام</section>
                                <section class="field-value overflow-auto">{{ auth()->user()->first_name }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">نام خانوادگی</section>
                                <section class="field-value overflow-auto">{{ auth()->user()->last_name }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">شماره تلفن همراه</section>
                                <section class="field-value overflow-auto">{{ auth()->user()->mobile }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">ایمیل</section>
                                <section class="field-value overflow-auto">{{ auth()->user()->email }}</section>
                            </section>

                            <section class="col-6 my-2 py-2">
                                <section class="field-title">کد ملی</section>
                                <section class="field-value overflow-auto">{{ auth()->user()->national_code }}</section>
                            </section>
                        </section>
                    </section>
                    <section class="d-flex justify-content-start my-4">
                        <a class="btn btn-link btn-sm text-decoration-none mx-1 edit-profile-info" type="button" data-bs-toggle="modal" data-bs-target="#edit-profile"><i class="fa fa-edit px-1"></i>ویرایش حساب</a>
                    </section>
                   
                    <section class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="edit-profile-label"
                    aria-hidden="true">
                    <section class="modal-dialog">
                        <section class="modal-content">
                            <section class="modal-header">
                                <h5 class="modal-title" id="edit-profile-label"><i class="fa fa-plus"></i> ویرایش
                                    حساب </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </section>
                            <section class="modal-body">
                                <form class="row" method="post"
                                    action="{{ route('customer.profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    <section class="col-6 mb-2">
                                        <label for="first_name" class="form-label mb-1">نام
                                            </label>
                                        <input value="{{ auth()->user()->first_name ?? auth()->user()->first_name }}"
                                            type="text" name="first_name" class="form-control form-control-sm"
                                            id="first_name" placeholder="نام">
                                    </section>

                                    <section class="col-6 mb-2">
                                        <label for="last_name" class="form-label mb-1">نام
                                            خانوادگی </label>
                                        <input value="{{ auth()->user()->last_name ?? auth()->user()->last_name }}"
                                            type="text" name="last_name" class="form-control form-control-sm"
                                            id="last_name" placeholder="نام خانوادگی ">
                                    </section>

                                    <section class="col-6 mb-2">
                                        <label for="national_code" class="form-label mb-1">کد ملی
                                        </label>
                                        <input value="{{ auth()->user()->national_code ?? auth()->user()->national_code }}"
                                            type="text" name="national_code" class="form-control form-control-sm"
                                            id="national_code" placeholder="کد ملی">
                                    </section>


                            </section>
                            <section class="modal-footer py-1">
                                <button type="submit" class="btn btn-sm btn-primary">ویرایش
                                    حساب</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-bs-dismiss="modal">بستن</button>
                            </section>
                            </form>

                        </section>
                    </section>
                </section>

                </main>
            </section>
        </section>
    </section>
    <!-- end body -->

@endsection