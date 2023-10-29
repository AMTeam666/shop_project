@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد کاربر ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد کاربر ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.admin-user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام</label>
                                <input  name="first_name" type="text" class="form-control form-control-sm" value="{{ old('first_name') }}">
                            </div>
                            @error('first_name')
                            <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">نام خانوادگی</label>
                                <input name="last_name" type="text" class="form-control form-control-sm" value="{{ old('last_name') }}">
                            </div>
                            @error('last_name')
                            <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">ایمیل</label>
                                <input  name="email" type="text" class="form-control form-control-sm value="{{ old('email') }}"">
                            </div>
                            @error('email')
                            <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert" >
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                     <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for=""> شماره موبایل</label>
                                <input name="mobile" type="text" class="form-control form-control-sm value="{{ old('mobile') }}"">
                            </div>
                         @error('mobile')
                         <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                         @enderror
                        </section>

                     <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">کلمه عبور</label>
                                <input name="password" type="password" class="form-control form-control-sm value="{{ old('password') }}"">
                            </div>
                         @error('password')
                         <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                         @enderror
                        </section>

                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تکرار کلمه عبور</label>
                                <input name="password_confirmation" type="text" class="form-control form-control-sm">
                            </div>
                        @error('password_confirmation')
                        <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                        @enderror
                        </section>

                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر</label>
                                <input name="profile_photo_path" type="file" class="form-control form-control-sm">
                            </div>
                        @error('profile_photo_path')
                        <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="activation">وضعیت فعال سازی </label>
                                <select name="activation" id="activation" class="form-control form-control-sm">
                                    <option value="0" @if(old('activation') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('activation') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('activation')
                            <span class="alert_required bg-danger text-white p-1 rounded my-2" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
