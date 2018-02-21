<?php 
namespace Controllers;

class IndexController extends Controller{	
	
	public function index(){
		$data['messages'] = \Models\Message::find();
		$data['text'] = 'Main page';
		
		return $this->render('hello', $data);
	}
	
	public function view(){
		//return $this->view('post/view', [])
	}
}