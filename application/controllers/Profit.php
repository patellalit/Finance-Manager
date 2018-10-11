<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profit extends CI_Controller
{
    protected $viewParams;
    
    public function __construct() 
    {
        parent::__construct();
        if(!isset($this->session->userdata['admin_data']['adminid']) && $this->session->userdata['admin_data']['adminid']==''){
            header('location:'.base_url());
            exit;
        }
        $this->load->model('Profit_model');
    }
    
    public function index(){
        $this->viewParams['processing_charges']     = $this->Profit_model->total_sum_processing_charges("delete_status!='1'");
        $this->viewParams['interest_income']        = $this->Profit_model->total_sum_interest_income("delete_status!='1'");
        $this->viewParams['expenses']               = $this->Profit_model->total_sum_expenses("delete_status!='1'");
        $this->viewParams['cash']                   = $this->Profit_model->total_sum_cash_amount("delete_status!='1'");
        $this->viewParams['total_emi']              = $this->Profit_model->total_sum_total_emi("delete_status!='1'");
        $this->viewParams['total_loan_amount']      = $this->Profit_model->total_sum_total_loan_amount("delete_status!='1'");
        
        $this->viewParams['outstanding']      = $this->Profit_model->getclosingbalance();
        // var_dump($this->viewParams['total_loan_amount']); die();
        $this->viewParams['page_title']             = 'Profit';
        $this->viewParams['content']                = 'profit';
        $this->load->view('layout/2colmn-left',$this->viewParams);
    }

    public function cash_on_hand(){ 
        $jsfilearray = array(
            base_url().'assets/backend/js/profit_datatable.js'
        );
        $this->viewParams['jsfilearray'] = $jsfilearray;
        $this->viewParams['page_title'] = 'Cash On Hand';
        $this->viewParams['content'] = 'profit/profit_list';
        $this->load->view('layout/2colmn-left',$this->viewParams);     
    }

    public function dataTables($start_date,$end_date){
        $opening_balance        = $this->Profit_model->get_opening_balance($start_date);
        $profit_data            = $this->Profit_model->get_profit_data($start_date,$end_date);
        $total_rec              = $this->Profit_model->total_record($start_date,$end_date);
        $i=1; 
        foreach ($profit_data as $key => $value) {
                //Cash
                if($value['type']=='1'){
                    $opening_balance += $value['receipt'];
                //Expense
                }elseif ($value['type']=='2') {
                    $opening_balance -= $value['payment'];
                //Receipt
                }elseif ($value['type']=='3') {
                    $opening_balance += $value['receipt'];
                //Customer
                }elseif ($value['type']=='4') {
                    $opening_balance -= $value['payment'];
                //Processing charge
                }else{
                    $opening_balance += $value['receipt'];
                }
                $profit_data[$key]['closing_balance'] = number_format($opening_balance,2);
            }
        echo json_encode(["data"=>$profit_data]);
        exit();
    }
    
    public function openingBalance($start_date){
        $opening_balance     = $this->Profit_model->get_opening_balance($start_date);
        echo json_encode(['opening_balance'=>$opening_balance]);
        exit();
    }

    public function gross_income(){ 
        $jsfilearray = array(
            base_url().'assets/backend/js/gross_income_datatable.js'
        );
        $this->viewParams['jsfilearray'] = $jsfilearray;
        $this->viewParams['page_title'] = 'Gross Income';
        $this->viewParams['content'] = 'profit/gross_income_list';
        $this->load->view('layout/2colmn-left',$this->viewParams);     
    }

    public function grossincome_dataTables($start_date,$end_date){
        $opening_balance        = $this->Profit_model->get_grossincome_balance($start_date);
        $grossincome_data       = $this->Profit_model->get_grossincome_data($start_date,$end_date);
        $total_rec              = $this->Profit_model->grossincome_total_record($start_date,$end_date);
        $i=1; 
        foreach ($grossincome_data as $key => $value) {
                //Receipt Interest
                if($value['type']=='1'){
                    $opening_balance += $value['receipt'];
                //Processing charge
                }else{
                    $opening_balance += $value['receipt'];
                }
                $grossincome_data[$key]['closing_balance'] = number_format($opening_balance,2);
            }
        echo json_encode(["data"=>$grossincome_data]);
        exit();
    }
    
    public function grossincome_Balance($start_date){
        $opening_balance     = $this->Profit_model->get_grossincome_balance($start_date);
        echo json_encode(['opening_balance'=>$opening_balance]);
        exit();
    }


    
}