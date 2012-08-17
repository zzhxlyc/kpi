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
		for($i = 0;$i < count($list);$i++){
			if($list[$i]->COLUMN_NAME == 'id'){
				unset($list[$i]);
				break;
			}
		}
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
		$this->set('$table_item', $table_item);
		$this->set('$datasource', $datasource);
		$this->add_data($datasource);
	}
	
	public function addrow(){
		if($this->request->post){
			$post = $this->request->post;
			$data = $post;
			$id = intval($data['dsid']);	//datasource id
			$Staff = $this->get('User');
			$has_error = true;
			if($id > 0){
				$cond = array('id'=>$id, 'valid'=>1);
				$datasource = $this->Datasource->get_row($cond);
				$cond = array('datasource'=>$id, 'staff'=>$Staff->id, 'valid'=>1);
				$table_item = $this->KpiTableItem->get_row($cond);
				if($datasource && $table_item){
					$has_error = false;
				}
			}
			if($has_error){
				exit('0');
			}
			
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
					exit('1');
				}
				else{
					exit('0');
				}
			}
		}
	}
	
	public function show(){
		$data = $this->get_data();
		$id = intval($data['dsid']);
		$Staff = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'valid'=>1);
			$datasource = $this->Datasource->get_row($cond);
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
		$tablename = $datasource->tablename;
		$list = Model::get_joins(array('T.*', 'D.time as time'),
								array('ds_data as D', "$tablename as T"), 
								array('D.datasource'=>$table_item->datasource, 
										'D.depart'=>$Staff->depart,'D.data eq'=>'T.id'), 
								array('D.time'=>'DESC'), 
								$pager->get_limit_str());
		$this->set('data', $list);
		$home = $this->get('home');
		$page_list = $pager->get_page_links($home."/show?dsid=$id&");
		$this->set('$page_list', $page_list);
		$this->add_data($datasource);
	}
	
	public function remove(){}
	
	public function delete(){}
	
}