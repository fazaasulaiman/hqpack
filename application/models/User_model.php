<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
    public function login(){
    	$kode=$this->input->post('kode');
    	$password=md5($this->input->post('password'));
    	$this->db->select('*');
    	$this->db->from('kpm');
    	$this->db->where('kode', $kode);
    	$this->db->where('pass', $password);
    	$query=$this->db->get();
               if ($query->num_rows() > 0) 
                foreach ($query->result() as $data) {
          $data=array('LOGIN'=>TRUE,'NAMA'=>$data->kode,'LEVEL'=>$data->level,'ID'=>$data->id);
          $this->session->set_userdata($data);  
          echo json_encode(array("status" => TRUE)); 
      	}else {
               echo json_encode(array("status" => FALSE));
              }

    }




}