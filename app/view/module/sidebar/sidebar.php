<?php 
	if($User){
?>

<div id="menu">
	<ul id="menu-products" class="opened">
	<!--<li><a><span><?php echo $User->name;?></span></a></li>-->
	<?php if($User->type == UserType::ADMIN){?>
	<li ><a href="<?php echo DEPART_HOME.'/index'?>"><span>部门管理</span></a></li>
	<li ><a href="<?php echo MANAGER_HOME.'/index'?>"><span>公司主管</span></a></li>
	<li><a href="<?php echo DIRECTOR_HOME.'/index'?>"><span>部门主管</span></a></li>
	<li><a href="<?php echo DATASOURCE_HOME.'/index'?>"><span>数据源表格</span></a></li>
	<li><a href="<?php echo KPITABLE_HOME.'/index'?>"><span>KPI考核表管理</span></a></li>
	<?php }?>
	
	<?php if($User->type == UserType::COMPANY){?>
	<li><a href="<?php echo KPICHECK_HOME.'/depart'?>"><span>绩效考核汇总</span></a></li>
	<li><a href="<?php echo STAFFM_HOME.'/depart'?>"><span>办事员管理</span></a></li>
	<?php }?>
	
	<?php if($User->type == UserType::DEPART){?>
	<li><a href="<?php echo STAFF_HOME.'/index'?>"><span>办事员管理</span></a></li>
	<li><a href="<?php echo KPI_HOME.'/index'?>"><span>KPI考核记录</span></a></li>
	<li><a href="<?php echo SCORE_HOME.'/index'?>"><span>KPI考核打分</span></a></li>
	<?php }?>
	
	<?php if($User->type == UserType::STAFF){?>
	<li><a href="<?php echo SOURCEDATA_HOME.'/index'?>"><span>数据源数据管理</span></a></li>
	<?php }?>
	
<<<<<<< HEAD
	<li><a><span></span></a></li>
	<li><a href="<?php echo USER_HOME.'/pswd'?>"><span>修改密码</span></a></li>
	<li><a href="<?php echo ROOT_URL.'/loginout'?>"><span>注销</span></a></li>
=======
	<!--<li><a href="<?php echo ROOT_URL.'/loginout'?>"><span>注销</span></a></li>-->
>>>>>>> 1e3fe3ed71e9088fed0f8fea9649106e219d3e5a
</ul>
</div>

<?php }?>

