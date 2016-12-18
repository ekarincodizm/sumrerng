<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderDetailVO
 *
 * @author anurartkae
 */
class OrderDetailVO extends CI_Model{
    //put your code here
    private $order_dt_id;
    private $order_hd_id;
    private $product_id;
    private $product_name;
    private $product_price;
    private $product_unit;
    private $chef_unit;
    private $cook_status;
    private $speed_food;
    private $creste_userid;
    private $create_date;
    private $update_userid;
    private $update_date;
    
    public function setchef_unit($chef_unit){
        $this->chef_unit = $chef_unit;
    }
    public function getchef_unit(){
        return $this->chef_unit;
    }
    
    
    public function setorder_dt_id($order_dt_id){
        $this->order_dt_id = $order_dt_id;
    }
    public function getorder_dt_id(){
        return $this->order_dt_id;
    }
    
    public function setorder_hd_id($order_hd_id){
        $this->order_hd_id = $order_hd_id;
    }
    public function getorder_hd_id(){
        return $this->order_hd_id;
    }
    
    public function setproduct_id($product_id){
        $this->product_id = $product_id;
    }
    public function getproduct_id(){
        return $this->product_id;
    }
    
    public function setproduct_name($product_name){
        $this->product_name = $product_name;
    }
    public function getproduct_name(){
        return $this->product_name;
    }
    
    public function setproduct_price($product_price){
        $this->product_price = $product_price;
    }
    public function getproduct_price(){
        return $this->product_price;
    }
    
    public function setproduct_unit($product_unit){
        $this->product_unit = $product_unit;
    }
    public function getproduct_unit(){
        return $this->product_unit;
    }
    
    public function setcook_status($cook_status){
        $this->cook_status = $cook_status;
    }
    public function getcook_status(){
        return $this->cook_status;
    }
    
    public function setspeed_food($speed_food){
        $this->speed_food = $speed_food;
    }
    public function getspeed_food(){
        return $this->speed_food;
    }
    
    public function setcreste_userid($creste_userid){
        $this->creste_userid = $creste_userid;
    }
    public function getcreste_userid(){
        return $this->creste_userid;
    }
    
    public function setcreate_date($create_date){
        $this->create_date = $create_date;
    }
    public function getcreate_date(){
        return $this->create_date;
    }
    
    public function setupdate_userid($update_userid){
        $this->update_userid = $update_userid;
    }
    public function getupdate_userid(){
        return $this->update_userid;
    }
    
    public function setupdate_date($update_date){
        $this->update_date = $update_date;
    }
    public function getupdate_date(){
        return $this->update_date;
    }
    


}
