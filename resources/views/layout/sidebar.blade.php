<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach($menususer as $menu)
            <li class="nav-item">
                <a class="nav-link" 
                   href="{{ $menu->menu_link ?? '#' }}" 
                   @if($submenus->where('parent_id', $menu->menu_id)->count() > 0) 
                        aria-expanded="true" 
                   @endif>
                    <i class="{{ $menu->menu_icon }} menu-icon"></i>
                    <span class="menu-title">{{ $menu->menu_name }}</span>
                    @if($submenus->where('parent_id', $menu->menu_id)->count() > 0)
                        <i class="menu-arrow"></i>
                    @endif
                </a>

                <!-- Menampilkan Submenu jika ada -->
                @if($submenus->where('parent_id', $menu->menu_id)->count() > 0)
                    <div class="collapse show" id="menu-{{ $menu->menu_id }}">
                        <ul class="nav flex-column sub-menu">
                            @foreach($submenus->where('parent_id', $menu->menu_id) as $submenu)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $submenu->menu_link }}">
                                        {{ $submenu->menu_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
