<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($menususer as $menu)
            <li class="nav-item">
                @if ($submenus->where('parent_id', $menu->menu_id)->count() > 0)
                    <!-- Menu dengan sub-menu -->
                    <a class="nav-link" href="#menu-{{ $menu->menu_id }}" 
                       data-bs-toggle="collapse" 
                       aria-expanded="false" 
                       aria-controls="menu-{{ $menu->menu_id }}">
                        <i class="{{ $menu->menu_icon }} menu-icon"></i>
                        <span class="menu-title">{{ $menu->menu_name }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="menu-{{ $menu->menu_id }}">
                        <ul class="nav flex-column sub-menu">
                            @foreach ($submenus->where('parent_id', $menu->menu_id) as $submenu)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $submenu->menu_link }}">
                                        {{ $submenu->menu_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <!-- Menu tanpa sub-menu -->
                    <a class="nav-link" href="{{ $menu->menu_link }}">
                        <i class="{{ $menu->menu_icon }} menu-icon"></i>
                        <span class="menu-title">{{ $menu->menu_name }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
