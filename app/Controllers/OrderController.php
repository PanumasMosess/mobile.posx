<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Controllers\BaseController;

class OrderController extends BaseController
{


    public function __construct()
    {
        // Model Order
        // $this->OrderModel = new \App\Models\OrderModel();

    }

    public function index()
    {
        $data['content'] = '/order_page';
        $data['title'] = 'Menu';
        echo view('/app', $data);
    }

    public function product_detail($order_code = null)
    {
        return view('details/detail');
    }
}
