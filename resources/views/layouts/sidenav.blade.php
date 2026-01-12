<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item nav-profile">
          <a href="#" class="nav-link">
            <div class="nav-profile-image">
              <img src="/assets/images/faces/face-profile.png" alt="profile" />
              <span class="login-status online"></span>
              <!--change to offline or busy as needed-->
            </div>
            <div class="nav-profile-text d-flex flex-column">
              <span class="font-weight-bold mb-2">{{$user->name}}</span>
              <span class="text-secondary text-small">{{$user->phone}}</span>
            </div>
            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
          </a>
        </li>
        @if ($user_role == 0 || $user_role == 1)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/booking_dashboard')}}">
            <span class="menu-title">Dashboard</span>
            <i class="fa fa-dashboard menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0 || $user_role == 1 || $user_role == 2)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin_bookings')}}">
            <span class="menu-title">Bookings</span>
            <i class="fa leading-none fa-book menu-icon"></i>
          </a>
        </li>
        @endif
        {{-- @if ($user_role == 0 || $user_role == 1 || $user_role == 2)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/parcel_dashboard')}}">
            <span class="menu-title">Parcel Dashboard</span>
            <i class="fa leading-none fa-book menu-icon"></i>
          </a>
        </li>
        @endif --}}
        @if ($user_role == 0 || $user_role == 1 || $user_role == 2)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/parcels')}}">
            <span class="menu-title">Parcels</span>
            <i class="fa leading-none fa-inbox menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0 || $user_role == 1 || $user_role == 2)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/hires')}}">
            <span class="menu-title">Bus Hiring</span>
            <i class="fa leading-none fa-money-bill menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/team_members')}}">
            <span class="menu-title">Team</span>
            <i class="fa leading-none fa-group menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0 || $user_role == 1)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/customers')}}">
            <span class="menu-title">Customers</span>
            <i class="fa leading-none fa-user menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0 || $user_role == 1 || $user_role == 2)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/locations')}}">
            <span class="menu-title">Locations</span>
            <i class="fa leading-none fa-globe menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0 || $user_role == 1)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/buses')}}">
            <span class="menu-title">Buses</span>
            <i class="fa leading-none fa-solid fa-bus menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0 || $user_role == 1)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/drivers')}}">
            <span class="menu-title">Drivers</span>
            <i class="fa leading-none fa-drivers-license-o menu-icon"></i>
          </a>
        </li>
        @endif
        @if ($user_role == 0 || $user_role == 1 || $user_role == 2)
        <li class="nav-item">
          <a class="nav-link" href="{{url('/trips')}}">
            <span class="menu-title">Trips</span>
            <i class="fa leading-none fa-road menu-icon"></i>
          </a>
        </li>
        @endif
      </ul>
    </nav>