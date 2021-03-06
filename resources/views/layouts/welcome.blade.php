<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="shortcut icon" href="{{ asset('/images/logo/thumbnail_logoaja.png') }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link href="https://fonts.googleapis.com/css?family=Cinzel&display=swap" rel="stylesheet">
    <script src="{{ asset('/tabler/assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/tabler/assets/js/require.min.js') }}"></script>
    <script>
      requirejs.config({
          baseUrl: '{{ config('app.url') }}tabler/'
      });
    </script>

    <!-- Dashboard Core -->
    <link href="{{ asset('/tabler/assets/css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('/tabler/assets/js/dashboard.js') }}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('/tabler/assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('/tabler/assets/plugins/charts-c3/plugin.js') }}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{ asset('/tabler/assets/plugins/maps-google/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('/tabler/assets/plugins/maps-google/plugin.js') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('/tabler/assets/plugins/input-mask/plugin.js') }}"></script>
    <!-- Datatables Plugin -->
    <script src="{{ asset('/tabler/assets/plugins/datatables/plugin.js') }}"></script>

  </head>
  <body class="">
    <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
      <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 mx-auto pt-4">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item dropdown">
                        <a href="{{ route("login.index") }}" class="nav-link" data-toggle="dropdown"> Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link"> Register</a>
                    </li>
                </ul>
            </div>
          <div class="col-lg order-lg-first">
                <div class="d-flex flex-row pt-4">
                    <div class="pt-2">
                        <a class="header-brand" href="{{ config('app.url') }}">
                            <img src="{{ asset('/images/logo/thumbnail_logoaja.png') }}" class="header-brand-img" alt="Travelomedia">
                            Travelomedia
                        </a>
                    </div>
                    <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                            <a href="{{ config('app.url') }}" class="nav-link"><i class="fe fe-home"></i> Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Top Destination</a>
                        </li>
                        <li class="nav-item">
                            <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Recommended Places</a>
                        </li>
                        <li class="nav-item">
                            <a href="/contact" class="nav-link"><i class="fe fe-phone"></i> Contact Us</a>
                        </li>
                    </ul>
                </div>
          </div>
        </div>
      </div>
    </div>

    @yield("content")


      <footer class="footer" style="position: fixed; bottom: 0; width: 100%;">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2019 <a href="/">Travelomedia</a>.&nbsp;All rights reserved.
            </div>
          </div>
        </div>
      </footer>



    <script>

            $(document).ready(function(){


            });

    </script>
  </body>
</html>
