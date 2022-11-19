<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <!-- <i class="fas fa-laugh-wink"></i> -->
    </div>
    <div class="sidebar-brand-text mx-3">Shopping Cart</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ url('admin/dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
      <i class="fas fa-fw fa-table"></i>
      <span>Products</span>
    </a>
    <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage Products:</h6>
        <a class="collapse-item {{ Request::is('admin/products') ? 'active' : '' }}" href="{{ url('admin/products') }}"> Products</a>
        <a class="collapse-item {{ Request::is('admin/products/create') ? 'active' : '' }}" href="{{ url('admin/products/create') }}">Add New</a>
      </div>
    </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <li class="nav-item active">
    <a class="nav-link" href="{{ url('admin/orders') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Orders</span></a>
  </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar