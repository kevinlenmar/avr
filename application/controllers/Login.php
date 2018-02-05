<?php
	/**
	* 
	*/
	class Login extends CI_Controller
	{
		public function index($page = 'login'){
			if(!file_exists(APPPATH.'views/pages/login/'.$page.'.php')){
				show_404();
			}else{
				$this->load->view('pages/login/'.$page);
			}
		}
	}