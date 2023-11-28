<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Controllers\BaseController;
use PHPUnit\Framework\Constraint\Count;

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
        $order_cart_new = false;
        $order_in_cart = $this->MobileOrderModel->checkOrderIncart($data[0]['order_code'], $data[0]['order_companies_id']);
        $count_order = count($order_in_cart);
        if ($count_order > 0) {
            $data_customer_cart_order = [
                'order_customer_pcs'  => $data[0]['pcs'] + $order_in_cart[0]->order_customer_pcs,
                'updated_at' => $buffer_datetime,
                'updated_by'  => $data[0]['table_code']
            ];
            $order_cart_new = $this->MobileOrderModel->updateOrderCart($data[0]['order_code'], $data[0]['order_companies_id'], $data_customer_cart_order);
        } else {
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
        }



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

    public function orderCartUpdate()
    {
        $buffer_datetime = date("Y-m-d H:i:s");
        $data = $_POST["data"];
        $data_customer_cart_order = [
            'order_customer_pcs'  => $data[0]['sum_pcs'],
            'updated_at' => $buffer_datetime,
            'updated_by'  => $data[0]['table_code']

        ];
        $order_cart_new = $this->MobileOrderModel->dataInCart($data[0]['id'], $data_customer_cart_order);

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

    public function orderMenuByType()
    {
        $data = $_POST["data"];
        if ($data[0]['id'] == 'All') {
            $list_menu =  $this->MobileOrderModel->getMenu($data[0]['companies']);
            return $this->response->setJSON([
                'status' => 200,
                'error' => false,
                'data' => $list_menu
            ]);
        } else {
            $list_menu =  $this->MobileOrderModel->getMenuBytype($data[0]['id']);
            return $this->response->setJSON([
                'status' => 200,
                'error' => false,
                'data' => $list_menu
            ]);
        }
    }

    public function orderMenuSearch()
    {
        $data = $_POST["data"];

        $list_menu =  $this->MobileOrderModel->getMenuSearch($data[0]['name'], $data[0]['companies']);
        return $this->response->setJSON([
            'status' => 200,
            'error' => false,
            'data' => $list_menu
        ]);
    }


    public function insertOrderCustomer()
    {
        $buffer_datetime = date("Y-m-d H:i:s");
        $datas = $_POST["data"];
        $count_cycle = 0;
        $pcs = 0;
        $table_code = null;


        $check_arr_count = count($datas);

        foreach ($datas as $data) {

            $ststus_check = '';
            $ststus_sum_check = '';
            $order_new = '';

            $ststus_check = $this->MobileOrderModel->getStatusOrderRunning($data[0]['order_code'],  $data[0]['order_customer_table_code']);
            $ststus_sum_check = $this->MobileOrderModel->getStatusOrderSummary($data[0]['order_customer_table_code']);
            $ststus_sum_order_code = $this->MobileOrderModel->getOrderSummaryRuning($data[0]['order_customer_table_code']);

            $ststus_sum_order_code  = $ststus_sum_order_code ?? null;

            if ($ststus_check->result == 'true') {
                $order_for_update =  $this->MobileOrderModel->getOrderRunning($data[0]['order_code'],  $data[0]['order_customer_table_code']);

                $data_order = [
                    'order_customer_pcs'  => ($data[0]['order_customer_pcs'] + $order_for_update->order_customer_pcs),
                    'updated_at' => $buffer_datetime,
                    'updated_by'  => $data[0]['order_customer_table_code']
                ];

                $order_new = $this->MobileOrderModel->updateOrderCustomer($data_order, $data[0]['order_code'],  $data[0]['order_customer_table_code']);

                $data_print_log = [
                    'order_customer_code'  => $order_for_update->order_customer_code,
                    'order_code'  => $data[0]['order_code'],
                    'order_table_code' => $data[0]['order_customer_table_code'],
                    'order_customer_ordername' => $data[0]['order_customer_ordername'],
                    'order_customer_pcs'  => $data[0]['order_customer_pcs'],
                    'order_print_status'  => 'WAIT_PRINT',
                    'created_at'  => $buffer_datetime,
                    'created_by'  => $data[0]['order_customer_table_code'],
                    'companies_id'  => $data[0]['companies_id']

                ];
                $order_customer_code_pdf = $order_for_update->order_customer_code;
                $order_print_log = $this->MobileOrderModel->insertOrderPrintLog($data_print_log);


                $pcs += $data[0]['order_customer_pcs'];

                if ($order_new) {
                    $count_cycle++;
                    if ($check_arr_count == $count_cycle) {
                        if ($ststus_sum_check->result == 'true') {

                            $summary_for_update =  $this->MobileOrderModel->getOrderSummaryRuning($data[0]['order_customer_table_code']);
                            $data_order_summary = [
                                'order_price_sum' => ($data[0]['order_price_sum'] + $summary_for_update->order_price_sum),
                                'order_pcs_sum'  => ($pcs + $summary_for_update->order_pcs_sum),
                                'updated_at' => $buffer_datetime,
                                'updated_by'  => $data[0]['order_customer_table_code']
                            ];
                            $update_order_summary_new = $this->MobileOrderModel->updateOrderCustomerSummary($data_order_summary,  $data[0]['order_customer_table_code']);
                        }

                        $data_posx_cart = [
                            'order_customer_status'  => 'FINISH',
                        ];

                        $update_status_cart = $this->MobileOrderModel->updateCartStatus($data_posx_cart,  $data[0]['order_customer_table_code']);

                        $data_mobile_status = [
                            'order_customer_table_code'  => $data[0]['order_customer_table_code'],
                            'status'  => 'WAIT_PRINT'
                        ];

                        $mobile_wait_print = $this->MobileOrderModel->insertMobileStatusPrint($data_mobile_status);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => 200,
                        'error' => true,
                        'message' => 'เพิ่มไม่สำเร็จ'
                    ]);
                }
            } else {
                $order_running_code = '';

                if ($count_cycle == 0) {
                    $buffer_order_code = 0;
                    $new_running_codes = $this->MobileOrderModel->getCodeCustomerOrder();

                    foreach ($new_running_codes as $running_code) {
                        $buffer_order_code = (int)$running_code->substr_order_cus_code;
                    }

                    if ($ststus_sum_order_code != null) {
                        $order_running_code = $ststus_sum_order_code->order_customer_code;
                    } else {
                        $sum_order_code = $buffer_order_code + 1;
                        $sprintf_order_code = sprintf("%08d", $sum_order_code);
                        $order_running_code = "POXC" . $sprintf_order_code;
                    }
                } else {
                    $buffer_order_code = 0;
                    $new_running_codes = $this->MobileOrderModel->getCodeCustomerOrder();

                    foreach ($new_running_codes as $running_code) {
                        $buffer_order_code = (int)$running_code->substr_order_cus_code;
                    }

                    if ($ststus_sum_order_code != null) {
                        $order_running_code = $ststus_sum_order_code->order_customer_code;
                    } else {
                        $sum_order_code = $buffer_order_code;
                        $sprintf_order_code = sprintf("%08d", $sum_order_code);
                        $order_running_code = "POXC" . $sprintf_order_code;
                    }
                }


                $data_print_log = [
                    'order_customer_code'  => $order_running_code,
                    'order_code'  => $data[0]['order_code'],
                    'order_table_code' => $data[0]['order_customer_table_code'],
                    'order_customer_ordername' => $data[0]['order_customer_ordername'],
                    'order_customer_pcs'  => $data[0]['order_customer_pcs'],
                    'order_print_status'  => 'WAIT_PRINT',
                    'created_at'  => $buffer_datetime,
                    'created_by'  => $data[0]['order_customer_table_code'],
                    'companies_id'  => $data[0]['companies_id']

                ];
                $order_customer_code_pdf = $order_running_code;
                $order_print_log = $this->MobileOrderModel->insertOrderPrintLog($data_print_log);

                //data table table
                $data_customer_order = [
                    'order_customer_code'  => $order_running_code,
                    'order_customer_ordername'  => $data[0]['order_customer_ordername'],
                    'order_customer_pcs'  => $data[0]['order_customer_pcs'],
                    'order_code'   => $data[0]['order_code'],
                    'order_customer_status'   => $data[0]['order_status'],
                    'order_customer'  => '',
                    'order_customer_table_code' => $data[0]['order_customer_table_code'],
                    'created_at' => $buffer_datetime,
                    'created_by'  => $data[0]['order_customer_table_code'],
                    'companies_id'  => $data[0]['companies_id']
                ];

                $data_code = [
                    'order_customer_code'  => $order_running_code,
                ];

                $table_code = $data[0]['order_customer_table_code'];

                $data_status_table = [
                    'table_status'  => 'USE',
                ];

                $pcs += $data[0]['order_customer_pcs'];

                $data_summary = [
                    'order_customer_code' =>  $order_running_code,
                    'order_table_code' =>  $data[0]['order_customer_table_code'],
                    'order_price_sum' =>  $data[0]['order_price_sum'],
                    'order_pcs_sum' =>  $pcs,
                    'order_time' =>  $buffer_datetime,
                    'order_status' =>  $data[0]['order_status'],
                    'created_by' =>  $data[0]['order_customer_table_code'],
                    'created_at' =>  $buffer_datetime,
                    'companies_id'  => $data[0]['companies_id']
                ];

                $create_new = $this->MobileOrderModel->insertOrderCustomer($data_customer_order, $data_code, $count_cycle, $ststus_sum_order_code);

                if ($create_new) {
                    $count_cycle++;
                    if ($check_arr_count == $count_cycle) {
                        if ($ststus_sum_check->result == 'false') {
                            $create_new2 = $this->MobileOrderModel->insertOrderCustomerSummary($data_summary, $data_status_table, $table_code);
                        } else  if ($ststus_sum_check->result == 'true') {

                            $summary_for_update =  $this->MobileOrderModel->getOrderSummaryRuning($data[0]['order_customer_table_code']);
                            $data_order_summary = [
                                'order_price_sum' => ($data[0]['order_price_sum'] + $summary_for_update->order_price_sum),
                                'order_pcs_sum'  => ($data[0]['order_customer_pcs'] + $summary_for_update->order_pcs_sum),
                                'updated_at' => $buffer_datetime,
                                'updated_by'  => $data[0]['order_customer_table_code']
                            ];
                            $update_order_summary_new = $this->MobileOrderModel->updateOrderCustomerSummary($data_order_summary,  $data[0]['order_customer_table_code']);
                        }

                        $data_posx_cart = [
                            'order_customer_status'  => 'FINISH',
                        ];

                        $update_status_cart = $this->MobileOrderModel->updateCartStatus($data_posx_cart,  $data[0]['order_customer_table_code']);

                        $data_mobile_status = [
                            'order_customer_table_code'  => $data[0]['order_customer_table_code'],
                            'status'  => 'WAIT_PRINT'
                        ];

                        $mobile_wait_print = $this->MobileOrderModel->insertMobileStatusPrint($data_mobile_status);
                    }
                } else {

                    return $this->response->setJSON([
                        'status' => 200,
                        'error' => true,
                        'message' => 'เพิ่มไม่สำเร็จ'
                    ]);
                }
            }
        }

        if ($check_arr_count == $count_cycle) {

            return $this->response->setJSON([
                'status' => 200,
                'error' => false,
                'message' => 'เพิ่มรายการสำเร็จ'
            ]);
        } else {
            //  ว่าง
        }
    }
}
