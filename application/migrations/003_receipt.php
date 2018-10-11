<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Receipt extends CI_Migration {

        public function up()
        {

        	$this->dbforge->add_field(array(
        	                        'id' => array(
        	                                'type' => 'INT',
        	                                'constraint' => 11,
        	                                'unsigned' => TRUE,
        	                                'auto_increment' => TRUE
        	                        ),
        	                        'customer_id' => array(
                                            'type' => 'INT',
                                            'constraint' => 11
                                    ),
                                    'receipt_date' => array(
                                            'type' => 'DATE',
                                            'null' => TRUE
                                    ),
                                    'emi' => array(
                                            'type' => 'FLOAT','constraint' => '11'
                                    ),
                                    'interest_income' => array(
                                            'type' => 'FLOAT','constraint' => '11'
                                    ),
                                    'created_at' => array(
                                            'type' => 'DATETIME'
                                    ),
                                    'updated_at' => array(
                                            'type' => 'DATETIME'
                                    ),
                                    'deleted_at' => array(
                                            'type' => 'DATETIME'
                                    )
        	                ));
        	$status_field="status int(11) NOT NULL DEFAULT '1' COMMENT '0-Deactive,1-Active'";
            $this->dbforge->add_field($status_field);
            $delete_field="delete_status int(11) NOT NULL DEFAULT '0' COMMENT '0-Not Delete,1-Delete'";
            $this->dbforge->add_field($delete_field);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_receipt'); 
            
        }

        public function down()
        {
            $this->dbforge->drop_table('tbl_receipt');
        }
}