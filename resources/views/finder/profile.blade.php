@extends('layouts.finder')
@section('content')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-4 text-center">
                <?php
                    $profileImg = ( $profile->avatar != '' ) ? $profile->avatar : config('app.url')."/images/no_image_available.png";
                ?>
                <img src="<?php echo $profileImg; ?>" class="profile-image rounded-image" alt="profile image">
            </div>
            <div class="col-8 mx-auto pt-3 text-left">
                <h4>{{ $profile->name }}</h4>
                <h6>Role : {{ $profile->role_name }}</h6>
                <a href="{{ route('finder.personalinfo') }}">Edit personal information</a>
                <div>
                <a href="{{ route('logout.index') }}">
                    Sign out&nbsp;<i class="icon ion-md-log-out"></i>
                </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 pt-3">
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
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" rows="5" id="userbio" name="userbio">{{ $profile->bio }}</textarea>
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
                        bootbox.alert("Something goes wrong, please check again 2", function(){
                            window.location.href = "{{ route('finder.profile') }}";
                        });
                    }
        });
    });

</script>

@endsection
