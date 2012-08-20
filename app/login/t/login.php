<BODY class="special_page"> 
<DIV class="top"> 
	<DIV class="gradient"></DIV> 
	<DIV class="content"> 
		<H1>杭州钱鸿集团绩效考核系统</H1> 
		<DIV class="wrapper"> 
		<DIV class="box"> 
		<DIV class="header grey"> 
		<IMG src="<?php echo IMAGE_HOME?>/lock.png" width="16" height="16"> 
		<H3>登录</H3> </DIV> 
		<FORM action="" method="post"> 
			<DIV class="content no-padding with-actions grey"> 
				<DIV class="section _100"> 
					<LABEL for="user"> 账号</LABEL> 
					<DIV> 
						<INPUT class="required" type="text" name="user" value="<?php echo $user->user?>" /> 
						<span class="error"><?php echo $errors['user']?></span>	
					</DIV>
					
				</DIV> 
				<DIV class="section _100"> <LABEL for="password"> 密码 </LABEL> 
					<DIV> 
						<INPUT class="required" name="password" type="password" value="<?php echo $user->password?>" /> 
						<span class="error"><?php echo $errors['password']?></span>
					</DIV> 
					
				</DIV> 
			</DIV> 
			<DIV class="actions"> 
				<DIV style="margin-top: 8px;" class="actions-left"> 
				<LABEL> 
					<INPUT name="autologin" type="checkbox" /> 记住账号和密码
				</LABEL> 
				</DIV> 
				<DIV class="actions-right"> <INPUT value="登录" type="submit" /> </DIV> 
			</DIV> 
		</FORM> 
		</DIV> 
		</DIV> 
	</DIV> 
</DIV
</BODY>