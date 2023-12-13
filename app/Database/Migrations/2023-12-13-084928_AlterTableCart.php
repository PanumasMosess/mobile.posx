<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableCart extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $sql_stock1 = "ALTER TABLE `posx_cart` ADD `printer_name` varchar(50) NULL AFTER `src_order_picture`";
        $db->query($sql_stock1);
    }

    public function down()
    {
        //
    }
}
