<DIV class="top"> 
<DIV class="gradient" ></DIV>
	<DIV id="content" > 
	<DIV id="login_h1"><H1>杭州钱鸿集团绩效考核系统</H1></DIV>
		<DIV class="wrapper"> 
		<DIV class="box"> 
		<DIV class="header grey"> 
		<IMG src="<?php echo IMAGE_HOME?>/lock.png" width="16" height="16"> 
		<H3>登录</H3> </DIV> 
		<FORM action="" method="post"> 
			<DIV class="data_wrapper "> 
				<DIV class="data"> 
					<DIV><LABEL for="user"> 账号</LABEL></DIV> 
					<DIV> 
						<INPUT class="required" type="text" name="user" value="<?php echo $user?>" /> 
						<br><span class="error"><?php echo $errors['user']?></span>	
					</DIV>
					
				</DIV> 
				<DIV class="data"> <DIV><LABEL for="password"> 密码 </LABEL></DIV> 
					<DIV> 
						<INPUT class="required" name="password" type="password" /> 
						<br><span class="error"><?php echo $errors['password']?></span>
					</DIV> 
					
				</DIV> 
			</DIV> 
			
			<DIV class="actions login"> 
				<DIV class="actions-right "> <INPUT value="登录" type="submit" /> </DIV> 
			</DIV> 
			<!---->
						<!--
			<DIV class="data"> 
				<DIV > <INPUT value="登录" type="submit" /> </DIV> 
			</DIV> 
			-->
			
		</FORM> 
		</DIV> 
		</DIV> 
	</DIV>  
</DIV>





