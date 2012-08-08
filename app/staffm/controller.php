<?php

class StaffmController extends AppController {
	
	public $models = array('User', 'Depart', 'Supervise');
	public $no_session = array();
	
	public function before(){
		$this->set('home', STAFFM_HOME);
		parent::before();
		$User = $this->get('User');
		if($User->type != UserType::COMPANY){
			$this->go_login();
		}
	}
	
	public function depart(){
		$get = $this->request->get;
		$Manager = $this->get('User');
		$list = Model::get_joins(array('D.*'), 
						array('supervise as S', 'department as D'),
						array('S.user'=>$Manager->id, 'D.valid'=>1,
								'S.depart eq'=>'`D`.`id`'));
		if(count($list) > 0){
			$id_array = get_ids($list);
			$manager_list = $this->User->get_list(array('type'=>UserType::DEPART, 
										'depart in'=>$id_array));
			$manager_list = array_to_map($manager_list, 'depart');
		}
		$this->set('$manager_list', $manager_list);
		$this->set('list', $list);
	}
	
	public function show(){
		$get = $this->request->get;
		$did = intval($get['depart']);
		$Manager = $this->get('User');
		$has_error = true;
		if($did > 0){
			$depart = $this->Depart->get($did);
			if($depart){
				$cond = array('user'=>$Manager->id, 'depart'=>$depart->id);
				$count = $this->Supervise->count($cond);
				if($count == 1){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$page = $get['page'];
		$limit = 10;
		$cond = array('depart'=>$did, 'type'=>UserType::STAFF, 'valid'=>1);
		$all = $this->User->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->User->get_page($cond, array('name'=>'ASC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(STAFFM_HOME."/show?depart=$did&");
		$this->set('$list', $list);
		$this->set('$depart', $depart);
		$this->set('$page_list', $page_list);
	}
	
	public function add(){
		$get = $this->request->get;
		$did = intval($get['depart']);
		$Manager = $this->get('User');
		$has_error = true;
		if($did > 0){
			$depart = $this->Depart->get($did);
			if($depart){
				$cond = array('user'=>$Manager->id, 'depart'=>$depart->id);
				$count = $this->Supervise->count($cond);
				if($count == 1){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$Manager = $this->get('User');
			$post = $this->request->post;
			$post['type'] = UserType::STAFF;
			$post['limit'] = UserLimit::get_staff_limit();
			$errors = $this->User->check($post);
			$this->check_slug_unique($errors, 'User');
			if(count($errors) == 0){
				$post['valid'] = 1;
				$post['password'] = md5($post['password']);
				$this->User->escape($post);
				$this->User->save($post);
				$this->response->redirect('show?depart='.$did);
			}
			else{
				$user = $this->set_model($post, new User());
				$this->set('errors', $errors);
				$this->set('$user', $user);
			}
		}
		$this->set('depart', $depart);
	}
	
	public function edit(){
		$get = $this->request->get;
		$id = get_id($get);
		$Manager = $this->get('User');
		$has_error = true;
		if($id > 0){
			$staff = $this->User->get_row(array('id'=>$id, 'type'=>UserType::STAFF));
			$depart = $this->Depart->get($staff->depart);
			if($staff && $depart){
				$cond = array('user'=>$Manager->id, 'depart'=>$staff->depart);
				$count = $this->Supervise->count($cond);
				if($count == 1){
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
				$this->response->redirect('edit?succ=1&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('$depart', $depart);
		$this->set('$user', $staff);
	}
	
	public function pswd(){
		$get = $this->request->get;
		$id = get_id($get);
		$Manager = $this->get('User');
		$has_error = true;
		if($id > 0){
			$staff = $this->User->get_row(array('id'=>$id, 'type'=>UserType::STAFF));
			$depart = $this->Depart->get($staff->depart);
			if($staff && $depart){
				$cond = array('user'=>$Manager->id, 'depart'=>$staff->depart);
				$count = $this->Supervise->count($cond);
				if($count == 1){
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
				$this->response->redirect('show?depart='.$depart->id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('$depart', $depart);
		$this->set('$user', $staff);
	}
	
	public function remove(){
		$get = $this->request->get;
		$id = get_id($get);
		$Manager = $this->get('User');
		$has_error = true;
		if($id > 0){
			$staff = $this->User->get_row(array('id'=>$id, 'type'=>UserType::STAFF));
			$depart = $this->Depart->get($staff->depart);
			if($staff && $depart){
				$cond = array('user'=>$Manager->id, 'depart'=>$staff->depart);
				$count = $this->Supervise->count($cond);
				if($count == 1){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->redirect('index');
		}
		
		parent::remove('User', 'show?depart='.$depart->id);
	}
	
}