<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Emi_type extends CI_Migration {

        public function up(){
            $fields = array('emi_type' => array('type' => 'INT','constraint' => 11, 'COMMENT'=>'1- Monthly , 2-Weekly',
                                                 'default'=>1),
                            'emi_day' => array('type' => 'VARCHAR', 'constraint' => '50')
            );
            $this->dbforge->add_column('tbl_customer', $fields);   	  
        }

        public function down()
        {
            $this->dbforge->drop_column('tbl_customer', 'emi_type');
            $this->dbforge->drop_column('tbl_customer', 'emi_day');
        }
}