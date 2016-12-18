<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chef_controller
 *
 * @author anurartkae
 */
class Chef_controller extends CI_Controller{
    //put your code here
     public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login') == '') {
            redirect('Login_controller', 'refresh');
        }
    }
    public function order_forchef_view(){
        $this->load->view('include/header');
        $this->load->view('kitchen/order_forchef');
        $this->load->view('include/footter');
    }
    public function refresh_view(){
        $result['order_detail'] = $this->tb_order_detail->get_order_detail_forchef();
        $this->load->view('include/header');
        $this->load->view('kitchen/refresh_view', $result);
        $this->load->view('include/footter');
    }
    public function update_chefunit($order_dt_id,$order_hd_id,$product_id,$product_unit){
        $date = date(DATE_TIME_FORMAT_APP);
        $user_id = $this->session->userdata("user_id");
        $vo = new OrderDetailVO();
        $vo->setupdate_date($date);
        $vo->setupdate_userid($user_id);
        $vo->setorder_dt_id($order_dt_id);
        $vo->setorder_hd_id($order_hd_id);
        $vo->setproduct_id($product_id);
        $result = $this->tb_order_detail->update_chefunit($vo);
        if($result > 0){
            $chef_unit = $this->tb_order_detail->get_chef_unit($vo);
            $unit = $chef_unit[0]['chef_unit'];
            if($unit == $product_unit){
                $vo->setcook_status("A");
                $result = $this->tb_order_detail->update_cookstatus($vo);
            }
        }
     redirect('Chef_controller/order_forchef_view','refresh');
    }
}
