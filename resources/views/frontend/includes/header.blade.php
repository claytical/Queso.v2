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
                <a class="navbar-item" href="{!! URL::to('quest/redeem')!!}">Quests</a>
                <div class="navbar-item has-dropdown is-hoverable">                
                        <a class="navbar-link  is-active" href="#">
                          Resources
                        </a>
                        <div class="navbar-dropdown is-boxed">
                          @foreach(access()->courses() as $c)

                            <a class="navbar-item {{ Active::pattern('resources/'.$c->id, 'is-active') }}" href="{!! URL::to('resources/'.$c->id) !!}">
                              {!! $c->name !!}
                            </a>
                          @endforeach
                        </div>
                </div>
                <a class="navbar-item" href="#">Grade</a>

                <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link  is-active" href="#">
                          Manage
                        </a>
                        <div class="navbar-dropdown is-boxed">
                        @foreach(access()->courses_taught() as $c)
                          <a class="navbar-item {{ Active::pattern('manage/course/'.$c->id, 'is-active') }}" href="{!! URL::to('manage/course/'.$c->id) !!}">
                            <strong>{!! $c->name !!}</strong>
                          </a>
                            <a class="navbar-item {{ Active::pattern('manage/quests/'.$c->id, 'is-active') }}" href="{!! URL::to('manage/quests/'.$c->id) !!}">
                              Quests
                            </a>
                            <a class="navbar-item {{ Active::pattern('manage/announcements/'.$c->id, 'is-active') }}" href="{!! URL::to('manage/announcements/'.$c->id) !!}">
                              Announcements
                            </a>
                            <a class="navbar-item {{ Active::pattern('manage/resources/'.$c->id, 'is-active') }}" href="{!! URL::to('manage/resources/'.$c->id) !!}">
                              Resources
                            </a>

                            <a class="navbar-item " href="#">
                              Students
                            </a>
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