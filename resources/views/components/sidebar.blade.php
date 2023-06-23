<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('dist/img/logomevivumoi.png') }}" width="110" height="32" alt=""
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                @foreach ($sidebar as $sb)
                    @foreach ($sb['roles'] as $role)
                        @if ($role == auth()->user()->roles->value)
                            @if (empty($sb['sub']))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route($sb['route']) }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="{{ $sb['icon'] }}"></i>
                                        </span>
                                        <span class="nav-link-title">
                                            {{__($sb['title']) }}
                                        </span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        data-bs-auto-close="false" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="{{ $sb['icon'] }}"></i>
                                        </span>

                                        <span class="nav-link-title">
                                            {{__($sb['title']) }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu" id="navbar-base">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                @foreach ($sb['sub'] as $sub)
                                                    <a class="dropdown-item" href="{{ route($sub['route']) }}">
                                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                            <i class=" {{ $sub['icon'] }} "></i>
                                                        </span>
                                                        {{ __($sub['title']) }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</aside>
