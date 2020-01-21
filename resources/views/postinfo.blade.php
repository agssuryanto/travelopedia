@extends($layouts)
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

                @if ( count($data['accomodation']->posts) > 0 )
                    <?php $x = ""; ?>
                    @foreach ( $data['accomodation']->posts as $accomodation )
                        <?php
                            if ( $x != $accomodation->name )
                            {
                                $x = $accomodation->name;
                        ?>
                                <div class="d-flex row px-3 py-3"><h3>{{ $accomodation->name }}</h3></div>
                                <div class="py-3">
                                    <span>
                                        @if ( $accomodation->image != "")
                                            <img style="max-width: 64px;" src="{{ $accomodation->image }}" alt="{{ $accomodation->posts_text }}">
                                        @endif
                                        {{ $accomodation->posts_text }}
                                    </span>
                                </div>
                        <?php
                            } else {
                        ?>
                                <div class="py-3">
                                    <span>
                                        @if ( $accomodation->image != "")
                                            <img style="max-width: 64px;" src="{{ $accomodation->image }}" alt="{{ $accomodation->posts_text }}">
                                        @endif

                                        {{ $accomodation->posts_text }}
                                    </span>
                                </div>

                        <?php
                            }
                        ?>
                    @endforeach
                @endif
          </div>
        @endforeach

      </div>
    </div>

@endsection
