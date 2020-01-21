@extends('layouts.user')
@section('content')

<div class="my-3 my-md-5">
    <div id="map"></div>
    <br />
</div>

    <div class="container">
      <div class="row row-cards row-deck">

        @foreach ( $data['popular']->locations as $post )

          <div class="col-sm-3 col-xl-3">
            <div class="card">
              <img class="card-img-top" src="{{ $post->image }}" alt={{ $post->caption }}>
              <div class="card-body d-flex flex-column">
                <h4>{{ $post->caption }}</h4>
                <a href="{{ config('app.url') }}/getinfo/{{ $post->post_id }}" class="text-default">More info ...</a>
                <div class="d-flex align-items-center pt-5 mt-auto">
                  <div class="avatar avatar-md mr-3" style="background-image: url({{ $post->avatar }})"></div>
                  <div>
                      {{ $post->name }}
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_k11Co05BhMpXi0DRUk4INioruFi1qLY&callback=initMap" async defer></script>

@endsection
