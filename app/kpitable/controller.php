<?php

class KpitableController extends AppController {
	
	public $models = array('KpiTable', 'KpiTableItem', 'User', 'Datasource');
	public $no_session = array();
	
	public function before(){
		$this->set('home', KPITABLE_HOME);
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
		$director = get_user($this->session);
		$cond = array('valid'=>1, 'manager'=>$director);
		$all = $this->KpiTable->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->KpiTable->get_page($cond, array('id'=>'ASC'), 
					$pager->now(), $limit);
		$page_list = $pager->get_page_links(KPITABLE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data(&$kpitable = Null){
		$director = get_user($this->session);
		$list = Model::get_joins(array('U.*', 'D.name as department'), 
									array('user as U', 'department as D'), 
									array('U.id'=>$director, 'U.depart eq'=>'`D`.`id`'));
		$this->set('$manager', $list[0]);
	}
	
	private function add_item_data(&$kpiitem = Null){
		$this->add_data();
		$ds_list = $this->Datasource->get_list(array('valid'=>1));
		$this->set('$ds_list', $ds_list);
		$staff_list = $this->User->get_list(array('type'=>UserType::STAFF, 'valid'=>1), 
								array('name'=>'ASC'));
		$this->set('$staff_list', $staff_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$post['manager'] = get_user($this->session);
			$post['time'] = DATETIME;
			$errors = $this->KpiTable->check($post);
			if(count($errors) == 0){
				$post['valid'] = 1;
				$this->KpiTable->escape($post);
				$this->KpiTable->save($post);
				$this->response->redirect('index');
			}
			else{
				$kpitable = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('$kpitable', $kpitable);
			}
		}
		$this->add_data($kpitable);
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = get_id($data);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'manager'=>$Director->id, 'valid'=>1);
			$kpitable = $this->KpiTable->get_row($cond);
			if($kpitable){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$kpitable = $this->set_model($post, $kpitable);
			$errors = $this->KpiTable->check($kpitable);
			if(count($errors) == 0){
				$this->KpiTable->escape($post);
				$this->KpiTable->save($post);
				$this->response->redirect('edit?id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->add_data($kpitable);
		$this->set('$kpitable', $kpitable);
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'manager'=>$Director->id, 'valid'=>1);
			$kpitable = $this->KpiTable->get_row($cond);
			if($kpitable){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$this->add_data($kpitable);
		$this->set('$kpitable', $kpitable);
		$cond = array('kpi_table'=>$kpitable->id, 'valid'=>1);
		$item_list = $this->KpiTableItem->get_list($cond);
		$this->set('$list', $item_list);
	}
	
	public function remove(){
		$get = $this->request->get;
		$id = get_id($get);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'manager'=>$Director->id, 'valid'=>1);
			$kpitable = $this->KpiTable->get_row($cond);
			if($kpitable){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			$this->response->redirect('index');
		}
		
		$id_array = $this->get_delete_ids();
		if(count($id_array) > 0){
			$cond = array('kpi_table in'=>$id_array);
			$this->KpiTableItem->update(array('valid'=>0), $cond);
		}
		parent::remove('KpiTable');
	}
	
	private function set_and_check_item(&$obj){
		if(is_array($obj)){
			$weight = $obj['weight'];
		}
		else if(is_object($obj)){
			$weight = $obj->weight;
		}
		$errors = $this->KpiTableItem->check($obj);
		if(!isset($errors['weight']) && $weight <= 0 || $weight > 100){
			$errors['weight'] = '范围有误';
		}
		return $errors;
	}
	
	public function additem(){
		$data = $this->get_data();
		$id = intval($data['tableid']);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'manager'=>$Director->id, 'valid'=>1);
			$kpitable = $this->KpiTable->get_row($cond);
			if($kpitable){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$post['depart'] = $kpitable->depart;
			$post['kpi_table'] = $kpitable->id;
			unset($post['tableid']);
			$errors = $this->set_and_check_item($post);
			if(count($errors) == 0){
				unset($post['kind']);
				$post['valid'] = 1;
				$post['modified'] = 0;
				$this->KpiTableItem->escape($post);
				$this->KpiTableItem->save($post);
				$this->response->redirect('show?id='.$kpitable->id);
			}
			else{
				$this->set('errors', $errors);
				$tableitem = $this->set_model($post);
				$this->set('$tableitem', $tableitem);
			}
		}
		$this->set('$kpitable', $kpitable);
		$this->add_item_data();
	}
	
	public function showitem(){
		$data = $this->get_data();
		$id = intval($data['id']);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'depart'=>$Director->depart, 'valid'=>1);
			$tableitem = $this->KpiTableItem->get_row($cond);
			if($tableitem){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$fields = array('K.*', 'D.name as ds_name', 'U.name as username', 'U.slug');
		$table = array('kpi_table_item as K', 'datasource as D', 'user as U');
		$cond = array('K.id'=>$id, 'K.datasource eq'=>'D.id', 'K.staff eq'=>'U.id');
		$list = Model::get_joins($fields, $table, $cond);
		if(isset($list[0])){
			$tableitem = $list[0];
			$this->set('$tableitem', $tableitem);
		}
		$kpitable = $this->KpiTable->get($tableitem->kpi_table);
		$this->set('$kpitable', $kpitable);
	}
	
	public function edititem(){
		$data = $this->get_data();
		$id = intval($data['id']);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'depart'=>$Director->depart, 'valid'=>1);
			$tableitem = $this->KpiTableItem->get_row($cond);
			if($tableitem){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$tableitem = $this->set_model($post, $tableitem);
			$errors = $this->set_and_check_item($tableitem);
			if(count($errors) == 0 && $tableitem->modified == 0){
				$this->KpiTableItem->escape($post);
				$this->KpiTableItem->save($post);
				$this->response->redirect('edititem?id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->add_item_data($tableitem);
		$this->set('$tableitem', $tableitem);
	}
	
	public function delitem(){
		$data = $this->get_data();
		$id = intval($data['id']);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'depart'=>$Director->depart, 'valid'=>1);
			$tableitem = $this->KpiTableItem->get_row($cond);
			if($tableitem){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			$this->response->redirect('index');
		}
		
		parent::remove('KpiTableItem', 'show?id='.$tableitem->kpi_table);
	}
	
}