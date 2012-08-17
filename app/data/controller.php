<?php

class DataController extends AppController {
	
	public $models = array('User', 'Datasource', 'DSData', 'Supervise');
	public $no_session = array();
	
	public function before(){
		$this->set('home', DATA_HOME);
		parent::before();
	}
	
	private function add_table_data($obj){
		$this->layout('data');
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
	
	public function index(){
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
		$User = $this->get('User');
		if($User->type == UserType::ADMIN){
			$departs = array();
		}
		else if($User->type == UserType::COMPANY){
//			$cond = array('user'=>$User->id);
//			$rets = $this->Supervise->get_list($cond);
//			$departs = get_attrs($rets, 'depart');
			$departs = array();
		}
		else if($User->type == UserType::DEPART){
//			$departs = array($User->depart);
			$departs = array();
		}
		else if($User->type == UserType::STAFF){
			$departs = array($User->depart);
		}
		else{
			echo 'aa';
			return;
		}
		
		$cond = array('datasource'=>$id);
		$cond2 = array('D.datasource'=>$id, 'D.data eq'=>'T.id');
		$page_link = $this->get('home')."/index?datasource=".$id;
		if(count($departs) == 1){
			$cond['depart'] = $departs[0];
			$cond2['D.depart'] = $departs[0];
		}
		else if(count($departs) > 1){
			$cond['depart in'] = $departs;
			$cond2['D.depart in'] = $departs;
		}
		if($data['from']){
			$cond['time >='] = $data['from'].' 00:00:00';
			$cond2['D.time >='] = $data['from'].' 00:00:00';
			$page_link .= "&from=".$data['from'];
		}
		if($data['to']){
			$cond['time <='] = $data['to'].' 23:59:59';
			$cond2['D.time <='] = $data['to'].' 23:59:59';
			$page_link .= "&to=".$data['to'];
		}
		$page_link .= '&';
		
		$all = $this->DSData->count($cond);
		$page = $data['page'];
		$limit = 10;
		$pager = new Pager($all, $page, $limit);
		$tablename = $datasource->tablename;
		
		$list = Model::get_joins(array('T.*', 'D.time as time'),
								array('ds_data as D', "$tablename as T"), 
								$cond2, 
								array('D.time'=>'DESC'), 
								$pager->get_limit_str());
		$this->set('data', $list);
		$this->set('$User', $User);
		$this->set('$page_list', $pager->get_page_links($page_link));
		$this->set('$datasource', $datasource);
		$this->add_table_data($datasource);
	}
	
	public function remove(){}
	public function delete(){}
	
}