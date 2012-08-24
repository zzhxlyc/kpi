
<div id="content">
	<div id="left">
		<?php include(MODULE_DIR.'/sidebar/sidebar.php')?>
	</div>
	<div id="right">
		<form action="<?php echo $home.'/remove'?>" method="post">
		<div class="box">
			<!-- box / title -->
			<div class="header_main title">
				<h5></h5>
			</div>
			<!-- end box / title -->
			<div class="table">
			<!-- table -->
			<table>
				<thead>
					<tr>
						<th class="column1">选择</th>
						<th class="column2">部门</th>
						<th class="column3">操作</th>
					</tr>
				</thead>
				<tbody>
						<?php 
							$i = 0;
							if(is_array($list)){
								foreach($list as $o){
									$i++;
									$tr_class = '';
									if($i % 2 == 0) $tr_class = 'class="even"';
						?>
						<tr <?php echo $tr_class?>>
							<td class="center"><input name="id[]" type="checkbox" value="<?php echo $o->id?>" /></td>
							<td class="center"><a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo $o->name?></a></td>
							<td class="operate">
								<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
								<a href="<?php echo $home.'/remove?id='.$o->id?>">删除</a>
							</td>
						</tr>
						<?php 
								}
							}
						?>
					</tbody>
			</table>
			<!-- end table -->	
			</div>
		</div>
		<div>
			<input type="submit" value="批量删除" />
		</div>
		</form>
		<form action="<?php echo $home.'/add'?>" method="post">
			<div>
				<input type="submit" value="添加部门" />
			</div>
		</form>
		
	</div>
</div>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>



