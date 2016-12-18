<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaymentVO
 *
 * @author anurartkae
 */
class PaymentVO extends CI_Model{
    //put your code here
    
    private $payment_id;
    private $payment_date;
    private $payment_money;
    private $order_hd_id;
    private $table_id;
    private $table_name;
    private $creste_userid;
    private $create_date;
    private $update_userid;
    private $update_date;
    private $start_date;
    private $end_date;
    
    public function setstart_date($start_date){
        $this->start_date = $start_date;
    }
    public function getstart_date(){
        return $this->start_date;
    }
    public function setend_date($end_date){
        $this->end_date = $end_date;
    }
    public function getend_date(){
        return $this->end_date;
    }
    
    
    public function setpayment_id($payment_id){
        $this->payment_id = $payment_id;
    }
    public function getpayment_id(){
        return $this->payment_id;
    }
    
    public function setpayment_date($payment_date){
        $this->payment_date = $payment_date;
    }
    public function getpayment_date(){
        return $this->payment_date;
    }
    
    public function setpayment_money($payment_money){
        $this->payment_money = $payment_money;
    }
    public function getpayment_money(){
        return $this->payment_money;
    }
    
    public function setorder_hd_id($order_hd_id){
        $this->order_hd_id = $order_hd_id;
    }
    public function getorder_hd_id(){
        return $this->order_hd_id;
    }
    
    public function settable_id($table_id){
        $this->table_id = $table_id;
    }
    public function gettable_id(){
        return $this->table_id;
    }
    
    public function settable_name($table_name){
        $this->table_name = $table_name;
    }
    public function gettable_name(){
        return $this->table_name;
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
