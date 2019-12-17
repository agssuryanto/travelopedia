<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="{{ asset('/assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootbox.min.js') }}"></script>

    <title>{{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
        }
        .page {
            margin-top: 75px;
        }
        a {
            color: #3c3c3c;
        }
        a:hover {
            color: #00758A;
        }
        .profile-image {
            width: 125px;
            height: 125px;
        }
        .rounded-image {
            border-radius: 50%;
        }
        .footer-menu {
            width: 20% !important;
            font-size: 2rem;
        }
    </style>
  </head>
  <body>
    <header class="fixed-top navbar-light bg-light">
        <div class="container">
            <div class="d-flex row">
                <a class="header-brand mx-auto py-2" href="/admin/home">
                    <img style="max-height: 42px;" src="{{ asset('/images/logo/thumbnail_logopanjang.png') }}" class="header-brand-img" alt="tabler logo">
                </a>
            </div>
        </div>
    </header>

    @yield('content')

    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>

    <footer class="fixed-bottom navbar-light bg-light">
        <div class="container">
            <div class="d-flex row">
                <div class="footer-menu text-center">
                    <a href="{{ route('finder.home') }}"><i class="icon ion-md-home"></i></a>
                </div>
                <div class="footer-menu text-center">
                    <a href="{{ route('finder.log') }}"><i class="icon ion-md-search"></i></a>
                </div>
                <div class="footer-menu text-center">
                    <a href="{{ route('finder.posts') }}"><i class="icon ion-md-add-circle-outline"></i></a>
                </div>
                <div class="footer-menu text-center">
                    <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                </div>
                <div class="footer-menu text-center">
                    <a href="{{ route('finder.profile') }}"><i class="icon ion-md-person"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script -->
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
