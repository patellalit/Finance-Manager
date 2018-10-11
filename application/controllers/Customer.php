<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin_data']['adminid']) && $this->session->userdata['admin_data']['adminid']==''){
			header('location:'.base_url());
			exit;
		}
		$this->load->model('Customer_model');
	}

	public function index(){	
		$jsfilearray = array(
			base_url().'assets/backend/js/customer_datatable.js'
		);
		$this->viewParams['jsfilearray'] = $jsfilearray;
		$this->viewParams['page_title'] = 'Customer list';
		$this->viewParams['content'] = 'customer/list';
        $this->load->view('layout/2colmn-left',$this->viewParams);		
	}

	public function dataTables(){
		$generalSearch='';
		$data=$this->input->post('query');
		if(!empty($data)){
				$generalSearch=$data['generalSearch'];		
		}
		$datatable_data=$this->Customer_model->datatable_data("delete_status!='1'",$generalSearch);
		$total_rec = $this->Customer_model->total_record("delete_status!='1'",$generalSearch);
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
		$this->viewParams['page_title'] = 'Add Customer';
		$jsfilearray = array(
								base_url().'assets/backend/js/jquery.validate.min.js',
								base_url().'assets/backend/js/additional-methods.js',
								base_url().'assets/backend/js/customer.js',
								base_url().'assets/backend/js/bootstrap_tags.js'
	 	                       );
		$this->viewParams['jsfilearray'] = $jsfilearray;	
		$this->viewParams['content'] = 'customer/add';
    	$this->load->view('layout/2colmn-left',$this->viewParams);
	}
	public function save(){
		if($this->input->post()){
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
			$this->form_validation->set_rules('mobile','Mobile No.','required');
			$this->form_validation->set_rules('emi_type','Emi Type','required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('processing_charges', 'Processing Charges', 'required');
			$this->form_validation->set_rules('emi_amount', 'Emi Amount', 'required');
			$this->form_validation->set_rules('emi_interest', 'Emi Interest', 'required');
			$this->form_validation->set_rules('loan_date', 'Load Date', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->viewParams['page_title'] = 'Add Customer';
				$jsfilearray = array(
					base_url().'assets/backend/js/jquery.validate.min.js',
					base_url().'assets/backend/js/additional-methods.js',
					base_url().'assets/backend/js/customer.js',
					base_url().'assets/backend/js/bootstrap_tags.js'
				       );
				$this->viewParams['jsfilearray'] = $jsfilearray;	
				$this->viewParams['content'] = 'customer/add';
				$this->load->view('layout/2colmn-left',$this->viewParams);
			}else{
				$loan_date='';
				if(!empty($this->input->post('loan_date'))){
					$loan_date = date('Y-m-d',strtotime($this->input->post('loan_date')));
				}
				$loan_closed_date=NULL;
				if(!empty($this->input->post('loan_closed_date'))){
					$loan_closed_date = date('Y-m-d',strtotime($this->input->post('loan_closed_date')));
				}
				$emi_day=NULL;
				if(!empty($this->input->post('emi_day'))){
					$emi_day = $this->input->post('emi_day');
				}
				$records['name'] 					= $this->input->post('customer_name');
				$records['mobile'] 					= $this->input->post('mobile');
				$records['emi_type'] 				= $this->input->post('emi_type');
				$records['emi_day'] 				= $emi_day;
				$records['loan_date'] 				= $loan_date;
				$records['amount'] 					= $this->input->post('amount');
				$records['processing_charges'] 		= $this->input->post('processing_charges');
				$records['emi_amount'] 				= $this->input->post('emi_amount');
				$records['emi_interest'] 			= $this->input->post('emi_interest');
				$records['total_emi'] 				= $this->input->post('total_emi');
				$records['emi_month'] 				= $this->input->post('emi_month');
				$records['closing_balance'] 		= $this->input->post('closing_balance');
				$records['loan_closed_date'] 		= $loan_closed_date;
				$records['loan_closed'] 			= $this->input->post('loan_closed');
				$records['created_at'] 				= date("Y-m-d H:i:s");
				$customer_id=$this->Customer_model->insert($records);
				if(!empty($customer_id)){
					$this->session->set_flashdata('success', 'Customer added successfully.');
					redirect('customer/list', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Customer added unsuccessfully.');
					redirect('customer/add', 'refresh');
				}
			}
							
		}
	}
    public function edit($id=''){
		$customer_data=$this->Customer_model->get_customer_data('id="'.$id.'"');
		if(empty($customer_data)){
			show_404();
		}else{
			//echo '<pre>'; var_dump($customer_data); die();
			$this->viewParams['customer_data'] = $customer_data;
			$this->viewParams['page_title'] = 'Edit Customer';
			$jsfilearray = array(
				base_url().'assets/backend/js/jquery.validate.min.js',
				base_url().'assets/backend/js/additional-methods.js',
				base_url().'assets/backend/js/customer.js',
				base_url().'assets/backend/js/bootstrap_tags.js'
			       );
			$this->viewParams['jsfilearray'] = $jsfilearray;	
			$this->viewParams['content'] = 'customer/edit';
	    	$this->load->view('layout/2colmn-left',$this->viewParams);
		}
		
	}
	public function update(){
		if($this->input->post('customer_id')){
			$customer_id=$this->input->post('customer_id');
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
			$this->form_validation->set_rules('mobile','Mobile no.','required');
			$this->form_validation->set_rules('emi_type','Emi Type','required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('processing_charges', 'Processing Charges', 'required');
			$this->form_validation->set_rules('emi_amount', 'Emi Amount', 'required');
			$this->form_validation->set_rules('emi_interest', 'Emi Interest', 'required');
			$this->form_validation->set_rules('date_loan', 'Load Date', 'required');
			if ($this->form_validation->run() === FALSE){
				$customer_data=$this->Customer_model->get_customer_data('id="'.$customer_id.'"');
				if(empty($customer_data)){
					show_404();
				}else{
					$this->viewParams['customer_data'] = $customer_data;
					$this->viewParams['page_title'] = 'Edit Customer';
					$jsfilearray = array(
						base_url().'assets/backend/js/jquery.validate.min.js',
						base_url().'assets/backend/js/additional-methods.js',
						base_url().'assets/backend/js/customer.js',
						base_url().'assets/backend/js/bootstrap_tags.js'
				   	);
					$this->viewParams['jsfilearray'] = $jsfilearray;	
					$this->viewParams['content'] = 'customer/edit';
					$this->load->view('layout/2colmn-left',$this->viewParams);
				}
			}else{
				$loan_date='';
				if(!empty($this->input->post('date_loan'))){
					$loan_date = date('Y-m-d',strtotime($this->input->post('date_loan')));
				}
				$loan_closed_date=NULL;
				if(!empty($this->input->post('loan_closed_date'))){
					$loan_closed_date = date('Y-m-d',strtotime($this->input->post('loan_closed_date')));
				}
				if($this->input->post('emi_type')==1){
					$emi_day=NULL;
				}else{
					$emi_day=NULL;
					if(!empty($this->input->post('emi_day'))){
						$emi_day = $this->input->post('emi_day');
					}
				}
				
				$records['name'] 					= $this->input->post('customer_name');
				$records['mobile'] 					= $this->input->post('mobile');
				$records['emi_type'] 				= $this->input->post('emi_type');
				$records['emi_day'] 				= $emi_day;
				$records['loan_date'] 				= $loan_date;
				$records['amount'] 					= $this->input->post('amount');
				$records['processing_charges'] 		= $this->input->post('processing_charges');
				$records['emi_amount'] 				= $this->input->post('emi_amount');
				$records['emi_interest'] 			= $this->input->post('emi_interest');
				$records['total_emi'] 				= $this->input->post('total_emi');
				$records['emi_month'] 				= $this->input->post('emi_month');
				$records['closing_balance'] 		= $this->input->post('closing_balance');
				$records['loan_closed_date'] 		= $loan_closed_date;
				$records['loan_closed'] 			= $this->input->post('loan_closed');
				$records['updated_at'] 				= date("Y-m-d H:i:s");
				$update=$this->Customer_model->update($records,$customer_id);
				if($update==true){
					$this->session->set_flashdata('success', 'Customer Updated successfully.');
					redirect('customer/edit/'.$customer_id, 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Customer Updated unsuccessfully.');
					redirect('customer/edit/'.$customer_id, 'refresh');
				}
			}
							
		}	
	}
	public function delete($id){
		$deleted_at = date("Y-m-d H:i:s");
		$delete_status = '1';
		$update=array("deleted_at"=>$deleted_at,"delete_status"=>$delete_status);
		$this->db->where("id",$id);
		$this->db->update("tbl_customer",$update);
		$this->Customer_model->delete_customer_receipt($update,$id);	
		return TRUE;
	}

	public function outstanding_list(){	
		$jsfilearray = array(
			base_url().'assets/backend/js/outstanding_datatable.js'
		);
		$this->viewParams['jsfilearray'] = $jsfilearray;
		$this->viewParams['page_title'] = 'Outstanding list';
		$this->viewParams['content'] = 'customer/outstanding_list';
        $this->load->view('layout/2colmn-left',$this->viewParams);	
		
	}
	
	public function outstanding_dataTables($type){
	    $generalSearch='';
	    $data=$this->input->post('query');
	    if(!empty($data)){
	            $generalSearch=$data['generalSearch'];      
	    }
	    $datatable_data=$this->Customer_model->outstanding_datatable_data("customer.delete_status!='1' AND customer.loan_closed!='1'",$generalSearch,$type);
	    $total_rec = $this->Customer_model->outstanding_total_record("customer.delete_status!='1' AND customer.loan_closed!='1'",$generalSearch,$type);
	    $pagination = $cur_page = $limit = '';
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

	public function ledger($id=''){
		$customer_data=$this->Customer_model->get_customer_data('id="'.$id.'" AND delete_status!="1"');
		if(empty($customer_data)){
			show_404();
		}else{
			$this->viewParams['ledger_data'] 	= $this->Customer_model->get_ledger_data($id);
			$this->viewParams['customer_name'] 	= $customer_data->name;
			$this->viewParams['mobile_no'] 		= $customer_data->mobile;
			$this->viewParams['page_title'] 	= 'Customer ledger';
			$this->viewParams['content'] 		= 'customer/ledger';
	        $this->load->view('layout/2colmn-left',$this->viewParams);	
		}
	}
	
}