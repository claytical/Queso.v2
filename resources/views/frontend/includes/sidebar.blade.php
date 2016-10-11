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
                {!! access()->course()->name !!}
            </div><!--pull-left-->
        </div><!--user-panel-->

         <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="visible-xs-*"><a href="#" data-toggle="modal" data-target="#course_list" class="btn btn-default btn-xs pull-right">Switch Course</a></li>
            @if (access()->instructor())
                <li class="{{ Active::pattern('grade/submissions') }}">
                <a href="/grade/submissions">Submissions <span class="badge pull-right">{!! Form::submission_count() !!}</span></a>
                </li>

                <li class="{{ Active::pattern('grade/inclass') }}">
                    {{ link_to('grade/inclass', 'In Class Work') }}
                </li>
                <li class="header">Manage</li>
                <li class="{{ Active::pattern('manage/quests') }}">
                    {{ link_to('manage/quests', 'Quests') }}
                </li>
                <li class="{{ Active::pattern('manage/students') }}">
                    {{ link_to('manage/students', 'Students') }}
                </li>
                <li class="{{ Active::pattern('manage/resources') }}">
                    {{ link_to('manage/resources', 'Resources') }}
                </li>
                <li class="{{ Active::pattern('manage/announcements') }}">
                    {{ link_to('manage/announcements', 'Announcements') }}
                </li>
                <li class="{{ Active::pattern('manage/course') }}">
                    {{ link_to('manage/course', 'Course') }}
                </li>


            @endif


            @if(access()->student())
                <li class="header">Quests</li>

                <!-- Optionally, you can add icons to the links -->
                <li class="{{ Active::pattern('quests/available') }}">
                    {{ link_to('quests/available', 'Available') }}
                </li>

                <li class="{{ Active::pattern('quest/redeem') }}">
                    {{ link_to('quest/redeem', 'Instant Credit') }}
                </li>

                <li class="{{ Active::pattern('quests/history') }}">
                    {{ link_to('quests/history', 'History') }}
                </li>
                <li class="{{ Active::pattern('feedback') }}">
                    {{ link_to('feedback', 'Peer Feedback') }}
                </li>

            @endif
            @if(access()->contentCount() > 0)
            <li class="header">Resources</li>
                {!! HTML::decode(Form::singleResourceList()) !!}

                {!! HTML::decode(Form::categoryResourceList()) !!}
            @endif

        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>