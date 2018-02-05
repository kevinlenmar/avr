<?php
	/**
	* 
	*/
	class AVR_Model extends CI_Model
	{
		
		public function __construct()
		{
			$this->load->database();
		}

		public function create_event($param){

			$data = array(
				'idEvent'			=> $param['idEvent'],
				'title'				=> $param['title'],
				'department' 		=> $param['department'],
				'cont_no'			=> $param['cont_no'],
				'startDay'			=> $param['startDay'],
				'endDay'			=> $param['endDay'],
				'startDate'			=> $param['startDate'],
				'endDate'			=> $param['endDate'],
				'color' 			=> $param['color'],
			);

			return $this->db->insert('event', $data);
			
		}

		public function proceed_event($param){

			$data = array(
				'idEvent'			=> $param['idEvent'],
				'title'				=> $param['title'],
				'department' 		=> $param['department'],
				'cont_no'			=> $param['cont_no'],
				'startDay'			=> $param['startDay'],
				'endDay'			=> $param['endDay'],
				'color' 			=> $param['color'],
				'approved' 			=> $param['approved'],
			);
			
			$this->db->where('idEvent', $param['idEvent']);
			return $this->db->update('event', $data);
		}

		public function cancel_event($param){

			$data = array(
				'idEvent'			=> $param['idEvent'],
				'color' 			=> $param['color'],
				'canceled' 			=> $param['canceled'],
			);
			
			$this->db->where('idEvent', $param['idEvent']);
			return $this->db->update('event', $data);
		}

		public function get_event(){
			$this->db->select('idEvent id, title title, department department, cont_no cont_no, startDay start, endDay end, color color, approved approved, canceled canceled');
			$this->db->from('event');

			return $this->db->get()->result();
		}

		public function get_approved(){
			$this->db->select('COUNT(approved) as Approved');
			$this->db->from('event');
			$this->db->where('approved', "1");

			return $this->db->get()->result();
		}

		public function display_approved($param){
			$this->db->select('COUNT(approved) as Approved');
			$this->db->from('event');
			$this->db->where('startDate >=', $param['startDate']);
			$this->db->where('endDate <=', $param['endDate']);
			$this->db->where('approved', "1");

			return $this->db->get()->result();
		}

		public function get_canceled(){
			$this->db->select('COUNT(canceled) as Canceled');
			$this->db->from('event');
			$this->db->where('canceled', "1");

			return $this->db->get()->result();
		}

		public function display_canceled($param){
			$this->db->select('COUNT(canceled) as Canceled');
			$this->db->from('event');
			$this->db->where('startDate >=', $param['startDate']);
			$this->db->where('endDate <=', $param['endDate']);
			$this->db->where('canceled', "1");

			return $this->db->get()->result();
		}

		public function update_event($param){
			$data = array(
				'idEvent'			=> $param['idEvent'],
				'title'				=> $param['title'],
				'startDay'			=> $param['startDay'],
				'endDay'			=> $param['endDay'],
				'startDate'			=> $param['startDate'],
				'endDate'			=> $param['endDate'],
			);


			$this->db->where('idEvent', $param['idEvent']);
			return $this->db->update('event', $data);
		}

		public function updateModal_event($param){
			$data = array(
				'idEvent'			=> $param['idEvent'],
				'title'				=> $param['title'],
				'department' 		=> $param['department'],
				'cont_no'			=> $param['cont_no'],
				'startDay'			=> $param['startDay'],
				'endDay'			=> $param['endDay'],
				'startDate'			=> $param['startDate'],
				'endDate'			=> $param['endDate'],
			);

			$this->db->where('idEvent', $param['idEvent']);
			return $this->db->update('event', $data);
		}

		public function delete_event($id){
			$this->db->where('idEvent', $id);
			$this->db->delete('event');

			return true;
		}

		public function get_cluster(){
			$query = $this->db->select('clr.cluster_id, clr.cluster_code, clr.cluster_name, clr.type')
                          ->order_by('clr.cluster_name asc')
                          ->get();

        return $query->result();
		}

		public function can_login($emp_id, $password){
			$this->db->where('emp_id', $emp_id);
			$this->db->where('password', $password);

			$query = $this->db->get('users');

			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
	}