<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Authentication extends CI_Controller {

	protected $viewParams;
	   
   	public function __construct(){
       parent::__construct();
       $this->viewParams['page_title'] = 'Finance';
       $this->viewParams['page_description'] = 'Finance';
       $this->load->model('Admin_model');
		
   	}
	public function signup(){
		$this->load->helper('form');
		$this->load->library('Form_validation');
		if($_POST){
			$this->form_validation->set_rules('fullname', 'Fullname', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('rpassword', 'Confirm Password', 'required|matches[password]');

					if ($this->form_validation->run() === FALSE)
					{
						$errors = validation_errors();
						echo json_encode(['error'=>$errors]);
						exit();
					}else{
						$fullname = $this->input->post('fullname');
						$email = $this->input->post('email');
						$password = md5($this->input->post('password'));
						$created_date = date('Y-m-d-H-i-s');
						$records = array(
							'full_name'	=>	$fullname,
							'email'	    =>	$email,
							'password'	=>	$password,
							'created_on'	=>	$created_date,
						);		

						$this->Admin_model->insert($records);
	 					echo json_encode(array('success'=>"You have been Inserted successfully."));
					 	exit();
					}
		}else{
				echo json_encode(['error'=>'Error']);
				exit();
		}
	}
	public function login()
	{
			$this->load->helper('form');
			$this->load->library('Form_validation');
			if($this->input->post('email'))
			{
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() === FALSE)
				{
					$errors = validation_errors();
					echo json_encode(['error'=>$errors]);
					exit();
				}
				else
				{	
					$user = $this->Admin_model->checklogin($this->input->post('email'),md5($this->input->post('password')));
					//echo '<pre>'; var_dump($user); die();
					if(!empty($user))
					{			
						$user_array = array(
							'adminid'=>$user[0]['id'],
							'full_name'=>$user[0]['full_name'],
							'email'=>$user[0]['email']
						);
						$this->session->set_userdata('admin_data', $user_array);
						echo json_encode(array('success'=>"Successfully login."));
						 	exit();
					}else{	
						echo json_encode(['error'=>'Invalid username or password']);
						exit();
					}
					
				}			
			}else{
				echo json_encode(['error'=>'Please enter email and password']);
				exit();
			}
		
		
	}

	public function logout()
	{
		//var_dump('logout'); exit();
		$this->session->unset_userdata('admin_data');
		header('location:'.base_url());
	}
}
