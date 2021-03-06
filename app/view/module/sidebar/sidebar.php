<?php 
	if($User){
?>

<div id="menu">
	<ul>
	<?php if($User->type == UserType::ADMIN){?>
	<li class="first-child <?php sidebar_current('depart', 0)?>"><a href="<?php echo DEPART_HOME.'/index'?>"><span>部门管理</span></a></li>
	<li <?php sidebar_current('manager')?>><a href="<?php echo MANAGER_HOME.'/index'?>"><span>公司主管</span></a></li>
	<li <?php sidebar_current('director')?>><a href="<?php echo DIRECTOR_HOME.'/index'?>"><span>部门主管</span></a></li>
	<li <?php sidebar_current('datasource')?>><a href="<?php echo DATASOURCE_HOME.'/index'?>"><span>数据源表格</span></a></li>
	<li <?php sidebar_current('kpitable')?>><a href="<?php echo KPITABLE_HOME.'/index'?>"><span>KPI考核表管理</span></a></li>
	<?php }?>
	
	<?php if($User->type == UserType::COMPANY){?>
	<li class="first-child <?php sidebar_current('kpicheck', 0)?>"><a href="<?php echo KPICHECK_HOME.'/depart'?>"><span>绩效考核汇总</span></a></li>
	<li <?php sidebar_current('staffm')?>><a href="<?php echo STAFFM_HOME.'/depart'?>"><span>办事员管理</span></a></li>
	<?php }?>
	
	<?php if($User->type == UserType::DEPART){?>
	<li class="first-child <?php sidebar_current('staff', 0)?>"><a href="<?php echo STAFF_HOME.'/index'?>"><span>办事员管理</span></a></li>
	<li <?php sidebar_current('kpi')?>><a href="<?php echo KPI_HOME.'/index'?>"><span>KPI考核记录</span></a></li>
	<li <?php sidebar_current('score')?>><a href="<?php echo SCORE_HOME.'/index'?>"><span>KPI考核打分</span></a></li>
	<?php }?>
	
	<?php if($User->type == UserType::STAFF){?>
	<li class="first-child <?php sidebar_current('sourcedata', 0)?>"><a href="<?php echo SOURCEDATA_HOME.'/index'?>"><span>数据源数据管理</span></a></li>
	<?php }?>
	
	<li <?php sidebar_current('user')?>><a href="<?php echo USER_HOME.'/pswd'?>"><span>修改密码</span></a></li>
	
</ul>
</div>

<?php }?>
