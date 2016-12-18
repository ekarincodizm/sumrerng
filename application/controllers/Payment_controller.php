<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment_controller
 *
 * @author anurartkae
 */
class Payment_controller extends CI_Controller {

    //put your code here



    function __construct() {
        parent::__construct();
        $this->load->library('mpdf-development/mpdf');
        if ($this->session->userdata('login') == '') {
            redirect('Login_controller', 'refresh');
        }
    }

    public function payMent_View() {
        $result['payment'] = $this->tb_payment->get_paymentAll();
        $this->load->view('include/header');
        $this->load->view('payment/payment_view', $result);
        $this->load->view('include/footter');
    }

    public function search_payment() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $table_id = $this->input->post('table_id');
        $table_name = $this->input->post('table_name');
        $vo = new PaymentVO();
        $vo->setstart_date($start_date);
        $vo->setend_date($end_date);
        $vo->settable_id($table_id);
        $vo->settable_name($table_name);
        $result['payment'] = $this->tb_payment->search_payment($vo);
        $this->load->view('include/header');
        $this->load->view('payment/payment_view', $result);
        $this->load->view('include/footter');
    }

    public function print_payment($payment_id) {
        $result = $this->tb_payment->get_payment_by_id($payment_id);
        $result_bill = $this->tb_order->get_title_bill("outbound"); 
        $mpdf = new mPDF('th', 'A4', '', ''); //A4-L แนวนอน
        //$mpdf->useOnlyCoreFonts = true;    // false is default
        //$mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Sumrerng. - Payment");
        //$mpdf->SetAuthor("Acme Trading Co.");
        $mpdf->SetWatermarkText("Paid");
        $mpdf->showWatermarkText = true;
        //$mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        //$mpdf->SetDisplayMode('fullpage');
        
        
        $payment_id = $result[0]['payment_id'];
        $payment_date = $result[0]['payment_date'];
        $payment_time = $result[0]['payment_time'];
        $payment_money = $result[0]['payment_money'];
        $order_hd_id = $result[0]['order_hd_id']; 
        $table_id = $result[0]['table_id'];
        $table_name = $result[0]['table_name'];
        
        
        
        
        $html = '
                <html>
                <head>
                <style>
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
                <table width="100%" >
                    
                    <tr >
                        <th  colspan="2" class="text-right">ร้านสำเริงต้มแซ่บ</th>
                    </tr>
                    <tr>
                       <th  colspan="2" class="text-right">ต.ป่าตอง อ.กระทู้ จ.ภูเก็ต</th>
                    </tr>
                    <tr>
                        <th colspan="2"  class="text-right">โทร. 0895854562</th>
                    </tr>
                    <tr>
                        <td colspan="2">..............................................................................................................................................................................................</td>
                    </tr>
                    <tr><td colspan="2"  ></td></tr>
                    <tr><td colspan="2"  ></td></tr>
                    <tr><td colspan="2"  ></td></tr>
                    <tr><td colspan="2"  ></td></tr>
                    <tr>
                       <td  class="text-left">เลขที่การชำระ : '.$payment_id.'</td>
                        <td  class="text-left">เลขที่ Order : '.$order_hd_id.'</td>
                    </tr>
                    <tr>
                        <td   class="text-left">หมายเลขโต๊ะ : '.$table_id.'</td>
                        <td   class="text-left">ชื่อโต๊ะ : '.$table_name.' </td>
                    </tr>
                    <tr>
                        <td   class="text-left">วันที่ชำระเงิน : '.$payment_date.' </td>
                        <td   class="text-left">เวลาที่ชำระเงิน : '.$payment_time.' น.</td>
                        
                    </tr>
                    <tr>
                        <td  colspan="2" class="text-left">จำนวนเงินที่ชำระ : '.$payment_money.' บาท</td>
                        
                    </tr>
                    



                    <tr><td colspan="2"  ></td></tr>
                    <tr><td colspan="2"  ></td></tr>
                    <tr><td colspan="2"  ></td></tr>
                    <tr><td colspan="2"  ></td></tr>
                     <tr>
                        <td colspan="2">..............................................................................................................................................................................................</td>
                    </tr>
                   <tr>
                        <td colspan="2" class="text-center">โปรดเก็บไว้เป็นหลักฐาน ขอบคุณที่ใช้บริการ</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">*ราคานี้รวมภาษีมูลค่าเพิ่มแล้ว '.$result_bill[0]['bill_vat'].'%</td>
                    </tr>
                </table>
                </body>
                </html>
                ';
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
         
         
    }

}
