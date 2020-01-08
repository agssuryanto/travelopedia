@extends('layouts.user')
@section('content')

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #4C7FCF;
  color: #FFFFFF;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #4C7FCF;
  border-top: none;
}
</style>

<div class="my-3 my-md-5">
  <div class="container">

    <?php
        // $profile = Session::get('profile');
        // print "<pre>";
        // print_r($profile);
        // print "</pre>";
        // print $profile->avatar;
        // die;
        $token = Session::get('token');
        $avatar = ( $profile->avatar != '' ) ? $profile->avatar : config('app.url')."/assets/images/user.png" ;
    ?>

    <div class="card">

        <div class="card-header">
            <div class="row">
                <div class="tab">
                    <button id="eee" class="tablinks" onclick="openCity(event, 'profile')">My Profile</button>
                    <button class="tablinks" onclick="openCity(event, 'personal')">Personal Information</button>
                </div>
            </div>
        </div>

        <div class="card-body" style="border: none;">
            <div class="tabcontent" style="border: none;" id="profile" name="profile">
                <h2>My Profile</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                            <form id="frmPictureProfile" name="frmPictureProfile" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <img src="<?php echo $avatar; ?>" id="img_preview" width="150" height="150" >
                                        </div>
                                        <input onchange="readURL(this)" type="file" style="font-size: 12px;" id="picture_profile" name="picture_profile" class="col-xs-10 col-sm-5" accept="image/gif, image/jpeg, image/png">
                                        <input type="hidden" id="id" name="id" value="<?php echo $profile->user_id; ?>" />
                                        <br /><br />
                                        <button style="width: 150px" id="btnSubmitFoto" name="btnSubmitFoto" class="btn btn-secondary btn-block"><i class="fe fe-camera"></i>&nbsp;Update Photo</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <form id="frmProfile" name="frmProfile">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input class="form-control" id="username" name="username" placeholder="your name" value="{{ $profile->name }}" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input class="form-control" id="useremail" name="useremail" placeholder="your-email@domain.com" value="{{ $profile->email }}" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input class="form-control" id="userphone" name="userphone" placeholder="Your phone number" value="{{ $profile->phone }}" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" id="select-status" class="form-control custom-select">
                                    <option value="1" <?php $sel=($profile->status == "1") ? " selected " : ""; echo $sel; ?> >Active</option>
                                    <option value="0" <?php $sel=($profile->status == "0") ? " selected " : ""; echo $sel; ?> >InActive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" rows="5" id="userbio" name="userbio">{{ $profile->bio }}</textarea>
                            </div>
                            <div class="form-footer">
                                <button id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tabcontent" style="border: none;" id="personal" name="personal">
                <h2>Personal Information</h2>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <form id="frmPersonalInfo" name="frmPersonalInfo">
                            <?php
                                $user_profile = $data['personal']->personals[0];
                                $year = date("Y", strtotime($user_profile->date_of_birth));
                                $month = date("n", strtotime($user_profile->date_of_birth));
                                $date = date("j", strtotime($user_profile->date_of_birth));
                                $city = ($user_profile->city_id != '') ? $user_profile->city_id : "0";
                                $district = ($user_profile->district_id != '') ? $user_profile->district_id : "0";
                                $subdistrict = ($user_profile->subdistrict_id != '' ) ? $user_profile->subdistrict_id : "0";
                            ?>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="id" name="id" value="<?php echo $profile->user_id; ?>" />
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input class="form-control" id="user_name" name="user_name" placeholder="user_name" value="{{ $profile->name }}" readonly />
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">ID Card</label>
                                        <input class="form-control" id="id_card" name="id_card" placeholder="id card" value="{{ $user_profile->id_card }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Place of Birth</label>
                                        <input class="form-control" id="place_of_birth" name="place_of_birth" placeholder="place of birth" value="{{ $user_profile->place_of_birth }}" />
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Date of birth</label>
                                    <div class="row gutters-xs">
                                    <div class="col-5">
                                        <select name="month_birth" class="form-control custom-select">
                                        <option value="">Month</option>
                                        <option value="1" <?php $sel = ( $month == "1" ) ? " selected " : ""; echo $sel; ?>>January</option>
                                        <option value="2" <?php $sel = ( $month == "2" ) ? " selected " : ""; echo $sel; ?>>February</option>
                                        <option value="3" <?php $sel = ( $month == "3" ) ? " selected " : ""; echo $sel; ?>>March</option>
                                        <option value="4" <?php $sel = ( $month == "4" ) ? " selected " : ""; echo $sel; ?>>April</option>
                                        <option value="5" <?php $sel = ( $month == "5" ) ? " selected " : ""; echo $sel; ?>>May</option>
                                        <option value="6" <?php $sel = ( $month == "6" ) ? " selected " : ""; echo $sel; ?>>June</option>
                                        <option value="7" <?php $sel = ( $month == "7" ) ? " selected " : ""; echo $sel; ?>>July</option>
                                        <option value="8" <?php $sel = ( $month == "8" ) ? " selected " : ""; echo $sel; ?>>August</option>
                                        <option value="9" <?php $sel = ( $month == "9" ) ? " selected " : ""; echo $sel; ?>> September</option>
                                        <option value="10" <?php $sel = ( $month == "10" ) ? " selected " : ""; echo $sel; ?>>October</option>
                                        <option value="11" <?php $sel = ( $month == "11" ) ? " selected " : ""; echo $sel; ?>>November</option>
                                        <option value="12" <?php $sel = ( $month == "12" ) ? " selected " : ""; echo $sel; ?>>December</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="day_birth" class="form-control custom-select">
                                        <option value="">Day</option>
                                        <?php
                                            for ($i=1; $i<=31; $i++)
                                            {
                                                $sel = ( $date == $i ) ? " selected " : "";
                                                echo "<option value=". $i .$sel.">".$i."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="year_birth" class="form-control custom-select">
                                        <option value="">Year</option>
                                        <?php
                                            for ($i=date("Y"); $i>1960; $i--)
                                            {
                                                $sel = ( $year == $i ) ? " selected " : "";
                                                echo "<option value=". $i .$sel.">".$i."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Province</label>
                                        <select onchange="change_pid()" class="form-control" style="min-width: 100px;" name="province" id="province">
                                            <?php

                                                $roles = count($data['provinces']->province);
                                                if ( count($data['provinces']->province) > 0 )
                                                {
                                                    echo "<option value=''>--- select province ---</option>";
                                                    foreach ($data['provinces']->province as $key )
                                                    {
                                                        $sel = ( $key->id == $user_profile->province_id ) ? " selected " : "";
                                                        echo "<option value=".$key->id.$sel.">".$key->province_name."</option>";
                                                    }
                                                }

                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">City</label>
                                        <select onchange="change_cid()" class="form-control" style="min-width: 100px;" name="city" id="city">
                                            <?php
                                                echo "<option value=''>--- select city ---</option>";
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">District</label>
                                        <select onchange="change_did()" class="form-control" style="min-width: 100px;" name="district" id="district">
                                            <?php
                                                echo "<option value=''>--- select district ---</option>";
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Sub District</label>
                                        <select class="form-control" style="min-width: 100px;" name="subdistrict" id="subdistrict">
                                            <?php
                                                echo "<option value=''>--- select subdistrict ---</option>";
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" rows="5" id="address" name="address">{{ $user_profile->address1 }}</textarea>
                            </div>

                            <div class="form-footer">
                                <button id="btnSubmit" name="btnSubmit" class="btn btn-primary">Save</button>
                                <a href="{{ route('user.home') }}" id="btnCancel" name="btnCancel" class="btn btn-secondary"><i class="fe fe-rotate-ccw"></i>&nbsp;Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

  </div>
</div>

		<script>
			$(document).ready(function(){

                change_pid();
                change_cid();
                change_did();

                $('#btnSubmitFoto').hide();
                openCity(event, 'profile');
				$("#picture_profile").change(function(){
					readURL(this);
                    $('#btnSubmitFoto').show();
				});
            });
        </script>


<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

        <script type="text/javascript">

            function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('#img_preview').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
                    $('#btnSubmitFoto').show();
				}
			}

            $('#frmPictureProfile').on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                data.append('_token', '{{ csrf_token() }}' );
                $.ajax({
					url: "{{ route('changeprofilepict.store') }}",
                    type: 'POST',
					method: 'POST',
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
                        var myJSON = JSON.stringify(data);
                        bootbox.alert("Update Picture Profile success", function(){
                            window.location.href = "{{ route('user.profile') }}";
                        });
                    },
                    error: function (request, status, error) {
                        var myJSON = JSON.stringify(request);
                        //alert(myJSON);
                        bootbox.alert("Something goes wrong, please check again 2", function(){
                            window.location.href = "{{ route('user.profile') }}";
                        });
                    }
                });
            });

            $('#frmPersonalInfo').on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                data.append('_token', '{{ csrf_token() }}' );
                $.ajax({
					url: "{{ route('user_profile.update_profile') }}",
                    type: 'POST',
					method: 'POST',
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
                        var myJSON = JSON.stringify(data);
                        //alert(myJSON);
                        if ( data != '' ) {
                            if ( data['status'] == true ) {
                                bootbox.alert("Update data success!", function(){
                                    window.location.href = "{{ route('user.profile') }}";
                                });
                            } else {
                                bootbox.alert("Update data failed!", function(){
                                    window.location.href = "{{ route('user.profile') }}";
                                });
                            }
                        } else {
                            bootbox.alert("Something goes wrong, please check again 1", function(){
                                window.location.href = "{{ route('user.profile') }}";
                            });
                        }
                    },
                    error: function (request, status, error) {
                        var myJSON = JSON.stringify(request);
                        alert(myJSON);
                        bootbox.alert("Something goes wrong, please check again 2", function(){
                            window.location.href = "{{ route('user.profile') }}";
                        });
                    }
                });
            });

            $('#frmProfile').on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
					url: "{{ config('app.url') }}/admin/user_profile/<?php echo $profile->user_id; ?>",
                    type: 'POST',
					method: 'POST',
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
                        var myJSON = JSON.stringify(data);
                        //alert(myJSON);
                        if ( data != '' ) {
                            if ( data['status'] == true ) {
                                bootbox.alert("Update data success!", function(){
                                    window.location.href = "{{ route('user.profile') }}";
                                });
                            }
                        } else {
                            bootbox.alert("Something goes wrong, please check again 1", function(){
                                window.location.href = "{{ route('user.profile') }}";
                            });
                        }
                    },
                    error: function (request, status, error) {
                        var myJSON = JSON.stringify(request);
                        //alert(myJSON);
                        bootbox.alert("Something goes wrong, please check again 2", function(){
                            window.location.href = "{{ route('user.profile') }}";
                        });
                    }
                });
            });


            function change_did(){
                var pid = $('#province').val();
                var cid = $('#city').val();
                var did = $('#district').val();
                if ( pid != '' && cid != '' && did != '' )
                {
                    $("#pid").val(pid);
                    $("#cid").val(cid);
                    $("#did").val(did);
                    $.ajax({
                        type:"POST",
                        url : "<?php echo config('app.api').'/getsubdistrict'; ?>",
                        data:{
                            'p_id': pid,
                            'c_id': cid,
                            'd_id': did,
                            'token': "<?php echo Session::get('token'); ?>",
                        },
                        success: function(data){
                            var myJSON = JSON.stringify(data);
                            $("#addCity").show();
                            if ( data.status == true ) {
                                $("#subdistrict").empty();
                                $('#subdistrict').append("<option value=''>--- select subdistrict ---</option>");
                                    $('#selected_city').val(pid);
                                    var district = data.district;
                                    if ( district.length > 0 ) {
                                        var xx = 0;
                                        $.each(district, function(idx, obj) {
                                            xx++;
                                            if ( obj.id == <?php echo $subdistrict; ?> )
                                            {
                                                $('#subdistrict').append($('<option>', {
                                                    value: obj.id,
                                                    text : obj.subdistrict_name,
                                                    selected: true
                                                }));
                                            } else {
                                                $('#subdistrict').append($('<option>', {
                                                    value: obj.id,
                                                    text : obj.subdistrict_name
                                                }));
                                            }                                        });
                                    }
                            } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){
                                        window.location.href = "{{ route('user.profile') }}";
                                    });
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('user.profile') }}";
                            });
                        }
                    });
                }
            }

            function change_cid(){
                var pid = $('#province').val();
                var cid = $('#city').val();
                if ( pid != '' && cid != '' )
                {
                    $("#pid").val(pid);
                    $("#cid").val(cid);
                    $.ajax({
                        type:"POST",
                        url : "<?php echo config('app.api').'/getdistrict'; ?>",
                        data:{
                            'p_id': pid,
                            'c_id': cid,
                            'token': "<?php echo Session::get('token'); ?>",
                        },
                        success: function(data){
                            var myJSON = JSON.stringify(data);
                            if ( data.status == true ) {
                                $('#district').empty();
                                $('#subdistrict').empty();
                                $('#district').append("<option value=''>--- select district ---</option>");
                                $('#subdistrict').append("<option value=''>--- select subdistrict ---</option>");
                                    $('#selected_city').val(pid);
                                    var district = data.district;
                                    if ( district.length > 0 ) {
                                        var xx = 0;
                                        $.each(district, function(idx, obj) {
                                            xx++;
                                            if ( obj.id == <?php echo $district; ?> )
                                            {
                                                $('#district').append($('<option>', {
                                                    value: obj.id,
                                                    text : obj.district_name,
                                                    selected: true
                                                }));
                                            } else {
                                                $('#district').append($('<option>', {
                                                    value: obj.id,
                                                    text : obj.district_name
                                                }));
                                            }
                                        });
                                        change_did();
                                    }
                            } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){
                                        window.location.href = "{{ route('user.profile') }}";
                                    });
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('user.profile') }}";
                            });
                        }
                    });
                }
            }

            function change_pid(){
                var pid = $('#province').val();
                $("#addCity").hide();
                if ( pid != '' ) {
                    $.ajax({
                        type:"POST",
                        url : "<?php echo config('app.api').'/getcity'; ?>",
                        data:{
                            'id': pid,
                            'token': "<?php echo Session::get('token'); ?>",
                        },
                        success: function(data){
                            var myJSON = JSON.stringify(data);
                            if ( data.status == true ) {
                                $('#city').empty();
                                    $('#district').empty();
                                    $('#subdistrict').empty();
                                    $('#city').append("<option value=''>--- select city ---</option>");
                                    $('#district').append("<option value=''>--- select district ---</option>");
                                    $('#subdistrict').append("<option value=''>--- select subdistrict ---</option>");
                                    var province = data.province;
                                    if ( province.length > 0 ) {
                                        var xx = 0;
                                        $.each(province, function(idx, obj) {
                                            xx++;
                                            if ( obj.id == <?php echo $city; ?> )
                                            {
                                                $('#city').append($('<option>', {
                                                    value: obj.id,
                                                    text : obj.city_name,
                                                    selected: true
                                                }));
                                            } else {
                                                $('#city').append($('<option>', {
                                                    value: obj.id,
                                                    text : obj.city_name
                                                }));
                                            }
                                        });
                                        change_cid();
                                    }

                            } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){
                                        window.location.href = "{{ route('user.profile') }}";
                                    });
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('user.profile') }}";
                            });
                        }
                    });

                }
            }
        </script>

@endsection
