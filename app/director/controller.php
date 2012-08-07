<?php

class DirectorController extends AppController {
	
	public $models = array('User', 'Depart');
	public $no_session = array();
	
	public function before(){
		$this->set('home', DIRECTOR_HOME);
		parent::before();
		$User = $this->get('User');
		if($User->type != UserType::ADMIN){
			$this->go_login();
		}
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array('type' => UserType::DEPART, 'valid'=>1);
		$all = $this->User->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = Model::get_joins(array('U.*', 'D.name as department'), 
									array('user as U', 'department as D'), 
									array('U.type'=>UserType::DEPART, 'U.valid'=>1,
										 'U.depart eq'=>'`D`.`id`'));
		$page_list = $pager->get_page_links(DIRECTOR_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data($user = Null){
		$list = $this->Depart->get_list(array('valid'=>1));
		$this->set('depart_list', $list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$post['slug'] = trim($post['slug']);
			$post['type'] = UserType::DEPART;
			$post['limit'] = UserLimit::get_depart_limit();
			$errors = $this->User->check($post);
			if(empty($post['depart'])){
				$errors['depart'] = '不能为空';
			}
			$this->check_slug_unique($errors, 'User');
			if(count($errors) == 0){
				$post['valid'] = 1;
				$post['password'] = md5($post['password']);
				$this->User->escape($post);
				$this->User->save($post);
				$this->response->redirect('index');
			}
			else{
				$user = $this->set_model($post, new User());
				$this->set('errors', $errors);
				$this->set('$user', $user);
			}
		}
		$this->add_data();
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			if($id > 0){
				$user = $this->User->get($id);
			}
			if($user){
				$user = $this->set_model($post, $user);
				$errors = $this->User->check($user);
				$this->check_slug_unique($errors, 'User');
				if(count($errors) == 0){
					$this->User->escape($post);
					$this->User->save($post);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->add_data($user);
					$this->set('errors', $errors);
					$this->set('$user', $user);
				}
			}
			else{
				$this->set('error', '不存在');
			}
		}
		else{
			$get = $this->request->get;
			$id = get_id($get);
			if($id > 0){
				$user = $this->User->get($id);
			}
			if($user){
				$this->add_data($user);
				$this->set('$user', $user);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
	public function pswd(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			if($id > 0){
				$user = $this->User->get($id);
			}
			if($user){
				$errors = array();
				if(empty($post['password'])){
					$errors['password'] = '密码为空';
				}
				if(empty($post['password2'])){
					$errors['password2'] = '确认密码为空';
				}
				if(count($errors) == 0 && $post['password'] != $post['password2']){
					$errors['password2'] = '确认密码不一致';
				}
				if(count($errors) == 0){
					$data = array('id'=>$id, 'password'=>md5($post['password']));
					$this->User->escape($data);
					$this->User->save($data);
					$this->response->redirect('index');
				}
				else{
					$this->set('errors', $errors);
					$this->set('$user', $user);
				}
			}
			else{
				$this->set('error', '不存在');
			}
		}
		else{
			$get = $this->request->get;
			$id = get_id($get);
			if($id > 0){
				$user = $this->User->get($id);
			}
			if($user){
				$this->set('$user', $user);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
	public function remove(){
		$id_array = $this->get_delete_ids();
		if(count($id_array) > 0){
		}
		parent::remove('User');
	}
	
}