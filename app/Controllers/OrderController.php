<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Controllers\BaseController;

class OrderController extends BaseController
{


    public function __construct()
    {
        // Model Mobile Order
        $this->MobileOrderModel = new \App\Models\MobileOrderModel();
    }

    public function index()
    {
        $data['content'] = '/order_page';
        $data['title'] = 'Menu';
        $data['css_critical'] = '';
        $data['js_critical'] = '    
            <script src="' . base_url('/assets/js/order_script/index_script.js?v=' . time()) . '"></script>
        ';
        echo view('/app', $data);
    }

    public function product_detail($order_code = null)
    {
        return view('details/detail');
    }

    public function getOrderType($id_company = null)
    {
        $list_order_type =  $this->MobileOrderModel->getTypeMenu($id_company);
        return $this->response->setJSON([
            'status' => 200,
            'error' => false,
            'data' => $list_order_type
        ]);
    }

    public function getMenu($id_company = null)
    {
        $list_menu =  $this->MobileOrderModel->getMenu($id_company);
        return $this->response->setJSON([
            'status' => 200,
            'error' => false,
            'data' => $list_menu
        ]);
    }

    public function orderMenuDetail($id_detail = null)
    {
        $data =  $this->MobileOrderModel->orderMenuDetail($id_detail);
        return $this->response->setJSON([
            'status' => 200,
            'error' => false,
            'data' => $data
        ]);
    }

    public function getTableDynamic($table_code = null)
    {
        $data =  $this->MobileOrderModel->getTableDynamic($table_code);
        return $this->response->setJSON([
            'status' => 200,
            'error' => false,
            'data' => $data
        ]);
    }

    public function insertCart()
    {
        $buffer_datetime = date("Y-m-d H:i:s");
        $data = $_POST["data"];

        $data_customer_cart_order = [
            'order_customer_ordername'  => $data[0]['order_order_name'],
            'order_customer_price'  => $data[0]['order_price'],
            'order_customer_pcs'  => $data[0]['pcs'],
            'order_code'  => $data[0]['order_code'],
            'order_customer_status'  => 'CART',
            'order_customer'  => $data[0]['table_code'],
            'order_customer_table_code'  => $data[0]['table_code'],
            'src_order_picture'  => $data[0]['src_order_picture'],
            'order_customer_des'  => $data[0]['order_customer_des'],
            'created_at' => $buffer_datetime,
            'created_by'  => $data[0]['table_code'],
            'companies_id'  => $data[0]['order_companies_id']

        ];
        $order_cart_new = $this->MobileOrderModel->insertOrderCart($data_customer_cart_order);

        if ($order_cart_new) {
            return $this->response->setJSON([
                'status' => 200,
                'error' => true,
                'message' => 'เพิ่มสำเร็จ'
            ]);
        } else {

            return $this->response->setJSON([
                'status' => 200,
                'error' => true,
                'message' => 'เพิ่มไม่สำเร็จ'
            ]);
        }
    }

    public function getOrderCart()
    {
        $data = $_POST["data"];

        $list_cart =  $this->MobileOrderModel->getOrderCart($data[0]['companies'], $data[0]['table_code']);
        return $this->response->setJSON([
            'status' => 200,
            'error' => false,
            'data' => $list_cart
        ]);
    }
}
