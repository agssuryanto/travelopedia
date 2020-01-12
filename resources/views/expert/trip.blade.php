@extends('layouts.expert')
@section('content')

<div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">My Trip</h3>
                    <a style="margin-left: 5%;" href="{{ route('expert.create') }}" class="btn btn-primary"><i class="fe fe-settings"></i>&nbsp;Create Trip</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Trip Name</th>
                            <th>Status</th>
                            <th class="no-sort"></th>
                            <th class="no-sort"></th>
                            <th class="no-sort"></th>
                        </tr>
                      </thead>
                      <tbody>

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
