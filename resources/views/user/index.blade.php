@extends('layouts.user')
@section('content')

<div class="my-3 my-md-5">
  <div class="container"  style="min-height: 375px;">
    <div class="page-header">
        <div class="col-lg-12 col-md-12">

            <?php
                print "<pre>";
                print_r($profile);
                print "</pre>";
                $user_profile = $profile->personal;
                print "<pre>";
                print_r($user_profile);
                print "</pre>";
            ?>

        </div>
    </div>
</div>


@endsection
