<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Drop_status extends CI_Migration {

        public function up()
        {
            $this->dbforge->drop_column('tbl_customer', 'status');
            $this->dbforge->drop_column('tbl_receipt', 'status');
            $this->dbforge->drop_column('tbl_expenses', 'status');
        }

        public function down()
        {
                $this->dbforge->drop_table('tbl_customer');
                $this->dbforge->drop_table('tbl_receipt');
                $this->dbforge->drop_table('tbl_expenses');
        }
}