<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title> Biofeed Investment ltd</title>

    <meta name="description" content=" Biofeed Investment is a community of dedicated investors that wants to make a steady extra income. we deal extensively on Bitcoin">
    <meta name="keywords" content=" Biofeed Investment, Shares, Finance, Bitcoin, Investment">
    <meta name="author" content=" Biofeed Investment ICT Team">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
   <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d9a1e53db28311764d78bd2/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>
<!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
<body>
  <div id="app" style="width: 100vw; padding: 0px; margin: auto; overflow: hidden; box-sizing: border-box;">
    <index></index>
  </div>
  <script src="{{ asset('js/jquery.js') }}" defer></script>
  <script src="{{ asset('js/fancybox.js') }}" defer></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
  <script src="{{ asset('js/clipboard.min.js') }}" defer></script>

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/objectdata.js') }}" defer></script>
  <script>
    if('serviceWorker' in navigator) {
      navigator.serviceWorker
        .register('/sw.js')
        .then(function() { console.log("Service Worker Registered"); });
    }
</script>
</body>
</html>
