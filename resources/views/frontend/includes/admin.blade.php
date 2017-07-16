<aside class="menu">
  <ul class="menu-list">
    <li><a class="{{ Active::pattern('manage/quests/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/quests/'.$course_id) !!}">Quests</a></li>
    <li><a class="{{ Active::pattern('manage/resources/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/resources/'.$course_id) !!}">Resources</a></li>
    <li><a class="{{ Active::pattern('manage/announcements/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/announcements/'.$course_id) !!}">Announcements</a></li>
  </ul>
  <p class="menu-label">
    Course Management
  </p>
  <ul class="menu-list">
    <li><a class="{{ Active::pattern('manage/course/'.$course_id, 'is-active') }}" href="{!! URL::to('manage/course/'.$course_id) !!}">Information</a></li>
    <li><a>Students</a></li>
    <li><a>Teams</a></li>
    <li><a>Skills</a></li>
    <li><a>Levels</a></li>
  </ul>
</aside>
