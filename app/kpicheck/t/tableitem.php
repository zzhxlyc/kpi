<div id="right">
<div class="box special2">

<div class="header_main title">
<h2><?php echo $kpitable->name?></h2>
</div>

<div class="table">
<table>
	<tr>
		<th>考核表项</th>
		<th width="70">类型</th>
		<th width="70">时间节点</th>
		<th width="100">操作</th>
	</tr>
	<?php 
		$i = 0;
		if(is_array($list)){
			foreach($list as $o){
				$i++;
				$tr_class = '';
				if($i % 2 == 0) $tr_class = 'class="even"';
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $o->name?></td>
		<td><?php echo KpiItemType::to_string($o->type)?></td>
		<td><?php echo $o->timeline?></td>
		<td class="operate">
			<a href="<?php echo $home.'/itemshow?itemid='.$o->id?>">查看具体</a>
		</td>
	</tr>
	<?php 
			}
		}
	?>
</table>
</div>

<div class="actions whiteBg">
<div class="actions-left">
<input type="button" value="返回" onclick="location.href='<?php echo $home."/kpitable?did=$kpitable->depart"?>'" /></div>
</div>

</div>
</div>
