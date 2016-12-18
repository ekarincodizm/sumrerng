<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TableVO
 *
 * @author anurartkae
 */
class TableVO extends CI_Model{
    //put your code here
    private $table_id;
    private $table_name;
    private $table_status;
    private $table_chair;
    private $table_zone;
    private $creste_userid;
    private $create_date;
    private $update_userid;
    private $update_date;
    
    
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
    
    public function settable_status($table_status){
        $this->table_status = $table_status;
    }
    public function gettable_status(){
        return $this->table_status;
    }
    
    public function settable_chair($table_chair){
        $this->table_chair = $table_chair;
    }
    public function gettable_chair(){
        return $this->table_chair;
    }
    
    public function settable_zone($table_zone){
        $this->table_zone = $table_zone;
    }
    public function gettable_zone(){
        return $this->table_zone;
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
