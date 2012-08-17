
<div id="header">
			<!-- logo -->
			<div id="logo">
				<h1>杭州钱鸿集团KPI系统</h1>
			</div>
			<!-- end logo -->
			<!-- user -->
			<ul id="user">
				<li class="first"><span><?php echo $User->name;?></span></li>
				<li><a href="<?php echo ROOT_URL.'/loginout'?>"><span>注销</span></a></li>
			</ul>
			<!-- end user -->
			<div id="header-inner">
				<div id="home">
					<a href="" title="Home"></a>
				</div>
				<!-- quick -->
				<ul id="quick">
					<li>
						<a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#" title="Products"><span class="normal">Examples</span></a>
						<ul style="display: none; ">
							<li><a href="http://www.netcoders.net/smoothadmin/index.html">Full, Column</a></li>
							<li><a href="http://www.netcoders.net/smoothadmin/index-no-column.html">Full, No Column</a></li>
							<li><a href="http://www.netcoders.net/smoothadmin/index-fixed.html">Fixed, Column</a></li>
							<li class="last"><a href="http://www.netcoders.net/smoothadmin/index-fixed-no-column.html">Fixed, No Column</a></li>
						</ul>
					</li>
					<li>
						<a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#" title="Products"><span class="icon"><img src="<?php echo IMAGE_HOME?>/application_double.png" alt="Products"></span><span>Products</span></a>
						<ul style="display: none; ">
							<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">Manage Products</a></li>
							<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">Add Product</a></li>
							<li>
								<a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#" class="childs">Sales</a>
								<ul style="display: none; ">
									<li><a href="">Today</a></li>
									<li><a href="">Yesterday</a></li>
									<li class="last">
										<a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#" class="childs">Archive</a>
										<ul style="display: none; ">
											<li><a href="">Last Week</a></li>
											<li class="last"><a href="">Last Month</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="last">
								<a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#" class="childs">Offers</a>
								<ul style="display: none; ">
									<li><a href="">Coupon Codes</a></li>
									<li class="last"><a href="">Rebates</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="" title="Events"><span class="icon"><img src="<?php echo IMAGE_HOME?>/calendar.png" alt="Events"></span><span>Events</span></a>
						<ul style="display: none; ">
							<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">Manage Events</a></li>
							<li class="last"><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">New Event</a></li>
						</ul>
					</li>
					<li>
						<a href="" title="Pages"><span class="icon"><img src="<?php echo IMAGE_HOME?>/page_white_copy.png" alt="Pages"></span><span>Pages</span></a>
						<ul style="display: none; ">
							<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">Manage Pages</a></li>
							<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">New Page</a></li>
							<li class="last">
								<a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#" class="childs">Help</a>
								<ul style="display: none; ">
									<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">How to Add a New Page</a></li>
									<li class="last"><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">How to Add a New Page</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="" title="Links"><span class="icon"><img src="<?php echo IMAGE_HOME?>/world_link.png" alt="Links"></span><span>Links</span></a>
						<ul style="display: none; ">
							<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">Manage Links</a></li>
							<li class="last"><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">Add Link</a></li>
						</ul>
					</li>
					<li>
						<a href="" title="Settings"><span class="icon"><img src="<?php echo IMAGE_HOME?>/cog.png" alt="Settings"></span><span>Settings</span></a>
						<ul style="display: none; ">
							<li><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">Manage Settings</a></li>
							<li class="last"><a href="http://www.netcoders.net/smoothadmin/index.html?username=admin&password=password#">New Setting</a></li>
						</ul>
					</li>
				</ul>
				<!-- end quick -->
				<div class="corner tl"></div>
				<div class="corner tr"></div>
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
						<h5>Products</h5>
					</div>
					<!-- end box / title -->
					<div class="table">
						<form action="" method="post">
						<table>
							<thead>
								<tr >
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
						</form>
					</div>
				</div>
			<!-- end table -->
		<input type="submit" value="批量删除" />
		<a href="<?php echo $home.'/add'?>">添加部门</a>
</form>
	</div>
</div>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>



