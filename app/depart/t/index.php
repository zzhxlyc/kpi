

<header>
		<div id="header_toolbar">
			<div class="container_12">
				<h1 class="grid_8">
					杭州钱鸿集团KPI系统
				</h1>
				<div class="grid_4">
					<div class="toolbar_large">
						<div class="toolbutton">
							<div class="toolicon">
								<img
									src="<?php echo IMAGE_HOME?>/user.png"
									width="16" height="16" alt="user">
							</div>
							<div class="toolmenu">
							
								<div class="toolcaption" style="min-width: 46px;">
									<span>Administrator</span>
								</div>
								<div class="dropdown" style="display: none;">
									<ul>
										<li>
											<a
												href="http://envato.stammtec.de/themeforest/peach/dashboard.html#">Settings</a>
										</li>
										<li>
											<a
												href="http://envato.stammtec.de/themeforest/peach/dashboard.html#">Logout</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="loginout">
							<form action="<?php echo ROOT_URL.'/loginout'?>" method="post">
							<div>
							<input type="submit" value="注销" />
							</div>
						</form>
							</div>
						</div>
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
							<th class="center">选择</th>
							<th class="center">部门</th>
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
				<input type="submit" value="添加部门" />
			</div>
		</form>
		
	</div>
</div>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>



