<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profit_model extends CI_Model{
    /**
     * get_users function to fetch countries list
     * 
     * @return void
     */

    function total_sum_processing_charges($where){
        $this->db->select('sum(processing_charges) as processing_charges');
        $this->db->from('tbl_customer');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->row()->processing_charges;
    }
    function total_sum_interest_income($where){
        $this->db->select('sum(interest_income) as interest_income');
        $this->db->from('tbl_receipt');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->row()->interest_income;
    }
    function total_sum_expenses($where){
        $this->db->select('sum(amount) as expenses');
        $this->db->from('tbl_expenses');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->row()->expenses;
    }
    function total_sum_cash_amount($where){
        $this->db->select('sum(amount) as cash');
        $this->db->from('tbl_cash');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->row()->cash;
    }
    function total_sum_total_emi($where){
        $this->db->select('(SUM(emi) + SUM(interest_income)) as total_emi');
        $this->db->from('tbl_receipt');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->row()->total_emi;
    }
    function total_sum_total_loan_amount($where){
        $this->db->select('sum(amount) as total_loan_amount');
        $this->db->from('tbl_customer');
        $this->db->where($where);
        $query=$this->db->get();
        return $query->row()->total_loan_amount;
    }

    function get_opening_balance($start_date){
        $sql="SELECT ( 
            (
                (SELECT IFNULL(sum(amount),0) FROM tbl_cash WHERE cash_date<'$start_date' AND delete_status!='1')+
                (SELECT IFNULL((sum(emi) + sum(interest_income)),0) as total_emi FROM tbl_receipt WHERE receipt_date<'$start_date' AND delete_status!='1')+
                (SELECT IFNULL(sum(processing_charges),0) FROM tbl_customer WHERE loan_date<'$start_date' AND delete_status!='1')
            )-
            (
                (SELECT IFNULL(sum(amount),0) FROM tbl_expenses WHERE expenses_date<'$start_date' AND delete_status!='1')+
                (SELECT IFNULL(sum(amount),0) FROM tbl_customer WHERE loan_date<'$start_date' AND delete_status!='1')
            ) 
        ) AS opening_balance";
        $query = $this->db->query($sql);
        return $query->row()->opening_balance;       
    }
    function get_profit_data($start_date,$end_date){
        $sql="
                SELECT `cash_date` as `date`,'1' as `type`,'-' as `payment`,`amount` as receipt FROM tbl_cash WHERE delete_status='0' AND (`cash_date` BETWEEN '$start_date' AND '$end_date') UNION ALL 
                SELECT `expenses_date` as `date`,'2' as `type`,`amount` as `payment`,'-' as receipt FROM tbl_expenses WHERE delete_status='0' AND (`expenses_date` BETWEEN '$start_date' AND '$end_date') UNION ALL 
                SELECT `receipt_date` as `date`,'3' as `type`,'-' as `payment`,(emi+interest_income) as receipt FROM tbl_receipt WHERE delete_status='0' AND (`receipt_date` BETWEEN '$start_date' AND '$end_date')  UNION ALL 
                SELECT `loan_date` as `date`,'4' as `type`,`amount` as `payment`,'-' as receipt FROM tbl_customer WHERE delete_status='0' AND (`loan_date` BETWEEN '$start_date' AND '$end_date') UNION ALL 
                SELECT `loan_date` as `date`,'5' as `type`,'-' as `payment`,`processing_charges` as receipt FROM tbl_customer WHERE delete_status='0' AND (`loan_date` BETWEEN '$start_date' AND '$end_date')
        ORDER BY `date` ASC";
        $query = $this->db->query($sql);
        // echo $this->db->last_query(); die();
        $data = $query->result_array(); 
        return $data;       
    }

    function total_record($start_date,$end_date){
        $sql="
                SELECT `cash_date` as `date`,'1' as `type`,'-' as `payment`,`amount` as receipt FROM tbl_cash WHERE delete_status='0' AND (`cash_date` BETWEEN '$start_date' AND '$end_date') UNION ALL 
                SELECT `expenses_date` as `date`,'2' as `type`,`amount` as `payment`,'-' as receipt FROM tbl_expenses WHERE delete_status='0' AND (`expenses_date` BETWEEN '$start_date' AND '$end_date') UNION ALL 
                SELECT `receipt_date` as `date`,'3' as `type`,'-' as `payment`,(emi+interest_income) as receipt FROM tbl_receipt WHERE delete_status='0' AND (`receipt_date` BETWEEN '$start_date' AND '$end_date')  UNION ALL 
                SELECT `loan_date` as `date`,'4' as `type`,`amount` as `payment`,'-' as receipt FROM tbl_customer WHERE delete_status='0' AND (`loan_date` BETWEEN '$start_date' AND '$end_date') UNION ALL 
                SELECT `loan_date` as `date`,'5' as `type`,'-' as `payment`,`processing_charges` as receipt FROM tbl_customer WHERE delete_status='0' AND (`loan_date` BETWEEN '$start_date' AND '$end_date')
        ORDER BY `date` ASC";
        $query = $this->db->query($sql);
        $data = $query->num_rows(); 
        return $data;       
    }

    function get_grossincome_balance($start_date){
        $sql="SELECT ( 
            (
                
                (SELECT IFNULL((sum(interest_income)),0) as total_emi FROM tbl_receipt WHERE receipt_date<'$start_date' AND delete_status!='1')+
                (SELECT IFNULL(sum(processing_charges),0) FROM tbl_customer WHERE loan_date<'$start_date' AND delete_status!='1')
            )
        ) AS opening_balance";
        $query = $this->db->query($sql);
        return $query->row()->opening_balance;       
    }

    function get_grossincome_data($start_date,$end_date){
        $sql="SELECT * FROM ( SELECT `receipt_date` as `date`,'1' as `type`,'-' as `payment`,`interest_income` as receipt FROM tbl_receipt WHERE delete_status='0' AND (`receipt_date` BETWEEN '$start_date' AND '$end_date') UNION ALL SELECT `loan_date` as `date`,'2' as `type`,'-' as `payment`,`processing_charges` as receipt FROM tbl_customer WHERE delete_status='0' AND (`loan_date` BETWEEN '$start_date' AND '$end_date') ) AS tbl ORDER BY `tbl`.`date` ASC";
        $query = $this->db->query($sql);
        //echo $this->db->last_query(); die();
        $data = $query->result_array(); 
        return $data;       
    }

    function grossincome_total_record($start_date,$end_date){
        $sql="SELECT * FROM ( SELECT `receipt_date` as `date`,'1' as `type`,'-' as `payment`,`interest_income` as receipt FROM tbl_receipt WHERE delete_status='0' AND (`receipt_date` BETWEEN '$start_date' AND '$end_date') UNION ALL SELECT `loan_date` as `date`,'2' as `type`,'-' as `payment`,`processing_charges` as receipt FROM tbl_customer WHERE delete_status='0' AND (`loan_date` BETWEEN '$start_date' AND '$end_date') ) AS tbl ORDER BY `tbl`.`date` ASC";
        $query = $this->db->query($sql);
        $data = $query->num_rows(); 
        return $data;       
    }
    
    function getclosingbalance(){
        
        $sql = "SELECT SUM(customer.amount-(IFNULL((SELECT SUM(receipt.emi) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status='0'), 0))) as closing_balance FROM tbl_customer as customer WHERE customer.delete_status='0'";
        $query = $this->db->query($sql);
        $data = $query->result_array(); 
        $data = $data[0]['closing_balance'];
        return $data;       
    }

}

?>