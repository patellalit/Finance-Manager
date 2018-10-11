<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cash_model extends CI_Model{
    private $table_name = 'tbl_cash';
    /**
     * get_users function to fetch countries list
     * 
     * @return void
     */

    function datatable_data($where='',$generalSearch=''){
        $search_where='(id LIKE "%'.$generalSearch.'%" OR title LIKE "%'.$generalSearch.'%" OR cash_date LIKE "%'.$generalSearch.'%" OR description LIKE "%'.$generalSearch.'%" OR amount LIKE "%'.$generalSearch.'%")';
        $pagination = '';
        if($this->input->get_post("pagination")!=''){
            $pagination = $this->input->get_post("pagination");
            $cur_page = $pagination['page'];
            if(isset($pagination['perpage']))
                $limit = $pagination['perpage'];
            else
                $limit = 10;
        }
        $field='id';
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
        return $query->result_array();
    }

    function total_record($where='',$generalSearch=''){
        $search_where='(id LIKE "%'.$generalSearch.'%" OR title LIKE "%'.$generalSearch.'%" OR cash_date LIKE "%'.$generalSearch.'%" OR description LIKE "%'.$generalSearch.'%" OR amount LIKE "%'.$generalSearch.'%")';
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

    function get_cash_data($where=''){
        $this->db->select('*');
        if($where)
            $this->db->where($where);
        $query=$this->db->get($this->table_name);
        return $query->row();
    }

    function update($records,$expenses_id){
        $this->db->where('id', $expenses_id);
        $this->db->update($this->table_name,$records);
        return true;       
    } 


}

?>