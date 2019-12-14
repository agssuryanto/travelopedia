@extends('layouts.admin')
@section('content')

<?php
    $profile = Session::get('profile');
?>
<style>
#map {
        margin: auto;
        height: 100%;
        width: 100%;
    }
</style>

<div class="my-3 my-md-5">
  <div class="container"  style="min-height: 375px;">
    <div class="page-header">

        <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Posts</h3>
                    </div>

                    <div class="card-body">
                    <?php
                        foreach ($data['popular']->posts as $post)
                        {
                    ?>
                    <form id="frmEditPost" name="frmEditPost">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div id="map"></div>
                                <script>
                                    function initMap() {
                                        var uluru = {lat: <?php echo $post->lat ; ?>, lng: <?php echo $post->long; ?>};
                                        var map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: 8,
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
                            <div class="col-md-6 col-lg-6">
                                <img src="{{ $post->image }}" alt="{{ $post->caption }}" id="map">
                            </div>
                        </div>

                        <br />

                        <div class="form-group">
                            <label class="form-label">Caption Name</label>
                            <input type="text" class="form-control" id="caption_name" name="caption_name" placeholder="Caption Name" value="{{ $post->caption }}" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="10" id="text_currator" name="text_currator">{{ $post->text_currator }}</textarea>
                        </div>

                        <input type="hidden" class="form-control" id="post_id" name="post_id" value="<?php echo $post->id; ?>" />

                        <div class="form-footer">
                            <button id="btnSubmit" name="btnSubmit" class="btn btn-primary"><i class="fe fe-save"></i>&nbsp;Save</button>
                            <a href="{{ route('posts.index') }}" id="btnCancel" name="btnCancel" class="btn btn-secondary"><i class="fe fe-rotate-ccw"></i>&nbsp;Cancel</a>
                        </div>
                    </form>
                    <?php
                        }
                    ?>
                    </div>
                </div>
        </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    $('#frmEditPost').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);

        bootbox.confirm({
            message: "Confirmation. All data is correct? ",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if ( result ) {

                    $.ajax({
                        url: "{{ config('app.url') }}/admin/posts/<?php echo $post->id ?>",
                        type: 'POST',
                        method: 'POST',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            var myJSON = JSON.stringify(data);
                            //alert(myJSON);
                            if ( data != '' ) {
                                if ( data['status'] == true ) {
                                    bootbox.alert("Update data success!", function(){
                                        window.location.href = "{{ route('posts.index') }}";
                                    });
                                } else {
                                    bootbox.alert("Something goes wrong, please check again 1", function(){
                                        window.location.href = "{{ route('posts.index') }}";
                                    });
                                }
                            }
                        },
                        error: function (request, status, error) {
                            var myJSON = JSON.stringify(request);
                            alert(myJSON);
                            bootbox.alert("Something goes wrong, please check again 2", function(){
                                window.location.href = "{{ route('posts.index') }}";
                            });
                        }
                    });
                }
            }
        });
    });

</script>


@endsection
