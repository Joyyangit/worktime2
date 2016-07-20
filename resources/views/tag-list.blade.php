@extends('layouts.dashboard')
@section('title', '标签/计划')

@section('main')

<div class="row">
	<div class="col-lg-12">
<div class="panel panel-default">
    <div class="panel-heading">
        添加计划
    </div>
    <div class="panel-body">
<form class="form-inline" role="form" method="POST" action="/tag/store">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
<label>名称：</label>
<input type="text" class="form-control" name="row[name]" />
</div>
<div class="form-group">
<label>开始：</label>
<input name="row[t_start]" class="form-control" type="text" onclick="showcalendar(event, this, true)">
</div>
<div class="form-group">
<label>结束：</label>
<input name="row[t_end]" class="form-control" type="text" onclick="showcalendar(event, this, true)">
</div>

<button type="submit" class="btn btn-primary">添加</button>

</form>

    </div>
    <!-- /.panel-body -->
</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered table-striped table-hover vertical-middle">
			<thead>
				<tr>
                    <th width="50">#id</th>
                    <th width="80">
名称
                    </th>
                    <th width="200">
开始时间
                    </th>
                    <th width="200">
结束时间
                    </th>
                    <th>
操作
                    </th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($tags as $tag) { ?>
<tr>
	<td><?php echo $tag->id; ?></td>
    <td><?php echo $tag->name; ?></td>
	<td><?php echo $tag->t_start; ?></td>
	<td><?php echo $tag->t_end; ?></td>
	<td>
<button data-toggle="modal" data-target="#tagModifyModal"
data-id="{{$tag->id}}"
data-name="{{$tag->name}}"
data-t_start="{{$tag->t_start}}"
data-t_end="{{$tag->t_end}}"
class="btn btn-link">修改</button>
<a href="/tag/show/{{$tag->id}}" class="btn btn-link">查看统计</a>
	</td>
</tr>
<?php } ?>
			</tbody>
		</table>

	</div>
</div>

<div class="modal fade" id="tagModifyModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">修改计划</h4>
      </div>
      <form method="POST" action="/tag/store">
      <div class="modal-body">
          <input type="hidden" name="id">
<div class="input-group input-group-lg">
<span class="input-group-addon">名称：</span>
<input type="text" class="form-control" name="row[name]">
</div>
<p></p>
<div class="input-group input-group-lg">
<span class="input-group-addon">开始：</span>
<input type="text" class="form-control" name="row[t_start]" onclick="showcalendar(event, this)">
</div>
<p></p>
<div class="input-group input-group-lg">
<span class="input-group-addon">结束：</span>
<input type="text" class="form-control" name="row[t_end]" onclick="showcalendar(event, this)">
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
        <button type="submit" class="btn btn-primary">保 存</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function( ) {
  $('#tagModifyModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    var els = modal.find('.modal-body input');
    var abc = ["id", "name", "t_start", "t_end"];
    for (var i = 0; i < abc.length; i++) {
      $(els[i]).val( button.data(abc[i]) )
    };
  });
});
</script>

@stop