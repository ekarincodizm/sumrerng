<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('login');
    }
    public function check_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result_user = $this->tb_user->check_login($username,$password);
        if ($result_user -> num_rows() > 0) {
            
            foreach ($result_user->result() as $row) {
                    $data = array(
                        'user_id'        => $row->user_id,
                        'user_prefix'    => $row->user_prefix,
                        'user_name'      => $row->user_name,
                        'user_lastname'  => $row->user_lastname,
                        'user_role'      => $row->user_role,
                        'user_insert'    => $row->user_insert,
                        'user_update'    => $row->user_update,
                        'user_delete'    => $row->user_delete,
                        'user_login'     => $row->user_login,
                        'user_pass'      => $row->user_pass,
                        'login'          => TRUE
                    );
            }
            $this->session->set_userdata($data);
            redirect('Main_controller');
        }else{
           redirect('Login_controller','refresh');
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect("Login_controller", "refresh");
        exit();
    }

}
