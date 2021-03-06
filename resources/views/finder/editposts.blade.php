@extends('layouts.finder')
@section('content')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Edit Posts</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <form id="frmProfile" name="frmProfile">
            <div class="row">
                <div class="col-md-8 col-lg-8 pt-3">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="posts_id" value="{{ $data['post']->posts[0]->id }}">

                    <div class="form-group">
                        <label class="form-label">Caption</label>
                        <input class="form-control" id="caption" name="caption" placeholder="caption" value="{{ $data['post']->posts[0]->caption }}" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="5" id="wysiwyg" name="wysiwyg">{{ $data['post']->posts[0]->text_currator }}</textarea>
                    </div>

                    <div class="form-group row">
                        <div class="d-flex col-sm-12">
                        <input type="hidden" class="form-control" id="latitude" name="latitude" />
                        <input type="hidden" class="form-control" id="longitude" name="longitude" />
                        <input type="hidden" class="form-control" id="ip_address" name="ip_address" />
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $data['profile']->user_id }}" />
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-lg-4 pt-3">
                    <div class="form-group">
                        <img id="img_preview" src="{{ $data['post']->posts[0]->image }}" style="max-width: 250px; max-height: 250px;" alt="profile image">
                        <br /><br />
                        <input onchange="readURL(this)" type="file" style="font-size: 12px;" id="picture_profile" name="picture_profile" class="col-xs-10 col-sm-5" accept="image/gif, image/jpeg, image/png">
                        <br /><br />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 pt-3">
                    <div class="form-footer">
                        <img style="width: 300px; margin-top: -250px; margin-left: 30%; position: fixed; z-indoex: 1;" src="{{ config('app.url') }}/assets/images/loading-gear.gif" id="loading-gear" name="loading-gear" />
                        <button id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

    window.addEventListener("load", function() {
        $('#loading-gear').hide();
        $.getJSON('https://ipapi.co/json/', function(data) {
                console.log(JSON.stringify(data, null, 2));
                $("#latitude").val(data.latitude);
                $("#longitude").val(data.longitude);
                $("#ip_address").val(data.ip);
            });
    });

    function readURL(input) {
	    if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#img_preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

  var konten = document.getElementById("wysiwyg");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;


            $('#frmProfile').on('submit', function(e) {
                e.preventDefault();
                var content = CKEDITOR.instances.wysiwyg.getData();
                if ($("#caption").val() == '' ) {
                    alert('Caption harus di isi!');
                    $("#caption").setfocus();
                    return false;
                }

                if (content == '') {
                    alert('Description harus di isi!');
                    $("#wysiwyg").setfocus();
                    return false;
                }

                var data = new FormData(this);
                data.append('_token', '{{ csrf_token() }}' );
                data.append('text_currator', content );
                $.ajax({
					url: "{{ route('finder.update') }}",
                    type: 'POST',
					method: 'POST',
					data: data,
					cache: false,
					contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#loading-gear').show();
                    },
					success: function(data){
                        var myJSON = JSON.stringify(data);
                        // console.log(myJSON);
                        // alert(myJSON);
                        $('#loading-gear').hide();
                        bootbox.alert("Update Picture Profile success", function(){
                            window.location.href = "{{ route('finder.home') }}";
                        });
                    },
                    error: function (request, status, error) {
                        var myJSON = JSON.stringify(request);
                        // console(myJSON);
                        // alert(myJSON);
                        $('#loading-gear').hide();
                        // bootbox.alert("Something goes wrong, please check again 2", function(){
                        //     window.location.href = "{{ route('finder.home') }}";
                        // });
                        bootbox.alert("Update Picture Profile success", function(){
                            window.location.href = "{{ route('finder.home') }}";
                        });

                    }
                });
            });

</script>

@endsection
