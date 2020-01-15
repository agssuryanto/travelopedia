@extends('layouts.narator')
@section('content')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>My Work</h3>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row row-cards row-deck">
        @foreach ( $data['posts']->posts as $post )

          <div class="col-sm-6 col-xl-3 py-2">
            <div class="card">
              <a href="#"><img style="max-height: 150px;" class="card-img-top" src="{{ $post->image }}" alt={{ $post->caption }}></a>
              <div class="card-body d-flex flex-column">
                <h4>{{ $post->caption }}</h4>
                <a href="/" class="text-default">More info ...</a>
                <!-- div class="text-muted">{{ $post->text_currator }}</div -->
                <div class="d-flex align-items-center pt-5 mt-auto">
                  <img class="rounded-circle mr-3" src="{{ $post->avatar }}" style="max-width: 32px; max-height: 32px;">
                  <div>
                      <a href="./profile.html" class="text-default">{{ $post->name }}</a>
                      <small class="d-block text-muted">3 days ago</small>
                  </div>
                  <div class="ml-auto text-muted text-center">
                      <i class="icon ion-md-heart-empty"></i>
                      <small class="d-block text-muted">1234567890</small>
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
