@include('service_provider.layouts.header')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->


            @include('service_provider/layouts.sidebar')
            @include('service_provider/layouts.navbar')

            @yield('content')

            @include('service_provider/layouts.footer')
</body>
