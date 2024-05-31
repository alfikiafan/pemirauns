<!-- Sidebar -->
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white mt-6"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src="../assets/img/kpu-uns.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Pemira Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (Auth::check() && Auth::user()->hasRole('superadmin'))
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.dashboard') ? 'active' : '') }}"
                    href="{{ route('admin.dashboard') }}">
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.manage_admin_univ') ? 'active' : '') }} "
                    href="{{ route('admin.manage_admin_univ') }}">
                    <span class="nav-link-text ms-1">Manage Admin Univ</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('admin.manage_admin_fakultas') ? 'active' : '') }}"
                    href="{{ route('admin.manage_admin_fakultas') }}">
                    <span class="nav-link-text ms-1">Manage Admin Fakultas</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('admin.manage_user') ? 'active' : '') }}"
                    href="{{ route('admin.manage_user') }}">
                    <span class="nav-link-text ms-1">Voter Management</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Candidate</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('admin.manage-election') ? 'active' : '') }}"
                    href="{{ route('admin.manage_election') }}">
                    <span class="nav-link-text ms-1">Election Management</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Information Management</span>
                </a>
            </li>
            @endif

            @if (Auth::check() && Auth::user()->hasRole('admin_univ'))
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.dashboard') ? 'active' : '') }}"
                    href="{{ route('admin.dashboard') }}">
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('admin.manage_user') ? 'active' : '') }}"
                    href="{{ route('admin.manage_user') }}">
                    <span class="nav-link-text ms-1">Voter Management</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Candidate</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Election Management</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Information Management</span>
                </a>
            </li>
            @endif

            @if (Auth::check() && Auth::user()->hasRole('admin_fakultas'))
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.dashboard') ? 'active' : '') }}"
                    href="{{ route('admin.dashboard') }}">
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('admin.manage_user') ? 'active' : '') }}"
                    href="{{ route('admin.manage_user') }}">
                    <span class="nav-link-text ms-1">Voter Management</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Candidate</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Election Management</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Information Management</span>
                </a>
            </li>
            @endif

            @if (!Auth::user()->roles()->exists())
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('user.dashboard') ? 'active' : '') }}"
                    href="{{ route('user.dashboard') }}">
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Information</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Vote</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <span class="nav-link-text ms-1">Admin Contact</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>