<!-- Sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start bg-gradient-primary"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="#">
            <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-3 font-weight-bold text-white">Pemira Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (Auth::check() && Auth::user()->hasRole('superadmin'))
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Super Admin</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.dashboard') ? 'active' : '') }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-home ps-2 pe-2 text-center text-dark {{ Request::is('admin.dashboard') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 {{ Request::is('admin.dashboard') ? 'text-dark' : 'text-white' }}">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.manage_admin_univ') ? 'active' : '') }}"
                    href="{{ route('admin.manage_admin_univ') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-cog ps-2 pe-2 text-center text-dark {{ Request::is('admin.manage_admin_univ') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.manage_admin_univ') ? 'text-dark' : 'text-white' }}">Manage Admin Univ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.manage_admin_fakultas') ? 'active' : '') }}"
                    href="{{ route('admin.manage_admin_fakultas') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-cog ps-2 pe-2 text-center text-dark {{ Request::is('admin.manage_admin_fakultas') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.manage_admin_fakultas') ? 'text-dark' : 'text-white' }}">Manage Admin Fakultas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.manage_user') ? 'active' : '') }}"
                    href="{{ route('admin.manage_user') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-users ps-2 pe-2 text-center text-dark {{ Request::is('admin.manage_user') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.manage_user') ? 'text-dark' : 'text-white' }}">Voter Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.candidates.index') ? 'active' : '') }}"
                    href="{{ route('admin.candidates.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-friends ps-2 pe-2 text-center text-dark {{ Request::is('admin.candidates.index') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.candidates.index') ? 'text-dark' : 'text-white' }}">Candidate</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.manage-election') ? 'active' : '') }}" 
                href="{{ route('admin.manage_election') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-vote-yea ps-2 pe-2 text-center text-dark {{ Request::is('admin.manage-election') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.manage-election') ? 'text-dark' : 'text-white' }}">Election Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('#') ? 'active' : '') }}" href="#">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-info-circle ps-2 pe-2 text-center text-dark {{ Request::is('#') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('#') ? 'text-dark' : 'text-white' }}">Information Management</span>
                </a>
            </li>
            @endif

            @if (Auth::check() && Auth::user()->hasRole('admin_univ'))
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Admin Univ</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.dashboard') ? 'active' : '') }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-home ps-2 pe-2 text-center text-dark {{ Request::is('admin.dashboard') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 {{ Request::is('admin.dashboard') ? 'text-dark' : 'text-white' }}">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.manage_user') ? 'active' : '') }}"
                    href="{{ route('admin.manage_user') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-users ps-2 pe-2 text-center text-dark {{ Request::is('admin.manage_user') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.manage_user') ? 'text-dark' : 'text-white' }}">Voter Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is ('admin.candidates.index') ? 'active' : '') }}"
                    href="{{ route('admin.candidates.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-friends ps-2 pe-2 text-center text-dark {{ Request::is('admin.candidates.index') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.candidates.index') ? 'text-dark' : 'text-white' }}">Candidate</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('admin.manage-election') ? 'active' : '') }}" 
                href="{{ route('admin.manage_election') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-vote-yea ps-2 pe-2 text-center text-dark {{ Request::is('admin.manage-election') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('admin.manage-election') ? 'text-dark' : 'text-white' }}">Election Management</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>