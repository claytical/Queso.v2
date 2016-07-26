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


        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>