<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    protected $viewParams;
    
    public function __construct(){
        parent::__construct();
        $this->viewParams['page_title'] = 'Finance';
        $this->viewParams['page_description'] = 'Finance';
        //$this->load->model('Dashboard_model');
    }
    
    public function index(){

        if(isset($this->session->userdata['admin_data']) && $this->session->userdata['admin_data']['adminid']!=''){
            header('location:'.base_url().'dashboard');
            exit;
        }
        $this->load->view('layout/empty',$this->viewParams);
    }
    
    public function dashboard(){
        if(!isset($this->session->userdata['admin_data']['adminid']) && $this->session->userdata['admin_data']['adminid']==''){
            header('location:'.base_url());
            exit;
        }
        $this->viewParams['page_title'] = 'Dashboard';
        $this->viewParams['content']                = 'dashboard';
        $this->load->view('layout/2colmn-left',$this->viewParams);
    }

    
}