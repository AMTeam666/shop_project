@extends('customers.layouts.master-two-col')

@section('head-tag')
    <title>تکمیل اطلاعات حساب کاربری</title>
@endsection

@section('content')
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تکمیل اطلاعات حساب کاربری</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="">
                            <form id="profile_completion" action="{{ route('customers.sales-process.profile-completion-update') }}" method="post" class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                @csrf

                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <section>
                                        اطلاعات حساب کاربری خود را (فقط یک بار، برای همیشه) وارد کنید. از این پس کالاها برای شخصی با این مشخصات ارسال می شود.
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


                                    @if(empty($user->mobile))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="mobile">موبایل</label>
                                            <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" value="{{ old('mobile') }}">
                                        </div>
                                        @error('mobile')
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

                                    @if(empty($user->email))
                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="email">ایمیل (اختیاری)</label>
                                                <input type="text" class="form-control form-control-sm" name="email" id="email" value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                            @enderror
                                        </section>
                                    @endif



                                </section>
                            </form>

                        </section>
                        <section class="">
                            <button type="button" onclick="document.getElementById('profile_completion').submit();" class="btn py-3 button-complete-profile-completion d-block w-100 ">تکمیل فرآیند خرید</button>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

@endsection




