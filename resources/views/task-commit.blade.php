@extends('layouts.dashboard')
@section('title', '提交任务')

@section('main')


<form method="POST" action="/task/store" onsubmit="return oncommit( );">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" id="taskContent" name="row[content]">
<input type="hidden" name="id" value="{{$task->id}}" />
<div class="row">
  <div class="col-sm-5">
    <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon">标题：</span>
      <input id="task-title" name="row[title]" type="text" class="form-control" value="{{'' == $task->title ? '没有标题的标题' : $task->title}}">
    </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">类型：</span>
        <select name="row[caty]" class="form-control">
@include('selection', ['data' => Config::get('worktime.caty'), 'slt' => $task->caty])
        </select>
    </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">优先级：</span>
        <select name="row[priority]" class="form-control">
@include('selection', ['data' => Config::get('worktime.priority'), 'slt' => $task->priority])
        </select>
    </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-2">
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">负责人：</span>
        <select name="row[leader]" class="form-control">
@include('selection-users', ['data' => $users, 'slt' => $task->author])
        </select>
    </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">归属：</span>
        <select name="row[department]" class="form-control">
@include('selection', ['data' => Config::get('worktime.department'), 'slt' => $task->department])
        </select>
    </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">计划：</span>
        <select name="row[tag]" class="form-control">
@include('selection-users', ['data' => $tags, 'slt' => $task->tag])
        </select>
    </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-group">
      <textarea id="summernote" height="500">{!!$task->content!!}</textarea>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <button type="submit" class="btn btn-danger btn-lg btn-block"> 提 交 </button>
    </div>
</div>

</form>

<p></p>

@stop


@section('js')
<script type="text/javascript">
$(document).ready(function( ) {
  initEditor( "summernote" );
});

function oncommit( ) {
  $('#taskContent').val( $('#summernote').summernote( 'code' ) );
  return true;
}
</script>
@stop