@extends('customers.layouts.master-one-col')

@section('head-tags')
<title>تیکت ها</title>
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
                        <section class="sidebar-nav-item">
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
                        <section class="sidebar-nav-item sidebar-nav-on">
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
                                <span>تیکت های من</span>
                            </h2>
                            <section class="content-header-link m-2">
                                <a href="{{ route('customer.profile.my-tickets.create') }}" class="btn btn-success text-white">ارسال تیکت جدید</a>
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->

                    <section class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نویسنده تیکت</th>
                                <th>عنوان تیکت</th>
                                <th>متن تیکت</th>
                                <th>دسته تیکت</th>
                                <th>اولویت تیکت</th>
                                <th>ارجاع شده از</th>
                                <th>وضعیت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $ticket->user->first_name . ' ' . $ticket->user->last_name }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ Str::limit($ticket->description, 30) }}</td>
                                <td>{{ $ticket->category->name }}</td>
                                <td>{{ $ticket->priority->name }}</td>
                                <td>{{ $ticket->admin->user->first_name . ' ' . $ticket->admin->user->last_name }}</td>
                                <td>{{ $ticket->status == 0 ? 'باز' : 'بسته شده'}}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('customer.profile.my-tickets.show', $ticket->id) }}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> مشاهده</a>
                                    <a href="{{ route('customer.profile.my-tickets.change', $ticket->id) }}" class="btn btn-outline-{{ $ticket->status == 0 ? 'warning' : 'success' }} {{ $ticket->status == 0 ? 'enabled' : 'disabled' }} btn-sm"><i class="fa fa-{{ $ticket->status == 0 ? 'lock' : 'key' }}"></i>
                                    {{ $ticket->status == 0 ? 'بستن' : 'باز کردن' }}
                                    </a>
    
                                </td>
                            </tr>
         
                            @endforeach
                            </tbody>
                        </table>
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
