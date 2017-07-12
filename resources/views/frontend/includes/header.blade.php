<header>
    <nav class="navbar">
        <div class="navbar-brand">
            <a class="navbar-item" href="{!! URL::to('/') !!}">
              <img src="/img/logo.png" alt="Queso: A Gameful Learning Management System">
            </a>
            <div class="navbar-start">
              <!-- navbar items -->
              @if (access()->guest())

              @else
                <a class="navbar-item" href="#">Quests</a>
                <a class="navbar-item" href="#">Resources</a>
                <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link  is-active" href="#">
                          Resources
                        </a>
                        <div class="navbar-dropdown is-boxed">
                          <a class="navbar-item " href="#">
                            Class #1
                          </a>
                          <a class="navbar-item " href="#">
                            Class #2
                          </a>
                        </div>
                </div>
                <a class="navbar-item" href="#">Grade</a>

                <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link  is-active" href="#">
                          Manage
                        </a>
                        <div class="navbar-dropdown is-boxed">
                        <div class="navbar-item">
                          <strong>Class #1</strong>
                        </div>
                          <a class="navbar-item {{ Active::pattern('manage/announcements') }}" href="{!! URL::to('manage/announcements') !!}">
                            Announcements
                          </a>

                          <a class="navbar-item " href="#">
                            Students
                          </a>
                          <a class="navbar-item " href="#">
                            Resources
                          </a>
                         <hr class="navbar-divider">
                          <div class="navbar-item">
                            <strong>Class #1</strong>
                          </div>
                          
                          <a class="navbar-item " href="#">
                            Students
                          </a>
                          <a class="navbar-item " href="#">
                            Resources
                          </a>
                        </div>
                </div>
              @endif
            </div>

            <div class="navbar-burger">
              <span></span>
              <span></span>
              <span></span>
            </div>
        </div>

        <div class="navbar-end">
            @if (access()->guest())
              <a class="navbar-item" href="{!! URL::to('login') !!}">
                {!! trans('navs.frontend.login') !!}
              </a>

              <a class="navbar-item" href="{!! URL::to('register') !!}">
                {!! trans('navs.frontend.register') !!}
              </a>
            @else

              <a class="navbar-item navbar-end" href="{!! URL::to('logout') !!}">
                {!! trans('navs.general.logout') !!}
              </a>
<!--
            <div class="navbar-item has-dropdown is-hoverable navbar-end">
                <a class="navbar-link  is-active" href="#">
                  {{ access()->user()->name }}
                </a>
                <div class="navbar-dropdown">
                  <a class="navbar-item " href="{!! URL::to('profile/edit')!!}">
                    Settings
                  </a>
                  <a class="navbar-item" href="{!! URL::to('password/change') !!}">
                    Change Password
                  </a>
                </div>
              </div>
-->
            @endif
        </div>
    </nav>
</header>