<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles-end')

        {{ Html::style(elixir('css/backend.css')) }}

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        @langRTL
            {!! Html::style(elixir('css/rtl.css')) !!}
        @endif

        @yield('after-styles-end')

        <!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Gentium+Basic|Open+Sans" rel="stylesheet">
        <!-- front loading scripts -->
        {{ HTML::script('js/vendor/dropzone/dropzone.js')}}
        {{ HTML::script('js/vendor/list.min.js')}}
        <script async charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key=a705fe8012d914a446d7e4" ></script>
        {{ Html::style('css/vendor/dropzone/dropzone.css') }}
        {{ Html::style('css/bootstrap-select.min.css') }}
        {{ Html::style('css/bootstrap-table.css') }}
        {{ Html::style('css/vendor/jquery.minipreview.css') }}
        {{ Html::style('css/vendor/select2.min.css') }}

<script>
</script>
    </head>
    <body class="skin-{{ config('backend.theme') }}">
        @include('includes.partials.logged-in-as')

        <div class="wrapper">
            @include('frontend.includes.header')
            @include('frontend.includes.sidebar') 

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')

                    {{-- Change to Breadcrumbs::render() if you want it to error to remind you to create the breadcrumbs for the given route --}}
                    {!! Breadcrumbs::renderIfExists() !!}
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js') }}
        {{ HTML::script('https://cdn.tinymce.com/4/tinymce.min.js')}}
        {{ Html::script('js/vendor/jquery/jquery.form.js') }}
        {{ Html::script('js/vendor/jquery/multiselect.min.js') }}
        {{ Html::script('js/vendor/jquery/jquery.minipreview.js') }}
        {{ Html::script('js/vendor/jquery/select2.full.min.js') }}

        <script>tinymce.init({  selector:'textarea', 
                                plugins: [
                                            'autolink autoresize link image',
                                            'searchreplace wordcount visualblocks fullscreen',
                                            'media contextmenu',
                                            'paste textpattern'],
                                toolbar: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'                                            
                                });</script>

        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.1.4.min.js')}}"><\/script>')</script>
        {{ Html::script('js/vendor/bootstrap/bootstrap.min.js') }}
        {{ Html::script('js/vendor/bootstrap/bootstrap-table.js') }}
        {{ Html::script('js/vendor/bootstrap/bootstrap-table-multiple-sort.min.js') }}
        {{ Html::script('js/vendor/bootstrap/bootstrap-select.min.js')}}
        <script>
        $( document ).ready(function() {
            $('select[name=default_course]').selectpicker();
//            $('a.preview').miniPreview();
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);     
        </script>  
        @yield('before-scripts-end')
      
        {{ HTML::script(elixir('js/backend.js')) }}
        @yield('after-scripts-end')
    </body>
</html>