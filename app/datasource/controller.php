<?php

class DatasourceController extends AppController {
	
	public $models = array('User', 'Datasource', 'DSData');
	public $no_session = array();
	
	public function before(){
		$this->set('home', DATASOURCE_HOME);
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
		$all = $this->Datasource->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Datasource->get_page($cond, array('id'=>'ASC'), 
												$pager->now(), $limit);
		$page_list = $pager->get_page_links(DATASOURCE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function get_attr_index($column){
		$index = 0;
		$l = strlen($column);
		$A = ord('A');
		for($i = 0;$i < $l;$i++){
			$index = $index * 26 + ord($column[$i]) - $A + 1;
		}
		return $index;
	}
	
	private function get_attr_name($index){
		$A = ord('A');
		$name = '';
		$a = $index;
		$b = 0;
		while($a > 0){
			$t = $a;
			$a = intval(($t - 1) / 26);
			$b = ($t - 1) % 26;
			$name .= chr($A + $b);
		}
		return $name; 
	}
	
	private function add_data(&$datasource){
		if(isset($datasource->comment) && strlen(trim($datasource->comment)) > 0){
			$comment = $datasource->comment;
			$array = explode(',', $comment);
			$datasource->column = array();
			foreach($array as $attr){
				$datasource->column[$attr] = '';
			}
		}
		else if(isset($datasource->tablename)){
			$datasource->column = array();
			$name = $datasource->tablename;
			$struct = Model::describe_table($name, 
							array('column_name', 'column_comment'));
			if(is_array($struct)){
				foreach($struct as $std){
					if($std->column_name != 'id'){
						$key = $std->column_comment;
						while(array_key_exists($key, $datasource->column)){
							$key .= '(1)';
						}
						$datasource->column[$key] = $std->column_name;
					}
				}
			}
		}
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$column = $post['column'];
			$comment = $post['comment'];
			$errors = $this->Datasource->check($post);
			$cond = array('name'=>$post['name']);
			if(!isset($errors['name'])){
				$count = $this->Datasource->count($cond);
				if($count > 0){
					$errors['name'] = '此数据源表格已存在';
				}
			}
			$this->check_slug_unique($errors);
			if(count($errors) == 0){
				unset($post['column']);
				unset($post['comment']);
				$table_name = 'datasource_'.$post['slug'];
				$post['tablename'] = $table_name;
				$post['valid'] = 1;
				$this->Datasource->escape($post);
				$this->Datasource->save($post);
				
				$column_array = array();
				if(!empty($column)){
					$column_array = explode(',', $column);
				}
				$comment_array = array();
				if(!empty($comment)){
					$comment_array = explode(',', $comment);
				}
				$count = count($column_array);
				
				if($count == count($comment_array)){
					$attr_array = array();
					$attr_array[] = array('name'=>id, 'type'=>'int', 
										'null'=>false, 'auto'=>true);
					$index = 1;
					for($i = 0;$i < $count;$i++){
						$column = trim($column_array[$i]);
						$comment = trim($comment_array[$i]);
						$t = array('type'=>'varchar');
						$t['name'] = $this->get_attr_name($index);
						$t['comment'] = $comment;
						$attr_array[] = $t;
						$index += 1;
					}
					Model::create_table($table_name, $attr_array);
				}
				
				$this->response->redirect('index');
			}
			else{
				$datasource = $this->set_model($post);
				$this->add_data($datasource);
				$this->set('errors', $errors);
				$this->set('$datasource', $datasource);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$column = $post['column'];
			$comment = $post['comment'];
			unset($post['column']);
			unset($post['comment']);
			$id = get_id($post);
			if($id > 0){
				$datasource = $this->Datasource->get($id);
			}
			if($datasource){
				$datasource = $this->set_model($post, $datasource);
				$errors = $this->Datasource->check($datasource);
				if(count($errors) == 0){
					$this->Datasource->escape($post);
					$this->Datasource->save($post);
					
					$column_array = explode(',', $column);
					$comment_array = explode(',', $comment);
					$struct = Model::describe_table($datasource->tablename, 
							array('column_name', 'column_comment'));
					$struct_array = array();
					$max_index = 0;
					foreach($struct as $column){
						$struct_array[$column->column_name] = $column->column_comment;
						if($column->column_name != 'id'){
							$index = $this->get_attr_index($column->column_name);
							$max_index = $max_index < $index ? $index : $max_index;
						}
					}
					$count = count($column_array);
					$index = $max_index + 1;
					if($count == count($comment_array)){
						$alter_array = array();
						$add_array = array();
						$remove_array = array_diff(array_keys($struct_array), 
											$column_array, array('id'));
						for($i = 0;$i < $count;$i++){
							$column = trim($column_array[$i]);
							$comment = trim($comment_array[$i]);
							if(array_key_exists($column, $struct_array)){
								if($comment != $struct_array[$column]){
									$t = array('type'=>'varchar');
									$t['comment'] = $comment;
									$alter_array[$column] = $t;
								}
							}
							else if($column == 'new'){
								$t = array('type'=>'varchar');
								$t['name'] = $this->get_attr_name($index);
								$t['comment'] = $comment;
								$add_array[] = $t;
								$index += 1;
							}
						}
						$table_name = $datasource->tablename;
						foreach($add_array as $attr){
							Model::alter_table('add', $table_name, $attr['name'], $attr);
						}
						foreach($alter_array as $column => $array){
							Model::alter_table('modify', $table_name, $column, 
												$array);
						}
						foreach($remove_array as $column){
							Model::alter_table('remove', $table_name, $column);
						}
					}
					
					$this->response->redirect('edit?succ=1&id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->add_data($datasource);
					$this->set('$datasource', $datasource);
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
				$datasource = $this->Datasource->get($id);
			}
			if($datasource){
				$this->add_data($datasource);
				$this->set('$datasource', $datasource);
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
		parent::remove();
	}
	
	private function add_table_data($obj){
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
	
	public function show(){
		$data = $this->get_data();
		$id = intval($data['datasource']);
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'valid'=>1);
			$datasource = $this->Datasource->get_row($cond);
			if($datasource){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$this->set('$datasource', $datasource);
		$cond = array('datasource'=>$id);
		$all = $this->DSData->count($cond);
		$page = $data['page'];
		$limit = 10;
		$pager = new Pager($all, $page, $limit);
		$tablename = $datasource->tablename;
		$list = Model::get_joins(array('T.*', 'D.time as time'),
								array('ds_data as D', "$tablename as T"), 
								array('D.datasource'=>$id, 'D.data eq'=>'T.id'), 
								array('D.time'=>'DESC'), 
								$pager->get_limit_str());
		$this->set('data', $list);
		$home = $this->get('home');
		$page_list = $pager->get_page_links($home."/show?dsid=$id&");
		$this->set('$page_list', $page_list);
		$this->add_table_data($datasource);
	}
	
	public function editdata(){
		$data = $this->get_data();
		$dsid = intval($data['datasource']);
		$id = intval($data['id']);
		$has_error = true;
		if($dsid > 0 && $id > 0){
			$cond = array('id'=>$dsid, 'valid'=>1);
			$datasource = $this->Datasource->get_row($cond);
			if($datasource){
				$tablename = $datasource->tablename;
				$d = Model::_get($tablename, $id);
				if($d){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			unset($data['datasource']);
			Model::_save($datasource->tablename, $data);
			$this->response->redirect("editdata?succ=1&datasource=$dsid&id=$id");
		}
		$this->set('$data', $d);
		$this->add_table_data($datasource);
		$this->set('datasource', $datasource);
	}
	
}