<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductVO
 *
 * @author anurartkae
 */
class ProductVO extends CI_Model{
    //put your code here
    private $product_id;
    private $category_id;
    private $category_name;
    private $product_name;
    private $product_price;
    private $product_packkey;
    private $product_status;
    private $creste_userid;
    private $create_date;
    private $update_userid;
    private $update_date;
    
    
    public function setcategory_name($category_name){
        $this->category_name = $category_name;
    }
    public function getcategory_name(){
        return $this->category_name;
    }
    
    
    public function setcategory_id($category_id){
        $this->category_id = $category_id;
    }
    public function getcategory_id(){
        return $this->category_id;
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
    
    public function setproduct_packkey($product_packkey){
        $this->product_packkey = $product_packkey;
    }
    public function getproduct_packkey(){
        return $this->product_packkey;
    }
    
    public function setproduct_status($product_status){
        $this->product_status = $product_status;
    }
    public function getproduct_status(){
        return $this->product_status;
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
