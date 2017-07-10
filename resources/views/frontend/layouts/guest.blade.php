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

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Raleway" rel="stylesheet">        
    </head>
    <body>
        <header>
            <nav class="navbar">
              <div class="navbar-brand">
                <a class="navbar-item" href="http://bulma.io">
                  <img src="{!! URL::to('img/logo.png')!!}" alt="Queso: A Gameful Learning Management System"/>
                </a>

                <div class="navbar-burger">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>
            </nav>
        </header>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
                @yield('page-header')

            </section>

            <!-- Main content -->
            <section class="content">
                @include('includes.partials.messages')
                @yield('content')
            </section><!-- /.content -->

            {{ Html::script('js/vendor/bootstrap/bootstrap.min.js') }}

        </div>
    </div>
    </body>
</html>