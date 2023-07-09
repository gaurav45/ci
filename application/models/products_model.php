<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_MOdel {

	public function getProducts($limit,$start,$data){
        // echo "<pre>";
        // print_r($this->session->userdata());
        if(!empty($this->session->userdata('productLinesearch'))){
            $this->db->where('productLine',$this->session->userdata('productLinesearch'));
        }
        if(!empty($this->session->userdata('minPrice'))){
            $this->db->where('MSRP >=',$this->session->userdata('minPrice'));
        }
        if(!empty($this->session->userdata('maxPrice'))){
            $this->db->where('MSRP <=',$this->session->userdata('maxPrice'));
        }

        if(empty($data)){
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get('products');
       

        return $query->result();
    }


    public function getProductList(){
        $query = $this->db->get('products');
       
        return $query->result();
    }
    public function get_count($data){
        if(!empty($this->session->userdata('productLinesearch'))){
            $this->db->where('productLine',$this->session->userdata('productLinesearch'));
        }

        if(!empty($this->session->userdata('minPrice'))){
            $this->db->where('MSRP >=',$this->session->userdata('minPrice'));
        }
        if(!empty($this->session->userdata('maxPrice'))){
            $this->db->where('MSRP <=',$this->session->userdata('maxPrice'));
        }
        $this->db->from('products');
        return $this->db->count_all_results();

         //echo $this->db->last_query();
    }

    public function getAllProductLine(){
        $this->db->distinct();
        $this->db->select('productLine');
        $query = $this->db->get('products');
        return $query->result();
    }

    public function updateBid($pCode){
        $this->db->set('MSRP', 'MSRP+10', FALSE);
        $this->db->set('bidCount', 'bidCount+1', FALSE);
        $this->db->where('productCode',$pCode);
        $this->db->update('products');
    }

    public function getLatestBid(){
        $this->db->select('productCode,MSRP');
        $query = $this->db->get('products');
       
        return $query->result();
    }

    public function updateUserbid(){
        $this->db->set('bidCount', 'bidCount+1', FALSE);
        $this->db->where('id',$this->session->userdata('userID'));
        $this->db->update('users');
    }

    public function getBidLeft(){
        $this->db->select('bidCount');
        $this->db->where('id',$this->session->userdata('userID'));
        $query = $this->db->get('users');
        return $query->row();
    }
    
}
