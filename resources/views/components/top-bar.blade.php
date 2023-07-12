<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <div class="nav-item dropdown d-none d-md-flex">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    @foreach (config('app.available_locales') as $locale => $lang)
                        @if (session('locale') == $locale)
                            <div class="d-none">
                                {{ $locale == 'vi' ? ($flag = 'flag_vietnam.png') : ($flag = 'flag_english.png') }}
                            </div>
                            <img src='{{ asset('assets/images/' . $flag) }}' alt="" width="40px" />&nbsp;
                            </li>
                        @endif
                    @endforeach
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    @foreach (config('app.available_locales') as $locale => $language)
                        <div class="d-none">
                            {{ $locale == 'vi' ? ($flag = 'flag_vietnam.png') : ($flag = 'flag_english.png') }}
                        </div>
                        <a href="{{ url('locale', $locale) }}" class="dropdown-item">
                            <img src="{{ asset('assets/images/' . $flag) }}" alt=""
                                width="30px">&nbsp;{{ __($language) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
            </div>
            @auth
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                            style="background-image: url({{ asset('file-upload/images/' . auth()->user()->avatar) }})"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->fullname }}</div>
                            <div class="mt-1 small text-muted">
                                @if (auth()->user()->roles->value == '1')
                                    <span class="badge bg-green-lt"> {{ __(auth()->user()->roles->key) }}</span>
                                @elseif (auth()->user()->roles->value == '2')
                                    <span class="badge bg-orange-lt">{{ __(auth()->user()->roles->key) }}</span>
                                @else
                                    <span class="badge bg-red-lt">{{ __(auth()->user()->roles->key) }}</span>
                                @endif
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('profile.index') }}" class="dropdown-item">{{ __('Profile') }}</a>
                        <a href="{{ route('change.password') }}" class="dropdown-item">{{ __('Change password') }}</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#modalLogout">{{ __('Logout') }}</a>
                    </div>
                </div>

            @endauth
        </div>
    </div>
</nav>

<div class="modal modal-blur fade" id="modalLogout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Are you sure') }}</div>
                <div>{{ __('Accept logout') }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto"
                    data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="{{ route('sign.out') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">{{ __('Logout') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
