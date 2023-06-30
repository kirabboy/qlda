<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <div class="nav-item dropdown pe-5">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                aria-label="Open user menu">
                <div class="btn-group">
                    <button type="button" class="btn btn-info" type="button">
                        {{ __('Language') }}
                    </button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" type="button">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="drop-toggle-columns dropdown-menu dropdown-menu-lg" role="menu">
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                @foreach (config('app.available_locales') as $locale => $language)
                    <div class="d-none">
                        {{ $locale == 'vi' ? ($flag = 'flag_vietnam.png') : ($flag = 'flag_english.jpg') }}
                    </div>
                    <a href="{{ url('locale', $locale) }}" class="dropdown-item">
                        <img src="{{ asset('assets/images/' . $flag) }}" alt=""
                            width="30px">&nbsp;{{ __($language) }}</a>
                @endforeach
            </div>
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
