<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model{
    private $table_name = 'tbl_customer';
    /**
     * get_users function to fetch countries list
     * 
     * @return void
     */

    function datatable_data($where='',$generalSearch=''){
        $search_where='(id LIKE "%'.$generalSearch.'%" OR name LIKE "%'.$generalSearch.'%" OR mobile LIKE "%'.$generalSearch.'%" OR loan_date LIKE "%'.$generalSearch.'%" OR amount LIKE "%'.$generalSearch.'%" OR processing_charges LIKE "%'.$generalSearch.'%" OR emi_amount LIKE "%'.$generalSearch.'%" OR emi_interest LIKE "%'.$generalSearch.'%" OR total_emi LIKE "%'.$generalSearch.'%" OR emi_month LIKE "%'.$generalSearch.'%" OR closing_balance LIKE "%'.$generalSearch.'%" OR loan_closed_date LIKE "%'.$generalSearch.'%" OR emi_day LIKE "%'.$generalSearch.'%")';
        $pagination = '';
        if($this->input->get_post("pagination")!=''){
            $pagination = $this->input->get_post("pagination");
            $cur_page = $pagination['page'];
            if(isset($pagination['perpage']))
                $limit = $pagination['perpage'];
            else
                $limit = 10;
        }
        $field='loan_date';
        $asc='DESC';
        if($this->input->get_post("sort")!=''){
          $sort=$this->input->get_post("sort");
          $field=$sort['field'];
          $asc=$sort['sort'];
        }
        $this->db->select('*');
        $this->db->order_by($field, $asc);
        if($generalSearch)
            $this->db->where($search_where);
        if($where)
            $this->db->where($where);
        if(isset($cur_page) && isset($limit) && $cur_page && $limit){
            if($cur_page=='1'){
                $start = '0';
            }else{
                $start = (($cur_page-1) * $limit);
            }
            $this->db->limit($limit, $start);
        }
        $query=$this->db->get($this->table_name);
        //echo '<br/>===>'; 
        //echo $this->db->last_query(); exit();
        return $query->result_array();
    }

    function total_record($where='',$generalSearch=''){
        $search_where='(id LIKE "%'.$generalSearch.'%" OR name LIKE "%'.$generalSearch.'%" OR mobile LIKE "%'.$generalSearch.'%" OR loan_date LIKE "%'.$generalSearch.'%" OR amount LIKE "%'.$generalSearch.'%" OR processing_charges LIKE "%'.$generalSearch.'%" OR emi_amount LIKE "%'.$generalSearch.'%" OR emi_interest LIKE "%'.$generalSearch.'%" OR total_emi LIKE "%'.$generalSearch.'%" OR emi_month LIKE "%'.$generalSearch.'%" OR closing_balance LIKE "%'.$generalSearch.'%" OR loan_closed_date LIKE "%'.$generalSearch.'%" OR emi_day LIKE "%'.$generalSearch.'%")';
        $this->db->select('*');
        if($generalSearch)
            $this->db->where($search_where);
        if($where)
            $this->db->where($where);
        $query=$this->db->get($this->table_name);
        return $query->num_rows();
    }

    function insert($records){
        $this->db->insert($this->table_name,$records); 
        $insert_id = $this->db->insert_id();          
        return $insert_id;        
    }

    function get_customer_data($where=''){
        $this->db->select('*');
        if($where)
            $this->db->where($where);
        $query=$this->db->get($this->table_name);
        return $query->row();
    }

    function update($records,$customer_id){
        $this->db->where('id', $customer_id);
        $this->db->update($this->table_name,$records);
        return true;       
    }

    function outstanding_datatable_data($where='',$generalSearch='',$type){
        if($type=='1'){
            $miss_emi='(MONTH(CURRENT_DATE()) - IFNULL((SELECT MONTH(receipt.receipt_date) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0" ORDER BY receipt.receipt_date DESC limit 1),MONTH(customer.loan_date))) as miss_emi';
        }else{
            $miss_emi='(WEEK(CURRENT_DATE()) - IFNULL((SELECT WEEK(receipt.receipt_date) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0" ORDER BY receipt.receipt_date DESC limit 1),MONTH(customer.loan_date))) as miss_emi';
        }
                
        $search_where='(customer.id LIKE "%'.$generalSearch.'%" OR customer.name LIKE "%'.$generalSearch.'%" OR customer.mobile LIKE "%'.$generalSearch.'%" OR customer.loan_date LIKE "%'.$generalSearch.'%" OR customer.amount LIKE "%'.$generalSearch.'%" OR customer.total_emi LIKE "%'.$generalSearch.'%" OR customer.emi_month LIKE "%'.$generalSearch.'%" OR (customer.amount-(IFNULL((SELECT SUM(receipt.emi) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) = "'.$generalSearch.'" OR (customer.emi_month-(IFNULL((SELECT COUNT(receipt.id) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) = "'.$generalSearch.'" OR IF(customer.emi_type=1,DATE_FORMAT(customer.loan_date,"%d") = "'.$generalSearch.'",customer.emi_day LIKE "%'.$generalSearch.'%"))';
        $pagination = '';
        $type_where='customer.emi_type ="'.$type.'"';
        if($this->input->get_post("pagination")!=''){
            $pagination = $this->input->get_post("pagination");
            $cur_page = $pagination['page'];
            if(isset($pagination['perpage']))
                $limit = $pagination['perpage'];
            else
                $limit = 10;
        }
        if($type=='1'){
           $field='date';
           $asc='ASC'; 
        }else{
            $field='(CASE 
                WHEN customer.emi_day="Sunday" THEN 7
                WHEN customer.emi_day="Saturday" THEN 6
                WHEN customer.emi_day="Friday" THEN 5
                WHEN customer.emi_day="Thursday" THEN 4
                WHEN customer.emi_day="Wednesday" THEN 3
                WHEN customer.emi_day="Tuesday" THEN 2
                WHEN customer.emi_day="Monday" THEN 1
            END) ';
            $asc='DESC';
        }
        
        
        if($this->input->get_post("sort")!=''){
          $sort=$this->input->get_post("sort");
          $field=$sort['field'];
          $asc=$sort['sort'];
        }
        $this->db->select('customer.id as id,
            IF(customer.emi_type=1,DATE_FORMAT(customer.loan_date,"%d"),customer.emi_day) as date,
            customer.name as name,
            customer.mobile as mobile,
            DATE_FORMAT(customer.loan_date,"%d-%m-%Y") as loan_date,
            customer.amount as amount,
            customer.total_emi as total_emi,
            customer.emi_month as emi_month,
            (customer.amount-(IFNULL((SELECT SUM(receipt.emi) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) as closing_balance,
            (customer.emi_month-(IFNULL((SELECT COUNT(receipt.id) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) as remaining_month,'.$miss_emi);
        $this->db->from('tbl_customer as customer');
        $this->db->order_by($field, $asc);
        if($generalSearch)
            $this->db->where($search_where);
        $this->db->where($type_where);
        if($where)
            $this->db->where($where);
        if(isset($cur_page) && isset($limit) && $cur_page && $limit){
            if($cur_page=='1'){
                $start = '0';
            }else{
                $start = (($cur_page-1) * $limit);
            }
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function outstanding_total_record($where='',$generalSearch='',$type){

        if($type=='1'){
            $miss_emi='(MONTH(CURRENT_DATE()) - IFNULL((SELECT MONTH(receipt.receipt_date) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0" ORDER BY receipt.receipt_date DESC limit 1),MONTH(customer.loan_date))) as miss_emi';
        }else{
            $miss_emi='(WEEK(CURRENT_DATE()) - IFNULL((SELECT WEEK(receipt.receipt_date) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0" ORDER BY receipt.receipt_date DESC limit 1),MONTH(customer.loan_date))) as miss_emi';
        }

        $search_where='(customer.id LIKE "%'.$generalSearch.'%" OR customer.name LIKE "%'.$generalSearch.'%" OR customer.mobile LIKE "%'.$generalSearch.'%" OR customer.loan_date LIKE "%'.$generalSearch.'%" OR customer.amount LIKE "%'.$generalSearch.'%" OR customer.total_emi LIKE "%'.$generalSearch.'%" OR customer.emi_month LIKE "%'.$generalSearch.'%" OR (customer.amount-(IFNULL((SELECT SUM(receipt.emi) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) = "'.$generalSearch.'" OR (customer.emi_month-(IFNULL((SELECT COUNT(receipt.id) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) = "'.$generalSearch.'" OR IF(customer.emi_type=1,DATE_FORMAT(customer.loan_date,"%d") = "'.$generalSearch.'",customer.emi_day LIKE "%'.$generalSearch.'%"))';
        $type_where='customer.emi_type ="'.$type.'"';
        $this->db->select('customer.id as id,
            IF(customer.emi_type=1,DATE_FORMAT(customer.loan_date,"%d"),customer.emi_day) as date,
            customer.name as name,
            customer.mobile as mobile,
            DATE_FORMAT(customer.loan_date,"%d-%m-%Y") as loan_date,
            customer.amount as amount,
            customer.total_emi as total_emi,
            customer.emi_month as emi_month,
            (customer.amount-(IFNULL((SELECT SUM(receipt.emi) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) as closing_balance,
            (customer.emi_month-(IFNULL((SELECT COUNT(receipt.id) FROM tbl_receipt as receipt WHERE receipt.customer_id=customer.id AND receipt.delete_status="0"), 0))) as remaining_month,'.$miss_emi);
        $this->db->from('tbl_customer as customer');
        if($generalSearch)
            $this->db->where($search_where);
        $this->db->where($type_where);
        if($where)
            $this->db->where($where);
        $query=$this->db->get();
        return $query->num_rows();
    }

    function get_ledger_data($id){
        $sql="SELECT * FROM (SELECT `loan_date` as `date`,'1' as `type`,`amount` as `payment`,'-' as receipt FROM tbl_customer WHERE id=$id AND delete_status='0' UNION SELECT `receipt_date` as `date`,'2' as `type`,'-' as `payment`,`emi` as `receipt` FROM tbl_receipt WHERE customer_id=$id AND delete_status='0' Order By `date` ASC) AS tbl ORDER BY `tbl`.`date` ASC";
        $query = $this->db->query($sql);
        //echo $this->db->last_query(); die();
        $data = $query->result_array(); 
        return $data;       
    }

    function delete_customer_receipt($records,$customer_id){
        $this->db->where('customer_id', $customer_id);
        $this->db->update('tbl_receipt',$records);
        return true;       
    }


        

}

?>