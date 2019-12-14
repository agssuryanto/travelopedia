@extends('layouts.admin')
@section('content')

<div class="col-12">

                <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">User Activity</h3>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>User ID</th>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>IP Address</th>
                            <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach ( $data->users as $key => $users )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img src="{{ $users->avatar }}" class="rounded-circle" style="max-width: 32px; max-height: 32px">
                                            &nbsp;
                                            {{ $users->name }}
                                        </td>
                                        <td>{{ $users->created_at }}</td>
                                        <td>{{ $users->activity }}</td>
                                        <td>{{ $users->ip_address }}</td>
                                        <td>&nbsp;</td>
                                    </tr>
                            @endforeach
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
