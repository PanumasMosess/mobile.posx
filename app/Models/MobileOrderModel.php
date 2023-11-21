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

    public function getMenu()
    {
        
    }
}
