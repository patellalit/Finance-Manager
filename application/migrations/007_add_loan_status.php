<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_loan_status extends CI_Migration {

        public function up()
        {	
                $fields = array('load_closed_status' => array('type' => 'INT','constraint' => '11' ,'COMMENT'=>'0-Open , 1-Closed','default'=>0));
                $this->dbforge->add_column('tbl_receipt', $fields);		             
        }

        public function down()
        {
                $this->dbforge->drop_column('tbl_receipt', 'load_closed_status');
        }
}
