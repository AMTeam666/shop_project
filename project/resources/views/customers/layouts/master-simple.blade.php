<!DOCTYPE html>
<html lang="en">
<head>
 
    @include('customers.layouts.head-tags')
    @yield('head-tag')

</head>
<body>


    <main id="main-body-one-col" class="main-body">


    @yield('content')

    </main>


    @include('customers.layouts.script')
    @yield('script')
    
</body>


</html>