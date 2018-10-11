<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Customer extends CI_Migration {

        public function up()
        {

        	$this->dbforge->add_field(array(
        	                        'id' => array(
        	                                'type' => 'INT',
        	                                'constraint' => 11,
        	                                'unsigned' => TRUE,
        	                                'auto_increment' => TRUE
        	                        ),
        	                        'name' => array(
        	                                'type' => 'VARCHAR',
        	                                'constraint' => '255'
        	                        ),
                                    'mobile' => array(
                                            'type' => 'VARCHAR',
                                            'constraint' => '255'
                                    ),
                                    'loan_date' => array(
                                            'type' => 'DATE'
                                    ),
                                    'amount' => array(
                                            'type' => 'DECIMAL','constraint' => '10,2'
                                    ),
                                    'processing_charges' => array(
                                            'type' => 'FLOAT','constraint' => '11'
                                    ),
                                    'emi_amount' => array(
                                            'type' => 'FLOAT','constraint' => '11'
                                    ),
                                    'emi_interest' => array(
                                            'type' => 'FLOAT','constraint' => '11'
                                    ),
                                    'total_emi' => array(
                                            'type' => 'FLOAT','constraint' => '11'
                                    ),
                                    'emi_month' => array(
                                            'type' => 'INT',
                                            'constraint' => 11
                                    ),
                                    'closing_balance' => array(
                                            'type' => 'FLOAT','constraint' => '11'
                                    ),
                                    'loan_closed_date' => array(
                                            'type' => 'DATE',
                                            'null' => TRUE
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
            $loan_closed_field="loan_closed int(11) NOT NULL DEFAULT '0' COMMENT '0-open,1-closed'";
            $this->dbforge->add_field($loan_closed_field);
        	$status_field="status int(11) NOT NULL DEFAULT '1' COMMENT '0-Deactive,1-Active'";
            $this->dbforge->add_field($status_field);
            $delete_field="delete_status int(11) NOT NULL DEFAULT '0' COMMENT '0-Not Delete,1-Delete'";
            $this->dbforge->add_field($delete_field);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_customer'); 
            
        }

        public function down()
        {
            $this->dbforge->drop_table('tbl_customer');
        }
}