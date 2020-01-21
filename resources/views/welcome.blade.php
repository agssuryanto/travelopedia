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

    <style>
      #map {
        height: 80%;
      }
    </style>

  </head>
  <body class="">
    <!-- div class="flex-fill">
      <div class="header py-4">
        <div class="container">
        </div>
      </div>
    </!-->
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
    <div id="map"></div>
    <br />
    <div class="container">
      <div class="row row-cards row-deck">

        @foreach ( $data['popular']->locations as $post )

          <div class="col-sm-3 col-xl-3">
            <div class="card">
              <a href="#"><img class="card-img-top" src="{{ $post->image }}" alt={{ $post->caption }}></a>
              <div class="card-body d-flex flex-column">
                <h4>{{ $post->caption }}</h4>
                <a href="{{ config('app.url') }}/getinfo/{{ $post->post_id }}" class="text-default">More info ...</a>
                <!-- div class="text-muted">{{ $post->text_currator }}</div -->
                <div class="d-flex align-items-center pt-5 mt-auto">
                  <div class="avatar avatar-md mr-3" style="background-image: url({{ $post->avatar }})"></div>
                  <div>
                      <a href="./profile.html" class="text-default">{{ $post->name }}</a>
                      <!-- small class="d-block text-muted">3 days ago</small -->
                  </div>
                  <div class="ml-auto text-muted">
                      <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        @endforeach

      </div>
    </div>


      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2019 <a href="/">Travelomedia</a>.&nbsp;All rights reserved.
            </div>
          </div>
        </div>
      </footer>



    <script>
            var map;
            var url = "{{ config('app.api') }}/getlocation";
            var lat = "";
            var long = "";
            var imgs = "";
            var captions = "";
            var koordinat = new Array();

            $(document).ready(function(){

                getlocation();

                var x=0;
                var counter = koordinat.length;
                setInterval(
                    function(){
                        var d = new Date();
                        var n = d.getSeconds();
                        //console.log(n+" "+x+" "+koordinat.length);
                        if ( x >= koordinat.length ) {
                            x=0;
                        }
                        initMap(koordinat[x][0], koordinat[x][1], koordinat[x][2], koordinat[x][3]);
                        x++;
                    }
                , 5000000);

            });

                // function print_koordinat() {
                //     for (i=0;i<koordinat.length;i++){
                //         /*
                //         console.log(koordinat[i]);
                //         console.log('LAT : '+koordinat[i][0]);
                //         console.log('LONG : '+koordinat[i][1]);
                //         console.log('IMG : '+koordinat[i][2]);
                //         console.log('CAPTION : '+koordinat[i][3]);
                //         */
                //     }
                // }

                function getlocation()
                {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        method: 'GET',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            var myJSON = JSON.stringify(data);
                            //console.log("Success : "+myJSON);
                            var locations = data.locations;
                            $.each(locations, function(idx, obj) {
                                //console.log(obj.caption+" "+obj.lat+" "+obj.long);
                                //console.log('get data : lat : '+obj.lat+' long : '+obj.long+' image : '+obj.image);
                                lat = obj.lat;
                                long = obj.long;
                                imgs = obj.image;
                                captions = obj.caption;
                                koordinat[idx] = new Array(lat, long, imgs, captions);
                            });
                            initMap(lat, long, imgs, captions);
                            //print_koordinat(koordinat);
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            //console.log("Failed : " +myJSON);
                        }
                    });
                }

            function initMap(lat, long, imgs, captions) {
                var lati = Number(lat);
                var longi = Number(long);
                //console.log(lati+" : "+longi);
                //var myLatLng = {lat: -8.582571, lng: 119.489866};
                var myLatLng = {lat: lati, lng: longi};
                var contentString = '<div id="content">'+
                    '<h6>'+captions+'</h6>'+
                    '<img src='+imgs+' width=100px height=75px>'+
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -2.600029, lng: 118.015776},
                zoom: 5
                });

                var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: captions,
                url: imgs
                });

                infowindow.open(map, marker);
                google.maps.event.addListener(marker, 'click', function() {
                    window.location.href = this.url;
                    infowindow.open(map, marker);
                    //alert(this.url);
                });

            }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google') }}&callback=initMap" async defer></script>

  </body>
</html>
