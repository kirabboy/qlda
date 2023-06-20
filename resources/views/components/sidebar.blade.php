<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('dist/img/logomevivumoi.png') }}" width="110" height="32" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                @if (auth()->user()->roles->value == 2 || auth()->user()->roles->value == 3)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-file"></i>
                            </span>
                            <span class="nav-link-title">
                                Dự án
                            </span>
                        </a>
                        <div class="dropdown-menu" id="navbar-base">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('project.add') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="fa-light fa-plus"></i>
                                        </span>
                                        Thêm dự án
                                    </a>
                                    <a class="dropdown-item" href="{{ route('project.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="fa-sharp fa-solid fa-list"></i>
                                        </span>
                                        Danh sách dự án
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                @if (auth()->user()->roles->value == 1 || auth()->user()->roles->value == 3)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <i class="fa-solid fa-flag"></i>
                            </span>
                            <span class="nav-link-title">
                                Báo cáo dự án
                            </span>
                        </a>
                        <div class="dropdown-menu" id="navbar-base">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('project.report.add') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="fa-light fa-plus"></i>
                                        </span>
                                        Thêm báo cáo dự án
                                    </a>
                                    <a class="dropdown-item" href="{{ route('project.report.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="fa-sharp fa-solid fa-list"></i>
                                        </span>
                                        Danh sách báo cáo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-sharp fa-solid fa-file-arrow-down"></i>
                            </span>
                            <span class="nav-link-title">
                                Quản lý file download
                            </span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->roles->value == 2 || auth()->user()->roles->value == 3)
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-bookmark"></i>
                            </span>
                            <span class="nav-link-title">
                                Quản lý thư viện
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <span class="nav-link-title">
                                Quản lý nhân viên
                            </span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->roles->value == 3)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <span class="nav-link-title">
                                Quản lý tài khoản
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</aside>
