@extends($layouts)
@section('content')

<?php
$profile = Session::get('profile');
?>

<div class="my-3 my-md-5">
    <div class="container">

        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Change Password</h3>
        </div>
        <div class="card-body">
            <form id="frmProfile" name="frmProfile">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current" name="current" placeholder="Current Password" />
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password"  class="form-control" id="new_password" name="new_password" placeholder="New Password" />
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password"  class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Confirmation New Password" />
                </div>

                <div class="form-footer">
                    <button id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block">Save</button>
                </div>

        </div>
    </div>
</div>

<script type="text/javascript">

$('#frmProfile').on('submit', function(e) {
    e.preventDefault();

    if ( $('#current').val() == '' || $('#new_password').val() == '' || $('#confirm_new_password').val() == '' ) {
        bootbox.alert("Enter all parameters", function(){
            $('#current').focus();
        });
        return false;
    }

    if ( $('#confirm_new_password').val() != $('#new_password').val() ) {
        bootbox.alert("Your password don't match", function(){
            $('#current').focus();
        });
        return false;
    }

    var data = new FormData(this);
    $.ajax({
		url: "{{ config('app.url') }}/admin/changepassword/<?php echo $profile->user_id; ?>",
        type: 'POST',
		method: 'POST',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
            var myJSON = JSON.stringify(data);
            if ( data != '' ) {
                if ( data['status'] == true ) {
                    bootbox.alert("Update data success! <br /> You need to re-login", function(){
                    });
                    window.location.href = "{{ route('logout.index') }}";
                } else {
                    bootbox.alert("Invalid current password!!", function(){
                    });
                    window.location.href = "{{ route('changepassword.index') }}";
                }
            } else {
                bootbox.alert("Something goes wrong, please check again 1", function(){
                    window.location.href = "{{ route('changepassword.index') }}";
                });
            }
        },
        error: function (request, status, error) {
            var myJSON = JSON.stringify(request);
            //alert(myJSON);
            bootbox.alert("Something goes wrong, please check again 2", function(){
                window.location.href = "{{ route('changepassword.index') }}";
            });
        }
    });
});

</script>

@endsection
