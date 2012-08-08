<?php

class KpiController extends AppController {
	
	public $models = array('User', 'KpiTable', 'KpiTableItem', 
					'KpiData', 'KpiDataItem', 'Datasource', 'DsData');
	public $no_session = array();
	
	public function before(){
		$this->set('home', KPI_HOME);
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
		$all = $this->KpiData->count();
		$pager = new Pager($all, $page, $limit);
		$list = Model::get_joins(array('D.*', 'T.name as table'), 
					array('kpi_data as D', 'kpi_table as T'), 
					array('D.depart'=>$Director->depart, 
							'D.kpi_table eq'=>'`T`.`id`'), 
					array('D.time'=>'DESC'),
					$limit);
		$page_list = $pager->get_page_links(KPI_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data(&$kpidata = Null){
		$director = get_user($this->session);
		$list = $this->KpiTable->get_list(array('manager'=>$director, 'valid'=>1));
		$this->set('kpi_table_list', $list);
	}
	
	private function add_item_data(&$kpiitem = Null){
		$this->add_data();
		$ds_list = $this->Datasource->get_list();
		$this->set('$ds_list', $ds_list);
		$staff_list = $this->User->get_list(array('type'=>UserType::STAFF), 
								array('name'=>'ASC'));
		$this->set('$staff_list', $staff_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$Director = $this->get('User');
			if(empty($post['month2'])){
				unset($post['month2']);
			}
			$post['manager'] = $Director->id;
			$post['depart'] = $Director->depart;
			$post['score'] = 0;
			$post['status'] = KpiDataStatus::OPEN;
			$post['time'] = DATETIME;
			$errors = $this->KpiData->check($post);
			if(count($errors) == 0){
				$this->KpiData->escape($post);
				$dataid = $this->KpiData->save($post);
				
				$cond = array('kpi_table'=>$post['kpi_table']);
				$tableitems = $this->KpiTableItem->get_list($cond);
				if(count($tableitems) > 0){
					foreach($tableitems as $item){
						$data = array();
						$data['kpi_data'] = $dataid;
						$data['kpi_table_item'] = $item->id;
						$data['score_depart'] = $item->score_depart;
						$data['score'] = -1;
						$data['verify'] = 0;
						$data['modified'] = 0;
						$data['time'] = DATETIME;
						$data['mtime'] = DATETIME;
						$this->KpiDataItem->save($data);
					}
				}
				
				$this->response->redirect('index');
			}
			else{
				$kpidata = $this->set_model($post, new KpiData());
				$this->set('errors', $errors);
				$this->set('$kpidata', $kpidata);
			}
		}
		$this->add_data($kpidata);
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = get_id($data);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'depart'=>$Director->depart);
			$kpidata = $this->KpiData->get_row($cond);
			if($kpidata){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$kpidata = $this->set_model($post, $kpidata);
			$errors = $this->KpiData->check($kpidata);
			if(count($errors) == 0){
				$this->KpiData->escape($post);
				$this->KpiData->save($post);
				$this->response->redirect('edit?succ=1&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->add_data($kpidata);
		$this->set('$kpidata', $kpidata);
	}
	
	public function remove(){}

	public function delete(){
		$data = $this->get_data();
		$id = get_id($data);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'depart'=>$Director->depart);
			$kpidata = $this->KpiData->get_row($cond);
			if($kpidata){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect('index');
		}
		
		$id_array = $this->get_delete_ids();
		if(count($id_array) > 0){
			$this->KpiDataItem->delete_all(array('kpi_data in'=>$id_array));
		}
		parent::delete('KpiData');
	}
	
	public function show(){
		$data = $this->get_data();
		$id = get_id($data);
		$Director = $this->get('User');
		$has_error = true;
		if($id > 0){
			$cond = array('id'=>$id, 'depart'=>$Director->depart);
			$kpidata = $this->KpiData->get_row($cond);
			if($kpidata){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$this->set('$kpidata', $kpidata);
		$item_list = $this->KpiTableItem->get_list(
								array('kpi_table'=>$kpidata->kpi_table));
		$tlist = $this->KpiDataItem->get_list(array('kpi_data'=>$kpidata->id));
		$data_item_list = array_to_map($tlist, 'kpi_table_item');
		$this->set('$data_item_list', $data_item_list);
		$this->set('$list', $item_list);
	}
	
	public function score(){
		$data = $this->get_data();
		$has_error = true;
		$dataid = $data['dataid'];
		$itemid = $data['itemid'];
		$Director = $this->get('User');
		if($dataid > 0 && $itemid > 0){
			$kpidata = $this->KpiData->get($dataid);
			$tableitem = $this->KpiTableItem->get($itemid);
		}
		if($kpidata && $tableitem){
			if($kpidata->kpi_table == $tableitem->kpi_table){
				$kpi_table = $this->KpiTable->get($kpidata->kpi_table);
				if($kpi_table){
					if($kpidata->depart == $Director->depart 
							&& $kpi_table->depart == $Director->depart){
						$has_error = false;
					}
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		/*
		if($this->request->post){
			$post = $this->request->post;
			$score = intval($post['score']);
			$data = array('score'=>$score);
			$id = intval($post['id']);
			$old_score = 0;
			if($id > 0){
				$data['id'] = $id;
				$data_item = $this->KpiDataItem->get($id);
				if($data_item){
					$old_score = $data_item->score;
				}
			}
			$data['kpi_data'] = $kpidata->id;
			$data['kpi_table_item'] = $tableitem->id;
			$data['verify'] = 0;
			$data['modified'] = 0;
			$data['time'] = DATETIME;
			$data['mtime'] = DATETIME;
			$errors = $this->KpiDataItem->check($data);
			if($score < 0 || $score > 100){
				$errors['score'] = '分数有误';
			}
			if(count($errors) == 0){
				$this->KpiDataItem->escape($data);
				$this->KpiDataItem->save($data);
				
				$new_score = $kpidata->score + ($score - $old_score) * $tableitem->weight / 100;
				$array = array('id'=>$kpidata->id, 'score'=>intval($new_score));
				$this->KpiData->save($array);
				
				$this->response->redirect('show?id='.$kpidata->id);
			}
			else{
				$this->set('errors', $errors);
				$this->set('$score', $score);
			}
		}
		else{
			$cond = array('kpi_data'=>$kpidata->id, 'kpi_table_item'=>$tableitem->id);
			$dataitem = $this->KpiDataItem->get_row($cond);
			if($dataitem){
				$this->set('$score', $dataitem->score);
				$this->set('id', $dataitem->id);
			}
		}
		*/
		$cond = array('kpi_data'=>$kpidata->id, 'kpi_table_item'=>$tableitem->id);
		$dataitem = $this->KpiDataItem->get_row($cond);
		$this->set('$dataitem', $dataitem);
		$this->set('$kpidata', $kpidata);
		$this->set('$kpitable', $kpi_table);
		$this->set('$tableitem', $tableitem);
	}
	
	public function data(){
		$data = $this->get_data();
		$has_error = true;
		$itemid = $data['itemid'];
		$Director = $this->get('User');
		if($itemid > 0){
			$tableitem = $this->KpiTableItem->get($itemid);
		}
		if($tableitem){
			$kpi_table = $this->KpiTable->get($tableitem->kpi_table);
			if($kpi_table){
				if($kpi_table->depart == $Director->depart){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$this->set('$tableitem', $tableitem);
		$datasource = $this->Datasource->get($tableitem->datasource);
		$this->set('$datasource', $datasource);
		$tablename = $datasource->tablename;
		$from = $data['from'];
		$to = $data['to'];
		if(empty($from) && empty($to)){
			return;
		}
		$page = $data['page'];
		$limit = 10;
		$cond = array('datasource'=>$datasource->id);
		if(!empty($from)){
			$cond['time >='] = $from.' 00:00:00';
		}
		if(!empty($to)){
			$cond['time <='] = $to.' 23:59:59';
		}
		$all = $this->DsData->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->DsData->get_page($cond, array('time'=>'DESC'), 
												$pager->now(), $limit);
		$this->set('$list', $list);
	}
	
	public function detail(){
		$data = $this->get_data();
		$has_error = true;
		$dsid = $data['dsid'];
		$Director = $this->get('User');
		if($dsid > 0){
			$ds_data = $this->DsData->get($dsid);
		}
		if($ds_data){
			$datasource = $this->Datasource->get($ds_data->datasource);
			$has_error = false;
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$tablename = $datasource->tablename;
		$data = Model::_get($tablename, $ds_data->data);
		$this->set('data', (array)$data);
		$list = Model::describe_table($tablename, 
						array('COLUMN_NAME', 'COLUMN_COMMENT'));
		$this->set('$list', $list);
	}
	
}