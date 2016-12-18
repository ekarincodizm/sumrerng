<?php
class Main_controller extends CI_Controller{
   
    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('tb_table');
        if( $this->session->userdata('login') == ''){
             redirect('Login_controller','refresh');
        }
    }
    
    public function index(){
       $this->load->view('include/header');
       if($this->session->userdata('user_role') == "admin"){
           $this->load->view('main');
       }else if($this->session->userdata('user_role') == "chef"){
           $this->load->view('kitchen/order_forchef');
       }else{
           //$this->load->view('staff');
       }
       
       $this->load->view('include/footter');
    }
    
    public function order(){
       $voTable = new TableVO();
       $voTable->settable_status("");
       $result['table'] = $this->tb_table->get_table($voTable);
       $this->load->view('include/header');
       $this->load->view('table',$result);
       $this->load->view('include/footter');
    }
    public function table(){
       $voTable = new TableVO();
       $voTable->settable_status("");
       $result['table'] = $this->tb_table->get_table($voTable);
       $this->load->view('include/header');
       $this->load->view('table',$result);
       $this->load->view('include/footter');
       $this->cart->destroy();
    }
    
    
    
}
