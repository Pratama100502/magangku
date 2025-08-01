<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo Kominfo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('asset_halaman_admin/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Aplikasi Magang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- panel user -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('asset_halaman_admin/adminlte/dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.admin.index') }}" class="nav-link" style="color: #f0f0f0;">
                        <i class="nav-icon fa-solid fa-gauge" style="color: #f0f0f0;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('calon.index') }}" class="nav-link" style="color: #f0f0f0;">
                        <i class="nav-icon fa-solid fa-file-invoice" style="color: #f0f0f0;"></i>
                        <p>Calon Peserta Magang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('peserta.index') }}" class="nav-link" style="color: #f0f0f0;">
                        <i class="nav-icon fa-solid fa-users" style="color: #f0f0f0;"></i>
                        <p>Data Peserta Magang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kalender.index') }}" class="nav-link" style="color: #f0f0f0;">
                        <i class="nav-icon fa-solid fa-calendar-days" style="color: #f0f0f0;"></i>
                        <p>Kalender Magang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dokumen.index') }}" class="nav-link" style="color: #f0f0f0;">
                        <i class="nav-icon fa-regular fa-file-pdf" style="color: #f0f0f0;"></i>
                        <p>Laporan Peserta Magang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mentor.index') }}" class="nav-link" style="color: #f0f0f0;">
                        <i class="nav-icon fa-solid fa-person-chalkboard" style="color: #f0f0f0;"></i>
                        <p>Manajemen Mentor</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
