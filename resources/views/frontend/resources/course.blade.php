@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section">
    <div class="columns is-multiline is-mobile">
        @foreach($resources as $tag => $resource)
            <div class="column is-one-half-tablet is-one-third-desktop">
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
                                @if(!$r->files->isEmpty())
                                    @foreach($r->files as $file)
                                    <p>
                                        <a href="{!! URL::to('uploads/' . $file->name) !!}" alt="{!! substr($file->name,5) !!}" download>
                                        <span class=""><i class="fa fa-paperclip"></i> {!! substr($file->name,5) !!}</span> 
                                        </a>
                                    </p>
                                    @endforeach
                                @endif
                            </div>
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