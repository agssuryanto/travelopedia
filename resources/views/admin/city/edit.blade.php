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
                        <h3 class="card-title">Edit Data City</h3>
                    </div>

                    <div class="card-body">
                    <?php
                        foreach ($data['cities']->cities as $key )
                        {
                            $role_id = $key->id;
                    ?>

                    <form id="frmAddCity" name="frmAddCity">
                        {{ csrf_field() }}																					
                        <input type="hidden" name="_method" value="PUT">														
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="form-label">City Name *</label>
                            <input type="text" class="form-control" id="city_name" name="city_name" placeholder="City Name" value="{{ $key->city_name }}" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status *</label>
                            <select class="selectize-input items full has-options has-items" name="status" id="status">
                                <option value="">--- select status ---</option>
                                <option value="1" <?php $sel=($key->status == '1') ? " selected " : ""; echo $sel; ?>>Active</option>
                                <option value="0" <?php $sel=($key->status == '0') ? " selected " : ""; echo $sel; ?>>Not Active</option>
                            </select>
                        </div>

                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $profile->user_id; ?>" />
                        <input type="hidden" class="form-control" id="p_id" name="p_id" value="{{ $key->province_id }}" />

                        <div class="form-footer">
                            <button id="btnSubmit" name="btnSubmit" class="btn btn-primary"><i class="fe fe-save"></i>&nbsp;Save</button>
                            <a href="{{ route('city.index') }}" id="btnCancel" name="btnCancel" class="btn btn-secondary"><i class="fe fe-rotate-ccw"></i>&nbsp;Cancel</a>
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

    $('#frmAddCity').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        if ( $('#city_name').val() == '' || $('#status').val() =='' ) {
            bootbox.alert("Fill in all required data", function(){ 
            });
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
                        url: "{{ config('app.url') }}/admin/city/<?php echo $role_id; ?>",
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
                                window.location.href = "{{ route('city.index') }}";                    
                                } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){ 
                                        window.location.href = "{{ route('city.index') }}";                    
                                    });				
                                }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            //alert(myJSON);
                            console.log(myJSON);
                            bootbox.alert("Something goes wrong, please check again 2", function(){ 
                                window.location.href = "{{ route('city.index') }}";                    
                            });											
                        }                                        
                    });                    
                }
            }
        });
    });

</script>


@endsection