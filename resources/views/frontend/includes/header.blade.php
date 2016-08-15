<header class="main-header">
    {{ link_to_route('frontend.user.dashboard', app_name(), [], ['class' => 'logo']) }}

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if (access()->guest())
                    <li>{{ link_to('login', trans('navs.frontend.login')) }}</li>
                    <li>{{ link_to('register', trans('navs.frontend.register')) }}</li>
                @else

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{ access()->user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>{{ link_to('profile/edit', 'Settings') }}</li>
                        <li>{{ link_to('password/change', 'Change Password') }}</li>

                        <!--

                            @if (access()->user()->canChangePassword())
                                <li>{{ link_to_route('auth.password.change', trans('navs.frontend.user.change_password')) }}</li>
                            @endif

                            @permission('view-backend')
                            <li>{{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) }}</li>
                            @endauth
                        -->

                        <li>{{ link_to_route('auth.logout', trans('navs.general.logout'), []) }}</li>
                    </ul>
                </li>

                @endif

            </ul>
        </div><!-- /.navbar-custom-menu -->
    </nav>
</header>