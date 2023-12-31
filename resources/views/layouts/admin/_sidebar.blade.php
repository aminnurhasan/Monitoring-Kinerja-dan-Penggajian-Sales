<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://avatars.dicebear.com/api/bottts/example.svg?options%5Bcolors%5D%5B%5D=cyan"
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <li class="nav-item ">
                <a href="{{ url('/home') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            {{-- <div class="sidebar-heading ml-2 mb-2" style="color: #f0f0f0; font-size: 14pt">
                Kelola Data
            </div> --}}

            <li class="nav-item">
                <a href="{{ url('/admin/user') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>User</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/admin/toko') }}" class="nav-link">
                    <i class="nav-icon fas fa-store"></i>
                    <p>Toko</p>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="{{ url('/toko') }}" class="nav-link {{ request()->is('toko', 'toko/create', 'toko/$toko->id', 'toko/edit') ? 'active':'' }}">
                    <i class="nav-icon fas fa-store"></i>
                    <p>Toko</p>
                </a>
            </li> --}}

            <li class="nav-item">
                <a href="{{ url('/admin/transaksi') }}" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Transaksi</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/admin/gaji') }}" class="nav-link">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>Gaji</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/admin/kinerja') }}" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>Kinerja Sales</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
