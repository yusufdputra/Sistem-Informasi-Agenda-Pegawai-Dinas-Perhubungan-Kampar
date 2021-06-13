<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{'/'}}" class="logo"><img src="{{asset('adminto/images/brand/kampar.png')}}" width="30px" alt=""><span>SI- <span>AH</span></span><i class="mdi mdi-layers"></i></a>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">

            <!-- Page title -->
            <ul class="nav navbar-nav list-inline navbar-left">
                <li class="list-inline-item">
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
                <li class="list-inline-item">
                    <h4 class="page-title">{{$title}}</h4>
                </li>
            </ul>

            @role('pegawai')
            <nav class="navbar-custom">

                <ul class="list-unstyled topbar-right-menu float-right mb-0">

                    <li>
                        <!-- Notification -->
                        <div class="notification-box">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a href="javascript:void(0);" class="right-bar-toggle">
                                        <i class="mdi mdi-bell-outline noti-icon"></i>
                                    </a>
                                    <div class="noti-dot">
                                        <span class="dot"></span>
                                        <span class="pulse"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Notification bar -->
                    </li>


                </ul>
            </nav>

            @endrole

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
<!-- Top Bar End -->