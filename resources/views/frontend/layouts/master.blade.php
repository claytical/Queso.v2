<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Queso Gameful Learning Management System')">
        <meta name="author" content="@yield('meta_author', 'Clay Ewing')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles-end')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->

        @yield('after-styles-end')

        <!-- Fonts -->
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.3/css/bulma.css" /> -->
        {{ Html::style('css/bulma.css') }}
        {{ Html::style('css/queso.css') }}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Raleway" rel="stylesheet">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.1/rangeslider.css" />
        <!-- front loading scripts -->
        {{ Html::script('js/vendor/dropzone/dropzone.js')}}
        {{ Html::script('js/vendor/list.min.js')}}
        <script async charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key=a705fe8012d914a446d7e4" ></script>
        {{ Html::style('css/vendor/dropzone/dropzone.css') }}
        {{ Html::style('css/vendor/multi-step-form.css') }}
        {{ Html::style('css/vendor/jquery.minipreview.css') }}

        {{ Html::style('css/vendor/selectize.css') }}
        {{ Html::style('css/vendor/chartist.css') }}


    </head>
    <body>
        @include('includes.partials.logged-in-as')

        @include('frontend.includes.header')

        @yield('page-header')
        
        @include('includes.partials.messages')
        
        @yield('content')
        
        @include('frontend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        {{ Html::script('js/vendor/jquery/jquery.validate.min.js') }}
        {{ Html::script('js/vendor/jquery/multi-step-form.js') }}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.1/rangeslider.js"></script>
        {{ Html::script('js/vendor/jquery/jquery.form.js') }}
        {{ Html::script('js/vendor/tinymce/tinymce.min.js') }}
        {{ Html::script('js/vendor/jquery/selectize.js') }}
        {{ Html::script('js/vendor/jquery/jquery.minipreview.js') }}
        {{ Html::script('js/vendor/jquery/select2.full.min.js') }}
        {{ Html::script('js/vendor/chartist.js') }}

        <script>tinymce.init({  selector:'textarea', 
                                plugins: [
                                            'autolink autoresize link image lists',
                                            'searchreplace wordcount visualblocks fullscreen',
                                            'media contextmenu',
                                            'paste textpattern'],
                                toolbar: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'                                            
                                });</script>

        <script>
        window.setTimeout(function() {
            $(".message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);     
        </script>  
        @yield('before-scripts-end')
 
        @yield('after-scripts-end')
    </body>
</html>