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
        $sql = "SELECT *, `order`.id as id_order FROM `order` 
        left join `group_product` on 
        `order`.group_id = `group_product`.id 
        WHERE  `order`.companies_id = '$id_company' AND `order`.order_status != 'CANCEL_ORDER' ORDER BY `order`.id DESC , `order`.order_menu_recommended DESC LIMIT 4";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }  

    public function getMenuScroll($id_company = null, $limit_plus = null)
    {
        $sql = "SELECT *, `order`.id as id_order FROM `order` 
        left join `group_product` on 
        `order`.group_id = `group_product`.id 
        WHERE  `order`.companies_id = '$id_company' AND `order`.order_status != 'CANCEL_ORDER' ORDER BY `order`.id DESC , `order`.order_menu_recommended DESC LIMIT $limit_plus";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    } 

    public function orderMenuDetail($id = null)
    {
        $sql = "SELECT *, a.id as id_order FROM `order` a
        left join group_product b 
        on a.group_id = b.id
        WHERE a.id = '$id' AND a.order_status != 'CANCEL_ORDER' ORDER BY a.id DESC";
        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function getTableDynamic($code = null)
    {
        $sql = "SELECT * FROM `table_dynamic` WHERE table_code = '$code'  ORDER BY id DESC";
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
        $sql = "SELECT * FROM `posx_cart` WHERE order_customer_table_code = '$table_code' AND companies_id = '$compnies_code' AND  order_customer_status = 'CART' ORDER BY id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }

    public function checkOrderIncart($order_code = null, $compnies_code = null)
    {
        $sql = "SELECT * FROM `posx_cart` WHERE order_code = '$order_code' AND companies_id = '$compnies_code' AND  order_customer_status = 'CART' ORDER BY id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }

    public function updateOrderCart($order_code = null, $compnies_code = null, $data = null)
    {
        $builder = $this->db->table('posx_cart');
        $array_order = array('order_code' => $order_code, 'companies_id' => $compnies_code, 'order_customer_status' => 'CART');
        $builder_status = $builder->where($array_order)->update($data);

        return ($builder_status) ? true : false;
    }

    public function dataInCart($id = null, $data = null)
    {
        $builder = $this->db->table('posx_cart');
        $array_order = array('id' => $id, 'order_customer_status' => 'CART');
        $builder_status = $builder->where($array_order)->update($data);

        return ($builder_status) ? true : false;
    }

    public function getMenuBytype($id = null)
    {
        $sql = "SELECT *, `order`.id as id_order FROM `order` 
        left join `group_product` on 
        `order`.group_id = `group_product`.id 
        WHERE `order`.group_id = '$id' AND `order`.order_status != 'CANCEL_ORDER' ORDER BY `order`.id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }

    public function getMenuSearch($order_name = null, $compnies_code = null)
    {
        $sql = "SELECT *, `order`.id as id_order FROM `order` 
        left join `group_product` on 
        `order`.group_id = `group_product`.id 
        WHERE `order`.order_name LIKE '%$order_name%'
        AND `order`.order_status != 'CANCEL_ORDER'
        AND `order`.companies_id = '$compnies_code' 
        ORDER BY `order`.id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }

    public function getStatusOrderRunning($order_code, $order_customer_table_code)
    {
        $sql = "SELECT (IF(EXISTS(SELECT * FROM order_customer 
        WHERE  order_code ='$order_code' and  order_customer_status = 'IN_KITCHEN'
        and order_customer_table_code = '$order_customer_table_code'),'true','false' ))  
        AS result";

        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function getStatusOrderSummary($order_customer_table_code)
    {
        $sql = "SELECT (IF(EXISTS(SELECT * FROM order_summary 
        WHERE  order_status = 'IN_KITCHEN'
        and order_table_code = '$order_customer_table_code'), 'true','false' ))  
        AS result";

        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function getOrderSummaryRuning($order_customer_table_code)
    {
        $sql = "SELECT * FROM order_summary  WHERE 
        order_status = 'IN_KITCHEN' and 
        order_table_code = '$order_customer_table_code'";

        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function insertOrderPrintLog($data)
    {
        $builder_print = $this->db->table('order_print_log');
        $builder_print_status = $builder_print->insert($data);

        return ($builder_print_status) ? true : false;
    }

    public function getCodeCustomerOrder()
    {
        $sql = "SELECT SUBSTRING(order_customer_code, 5,8) as substr_order_cus_code  FROM order_customer_running order by id desc LIMIT 1";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }

    public function getOrderRunning($order_code, $order_customer_table_code)
    {
        $sql = "SELECT * FROM order_customer  WHERE 
        order_code ='$order_code' and  
        order_customer_status = 'IN_KITCHEN' and 
        order_customer_table_code = '$order_customer_table_code'";

        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function updateOrderCustomer($data_order, $order_code,  $order_customer_table_code)
    {
        $builder_order_update = $this->db->table('order_customer');
        $array_order_update = array('order_code' => $order_code, 'order_customer_status' => 'IN_KITCHEN', 'order_customer_table_code' => $order_customer_table_code, 'order_customer_des' => '');
        $builder_order_update_status = $builder_order_update->where($array_order_update)->update($data_order);
        return ($builder_order_update_status) ? true : false;
    }

    public function updateOrderCustomerSummary($data_order, $order_customer_table_code)
    {
        $builder_order_sum_update = $this->db->table('order_summary');
        $array_order_sum_update = array('order_status' => 'IN_KITCHEN', 'order_table_code' => $order_customer_table_code);
        $builder_order_sum_update_status = $builder_order_sum_update->where($array_order_sum_update)->update($data_order);
        return ($builder_order_sum_update_status) ? true : false;
    }

    public function insertOrderCustomer($data, $running, $datacount = null, $status)
    {
        $builder_table = $this->db->table('order_customer');
        $builder_table_status = $builder_table->insert($data);

        if (($datacount == 0) && ($status == null)) {
            $builder_running = $this->db->table('order_customer_running');
            $builder_running_status = $builder_running->insert($running);
        }


        return ($builder_table_status) ? true : false;
    }

    public function insertOrderCustomerSummary($data, $table, $table_code)
    {
        $builder_summary = $this->db->table('order_summary');
        $builder_summary_status = $builder_summary->insert($data);

        $builder_table = $this->db->table('table_dynamic');
        $builder_table_status =  $builder_table->where('table_code', $table_code)->update($table);

        return ($builder_summary_status && $builder_table_status)  ? true : false;
    }

    public function updateCartStatus($data_order, $order_customer_table_code)
    {
        $builder_order_sum_update = $this->db->table('posx_cart');
        $array_order_sum_update = array('order_customer_status' => 'CART', 'order_customer_table_code' => $order_customer_table_code);
        $builder_order_sum_update_status = $builder_order_sum_update->where($array_order_sum_update)->update($data_order);
        return ($builder_order_sum_update_status) ? true : false;
    }

    public function insertMobileStatusPrint($data)
    {
        $builder_summary = $this->db->table('posx_mobile_status_print');
        $builder_summary_status = $builder_summary->insert($data);

        return ($builder_summary_status)  ? true : false;
    }

    public function getPriceValue($companies = null)
    {
        $sql = "SELECT valueMoney, symbolValueMoney FROM information  WHERE 
        companies_id ='$companies'";
        $builder = $this->db->query($sql);
        return $builder->getRow();
    }

    public function getRecommendd($companies = null)
    {
        $sql = "SELECT *, `order`.id as id_order FROM `order` 
        left join `group_product` on 
        `order`.group_id = `group_product`.id 
        WHERE  `order`.companies_id = '$companies' AND `order`.order_status != 'CANCEL_ORDER' AND  `order`.order_menu_recommended = 1 ORDER BY `order`.id DESC";
        $builder = $this->db->query($sql);
        return $builder->getResult();
    }
}
