<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin_data']['adminid']) && $this->session->userdata['admin_data']['adminid']==''){
			header('location:'.base_url());
			exit;
		}
		$this->load->model('Cash_model');
	}

	public function index(){	
		$jsfilearray = array(
			base_url().'assets/backend/js/cash_datatable.js'
		);
		$this->viewParams['jsfilearray'] = $jsfilearray;
		$this->viewParams['page_title'] = 'Cash list';
		$this->viewParams['content'] = 'cash/list';
        $this->load->view('layout/2colmn-left',$this->viewParams);		
	}

	public function dataTables(){
		$generalSearch='';
		$data=$this->input->post('query');
		if(!empty($data)){
				$generalSearch=$data['generalSearch'];		
		}
		$datatable_data=$this->Cash_model->datatable_data("delete_status!='1'",$generalSearch);
		$total_rec = $this->Cash_model->total_record("delete_status!='1'",$generalSearch);
	    $pagination = $cur_page = $limit = '';
	    $limit = 1;
	    if($this->input->get_post("pagination")!=''){
			$pagination = $this->input->get_post("pagination");
			$cur_page = $pagination['page'];
				if(isset($pagination['perpage']))
			 		$limit = $pagination['perpage'];
				else
					$limit = 10;
	    }
		echo json_encode([
				"data"=>$datatable_data,
				"meta"=>['page'=>$cur_page,'pages'=>ceil($total_rec/$limit),'perpage'=>$limit,'total'=>$total_rec]
			]);
		exit();
	}

    public function add(){
		$this->viewParams['page_title'] = 'Add Cash';
		$jsfilearray = array(
								base_url().'assets/backend/js/jquery.validate.min.js',
								base_url().'assets/backend/js/additional-methods.js',
								base_url().'assets/backend/js/cash.js'
	 	                       );
		$this->viewParams['jsfilearray'] = $jsfilearray;	
		$this->viewParams['content'] = 'cash/add';
    	$this->load->view('layout/2colmn-left',$this->viewParams);
	}
	public function save(){
		if($this->input->post()){
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->viewParams['page_title'] = 'Add Cash';
				$jsfilearray = array(
					base_url().'assets/backend/js/jquery.validate.min.js',
					base_url().'assets/backend/js/additional-methods.js',
					base_url().'assets/backend/js/cash.js'
			   	);
				$this->viewParams['jsfilearray'] = $jsfilearray;	
				$this->viewParams['content'] = 'cash/add';
				$this->load->view('layout/2colmn-left',$this->viewParams);
			}else{
				$cash_date=NULL;
				if(!empty($this->input->post('cash_date'))){
					$cash_date = date('Y-m-d',strtotime($this->input->post('cash_date')));
				}
				$records['title'] 					= $this->input->post('title');
				$records['description'] 			= $this->input->post('description');
				$records['amount'] 					= $this->input->post('amount');
				$records['cash_date'] 				= $cash_date;
				$records['created_at'] 				= date("Y-m-d H:i:s");
				$cash_id=$this->Cash_model->insert($records);
				if(!empty($cash_id)){
					$this->session->set_flashdata('success', 'Cash added successfully.');
					redirect('cash/list', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Cash added unsuccessfully.');
					redirect('cash/add', 'refresh');
				}
			}
							
		}
	}
    public function edit($id=''){
		$cash_data=$this->Cash_model->get_cash_data('id="'.$id.'"');
		if(empty($cash_data)){
			show_404();
		}else{
			$this->viewParams['cash_data'] = $cash_data;
			$this->viewParams['page_title'] = 'Edit Cash';
			$jsfilearray = array(
				base_url().'assets/backend/js/jquery.validate.min.js',
				base_url().'assets/backend/js/additional-methods.js',
				base_url().'assets/backend/js/cash.js'
           	);
			$this->viewParams['jsfilearray'] = $jsfilearray;	
			$this->viewParams['content'] = 'cash/edit';
	    	$this->load->view('layout/2colmn-left',$this->viewParams);
		}
		
	}
	public function update(){
		if($this->input->post('cash_id')){
			$cash_id=$this->input->post('cash_id');
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			if ($this->form_validation->run() === FALSE){
				$cash_data=$this->Cash_model->get_cash_data('id="'.$cash_id.'"');
				if(empty($cash_data)){
					show_404();
				}else{
					$this->viewParams['cash_data'] = $cash_data;
					$this->viewParams['page_title'] = 'Edit Cash';
					$jsfilearray = array(
						base_url().'assets/backend/js/jquery.validate.min.js',
						base_url().'assets/backend/js/additional-methods.js',
						base_url().'assets/backend/js/cash.js'
		           	);
					$this->viewParams['jsfilearray'] = $jsfilearray;	
					$this->viewParams['content'] = 'cash/edit';
			    	$this->load->view('layout/2colmn-left',$this->viewParams);
				}
			}else{
				$cash_date=NULL;
				if(!empty($this->input->post('cash_date'))){
					$cash_date = date('Y-m-d',strtotime($this->input->post('cash_date')));
				}
				$records['title'] 					= $this->input->post('title');
				$records['description'] 			= $this->input->post('description');
				$records['amount'] 					= $this->input->post('amount');
				$records['cash_date'] 				= $cash_date;
				$records['updated_at'] 				= date("Y-m-d H:i:s");
				$update=$this->Cash_model->update($records,$cash_id);
				if($update==true){
					$this->session->set_flashdata('success', 'Cash Updated successfully.');
					redirect('cash/edit/'.$cash_id, 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Cash Updated unsuccessfully.');
					redirect('cash/edit/'.$cash_id, 'refresh');
				}
			}
							
		}	
	}
	
	public function delete($id){
		$deleted_at = date("Y-m-d H:i:s");
		$delete_status = '1';
		$update=array("deleted_at"=>$deleted_at,"delete_status"=>$delete_status);
		$this->db->where("id",$id);
		$this->db->update("tbl_cash",$update);		
		return TRUE;
	}	
}