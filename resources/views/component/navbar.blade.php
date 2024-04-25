<nav class="sticky-top d-flex align-items-center navbar-expand bg-white topbar mb-4 z-0 shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none ml-3 rounded p-0">
        <i class="bi bi-list"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="d-flex">
            <input type="text" class="form-control bg-light border-0 small w-100" name="search" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto position-relative z-0">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item d-md-none d-block">
            <a class="d-flex align-items-center nav-link" type="button" data-toggle="modal"
                data-target="#searchbar">
                <i class="bi bi-search"></i>
            </a>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="/profile.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="bi bi-box-arrow-right mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<div class="modal fade" id="searchbar" tabindex="0" aria-labelledby="searchbarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body d-flex align-items-center gap-2">
                <form id="navbarSearch" class="mx-auto w-100">
                    <input class="d-inline bg-white form-control border-primary px-3 text-dark"
                        style="border-radius: 50px !important;" type="text" name="search"
                        placeholder="Cari..." aria-label="Search">
                </form>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
    </div>
</div>