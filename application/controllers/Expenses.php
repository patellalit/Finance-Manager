<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin_data']['adminid']) && $this->session->userdata['admin_data']['adminid']==''){
			header('location:'.base_url());
			exit;
		}
		$this->load->model('Expenses_model');
	}

	public function index(){	
		$jsfilearray = array(
			base_url().'assets/backend/js/expenses_datatable.js'
		);
		$this->viewParams['jsfilearray'] = $jsfilearray;
		$this->viewParams['page_title'] = 'Expenses list';
		$this->viewParams['content'] = 'expenses/list';
        $this->load->view('layout/2colmn-left',$this->viewParams);		
	}

	public function dataTables(){
		$generalSearch='';
		$data=$this->input->post('query');
		if(!empty($data)){
				$generalSearch=$data['generalSearch'];		
		}
		$datatable_data=$this->Expenses_model->datatable_data("delete_status!='1'",$generalSearch);
		$total_rec = $this->Expenses_model->total_record("delete_status!='1'",$generalSearch);
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
		$this->viewParams['page_title'] = 'Add Expenses';
		$jsfilearray = array(
								base_url().'assets/backend/js/jquery.validate.min.js',
								base_url().'assets/backend/js/additional-methods.js',
								base_url().'assets/backend/js/expenses.js'
	 	                       );
		$this->viewParams['jsfilearray'] = $jsfilearray;	
		$this->viewParams['content'] = 'expenses/add';
    	$this->load->view('layout/2colmn-left',$this->viewParams);
	}
	public function save(){
		if($this->input->post()){
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('expenses_date','Expenses Date','required');
			if ($this->form_validation->run() === FALSE){
				$this->viewParams['page_title'] = 'Add Expenses';
				$jsfilearray = array(
					base_url().'assets/backend/js/jquery.validate.min.js',
					base_url().'assets/backend/js/additional-methods.js',
					base_url().'assets/backend/js/expenses.js'
			   	);
				$this->viewParams['jsfilearray'] = $jsfilearray;	
				$this->viewParams['content'] = 'expenses/add';
				$this->load->view('layout/2colmn-left',$this->viewParams);
			}else{
				$expenses_date=NULL;
				if(!empty($this->input->post('expenses_date'))){
					$expenses_date = date('Y-m-d',strtotime($this->input->post('expenses_date')));
				}
				$records['title'] 					= $this->input->post('title');
				$records['description'] 			= $this->input->post('description');
				$records['amount'] 					= $this->input->post('amount');
				$records['expenses_date'] 			= $expenses_date;
				$records['created_at'] 				= date("Y-m-d H:i:s");
				$expenses_id=$this->Expenses_model->insert($records);
				if(!empty($expenses_id)){
					$this->session->set_flashdata('success', 'Expenses added successfully.');
					redirect('expenses/list', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Expenses added unsuccessfully.');
					redirect('expenses/add', 'refresh');
				}
			}
							
		}
	}
    public function edit($id=''){
		$expenses_data=$this->Expenses_model->get_expenses_data('id="'.$id.'"');
		if(empty($expenses_data)){
			show_404();
		}else{
			$this->viewParams['expenses_data'] = $expenses_data;
			$this->viewParams['page_title'] = 'Edit Expenses';
			$jsfilearray = array(
				base_url().'assets/backend/js/jquery.validate.min.js',
				base_url().'assets/backend/js/additional-methods.js',
				base_url().'assets/backend/js/expenses.js'
           	);
			$this->viewParams['jsfilearray'] = $jsfilearray;	
			$this->viewParams['content'] = 'expenses/edit';
	    	$this->load->view('layout/2colmn-left',$this->viewParams);
		}
		
	}
	public function update(){
		if($this->input->post('expenses_id')){
			$expenses_id=$this->input->post('expenses_id');
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('expenses_date','Expenses Date','required');
			if ($this->form_validation->run() === FALSE){
				$expenses_data=$this->Expenses_model->get_expenses_data('id="'.$expenses_id.'"');
				if(empty($expenses_data)){
					show_404();
				}else{
					$this->viewParams['expenses_data'] = $expenses_data;
					$this->viewParams['page_title'] = 'Edit Expenses';
					$jsfilearray = array(
						base_url().'assets/backend/js/jquery.validate.min.js',
						base_url().'assets/backend/js/additional-methods.js',
						base_url().'assets/backend/js/expenses.js'
		           	);
					$this->viewParams['jsfilearray'] = $jsfilearray;	
					$this->viewParams['content'] = 'expenses/edit';
			    	$this->load->view('layout/2colmn-left',$this->viewParams);
				}
			}else{
				$expenses_date=NULL;
				if(!empty($this->input->post('expenses_date'))){
					$expenses_date = date('Y-m-d',strtotime($this->input->post('expenses_date')));
				}
				$records['title'] 					= $this->input->post('title');
				$records['description'] 			= $this->input->post('description');
				$records['amount'] 					= $this->input->post('amount');
				$records['expenses_date'] 			= $expenses_date;
				$records['updated_at'] 				= date("Y-m-d H:i:s");
				$update=$this->Expenses_model->update($records,$expenses_id);
				if($update==true){
					$this->session->set_flashdata('success', 'Expenses Updated successfully.');
					redirect('expenses/edit/'.$expenses_id, 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Expenses Updated unsuccessfully.');
					redirect('expenses/edit/'.$expenses_id, 'refresh');
				}
			}
							
		}	
	}
	
	public function delete($id){
		$deleted_at = date("Y-m-d H:i:s");
		$delete_status = '1';
		$update=array("deleted_at"=>$deleted_at,"delete_status"=>$delete_status);
		$this->db->where("id",$id);
		$this->db->update("tbl_expenses",$update);		
		return TRUE;
	}
	
}