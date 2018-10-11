<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin_data']['adminid']) && $this->session->userdata['admin_data']['adminid']==''){
			header('location:'.base_url());
			exit;
		}
		$this->load->model('Receipt_model');
	}

	public function index(){	
		$jsfilearray = array(
			base_url().'assets/backend/js/receipt_datatable.js'
		);
		$this->viewParams['jsfilearray'] = $jsfilearray;
		$this->viewParams['page_title'] = 'Receipt list';
		$this->viewParams['content'] = 'receipt/list';
        $this->load->view('layout/2colmn-left',$this->viewParams);		
	}

	public function dataTables(){
		$generalSearch='';
		$data=$this->input->post('query');
		if(!empty($data)){
				$generalSearch=$data['generalSearch'];		
		}
		$datatable_data=$this->Receipt_model->datatable_data("receipt.delete_status!='1'",$generalSearch);
		$total_rec = $this->Receipt_model->total_record("receipt.delete_status!='1'",$generalSearch);
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
		$this->viewParams['customer_data'] = $this->Receipt_model->get_customer_data("delete_status!='1'");
		$this->viewParams['page_title'] = 'Add Receipt';
		$jsfilearray = array(
								base_url().'assets/backend/js/jquery.validate.min.js',
								base_url().'assets/backend/js/additional-methods.js',
								base_url().'assets/backend/js/receipt.js'
	 	                       );
		$this->viewParams['jsfilearray'] = $jsfilearray;	
		$this->viewParams['content'] = 'receipt/add';
    	$this->load->view('layout/2colmn-left',$this->viewParams);
	}
	public function save(){
		if($this->input->post()){
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('customer_id', 'Customer Name', 'required');
			$this->form_validation->set_rules('receipt_date', 'Receipt Date', 'required');
			$this->form_validation->set_rules('emi', 'Emi', 'required');
			$this->form_validation->set_rules('interest_income', 'Interest Income', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->viewParams['customer_data'] = $this->Receipt_model->get_customer_data("delete_status!='1'");
				$this->viewParams['page_title'] = 'Add Receipt';
				$jsfilearray = array(
										base_url().'assets/backend/js/jquery.validate.min.js',
										base_url().'assets/backend/js/additional-methods.js',
										base_url().'assets/backend/js/receipt.js'
			 	                       );
				$this->viewParams['jsfilearray'] = $jsfilearray;	
				$this->viewParams['content'] = 'receipt/add';
		    	$this->load->view('layout/2colmn-left',$this->viewParams);
			}else{
				$receipt_date=NULL;
				if(!empty($this->input->post('receipt_date'))){
					$receipt_date = date('Y-m-d',strtotime($this->input->post('receipt_date')));
				}
				if($this->input->post('load_closed')=='yes'){
					$update=array("closing_balance"=>0,"loan_closed_date"=>$receipt_date,"loan_closed"=>1);
					$this->db->where("id",$this->input->post('customer_id'));
					$this->db->update("tbl_customer",$update);
					$records['load_closed_status'] 		= 1;
				}
				$records['customer_id'] 		= $this->input->post('customer_id');
				$records['receipt_date'] 		= $receipt_date;
				$records['emi'] 				= $this->input->post('emi');
				$records['interest_income'] 	= $this->input->post('interest_income');
				$records['created_at'] 			= date("Y-m-d H:i:s");
				$receipt_id=$this->Receipt_model->insert($records);
				if(!empty($receipt_id)){
					$this->session->set_flashdata('success', 'Receipt added successfully.');
					redirect('receipt/list', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Receipt added unsuccessfully.');
					redirect('receipt/add', 'refresh');
				}
			}				
		}
	}

    public function edit($id=''){
		$this->viewParams['customer_data'] = $this->Receipt_model->get_customer_data("delete_status!='1'");
		$receipt_data=$this->Receipt_model->get_receipt_data('id="'.$id.'"');
		if(empty($receipt_data)){
			show_404();
		}else{
			$this->viewParams['receipt_data'] 	= $receipt_data;
			$this->viewParams['page_title'] 	= 'Edit Receipt';
			$jsfilearray = array(
				base_url().'assets/backend/js/jquery.validate.min.js',
				base_url().'assets/backend/js/additional-methods.js',
				base_url().'assets/backend/js/receipt.js'
           	);
			$this->viewParams['jsfilearray'] = $jsfilearray;		
			$this->viewParams['content'] = 'receipt/edit';
	    	$this->load->view('layout/2colmn-left',$this->viewParams);
		}
		
	}

	public function update(){
		if($this->input->post('receipt_id')){
			$receipt_id=$this->input->post('receipt_id');
			$receipt_data=$this->Receipt_model->get_receipt_data('id="'.$receipt_id.'"');
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('customer_id', 'Customer Name', 'required');
			$this->form_validation->set_rules('date_receipt', 'Receipt Date', 'required');
			$this->form_validation->set_rules('emi', 'Emi', 'required');
			$this->form_validation->set_rules('interest_income', 'Interest Income', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->viewParams['customer_data'] = $this->Receipt_model->get_customer_data("delete_status!='1'");
				$receipt_data=$this->Receipt_model->get_receipt_data('id="'.$receipt_id.'"');
				if(empty($receipt_data)){
					show_404();
				}else{
					$this->viewParams['receipt_data'] 	= $receipt_data;
					$this->viewParams['page_title'] 	= 'Edit Receipt';
					$jsfilearray = array(
						base_url().'assets/backend/js/jquery.validate.min.js',
						base_url().'assets/backend/js/additional-methods.js',
						base_url().'assets/backend/js/receipt.js'
					);
					$this->viewParams['jsfilearray'] = $jsfilearray;		
					$this->viewParams['content'] = 'receipt/edit';
					$this->load->view('layout/2colmn-left',$this->viewParams);
				}
			}else{
				$receipt_date=NULL;
				if(!empty($this->input->post('date_receipt'))){
					$receipt_date = date('Y-m-d',strtotime($this->input->post('date_receipt')));
				}
				if($this->input->post('load_closed')=='yes'){
					$update=array("closing_balance"=>0,"loan_closed_date"=>$receipt_date,"loan_closed"=>1);
					$this->db->where("id",$this->input->post('customer_id'));
					$this->db->update("tbl_customer",$update);
					$records['load_closed_status'] 		= 1;
				}else{
					$update=array("closing_balance"=>0,"loan_closed_date"=>NULL,"loan_closed"=>0);
					$this->db->where("id",$this->input->post('customer_id'));
					$this->db->update("tbl_customer",$update);
					$records['load_closed_status'] 		= 0;
				}
				$records['customer_id'] 		= $this->input->post('customer_id');
				$records['receipt_date'] 		= $receipt_date;
				$records['emi'] 				= $this->input->post('emi');
				$records['interest_income'] 	= $this->input->post('interest_income');
				$records['updated_at'] 		= date("Y-m-d H:i:s");
				$update=$this->Receipt_model->update($records,$receipt_id);
				if($update==true){
					$this->session->set_flashdata('success', 'Receipt Updated successfully.');
					redirect('receipt/edit/'.$receipt_id, 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Receipt Updated unsuccessfully.');
					redirect('receipt/edit/'.$receipt_id, 'refresh');
				}
			}
							
		}	
	}
	
	public function delete($id){
		$deleted_at = date("Y-m-d H:i:s");
		$delete_status = '1';
		$update=array("deleted_at"=>$deleted_at,"delete_status"=>$delete_status);
		$this->db->where("id",$id);
		$this->db->update("tbl_receipt",$update);		
		return TRUE;
	}
	
	public function fetchCustomer($customer_id){
	    $cdata = array('emi_amount' => 0,'emi_interest' => 0 );
	    if((int) $customer_id > 0){
    	    $customer_data = $this->Receipt_model->get_customer_data("delete_status!='1' AND id={$customer_id}");
    	    if($customer_data && count($customer_data) > 0){
        	    $cdata = array('emi_amount' => $customer_data[0]['emi_amount'],'emi_interest' =>$customer_data[0]['emi_interest'] );
        	    
        	    echo json_encode($cdata);
        		exit();
    	    }
	    }
	    
	    echo json_encode($cdata);
		exit();
	}
	
}