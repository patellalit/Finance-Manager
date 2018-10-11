<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Expenses extends CI_Migration {

        public function up()
        {

        	$this->dbforge->add_field(array(
        	                        'id' => array(
        	                                'type' => 'INT',
        	                                'constraint' => 11,
        	                                'unsigned' => TRUE,
        	                                'auto_increment' => TRUE
        	                        ),
        	                        'title' => array(
                                            'type' => 'VARCHAR',
                                            'constraint' => '255'
                                    ),
                                    'expenses_date' => array(
                                            'type' => 'DATE',
                                            'null' => TRUE
                                    ),
                                    'description' => array(
                                            'type' => 'TEXT'
                                    ),
                                    'amount' => array(
                                            'type' => 'DECIMAL','constraint' => '10,2'
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
            $this->dbforge->create_table('tbl_expenses');   
        }

        public function down()
        {
            $this->dbforge->drop_table('tbl_expenses');
        }
}