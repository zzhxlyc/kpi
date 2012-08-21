
<header>
		<div id="header_toolbar">
				<h1 class="grid_1">
					杭州钱鸿集团KPI系统
				</h1>
				<div class="grid_2">
					<div class="toolbar_large">
							<div class="toolicon">
								<img
									src="<?php echo IMAGE_HOME?>/user.png"
									width="16" height="16" alt="user">
							</div>
							<div class="toolmenu">
								<div class="toolcaption" style="min-width: 46px;">
									<span>管理员</span>
								</div>
							</div>
							<div class="toolicon_lock">
								<img
									src="<?php echo IMAGE_HOME?>/lock.png"
									width="16" height="16" alt="user">
							</div>
							<div class="loginout">
								<a class="a_loginout" href="<?php echo ROOT_URL.'/loginout'?>"> 注销</a>
							</div>
					</div>
				</div>
		</div>
		<nav id="header_main">
		<div class="container_12">
		</div>
		</nav>
</header>		

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
								<th class="column1" >选择</th>
								<th class="column2">姓名</th>
								<th class="column3" >操作</th>
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
									<a href="<?php echo $home.'/remove?id='.$o->id?>">删除</
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
				<input type="submit" value="添加公司主管" />
			</div>
		</form>
	</div>
</div>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

