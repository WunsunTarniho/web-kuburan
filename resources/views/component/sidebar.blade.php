<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <i class="bi bi-4-circle-fill fs-2"></i>
        </div>
        <div class="sidebar-brand-text mx-3">....</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span></a>
    </li>

    @can('admin')
        <li class="nav-item active">
            <a class="nav-link" href="/user/create">
                <i class="bi bi-person-add"></i>
                <span>Register</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="/user">
                <i class="bi bi-person-fill"></i>
                <span>Users</span></a>
        </li>
    @endcan

    @can('admin-petugas')
        <li class="nav-item active">
            <a class="nav-link" href="/grave/create">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah Makam</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="/trash">
                <i class="bi bi-trash"></i>
                <span>Data yang dihapus</span></a>
        </li>
    @endcan

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
