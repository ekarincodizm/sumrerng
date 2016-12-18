<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tb_product
 *
 * @author anurartkae
 */
class tb_product extends CI_Model {
    public function get_product(){
        $sql = " select   c.*,p.* "
                . " from tb_product  p"
                . " left join tb_category c on "
                . " c.category_id = p.product_category"
                . " order by p.product_category asc ";
                
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    
    public function get_category(){
        $sql = " select   "
                . "  category_id"
                . " ,category_name "
                . " from tb_category  "
                . " order by category_id asc ";
                
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    public function get_product_by_id($prodduct_id){
         
        $sql = " select * from tb_product where product_id = '".$prodduct_id."'";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    
    }
    public function delete_product($product_id){
        $this->db->where('product_id', $product_id);
        $this->db->delete('tb_product');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function add_product(ProductVO $vo){
        $this->db->set('product_category', $vo->getcategory_id());
        $this->db->set('product_name', $vo->getproduct_name());
        $this->db->set('product_price', $vo->getproduct_price());
        $this->db->set('product_packkey', $vo->getproduct_packkey());
        $this->db->set('product_status', "A");
        $this->db->set('creste_userid', $vo->getcreste_userid());
        $this->db->set('create_date', $vo->getcreate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->insert('tb_product');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function add_category(ProductVO $vo){
        $this->db->set('category_name', $vo->getcategory_name());
        $this->db->set('create_userid', $vo->getcreste_userid());
        $this->db->set('create_date', $vo->getcreate_date());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->insert('tb_category');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
