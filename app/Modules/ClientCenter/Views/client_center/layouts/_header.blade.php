<nav class="app-header navbar navbar-expand bg-body border-bottom">
    <div class="container-fluid">
        {{-- Without this toggle a logged-in Client Center user had NO navigation below 992px:
             body.sidebar-expand-lg pushes .app-sidebar fully off-canvas there, and AdminLTE
             only ever brings it back via the handler bound to [data-lte-toggle="sidebar"]. --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link d-lg-none" data-lte-toggle="sidebar" href="#" role="button"
                   aria-label="@lang('Menu')" title="@lang('Menu')"><i
                            class="fa-solid fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('session.logout') }}"
                                    aria-label="@lang('bt.sign_out')" title="@lang('bt.sign_out')"><i
                            class="fa fa-power-off"></i></a></li>
        </ul>
    </div>
</nav>

