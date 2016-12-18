<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderVO
 *
 * @author anurartkae
 */
class OrderVO extends CI_Model{
    //put your code here
    private $order_hd_id;
    private $order_hd_table_id;
    private $order_hd_table_name;
    private $ordder_hd_date;
    private $order_hd_user;
    private $order_hd_status;
    private $order_phone;
    private $order_stop;
    private $order_customer;
    private $order_stopview;
    private $creste_userid;
    private $create_date;
    private $update_userid;
    private $update_date;
    private $order_hd_type;
    
    public function setorder_hd_type($order_hd_type){
        $this->order_hd_type = $order_hd_type;
    }
    public function getorder_hd_type(){
        return $this->order_hd_type;
    }
    
    
    public function setorder_stopview($order_stopview){
        $this->order_stopview = $order_stopview;
    }
    public function getorder_stopview(){
        return $this->order_stopview;
    }
    
    
    public function setorder_hd_id($order_hd_id){
        $this->order_hd_id = $order_hd_id;
    }
    public function getorder_hd_id(){
        return $this->order_hd_id;
    }
    
    public function setorder_hd_table_id($order_hd_table_id){
        $this->order_hd_table_id = $order_hd_table_id;
    }
    public function getorder_hd_table_id(){
        return $this->order_hd_table_id;
    }
    
    public function setorder_hd_table_name($order_hd_table_name){
        $this->order_hd_table_name = $order_hd_table_name;
    }
    public function getorder_hd_table_name(){
        return $this->order_hd_table_name;
    }
    
    public function setordder_hd_date($ordder_hd_date){
        $this->ordder_hd_date = $ordder_hd_date;
    }
    public function getordder_hd_date(){
        return $this->ordder_hd_date;
    }
    
    public function setorder_hd_user($order_hd_user){
        $this->order_hd_user = $order_hd_user;
    }
    public function getorder_hd_user(){
        return $this->order_hd_user;
    }
    
    public function setorder_hd_status($order_hd_status){
        $this->order_hd_status = $order_hd_status;
    }
    public function getorder_hd_status(){
        return $this->order_hd_status;
    }
    
    public function setorder_phone($order_phone){
        $this->order_phone = $order_phone;
    }
    public function getorder_phone(){
        return $this->order_phone;
    }
    
    public function setorder_stop($order_stop){
        $this->order_stop = $order_stop;
    }
    public function getorder_stop(){
        return $this->order_stop;
    }
    
    public function setorder_customer($order_customer){
        $this->order_customer = $order_customer;
    }
    public function getorder_customer(){
        return $this->order_customer;
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
