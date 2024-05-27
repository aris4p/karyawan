 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->




        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('karyawan') }}">
                        <i class="bi bi-circle"></i><span>Daftar Karyawan</span>
                    </a>
                </li>
            </ul>
           
            <li class="menu-header small text-uppercase">
                <hr>
            </li>
            <a class="nav-link collapsed" data-bs-target="#components-akun" data-bs-toggle="collapse" href="#">
                <i class="menu-icon tf-icons bx bx-dock-top"></i></i><span>Akun Setting</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-akun" class="nav-content collapse " data-bs-parent="#sidebar-akun">
                <li>
                    <a href="{{ route('changepassword') }}">
                        <i class="bi bi-circle"></i><span>Ganti Password</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
        {{-- <a class="nav-link " href="{{ route('transaction') }}">
                <i class="bi bi-grid"></i>
                <span>Transaction</span>
            </a> --}}
        </li><!-- Transaction Nav -->

    </aside>
