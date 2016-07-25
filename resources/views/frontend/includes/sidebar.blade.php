<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <!-- Status -->
                <a href="#">Course Name</a>
            </div><!--pull-left-->
        </div><!--user-panel-->
<!--
        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.backend.general.search_placeholder') }}" />
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div><!--input-group-->
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Quests</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                {{ link_to_route('admin.dashboard', "Available" }}
            </li>
            <li class="{{ Active::pattern('admin/dashboard') }}">
                {{ link_to_route('admin.dashboard', "Completed" }}
            </li>
            <li class="{{ Active::pattern('admin/dashboard') }}">
                {{ link_to_route('admin.dashboard', "Peer Feedback" }}
            </li>

            <li class="header">Resources</li>
            <li class="{{ Active::pattern('resources/*') }}">
                {{ link_to_route('admin.dashboard', trans('menus.backend.sidebar.dashboard')) }}

            </li>
            <li class="{{ Active::pattern('resources/*') }}">
                {{ link_to_route('admin.dashboard', trans('menus.backend.sidebar.dashboard')) }}

            </li>
            <li class="{{ Active::pattern('resources/*') }}">
                {{ link_to_route('admin.dashboard', trans('menus.backend.sidebar.dashboard')) }}

            </li>

            @permission('manage-users')
                <li class="{{ Active::pattern('admin/access/*') }}">
                    {{ link_to_route('admin.access.user.index', trans('menus.backend.access.title')) }}
                </li>
            @endauth


        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>