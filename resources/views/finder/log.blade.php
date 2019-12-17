@extends('layouts.finder')
@section('content')

<div class="col-12">

                <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">User Posts</h3>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                  </div>
                </div>
              </div>

@endsection
