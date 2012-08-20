
<div id="header">
	<!-- logo -->
	<div id="logo">
		<h1>杭州钱鸿集团KPI系统</h1>
	</div>
	<!-- end logo -->
	<!-- user -->
	<ul id="user">
		<li class="first">
			<span>
				<?php echo $User->name;?>
			</span>
		</li>
		<li>
			<a href="<?php echo ROOT_URL.'/loginout'?>"><span>注销</span>
			</a>
		</li>
	</ul>
	<!-- end user -->
	<div id="header-inner">
	</div>
</div>

<div id="content">
	<div id="left">
		<?php include(MODULE_DIR.'/sidebar/sidebar.php')?>
	</div>
	<div id="right">
		<form action="<?php echo $home.'/remove'?>" method="post">
		<!-- table -->
		<div class="box">
			<!-- box / title -->
			<div class="title">
				<h5></h5>
			</div>
			<!-- end box / title -->
			<div class="table">
					<table>
						<thead>
							<tr>
								<th class="center">选择</th>
								<th class="center">姓名</th>
								<th class="center">操作</th>
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
									<a href="<?php echo $home.'/pswd?id='.$o->id?>">修改密码</a>
									<a href="<?php echo $home.'/remove?id='.$o->id?>">删除</a>
								</td>
							</tr>
							<?php 
									}
								}
							?>
						</tbody>
					</table>
			</div>
		</div>
		<!-- end table -->
		<div>
			<input type="submit" value="批量删除" />
		</div>
		</form>
		<form action="<?php echo $home.'/add'?>" method="post">
			<div>
				<input type="submit" value="添加部门主管" />
			</div>
		</form>
	</div>
</div>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

