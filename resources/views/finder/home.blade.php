@extends('layouts.finder')
@section('content')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>My Location</h3>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row row-cards row-deck">
        @foreach ( $data['posts']->posts as $post )

          <div class="col-sm-6 col-xl-3">
            <div class="card">
              <a href="#"><img style="max-height: 150px;" class="card-img-top" src="{{ $post->image }}" alt={{ $post->caption }}></a>
              <div class="card-body d-flex flex-column">
                <a href="#" title="click for more info"><h4>{{ $post->caption }}</h4></a>
                <?php
                    $narasi = true;
                    $akomodasi = true;
                ?>
                @foreach ( $data['narasi']->users as $narasi )
                    @if ( ($narasi->post_id == $post->post_id) && $post->text_currator == "" )
                        <?php $narasi = false; ?>
                        @break
                    @endif
                @endforeach

                @foreach ( $data['no_accomodation']->posts as $accomodation )
                    @if ( $accomodation->post_id == $post->post_id)
                        <?php $akomodasi = false; ?>
                        @break
                    @endif
                @endforeach

                <div class="d-flex row text-muted text-left pl-3">
                    @if ( !$narasi )
                        <a href="{{ config('app.url') }}/finder/edit/{{ $post->post_id }}" title="belum ada narasi"><ion-icon name="clipboard" style="color: #bf4458;"></ion-icon></<ion-icon></a>
                    @endif
                    &nbsp;
                    @if ( !$akomodasi )
                        <a href="{{ config('app.url') }}/finder/edit/{{ $post->post_id }}" title="belum ada akomodasi"><ion-icon name="home" style="color: #bf4458;"></ion-icon></small></a>
                    @endif

                    @if ( $narasi && $akomodasi )
                        <a href="#"><ion-icon name="homex"></ion-icon></small></a>
                    @endif
                </div>

                <div class="d-flex align-items-center pt-5 mt-auto">
                  <img class="rounded-circle mr-3" src="{{ $post->avatar }}" style="max-width: 32px; max-height: 32px;">
                  <div>
                      <small>{{ $post->name }}</small>
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
