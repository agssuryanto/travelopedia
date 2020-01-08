@extends('layouts.finder')
@section('content')

<div class="page">
<div class="col-12">

                <div class="card">
                  <div class="card-header">
                  <h6 class="card-title">User Log Activity</h6>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                        <tr>
                          <th>No</th>
                          <th>Date</th>
                          <th>Activity</th>
                          <th>Reff ID</th>
                          <th>&nbsp;</th>
                        </tr>
                        </tr>
                      </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach ($data['log']->users as $logs => $log)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $log->updated_at }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->reff_id }}</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php $no++; ?>
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
            </div>

@endsection
