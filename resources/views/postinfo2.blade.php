@extends($layouts)
@section('content')


<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            @foreach ( $data['posts']->users as $post )
                <h5>{{ $post->caption }}</h5>
                <img src="{{ $post->image }}" alt="{{ $post->caption }}" style="min-height: 250px;">
            @endforeach
        </div>
        <div class="col-md-8">
            <?php print "Found : ".count($data['trip']->trip); ?>
            @foreach ( $data['trip']->trip as $trip )
                <div style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: white;">
                    <p>{{ $trip->trip_name }}</p>
                    <p>Location Finder :&nbsp;{{ $trip->finder }}</p>
                    <p>Expert Trip :&nbsp;{{ $trip->expert }}</p>
                    <a href="#" class="btn btn-primary">View Rundown</a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 py-5">
            {!! $post->narasi !!}
        </div>
    </div>
</div>

<div class="py-5">&nbsp;</div>
@endsection
