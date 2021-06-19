<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ url('dashboard')}}">
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/customer-list')}}">
        <span class="menu-title">Customer</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('/vendor-list')}}">
        <span class="menu-title">Vendor</span>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="{{url('/profile')}}">
        <span class="menu-title">Profile</span>
      </a>
    </li> -->
  
    <li class="nav-item pro-upgrade">
    <span class="nav-link">
        <a class="btn btn-block px-0 btn-rounded btn-upgrade" href="{{ route('logout') }}" target="_blank" onclick="event.preventDefault();
                                                     document.getElementById('logout-form-admin').submit();"> LOG OUT</a>
       <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
       </form>
    </span>
    </li>
  </ul>
</nav>