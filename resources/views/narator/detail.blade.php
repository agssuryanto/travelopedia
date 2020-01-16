@extends('layouts.narator')
@section('content')

<div class="page">
    <form id="frmUpdatenarasi" name="frmUpdatenarasi" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <?php
                    $datax = $data['posts']->narasi[0];
                    $profileImg = ( $datax->avatar != '' ) ? $datax->avatar : config('app.url')."/images/no_image_available.png";
                ?>
                <img src="<?php echo $profileImg; ?>" class="profile-image rounded-image mb-3" alt="profile image">
                <h6>Uploader : {{ $datax->name }}</h6>
            </div>
            <div class="col-md-6 mx-auto pt-3 text-left">
                <p>{{ $datax->caption }}</p>
                <img src="<?php echo $datax->image; ?>" width="250" class="mb-3" alt="profile image">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <textarea class="form-control" id="wysiwyg" name="wysiwyg">{{ $datax->narasi }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="tags">Tags:</label>
                <input type="text" class="form-control" id="tags" name="tags" value="{{ $datax->tags }}">
                <input type="hidden" class="form-control" id="posts_id" name="posts_id" value="{{ $datax->posts_id }}">
                <input type="hidden" class="form-control" id="narasi_id" name="narasi_id" value="{{ $datax->id }}">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $data['profile']->user_id }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex row justify-content-center py-3">
                    <button style="width: 150px" id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block"><i class="fe fe-camera"></i>&nbsp;Update Narasi</button>
                    &nbsp;&nbsp;
                    <a href="{{ route('narator.home') }}" class="btn btn-secondary"><i class="fe fe-rotate-ccw"></i>&nbsp;Cancel</a>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
  var konten = document.getElementById("wysiwyg");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;

            $('#frmUpdatenarasi').on('submit', function(e) {
                e.preventDefault();
                var content = CKEDITOR.instances.wysiwyg.getData();
                var data = new FormData(this);
                data.append('_token', '{{ csrf_token() }}' );
                data.append('wysiwyg', content );
                $.ajax({
					url: "{{ route('narator.store') }}",
                    type: 'POST',
					method: 'POST',
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
                        var myJSON = JSON.stringify(data);
                        bootbox.alert("Update Narasi success", function(){
                            window.location.href = "{{ route('narator.home') }}";
                        });
                    },
                    error: function (request, status, error) {
                        var myJSON = JSON.stringify(request);
                        alert(myJSON);
                        bootbox.alert("Something goes wrong, please check again 2", function(){
                            window.location.href = "{{ route('narator.home') }}";
                        });
                    }
                });
            });

</script>
@endsection
