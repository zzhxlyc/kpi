<?php

class ScoreController extends AppController {
	
	public $models = array('User', 'KpiTable', 'KpiTableItem', 'Depart', 
					'KpiData', 'KpiDataItem', 'Datasource', 'DsData');
	public $no_session = array();
	
	public function before(){
		$this->set('home', SCORE_HOME);
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
		$all = $this->KpiDataItem->count(array('score_depart'=>$Director->depart));
		$pager = new Pager($all, $page, $limit);
		$list = Model::get_joins(array('KD.name as dataname', 'KDI.*', 
										'KTI.name as itemname', 'KTI.depart as depart'), 
					array('kpi_data_item as KDI', 'kpi_data as KD', 
									'kpi_table_item as KTI'), 
					array('KDI.score_depart'=>$Director->depart, 
							'KDI.kpi_table_item eq'=>'`KTI`.`id`', 
							'KTI.type !='=>KpiItemType::FOUJUE,
							'KDI.kpi_data eq'=>'`KD`.`id`'), 
					array('KDI.time'=>'DESC'),
					$pager->get_limit_str());
		$page_list = $pager->get_page_links(SCORE_HOME.'/index?');
		$this->set('list', $list);
		$departs = $this->Depart->get_list();
		$departs = array_to_map($departs);
		$this->set('departs', $departs);
		$this->set('$page_list', $page_list);
	}
	
	public function score(){
		$data = $this->get_data();
		$has_error = true;
		$id = intval($data['id']);	//data item id
		$Director = $this->get('User');
		if($id > 0){
			$dataitem = $this->KpiDataItem->get($id);
		}
		if($dataitem){
			$tableitem = $this->KpiTableItem->get($dataitem->kpi_table_item);
			if($tableitem && $tableitem->type != KpiItemType::FOUJUE
				&& $tableitem->score_depart == $Director->depart){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
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
					if($old_score == -1){
						$old_score = 0;
					}
				}
			}
			$data['mtime'] = DATETIME;
			if($score < 0 || $score > 100){
				$errors['score'] = '分数有误';
			}
			if(count($errors) == 0){
				$this->KpiDataItem->escape($data);
				$this->KpiDataItem->save($data);
				
				$kpidata = $this->KpiData->get($dataitem->kpi_data);
				if($tableitem->type != KpiItemType::FOUJUE){
					$new_score = $kpidata->score + 
							($score - $old_score) * $tableitem->weight / 100;
				}
				else{
					if($score < 60){
						$new_score = 0;
					}
					else{
						$new_score = $old_score;
					}
				}
				if($old_score != $new_score){
					$array = array('id'=>$kpidata->id, 'score'=>intval($new_score));
					$this->KpiData->save($array);
				}
				
				$this->response->redirect('index');
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$kpitable = $this->KpiTable->get($tableitem->kpi_table);
		$depart = $this->Depart->get($tableitem->depart);
		$this->set('$dataitem', $dataitem);
		$this->set('$kpitable', $kpitable);
		$this->set('$depart', $depart);
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
			if($tableitem->score_depart == $Director->depart){
				$has_error = false;
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
			if($ds_data->depart == $Director->depart){
				$has_error = false;
			}
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