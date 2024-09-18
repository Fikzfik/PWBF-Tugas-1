<ul class="nav">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ auth()->user()->id_jenis_user == 1 ? '/dashboardadmin' : '/dashboard' }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title ">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/addrole">
                    <i class="icon-grid-2 menu-icon"></i>
                    <span class="menu-title ">Add Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/addmenu">
                    <i class="icon-contract menu-icon"></i>
                    <span class="menu-title ">Add Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Add Something</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item "> <a class="nav-link" href="/addbook">Buku</a></li>
                        <li class="nav-item"> <a class="nav-link" href="/addkategori">Kategori</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</ul>
