 <style>
  span.error-block {
    color: red;
}
 </style>
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      
      <span class="brand-text font-weight-light"> Data Management System</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('vendors/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->first_name.' '   .Auth::user()->last_name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('sales')|| Auth::user()->hasRole('user'))
          <li class="nav-item menu-open ">
            <a href="{{ url('/home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
        
          <li class="nav-item ">
            <a href="{{ url('/users') }}" class="nav-link {{ (request()->is('users')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management

              </p>
            </a>
          </li> 
          @endif
           @if(Auth::user()->hasRole('sales') || Auth::user()->hasRole('admin'))
          <li class="nav-item ">
            <a href="{{ url('/categories') }}" class="nav-link {{ (request()->is('categories')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category Management

              </p>
            </a>
          </li> 
          <li class="nav-item ">
            <a href="{{ url('/products') }}" class="nav-link {{ (request()->is('products')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-ship"></i>
              <p>
                Product Management

              </p>
            </a>
          </li> 
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>