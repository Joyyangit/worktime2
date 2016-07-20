@extends('layouts.dashboard')
@section('title', '编辑反馈')

@section('main')


<form method="POST" action="/feedback/store" onsubmit="$('#feedbackContent').val( $('#summernote').summernote( 'code' ) ); return true;">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="id" value="{{$feedback->id}}">
<input type="hidden" id="feedbackContent" name="row[message]">

<div class="row">
  <div class="col-lg-12">
    <div class="form-group">
      <div id="summernote" height="500">{!!$feedback->message!!}</div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <button type="submit" class="btn btn-danger btn-lg btn-block"> 提 交 </button>
    </div>
    <div class="col-sm-2">
    </div>
</div>

</form>

@stop

@section('js')
<script type="text/javascript">
$(document).ready(function( ) {
  initEditor( "summernote" );
});
</script>
@stop
