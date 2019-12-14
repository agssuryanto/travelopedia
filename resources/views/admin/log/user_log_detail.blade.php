@extends('layouts.admin')
@section('content')

<style>
#map {
        margin: auto;
        height: 100%;
        width: 100%;
    }
</style>

<?php $profile = Session::get('profile'); ?>

<div class="my-3 my-md-5">
    <div class="container"  style="min-height: 375px;">
        <div class="page-header">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Log Detail</h3>
                    </div>

                    <form>
                        <?php
                            foreach ( $data->users as $key => $users )
                            {
                        ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img src="{{ $users->avatar }}" class="rounded-circle" style="max-width: 32px; max-height: 32px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="form-label">User Name</label>
                                        <input type="text" readonly value="{{ $users->name }}" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label">Country Name</label>
                                        <input type="text" readonly value="{{ $users->country }}" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label">Region Name</label>
                                        <input type="text" readonly value="{{ $users->region_name }}" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label">ISP Name</label>
                                        <input type="text" readonly value="{{ $users->isp }}" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label">Timezone</label>
                                        <input type="text" readonly value="{{ $users->timezone }}" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label">IP Address</label>
                                        <input type="text" readonly value="{{ $users->ip_address }}" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label">Browser</label>
                                        <input type="text" readonly value="{{ $users->browser }}" class="form-control" id="user_name" name="user_name" placeholder="User Name" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label">User Agent</label>
                                        <textarea class="form-control" readonly>{{ $users->user_agent }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="map"></div>
                                    <script>
                                        function initMap() {
                                            var uluru = {lat: <?php echo $users->lat ; ?>, lng: <?php echo $users->lon; ?>};
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 12,
                                                center: uluru
                                            });
                                            var marker = new google.maps.Marker({
                                                position: uluru,
                                                map: map
                                            });
                                        }
                                    </script>
                                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLi7JyOMCGj7w3aREo9q8jR4pCWmnwRNA&callback=initMap">
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ route('user.network') }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
