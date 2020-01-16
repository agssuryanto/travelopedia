@extends('layouts.welcome')
@section('content')


    <div class="container py-5">
      <div class="row row-cards row-deck">

        @foreach ( $data['posts']->users as $post )

          <div class="col-md-8 col-xl-8">
            {!! $post->narasi !!}
          </div>

          <div class="col-md-4">
                <h5>{{ $post->caption }}</h5>
                <img src="{{ $post->image }}" alt="{{ $post->caption }}" style="min-height: 250px;">
                <h5 class="py-5">{{ $post->tags }}</h5>
          </div>
        @endforeach

      </div>
    </div>

@endsection
