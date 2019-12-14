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
      <div class="row row-cards row-deck">
            <div class="col-md-12 col-lg-12 pt-3">
                <form id="frmProfile" name="frmProfile">
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

                            <div class="form-footer">
                                <button id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                </form>
            </div>
      </div>
    </div>
</div>


@endsection
