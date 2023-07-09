<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('isLoggedIn') !== TRUE){
            redirect('login');
        }
        $this->load->model('products_model');
        $this->load->library("pagination");
   }

   public function index(){
      $postData = $this->input->post();
      
      if(!$this->session->userdata('minPrice')){
        $this->session->set_userdata('minPrice','1');
        $this->session->set_userdata('maxPrice','1000');
      }
      if(!empty($postData)){
        if(isset($postData['productLine']) && $postData['productLine'] != 'no_data'){
           $this->session->set_userdata('productLinesearch',$postData['productLine']);
        }else{
           $this->session->unset_userdata('productLinesearch');
        }

        if(isset($postData['minPrice'])){
          $this->session->set_userdata('minPrice',$postData['minPrice']);
        }
        if(isset($postData['maxPrice'])){
          $this->session->set_userdata('maxPrice',$postData['maxPrice']);
        }
      }
      
      $filtereData = array();
      
      $config = array();
      $config["base_url"] = base_url() . "products";
      $config["total_rows"] = $this->products_model->get_count($filtereData);
      $config["per_page"] = 5;
      $config["uri_segment"] = 2;
      $data['productLine'] = $this->products_model->getAllProductLine();
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
      $data['links'] = $this->pagination->create_links();
      $data['main_content'] = 'products';
      //$data['main_content'] = 'products';
      $data['totalProducts'] = $config["total_rows"];
   	 	$data['products']  = $this->products_model->getProducts($config["per_page"], $page,$filtereData);
      if(!empty($postData)){
         $data['main_content'] = 'productFiltered';
      }
     
      $this->load->view('template',$data);
   }

   public function list(){
     $data['products']  = $this->products_model->getProductList();
     $data['main_content'] = 'productList';
     $this->load->view('template',$data);
   }

   public function updateBid(){
     $data = $this->input->post();
     $pCode = $data['productCode'];
     $this->products_model->updateBid($pCode);

     $this->products_model->updateUserbid();

     $countLeft = $this->products_model->getBidLeft();
     echo  $countLeft->bidCount;
   }

   public function refreshBid(){
      $productData = $this->products_model->getLatestBid();
      echo json_encode($productData);
   }

}