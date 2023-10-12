@include('admin.layouts.header')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->


            @include('admin/layouts.sidebar')
            @include('admin/layouts.navbar')

            @yield('content')

            @include('admin/layouts.footer')
</body>
