<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('users-management.index') }}" class="nav-link {{ Request::routeIs('users-management.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Users Management</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('organization.index') }}" class="nav-link {{ Request::routeIs('organization.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>Organization</p>
    </a>
</li>
