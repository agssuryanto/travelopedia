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
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ asset('/assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('/assets/js/require.min.js') }}"></script>
    <script src="{{ asset('/assets/js/cookies_utillity.js') }}"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="../assets/css/dashboard.css" rel="stylesheet" />
    <script src="../assets/js/dashboard.js"></script>
  </head>
  <body class="" style="background-image: url({{ asset('/images/travelling.jpg') }}); background-repeat: no-repeat; background-size: cover;" >
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row" >
            <div class="col-lg-6 col-md-6">
              &nbsp;
            </div>
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                  <img src="{{ asset('/images/logo/thumbnail_logopanjang.png') }}" alt="Travelomedia">
              </div>
              <form class="card" name="frmLogin" id="frmLogin">
              <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                      <a href="./forgot-password.html" class="float-right small">I forgot password</a>
                    </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div>
                  <div class="form-footer">
                    <img style="width: 300px; margin-top: -250px; background-color: rgba(255,255,255,0.7); position: fixed; z-indoex: 1;" src="{{ config('app.url') }}/assets/images/loading-gear.gif" id="loading-gear" name="loading-gear" />
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                  </div>
                </div>
                <div class="text-center text-muted">
                  Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
                  <br /><br />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
		$(document).ready(function(){
            $('#loading-gear').hide();
        });
    </script>

    <script>

        function readlocation() {

            if ( navigator.geolocation )
            {
                navigator.geolocation.getCurrentPosition(function(position){
                    console.log(position);
                });
            } else {
                console.log("geolocation is not supported");
            }

        }

		$('#frmLogin').on('submit', function(e){
          e.preventDefault();
          if($('#email').val() == '' ){
						bootbox.alert("Fill in Email Address!", function(){
              //
						});
						$('#email').focus();
						return false;
					}

          if($('#password').val() == '' ){
						bootbox.alert("Fill in Password!", function(){
							//
						});
						$('#password').focus();
						return false;
          }

          $('#loading-gear').show();
          var data = new FormData(this);
          var _token = $('input#_token').val();
          data.append("_token", _token);
          $.ajax({
					  url: "{{ route('dologin') }}",
            type: 'POST',
					  method: 'POST',
					  data: data,
					  cache: false,
					  contentType: false,
					  processData: false,
					  success: function(data){
					    if ( data != '' ) {
                if ( data['status'] == true ) {
                  bootbox.alert("Login Successfully!", function(){
                  });
                  window.location.href = "{{ route('home.index') }}";
                } else {
                  bootbox.alert("Invalid email or password 1!", function(){
                    window.location.href = window.location.href;
                  });
                }
					    } else {
					            bootbox.alert("Invalid email or password 2!", function(){
									window.location.href = window.location.href;
								});
							}
					  },
						error: function (request, status, error) {
                            bootbox.alert("Invalid email or password 3!", function(){
								window.location.href = window.location.href;
							});
						}
          });
        });

    </script>

  </body>
</html>
