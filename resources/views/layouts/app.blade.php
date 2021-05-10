@include('layouts.header')
<!-- Begin page -->

@include('layouts.topbar')

@include('layouts.sidebar')



<div class="content-page">
    <!-- Start content -->
    <div class="container-fluid">
        @yield('content')
    </div>
</div>
@include('layouts.footer')