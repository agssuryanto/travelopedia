@extends('layouts.finder')
@section('content')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-4 text-center">
                <h6>Edit Personal Information</h6>
                <form id="frmPictureProfile" name="frmPictureProfile" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <img id="img_preview" src="{{ $data['profile']->avatar }}" class="rounded-image mt-3" style="max-width: 75px; max-height: 75px;" alt="profile image">
                    <br /><br />
                    <input onchange="readURL(this)" type="file" style="font-size: 12px;" id="picture_profile" name="picture_profile" class="col-xs-10 col-sm-5" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" id="id" name="id" value="<?php echo $data['profile']->user_id; ?>" />
                    <br /><br />
                    <button style="width: 150px" id="btnSubmitFoto" name="btnSubmitFoto" class="btn btn-secondary btn-block"><i class="fe fe-camera"></i>&nbsp;Update Photo</button>
                </form>
            </div>
            <div class="col-8 mx-auto pt-3 text-left">
                <form id="frmPersonalInfo" name="frmPersonalInfo">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="id" name="id" value="<?php echo $data['profile']->user_id; ?>" />
                    @foreach ( $data['personal']->personals as $key => $info )

                        <?php
                        $city = ($info->city_id != '') ? $info->city_id : "0";
                        $district = ($info->district_id != '') ? $info->district_id : "0";
                        $subdistrict = ($info->subdistrict_id != '' ) ? $info->subdistrict_id : "0";
                        ?>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $info->name }}" id="username" name="username" placeholder="your name" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ID Card</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $info->id_card }}" id="id_card" name="id_card" placeholder="your id card" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Place of Birth</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $info->place_of_birth }}" id="place_of_birth" name="place_of_birth" placeholder="your place of birth" />
                            </div>
                        </div>
                        <?php
                            $year = date("Y", strtotime($info->date_of_birth));
                            $month = date("n", strtotime($info->date_of_birth));
                            $date = date("j", strtotime($info->date_of_birth));
                        ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date of Birth</label>
                            <div class="d-flex col-sm-10">
                                <select name="month_birth" class="form-control custom-select">
                                    <option value="">Select Month</option>
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
                                <select name="day_birth" class="form-control custom-select">
                                    <option value="">Select Day</option>
                                    <?php
                                        for ($i=1; $i<=31; $i++)
                                        {
                                            $sel = ( $date == $i ) ? " selected " : "";
                                            echo "<option value=". $i .$sel.">".$i."</option>";
                                        }
                                    ?>
                                </select>
                                <select name="year_birth" class="form-control custom-select">
                                    <option value="">Select Year</option>
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
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address">{{ $info->address1 }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Province</label>
                            <div class="col-sm-10">
                                <select onchange="change_pid()" class="form-control" style="min-width: 100px;" name="province" id="province">
                                    <?php
                                        if ( count($data['provinces']->province) > 0 )
                                        {
                                            echo "<option value=''>--- select province ---</option>";
                                            foreach ($data['provinces']->province as $key )
                                            {
                                                $sel = ( $info->province_id == $key->id ) ? " selected " : "";
                                                echo "<option value=".$key->id.$sel.">".$key->province_name."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    @endforeach


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <select onchange="change_cid()" class="form-control" style="min-width: 100px;" name="city" id="city">
                                <?php
                                    echo "<option value=''>--- select city ---</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">District</label>
                        <div class="col-sm-10">
                            <select onchange="change_did()" class="form-control" style="min-width: 100px;" name="district" id="district">
                                <?php
                                    echo "<option value=''>--- select district ---</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sub District</label>
                        <div class="col-sm-10">
                            <select class="form-control" style="min-width: 100px;" name="subdistrict" id="subdistrict">
                                <?php
                                    echo "<option value=''>--- select subdistrict ---</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

        $(document).ready(function() {
            change_pid();
            change_cid();
            change_did();

                $('#btnSubmitFoto').hide();
				$("#picture_profile").change(function(){
					readURL(this);
                    $('#btnSubmitFoto').show();
				});

        });

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
                                            }
                                        });
                                    }
                            } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){
                                        window.location.href = "{{ route('finder.profile') }}";
                                    });
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('finder.profile') }}";
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
                                        window.location.href = "{{ route('finder.profile') }}";
                                    });
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('finder.profile') }}";
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
                                        window.location.href = "{{ route('finder.profile') }}";
                                    });
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('finder.profile') }}";
                            });
                        }
                    });
                }
            }

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
                                    window.location.href = "{{ route('finder.profile') }}";
                                });
                            } else {
                                bootbox.alert("Update data failed!", function(){
                                    window.location.href = "{{ route('finder.profile') }}";
                                });
                            }
                        } else {
                            bootbox.alert("Something goes wrong, please check again 1", function(){
                                window.location.href = "{{ route('finder.profile') }}";
                            });
                        }
                    },
                    error: function (request, status, error) {
                        var myJSON = JSON.stringify(request);
                        //alert(myJSON);
                        //console.log(myJSON);
                        bootbox.alert("Something goes wrong, please check again 2", function(){
                            window.location.href = "{{ route('finder.profile') }}";
                        });
                    }
                });
            });

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
                            window.location.href = "{{ route('finder.profile') }}";
                        });
                    },
                    error: function (request, status, error) {
                        var myJSON = JSON.stringify(request);
                        alert(myJSON);
                        bootbox.alert("Something goes wrong, please check again 2", function(){
                            window.location.href = "{{ route('finder.profile') }}";
                        });
                    }
                });
            });

</script>

@endsection
