<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Follow_model extends CI_Model {
 	 var $table = 'followup';
 	 var $column_order = array(null,'konsumen','barang','tgl_order','next_order'); 
     var $column_search = array('konsumen','barang','tgl_order','next_order'); 
     var $order = array('id' => 'desc'); 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            

   
    public function get($id,$tabel){
            	$this->db->select("konsumen.konsumen, followup.*");
                $this->db->from($tabel);
                $this->db->join('konsumen', 'konsumen.id = followup.id_konsumen');
			    $this->db->where('followup.id',$id);
			    $query = $this->db->get();
			    return $query->row();
            }
    
    
 
    
        private function _get_datatables_query($tabel)
    {
        
        $this->db->select("konsumen.konsumen, followup.*");
        $this->db->from($tabel);
        $this->db->join('konsumen', 'konsumen.id = followup.id_konsumen');
        $i = 0;
        
            foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        
        
        if(isset($_POST['order'])) // here order processing
        {       
           
               $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']); 
            
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($tabel)
    {
        
        $this->_get_datatables_query($tabel);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($tabel)
    {  
        $this->_get_datatables_query($tabel);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($tabel)
    {   
        $this->db->from($tabel);
        return $this->db->count_all_results();
    }
    
    public function sugestkonsumen($param){
                
        $this->db->select('*');
        $this->db->from('konsumen');
        $this->db->like('konsumen', $param);
        return $query=$this->db->get()->result();
       
    }

}