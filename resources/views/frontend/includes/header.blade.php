<header>
    <nav class="navbar">
        <div class="navbar-brand">
            <a class="navbar-item" href="{!! URL::to('/') !!}">
              <img src="/img/logo.png" alt="Queso: A Gameful Learning Management System">
            </a>
 
            <div class="navbar-burger">
              <span></span>
              <span></span>
              <span></span>
            </div>
        </div>
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
                        {!! access()->courses_taught() !!}
                        @foreach(access()->courses_taught() as $c)
                        <a class="navbar-item {{ Active::pattern('manage/announcements', 'is-active') }}" href="{!! URL::to('manage/course') !!}">
                          <strong>{!! $c->name !!}</strong>
                        </a>
                          <a class="navbar-item {{ Active::pattern('manage/quests', 'is-active') }}" href="{!! URL::to('manage/quests') !!}">
                            Quests
                          </a>
                          <a class="navbar-item {{ Active::pattern('manage/announcements', 'is-active') }}" href="{!! URL::to('manage/announcements') !!}">
                            Announcements
                          </a>

                          <a class="navbar-item " href="#">
                            Students
                          </a>
                          <a class="navbar-item " href="#">
                            Resources
                          </a>
                         <hr class="navbar-divider">
                         @endforeach
                </div>
              @endif
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