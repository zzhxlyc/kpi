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
		$staff = get_user($this->session);
		$sql = 'SELECT distinct(`datasource`) FROM `kpi`.`kpi_table_item` WHERE `staff` = '.$staff;
		$ds_list = Model::_select($sql);
		$ds_id_array = get_attrs($ds_list, 'datasource');
		if(count($ds_id_array) > 0){
			$list = $this->Datasource->get_list(array('id in'=>$ds_id_array));
		}
		else{
			$list = array();
		}
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
		$id = intval($data['dsid']);
		$Staff = $this->get('User');
		$has_error = true;
		if($id > 0){
			$datasource = $this->Datasource->get($id);
			$cond = array('datasource'=>$id, 'staff'=>$Staff->id, 'valid'=>1);
			$table_item = $this->KpiTableItem->get_row($cond);
			if($datasource && $table_item){
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
				unset($post['dsid']);
				$data_id = Model::_save($datasource->tablename, $post);
				if($data_id > 0){
					$array = array();
					$array['datasource'] = $datasource->id;
					$array['year'] = idate('Y');
					$array['month'] = idate('m');
					$array['depart'] = $Staff->depart;
					$array['data'] = $data_id;
					$array['time'] = DATETIME;
					$array['mtime'] = DATETIME;
					$this->DSData->save($array);
					$this->response->redirect('show?dsid='.$id);
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
		$id = intval($data['dsid']);
		$Staff = $this->get('User');
		$has_error = true;
		if($id > 0){
			$datasource = $this->Datasource->get($id);
			$cond = array('datasource'=>$id, 'staff'=>$Staff->id, 'valid'=>1);
			$table_item = $this->KpiTableItem->get_row($cond);
			if($datasource && $table_item){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$this->set('$datasource', $datasource);
		$cond = array('datasource'=>$table_item->datasource, 'depart'=>$Staff->depart);
		$all = $this->DSData->count($cond);
		$page = $data['page'];
		$limit = 10;
		$pager = new Pager($all, $page, $limit);
		$list = $this->DSData->get_page($cond, array('time'=>'DESC'), 
									$pager->now(), $limit);
		$home = $this->get('home');
		$page_list = $pager->get_page_links($home."/show?dsid=$id&");
		$this->set('item_id', $table_item->id);
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function edit(){
		$data = $this->get_data();
		$dsid = intval($data['dsid']);
		$id = intval($data['id']);	//DsData id
		$Staff = $this->get('User');
		$has_error = true;
		if($dsid > 0 && $id > 0){
			$datasource = $this->Datasource->get($dsid);
			$cond = array('datasource'=>$dsid, 'staff'=>$Staff->id, 'valid'=>1);
			$table_item = $this->KpiTableItem->get_row($cond);
			if($datasource && $table_item){
				$cond = array('id'=>$id, 'depart'=>$Staff->depart);
				$ds_data = $this->DSData->get_row($cond);
				if($ds_data){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			unset($data['dsid']);
			$data['id'] = $ds_data->data;
			Model::_save($datasource->tablename, $data);
			$this->response->redirect("edit?succ=1&dsid=$dsid&id=$id");
		}
		$list = Model::get_joins(array('DS.*', 'D.name', 'D.tablename', 
										'T.name as department'),
					array('ds_data as DS', 'datasource as D', 
						'department as T'),
					array('DS.id'=>$id, 'DS.datasource eq'=>'`D`.`id`', 
						'DS.depart eq'=>'`T`.`id`'));
		$ds_data = $list[0];
		$data = Model::_get($ds_data->tablename, $ds_data->data);
		$this->set('ds_data', $ds_data);
		if($ds_data && $data){
			$this->set('data', (array)$data);
			$this->add_data($ds_data->tablename);
		}
		$this->set('datasource', $datasource);
	}
	
	public function remove(){}
	
	public function delete(){}
	
}