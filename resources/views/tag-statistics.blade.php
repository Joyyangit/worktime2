@extends('layouts.dashboard')
@section('title', $tag->name)

@section('main')

<h1>{{$tag->name}} [{{$tag->t_start}}] - [{{$tag->t_end}}]</h1>
<hr />

<?php
$departments = Config::get('worktime.department');
?>

<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
                    <th width="100">#id</th>
                    <th>进度</th>
                    <th width="80">总数量</th>
                    <th width="80">处理中</th>
                    <th width="80">已解决</th>
                    <th width="80">可测试</th>
                    <th width="80">完成</th>
				</tr>
			</thead>
			<tbody>
<tr>
    <td>全部</td>
    <td>
<?php
$total = array_sum($s_all);
$p = 0;
if ($total > 0) {
    $p = intval($s_all[50] / $total * 10000) / 100;
}
?>
@include('progress', ['p' => $p])
    </td>
    <td><?php echo $total; ?></td>
    <td><?php echo $s_all[10] + $s_all[30]; ?></td>
    <td><?php echo $s_all[20]; ?></td>
    <td><?php echo $s_all[40]; ?></td>
    <td><?php echo $s_all[50]; ?></td>
</tr>
<?php
foreach ($s_department as $id => $one) {
    $total = array_sum($one);
    $p = 0;
    if ($total > 0) {
        $p = intval($one[50] / $total * 10000) / 100;
    }
?>
<tr>
	<td><?php echo $departments[$id]; ?></td>
    <td>
@include('progress', ['p' => $p])
    </td>
    <td><?php echo $total; ?></td>
	<td><?php echo $one[10] + $one[30]; ?></td>
	<td><?php echo $one[20]; ?></td>
    <td><?php echo $one[40]; ?></td>
    <td><?php echo $one[50]; ?></td>
</tr>
<?php }
foreach ($s_leader as $id => $one) {
    $total = array_sum($one);
    $p = 0;
    if ($total > 0) {
        $p = intval($one[50] / $total * 10000) / 100;
    }
?>
<tr>
    <td><?php echo $users[$id]->name; ?></td>
    <td>
@include('progress', ['p' => $p])
    </td>
    <td><?php echo array_sum($one); ?></td>
    <td><?php echo $one[10] + $one[30]; ?></td>
    <td><?php echo $one[20]; ?></td>
    <td><?php echo $one[40]; ?></td>
    <td><?php echo $one[50]; ?></td>
</tr>
<?php } ?>
			</tbody>
		</table>
	</div>
</div>

@stop