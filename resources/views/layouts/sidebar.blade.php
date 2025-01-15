<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
        <img src="{{ asset('assets/img/logo/logo2.png') }}" alt="Logo">
    </div>
    <div class="sidebar-brand-text mx-3">KasirKu</div>
</a>

    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Features Heading -->
    <div class="sidebar-heading">User</div>

    <li class="nav-item">
        <a class="nav-link text-dark" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users text-dark"></i>
            <span>Users</span>
        </a>
    </li>
       <!-- Divider -->
       <hr class="sidebar-divider">

    <div class="sidebar-heading">Pembelian</div>

    <li class="nav-item">
        <a class="nav-link text-dark" href="{{ route('users.index') }}">
            <i class="fas fa-store text-dark"></i>
            <span>Pembelian</span>
        </a>
    </li>

       <!-- Divider -->
       <hr class="sidebar-divider">
    <div class="sidebar-heading">Penjualan</div>

    <li class="nav-item">
        <a class="nav-link text-dark" href="{{ route('users.index') }}">
            <i class="fas fa-shopping-cart text-dark"></i>
            <span>Penjualan</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Stok</div>

    <li class="nav-item">
        <a class="nav-link text-dark" href="{{ route('users.index') }}">
            <i class="fas fa-box text-dark"></i>
            <span>Stok Barang</span>
        </a>
    </li>

  

   
   

    

    <!-- Divider -->
    <hr class="sidebar-divider">
   

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Version -->
    <div class="version" id="version-ruangadmin"></div>
</ul>
<!-- Sidebar -->
