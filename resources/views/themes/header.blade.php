<div class="container-fluid main-container">
    <div class="d-flex">
        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
        <a class="logo-horizontal " href="{{ route('inicio') }}">
            <img src="{{ asset('images/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
        </a>

        <div class="d-flex order-lg-2 ms-auto header-right-icons">
            <div class="navbar navbar-collapse responsive-navbar p-0">
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <div class="d-flex order-lg-2">
                        <div class="dropdown d-flex notifications">
                            <a class="nav-link icon" data-bs-toggle="dropdown">
                                <i class="fe fe-bell"></i><span class=" pulse"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <div class="drop-heading border-bottom">
                                    <div class="d-flex">
                                        <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications</h6>
                                    </div>
                                </div>
                                <div class="notifications-menu">
                                    <a class="dropdown-item d-flex" href="notify-list.html">
                                        <div class="me-3 notifyimg bg-primary brround box-shadow-primary">
                                            <i class="fe fe-mail"></i>
                                        </div>
                                        <div class="mt-1 wd-80p">
                                            <h5 class="notification-label mb-1">New Application received
                                            </h5>
                                            <span class="notification-subtext">3 days ago</span>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex" href="notify-list.html">
                                        <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                            <i class="fe fe-check-circle"></i>
                                        </div>
                                        <div class="mt-1 wd-80p">
                                            <h5 class="notification-label mb-1">Project has been approved</h5>
                                            <span class="notification-subtext">2 hours ago</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <a href="notify-list.html" class="dropdown-item text-center p-3 text-muted">View all Notification</a>
                            </div>
                        </div>

                        <div class="dropdown d-flex profile-1">
                            <a class="nav-link icon" data-bs-toggle="dropdown">
                                <i class="fe fe-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <div class="drop-heading">
                                    <div class="text-center">
                                        <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ Auth::user()->nombre_corto }}</h5>
                                        <small class="text-muted">{{ Auth::user()->getAllRol(); }}</small>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item" href="profile.html"><i class="dropdown-icon fe fe-user"></i> Cambiar clave </a>
                                <a class="dropdown-item" href="{{ route('cerrar-sesion') }}"><i class="dropdown-icon fe fe-alert-circle"></i> Salir </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>