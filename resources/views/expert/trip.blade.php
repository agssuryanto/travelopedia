@extends('layouts.expert')
@section('content')

<div class="container my-5">
    <div class="col-md-12">

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
                            <th>Description</th>
                            <th>Image</th>
                            <th>Finder Caption</th>
                            <th>Finder Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ( $data['posts']->trip as $trip )
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $trip->trip_name }}</td>
                                <td>{{ $trip->trip_desc }}</td>
                                <td><img src="{{ $trip->image }}" style="max-width: 100px;"></td>
                                <td>{{ $trip->caption }}</td>
                                <td>{{ $trip->location_finder }} <span class="avatar avatar-sm" style="background-image: url({{ $trip->avatar }})"></span></td>
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
