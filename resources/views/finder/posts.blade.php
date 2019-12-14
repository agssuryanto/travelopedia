@extends('layouts.finder')
@section('content')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>New Posts</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <form id="frmProfile" name="frmProfile">
            <div class="row">
                <div class="col-md-6 col-lg-6 pt-3">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="form-label">Caption</label>
                        <input class="form-control" id="caption" name="caption" placeholder="caption" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="5" id="text_currator" name="text_currator"></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 pt-3">
                    <div class="form-group">
                        <img id="img_preview" src="{{ asset('images/preview.jpg') }}" style="max-width: 250px; max-height: 250px;" alt="profile image">
                        <br /><br />
                        <input onchange="readURL(this)" type="file" style="font-size: 12px;" id="picture_profile" name="picture_profile" class="col-xs-10 col-sm-5" accept="image/gif, image/jpeg, image/png">
                        <input type="hidden" id="id" name="id" value="<?php echo $data['profile']->user_id; ?>" />
                        <br /><br />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 pt-3">
                    <div class="form-footer">
                        <button id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

            function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('#img_preview').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
			}

</script>

@endsection
