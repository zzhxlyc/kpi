<?php

class LoginController extends AppController {
	
	public $models = array('User');
	public $no_session = array();
	
	public function before(){
		$this->load_session();
		$this->set('home', LOGIN_HOME);
	}
	
	public function login(){
		if($this->request->post){
			$post = $this->request->post;
			$user = esc_text(trim($post['user']));
			$password = esc_text(trim($post['password']));
			$errors = array();
			if(strlen($user) == 0){
				$errors['user'] = '用户名为空';
			}
			$this->set('user', $user);
			if(strlen($password) == 0){
				$errors['password'] = '密码为空';
			}
			if(count($errors) == 0){
				$cond = array('slug'=>$user, 'password'=>md5($password));
				$user = $this->User->get_row($cond);
				if(!$user){
					$errors['password'] = '用户名或密码错误';
				}
				else if($user->valid == 0 && $user->id != 1){
					$errors['user'] = '此用户已被删除';
				}
			}
			if(count($errors) == 0){
				$this->session->set('user', $user->id);
				$data = array('id'=>$user->id, 'login'=>DATETIME);
				$this->User->save($data);
				if($user->type == UserType::ADMIN){
					$this->redirect('index', 'depart');
				}
				else if($user->type == UserType::COMPANY){
					$this->redirect('depart', 'kpicheck');
				}
				else if($user->type == UserType::DEPART){
					$this->redirect('index', 'kpi');
				}
				else if($user->type == UserType::STAFF){
					$this->redirect('index', 'sourcedata');
				}
			}
			else{
				$this->set('$errors', $errors);
			}
		}
	}
	
	public function loginout(){
		$this->session->set('user', '');
		$this->response->redirect(LOGIN_HOME);
	}
	
}