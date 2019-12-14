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
          <div class="row">
            <div class="col-lg-6 col-md-6">
                &nbsp;
            </div>
            <div class="col col-login mx-auto">
              <form class="card" name="frmLogin" id="frmLogin">
              <div class="text-center ml-6 mr-6">
                  <img style="max-height: 64px;" src="{{ asset('/images/logo/thumbnail_logopanjang.png') }}" alt="Travelomedia">
              </div>
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="card-body p-3">
                  <div class="card-title text-center">Register Form</div>
                  <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="userName" placeholder="Enter username">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone_no" name="phone_no" aria-describedby="phone_no" placeholder="Enter phone no">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                    </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <input type="hidden" class="form-control" id="latitude" name="latitude" placeholder="latitude">
                    <input type="hidden" class="form-control" id="longitude" name="longitude" placeholder="longitude">
                    <input type="hidden" class="form-control" id="ip_address" name="ip_address" placeholder="ip_address">
                    <input type="hidden" class="form-control" id="browsername" name="browsername" placeholder="browser">
                    <input type="hidden" class="form-control" id="user_agent" name="user_agent" placeholder="ua">
                    <input type="hidden" class="form-control" id="net_info" name="net_info" placeholder="network">
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">
                            Register as
                            </label>
                        </div>
                        <div class="col-md-6">
                            <select name="user_type" id="user_type">
                                <option value="2">User</option>
                                <option value="3">Location Finder</option>
                                <option value="4">Local Expert</option>
                                <option value="5">Narrator</option>
                                <option value="7">Travel Agent</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="form-footer">
                    <img style="width: 300px; margin-top: -250px; background-color: rgba(255,255,255,0.7); position: fixed; z-indoex: 1;" src="{{ config('app.url') }}/assets/images/loading-gear.gif" id="loading-gear" name="loading-gear" />
                    <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                  </div>
                </div>
                <div class="text-center text-muted">
                  Already have account? <a href="/admin/login">Sign in</a>
                  <br /><br />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            var browser = "";
            // CHROME
            if (navigator.userAgent.indexOf("Chrome") != -1 ) {
                //console.log("Google Chrome");
                browser = "Google Chrome";
            }
            // FIREFOX
            else if (navigator.userAgent.indexOf("Firefox") != -1 ) {
                //console.log("Mozilla Firefox");
                browser = "Mozilla Firefox";
            }
            // INTERNET EXPLORER
            else if (navigator.userAgent.indexOf("MSIE") != -1 ) {
                //console.log("Internet Exploder");
                browser = "Internet Explorer";
            }
            // EDGE
            else if (navigator.userAgent.indexOf("Edge") != -1 ) {
                //console.log("Internet Exploder");
                browser = "Ms. Edge";
            }
            // SAFARI
            else if (navigator.userAgent.indexOf("Safari") != -1 ) {
                //console.log("Safari");
                browser = "Safari";
            }
            // OPERA
            else if (navigator.userAgent.indexOf("Opera") != -1 ) {
                //console.log("Opera");
                browser = "Opera";
            }
            // YANDEX BROWSER
            else if (navigator.userAgent.indexOf("Opera") != -1 ) {
                //console.log("YaBrowser");
                browser = "YaBrowser"
            }
            // OTHERS
            else {
                //console.log("Others");
                browser = "Others";
            }

            $.getJSON('http://ip-api.com/json?callback=?', function(data) {
                $("#latitude").val(data.lat);
                $("#longitude").val(data.lon);
                $("#ip_address").val(data.query);
                $("#net_info").val(JSON.stringify(data));
            });

            $("#browsername").val(browser);
            $("#user_agent").val(navigator.userAgent);
        });

	    $(document).ready(function(){
            $('#loading-gear').hide();
        });

        $('#frmLogin').on('submit', function(e){
          e.preventDefault();
          if($('#username').val() == '' ){
						bootbox.alert("Fill in Your Username !", function(){
              //
						});
						$('#username').focus();
						return false;
					}

          if($('#email').val() == '' ){
						bootbox.alert("Fill in Your Email Address!", function(){
              //
						});
						$('#email').focus();
						return false;
					}

          if($('#phone_no').val() == '' ){
						bootbox.alert("Fill in Your Phone No!", function(){
              //
						});
						$('#phone_no').focus();
						return false;
					}

          if($('#password').val() == '' ){
						bootbox.alert("Fill in Your Password!", function(){
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
			    url: "{{ route('doregister') }}",
                type: 'POST',
				method: 'POST',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
                        $('#loading-gear').hide();
                        var myJSON = JSON.stringify(data);
                        //alert(myJSON);
                        if ( data['status'] == true ) {
                            bootbox.alert("Registration success, you can login now!", function(){
                                window.location.href = "{{ route('user.home') }}"
                            });
                        } else {
                            bootbox.alert("Update data failed!", function(){
                                window.location.href = window.location.href;
                            });
                        }
					},
				error: function (request, status, error) {
                        bootbox.alert("Invalid credential!", function(){
							window.location.href = window.location.href;
						});
				}
          });
        });

    </script>

  </body>
</html>
