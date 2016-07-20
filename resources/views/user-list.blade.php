@extends('layouts.dashboard')
@section('title', '成员管理')

@section('main')


<div class="row">
	<div class="col-lg-6">
		<table class="table table-bordered table-striped table-hover vertical-middle">
			<thead>
				<tr>
                    <th width="50">#id</th>
                    <th width="80">
Email
                    </th>
                    <th width="80">
姓名
                    </th>
                    <th>
操作
                    </th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($users as $user) { ?>
<tr>
	<td><?php echo $user->id; ?></td>
    <td><?php echo $user->email; ?></td>
	<td><?php echo $user->name; ?></td>
	<td>
<a href="/user/edit/{{$user->id}}" class="btn btn-link">修改</a>
	</td>
</tr>
<?php } ?>
			</tbody>
		</table>

	</div>
</div>

@stop