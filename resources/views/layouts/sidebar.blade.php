<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{route('vendor-dashboard')}}">
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('vendor-order')}}">
        <span class="menu-title">Order</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('vendor-custom-order')}}">
        <span class="menu-title">Custom Order</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('product-index')}}">
        <span class="menu-title">Product</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('category.index')}}">
        <span class="menu-title">Product Category</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Custom Cake</span>
        <i class="icon-arrow-down menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{route('custom-size')}}">Size</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{route('custom-flavor')}}">Flavor</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('vendor/profile')}}">
        <span class="menu-title">Profile</span>
      </a>
    </li>
  
    <li class="nav-item pro-upgrade">
      <span class="nav-link">

     
        <a class="btn btn-block px-0 btn-rounded btn-upgrade" href="{{ route('vendor.logout') }}" target="_blank" onclick="event.preventDefault();
                                                     document.getElementById('logout-form-vendor').submit();"> LOG OUT</a>
       <form id="logout-form-vendor" action="{{ route('vendor.logout') }}" method="POST" class="d-none">
                                        @csrf
       </form>
      </span>
    </li>
  </ul>
</nav>


@php 

//dd(Auth::guard()->name);

@endphp