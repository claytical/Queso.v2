<aside class="menu">
  <p class="menu-label">
    Grade
  </p>
  <ul class="menu-list">
    <li><a class="{{ Active::pattern('grade/activity/select/'.$course_id, 'is-active') }}" href="{{ URL::to('grade/activity/select/'.$course_id)}}">Activity</a></li>
    <li><a>Submissions</a></li>
  </ul>

  <p class="menu-label">
    Course Management
  </p>

  <ul class="menu-list">
    <li><a class="{{ Active::pattern('manage/quests/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/quests/'.$course_id) !!}">Quests</a></li>
    <li><a class="{{ Active::pattern('manage/resources/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/resources/'.$course_id) !!}">Resources</a></li>
    <li><a class="{{ Active::pattern('manage/announcements/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/announcements/'.$course_id) !!}">Announcements</a></li>
    <li><a class="{{ Active::pattern('manage/students/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/students/'.$course_id) !!}">Students</a></li>
    <li><a>Teams</a></li>
  </ul>
  <p class="menu-label">
    Course Settings
  </p>
  <ul class="menu-list">
    <li><a class="{{ Active::pattern('manage/course/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/course/'.$course_id) !!}">General</a></li>
    <li><a class="{{ Active::pattern('manage/course/skills/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/skills/course/'.$course_id) !!}">Skills</a></li>
    <li><a class="{{ Active::pattern('manage/course/levels/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/levels/course/'.$course_id) !!}">Levels</a></li>
  </ul>
</aside>
