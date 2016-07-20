@extends('layouts.dashboard')

@section('title', '任务列表')

@section('main')

<div class="row">
<div class="col-lg-12">
<div class="alert alert-success">

    <form class="form-inline" id="search_servers">
<div class="form-group">

        <label>ID: </label>
        <input itag="val" type="text" name="id" class="form-control">

        <label>标题: </label>
        <input itag="val" type="text" name="server_id" class="form-control">

        <button type="button" class="btn btn-primary margin-right" onclick='
        sajax( "/server/index", get_form_values("search_servers"), function( res ) {
                $("#server-list").html( res );
            });'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> 查询</button>

        <a href="/task/create" class="btn btn-success margin-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加新任务</a>

        <button type="button" class="btn btn-warning margin-right" onclick='taskFilter();'><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> 刷新</button>
</div>
    </form>
</div>
</div>
</div>

<table class="table table-bordered table-striped vertical-middle h-middle">
  <thead id="taskfilter">
    <tr>
        <th width="20">
<input type="checkbox"></th>
        <th width="50">#id</th>
        <th width="80">
<select itag="val" name="search[status]" onchange="taskFilter();">
<option>状态</option>
@include('selection', ['data' => $status, 'slt' => isset($options['status']) ? $options['status'] : 0])
</select>
        </th>
        <th width="80">
<select itag="val" name="search[priority]" onchange="taskFilter();">
<option>优先级</option>
@include('selection', ['data' => $prioritys, 'slt' => isset($options['priority']) ? $options['priority'] : 0])
</select>
        </th>
        <th width="80">
<select itag="val" name="search[caty]" onchange="taskFilter();">
<option>类型</option>
@include('selection', ['data' => $catys, 'slt' => isset($options['caty']) ? $options['caty'] : 0])
</select>
        </th>
        <th class="text-left">标题 </th>
        <th width="80">
<select itag="val" name="search[leader]" onchange="taskFilter();">
<option>负责人</option>
@include('selection-users', ['data' => $users, 'slt' => isset($options['leader']) ? $options['leader'] : 0])
</select>
        </th>
        <th width="80">
<select itag="val" name="search[department]" onchange="taskFilter();">
<option>归属</option>
@include('selection', ['data' => $departments, 'slt' => isset($options['department']) ? $options['department'] : 0])
</select>
        </th>
        <th width="80">
<select itag="val" name="search[tag]" onchange="taskFilter();">
<option>计划</option>
@include('selection-users', ['data' => $tags, 'slt' => isset($options['tag']) ? $options['tag'] : 0])
</select>
        </th>
        <th width="80">
<select itag="val" name="search[author]" onchange="taskFilter();">
<option>报告人</option>
@include('selection-users', ['data' => $users, 'slt' => isset($options['author']) ? $options['author'] : 0])
</select>
        </th>
        <th width="250">修改日期</th>
    </tr>
  </thead>
  <tbody id="tasklist">
@include('task-list-content')
  </tbody>
</table>

<div class="row">

  <div class="col-lg-12">
<div class="form-inline" id="changemoreform">
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">状态：</span>
<select itag="val" name="changeto[status]" class="form-control">
<option value="0">不修改</option>
@include('selection', ['data' => Config::get('worktime.status'), 'slt' => 0])
</select>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">优先级：</span>
<select itag="val" name="changeto[priority]" class="form-control">
<option value="0">不修改</option>
@include('selection', ['data' => Config::get('worktime.priority'), 'slt' => 0])
</select>
    </div>
    </div>


    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">类型：</span>
<select itag="val" name="changeto[caty]" class="form-control">
<option value="0">不修改</option>
@include('selection', ['data' => Config::get('worktime.caty'), 'slt' => 0])
</select>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">负责人：</span>
<select itag="val" name="changeto[leader]" class="form-control">
<option value="0">不修改</option>
@include('selection-users', ['data' => $users, 'slt' => 0])
</select>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">归属：</span>
<select itag="val" name="changeto[department]" class="form-control">
<option value="0">不修改</option>
@include('selection', ['data' => Config::get('worktime.department'), 'slt' => 0])
</select>
    </div>
    </div>

    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">计划：</span>
<select itag="val" name="changeto[tag]" class="form-control">
<option value="0">不修改</option>
@include('selection-users', ['data' => $tags, 'slt' => 0])
</select>
    </div>
    </div>

    <button onclick="changeMore( );" class="btn btn-danger">批量修改</button>

</div>

  <p></p>
  </div>

</div>

@stop

@section('js')

<script type="text/javascript">
function taskFilter( ) {
  var s = get_form_values( "taskfilter" );
  console.log(s);
  $.ajax({
    data: s,
    type: "GET",
    url: '/task/index',
    cache: false,
    success: function( res ) {
      $("#tasklist").html( res );
    }
  });
}

setInterval( "taskFilter( );", 1000 * 60 * 5 );

function changeMore( ) {
  var s = get_form_values( "tasklist" );
  if ("" == s) {
    alert( "没有选择任务" );
    return;
  }
  s += "&" + get_form_values( "changemoreform" );

  console.log( s );

  $.ajax({
    data: s,
    type: "GET",
    url: '/task/index',
    cache: false,
    success: function( res ) {
      $("#tasklist").html( res );
    }
  });
}
</script>
@stop
