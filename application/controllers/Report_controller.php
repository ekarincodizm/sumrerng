<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_controller
 *
 * @author anurartkae
 */
class Report_controller extends CI_Controller {
    //put your code here
    
    
    function __construct() {
        parent::__construct();
        $this->load->library('mpdf-development/mpdf');
        if ($this->session->userdata('login') == '') {
            redirect('Login_controller', 'refresh');
        }
    }
    public function index(){
       $this->load->view('include/header');
       $this->load->view('report/report_type_view');
       $this->load->view('include/footter');
    }
    public function circulation(){
       $this->load->view('include/header');
       $this->load->view('report/circulation');
       $this->load->view('include/footter');
    }
    public function circulation_ajax(){
       $start_date = $this->input->post('start_date');
       $end_date = $this->input->post('end_date');
       $result['date'] = array('start_date'=>$start_date,'end_date'=>$end_date);
       $result['circulation'] = $this->tb_order->circulation($start_date,$end_date);
       $this->load->view('report/circulation_ajax',$result);
    }
     public function circulation_report($start_date,$end_date){
       $result = $this->tb_order->circulation($start_date,$end_date);
       $result_bill = $this->tb_order->get_title_bill("inbound");
       $mpdf = new mPDF('th', 'A4', '', ''); //A4-L แนวนอน
       $mpdf->SetTitle($result_bill[0]['bill_title']." รายงานสรุปยอดขาย");
       //$mpdf->SetWatermarkText("Paid");
       $mpdf->showWatermarkText = true;
       $mpdf->watermarkTextAlpha = 0.1;
       $print_date = date('Y-m-d');
        $print_time = date('H:i');
        $header = '
                <html>
                <head>
                
                <style type="text/css" media="print">
                    
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
                <table width="100%"  >
                    <tr >
                        <th colspan="5" class="text-right">' . $result_bill[0]['bill_title'] . '</th>
                    </tr>
                    <tr>
                        <th colspan="5"  class="text-right">ต.' . $result_bill[0]['bill_sub_district'] . ' อ.' . $result_bill[0]['bill_district'] . ' จ.' . $result_bill[0]['bil_province'] . ' ' . $result_bill[0]['bill_postcode'] . '</th>
                    </tr>
                    <tr>
                        <th colspan="5"  class="text-right">โทร.' . $result_bill[0]['bill_phone'] . '</th>
                    </tr>
                    <tr >
                        <th colspan="5" class="text-center">รายงานสรุปยอดขาย</th>
                    </tr>
                    
                    <tr>
                        <td  colspan="2"  class="text-left">วันที่พิมพ์รายงาน : ' . $print_date . ' </td>
                        <td  class="text-right" colspan="3" >เวลา : ' . $print_time . ' </td>
                    </tr>
                    <tr>
                        <td  colspan="5"  class="text-left">ยอดขายวันที่ : ' . $start_date. ' ถึงวันที่ '.$end_date.'</td>
                        
                    </tr>
                    
                    <tr>
                        <td colspan="5">....................................................................................................................................................................</td>
                    </tr>
                    
                    <tr>
                        <td colspan="1" class="text-left" >ชื่อสินค้า</td>
                        <td colspan="2" class="text-right" width="60px">ราคา/หน่วย</td>
                        <td colspan="1" class="text-right" width="80px">จำนวน</td>
                        <td colspan="1" class="text-right" width="80px">รวม</td>
                    </tr>
                    <tr><td colspan="5">....................................................................................................................................................................</td></tr>';
        $sum = 0;
        $total = 0;
        foreach ($result as $row) {
            $sum = $row['price']*$row['chef_unit'];
            $total = $total+$sum;
            $str = $str . '<tr><td  colspan="2" class="text-left" >' . $row['product_name'] . '</td><td class="text-right">' . $row['price'] . '</td><td class="text-right">' . $row['chef_unit'] . '</td><td class="text-right">' . $sum . '</td></tr>';
        }

        $footter = '<tr><td colspan="5">....................................................................................................................................................................</td></tr>
                    <tr>
                        <td colspan="5" class="text-right">รวมเป็นเงินที่ขายได้ทั้งสิ้น : '.$total.' บาท</td>
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
    
    public function best_seller(){
       $this->load->view('include/header');
       $this->load->view('report/best_seller');
       $this->load->view('include/footter');
    }
    public function inventory_balance(){
       $this->load->view('include/header');
       $this->load->view('report/inventory_balance');
       $this->load->view('include/footter');
    }
    
   
    public function best_seller_report(){
      
    }
    public function inventory_balance_report(){
       
    }
}
