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
class tb_order extends CI_Model {

    public function running_number($table_id) {

        /*
          $result = 0;
          $sql = "select max(order_hd_id)+1 as order_hd_id from tb_order ";
          $query = $this->db->query($sql);
          $res2 = $query->result_array();
          $result = $res2[0]['order_hd_id'];
          if ($result == 0) {
          return 1;
          } else {
          return $result;
          }
         */

        $result = 0;
        $sql = "select max(order_hd_id)+1 as order_hd_id from tb_order ";
        $query = $this->db->query($sql);
        $res2 = $query->result_array();
        $result = $res2[0]['order_hd_id'];
        if ($result == 0) {
            return 1;
        } else {
            $sqlChk = "select * from tb_order where order_hd_table_id = '" . $table_id . "' and order_hd_status = 'B'";
            $query = $this->db->query($sqlChk);
            if ($query->num_rows() > 0) {
                $sql = "select order_hd_id from tb_order where order_hd_table_id = '" . $table_id . "' and order_hd_status = 'B'";
                $query = $this->db->query($sqlChk);
                $query = $query->result_array();
                return $query[0]['order_hd_id'];
            } else {
                return $result;
            }
        }
    }

    public function insert_order($order_hd_id, $order_hd_table_id, $order_hd_table_name, $ordder_hd_date, $order_hd_user, $order_hd_status, $creste_userid, $create_date, $update_userid, $update_date) {
        $this->db->set('order_hd_id', $order_hd_id);
        $this->db->set('order_hd_table_id', $order_hd_table_id);
        $this->db->set('order_hd_table_name', $order_hd_table_name);
        $this->db->set('ordder_hd_date', $ordder_hd_date);
        $this->db->set('order_hd_user', $order_hd_user);
        $this->db->set('order_hd_status', $order_hd_status);
        $this->db->set('creste_userid', $creste_userid);
        $this->db->set('create_date', $create_date);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->insert('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function insert_order_detail($order_hd_id, $product_id, $productname, $price, $qty, $creste_userid, $create_date, $update_userid, $update_date) {
        $this->db->set('order_hd_id', $order_hd_id);
        $this->db->set('product_name', $productname);
        $this->db->set('product_price', $price);
        $this->db->set('product_unit', $qty);
        $this->db->set('product_id', $product_id);
        $this->db->set('cook_status', "B");
        $this->db->set('chef_unit', 0);
        $this->db->set('speed_food', "S");
        $this->db->set('creste_userid', $creste_userid);
        $this->db->set('create_date', $create_date);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->insert('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_order_by_table($order_id) {
        $sql = "select "
                . " hdr.order_hd_id"
                . " ,hdr.order_hd_table_id"
                . " ,hdr.order_hd_table_name"
                //. " ,hdr.ordder_hd_date"
                . " ,DATE_FORMAT(date_add(hdr.ordder_hd_date , interval +543 year),'%m/%d/%Y %H:%i:%s') as ordder_hd_date"
                //. " ,DATE_FORMAT(hdr.ordder_hd_date,'%H:%i:%s') as order_time"
                . " ,hdr.order_hd_user"
                . " ,hdr.order_hd_status"
                . " ,dtl.order_dt_id"
                . " ,dtl.product_id"
                . " ,dtl.product_name"
                . " ,dtl.product_price"
                . " ,dtl.product_unit"
                . " ,dtl.chef_unit"
                . " from tb_order hdr "
                . " left join tb_order_detail dtl on hdr.order_hd_id = dtl.order_hd_id "
                . " where hdr.order_hd_id = '" . $order_id . "'"
                . " and hdr.order_hd_status = 'B'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function redue_order_by_order($order_id, $product_id, $update_userid, $update_date) {
        $this->db->set('product_unit', 'product_unit-1', FALSE);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('product_id', $product_id);
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function add_order_by_order($order_id, $product_id, $update_userid, $update_date) {
        $this->db->set('product_unit', 'product_unit+1', FALSE);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('product_id', $product_id);
        $this->db->update('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_order() {
        $sql = " select  "
                . "  order_hd_id"
                . " ,order_hd_table_id"
                . " ,order_hd_table_name"
                . " from tb_order"
                . " where order_hd_status = 'B' order by order_hd_table_id asc";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }

    public function update_order($order_hd_status, $order_id, $table_id, $update_userid, $update_date) {
        $this->db->set('order_hd_status', $order_hd_status);
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('order_hd_table_id', $table_id);
        $this->db->update('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function update_order_by_order_id($order_id, $table_id, $update_userid, $update_date) {
        $this->db->set('update_userid', $update_userid);
        $this->db->set('update_date', $update_date);
        $this->db->where('order_hd_id', $order_id);
        $this->db->where('order_hd_table_id', $table_id);
        $this->db->update('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    
    public function check_order_by_order_id($order_id){
        $sql = " select  * from tb_order where order_hd_id = '".$order_id."' and order_hd_status = 'B'";
        $result = $this->db->query($sql);
        return $result->num_rows();
    }
    
    public function delete_order_detail($order_dt_id) {
        $this->db->where('order_dt_id', $order_dt_id);
        $this->db->delete('tb_order_detail');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function cancel_header(OrderDetailVO $vo){
        $this->db->where('order_hd_id', $vo->getorder_hd_id());
        $this->db->delete('tb_order');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
