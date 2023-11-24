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
}
