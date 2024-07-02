<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start bg-gradient-primary"
    id="sidenav-main" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="#">
            <img src="{{ asset('assets/img/kpu-uns.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-3 font-weight-bold text-white">PEMIRA UNS</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (Auth::check() && Auth::user()->hasRole('superadmin'))
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Super Admin</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-home ps-2 pe-2 text-center {{ Request::is('admin.dashboard') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Home</span>
                </a>
            </li>
            <li class="nav-item mt-1">
                <span
                    class="nav-link-text ms-2 ps-4 text-uppercase text-xs font-weight-bolder text-white">Administrator</span>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/manage-admin-univ*') ? 'active' : '' }}"
                    href="{{ route('admin.admin_univ.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-cog ps-2 pe-2 text-center {{ Request::is('admin.admin_univ.index') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Admin Universitas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/manage-admin-fakultas*') ? 'active' : '' }}"
                    href="{{ route('admin.admin_faculty.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-cog ps-2 pe-2 text-center {{ Request::is('admin.admin_faculty.index') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Admin Fakultas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/manage-user*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-users ps-2 pe-2 text-center {{ Request::is('admin.users.index') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Voter</span>
                </a>
            </li>
            <li class="nav-item mt-1">
                <span
                    class="nav-link-text ms-2 ps-4 text-uppercase text-xs font-weight-bolder text-white">Candidates</span>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/candidate*') ? 'active' : '' }}"
                    href="{{ route('admin.candidates.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-friends ps-2 pe-2 text-center {{ Request::is('admin/candidate*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Candidate</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/president-candidate*') ? 'active' : '' }}"
                    href="{{ route('president-candidate.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-info-circle ps-2 pe-2 text-center {{ Request::is('admin/president-candidate*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">President Candidate</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-2 {{ Request::is('admin/vice-president-candidate*') ? 'active' : '' }}"
                    href="{{ route('vice-president-candidate.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-info-circle ps-2 pe-2 text-center {{ Request::is('admin/vice-president-candidate*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Vice President Candidate</span>
                </a>
            </li>
            <li class="nav-item mt-1">
                <span
                    class="nav-link-text ms-2 ps-4 text-uppercase text-xs font-weight-bolder text-white">Election</span>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/election*') ? 'active' : '' }}"
                    href="{{ route('admin.election') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-vote-yea ps-2 pe-2 text-center {{ Request::is('admin.election') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Election</span>
                </a>
            </li>
            <li class="nav-item mt-1">
                <span
                    class="nav-link-text ms-2 ps-4 text-uppercase text-xs font-weight-bolder text-white">Information</span>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/information*') ? 'active' : '' }}"
                    href="{{ route('admin.information.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-info-circle ps-2 pe-2 text-center {{ Request::is('admin/information*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Information</span>
                </a>
            </li>
            @endif

            @if (Auth::check() && (Auth::user()->hasRole('admin_univ') || Auth::user()->hasRole('admin_fakultas')))
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Admin Pemira</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-home ps-2 pe-2 text-center {{ Request::is('admin.dashboard') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin.users.index') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-users ps-2 pe-2 text-center {{ Request::is('admin.users.index') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Voter</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/candidate*') ? 'active' : '' }}"
                    href="{{ route('admin.candidates.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-friends ps-2 pe-2 text-center {{ Request::is('admin/candidate*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Candidate</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/election*') ? 'active' : '' }}"
                    href="{{ route('admin.election') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-vote-yea ps-2 pe-2 text-center {{ Request::is('admin.election') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Election</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/information*') ? 'active' : '' }}"
                    href="{{ route('admin.information.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-info-circle ps-2 pe-2 text-center {{ Request::is('admin/information*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Information</span>
                </a>
            </li>
            @endif

            @if (!Auth::user()->roles()->exists())
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">User</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/dashboard*') ? 'active' : '' }}"
                    href="{{ route('user.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-home ps-2 pe-2 text-center {{ Request::is('user.dashboard') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/information*') ? 'active' : '' }}"
                    href="{{ route('user.information.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-info-circle ps-2 pe-2 text-center {{ Request::is('user/information*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Information</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/vote*') ? 'active' : '' }}"
                href="{{ route('user.vote') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-vote-yea ps-2 pe-2 text-center {{ Request::is('user/vote') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Vote</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/contact*') ? 'active' : '' }}"
                    href="{{ route('user.contact') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-user-cog ps-2 pe-2 text-center {{ Request::is('user/contact*') ? 'text-white' : 'text-dark' }}"
                            aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Contact Admin</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>
