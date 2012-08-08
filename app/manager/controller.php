<?php

class ManagerController extends AppController {
	
	public $models = array('User', 'Depart', 'Supervise');
	public $no_session = array();
	
	public function before(){
		$this->set('home', MANAGER_HOME);
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
		$cond = array('type' => UserType::COMPANY, 'valid'=>1);
		$all = $this->User->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->User->get_page($cond, array('id'=>'ASC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(MANAGER_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function set_data(){
		$list = $this->Depart->get_list(array('valid'=>1));
		$this->set('depart_list', $list);
	}
	
	private function add_data($user){
		$list = $this->Supervise->get_list(array('user'=>$user->id));
		$user->depart = array();
		foreach($list as $o){
			$user->depart[] = $o->depart;
		}
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$post['slug'] = trim($post['slug']);
			$post['type'] = UserType::COMPANY;
			$post['limit'] = UserLimit::get_company_limit();
			$depart = $post['depart'];
			$errors = $this->User->check($post);
			$this->check_slug_unique($errors, 'User');
			if(count($errors) == 0){
				unset($post['depart']);
				$post['valid'] = 1;
				$post['password'] = md5($post['password']);
				$this->User->escape($post);
				$uid = $this->User->save($post);
				if(is_array($depart) && $uid){
					foreach($depart as $did){
						$data = array('user'=>$uid, 'depart'=>$did);
						$this->Supervise->save($data);
					}
				}
				$this->response->redirect('index');
			}
			else{
				$user = $this->set_model($post, new User());
				$this->set('errors', $errors);
				$this->set('$user', $user);
			}
		}
		$this->set_data();
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			$depart = $post['depart'];
			if($id > 0){
				$user = $this->User->get($id);
			}
			if($user){
				$user = $this->set_model($post, $user);
				$errors = $this->User->check($user);
				$this->check_slug_unique($errors, 'User');
				if(count($errors) == 0){
					unset($post['depart']);
					$this->User->escape($post);
					$this->User->save($post);
					
					$list = $this->Supervise->get_list(array('user'=>$id));
					$depart_id_list = get_attrs($list, 'depart');
					if(!is_array($depart)) $depart = array();
					$remove_id_array = array_diff($depart_id_list, $depart);
					$add_id_array = array_diff($depart, $depart_id_list);
					if(is_array($remove_id_array) && count($remove_id_array) > 0){
						$remove_cond = array('user'=>$id, 'depart in'=>$remove_id_array);
						$this->Supervise->delete_all($remove_cond);
					}
					if(is_array($add_id_array) && count($add_id_array) > 0){
						foreach($add_id_array as $did){
							$data = array('user'=>$id, 'depart'=>$did);
							$this->Supervise->save($data);
						}
					}
					
					$this->response->redirect('edit?succ=1&id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('$user', $user);
					$this->set_data();
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
				$this->set_data();
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
			$this->Supervise->delete_all(array('user in'=>$ids));
		}
		parent::remove('User');
	}
	
}