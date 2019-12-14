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
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2019-04-04 16:57:42 +0200 -->
    <title>Indonesian Culture</title>
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

    <style>
      #map {
        height: 80%;
      }
    </style>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLi7JyOMCGj7w3aREo9q8jR4pCWmnwRNA"></script>
    <script>

    var markers = [
      ['BANDA ACEH', 5.5577, 95.3222, 'http://api-travel.doingfun.id/logo-daerah/aceh36x36.png'],
      ['SUMATERA UTARA', 3.597031 , 98.678513, 'http://api-travel.doingfun.id/logo-daerah/sumut36x36.png'],
      ['SUMATERA BARAT', -0.94924, 100.35427, 'http://api-travel.doingfun.id/logo-daerah/sumbar36x36.png'],
      ['RIAU', 0.506566, 101.437790, 'http://api-travel.doingfun.id/logo-daerah/riau36x36.png'],
      ['JAMBI', -1.609972, 103.607254, 'http://api-travel.doingfun.id/logo-daerah/jambi36x36.png'],
      ['SUMATERA SELATAN', -2.990934, 104.756554, 'http://api-travel.doingfun.id/logo-daerah/sumsel36x36.png'],
      ['LAMPUNG', -5.450000, 105.266670, 'http://api-travel.doingfun.id/logo-daerah/lampung36x36.png'],
      ['DKI JAKARTA', -6.175392, 106.827153, 'http://api-travel.doingfun.id/logo-daerah/jakarta36x36.png'],
      ['JAWA BARAT', -6.914744, 107.609810, 'http://api-travel.doingfun.id/logo-daerah/jabar36x36.png'],
      ['JAWA TENGAH', -7.150975, 110.140259, 'http://api-travel.doingfun.id/logo-daerah/jateng36x36.png'],
      ['JOGJAKARTA', -7.797068, 110.370529, 'http://api-travel.doingfun.id/logo-daerah/jogjakarta36x36.png'],
      ['JAWA TIMUR', -7.250445, 112.768845, 'http://api-travel.doingfun.id/logo-daerah/jatim36x36.png'],
      ['KEP. RIAU', 3.945651, 108.142867, 'http://api-travel.doingfun.id/logo-daerah/kep-riau36x36.png'],
      ['BANTEN', -6.4058172, 106.0640179, 'http://google-maps-icons.googlecode.com/files/sailboat-tourism.png'],
      ['BALI', -8.650000, 115.216667, 'http://api-travel.doingfun.id/logo-daerah/bali36x36.png'],
      ['NUSA TENGGARA BARAT', -8.49317, 117.42024, 'http://api-travel.doingfun.id/logo-daerah/ntb36x36.png'],
      ['NUSA TENGGARA TIMUR', -8.657382, 121.079369, 'http://api-travel.doingfun.id/logo-daerah/ntt36x36.png'],

      ['BENGKULU', -3.788892, 102.266579, 'http://google-maps-icons.googlecode.com/files/sailboat-tourism.png'],

      ['BANGKA BELITUNG', -2.741051, 106.440587, 'http://google-maps-icons.googlecode.com/files/sailboat-tourism.png'],

      ['KALIMANTAN UTARA', 2.750000,   116.000000, 'http://api-travel.doingfun.id/logo-daerah/kalut36x36.png'],
      ['KALIMANTAN BARAT', 0.000000,   109.333336, 'http://api-travel.doingfun.id/logo-daerah/kalbar36x36.png'],
      ['KALIMANTAN TENGAH', -2.210000, 113.920000, 'http://api-travel.doingfun.id/logo-daerah/kalteng36x36.png'],
      ['KALIMANTAN SELATAN', -3.316694,  114.590111, 'http://api-travel.doingfun.id/logo-daerah/kalsel36x36.png'],
      ['KALIMANTAN TIMUR', -0.502106, 117.153709, 'http://api-travel.doingfun.id/logo-daerah/kaltim36x36.png'],

      ['SULAWESI UTARA', 0.624693,  123.974998, 'http://api-travel.doingfun.id/logo-daerah/sulut36x36.png'],
      ['SULAWESI TENGAH', -1.430025,  121.445618, 'http://api-travel.doingfun.id/logo-daerah/sulteng36x36.png'],
      ['SULAWESI BARAT', -2.844137, 119.232078,  'http://api-travel.doingfun.id/logo-daerah/sulbar36x36.png'],
      ['SULAWESI SELATAN', -3.668799,  119.974053, 'http://api-travel.doingfun.id/logo-daerah/sulsel36x36.png'],
      ['SULAWESI TENGGARA', -3.972201, 122.514900, 'http://api-travel.doingfun.id/logo-daerah/sultra36x36.png'],

      ['GORONTALO', 0.556174,  123.058548, 'http://api-travel.doingfun.id/logo-daerah/gorontalo36x36.png'],

      ['MALUKU', -3.654703,  128.190643, 'http://api-travel.doingfun.id/logo-daerah/maluku36x36.png'],
      ['MALUKU UTARA', 1.570999,  127.808769, 'http://api-travel.doingfun.id/logo-daerah/malut36x36.png'],

      ['PAPUA BARAT', -0.861453,  134.062042, 'http://api-travel.doingfun.id/logo-daerah/papua-barat36x36.png'],
      ['PAPUA', -4.269928, 138.080353, 'http://api-travel.doingfun.id/logo-daerah/papua36x36.png'],
    ];

      function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        //var map = new google.maps.Map(mapCanvas, mapOptions)

        var map = new google.maps.Map(mapCanvas, {
                    center: {lat: -2.600029, lng: 118.015776},
                    zoom: 5
                    });

        var infowindow = new google.maps.InfoWindow(), marker, i;
        var bounds = new google.maps.LatLngBounds(); // diluar looping
        for (i = 0; i < markers.length; i++) {
            pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(pos); // di dalam looping
            marker = new google.maps.Marker({
                position: pos,
                map: map,
                icon: markers[i][3]
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(markers[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
            map.fitBounds(bounds); // setelah looping
        }

      }


      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body class="">
    <div class="flex-fill">
      <div class="header py-4">
        <div class="container">
          <div class="d-flex justify-content-center">
            <a class="header-brand" href="./index.html">
                <!-- img src="" class="header-brand-img" alt="INDONESIA TRAVELOPEDIA" -->
                <div class="text-logo">INDONESIAN CULTURE</div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 ml-auto">
            <form class="input-icon my-3 my-lg-0">
              <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
              <div class="input-icon-addon">
                <i class="fe fe-search"></i>
              </div>
            </form>
          </div>
          <div class="col-lg order-lg-first">
            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.html" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Kesenian Tradisional</a>
                  </li>
                  <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
                  </li>
                  <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                  </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="map"></div>
    <br />


      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2019 <a href="/">Indonesian Culture</a>.&nbsp;All rights reserved.
            </div>
          </div>
        </div>
      </footer>

  </body>
</html>
