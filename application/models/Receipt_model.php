<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipt_model extends CI_Model{
    private $table_name = 'tbl_receipt';
    /**
     * get_users function to fetch countries list
     * 
     * @return void
     */

    function datatable_data($where='',$generalSearch=''){
        $search_where='( receipt.id LIKE "%'.$generalSearch.'%" OR receipt.receipt_date LIKE "%'.$generalSearch.'%" OR receipt.emi LIKE "%'.$generalSearch.'%" OR receipt.interest_income LIKE "%'.$generalSearch.'%" OR customer.name LIKE "%'.$generalSearch.'%") ';
        $pagination = '';
        if($this->input->get_post("pagination")!=''){
            $pagination = $this->input->get_post("pagination");
            $cur_page = $pagination['page'];
            if(isset($pagination['perpage']))
                $limit = $pagination['perpage'];
            else
                $limit = 10;
        }
        $field='receipt.id';
        $asc='DESC';
        if($this->input->get_post("sort")!=''){
          $sort=$this->input->get_post("sort");
          $field=$sort['field'];
          $asc=$sort['sort'];
        }
        //receipt.status as status,
        $this->db->select(
        'receipt.id as id,
            receipt.customer_id as customer_id,
            receipt.receipt_date as receipt_date,
            receipt.emi as emi,
            receipt.interest_income as interest_income,
            receipt.created_at as created_at,
        receipt.updated_at as updated_at,
        customer.name as customer_name');
        $this->db->from('tbl_receipt as receipt');
        $this->db->join('tbl_customer as customer','customer.id=receipt.customer_id','Left');
        $this->db->order_by($field, $asc);
        if($generalSearch)
            $this->db->where($search_where);
        $this->db->where($where);
        if(isset($cur_page) && isset($limit) && $cur_page && $limit){
            if($cur_page=='1'){
                $start = '0';
            }else{
                $start = (($cur_page-1) * $limit);
            }
            $this->db->limit($limit, $start);
        }
        $query=$this->db->get();
        return $query->result_array();
    }

    function total_record($where='',$generalSearch=''){
        $search_where='( receipt.id LIKE "%'.$generalSearch.'%" OR receipt.receipt_date LIKE "%'.$generalSearch.'%" OR receipt.emi LIKE "%'.$generalSearch.'%" OR receipt.interest_income LIKE "%'.$generalSearch.'%" OR customer.name LIKE "%'.$generalSearch.'%") ';
        // receipt.status as status,
        $this->db->select(
        'receipt.id as id,
            receipt.customer_id as customer_id,
            receipt.receipt_date as receipt_date,
            receipt.emi as emi,
            receipt.interest_income as interest_income,
            receipt.created_at as created_at,
        receipt.updated_at as updated_at,
        customer.name as customer_name');
        $this->db->from('tbl_receipt as receipt');
        $this->db->join('tbl_customer as customer','customer.id=receipt.customer_id','Left');
        if($generalSearch)
            $this->db->where($search_where);
        $this->db->where($where);
        $query=$this->db->get();
        return $query->num_rows();
    }

    function get_customer_data($where=''){
        $this->db->select('*');
        if($where)
            $this->db->where($where);
        $query=$this->db->get('tbl_customer');
        return $query->result_array();
    } 

    function insert($records){
        $this->db->insert($this->table_name,$records); 
        $insert_id = $this->db->insert_id();          
        return $insert_id;        
    }

    function get_receipt_data($where=''){
        $this->db->select('*');
        if($where)
            $this->db->where($where);
        $query=$this->db->get($this->table_name);
        return $query->row();
    }

    function update($records,$receipt_id){
        $this->db->where('id', $receipt_id);
        $this->db->update($this->table_name,$records);
        return true;       
    } 


}

?>