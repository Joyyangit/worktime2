<?php
$textcolor = array();
$a = array( 'text-muted', 'text-primary', 'text-danger', 'text-danger' );
$i = 0;
foreach ($prioritys as $key => $value) {
    $textcolor[$key] = $a[$i];
    $i++;
}
foreach ($tasks as $task) {
    if (50 == $task->status) {
        $tcolor = 'text-success';
    } elseif (99 == $task->status) {
        $tcolor = 'text-muted';
    } else {
        $tcolor = $textcolor[$task->priority];
    }
?>
<tr class="{{$tcolor}}">
<td><input itag="val" name="ids[]" type="checkbox" value="<?php echo $task->id; ?>"></td>
<td><?php echo $task->id; ?></td>
<td><?php echo $status[$task->status]; ?></td>
<td><?php echo $prioritys[$task->priority]; ?></td>
<td><?php echo $catys[$task->caty]; ?></td>
<td class="text-left"><a class="{{$tcolor}}" href="/task/show/<?php echo $task->id;?>" target="_blank"><?php echo $task->title; ?></a></td>
<td><?php echo $users[$task->leader]->name; ?></td>
<td><?php echo $departments[$task->department]; ?></td>
<td><?php echo $tags[$task->tag]->name; ?></td>
<td><?php echo $users[$task->author]->name; ?></td>
<td><?php echo $task->updated_at; ?></td>
</tr>
<?php } ?>
<tr><td colspan="11"><nav> <?php echo $tasks->appends($options)->render( );?> </nav></td></tr>