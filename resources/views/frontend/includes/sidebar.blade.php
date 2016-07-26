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

         <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Quests</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('quests/available') }}">
                {{ link_to('quests/available', 'Available') }}
            </li>

            <li class="{{ Active::pattern('quests/redeem') }}">
                {{ link_to('quest/redeem', 'Instant Credit') }}
            </li>

            <li class="{{ Active::pattern('quests/history') }}">
                {{ link_to('quests/history', 'History') }}
            </li>
            <li class="{{ Active::pattern('feedback') }}">
                {{ link_to('feedback', 'Peer Feedback') }}
            </li>

            <li class="header">Resources</li>
            <li class="{{ Active::pattern('resource/1') }}">
                {{ link_to('#', 'Handouts') }}
            </li>
            <li class="{{ Active::pattern('resource/2') }}">
                {{ link_to('#', 'Presentations') }}
            </li>


        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>