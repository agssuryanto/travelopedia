@extends('layouts.expert')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="px-5 py-3" style="border: 1px solid #ccc; border-radius: 5px; background-color: white;">
                <p>Trip Name: {{ $data['posts']->trip[0]->trip_name }}</p>
                <p>Trip Name: {{ $data['posts']->trip[0]->trip_desc }}</p>
                <p>Location Finder: {{ $data['posts']->trip[0]->name }}</p>
                <span class="avatar avatar-xl" style="background-image: url({{ $data['posts']->trip[0]->avatar }})"></span>
            </div>
        </div>
        <div class="col-md-6">
            <img style="max-width: 350px" src="{{ $data['posts']->trip[0]->image }}" alt="{{ $data['posts']->trip[0]->trip_name }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trip Rundown</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Activity</th>
                                <th class="no-sort"></th>
                            </tr>
                            </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach ( $data['posts']->rundown as $rundown )
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $rundown->rundown_title }}</td>
                                    <td>{{ $rundown->rundown_activity }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        // require(['datatables', 'jquery'], function(datatable, $) {
                        //     $('.datatable').DataTable();
                        // });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
