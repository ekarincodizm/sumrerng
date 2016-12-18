<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tb_payment
 *
 * @author anurartkae
 */
class tb_payment extends CI_Model{
    
    public function get_paymentAll(){
        $sql = "select "
                . " payment_id"
                . " ,DATE_FORMAT(date_add(payment_date , interval +543 year),'%d/%m/%Y')   as payment_date"
                . " ,DATE_FORMAT(payment_date,'%H:%i') as payment_time"
                . " ,payment_money"
                . " ,order_hd_id"
                . " ,table_id"
                . " ,table_name"
                . " ,creste_userid"
                . " ,DATE_FORMAT(date_add(create_date , interval +543 year),'%d/%m/%Y %H:%i')   as create_date"
                . " ,update_userid"
                . " ,DATE_FORMAT(date_add(update_date , interval +543 year),'%d/%m/%Y %H:%i')   as update_date"
                . " from tb_payment order by payment_id desc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function search_payment(PaymentVO $vo){
        $strWhere = "";
        $sql = "select "
                . " payment_id"
                . " ,DATE_FORMAT(date_add(payment_date , interval +543 year),'%d/%m/%Y')   as payment_date"
                . " ,DATE_FORMAT(payment_date,'%H:%i') as payment_time"
                . " ,payment_money"
                . " ,order_hd_id"
                . " ,table_id"
                . " ,table_name"
                . " ,creste_userid"
                . " ,DATE_FORMAT(date_add(create_date , interval +543 year),'%d/%m/%Y %H:%i')   as create_date"
                . " ,update_userid"
                . " ,DATE_FORMAT(date_add(update_date , interval +543 year),'%d/%m/%Y %H:%i')   as update_date"
                . " from tb_payment ";
        if($vo->getstart_date() != "" && $vo->getend_date() == ""){
            if($strWhere != ""){
                $strWhere = $strWhere." and ";
            }
            $strWhere = " DATE_FORMAT(payment_date,'%Y-%m-%d') = '".$vo->getstart_date()."'";
        }else if($vo->getstart_date() == "" && $vo->getend_date() != ""){
            if($strWhere != ""){
                $strWhere = $strWhere." and ";
            }
            $strWhere = " DATE_FORMAT(payment_date,'%Y-%m-%d') <= '".$vo->getend_date()."'";
        }else if($vo->getstart_date() != "" && $vo->getend_date() != ""){
            if($strWhere != ""){
                $strWhere = $strWhere." and ";
            }
            $strWhere = " DATE_FORMAT(payment_date,'%Y-%m-%d') between '".$vo->getstart_date()."' and '".$vo->getend_date()."'";
        }
        if($vo->gettable_id() != ""){
            if($strWhere != ""){
                $strWhere = $strWhere." and ";
            }
            $strWhere = $strWhere." table_id like '%".$vo->gettable_id()."%'";
        }
        if($vo->gettable_name() != ""){
            if($strWhere != ""){
                $strWhere = $strWhere." and ";
            }
            $strWhere = $strWhere." table_name like '%".$vo->gettable_name()."%'";
        }
        
        
        if($strWhere != ""){
            $sql = $sql." where ".$strWhere;
        }
        $sql = $sql." order by payment_id desc ";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function  confirm_payment(PaymentVO $vo){
        $this->db->set('payment_date',$vo->getpayment_date() );
        $this->db->set('payment_money',$vo->getpayment_money() );
        $this->db->set('order_hd_id', $vo->getorder_hd_id());
        $this->db->set('table_id', $vo->gettable_id());
        $this->db->set('table_name',$vo->gettable_name() );
        $this->db->set('creste_userid', $vo->getcreste_userid());
        $this->db->set('create_date', $vo->getcreate_date());
        $this->db->set('update_userid',$vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->insert('tb_payment');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function get_payment_by_id($payment_id){
        $sql = " select "
                . " payment_id "
                . " ,DATE_FORMAT(date_add(payment_date , interval +543 year),'%d/%m/%Y') as payment_date "
                . " ,DATE_FORMAT(payment_date,'%H:%i') as payment_time"
                . " ,payment_money "
                . " ,order_hd_id"
                . " ,table_id "
                . " ,table_name "
                . " from tb_payment "
                . " where payment_id = '".$payment_id."'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
}
