<?php

class UserController extends AppController {
	
	public $models = array('User');
	public $no_session = array();
	
	public function before(){
		$this->set('home', USER_HOME);
		parent::before();
		$User = $this->get('User');
		if(!$User){
			$this->go_login();
		}
	}
	
	
	public function pswd(){
		$User = $this->get('User');
		if($this->request->post){
			$post = $this->request->post;
			$errors = array();
			if(empty($post['password'])){
				$errors['password'] = '原密码为空';
			}
			if(empty($post['password1'])){
				$errors['password1'] = '新密码为空';
			}
			if(empty($post['password2'])){
				$errors['password2'] = '确认密码为空';
			}
			if(count($errors) == 0 && $post['password1'] != $post['password2']){
				$errors['password2'] = '确认密码不一致';
			}
			if(count($errors) == 0){
				if(md5(trim($post['password'])) != $User->password){
					$errors['password'] = '原密码错误';
				}
			}
			if(count($errors) == 0){
				$data = array('id'=>$User->id, 'password'=>md5($post['password1']));
				$this->User->save($data);
				$this->redirect('pswd?succ');
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('$user', $User);
	}
	
	public function remove(){}
	public function delete(){}
	
}