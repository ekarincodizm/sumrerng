<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tb_order_detail
 *
 * @author anurartkae
 */
class tb_order_detail extends CI_Model{
    //put your code here
    public function get_order_detail(){
         
        $sql = " select  "
                . "  h.order_hd_id"
                . " ,h.order_hd_table_name"
                . " ,d.order_dt_id"
                . " ,d.product_id"
                . " ,d.product_name"
                . " ,d.product_unit"
                . " ,d.chef_unit"
                . " ,d.speed_food"
                . " ,d.cook_status"
                . " ,p.product_packkey"
                . " from tb_order h "
                . " left join tb_order_detail d on h.order_hd_id = d.order_hd_id "
                . " left join tb_product p on p.product_id = d.product_id "
                . " where h.order_hd_status = 'B' and d.cook_status = 'B' order by h.order_hd_id asc , d.speed_food asc,d.cook_status desc";//d.cook_status = 'B' and 
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    public function get_order_detail_forchef(){
         
        $sql = " select  "
                . "  h.order_hd_id"
                . " ,h.order_hd_table_name"
                . " ,d.order_dt_id"
                . " ,d.product_id"
                . " ,d.product_name"
                . " ,d.product_unit"
                . " ,d.chef_unit"
                . " ,d.product_unit-d.chef_unit as not_send"
                . " ,d.speed_food"
                . " ,p.product_packkey"
                . " from tb_order h "
                . " left join tb_order_detail d on h.order_hd_id = d.order_hd_id "
                . " left join tb_product p on p.product_id = d.product_id "
                . " where d.cook_status = 'B' and h.order_hd_status = 'B' order by order_hd_id,d.speed_food,d.update_date  asc";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    
    public function update_speed_food(OrderDetailVO $vo){
        $this->db->set('speed_food', $vo->getspeed_food());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->where('order_dt_id', $vo->getorder_dt_id());
        $this->db->where('order_hd_id', $vo->getorder_hd_id());
        $this->db->where('product_id', $vo->getproduct_id());
        $this->db->where('cook_status', $vo->getcook_status());
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function update_chefunit(OrderDetailVO $vo){
        $this->db->set('chef_unit', 'chef_unit+1', FALSE);
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->where('order_dt_id', $vo->getorder_dt_id());
        $this->db->where('order_hd_id', $vo->getorder_hd_id());
        $this->db->where('product_id', $vo->getproduct_id());
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function update_cookstatus(OrderDetailVO $vo){
        $this->db->set('cook_status', $vo->getcook_status());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->where('order_dt_id', $vo->getorder_dt_id());
        $this->db->where('order_hd_id', $vo->getorder_hd_id());
        $this->db->where('product_id', $vo->getproduct_id());
        
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function get_chef_unit(OrderDetailVO $vo){
        $sql = " select  chef_unit from tb_order_detail "
                . " where order_dt_id = '".$vo->getorder_dt_id()."'"
                . " and order_hd_id = '".$vo->getorder_hd_id()."'"
                . " and product_id = '".$vo->getproduct_id()."'";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    public function cancel_detail(OrderDetailVO $vo){
        $this->db->where('order_dt_id', $vo->getorder_dt_id());
        $this->db->where('order_hd_id', $vo->getorder_hd_id());
        $this->db->where('product_id', $vo->getproduct_id());
        $this->db->delete('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function get_count_order_detail(OrderDetailVO $vo){
        $sql = " select  * from tb_order_detail"
                . " where order_hd_id = '".$vo->getorder_hd_id()."'";
        $result = $this->db->query($sql);
        return $result->num_rows();
    }
    
    
}
