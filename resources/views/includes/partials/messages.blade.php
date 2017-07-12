@if ($errors->any())
    <article class="message is-danger">
      <div class="message-header">
        <p>Error</p>
        <button class="delete"></button>
      </div>
      <div class="message-body">
             @foreach ($errors->all() as $error)
                {!! $error !!}<br/>
            @endforeach
      </div>
    </article>
@elseif (session()->get('flash_success'))
    <article class="message is-success">
      <div class="message-header">
        <p>Success</p>
        <button class="delete"></button>
      </div>
      <div class="message-body">
        @if(is_array(json_decode(session()->get('flash_success'), true)))
            {!! implode('', session()->get('flash_success')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_success') !!}
        @endif
      </div>
    </article>
@elseif (session()->get('flash_warning'))
    <article class="message is-warning">
      <div class="message-header">
        <p>Success</p>
        <button class="delete"></button>
      </div>
      <div class="message-body">
        @if(is_array(json_decode(session()->get('flash_warning'), true)))
            {!! implode('', session()->get('flash_warning')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_warning') !!}
        @endif
      </div>
    </article>
@elseif (session()->get('flash_info'))
    <article class="message is-info">
      <div class="message-header">
        <p>Information</p>
        <button class="delete"></button>
      </div>
      <div class="message-body">
        @if(is_array(json_decode(session()->get('flash_info'), true)))
            {!! implode('', session()->get('flash_info')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_info') !!}
        @endif
      </div>
    </article>
@elseif (session()->get('flash_danger'))
    <article class="message is-danger">
      <div class="message-header">
        <p>Danger!</p>
        <button class="delete"></button>
      </div>
      <div class="message-body">
        @if(is_array(json_decode(session()->get('flash_danger'), true)))
            {!! implode('', session()->get('flash_danger')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_danger') !!}
        @endif
      </div>
    </article>
@elseif (session()->get('flash_message'))
    <article class="message is-info">
      <div class="message-header">
        <p>Information</p>
        <button class="delete"></button>
      </div>
      <div class="message-body">
        @if(is_array(json_decode(session()->get('flash_message'), true)))
            {!! implode('', session()->get('flash_message')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_message') !!}
        @endif
      </div>
    </article>
@endif