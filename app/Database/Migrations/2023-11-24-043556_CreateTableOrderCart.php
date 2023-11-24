<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableOrderCart extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE `posx_cart` (`id` INT NOT NULL AUTO_INCREMENT , 
        `order_customer_code` VARCHAR(100) NULL , 
        `order_customer_ordername`  VARCHAR(100) NULL , 
        `order_customer_des` TEXT NULL , 
        `order_customer_price` decimal(10,2) NOT NULL , 
        `order_customer_pcs` INT(11) NOT NULL , 
        `order_code` VARCHAR(100) NULL , 
        `order_customer_status` TEXT NULL , 
        `order_customer` TEXT NULL ,
        `order_customer_table_code` VARCHAR(100) NULL, 
        `created_by` TEXT NULL , 
        `updated_by` TEXT NULL , 
        `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        `updated_at` DATETIME NULL DEFAULT NULL , 
        `deleted_at` DATETIME NULL DEFAULT NULL , 
        `companies_id` INT NOT NULL, 
         PRIMARY KEY (`id`), INDEX (`order_customer_code`), INDEX (`order_code`), INDEX (`order_customer_table_code`), INDEX (`companies_id`)) ENGINE = InnoDB";
        $db->query($sql);
    }

    public function down()
    {
        //
    }
}
