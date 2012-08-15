<?php

class KpitableController extends AppController {
	
	public $models = array('KpiTable', 'KpiTableItem', 'User', 'Datasource', 'Depart');
	public $no_session = array();
	
	public function before(){
		$this->set('home', KPITABLE_HOME);
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
		$director = get_user($this->session);
		$cond = array('valid'=>1);
		$all = $this->KpiTable->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = Model::get_joins(array('K.*', 'D.name as department'), 
						array('kpi_table as K', 'department as D'), 
						array('K.depart eq'=>'D.id'),
						array('K.depart'=>'ASC'),
						$pager->get_limit_str());
		$page_list = $pager->get_page_links(KPITABLE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data(&$kpitable = Null){
		$departs = $this->Depart->get_list(array('valid'=>1));
		$this->set('$departs', $departs);
	}
	
	private function add_item_data(&$kpiitem = Null){
		$this->add_data();
		$ds_list = $this->Datasource->get_list(array('valid'=>1));
		$this->set('$ds_list', $ds_list);
		$staff_list = Model::get_joins(array('U.*', 'D.name as department'),
										array('user as U', 'department as D'), 
										array('U.type'=>UserType::STAFF, 'U.valid'=>1, 
											'U.depart eq'=>'`D`.`id`'),
										array('U.name'=>'ASC'));
		$this->set('$staff_list', $staff_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$errors = $this->KpiTable->check($post);
			if(count($errors) == 0){
				$cond = array('id'=>intval($post['depart']), 'valid'=>1);
				$depart = $this->Depart->get_row($cond);
				if(!$depart){
					$errors['depart'] = '部门不存在';
				}
			}
			if(count($errors) == 0){
				$post['time'] = DATETIME;
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
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'valid'=>1);
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
				$cond = array('id'=>intval($post['depart']), 'valid'=>1);
				$depart = $this->Depart->get_row($cond);
				if(!$depart){
					$errors['depart'] = '部门不存在';
				}
			}
			if(count($errors) == 0){
				$this->KpiTable->escape($post);
				$this->KpiTable->save($post);
				$this->response->redirect('edit?succ=1&id='.$id);
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
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'valid'=>1);
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
		if(is_object($obj)){
			$data = (array)$obj;
		}
		else{
			$data = $obj;
		}
		$errors = $this->KpiTableItem->check($obj);
		if(intval($data['type']) != KpiItemType::FOUJUE){
			if(empty($data['datasource'])){
				$errors['datasource'] = '不能为空';
			}
			if(empty($data['staff'])){
				$errors['staff'] = '不能为空';
			}
			if(!isset($errors['weight']) && 
				($data['weight'] <= 0 || $data['weight'] > 100)){
				$errors['weight'] = '范围有误';
			}
			if(!isset($errors['weight']) && isset($data['kpi_table'])){
				$cond = array('valid'=>1, 'kpi_table'=>$data['kpi_table'], 
							'type !='=>KpiItemType::FOUJUE);
				if(isset($data['id'])){
					$cond['id !='] = $data['id'];
				}
				$items = $this->KpiTableItem->get_list($cond);
				$sum = 0;
				foreach($items as $item){
					$sum += intval($item->weight);
				}
				if($sum + $data['weight'] > 100){
					$errors['weight'] = '其他所有指标比重已达到'.$sum.'%';
				}
			}
		}
		else{
			if(isset($errors['weight'])){
				unset($errors['weight']);
			}
		}
		return $errors;
	}
	
	public function additem(){
		$data = $this->get_data();
		$id = intval($data['tableid']);
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'valid'=>1);
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
			$staff = $this->User->get($post['staff']);
			if(count($errors) == 0){
				unset($post['kind']);
				$post['score_depart'] = $staff->depart;
				$post['valid'] = 1;
				$post['modified'] = 0;
				if($post['type'] == KpiItemType::FOUJUE){
					$post['datasource'] = 0;
					$post['weight'] = 0;
					$post['score_depart'] = 0;
					$post['staff'] = 0;
				}
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
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'valid'=>1);
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
			$staff = $this->User->get($post['staff']);
			if(count($errors) == 0){
				$post['score_depart'] = $staff->depart;
				if($post['type'] == KpiItemType::FOUJUE){
					$post['datasource'] = 0;
					$post['weight'] = 0;
					$post['score_depart'] = 0;
					$post['staff'] = 0;
				}
				$this->KpiTableItem->escape($post);
				$this->KpiTableItem->save($post);
				$this->response->redirect('edititem?succ=1&id='.$id);
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
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'valid'=>1);
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