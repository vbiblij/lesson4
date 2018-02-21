<?php 
namespace Controllers;

class PostController extends Controller{	
	/*public function __construct(){
		
	}*/
	
	public function index(){
		$data['messages'] = \Models\Message::find();
		$data['text'] = 'Hello';
		
		return $this->render('hello', $data);
	}
	
	public function view(){
		//return $this->view('post/view', [])
	}
}