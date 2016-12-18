<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Checkfood_controller
 *
 * @author anurartkae
 */
class Checkfood_controller extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login') == '') {
            redirect('Login_controller', 'refresh');
        }
    }
    public function checkFood_view(){
        $result['order_detail'] = $this->tb_order_detail->get_order_detail();
        $this->load->view('include/header');
        $this->load->view('checkFood/check_food_view',$result);
        $this->load->view('include/footter');
    }
    
   /* public function refresh_view(){
        $result['order_detail'] = $this->tb_order_detail->get_order_detail();
        $this->load->view('include/header');
        $this->load->view('checkFood/refresh_view', $result);
        $this->load->view('include/footter');
    }*/
    public function update_speed_food($order_dt_id,$order_hd_id,$product_id){
        $date = date(DATE_TIME_FORMAT_APP);
        $user_id = $this->session->userdata("user_id");
        $vo = new OrderDetailVO();
        $vo->setorder_dt_id($order_dt_id);
        $vo->setorder_hd_id($order_hd_id);
        $vo->setproduct_id($product_id);
        $vo->setspeed_food("F");
        $vo->setcook_status("B");
        $vo->setupdate_date($user_id);
        $vo->setupdate_userid($date);
        $result = $this->tb_order_detail->update_speed_food($vo);
        
        redirect('Checkfood_controller/checkFood_view','refresh');
    }
    public function cancel_detail($order_dt_id,$order_hd_id,$product_id){
        $vo = new OrderDetailVO();
        $vo->setorder_hd_id($order_hd_id);
        $vo->setorder_dt_id($order_dt_id);
        $vo->setproduct_id($product_id);
        $resultCancel = $this->tb_order_detail->cancel_detail($vo);
        
        if($resultCancel > 0){
            $resultCount = $this->tb_order_detail->get_count_order_detail($vo);
            echo $resultCount;
            if($resultCount <= 0){
                $result = $this->tb_order->cancel_header($vo);
            }
        }
        redirect('Checkfood_controller/checkFood_view','refresh');
    }
}
