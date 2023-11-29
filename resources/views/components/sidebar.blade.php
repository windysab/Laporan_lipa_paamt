<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Laporan Bulan Perkara</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LBP</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>LIPA</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('perkara-lipa1.index') }}">Lipa 1</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('perkara.index') }}">User List</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>PERKARA MASUK</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('perkara-masuk.index') }}">HSU</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('perkara-masuk-blg.index') }}">BALANGAN</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Perkara Gaib</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('perkara-gaib.index') }}">Perkara Gaib</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Perkara PNS</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('perkara-pns.index') }}">Perkara PNS</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Perkara Ecourt</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('perkara-ecourt.index') }}">Perkara Ecourt</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Perkara Dispensasi</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('perkara-diska.index') }}">Perkara Dispensasi</a>
                    </li>


                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Semuanya</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('jadwal-sidang.index') }}">Jadwal Sidang</a>
                    </li>

                </ul>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('dirput.index') }}">Direkturi Putusan</a>
                    </li>

                </ul>
            </li>


    </aside>
</div>
