<?php
/**
* 
*/
/**
* 
*/
class AVR extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('AVR_Model');
	}


	public function calendar($page = 'calendar'){
		if(!file_exists(APPPATH.'views/pages/calendar/'.$page.'.php')){
			show_404();
		}
			$data['title'] = ucfirst($page);

		if($this->session->userdata('emp_id')){

			$this->load->view('templates/header');
			$this->load->view('pages/calendar/'.$page, $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url() . 'login');
		}
			
			
	}

	public function dashboard($page = 'dashboard'){
		if(!file_exists(APPPATH.'views/pages/calendar/'.$page.'.php')){
			show_404();
		}


			$this->load->view('templates/header');
			$this->load->view('pages/calendar/'.$page);
			$this->load->view('templates/footer');	
	}

	public function create($page = 'create'){
		if(!file_exists(APPPATH.'views/pages/calendar/'.$page.'.php')){
			show_404();
		}


			$this->load->view('templates/header');
			$this->load->view('pages/calendar/'.$page);
			$this->load->view('templates/footer');	
	}

	public function login(){

		$this->form_validation->set_rules('emp_id', 'Employee ID', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run()){

			$emp_id = 	$this->input->post('emp_id');
			$password = $this->input->post('password');

			if($this->avr_model->can_login($emp_id, $password)){
				$session_data = array(
					'emp_id'	=>	$emp_id,
				);

				$this->session->set_userdata($session_data);
				redirect(base_url() . 'calendar');
			}else{
				$this->session->set_flashdata('error', 'Invalid Username and Password');
				redirect(base_url() . 'login');
			}

		}else{
			$this->load->view('pages/login/login');
		}
	}

	public function logout(){
		$this->session->unset_userdata('emp_id');
		redirect(base_url(). 'login');
	}

	public function event(){
		$data = $this->AVR_Model->get_event();
		echo json_encode($data);
	}

	public function create_event_prompt(){

			$param['idEvent']		= $this->input->post('idEvent');
			$param['title']			= $this->input->post('title');
			$param['department'] 	= $this->input->post('department');
			$param['cont_no'] 		= $this->input->post('cont_no');
			$param['startDay']		= $this->input->post('startDay');
			$param['endDay']		= $this->input->post('endDay');
			$param['startDate'] 	= $this->input->post('startDate');
			$param['endDate'] 		= $this->input->post('endDate');
			$param['color'] 		= "yellow";

				
			$data = $this->AVR_Model->create_event($param);
			echo json_encode($data);
	}

	public function proceed_event_prompt(){
		
		$param['idEvent']		= $this->input->post('idEvent');
		$param['title']			= $this->input->post('title');
		$param['department'] 	= $this->input->post('department');
		$param['cont_no'] 		= $this->input->post('cont_no');
		$param['startDay']		= $this->input->post('startDay');
		$param['endDay']		= $this->input->post('endDay');
		$param['startDate'] 	= $this->input->post('startDate');
		$param['endDate'] 		= $this->input->post('endDate');
		$param['color'] 		= "green";
		$param['approved'] 		= 1;
			
		$data = $this->AVR_Model->proceed_event($param);
		echo json_encode($data);
		
	}

	public function cancel_event_prompt(){
		$param['idEvent']		= $this->input->post('idEvent');
		$param['color'] 		= "red";
		$param['canceled'] 		= 1;
			
		$data = $this->AVR_Model->cancel_event($param);
		echo json_encode($data);
	}

	public function get_all_approved(){
		$data = $this->avr_model->get_approved();
		echo json_encode($data);
	}

	public function get_display_approved(){
		$param['startDate'] 	= $this->input->post('startDate');
		$param['endDate'] 		= $this->input->post('endDate');

		$data = $this->avr_model->display_approved($param);
		echo json_encode($data);
	}

	public function get_display_canceled(){
		$param['startDate'] 	= $this->input->post('startDate');
		$param['endDate'] 		= $this->input->post('endDate');

		$data = $this->avr_model->display_canceled($param);
		echo json_encode($data);
	}

	public function get_all_canceled(){
		$data = $this->avr_model->get_canceled();
		echo json_encode($data);
	}

	public function get_all_clusters(){
		$data = $this->avr_model->get_clusters();

		echo json_encode($data);
	}

	public function update(){
		$param['idEvent'] 		= $this->input->post('idEvent');
		$param['title']			= $this->input->post('title');
		$param['startDay'] 		= $this->input->post('startDay');
		$param['endDay'] 		= $this->input->post('endDay');
		$param['startDate'] 	= $this->input->post('startDate');
		$param['endDate']		= $this->input->post('endDate');

		$data = $this->AVR_Model->update_event($param);
		echo "working";
	}

	public function updateModal(){
		$param['idEvent'] 		= $this->input->post('idEvent');
		$param['title']			= $this->input->post('title');
		$param['emp_id'] 		= $this->input->post('emp_id');
		$param['emp_name'] 		= $this->input->post('emp_name');
		$param['department'] 	= $this->input->post('department');
		$param['position'] 		= $this->input->post('position');
		$param['cont_no'] 		= $this->input->post('cont_no');
		$param['startDay'] 		= $this->input->post('startDay');
		$param['endDay'] 		= $this->input->post('endDay');
		$param['startDate'] 	= $this->input->post('startDate');
		$param['endDate']		= $this->input->post('endDate');

		$data = $this->AVR_Model->updateModal_event($param);
		redirect('calendar', 'refresh');
	}

	public function delete(){
		$id = $this->input->post('idEvent');
		$data = $this->AVR_Model->delete_event($id);
		redirect('calendar', 'refresh');
	}
}