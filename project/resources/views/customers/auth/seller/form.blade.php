@extends('customers.layouts.master-simple')

@section('content')

<section class="vh-100 d-flex justify-content-center align-items-center pb-5">

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    @guest
                    <section class="row mt-4">
                        <div>
                            ابتدا در سایت حساب بسازید <a class="text-decoration-none" href="{{ route('auth.customer.register') }}">ثبت نام / ورود</a>
                        </div>
                    </section>
                    @endguest
                    @auth
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="bg-dark rounded text-white">
                                <span>ثبت نام فروشنده</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!--------- start triller Modal ------------>
                    <section class="modal fade" id="photo" tabindex="-1" aria-labelledby="photo-label" aria-hidden="true">
                        <section class="modal-dialog">
                            <section class="modal-content">
                                <section class="modal-header">
                                    <h5 class="modal-title" id="photo-label">روش گرفتن عکس تایید هویت</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </section>
                                <section class="modal-body">
                                    <div class="">
                                        <img src="{{ asset('images/verification-step1.jpg') }}" alt="verification-step1.jpg">
                                    </div>
                                </section>
                                <section class="modal-footer py-1 d-flex justify-content-between">
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                </section>
                            </section>
                        </section>
                    </section>
                    <!------------ end triller Modal ----------->
                    <section class="row mt-4">
                        <section class="">
                            <form id="profile_completion" action="{{ route('seller.confirm') }}" method="post" class="content-wrapper bg-white p-3 rounded-2 mb-4" enctype="multipart/form-data">
                                @csrf

                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <section>
                                        برای ورود به عنوان فروشنده باید عکس خود به همراه کارت ملی یا شناسنامه ارسال کنید
                                        <button class="btn btn-info btn-sm ml-3" type="button" data-bs-toggle="modal" data-bs-target="#photo">آموزش عکس تاییدیه</button>
                                    </section>
                                </section>

                                <section class="row pb-3">

                                    @if(empty($user->first_name))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="first_name">نام</label>
                                            <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                        </div>
                                        @error('first_name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>
                                    @endif


                                    @if(empty($user->last_name))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="last_name">نام خانوادگی</label>
                                            <input type="text" class="form-control form-control-sm" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                        </div>
                                        @error('last_name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>
                                    @endif


                                    @if(empty($user->national_code))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="national_code">کد ملی</label>
                                            <input type="text" class="form-control form-control-sm" name="national_code" id="national_code" value="{{ old('national_code') }}">
                                        </div>
                                        @error('national_code')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>
                                    @endif

                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="national_code">نام فروشگاه</label>
                                            <input type="text" class="form-control form-control-sm" name="store_name" id="store_name" value="{{ old('store_name') }}">
                                        </div>
                                        @error('store_name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="national_code">عکس تایید هویت</label>
                                            <input type="file" class="form-control form-control-sm" name="accepted_photo_path" id="accepted_photo_path" value="{{ old('accepted_photo_path') }}">
                                        </div>
                                        @error('accepted_photo_path')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>

                                </section>
                            </form>

                        </section>
                        <section class="">
                            <button type="button" onclick="document.getElementById('profile_completion').submit();" class="btn py-3 button-complete-profile-completion d-block w-100 ">تکمیل فرآیند ثبت نام</button>
                        </section>
                    </section>
                    @endauth
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->
</section>

@endsection
