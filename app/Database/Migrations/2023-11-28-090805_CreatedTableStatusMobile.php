<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatedTableStatusMobile extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE `posx_mobile_status_print` (`id` INT NOT NULL AUTO_INCREMENT , 
        `order_customer_table_code` VARCHAR(100) NULL, 
        `status` VARCHAR(100) NULL, 
        `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        `companies_id` INT NOT NULL, 
         PRIMARY KEY (`id`),  INDEX (`order_customer_table_code`), INDEX (`companies_id`)) ENGINE = InnoDB";
        $db->query($sql);
    }

    public function down()
    {
        //
    }
}
