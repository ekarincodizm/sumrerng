<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Addproduct_controller
 *
 * @author anurartkae
 */
class Addproduct_controller extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('login') == '') {
            redirect('Login_controller', 'refresh');
        }
    }
    
    public function index(){
        $result['product'] = $this->tb_product->get_product();
        $result['category'] = $this->tb_product->get_category();
        $this->load->view('include/header');
        $this->load->view('product/pduct_view',$result);
        $this->load->view('include/footter');
    }
    
    public function delete_product($product_id){
        $result = $this->tb_product->delete_product($product_id);
        redirect('Addproduct_controller','refresh');
    }
    public function add_product(){
        $date = date(DATE_TIME_FORMAT_APP);
        $user_id = $this->session->userdata("user_id");
        $category = $this->input->post('category');
        $product_name = $this->input->post('product_name');
        $product_price = $this->input->post('product_price');
        $product_packkey = $this->input->post('product_packkey');
        $vo = new ProductVO();
        $vo->setproduct_name($product_name);
        $vo->setcategory_id($category);
        $vo->setproduct_packkey($product_packkey);
        $vo->setproduct_price($product_price);
        $vo->setcreate_date($date);
        $vo->setcreste_userid($user_id);
        $vo->setupdate_date($date);
        $vo->setupdate_userid($user_id);
        
        $result = $this->tb_product->add_product($vo);
        redirect('Addproduct_controller','refresh');
        
    }
    public function add_category(){
        $date = date(DATE_TIME_FORMAT_APP);
        $user_id = $this->session->userdata("user_id");
        $category = $this->input->post('category');
        $vo = new ProductVO();
        $vo->setcategory_name($category);
        $vo->setcreate_date($date);
        $vo->setcreste_userid($user_id);
        $vo->setupdate_date($date);
        $vo->setupdate_userid($user_id);
        $result = $this->tb_product->add_category($vo);
        redirect('Addproduct_controller','refresh');
    }
}
