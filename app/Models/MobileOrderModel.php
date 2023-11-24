<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class MobileOrderModel
{
    protected $db;
    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->db = &$db;
    }

    public function getTypeMenu($id_company = null)
    {
        $sql = " SELECT * FROM group_product WHERE companies_id = '$id_company' ORDER BY id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }

    public function getMenu($id_company = null)
    {
        $sql = "SELECT * FROM `order` WHERE companies_id = '$id_company' AND order_status != 'CANCEL_ORDER' ORDER BY id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }

    public function orderMenuDetail($id = null)
    {
        $sql = "SELECT * FROM `order` WHERE id = '$id' AND order_status != 'CANCEL_ORDER' ORDER BY id DESC";
        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function getTableDynamic($code = null)
    {
        $sql = "SELECT * FROM `table_dynamic` WHERE table_code = '$code' AND table_status != 'USE' ORDER BY id DESC";
        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function insertOrderCart($data = null)
    {
        $builder_cart = $this->db->table('posx_cart');
        $builder_cart_status = $builder_cart->insert($data);

        return ($builder_cart_status) ? true : false;
    }

    public function getOrderCart($compnies_code = null, $table_code = null)
    {
        $sql = "SELECT * FROM `posx_cart` WHERE order_customer_table_code = '$table_code' AND companies_id = '$compnies_code' ORDER BY id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }
}
