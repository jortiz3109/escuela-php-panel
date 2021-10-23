<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('/') }}">
                <img src="https://dev.placetopay.com/web/wp-content/uploads/2020/08/LOGO-P2P-blanco-developers-1.png" class="attachment-0x0 size-0x0" alt="" loading="lazy">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="main-navbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="main-navbar" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        @auth
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                @csrf
                                <button class="button is-light" type="submit">
                                    @lang('Logout')
                                </button>
                            </form>
                        @else
                            <a class="button is-light">
                                @lang('auth.login')
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
