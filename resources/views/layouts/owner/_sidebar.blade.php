<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/owner/user') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Admin</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/owner/master') }}" class="nav-link">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>Master Gaji</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/kinerja') }}" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>Kinerja Admin</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
