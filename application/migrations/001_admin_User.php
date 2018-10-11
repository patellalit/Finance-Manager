<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Admin_User extends CI_Migration {

        public function up()
        {

        	$this->dbforge->add_field(array(
        	                        'id' => array(
        	                                'type' => 'INT',
        	                                'constraint' => 11,
        	                                'unsigned' => TRUE,
        	                                'auto_increment' => TRUE
        	                        ),
        	                        'full_name' => array(
        	                                'type' => 'VARCHAR',
        	                                'constraint' => '255'
        	                        ),
        	                        'email' => array(
        	                                'type' => 'VARCHAR',
        	                                'constraint' => '255'
        	                        ),
        	                        'password' => array(
        	                                'type' => 'VARCHAR',
        	                                'constraint' => '255'
        	                        ),
        	                        'created_on' => array(
        	                                'type' => 'DATETIME'
        	                        ),
        	                        'last_login' => array(
        	                                'type' => 'DATETIME',
                                            'null' => TRUE
        	                        )
        	                ));
        	$status_field="status int(11) NOT NULL DEFAULT '1' COMMENT '0-Deactive,1-Active'";
        	$this->dbforge->add_field($status_field);
  			$this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('admin_user');
            
        }

        public function down()
        {
                $this->dbforge->drop_table('admin_user');
        }
}