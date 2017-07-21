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
                    @if(count(access()->courses()) > 1)
                        <div class="navbar-item has-dropdown is-hoverable">                
                                <a class="navbar-link  is-active" href="#">
                                  Quests
                                </a>
                                <div class="navbar-dropdown is-boxed">
                                  @foreach(access()->courses() as $c)

                                    <a class="navbar-item {{ Active::pattern('quests/history/'.$c->id, 'is-active') }}" href="{!! URL::to('quests/history/'.$c->id) !!}">
                                      {!! $c->name !!}
                                    </a>
                                  @endforeach
                                </div>
                        </div>


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
        
                          <a class="navbar-item {{ Active::pattern('quests/history/'.$c->id, 'is-active') }}" href="{!! URL::to('quests/history/'.$c->id)!!}">Quests</a>

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
                        </div>
                    @else
                      @if(count(access()->courses_taught()) == 1)
                          @foreach(access()->courses_taught() as $c)
                            <a class="navbar-item {{ Active::pattern('manage/course/'.$c->id, 'is-active') }}" href="{!! URL::to('manage/course/'.$c->id) !!}">
                              Manage
                            </a>
                          @endforeach
                      @else
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
            @endif
        </div>
    </nav>
</header>