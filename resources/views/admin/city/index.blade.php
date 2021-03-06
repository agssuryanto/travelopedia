@extends('layouts.admin')
@section('content')

<div class="my-3 my-md-5">
  <div class="container"  style="min-height: 375px;">
    <div class="page-header">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-16 col-md-12">
                        <br />
                        <h3>&#8195;City</h3>
                    </div>
                </div>
                <!-- div class="card-header" -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6" style="margin-left: 25px;">
                            <div class="form-group">
                                <input type="hidden" id="selected_city" name="selected_city">
                                <select onchange="change_pid()" class="form-control" style="min-width: 100px;" name="province" id="province">
                                    <?php
                                        $roles = count($data['provinces']->province);
                                        if ( count($data['provinces']->province) > 0 )
                                        {
                                            echo "<option value=''>--- select province ---</option>";
                                            foreach ($data['provinces']->province as $key )
                                            {
                                                echo "<option value=".$key->id.">".$key->province_name."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <a id="addCity" name="addCity" href="" class="btn btn-primary"><i class="fe fe-settings"></i>&nbsp;Add</a>
                        </div>
                    </div>
                <!-- /div -->

                <div class="table-responsive">
                    <table id="tblcity" name="tblcity" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>City Name</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script>
                        $(function () {
                            //Initialize Select2 Elements
                            $('.select2').select2()
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('.select2').select2()
                            $('#tblcity > thead > tr > th').removeClass('sorting_asc');
                        });
                        require(['datatables', 'jquery'], function(datatable, $) {
                      	    $('.datatable').DataTable();
                      	});
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#addCity').hide();
    });

    function change_pid(){
        var pid = $('#province').val();
        var url = "<?php echo config('app.url') ?>/admin/city/"+pid;
        $('#addCity').attr('href', url);
        if ( pid != '' ) {
            $('#addCity').show();
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
                        $("#tblcity").find("tr:gt(0)").remove();
                            $('#selected_city').val(pid);
                            var province = data.province;
                            if ( province.length > 0 ) {
                                var xx = 0;
                                $.each(province, function(idx, obj) {
                                    xx++;
                                    var status = 'In Active';
                                    if ( obj.status == '1' ) {
                                        status = 'Active';
                                    }
                                    var edit = "<a href=<?php echo config('app.url'); ?>" + "/admin/city/" + obj.id + "/edit class='icon'><i class='fe fe-edit'></i></a>";
                                    var del = "<a href=<?php echo config('app.url'); ?>" + "/admin/city/delete/" + obj.id + " class='icon'><i class='fe fe-trash'></i></a>";
                                    $('#tblcity > tbody:last-child').append('<tr><td>'+xx+'</td><td>'+obj.city_name+'</td><td>'+status+'</td><td>'+edit+'</td><td>'+del+'</td></tr>');
                                });
                            }
                    } else {
                            bootbox.alert("Something goes wrong, please check again 1", function(){
                                window.location.href = "{{ route('city.index') }}";
                            });
                    }
                },
                error: function (request, status, error) {
                    var myJSON = JSON.stringify(request);
                    //alert(myJSON);
                    bootbox.alert("Something goes wrong, please check again 2", function(){
                        window.location.href = "{{ route('city.index') }}";
                    });
                }
            });

        } else {
            $('#addCity').hide();
        }
    }
</script>

@endsection
