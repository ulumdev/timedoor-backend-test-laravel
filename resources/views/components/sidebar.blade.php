<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>menu</span></li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>dashboards</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link">analytics</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link">crm</a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link">ecommerce</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link">crypto</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link">projects</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu --> --}}

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}"
                        href="{{ route('books.index') }}">
                        <i class="ri-apps-2-line"></i> <span data-key="t-landing">List Books</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('authors.*') ? 'active' : '' }}"
                        href="{{ route('authors.top') }}">
                        <i class="ri-user-star-line"></i> <span data-key="t-landing">Top Authors</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ratings.*') ? 'active' : '' }}"
                        href="{{ route('ratings.create') }}">
                        <i class="ri-draft-line"></i> <span data-key="t-landing">Insert Rating</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
