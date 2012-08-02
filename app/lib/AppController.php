<?php

class AppController extends Controller{
	
	public function before(){
		$this->load_session();
		$user = get_user($this->session);
		if($user > 0){
			$User = $this->User->get_row(array('id'=>$user));
			$this->set('User', $User);
		}
		else{
			$this->response->redirect(LOGIN_HOME);
		}
		if($this->is_set('home')){
			$this->set('index_page', $this->get('home').'/index');
		}
	}
	
	public function go_login(){
		$this->session->set('user', '');
		$this->response->redirect(LOGIN_HOME);
	}
	
	public function get_data(){
		if($this->request->post){
			return $this->request->post;
		}
		else{
			return $this->request->get;
		}
	}
	
	protected function get_delete_ids($get = Null, $post = Null){
		if($get == Null) $get = $this->request->get;
		if($post == Null) $post = $this->request->post;
		if(isset($get['id'])){
			$r = array($get['id']);
		}
		if(isset($post['id'])){
			$r = $post['id'];
		}
		if(isset($r) && count($r) > 0){
			$r = array_map('intval', $r);
			return $r;
		}
		else{
			return array();
		}
	}
	
	public function remove($model = '', $redirect = 'index'){
		if($model == ''){
			$model = $this->request->module;
		}
		$Model = ucfirst($model);
		$model = strtolower($model);
		$id_array = $this->get_delete_ids();
		$this->{$Model}->update(array('valid'=>0), array('id in'=>$id_array));
		if($redirect){
			$this->response->redirect($redirect);
		}
	}
	
	public function delete($model = '', $redirect = 'index'){
		if($model == ''){
			$model = $this->request->module;
		}
		$Model = ucfirst($model);
		$model = strtolower($model);
		if($this->request->post){
			$post = $this->request->post;
			if(isset($post['id'])){
				$ids = $post['id'];
				if(is_array($ids) && count($ids) > 0){
					$num = $this->{$Model}->delete($ids);
				}
			}
		}
		else{
			$get = $this->request->get;
			if(isset($get['id'])){
				$id = intval($get['id']);
				if($id > 0){
					$this->{$Model}->delete($id);
				}
			}
		}
		if($redirect){
			$this->response->redirect($redirect);
		}
	}
	
	protected function check_slug_unique(&$errors, $model = ''){
		$slug = trim($this->request->post['slug']);
		$this->request->post['slug'] = $slug;
		if($slug){
			if($model == ''){
				$model = ucfirst($this->request->get_module());
			}
			$slug = esc_text($slug);
			if(preg_match("/^[A-Za-z0-9_]+$/", $slug)){
				$count = $this->{$model}->count(array('slug'=>$slug));
				if($count > 0){
					$errors['slug'] = '已被使用';
				}
			}
			else{
				$errors['slug'] = '只能包含英文数字下划线';
			}
		}
	}
	
}