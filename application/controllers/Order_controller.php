<?php

class Order_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->library('mpdf-development/mpdf');
        if ($this->session->userdata('login') == '') {
            redirect('Login_controller', 'refresh');
        }
    }

    public function order_view($table_id) {
        $result['table'] = $this->tb_table->get_table_by_id($table_id);
        $result['product'] = $this->tb_product->get_product();
        $this->load->view('include/header');
        $this->load->view('order/order_detail', $result);
        $this->load->view('include/footter');
    }

    public function add_order() {
        $product_id = $this->input->post('product_id');
        $table_id = $this->input->post('table_id');
        $result = $this->tb_product->get_product_by_id($product_id);
        $data = array(
            'id' => $result[0]['product_id'],
            'qty' => 1,
            'price' => $result[0]['product_price'],
            'name' => "-",
            'productname' => $result[0]['product_name']
                //'options' => array('Size' => 'L', 'Color' => 'Red')
        );
        $this->cart->insert($data);
        $this->load->view('order/order_in_ajax');
        
    }

    public function reduce_cart($rowId, $qty, $table_id) {
        $data = array(
            'rowid' => $rowId,
            'qty' => $qty - 1
        );
        $this->cart->update($data);
        redirect('Order_controller/order_view/' . $table_id, 'refresh');
    }

    public function load_cart($rowId, $qty, $table_id) {
        $data = array(
            'rowid' => $rowId,
            'qty' => 1 + $qty
        );
        $this->cart->update($data);
        redirect('Order_controller/order_view/' . $table_id, 'refresh');
    }

    public function cancel_cart() {//$table_id
        $this->cart->destroy();
        redirect('Main_controller/order', 'refresh');
    }

    public function confirm_order($table_id, $table_name) {
        $order_hd_id = "";
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata("user_id");
        $result = $this->tb_table->get_table_by_id($table_id);

        $num = "";
        $num_run = "";
        $result_id = $this->tb_order->running_number($table_id);

        $result_id = $this->chk_length_num($result_id);

        //$order_hd_id = $num_run;
        $order_hd_id = $result_id;
        $order_hd_table_id = $table_id;
        $order_hd_table_name = $result[0]['table_name'];
        $ordder_hd_date = $date;
        $order_hd_user = $this->session->userdata('user_prefix') . $this->session->userdata('user_name') . " " . $this->session->userdata('user_lastname');
        $order_hd_status = "B";
        $creste_userid = $this->session->userdata('user_id');
        $create_date = $date;
        $update_userid = $this->session->userdata('user_id');
        $update_date = $date;
        $result = $this->tb_order->check_order_by_order_id($order_hd_id);
        $vo = new OrderVO();
        $voDetail = new OrderDetailVO();
        $vo->setorder_hd_id($order_hd_id);
        $vo->setorder_hd_table_id($order_hd_table_id);
        $vo->setorder_hd_table_name($order_hd_table_name);
        $vo->setordder_hd_date($ordder_hd_date);
        $vo->setorder_hd_user($order_hd_user);
        $vo->setorder_hd_status($order_hd_status);
        $vo->setorder_hd_type("in");
        $vo->setcreate_date($create_date);
        $vo->setcreste_userid($creste_userid);
        $vo->setupdate_date($update_date);
        $vo->setupdate_userid($update_userid);
        if ($result > 0) {
            $result = $this->tb_order->update_order_by_order_id($vo, $table_id/* $order_hd_id, $table_id, $update_userid, $update_date */);
            if ($result > 0) {
                foreach ($this->cart->contents() as $items) {
                    $voDetail->setorder_hd_id($order_hd_id);
                    $voDetail->setproduct_id($items['id']);
                    $voDetail->setproduct_name($items['productname']);
                    $voDetail->setproduct_price($items['price']);
                    $voDetail->setproduct_unit($items['qty']);
                    $voDetail->setupdate_date($update_date);
                    $voDetail->setupdate_userid($update_userid);
                    $voDetail->setcreate_date($create_date);
                    $voDetail->setcreste_userid($creste_userid);
                    $voDetail->setcook_status("B");
                    $voDetail->setspeed_food("S");
                    $voDetail->setchef_unit(0);
                    $result_insert = $this->tb_order->insert_order_detail($voDetail/* $order_hd_id, $items['id'], $items['productname'], $items['price'], $items['qty'], $creste_userid, $create_date, $user_id, $update_date */);
                }
            }
        } else {
            $result_insert = $this->tb_order->insert_order($vo);
            $new_id = $this->db->insert_id();

            $order_hd_id = $new_id;

            if ($result_insert > 0) {
                foreach ($this->cart->contents() as $items) {
                    $voDetail->setorder_hd_id($order_hd_id);
                    $voDetail->setproduct_id($items['id']);
                    $voDetail->setproduct_name($items['productname']);
                    $voDetail->setproduct_price($items['price']);
                    $voDetail->setproduct_unit($items['qty']);
                    $voDetail->setupdate_date($update_date);
                    $voDetail->setupdate_userid($update_userid);
                    $voDetail->setcreate_date($create_date);
                    $voDetail->setcreste_userid($creste_userid);
                    $voDetail->setcook_status("B");
                    $voDetail->setspeed_food("S");
                    $voDetail->setchef_unit(0);
                    $result_insert = $this->tb_order->insert_order_detail($voDetail);
                }
            }

            if ($result_insert > 0) {
                $voTable = new TableVO();
                $voTable->settable_status("B");
                $voTable->settable_id($table_id);
                $voTable->setupdate_userid($user_id);
                $voTable->setupdate_date($date);
                $result_insert = $this->tb_table->update_table($voTable);
            }
        }
        $order_hd_id = $this->chk_length_num($order_hd_id);
        redirect('Order_controller/order_detail_bill/' . $order_hd_id);
    }

    public function chk_length_num($result_id) {
        if (strlen($result_id) < 10) {
            for ($i = 0; $i < 10 - strlen($result_id); $i++) {
                $num = $num . "0";
            }
            $num_run = $num . $result_id;
        } else {
            $num_run = $result_id;
        }
        return $num_run;
    }

    public function order_detail_bill($order_hd_id) {
        $result['order'] = $this->tb_order->get_order_by_table($order_hd_id);
        $this->load->view('include/header');
        $this->load->view('order/order_detail_bill', $result);
        $this->load->view('include/footter');
    }

    //พิมพ์ใบ Order ส่งครัว
    public function print_bill_order($order_hd_id) {
        $result = $this->tb_order->get_order_by_table($order_hd_id);
        $result_bill = $this->tb_order->get_title_bill("inbound");
        $mpdf = new mPDF('th', 'A4', '', ''); //A4-L แนวนอน
        //$mpdf->useOnlyCoreFonts = true;    // false is default
        //$mpdf->SetProtection(array('print'));
        $mpdf->SetTitle($result_bill[0]['bill_title'] . " Order");
        //$mpdf->SetAuthor("Acme Trading Co.");
        $mpdf->SetWatermarkText("Paid");
        $mpdf->showWatermarkText = true;
        //$mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        //$mpdf->SetDisplayMode('fullpage');
        $print_date = date('d/m/Y');
        $print_time = date('H:i');





        $header = '
                <html>
                <head>
                <style>
                    
                </style>
                <style type="text/css" media="print">
                    @page 
                        {
                            size:auto;  
                            margin:5 5 5 5mm;  
                            font-size:13px;
                        }

                        body 
                        {
                            size:auto;
                            margin:5 5 5 5px;  
                            font-size:13px;
                        }
                        .text-center {
                           text-align: center;
                        }
                        .text-left {
                           text-align: left;
                        }
                        .text-right {
                           text-align: right;
                        }
                      
                    </style>
                </head>
                <body>
                <table width="40%" >
                    <tr >
                        <th colspan="4" class="text-center">ใบสั่งอาหาร</th>
                    </tr>
                    <tr >
                        <th colspan="4" class="text-center">' . $result_bill[0]['bill_title'] . '</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">ต.' . $result_bill[0]['bill_sub_district'] . ' อ.' . $result_bill[0]['bill_district'] . ' จ.' . $result_bill[0]['bil_province'] . ' ' . $result_bill[0]['bill_postcode'] . '</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">โทร.' . $result_bill[0]['bill_phone'] . '</th>
                    </tr>
                    
                    <tr>
                        <td colspan="2"  class="text-left">เลขที่ Order : ' . $order_hd_id . '</td>
                        <td colspan="2"  class="text-right"> ชื่อโต๊ะ : ' . $result[0]['order_hd_table_name'] . '</td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-left">ผู้รับ Order : ' . $result[0]['order_hd_user'] . ' </td>
                        
                    </tr>
                    <tr>
                        <td  colspan="3" class="text-left">วันที่พิมพ์ใบ Order : ' . $print_date . ' </td>
                        <td  class="text-right">เวลา : ' . $print_time . ' </td>
                    </tr>
                    
                    <tr>
                        <td colspan="4">..................................................................................</td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" class="text-left" >ชื่อสินค้า</td>
                        
                        <td class="text-right" width="60px">จำนวนสั่ง</td>
                        <td class="text-right" width="80px">หน่วย</td>
                    </tr>
                    <tr><td colspan="4">..................................................................................</td></tr>';
        foreach ($result as $row) {
            $str = $str . '<tr><td  colspan="2" class="text-left" >' . $row['product_name'] . '</td><td class="text-right">' . $row['product_unit'] . '</td><td class="text-right">' . $row['product_packkey'] . '</td></tr>';
        }

        $footter = '<tr><td colspan="4">..................................................................................</td></tr>
                    <tr>
                        <td colspan="4" class="text-center">ให้นำส่งแผนกครัวเพื่อเตรียมปรุงอาหาร</td>
                    </tr>
                    
                </table>
                </body>
                </html>
                ';
        $html = $header . $str . $footter;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    //พิมพ์ใบเสร็จกรณีสั่งในร้าน
    public function print_bill_in($order_hd_id) {
        $result = $this->tb_order->get_order_in_detaill_for_bill($order_hd_id);
        $result_bill = $this->tb_order->get_title_bill("outbound");
        $mpdf = new mPDF('th', 'A4', '', ''); //A4-L แนวนอน
        $mpdf->SetTitle($result_bill[0]['bill_title'] . " Invoice");
        $mpdf->SetWatermarkText("Paid");
        $mpdf->showWatermarkText = true;
        $mpdf->watermarkTextAlpha = 0.1;
        $print_date = date('d/m/Y');
        $print_time = date('H:i');
        $header = '
                <html>
                <head>
                <style>
                    
                </style>
                <style type="text/css" media="print">
                    @page 
                        {
                            size:auto;  /* กำหนดขนาดของหน้าเอกสารเป็นออโต้ครับ */
                            margin:5 5 5 5mm;  /* กำหนดขอบกระดาษเป็น 0 มม. */
                            font-size:13px;
                        }

                        body 
                        {
                            size:auto;
                            margin:5 5 5 5px;  /* เป็นการกำหนดขอบกระดาษของเนื้อหาที่จะพิมพ์ก่อนที่จะส่งไปให้เครื่องพิมพ์ครับ */
                            font-size:13px;
                        }
                        .text-center {
                           text-align: center;
                        }
                        .text-left {
                           text-align: left;
                        }
                        .text-right {
                           text-align: right;
                        }
                      
                    </style>
               
                </head>
                <body>
                <table width="40%">
                    
                    <tr >
                        <th colspan="4" class="text-center">' . $result_bill[0]['bill_title'] . '</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">ต.' . $result_bill[0]['bill_sub_district'] . ' อ.' . $result_bill[0]['bill_district'] . ' จ.' . $result_bill[0]['bil_province'] . ' ' . $result_bill[0]['bill_postcode'] . '</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">โทร.' . $result_bill[0]['bill_phone'] . '</th>
                    </tr>
                    
                    
                    <tr>
                        <td colspan="3"  class="text-left">เลขที่ Order : ' . $order_hd_id . '</td>
                        <td class="text-right">ชื่อโต๊ะ : ' . $result[0]['order_hd_table_name'] . '</td>
                    </tr>
                    <tr>
                        <td  colspan="3" class="text-left">วันที่ออกใบเสร็จ : ' . $print_date . ' </td>
                        <td   class="text-right">เวลา : ' . $print_time . ' </td>
                    </tr>
                    <tr>
                        <td colspan="4">....................................................................................</td>
                    </tr>
                    <tr>
                        <td class="text-left">รายการ</td>
                        <td class="text-right">ราคา</td>
                        <td class="text-right">จำนวน</td>
                        <td class="text-right">รวม</td>
                    
                    </tr>
                    <tr><td colspan="4">....................................................................................</td></tr>';
        $str = "";
        $sum = 0;
        $total = 0;
        $totalAmt = 0;
        $vat = $result_bill[0]['bill_vat'];
        $totalVat = 0;
        foreach ($result as $row) {
            $sum = $row['product_price'] * $row['chef_unit'];
            $str = $str . '<tr><td class="text-left">' . $row['product_name'] . '</td><td class="text-right">' . $row['product_price'] . '</td><td class="text-right">' . $row['chef_unit'] . '</td><td class="text-right">' . $sum . '</td></tr>';
            $total = $total + $sum;
            $totalVat = ($total * $vat) / 100;
            $totalAmt = $total + $totalVat;
        }


        $footter = '<tr><td colspan="4">....................................................................................</td></tr>
                    <tr>
                        <td colspan="4" class="text-right">รวมเป็นเงิน : ' . $total . ' บาท</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">ภาษี ' . $result_bill[0]['bill_vat'] . '% : ' . $totalVat . ' บาท</td>
                    </tr>
                    <tr>
                        
                        <td colspan="4" class="text-right" >รวมเป็นเงินทั้งสิ้น : ' . $totalAmt . ' บาท</td>
                    </tr>
                    
                    
                    <tr>
                        <td colspan="4" class="text-center">โปรดเก็บไว้เป็นหลักฐาน ขอบคุณที่ใช้บริการ</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center">โอกาสหน้าเชิญใหม่น่ะค่ะ</td>
                    </tr>
                </table>
                </body>
                </html>
                ';
        $html = $header . $str . $footter;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public function back_main() {
        $this->cart->destroy();
        redirect('Main_controller');
    }

    public function check_biil_in() {
        $type = "in";
        $result['order_table'] = $this->tb_order->get_order_in($type);
        $this->load->view('include/header');
        $this->load->view('checkBill/bill_table', $result);
        $this->load->view('include/footter');
    }

    public function bill_detail($order_id, $order_hd_type) {
        $result['order'] = $this->tb_order->bill_detail($order_id);
        $this->load->view('include/header');
        if ($order_hd_type == "in") {
            $this->load->view('checkBill/bill_detail_in', $result);
        } else if ($order_hd_type == "out") {
            $this->load->view('checkBill/bill_detail_out', $result);
        } 
            else;
        $this->load->view('include/footter');
    }

    public function check_biil_by_id() {
        $this->load->view('bill_view');
    }

    public function redue_order_by_order($order_dt_id, $order_id, $product_id,$type) {
        $date = date(DATE_TIME_FORMAT_APP);
        $update_userid = $this->session->userdata('user_id');
        $update_date = $date;
        $data = $this->tb_order->get_unit_in_order_detail($order_dt_id, $order_id, $product_id);
        if ($data[0]['product_unit'] >= $data[0]['chef_unit'] && $data[0]['chef_unit'] != 0) {
            $result = $this->tb_order->redue_order_by_order($order_dt_id, $order_id, $product_id, $update_userid, $update_date);
            if ($result > 0) {
                $data = $this->tb_order->get_unit_in_order_detail($order_dt_id, $order_id, $product_id);
                if ($data[0]['product_unit'] > $data[0]['chef_unit']) {
                    $result_update = $this->tb_order->update_cook_status($order_dt_id, $order_id, $product_id, $update_userid, $update_date, "B");
                }
            }
        }


        redirect('Order_controller/bill_detail/' . $order_id . "/".$type, 'refresh');
    }

    public function add_order_by_order($order_dt_id, $order_id, $product_id,$type) {
        $date = date(DATE_TIME_FORMAT_APP);
        $update_userid = $this->session->userdata('user_id');
        $update_date = $date;
        $data = $this->tb_order->get_unit_in_order_detail($order_dt_id, $order_id, $product_id);
        if ($data[0]['product_unit'] > $data[0]['chef_unit']) {
            $result = $this->tb_order->add_order_by_order($order_dt_id, $order_id, $product_id, $update_userid, $update_date);
            if ($result > 0) {
                $data = $this->tb_order->get_unit_in_order_detail($order_dt_id, $order_id, $product_id);
                if ($data[0]['product_unit'] == $data[0]['chef_unit']) {
                    $result_update = $this->tb_order->update_cook_status($order_dt_id, $order_id, $product_id, $update_userid, $update_date, "A");
                }
            }
        }
        redirect('Order_controller/bill_detail/' . $order_id . "/".$type, 'refresh');
    }

    public function payment_in_view($order_id, $payment_money, $table_id, $type) {
        $result['payment'] = array('order_id' => $order_id, 'payment_money' => $payment_money, 'table_id' => $table_id, 'type' => $type);
        $this->load->view('include/header');
        $this->load->view('checkBill/payment_in_view', $result);
        $this->load->view('include/footter');
    }

    public function confirm_payment($table_id, $payment_money, $order_id, $type) {
        $date = date(DATE_TIME_FORMAT_APP);
        $user_id = $this->session->userdata("user_id");
        $result = "";
        $table_name = "";
        if ($type == "in") {
            $result = $this->tb_table->get_table_by_id($table_id);
            $table_name = $result[0]['table_name'];
        } else {
            $result = $this->tb_order->get_order_header($order_id);
            $table_name = $result[0]['order_hd_table_name'];
        }
        $vo = new PaymentVO;
        $vo->setpayment_date($date);
        $vo->setorder_hd_id($order_id);
        $vo->settable_id($table_id);
        $vo->settable_name($table_name);
        $vo->setpayment_money($payment_money);
        $vo->setupdate_date($date);
        $vo->setcreate_date($date);
        $vo->setupdate_userid($user_id);
        $vo->setcreste_userid($user_id);
        $reulst = $this->tb_payment->confirm_payment($vo);
        if ($reulst > 0) {
            $this->tb_order->update_order("A", $order_id, $table_id, $user_id, $date);
            $votable = new TableVO();
            $votable->settable_status("A");
            $votable->settable_id($table_id);
            $votable->setupdate_date($date);
            $votable->setupdate_userid($user_id);
            $this->tb_table->update_table($votable);
        } else {
            
        }
        if ($type == "in") {
            redirect('Order_controller/check_biil_in', 'refresh');
        } else if ($type == "out") {
            redirect('OrderOut_controller/check_biil_out', 'refresh');
        }
    }

    public function delete_billdetail($order_dt_id, $order_id,$type) {
        $vo = new OrderDetailVO();
        $vo->setorder_hd_id($order_id);
        $result = $this->tb_order->delete_order_detail($order_dt_id);
        if ($result > 0) {
            $count = $this->tb_order_detail->get_count_order_detail($vo);
            if ($count <= 0) {
                $chk = $this->tb_order->delete_order_by_id($order_id);
                if ($chk > 0) {
                    redirect('Order_controller/check_biil_in', 'refresh');
                }
            } else {
                redirect('Order_controller/bill_detail/' . $order_id."/".$type, 'refresh');
            }
        }
    }

}
