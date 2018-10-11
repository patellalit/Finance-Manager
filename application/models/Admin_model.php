<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
	private $table_name = 'admin_user';
    /**
     * get_users function to fetch countries list
     * 
     * @return void
     */  
 
	function insert($fieldarray=array()){
        $this->db->insert($this->table_name,$fieldarray);           
        return true;        
    }

    function update($records,$a_id){
        $this->db->where('id', $a_id);
        $this->db->update($this->table_name,$records);
        return true;       
    }

	function checklogin($email='',$password=''){
        $users   = array();
		$rs = $this->db->select('id,full_name,email,password')->where('email',$email)->where('password',$password)->get($this->table_name)->result_array();			
		if( is_array( $rs ) && count( $rs ) > 0 ){
			$i=0;
			foreach( $rs as $user ){
				$users[$i]['id'] = $user['id'];
				$users[$i]['full_name'] = $user['full_name'];
				$users[$i]['email'] = $user['email'];
				$users[$i]['password'] = $user['password'];
				$i++;
			}
		}           
        return $users;
    }
    public function get_admin_data($where)
    {
        $users   = array();
		$rs = $this->db->select('id,full_name,email,password')->where($where)->get($this->table_name)->result_array();
		if( is_array( $rs ) && count( $rs ) > 0 ){
			$i=0;
			foreach( $rs as $user ){
				$users[$i]['id'] = $user['id'];
				$users[$i]['full_name'] = $user['full_name'];
				$users[$i]['email'] = $user['email'];
				$users[$i]['password'] = $user['password'];
				$i++;
			}
		}           
        return $users;
    }   

  
}
?>