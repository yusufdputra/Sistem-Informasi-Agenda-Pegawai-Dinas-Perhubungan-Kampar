<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">

    <!-- User -->
    <div class="user-box">
      <div class="user-img">
        <img src="{{asset('adminto/images/users/avatar-1.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
        <div class="user-status online"><i class="mdi mdi-adjust"></i></div>
      </div>
      <h5><a href="#"> {{ Auth::user()->name }}</a> </h5>
      <ul class="list-inline">


        <li class="list-inline-item">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
    <!-- End User -->

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <ul>
        <li class="text-muted menu-title">Navigation</li>
        <li>
          <a href="{{('/')}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
        </li>
        @role('admin')
        <li>
          <a href="{{route ('pegawai.index')}}" class="waves-effect"><i class="mdi mdi-account-multiple"></i> <span> Data Pegawai </span> </a>
        </li>

        <li>
          <a href="{{route ('agenda.index')}}" class="waves-effect"><i class="mdi mdi-view-agenda"></i> <span> Agenda </span> </a>
        </li>
        <li>
          <a href="{{route ('bidang.index')}}" class="waves-effect"><i class="mdi mdi-cube"></i> <span> Bidang </span> </a>
        </li>

        @endrole

        @role("pegawai")

        <li>
          <a href="{{route ('agenda.index')}}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Agenda </span> </a>
        </li>

        @endrole





      </ul>
      <div class="clearfix"></div>
    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>

  </div>

</div>
<!-- Left Sidebar End -->



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">


    </div> <!-- container -->

  </div> <!-- content -->

  <footer class="footer text-right">
    2021 - Dinas Perhubungan Kampar Team
  </footer>

</div>