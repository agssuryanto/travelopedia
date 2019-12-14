@extends('layouts.admin')
@section('content')

<?php
    $profile = Session::get('profile');
?>

<div class="my-3 my-md-5">
  <div class="container"  style="min-height: 375px;">
    <div class="page-header">

        <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Confirmation Delete Role</h3>                        
                    </div>                    

                    <div class="card-body">
                    <p style="color: red;"><i>Warnings: all user with role will don't have authority</i></p>
                    <?php
                        foreach ($data['roles']->role as $key )
                        {
                            $role_id = $key->id;
                    ?>
                    <form id="frmUserRole" name="frmUserRole">
                        {{ csrf_field() }}							
                        <input type="hidden" name="_method" value="DELETE">														
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Role Name" value="{{ $key->name }}" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Display Name</label>
                            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" value="{{ $key->display_name }}" />
                            <input type="hidden" class="form-control" id="role_id" name="role_id" placeholder="Role id" value="{{ $key->id }}" />
                        </div>

                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $profile->user_id; ?>" />

                        <div class="form-footer">
                            <button id="btnSubmit" name="btnSubmit" class="btn btn-danger"><i class="fe fe-trash-2"></i>&nbsp;Confirm Delete</button>
                            <a href="{{ route('user-role.index') }}" id="btnCancel" name="btnCancel" class="btn btn-secondary"><i class="fe fe-rotate-ccw"></i>&nbsp;Cancel</a>
                        </div>
                    </form>
                    <?php
                    }
                    ?>
                    </div>                    
                </div>
        </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    $('#frmUserRole').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        bootbox.confirm({
            message: "Confirmation. Do you really want to delete this data ?",
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
                        url: "{{ config('app.url') }}/admin/user-role/<?php echo $role_id; ?>",
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
                                window.location.href = "{{ route('user-role.index') }}";                    
                                } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){ 
                                        window.location.href = "{{ route('user-role.index') }}";                    
                                    });				
                                }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            alert(myJSON);
                            bootbox.alert("Something goes wrong, please check again 2", function(){ 
                                window.location.href = "{{ route('user-role.index') }}";                    
                            });											
                        }                                        
                    });                    
                }
            }
        });
    });

</script>


@endsection