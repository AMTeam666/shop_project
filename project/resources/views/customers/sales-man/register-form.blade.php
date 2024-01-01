@extends('customers.layouts.master-one-col')

@section('head-tags')
    <title>ویرایش اطلاعات حساب</title>
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
                                <span>ویرایش اطلاعات حساب کاربری</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="">
                            @auth
                            <form id="profile_completion" action="{{ route('customer.profile.update') }}" method="post" class="content-wrapper bg-white p-3 rounded-2 mb-4" enctype="multipart/form-data">
                                @csrf
                                <section class="row pb-3">

                                
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="first_name">نام</label>
                                            <input type="text" class="form-control form-control-sm" @if(auth()->check()) disabled @endif name="first_name" id="first_name" placeholder="{{ auth()->user()->first_name }}" value="{{ old('first_name') }}">
                                        </div>
                                        @error('first_name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>
                                


                                    
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="last_name">نام خانوادگی</label>
                                            <input type="text" class="form-control form-control-sm" @if(auth()->check()) disabled @endif name="last_name" id="last_name" placeholder="{{ auth()->user()->last_name }}" value="{{ old('last_name') }}">
                                        </div>
                                        @error('last_name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>
                            


                                    @if(auth()->user()->mobile != null)
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="mobile">موبایل</label>
                                            <input type="text" class="form-control form-control-sm" @if(auth()->check()) disabled @endif name="mobile" id="mobile" placeholder="{{ auth()->user()->mobile }}" value="{{ old('mobile') }}">
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
                                 
                                    @if(auth()->user()->email != null)
                                    <section class="col-12 col-md-6 my-2 ">
                                        <div class="form-group">
                                            <label for="email">ایمیل (اختیاری)</label>
                                            <input type="text" class="form-control form-control-sm" name="email" id="email" placeholder="{{ auth()->user()->email }}" value="{{ old('email') }}">
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

                                    @if(auth()->user()->national_code != null)
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group">
                                            <label for="national_code">کد ملی</label>
                                            <input type="text" class="form-control form-control-sm" @if(auth()->check() ) disabled @endif name="national_code" id="national_code" placeholder="{{ auth()->user()->national_code }}" value="{{ old('national_code') }}">
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
                                            <label for="national_code">شماره حساب</label>
                                            <input type="number" class="form-control form-control-sm"  name="card_code" id="card_code" placeholder="شماره حساب بانکی" value="{{ old('card_code') }}">
                                        </div>
                                        @error('card_code')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>

                                    <section class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">تصویر تایید هویتی </label>
                                            <input type="file" name="accepted_photo_path" class="form-control form-control-sm">
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
                            <button type="button" onclick="document.getElementById('profile_completion').submit();" class="btn py-3 button-complete-profile-completion d-block w-100 ">ویرایش</button>
                        </section>
                        
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->
@endsection