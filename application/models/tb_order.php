<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tb_order
 *
 * @author anurartkae
 */
class tb_order extends CI_Model{
    //put your code here
    public function get_order_in($type){
         
        $sql = " select "
                . "  order_hd_id"
                . " ,order_hd_table_name"
                . " ,order_hd_type"
                . " from tb_order "
                . " where order_hd_status = 'B' "
                . " and order_hd_type = '".$type."' order by order_hd_table_id asc";
                
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    public function get_order_out($type){
        $sql = " select "
                . "  order_hd_id"
                . " ,order_hd_table_name"
                . ",order_hd_type"
                . " from tb_order "
                . " where order_hd_status = 'B' "
                . " and order_hd_type = '".$type."'";
                
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    public function running_number($table_id){
       $sql = " select * "
            . " from tb_order "
            . " where order_hd_table_id = '".$table_id."'"
            . " and order_hd_status = 'B' ";
        $result = $this->db->query($sql);
        if($result->num_rows() > 0){
            $result = $this->db->query($sql);
            $result = $result->result_array();
            return $result[0]['order_hd_id'];
        }else{
            //$maxid = $this->db->query('SELECT MAX(order_hd_id) AS `maxid` FROM `tb_order`')->row()->maxid;
            //return  $maxid+1;
            return 0;
        }
    }
    public function get_unit_in_order_detail($order_dt_id, $order_id, $product_id){
         
        $sql = " select "
                . "  product_unit"
                . " ,chef_unit"
                . " from tb_order_detail "
                . " where order_dt_id = '".$order_dt_id."'"
                . " and order_hd_id = '".$order_id."'"
                . " and product_id = '".$product_id."'";
                
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    public function update_cook_status($order_dt_id, $order_id, $product_id, $update_userid, $update_date,$cook_status){
        $this->db->set('cook_status', $cook_status);
        $this->db->set('update_date', $update_date);
        $this->db->set('update_userid', $update_userid);
        $this->db->where('order_dt_id', $order_dt_id);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('product_id', $product_id);
        
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function check_order_by_order_id($order_hd_id){
         $sql = " select * "
              . " from tb_order "
              . " where order_hd_id = '".$order_hd_id."'";
        $result = $this->db->query($sql);
        return $result->num_rows();
    }
    public function update_order($order_hd_status,$order_id, $table_id, $user_id, $date){
        
        $this->db->set('order_hd_status', $order_hd_status);
        $this->db->set('update_date', $date);
        $this->db->set('update_userid', $user_id);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('order_hd_table_id', $table_id);
        $this->db->update('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_order_out_by_order_id(OrderVO $vo,$table_id){
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->where('order_hd_id', $vo->getorder_hd_id());
        $this->db->where('order_hd_table_id', $table_id);
        $this->db->update('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function update_order_by_order_id(OrderVO $vo,$table_id){
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->where('order_hd_id', $vo->getorder_hd_id());
        $this->db->where('order_hd_table_id', $table_id);
        $this->db->update('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function insert_order(OrderVO $vo){
        $this->db->set('order_hd_table_id', $vo->getorder_hd_table_id());
        $this->db->set('order_hd_table_name', $vo->getorder_hd_table_name());
        $this->db->set('ordder_hd_date', $vo->getordder_hd_date());
        $this->db->set('order_hd_type', $vo->getorder_hd_type());
        $this->db->set('order_hd_user', $vo->getorder_hd_user());
        $this->db->set('order_hd_status', $vo->getorder_hd_status());
        $this->db->set('creste_userid', $vo->getcreste_userid());
        $this->db->set('create_date', $vo->getcreate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->insert('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function insert_order_out(OrderVO $vo){
        $this->db->set('order_phone', $vo->getorder_phone());
        $this->db->set('order_stop', $vo->getorder_stop());
        $this->db->set('order_stopview', $vo->getorder_stopview());
        $this->db->set('order_customer', $vo->getorder_customer());
        $this->db->set('order_hd_type', $vo->getorder_hd_type());
        $this->db->set('order_hd_table_id', $vo->getorder_hd_table_id());
        $this->db->set('order_hd_table_name', $vo->getorder_hd_table_name());
        $this->db->set('ordder_hd_date', $vo->getordder_hd_date());
        $this->db->set('order_hd_user', $vo->getorder_hd_user());
        $this->db->set('order_hd_status', $vo->getorder_hd_status());
        $this->db->set('creste_userid', $vo->getcreste_userid());
        $this->db->set('create_date', $vo->getcreate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->insert('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function insert_order_detail(OrderDetailVO $vo){
        $this->db->set('order_hd_id', $vo->getorder_hd_id());
        $this->db->set('product_id', $vo->getproduct_id());
        $this->db->set('product_name', $vo->getproduct_name());
        $this->db->set('product_price', $vo->getproduct_price());
        $this->db->set('product_unit', $vo->getproduct_unit());
        $this->db->set('chef_unit', $vo->getchef_unit());
        $this->db->set('cook_status', $vo->getcook_status());
        $this->db->set('speed_food', $vo->getspeed_food());
        $this->db->set('creste_userid', $vo->getcreste_userid());
        $this->db->set('create_date', $vo->getcreate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->insert('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function insert_order_out_detail(OrderDetailVO $vo){
        $this->db->set('order_hd_id', $vo->getorder_hd_id());
        $this->db->set('product_id', $vo->getproduct_id());
        $this->db->set('product_name', $vo->getproduct_name());
        $this->db->set('product_price', $vo->getproduct_price());
        $this->db->set('product_unit', $vo->getproduct_unit());
        $this->db->set('chef_unit', $vo->getchef_unit());
        $this->db->set('cook_status', $vo->getcook_status());
        $this->db->set('speed_food', $vo->getspeed_food());
        $this->db->set('creste_userid', $vo->getcreste_userid());
        $this->db->set('create_date', $vo->getcreate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->insert('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function get_order_header($order_hd_id){
        $sql = " select "
                . " * "
                . " from tb_order "
                . " where order_hd_id = '".$order_hd_id."'";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    
    
    public function get_title_bill($type){
        $sql = " select * "
                . "  from tb_bill_config where bill_type = '".$type."'";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    //bill ใบสั่งอาหารส่งครัว
    public function get_order_by_table($order_id){
        $sql = " select "
                . "  h.order_hd_id"
                . " ,h.order_hd_table_id"
                . " ,h.order_hd_table_name"
                . " ,h.order_hd_money"
                . " ,DATE_FORMAT(date_add(ordder_hd_date , interval +543 year),'%d/%m/%Y')   as ordder_hd_date"
                . " ,DATE_FORMAT(ordder_hd_date,'%H:%i') as order_time"
                . " ,h.order_hd_user"
                . " ,d.order_dt_id"
                . " ,d.product_name"
                . " ,d.product_unit"
                . " ,d.product_price"
                . " ,d.product_id"
                . " ,p.product_packkey "
                . " ,d.chef_unit "
                . " from tb_order h "
                . " left join tb_order_detail d "
                . " on h.order_hd_id = d.order_hd_id "
                . " left join tb_product p "
                . " on p.product_id = d.product_id "
                . " where h.order_hd_id = '".$order_id."'"
                . " and d.cook_status = 'B' ";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    //bill สรุปเช็คบิล
    public function bill_detail($order_id){
        $sql = " select "
                . "  h.order_hd_id"
                . " ,h.order_hd_table_id"
                . " ,h.order_hd_table_name"
                . " ,h.order_hd_money"
                . " ,DATE_FORMAT(date_add(ordder_hd_date , interval +543 year),'%d/%m/%Y')   as ordder_hd_date"
                . " ,DATE_FORMAT(ordder_hd_date,'%H:%i') as order_time"
                . " ,h.order_hd_user"
                . " ,d.order_dt_id"
                . " ,d.product_name"
                . " ,d.product_unit"
                . " ,d.product_price"
                . " ,d.product_id"
                . " ,p.product_packkey "
                . " ,d.chef_unit "
                . " from tb_order h "
                . " left join tb_order_detail d "
                . " on h.order_hd_id = d.order_hd_id "
                . " left join tb_product p "
                . " on p.product_id = d.product_id "
                . " where h.order_hd_id = '".$order_id."'"
                . " and h.order_hd_status = 'B' ";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    
    
    
    //bil invoice  สำหรับ Order ที่สั่งในร้าน
    public function get_order_in_detaill_for_bill($order_hd_id){
        $sql = " select "
                . "  h.order_hd_id"
                . " ,h.order_hd_table_id"
                . " ,h.order_hd_table_name"
                . " ,d.product_name"
                . " ,d.product_price"
                . " ,p.product_packkey "
                . " ,sum(d.chef_unit) as  chef_unit"
                . " from tb_order h "
                . " left join tb_order_detail d "
                . " on h.order_hd_id = d.order_hd_id "
                . " left join tb_product p "
                . " on p.product_id = d.product_id "
                . " where h.order_hd_id = '".$order_hd_id."'"
                . " and h.order_hd_status = 'B' and d.chef_unit > 0 "
                . " group by"
                . "  h.order_hd_id"
                . " ,h.order_hd_table_id"
                . " ,h.order_hd_table_name"
                . " ,d.product_name "
                . " ,d.product_price"
                . " ,p.product_packkey";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    
    //bil invoice  สำหรับ Order ที่สั่งจากข้างนอก
    public function get_order_out_detaill_for_bill($order_hd_id){
        $sql = " select "
                . "  h.order_hd_id"
                . " ,h.order_hd_table_id"
                . " ,h.order_hd_table_name"
                . " ,d.product_name"
                . " ,d.product_price"
                . " ,p.product_packkey "
                . " ,h.order_phone"
                . " ,h.order_stop"
                . " ,h.order_stopview"
                . " ,h.order_customer"
                . " ,sum(d.chef_unit) as  chef_unit"
                . " from tb_order h "
                . " left join tb_order_detail d "
                . " on h.order_hd_id = d.order_hd_id "
                . " left join tb_product p "
                . " on p.product_id = d.product_id "
                . " where h.order_hd_id = '".$order_hd_id."'"
                . " and h.order_hd_status = 'B' "
                . " and d.chef_unit > 0 "
                . " group by "
                . "  h.order_hd_id"
                . " ,h.order_hd_table_id"
                . " ,h.order_hd_table_name"
                . " ,d.product_name "
                . " ,d.product_price"
                . " ,p.product_packkey"
                . " ,h.order_phone"
                . " ,h.order_stop"
                . " ,h.order_stopview"
                . " ,h.order_customer";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    
    public function delete_order_detail($order_dt_id){
        $this->db->where('order_dt_id', $order_dt_id);
        $this->db->delete('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function delete_order_by_id($order_hd_id){
        $this->db->where('order_hd_id', $order_hd_id);
        $this->db->delete('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function redue_order_by_order($order_dt_id,$order_id, $product_id, $update_userid, $update_date){
        $this->db->set('chef_unit', 'chef_unit-1', FALSE);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->where('order_dt_id', $order_dt_id);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('product_id', $product_id);
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function add_order_by_order($order_dt_id,$order_id, $product_id, $update_userid, $update_date){
        $this->db->set('chef_unit', 'chef_unit+1', FALSE);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->where('order_dt_id', $order_dt_id);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('product_id', $product_id);
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
     public function update_money($order_hd_id,$order_hd_money, $update_userid, $update_date){
        $this->db->set('order_hd_money',$order_hd_money);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->where('order_hd_id', $order_hd_id);
        $this->db->update('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function circulation($start_date,$end_date){
        $sql = " select "
                . "  product_id"
                . " ,product_name"
                . " ,product_price*chef_unit as price"
                . " ,sum(chef_unit) as chef_unit"
                . " ,DATE_FORMAT(create_date,'%Y-%m-%d') as create_date"
                . " from tb_order_detail  "
                . " where DATE_FORMAT(create_date,'%Y-%m-%d')  between '".$start_date."' and '".$end_date."'"
                . " group by "
                . " product_id"
                . ",product_name"
                . " order by chef_unit desc";
                
                
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
}
