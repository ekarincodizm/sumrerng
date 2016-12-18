<?php


class tb_table  extends CI_Model{
    public function get_table(TableVO $vo){
        $sql = " select  "
             . "  table_id"
             . " ,table_name"
             . " ,table_status"
             . " ,table_chair"
             . " ,table_zone"
             . " from tb_table ";
        
        //if($vo->gettable_status() != ""){
            //$sql = $sql." where table_status = '".$vo->gettable_status()."'";
        //}
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    public function get_table_by_id($table_id){
        $sql = " select * from tb_table where table_id = '".$table_id."'";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
     public function update_table(TableVO $vo){
        $this->db->set('table_status', $vo->gettable_status());
        $this->db->set('update_userid', $vo->getupdate_userid());
        $this->db->set('update_date', $vo->getupdate_date());
        $this->db->where('table_id', $vo->gettable_id());
        $this->db->update('tb_table');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
