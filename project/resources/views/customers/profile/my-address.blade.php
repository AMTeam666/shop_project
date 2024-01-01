@extends('customers.layouts.master-one-col')

@section('head-tags')
    <title>آدرس های من </title>
@endsection

@section('content')
    
 <!-- start body -->
 <section class="">
    <section id="main-body-two-col" class="container-xxl body-container main-profile-container">
        <section class="row bg-white p-0 main-profile-info">
            
            <aside id="sidebar" class="sidebar p-0">
                <section class="content-wrapper sidebar-profile-background mb-3">
                    <!-- start sidebar nav-->
                    <section class="sidebar-nav">
                        <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.orders') }}">سفارش های من</a></span>
                        </section>
                        <section class="sidebar-nav-item sidebar-nav-on">
                            <span class="sidebar-nav-item-title"><a class="p-3 text-center" href="{{ route('customer.profile.address') }}">آدرس های من</a></span>
                        </section>
                        <section class="sidebar-nav-item">
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
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                    <!-- start vontent header -->
                    <section class="content-header mb-4">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>آدرس های من</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->



                    <section class="my-addresses">
                      @forelse ( auth()->user()->addresses as $address )
                      <section class="my-address-wrapper mb-2 p-2">
                        <section class="mb-2">
                            <i class="fa fa-map-marker-alt mx-1"></i>
                            آدرس  : شهر    {{ $address->city->name }} {{ $address->address }}
                        </section>
                        <section class="mb-2">
                            <i class="fa fa-user-tag mx-1"></i>
                            گیرنده :  {{ $address->recipient_first_name . $address->recipient_last_name ?? '-' }}
                        </section>
                        <section class="mb-2">
                            <i class="fa fa-mobile-alt mx-1"></i>
                            موبایل گیرنده : {{ $address->mobile ?? '-' }}
                        </section>
                        <section class="button-edit-delete-address-container">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#edit-address-{{ $address->id }}">ویرایش آدرس</button>
                            <a class="btn" href="{{ route('customer.profile.address.delete', $address) }}">حذف آدرس</a>
                        </section>
                    </section>
            <!-- start edit address Modal -->
            <section class="modal fade" id="edit-address-{{ $address->id }}" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                <section class="modal-dialog">
                    <section class="modal-content">
                        <section class="modal-header">
                            <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ویرایش آدرس </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </section>
                        <section class="modal-body">
                            <form class="row" method="post" action="{{ route('customer.sales-process.update-address', $address->id) }}">
                                @method('patch')
                                @csrf
                                <section class="col-6 mb-2">
                                    <label for="province" class="form-label mb-1">استان</label>
                                    <select name="province_id" class="form-select form-select-sm" id="province-{{ $address->id }}">
                                        @foreach ($provinces as $province)
                                        <option {{ $address->province_id == $province->id ? 'selected' : '' }} value="{{ $province->id }}" data-url="{{ route('customer.sales-process.get-cities', $province->id) }}">
                                            {{ $province->name }}</option>
                                        @endforeach

                                    </select>
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="city" class="form-label mb-1">شهر</label>
                                    <select name="city_id" class="form-select form-select-sm" id="city-{{ $address->id }}">
                                        <option selected>شهر را انتخاب کنید</option>
                                    </select>
                                </section>
                                <section class="col-12 mb-2">
                                    <label for="address" class="form-label mb-1">نشانی</label>
                                    <textarea name="address" class="form-control form-control-sm" id="address" placeholder="نشانی">{{ $address->address }}</textarea>
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="postal_code" class="form-label mb-1">کد
                                        پستی</label>
                                    <input value="{{ $address->postal_code }}" type="text" name="postal_code" class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                </section>

                                <section class="col-3 mb-2">
                                    <label for="no" class="form-label mb-1">پلاک</label>
                                    <input type="text" value="{{ $address->no }}" name="no" class="form-control form-control-sm" id="no" placeholder="پلاک">
                                </section>

                                <section class="col-3 mb-2">
                                    <label for="unit" class="form-label mb-1">واحد</label>
                                    <input type="text" value="{{ $address->unit }}" name="unit" class="form-control form-control-sm" id="unit" placeholder="واحد">
                                </section>

                                <section class="border-bottom mt-2 mb-3"></section>

                                <section class="col-12 mb-2">
                                    <section class="form-check">
                                        <input {{ $address->recipient_first_name ? 'checked' : '' }} class="form-check-input" name="receiver" type="checkbox" id="receiver">
                                        <label class="form-check-label" for="receiver">
                                            گیرنده سفارش خودم نیستم (اطلاعات زیر تکمیل شود)
                                        </label>
                                    </section>
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="first_name" class="form-label mb-1">نام
                                        گیرنده</label>
                                    <input value="{{ $address->recipient_first_name ?? $address->recipient_first_name }}" type="text" name="recipient_first_name" class="form-control form-control-sm" id="first_name" placeholder="نام گیرنده">
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="last_name" class="form-label mb-1">نام
                                        خانوادگی گیرنده</label>
                                    <input value="{{ $address->recipient_last_name ?? $address->recipient_last_name }}" type="text" name="recipient_last_name" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی گیرنده">
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="mobile" class="form-label mb-1">شماره
                                        موبایل</label>
                                    <input value="{{ $address->mobile ?? $address->mobile }}" type="text" name="mobile" class="form-control form-control-sm" id="mobile" placeholder="شماره موبایل">
                                </section>


                        </section>
                        <section class="modal-footer py-1">
                            <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                        </section>
                        </form>

                    </section>
                </section>
            </section>
        <!-- end edit address Modal -->
                      @empty
                      <section class="order-item">
                        <section class="d-flex justify-content-between">
                            <p>ادسی ثبت نشده است</p>
                        </section>
                    </section>
                      @endforelse
                     

                        <section class="address-add-wrapper">
                            <button class="address-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-address" ><i class="fa fa-plus"></i> ایجاد آدرس جدید</button>
                          <!-- start add address Modal -->
                         <section class="modal fade" id="add-address" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                            <section class="modal-dialog">
                                <section class="modal-content">
                                    <section class="modal-header">
                                        <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </section>
                                    <section class="modal-body">
                                        <form class="row" method="post" action="{{ route('customers.sales-process.add-address') }}">
                                            @csrf
                                            <section class="col-6 mb-2">
                                                <label for="province" class="form-label mb-1">استان</label>
                                                <select name="province_id" class="form-select form-select-sm" id="province">
                                                    <option selected>استان را انتخاب کنید</option>
                                                    @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}" data-url="{{ route('customer.sales-process.get-cities', $province->id) }}">
                                                        {{ $province->name }}</option>
                                                    @endforeach

                                                </select>
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="city" class="form-label mb-1">شهر</label>
                                                <select name="city_id" class="form-select form-select-sm" id="city">
                                                    <option selected>شهر را انتخاب کنید</option>
                                                </select>
                                            </section>
                                            <section class="col-12 mb-2">
                                                <label for="address" class="form-label mb-1">نشانی</label>
                                                <textarea name="address" class="form-control form-control-sm" id="address" placeholder="نشانی"></textarea>
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="postal_code" class="form-label mb-1">کد
                                                    پستی</label>
                                                <input type="text" name="postal_code" class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                            </section>

                                            <section class="col-3 mb-2">
                                                <label for="no" class="form-label mb-1">پلاک</label>
                                                <input type="text" name="no" class="form-control form-control-sm" id="no" placeholder="پلاک">
                                            </section>

                                            <section class="col-3 mb-2">
                                                <label for="unit" class="form-label mb-1">واحد</label>
                                                <input type="text" name="unit" class="form-control form-control-sm" id="unit" placeholder="واحد">
                                            </section>

                                            <section class="border-bottom mt-2 mb-3"></section>

                                            <section class="col-12 mb-2">
                                                <section class="form-check">
                                                    <input class="form-check-input" name="receiver" type="checkbox" id="receiver">
                                                    <label class="form-check-label" for="receiver">
                                                        گیرنده سفارش خودم نیستم (اطلاعات زیر تکمیل شود)
                                                    </label>
                                                </section>
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="first_name" class="form-label mb-1">نام
                                                    گیرنده</label>
                                                <input type="text" name="recipient_first_name" class="form-control form-control-sm" id="first_name" placeholder="نام گیرنده">
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="last_name" class="form-label mb-1">نام
                                                    خانوادگی گیرنده</label>
                                                <input type="text" name="recipient_last_name" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی گیرنده">
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="mobile" class="form-label mb-1">شماره
                                                    موبایل</label>
                                                <input type="text" name="mobile" class="form-control form-control-sm" id="mobile" placeholder="شماره موبایل">
                                            </section>


                                    </section>
                                    <section class="modal-footer py-1">
                                        <button type="submit" class="btn btn-sm btn-primary">ثبت
                                            آدرس</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                    </section>
                                    </form>

                                </section>
                            </section>
                        </section>
                        <!-- end add address Modal -->
                        </section>

                    </section>


                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#province').change(function() {
            var element = $('#province option:selected');
            var url = element.attr('data-url');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        let cities = response.cities;
                        $('#city').empty();
                        cities.map((city) => {
                            $('#city').append($('<option/>').val(city.id).text(city
                                .name))
                        })
                    } else {
                        errorToast('خطا پیش آمده است')
                    }
                },
                error: function() {
                    errorToast('خطا پیش آمده است')
                }
            })
        })


        // edit
        var addresses = {!! auth()->user()->addresses !!}
        // console.log(addresses);
        addresses.map(function(address) {
            var id = address.id;
            var target = `#province-${id}`;
            var selected = `${target} option:selected`
        $(target).change(function() {
            var element = $(selected);
            var url = element.attr('data-url');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        let cities = response.cities;
                        $(`#city-${id}`).empty();
                        cities.map((city) => {
                            $(`#city-${id}`).append($('<option/>').val(city.id).text(city
                                .name))
                        })
                    } else {
                        errorToast('خطا پیش آمده است')
                    }
                },
                error: function() {
                    errorToast('خطا پیش آمده است')
                }
            })
        })
    })

    })
</script>
@endsection