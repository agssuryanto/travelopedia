@extends('layouts.narator')
@section('content')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Available Posts</h3>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row row-cards row-deck">
        @foreach ( $data['posts']->users as $post )

          <div class="col-sm-6 col-xl-3 py-2">
            <div class="card">
              <a href="#"><img style="max-height: 150px;" class="card-img-top" src="{{ $post->image }}" alt={{ $post->caption }}></a>
              <div class="card-body d-flex flex-column">
                <h4>{{ $post->caption }}</h4>
                <a href="{{ config('app.url') }}/narator/create/{{ $post->post_id }}" class="text-default">Create Info ...</a>
                <div class="d-flex align-items-center pt-5 mt-auto">
                  <img class="rounded-circle mr-3" src="{{ $post->avatar }}" style="max-width: 32px; max-height: 32px;">
                  <div>
                      {{ $post->name }}
                  </div>
                </div>
              </div>
            </div>
          </div>

        @endforeach

      </div>
    </div>
</div>


@endsection
