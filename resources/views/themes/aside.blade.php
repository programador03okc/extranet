
<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{ route('inicio') }}">
            <img src="{{ asset('images/logo-rrhh.png') }}" class="header-brand-img desktop-logo1" alt="logo">
        </a>
    </div>
    <div class="main-sidemenu">
        <div class="slide-left disabled" id="slide-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
            </svg>
        </div>
        <ul class="side-menu">
            <li class="sub-category">
                <h3>MENU PRINCIPAL</h3>
            </li>
            <li class="slide">
                <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('inicio') }}">
                    <i class="side-menu__icon fe fe-home"></i>
                    <span class="side-menu__label">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="side-menu__item has-link" href="{{ route('promociones.cupones') }}" target="_blank">
                    <i class="side-menu__icon fe fe-zap"></i><span class="side-menu__label">Promociones</span>
                </a>
            </li>
            <li class="sub-category">
                <h3>RECURSOS HUMANOS</h3>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                    <i class="side-menu__icon fe fe-slack"></i>
                    <span class="side-menu__label">Solicitudes</span>
                    <i class="angle fe fe-chevron-right"></i>
                </a>
                <ul class="slide-menu">
                    <li class="panel sidetab-menu">
                        <div class="panel-body tabs-menu-body p-0 border-0">
                            <div class="tab-content">
                                <div class="tab-pane active" id="side1">
                                    <ul class="sidemenu-list">
                                        <li><a href="{{ route('recursos-humanos.permisos') }}" class="slide-item"> Permisos</a></li>
                                        {{--  <li><a href="{{ route('recursos-humanos.horas-extras') }}" class="slide-item"> Horas extras</a></li>  --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="slide-right" id="slide-right">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
            </svg>
        </div>
    </div>
</div>