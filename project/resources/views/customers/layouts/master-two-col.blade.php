<!DOCTYPE html>
<html lang="en">
<head>
    @include('customers.layouts.head-tags')
    @yield('head-tags')
</head>
<body>

    @include('customers.layouts.header')

    <section class="container-xxl body-container">
        @yield('customers.layouts.sidebar')
    </section>

    <main id="main-body-one-col" class="main-body">

    @yield('content')

    </main>


    @include('customers.layouts.footer')

    @include('admin.alerts.sweetalert.success')


    @include('customers.layouts.script')
    @yield('script')



    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.error')
</body>
</html>
