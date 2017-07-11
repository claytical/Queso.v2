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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.3/css/bulma.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Raleway" rel="stylesheet">        
    </head>
    <body>
        <header>
            <nav class="navbar">
              <div class="navbar-brand">

                <div class="navbar-burger">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>
            </nav>
        </header>

        @include('includes.partials.messages')
        
        <section class="guest-content">
            @yield('content')
        </section>
        <footer class="footer">
          <div class="container">
            <div class="content has-text-centered">
              <p>
                <strong>Queso</strong> by <a href="http://claytical.com">Clay Ewing</a>.
              </p>
              <p>
                <a class="icon" href="https://github.com/claytical/Queso.v2">
                  <i class="fa fa-github"></i>
                </a>
              </p>
            </div>
          </div>
        </footer>


        {{ Html::script('js/vendor/bootstrap/bootstrap.min.js') }}
    
    </body>
</html>