@extends('layouts.admin')
@section('content')

<div class="my-3 my-md-5" style="min-height: 375px;">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Dashboard
      </h1>
      <?php
        $profile = Session::get('profile');
        print "<pre>";
        print_r($profile);
        print "</pre>";
      ?>
    </div>
  </div>
</div>

@endsection