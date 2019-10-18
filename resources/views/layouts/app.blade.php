

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{Config('app.name', 'Deckbuilder')}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

      
    </head>
    <body>
      @include('inc.navbar')
      <div class="container-fluid">
        @yield('content')
      </div>
      <script src="/js/app.js"></script> 
    </body>
</html>
