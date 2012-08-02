<?php

class SourcedataController extends AppController {
	
	public $models = array('User', 'Datasource', 'KpiTableItem', 'DSData', 'Depart');
	public $no_session = array();
	
	public function before(){
		$this->set('home', SOURCEDATA_HOME);
		parent::before();
		$User = $this->get('User');
		if($User->type != UserType::STAFF){
			$this->go_login();
		}
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$user = get_user($this->session);
		$list = Model::get_joins(array('K.id', 'D.id as ds', 'D.name', 'T.id as depart',
										'T.name as department'), 
									array('kpi_table_item as K', 
										'datasource as D', 'department as T'),
									array('K.staff'=>$user, 'K.datasource eq'=>'`D`.`id`', 
											'K.depart eq'=>'`T`.`id`'), 
									array('D.name'=>'ASC'));
		$this->set('list', $list);
	}
	
	private function check_data(&$post){
		$errors = array();
		foreach($post as $key => $value){
			$value = esc_text($value);
			$post[$key] = $value;
			if(utf8_strlen($value) > 250){
				$errors[$key] = '不能超过250个字符';
			}
		}
		return $errors;
	}
	
	private function add_data($obj){
		if(is_object($obj)){
			$tablename = $obj->tablename;
		}
		else{
			$tablename = $obj;
		}
		$list = Model::describe_table($tablename, 
						array('COLUMN_NAME', 'COLUMN_COMMENT'));
		$this->set('$list', $list);
	}
	
	public function add(){
		$data = $this->get_data();
		$id = intval($data['itemid']);
		$Staff = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'staff'=>$Staff->id, 'valid'=>1);
			$table_item = $this->KpiTableItem->get_row($cond);
			if($table_item){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$datasource = $this->Datasource->get($table_item->datasource);
		if($table_item->depart > 0){
			$department = $this->Depart->get($table_item->depart);
			$this->set('$department', $department->name);
		}
		if($this->request->post){
			$post = $this->request->post;
			$errors = $this->check_data($post);
			if(count($errors) == 0){
				unset($post['itemid']);
				$data_id = Model::_save($datasource->tablename, $post);
				if($data_id > 0){
					$array = array();
					$array['datasource'] = $datasource->id;
					$array['year'] = idate('Y');
					$array['month'] = idate('m');
					$array['depart'] = $table_item->depart;
					$array['data'] = $data_id;
					$array['time'] = DATETIME;
					$array['mtime'] = DATETIME;
					$this->DSData->save($array);
					$this->response->redirect('show?itemid='.$id);
				}
				else{
					print_r($post);
					$this->set('error', 'SQL有误，记录打印的数据，请联系管理员');
				}
			}
			$this->set('errors', $errors);
			$this->set('data', $post);
		}
		$this->set('$table_item', $table_item);
		$this->set('$datasource', $datasource);
		$this->add_data($datasource);
	}
	
	public function show(){
		$data = $this->get_data();
		$id = intval($data['itemid']);
		$Staff = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'staff'=>$Staff->id, 'valid'=>1);
			$table_item = $this->KpiTableItem->get_row($cond);
			if($table_item){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$datasource = $this->Datasource->get($table_item->datasource);
		$this->set('$datasource', $datasource);
		if($table_item->depart > 0){
			$department = $this->Depart->get($table_item->depart);
			$this->set('$department', $department->name);
		}
		$cond = array('datasource'=>$table_item->datasource, 
						'depart'=>$table_item->depart);
		$all = $this->DSData->count($cond);
		$page = $data['page'];
		$limit = 10;
		$pager = new Pager($all, $page, $limit);
		$list = $this->DSData->get_page($cond, array('time'=>'DESC'), 
									$pager->now(), $limit);
		$home = SOURCEDATA_HOME;
		$page_list = $pager->get_page_links($home."/show?itemid=$id&");
		$this->set('item_id', $table_item->id);
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function edit(){
		$data = $this->get_data();
		$itemid = intval($data['itemid']);
		$id = intval($data['id']);
		$Staff = $this->get('User');
		$has_error = true;
		if($itemid > 0 && $id > 0){
			$cond = array('id'=>$itemid, 'staff'=>$Staff->id, 'valid'=>1);
			$table_item = $this->KpiTableItem->get_row($cond);
			if($table_item){
				$cond = array('id'=>$id, 'depart'=>$Staff->depart);
				$count = $this->DSData->count($cond);
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
			$ds_id = $table_item->datasource;
			$datasource = $this->Datasource->get($ds_id);
			unset($data['itemid']);
			Model::_save($datasource->tablename, $data);
		}
		$list = Model::get_joins(array('DS.*', 'D.name', 'D.tablename', 
										'T.name as department'),
					array('ds_data as DS', 'datasource as D', 
						'department as T'),
					array('DS.id'=>$id, 'DS.datasource eq'=>'`D`.`id`', 
						'DS.depart eq'=>'`T`.`id`'));
		$ds_data = $list[0];
		$data = Model::_get($ds_data->tablename, $ds_data->data);
		if($ds_data && $data){
			$this->set('data', (array)$data);
			$this->add_data($ds_data->tablename);
		}
		$this->set('$table_item', $table_item);
	}
	
	public function remove(){}
	
	public function delete(){}
	
}