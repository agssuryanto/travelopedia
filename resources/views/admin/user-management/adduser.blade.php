@extends('layouts.admin')
@section('content')

<?php $profile = Session::get('profile'); ?>

<div class="my-3 my-md-5">
    <div class="container"  style="min-height: 375px;">
        <div class="page-header">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">New User</h3>
                    </div>

                    <div class="card-body">
                        <form id="frmAddUser" name="frmAddUser">

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    {{ csrf_field() }}																					
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $profile->user_id; ?>">
                                    <div class="row">
                                        <div class="col-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">User Name</label>
                                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Email Address" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Phone No</label>
                                                <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No" />
                                            </div>  
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Role User</label>
                                                <select class="selectize-input items full has-options has-items" name="role_id" id="role_id">
                                                    <option value="">--- select role ---</option>
                                                    <?php 
                                                    if ( count($data['roles']->role) > 0 )
                                                    {
                                                        $i=0;
                                                        foreach ($data['roles']->role as $key )
                                                        {
                                                            print '<option value='.$key->id.'>'.$key->display_name.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label class="form-label">Status</label>
                                            <select class="selectize-input items full has-options has-items" name="status" id="status">
                                                <option value="">--- select status ---</option>
                                                <option value="1">Active</option>
                                                <option value="0">Not Active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Bio</label>
                                        <textarea class="form-control" name="user_bio" id="user_bio"></textarea>
                                    </div>

                                    <div class="form-footer">
                                        <button id="btnSubmit" name="btnSubmit" class="btn btn-primary"><i class="fe fe-save"></i>&nbsp;Save</button>
                                        <a href="{{ route('user-management.index') }}" id="btnCancel" name="btnCancel" class="btn btn-secondary"><i class="fe fe-rotate-ccw"></i>&nbsp;Cancel</a>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>



<script>
	$(document).ready(function(){
		$("#picture_profile").change(function(){
			readURL(this);
		});
    });
</script>

<script type="text/javascript">

    function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();	
			reader.onload = function (e) {
				$('#img_preview').attr('src', e.target.result);
			}   
			reader.readAsDataURL(input.files[0]);
		}
	}

    $('#frmAddUser').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        if ( $('#user_name').val() == '' ) {
            bootbox.alert("User Name Required !", function(){ 
            });
            $('#user_name').setfocus();            
            return false;
        }

        if ( $('#email_address').val() == '' ) {
            bootbox.alert("Email Address Required !", function(){ 
            });
            $('#email_address').setfocus();            
            return false;
        }

        if ( $('#phone_no').val() == '' ) {
            bootbox.alert("Phone No Required !", function(){ 
            });
            $('#phone_no').setfocus();            
            return false;
        }

        if ( $('#role_id').val() == '' ) {
            bootbox.alert("Role User Required !", function(){ 
            });
            $('#role_id').setfocus();            
            return false;
        }

        bootbox.confirm({
            message: "Confirmation. All data is correct? ",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if ( result ) {

                    $.ajax({
                        url: "{{ route('user-management.store') }}",
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
                                    });
                                }
                                window.location.href = "{{ route('user-management.index') }}";                    
                                } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){ 
                                        window.location.href = "{{ route('user-management.index') }}";                    
                                    });				
                                }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            alert(myJSON);
                            bootbox.alert("Something goes wrong, please check again 2", function(){ 
                                window.location.href = "{{ route('user-management.index') }}";                    
                            });											
                        }                                        
                    });                    
                }
            }
        });
    });

</script>

@endsection