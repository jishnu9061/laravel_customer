<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}"
                    class="nav-link {{ request()->is('user') || request()->is('user/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>{{ __('Customers') }}</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
