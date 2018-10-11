<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin_data']['adminid']) || $this->session->userdata['admin_data']['adminid']==''){
			header('location:'.base_url());
			exit;
		}
		$this->load->model('Admin_model');
	}

	public function edit(){
		$admin_id=$this->session->userdata['admin_data']['adminid'];
			$jsfilearray = array(
									base_url().'assets/backend/js/jquery.validate.min.js',
									base_url().'assets/backend/js/additional-methods.js',
									base_url().'assets/backend/js/profile.js'
		 	                       );
			$this->viewParams['jsfilearray'] = $jsfilearray;	
			$this->viewParams['admin_data'] = $this->Admin_model->get_admin_data("id= '".$admin_id."'");
			$this->viewParams['page_title'] = 'Profile Edit';
			$this->viewParams['content'] = 'profile';
    		$this->load->view('layout/2colmn-left',$this->viewParams);	
	}
	public function update(){
		if($this->input->post('admin_id')){
			$a_id=$this->session->userdata['admin_data']['adminid'];
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('full_name', 'Full Name', 'required');
			if ($this->form_validation->run() === FALSE){
				$admin_id=$this->session->userdata['admin_data']['adminid'];
					$jsfilearray = array(
											base_url().'assets/backend/js/jquery.validate.min.js',
											base_url().'assets/backend/js/additional-methods.js',
											base_url().'assets/backend/js/profile.js'
				 	                       );
					$this->viewParams['jsfilearray'] = $jsfilearray;
					$this->viewParams['admin_data'] = $this->Admin_model->get_admin_data("id= '".$admin_id."'");
					$this->viewParams['page_title'] = 'Profile Edit';
					$this->viewParams['content'] = 'profile';
					$this->load->view('layout/2colmn-left',$this->viewParams);
			}else{
				$records['full_name'] 		= $this->input->post('full_name');
				$update=$this->Admin_model->update($records,$a_id);
				if($update==true){
					$user = $this->Admin_model->get_admin_data("id= '".$a_id."'");
					if(!empty($user))
					{			
						$user_array = array(
							'adminid'=>$user[0]['id'],
							'full_name'=>$user[0]['full_name'],
							'email'=>$user[0]['email']
						);
						$this->session->set_userdata('admin_data', $user_array);
						$this->session->set_flashdata('success', 'Admin User Updated successfully.');
						redirect('profile/edit', 'refresh');
					}else{	
						$this->session->set_flashdata('error', 'Error.');
						redirect('profile/edit', 'refresh');
					}
				}else{
					$this->session->set_flashdata('error', 'Admin User Updated unsuccessfully.');
					redirect('profile/edit', 'refresh');
				}
			}					
		}	
	}

	public function password_change(){
		$admin_id=$this->session->userdata['admin_data']['adminid'];
			$jsfilearray = array(
									base_url().'assets/backend/js/jquery.validate.min.js',
									base_url().'assets/backend/js/additional-methods.js',
									base_url().'assets/backend/js/pw_change.js'
		 	                       );
			$this->viewParams['jsfilearray'] = $jsfilearray;	
			$this->viewParams['admin_data'] = $this->Admin_model->get_admin_data("id= '".$admin_id."'");
			$this->viewParams['page_title'] = 'Change Password';
			$this->viewParams['content'] 	= 'password_change';
    		$this->load->view('layout/2colmn-left',$this->viewParams);	
	}

	public function pw_update(){
		if($this->input->post('admin_id')){
			$a_id=$this->session->userdata['admin_data']['adminid'];
			$this->load->helper('form');
			$this->load->library('Form_validation');
			$this->form_validation->set_rules('new_password', 'Password', 'required');
			$this->form_validation->set_rules('r_password', 'Confirm Password', 'required|matches[new_password]');
			if ($this->form_validation->run() === FALSE){
				$admin_id=$this->session->userdata['admin_data']['adminid'];
					$jsfilearray = array(
											base_url().'assets/backend/js/jquery.validate.min.js',
											base_url().'assets/backend/js/additional-methods.js',
											base_url().'assets/backend/js/pw_change.js'
				 	                       );
					$this->viewParams['jsfilearray'] = $jsfilearray;
					$this->viewParams['admin_data'] = $this->Admin_model->get_admin_data("id= '".$admin_id."'");
					$this->viewParams['page_title'] = 'Change Password';
					$this->viewParams['content'] 	= 'password_change';
    				$this->load->view('layout/2colmn-left',$this->viewParams);
			}else{
				$records['password'] 		= md5($this->input->post('new_password'));
				$update=$this->Admin_model->update($records,$a_id);
				if($update==true){
					$this->session->set_flashdata('success', 'Admin User Updated successfully.');
					redirect('profile/password_change', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Admin User Updated unsuccessfully.');
					redirect('profile/password_change', 'refresh');
				}
			}					
		}	
	}
					
}