<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Bfin Financial Services</title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
  <link rel="stylesheet" href="{{ asset('css/skeleton.css') }}">


</head>
<body>
  <div id="app">
    <index></index>
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/jquery.js') }}" defer></script>
  <!-- <script src="{{ asset('js/rate.js') }}" defer></script> -->
  <script src="{{ asset('js/fancybox.js') }}" defer></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
  <script src="{{ asset('js/clipboard.min.js') }}" defer></script>
  <!-- <script src="{{ asset('js/functions.js') }}" defer></script> -->

<!--   <script src="{{ asset('js/jquery.js.download') }}" defer></script>
  <script src="{{ asset('js/rate.js.download') }}" defer></script>
  <script src="{{ asset('js/fancybox.js.download') }}" defer></script>
  <script src="{{ asset('js/owl.carousel.min.js.download') }}" defer></script>
  <script src="{{ asset('js/clipboard.min.js.download') }}" defer></script>
  <script src="{{ asset('js/functions.js.download') }}" defer></script> -->

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script>
    if('serviceWorker' in navigator) {
      navigator.serviceWorker
        .register('/sw.js')
        .then(function() { console.log("Service Worker Registered"); });
    }
</script>
</body>
</html>
