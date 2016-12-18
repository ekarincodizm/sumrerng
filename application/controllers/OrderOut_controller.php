<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderOut_controller
 *
 * @author anurartkae
 */
class OrderOut_controller extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->library('mpdf-development/mpdf');
        if ($this->session->userdata('login') == '') {
            redirect('Login_controller', 'refresh');
        }
    }
    
    public function index(){
        $this->cart->destroy();
        $result['product'] = $this->tb_product->get_product();
        $this->load->view('include/header');
        $this->load->view('order_out/order_out_form',$result);
        $this->load->view('include/footter');
    }
    
    public function add_order_out() {
        $product_id = $this->input->post('product_id');
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
        $this->load->view('order_out/order_out_ajax');
        
        
    }
    
    public function cancel_cart() {
        $this->cart->destroy();
        redirect('OrderOut_controller', 'refresh');
    }
    public function back_tomain() {
        $this->cart->destroy();
        redirect('Main_controller', 'refresh');
    }
    public function confirm_order_out() {//$table_id, $table_name
        
        $order_hd_id = "";
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata("user_id");
        
        $order_customer = $this->input->post('order_customer');
        $order_phone = $this->input->post('order_phone');
        $order_stop = $this->input->post('order_stop');
        $order_stopview = $this->input->post('order_stopview');
        
        $num = "";
        $num_run = "";
        $result_id = $this->tb_order->running_number($order_phone);
        
        $result_id = $this->chk_length_num($result_id);
        //$order_hd_id = $num_run;
        $order_hd_id = $result_id;
        
        
        $order_hd_table_id = $order_phone;
        $order_hd_table_name = "โทรสั่ง ".$order_customer;
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
        
        $vo->setorder_phone($order_phone);
        $vo->setorder_stop($order_stop);
        $vo->setorder_stopview($order_stopview);
        $vo->setorder_customer($order_customer);
        $vo->setorder_hd_type("out");
        $vo->setcreate_date($create_date);
        $vo->setcreste_userid($creste_userid);
        $vo->setupdate_date($update_date);
        $vo->setupdate_userid($update_userid);
        if ($result > 0) {
            $result = $this->tb_order->update_order_out_by_order_id($vo,$order_phone);
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
                    $result_insert = $this->tb_order->insert_order_out_detail($voDetail);
                }
            }
        } else {
            $result_insert = $this->tb_order->insert_order_out($vo);
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
                    $result_insert = $this->tb_order->insert_order_out_detail($voDetail);
                }
            }
            
            if ($result_insert > 0) {
                $voTable = new TableVO();
                $voTable->settable_status("B");
                $voTable->settable_id($order_phone);
                $voTable->setupdate_userid($user_id);
                $voTable->setupdate_date($date);
                $result_insert = $this->tb_table->update_table($voTable);
            }
        }
        $order_hd_id = $this->chk_length_num($order_hd_id);
        redirect('OrderOut_controller/order_out_detail_bill/'.$order_hd_id);
         
    }
    public function chk_length_num($result_id){
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

    public function order_out_detail_bill($order_hd_id){
        $result['order'] = $this->tb_order->get_order_by_table($order_hd_id);
        $this->load->view('include/header');
        $this->load->view('order_out/order_out_detail_bill',$result);
        $this->load->view('include/footter');
        
    }
    //พิมพ์ใบ Order ส่งครัว
    public function print_bill_order($order_hd_id){
        $result = $this->tb_order->get_order_by_table($order_hd_id);
        $result_bill = $this->tb_order->get_title_bill("inbound"); 
        $mpdf = new mPDF('th', 'A4', '', ''); //A4-L แนวนอน
        $mpdf->SetTitle($result_bill[0]['bill_title']." Order");
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
                        <th colspan="4" class="text-center">'.$result_bill[0]['bill_title'].'</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">ต.'.$result_bill[0]['bill_sub_district'].' อ.'.$result_bill[0]['bill_district'].' จ.'.$result_bill[0]['bil_province'].' '.$result_bill[0]['bill_postcode'].'</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">โทร.'.$result_bill[0]['bill_phone'].'</th>
                    </tr>
                    
                    <tr>
                        <td colspan="2"  class="text-left">เลขที่ Order : '.$order_hd_id.'</td>
                        <td colspan="2"  class="text-right"> ชื่อโต๊ะ : '.$result[0]['order_hd_table_name'].'</td>
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
    
    
    //พิมพ์ใบเสร็จการณีสั่งจากข้างนอก
    public function print_bill_out($order_hd_id) {
        $result = $this->tb_order->get_order_out_detaill_for_bill($order_hd_id);
        $result_bill = $this->tb_order->get_title_bill("outbound"); 
        $mpdf = new mPDF('th', 'A4', '', ''); //A4-L แนวนอน
        $mpdf->SetTitle($result_bill[0]['bill_title']." Invoice");
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
                        <th colspan="4" class="text-center">'.$result_bill[0]['bill_title'].'</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">ต.'.$result_bill[0]['bill_sub_district'].' อ.'.$result_bill[0]['bill_district'].' จ.'.$result_bill[0]['bil_province'].' '.$result_bill[0]['bill_postcode'].'</th>
                    </tr>
                    <tr>
                        <th colspan="4"  class="text-center">โทร.'.$result_bill[0]['bill_phone'].'</th>
                    </tr>
                    
                    
                    <tr>
                        <td colspan="2"  class="text-left">Order : '.$order_hd_id.'</td>
                        <td colspan="2" class="text-right">ชื่อโต๊ะ : '.$result[0]['order_hd_table_name'].'</td>
                    </tr>
                    <tr>
                        <td  colspan="2" class="text-left">วันที่ : ' . $print_date . ' </td>
                        <td   colspan="2" class="text-right">เวลา : ' . $print_time . ' </td>
                    </tr>
                    <tr>
                        <td  colspan="2" class="text-left">ชื่อผู้สั่ง : ' . $result[0]['order_customer'] . ' </td>
                             <td  colspan="2" class="text-right">โทร : ' . $result[0]['order_phone'] . ' </td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-left">จุดส่งอาหาร : ' . $result[0]['order_stop'] . ' </td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-left">จุดสังเกตุ : ' . $result[0]['order_stopview'] . ' </td>
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
                        <td colspan="4" class="text-right">ภาษี '.$result_bill[0]['bill_vat'].'% : ' . $totalVat . ' บาท</td>
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
    public function check_biil_out() {
        $type = "out";
        $result['order_table'] = $this->tb_order->get_order_out($type);
        $this->load->view('include/header');
        $this->load->view('checkBill/bill_table', $result);
        $this->load->view('include/footter');
    }
    
    
    
    public function update_money($order_hd_id){
        date_default_timezone_set("Asia/Bangkok");
        $update_date = date('Y-m-d H:i:s');
        $update_userid = $this->session->userdata("user_id");
        $order_hd_money = $this->input->post('order_hd_money');
        $result = $this->tb_order->update_money($order_hd_id,$order_hd_money, $update_userid, $update_date); 
        redirect('Order_controller/bill_detail/'.$order_hd_id."/out",'refresh');
    }
    public function payment_out_view($order_id, $payment_money, $table_id,$type) {
        $result['payment'] = array('order_id' => $order_id, 'payment_money' => $payment_money, 'table_id' => $table_id,'type' => $type);
        $this->load->view('include/header');
        $this->load->view('checkBill/payment_out_view', $result);
        $this->load->view('include/footter');
    }
}
