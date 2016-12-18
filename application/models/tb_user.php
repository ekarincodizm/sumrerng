<?php


class tb_user extends CI_Model{
    
    
    public function check_login($username,$password){
        $sql = "select * from tb_user where user_login = '".$username."' and user_pass = '".$password."'";
        $result = $this->db->query($sql); 
        return $result;
    }
    
}
