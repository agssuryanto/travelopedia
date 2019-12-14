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
                        <h3 class="card-title">New Sub District</h3>
                    </div>

                    <div class="card-body">
                    <form id="frmAddCity" name="frmAddCity">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="form-label">Sub District Name *</label>
                            <input type="text" class="form-control" id="subdistrict_name" name="subdistrict_name" placeholder="Sub District Name" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Zip Code *</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status *</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">--- select status ---</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>

                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $profile->user_id; ?>" />
                        <input type="hidden" class="form-control" id="p_id" name="p_id" value="<?php echo $province; ?>" />
                        <input type="hidden" class="form-control" id="c_id" name="c_id" value="<?php echo $city; ?>" />
                        <input type="hidden" class="form-control" id="d_id" name="d_id" value="<?php echo $district; ?>" />

                        <div class="form-footer">
                            <button id="btnSubmit" name="btnSubmit" class="btn btn-primary"><i class="fe fe-save"></i>&nbsp;Save</button>
                            <a href="{{ route('subdistrict.index') }}" id="btnCancel" name="btnCancel" class="btn btn-secondary"><i class="fe fe-rotate-ccw"></i>&nbsp;Cancel</a>
                        </div>
                    </form>
                    </div>
                </div>
        </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });

    $(document).ready(function() {
        $('.select2').select2();
    });

    $('#frmAddCity').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        if ( $('#subdistrict_name').val() == '' || $('#status').val() =='' ) {
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
                        url: "{{ route('subdistrict.store') }}",
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
                                        window.location.href = "{{ route('subdistrict.index') }}";
                                    });
                                }
                            } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){
                                        window.location.href = "{{ route('subdistrict.index') }}";
                                    });
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            alert(myJSON);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('subdistrict.index') }}";
                            });
                        }
                    });
                }
            }
        });
    });

</script>


@endsection
