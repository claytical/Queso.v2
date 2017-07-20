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
                <a class="navbar-item" href="{!! URL::to('quests/available')!!}">Quests</a>
                <a class="navbar-item" href="{!! URL::to('quests/history/1')!!}">Progress</a>


                @if(count(access()->courses()) > 1)
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
                @else
                  @foreach(access()->courses() as $c)

                    <a class="navbar-item {{ Active::pattern('resources/'.$c->id, 'is-active') }}" href="{!! URL::to('resources/'.$c->id) !!}">
                      Resources
                    </a>
                  @endforeach

                @endif

                @if(count(access()->courses_taught()) > 1)

                  <div class="navbar-item has-dropdown is-hoverable">
                          <a class="navbar-link  is-active" href="#">
                            Manage
                          </a>
                          <div class="navbar-dropdown is-boxed">
                          @foreach(access()->courses_taught() as $c)
                            <a class="navbar-item {{ Active::pattern('manage/course/'.$c->id, 'is-active') }}" href="{!! URL::to('manage/course/'.$c->id) !!}">
                              {!! $c->name !!}
                            </a>
                           @endforeach
                  </div>
                  @else
                    @if(count(access()->courses_taught()) == 1)
                          @foreach(access()->courses_taught() as $c)
                            <a class="navbar-item {{ Active::pattern('manage/course/'.$c->id, 'is-active') }}" href="{!! URL::to('manage/course/'.$c->id) !!}">
                              Manage
                            </a>
                    @endif
                  @endif
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