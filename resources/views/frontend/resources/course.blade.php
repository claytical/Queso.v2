@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section">
    <div class="columns is-multiline is-mobile">
        @foreach($resources as $tag => $resource)
            <div class="column is-half">
                <div class="box">
                @if($tag)
                    <p class="title headline is-uppercase">{!! $tag !!}</p>
                @else
                    <p class="title headline is-uppercase">Resources</p>

                @endif
                @foreach($resource as $r)
                    @if($r->link)
                        <a href="{{ $r->link }}" data-iframely-url>{{ $r->link }}</a>
                        <br/>
                    @else

                        <article class="media">
                          <div class="media-content">
                            <div class="content">
                              <p>
                                <strong>{!! $r->title !!}</strong>
                                <br>
                                {!! $r->description !!}
                              </p>
                            </div>
                            <nav class="level is-mobile">
                              <div class="level-left">
                                @if(!$r->files->isEmpty())
                                    @foreach($r->files as $file)
                                        <a class="level-item" href="{!! URL::to('uploads/' . $file->name) !!}" alt="{!! substr($file->name,5) !!}" download>
                                        <span class="icon is-small"><i class="fa fa-paperclip"></i></span>
                                        </a>
                                    @endforeach
                                @endif
                              </div>
                            </nav>
                          </div>

                        </article>
                    @endif
                @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop