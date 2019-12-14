@extends('layouts.admin')
@section('content')

<div class="col-12">

                <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">User Network Info</h3>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Log ID</th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>Timezone</th>
                                <th>Browser</th>
                                <th>IP Address</th>
                                <th>ISP</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ( $data->users as $key => $users )
                                {
                            ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><a href="{{ config('app.url') }}/admin/user_log_detail/{{ $users->log_id }}">{{ $users->log_id }}</a></td>
                                        <td>{{ $users->country }}</td>
                                        <td>{{ $users->region_name }}</td>
                                        <td>{{ $users->timezone }}</td>
                                        <td>{{ $users->browser }}</td>
                                        <td>{{ $users->ip_address }}</td>
                                        <td>{{ $users->isp }}</td>
                                        <td>&nbsp;</td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <script>
                      require(['datatables', 'jquery'], function(datatable, $) {
                      	    $('.datatable').DataTable();
                      	  });
                    </script>
                  </div>
                </div>
              </div>

@endsection
