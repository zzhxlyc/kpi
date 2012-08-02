<?php

class DepartController extends AppController {
	
	public $models = array('User', 'Depart', 'Supervise');
	public $no_session = array();
	
	public function before(){
		$this->set('home', DEPART_HOME);
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
		$cond = array('valid'=>1);
		$all = $this->Depart->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Depart->get_page($cond, array('id'=>'ASC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(DEPART_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$errors = $this->Depart->check($post);
			$count = $this->Depart->count(array('name'=>$post['name'], 'valid'=>1));
			if($count != 0){
				$errors['name'] = '已存在';
			}
			if(count($errors) == 0){
				$post['valid'] = 1;
				$this->Depart->escape($post);
				$this->Depart->save($post);
				$this->response->redirect('index');
			}
			else{
				$depart = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('$depart', $depart);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			if($id > 0){
				$depart = $this->Depart->get($id);
			}
			if($depart){
				$depart = $this->set_model($post, $depart);
				$errors = $this->Depart->check($depart);
				if(count($errors) == 0){
					$this->Depart->escape($post);
					$this->Depart->save($post);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('$depart', $depart);
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
				$depart = $this->Depart->get($id);
			}
			if($depart){
				$this->set('$depart', $depart);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
	public function remove(){
		$id_array = $this->get_delete_ids();
		if(count($id_array) > 0){
			$this->User->update(array('depart'=>0), array('depart in'=>$id_array));
			$this->Supervise->delete_all(array('depart in'=>$id_array));
		}
		parent::remove();
	}
	
}