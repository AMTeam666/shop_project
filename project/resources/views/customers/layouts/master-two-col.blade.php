<!DOCTYPE html>
<html lang="en">
<head>
    @include('customers.layouts.head-tag')
    @yield('head-tag')
</head>
<body>

    @include('customer.layouts.header')

    <section class="container-xxl body-container">
        @yield('customers.layouts.sidebar')
    </section>

    <main id="main-body-one-col" class="main-body">

    @yield('content')

    </main>


    @include('customers.layouts.footer')



    @include('customer.layouts.script')
    @yield('script')
</body>
</html>
