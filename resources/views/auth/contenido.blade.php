<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema G-Optics">
    <meta name="keyword" content="Sistema G-Opticsl">
    <title>Sistema G-Optics</title>
    <!-- Icons -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.min.css')}}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/stylelogin.css')}}" rel="stylesheet">
    <script src="{{asset('https://code.jquery.com/jquery-3.2.1.js')}}"></script>

    <link rel="icon" href="{{asset('img/favicon2.png')}}" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('img/favicon2.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('img/favicon2.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('img/favicon2.png')}}">
</head>

<body class="my-login-page">  
  <div class="container">
   @yield('login')
  </div>

<!-- Bootstrap and necessary plugins -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <!-- GenesisUI main scripts -->
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
    @stack('scripts')

</body>
</html>