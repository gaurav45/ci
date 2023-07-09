<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashBoard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('isLoggedIn') !== TRUE){
            redirect('login');
        }
   }

   public function index(){
   	 	$data['userData']  = $this->session->userData();
        $data['main_content'] = 'dashboard';
        $this->load->view('template',$data);
   }

   public function logout(){
        $session_data = array(
            'userid' => '',
            'bids' => '',
            'isLoggedIn' => FALSE
        );
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
            redirect('login');
        }

}