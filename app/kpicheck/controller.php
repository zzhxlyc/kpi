<?php

class KpicheckController extends AppController {
	
	public $models = array('User', 'Supervise', 'Depart','KpiTable', 'KpiTableItem', 
					'KpiData', 'KpiDataItem', 'Datasource', 'DsData');
	public $no_session = array();
	
	public function before(){
		$this->set('home', KPICHECK_HOME);
		parent::before();
		$User = $this->get('User');
		if($User->type != UserType::COMPANY){
			$this->go_login();
		}
	}
	
	public function depart(){
		$get = $this->request->get;
		$Director = $this->get('User');
		$list = Model::get_joins(array('D.*'), 
						array('supervise as S', 'department as D'),
						array('S.user'=>$Director->id, 'D.valid'=>1,
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
	
	public function kpidata(){
		$get = $this->request->get;
		$did = $get['did'];
		$Director = $this->get('User');
		$has_error = true;
		if($did > 0){
			$depart = $this->Depart->get($did);
			if($depart){
				$cond = array('user'=>$Director->id, 'depart'=>$did);
				$yes = $this->Supervise->count($cond);
				if($yes == 1){
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
		$cond = array('depart'=>$did, 'status >='=>KpiDataStatus::OPEN);
		$all = $this->KpiData->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->KpiData->get_page($cond, array('time'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(KPICHECK_HOME."/kpidata?did=$did&");
		$this->set('$list', $list);
		$this->set('$depart', $depart);
		$this->set('$page_list', $page_list);
	}
	
	public function kpiitem(){
		$get = $this->request->get;
		$dataid = $get['dataid'];
		$Director = $this->get('User');
		$has_error = true;
		if($dataid > 0){
			$kpidata = $this->KpiData->get($dataid);
			if($kpidata){
				$cond = array('user'=>$Director->id, 'depart'=>$kpidata->depart);
				$yes = $this->Supervise->count($cond);
				if($yes == 1){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$cond = array('kpi_table'=>$kpidata->kpi_table);
		$list = Model::get_joins(array('K.*', 'D.name as department'), 
								array('kpi_table_item as K', 'department as D'),
								array('K.kpi_table eq'=>$kpidata->kpi_table, 
										'K.score_depart eq'=>'D.id'));
		$data_list = $this->KpiDataItem->get_list(array('kpi_data'=>$kpidata->id));
		$data_list = array_to_map($data_list, 'kpi_table_item');
		$this->set('$kpidata', $kpidata);
		$this->set('$list', $list);
		$this->set('$data_list', $data_list);
	}
	
	public function itemdetail(){
		$get = $this->request->get;
		$itemid = $get['itemid'];	//data item
		$Director = $this->get('User');
		$has_error = true;
		if($itemid > 0){
			$dataitem = $this->KpiDataItem->get($itemid);
			if($dataitem){
				$tableitem = $this->KpiTableItem->get($dataitem->kpi_table_item);
				if($tableitem){
					$cond = array('user'=>$Director->id, 'depart'=>$tableitem->depart);
					$yes = $this->Supervise->count($cond);
					if($yes == 1){
						$has_error = false;
					}
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$this->set('$tableitem', $tableitem);
		$this->set('$dataitem', $dataitem);
		$staff = $this->User->get($tableitem->staff);
		$depart = $this->Depart->get($staff->depart);
		$datasource = $this->Datasource->get($tableitem->datasource);
		$this->set('$staff', $staff);
		$this->set('$depart', $depart);
		$this->set('$datasource', $datasource);
	}
	
	public function datasource(){
		$get = $this->request->get;
		$dsid = $get['dsid'];	//data item
		$Director = $this->get('User');
		$has_error = true;
		if($dsid > 0){
			$datasource = $this->Datasource->get($dsid);
			if($datasource){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$this->set('$dataitem', $dataitem);
		$this->set('$tableitem', $tableitem);
		$this->set('$datasource', $datasource);
		
		$tablename = $datasource->tablename;
		$from = $get['from'];
		$to = $get['to'];
		if(empty($from) && empty($to)){
			return;
		}
		$page = $get['page'];
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
		$page_list = $pager->get_page_links($this->get('home')."/datasource?dsid=$dsid&");
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function detail(){
		$data = $this->get_data();
		$has_error = true;
		$dsid = $data['dsid'];	//DsData id
		$Director = $this->get('User');
		if($dsid > 0){
			$ds_data = $this->DsData->get($dsid);
			if($ds_data){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$datasource = $this->Datasource->get($ds_data->datasource);
		$tablename = $datasource->tablename;
		$data = Model::_get($tablename, $ds_data->data);
		$this->set('data', (array)$data);
		$list = Model::describe_table($tablename, 
						array('COLUMN_NAME', 'COLUMN_COMMENT'));
		$this->set('$list', $list);
	}
	
	public function kpitable(){
		$get = $this->request->get;
		$did = $get['did'];
		$Director = $this->get('User');
		$has_error = true;
		if($did > 0){
			$depart = $this->Depart->get($did);
			if($depart){
				$cond = array('user'=>$Director->id, 'depart'=>$did);
				$yes = $this->Supervise->count($cond);
				if($yes == 1){
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
		$cond = array('depart'=>$did, 'valid'=>1);
		$all = $this->KpiTable->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->KpiTable->get_page($cond, array('time'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(KPICHECK_HOME."/kpitable?did=$did&");
		$this->set('$list', $list);
		$this->set('$depart', $depart);
		$this->set('$page_list', $page_list);
	}
	
	public function tableitem(){
		$get = $this->request->get;
		$tableid = $get['tableid'];
		$Director = $this->get('User');
		$has_error = true;
		if($tableid > 0){
			$kpitable = $this->KpiTable->get($tableid);
			if($kpitable){
				$cond = array('user'=>$Director->id, 'depart'=>$kpitable->depart);
				$yes = $this->Supervise->count($cond);
				if($yes == 1){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		$cond = array('kpi_table'=>$kpitable->id);
		$list = $this->KpiTableItem->get_list($cond);
		$this->set('$kpitable', $kpitable);
		$this->set('$list', $list);
	}
	
	public function itemshow(){
		$get = $this->request->get;
		$itemid = $get['itemid'];	//table item
		$Director = $this->get('User');
		$has_error = true;
		if($itemid > 0){
			$tableitem = $this->KpiTableItem->get($itemid);
			if($tableitem){
				$cond = array('user'=>$Director->id, 'depart'=>$tableitem->depart);
				$yes = $this->Supervise->count($cond);
				if($yes == 1){
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
		$staff = $this->User->get($tableitem->staff);
		$depart = $this->Depart->get($staff->depart);
		$this->set('$datasource', $datasource);
		$this->set('$staff', $staff);
		$this->set('$depart', $depart);
	}
	
	public function itemedit(){
		$data = $this->get_data();;
		$itemid = $data['itemid'];	//table item
		$Director = $this->get('User');
		$has_error = true;
		if($itemid > 0){
			$tableitem = $this->KpiTableItem->get($itemid);
			if($tableitem){
				$cond = array('user'=>$Director->id, 'depart'=>$tableitem->depart);
				$yes = $this->Supervise->count($cond);
				if($yes == 1){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->set('error', '参数有误');
			return;
		}
		
		if($this->request->post){
			$data['id'] = $data['itemid'];
			unset($data['itemid']);
			$tableitem = $this->set_model($data, $tableitem);
			$errors = $this->KpiTableItem->check($tableitem);
			$data['weight'] = intval($data['weight']);
			if($data['weight'] <= 0 || $data['weight'] > 100){
				$errors['weight'] = '数据有误';
			}
			if(count($errors) == 0){
				$data['modified'] = 1;
				$this->KpiTableItem->escape($data);
				$this->KpiTableItem->save($data);
				$this->response->redirect('itemedit?succ=1&itemid='.$itemid);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('$tableitem', $tableitem);
		$ds_list = $this->Datasource->get_list(array('valid'=>1));
		$this->set('$ds_list', $ds_list);
		$staff_list = Model::get_joins(array('U.*', 'D.name as department'),
										array('user as U', 'department as D'), 
										array('U.type'=>UserType::STAFF, 'U.valid'=>1, 
											'U.depart eq'=>'`D`.`id`'),
										array('U.name'=>'ASC'));
		$this->set('$staff_list', $staff_list);
	}
	
}