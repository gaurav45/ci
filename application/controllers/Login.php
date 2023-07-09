<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct(){
	    parent::__construct();

        if($this->session->userdata('isLoggedIn') == TRUE){
           redirect('dashboard');
        }
	    $this->load->model('login_model');
	     $this->form_validation->set_error_delimiters('<div class="error" color="red">', '</div>');

    }
	public function index()
	{
		$this->load->view('login');
	}

	public function addUser(){
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        
		$this->form_validation->set_rules('email', 'Email', 'required|callback_checkUserExist');
		
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
            return;
        }
        
        	
        $data = array(
        	'name' => $this->input->post('name'),
        	'email' => $this->input->post('email'),
        	'password' => $this->input->post('password'),
        	'date_created' => date('Y-m-d H:i:s')
        );
        $insertUser = $this->login_model->addUser($data);
        if($insertUser){
            $this->session->set_flashdata('msg-info', 'successfully registered');
            redirect('Login');
        }else{
            $this->session->set_flashdata('msg-danger', 'user not register');
            redirect('Login');
        }
	}


	public function checkLogin(){
		$this->form_validation->set_rules('lemail', 'Email', 'trim|required');
        $this->form_validation->set_rules('lpassword', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
            return;
        }

       
        $data = $this->input->post();

        $userData = $this->login_model->checkLogin($data);
        if(empty($userData)){
            $this->session->set_flashdata('msg-danger', 'Wrong Crediantial');
            redirect('Login');
        }
        
        $sessionArray = array(
            'userID' => $userData['id'],
            'name'   => $userData['name'],
            'isLoggedIn' =>true
        ); 
        $this->session->set_userdata($sessionArray);
        $data['userData']  = $sessionArray;
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

	public function checkUserExist($email){
	
		$userID = $this->login_model->checkEmail($email);
		
		if($userID == 0){
			return true;
		}else{
	    	$this->form_validation->set_message('checkUserExist', 'Email already exist');
           return false;
		}
		
	}
}