<?php

class StaffController extends AppController {
	
	public $models = array('User', 'Depart');
	public $no_session = array();
	
	public function before(){
		$this->set('home', STAFF_HOME);
		parent::before();
		$User = $this->get('User');
		if($User->type != UserType::DEPART){
			$this->go_login();
		}
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$Director = $this->get('User');
		$cond = array('type' => UserType::STAFF, 'depart'=>$Director->depart, 'valid'=>1);
		$all = $this->User->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->User->get_page($cond, array('id'=>'ASC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(STAFF_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data($user = Null){
		$director = get_user($this->session);
		$list = Model::get_joins(array('U.*', 'D.name as department'), 
									array('user as U', 'department as D'), 
									array('U.id'=>$director, 'U.depart eq'=>'`D`.`id`'));
		$this->set('$manager', $list[0]);
	}
	
	public function add(){
		if($this->request->post){
			$Director = $this->get('User');
			$post = $this->request->post;
			$post['depart'] = $Director->depart;
			$post['type'] = UserType::STAFF;
			$post['limit'] = UserLimit::get_staff_limit();
			$errors = $this->User->check($post);
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
		$get = $this->request->get;
		$id = get_id($get);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$staff = $this->User->get_row(array('id'=>$id, 'type'=>UserType::STAFF));
			if($staff){
				if($staff->depart == $Director->depart){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$user = $staff;
			$user = $this->set_model($post, $user);
			$errors = $this->User->check($user);
			if(count($errors) == 0){
				$this->User->escape($post);
				$this->User->save($post);
				$this->response->redirect('edit?id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->add_data($staff);
		$this->set('$user', $staff);
	}
	
	public function pswd(){
		$get = $this->request->get;
		$id = get_id($get);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$staff = $this->User->get_row(array('id'=>$id, 'type'=>UserType::STAFF));
			if($staff){
				if($staff->depart == $Director->depart){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$user = $staff;
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
			}
		}
		$this->set('$user', $staff);
	}
	
	public function remove(){
		$get = $this->request->get;
		$id = get_id($get);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$staff = $this->User->get_row(array('id'=>$id, 'type'=>UserType::STAFF));
			if($staff){
				if($staff->depart == $Director->depart){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			$this->response->redirect('index');
		}
		
		parent::remove('User');
	}
	
}