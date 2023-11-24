<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableOrderCart extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $sql_stock1 = "ALTER TABLE `posx_cart` ADD `src_order_picture` TEXT NULL AFTER `order_customer_table_code`";
        $db->query($sql_stock1);
    }

    public function down()
    {
        //
    }
}
