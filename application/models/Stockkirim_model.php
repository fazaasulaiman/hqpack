<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Stockkirim_model extends CI_Model {
 	 var $table = 'followup';
 	 var $column_order = array(null,'stock_kirim.tanggal','stock_kirim.nota','konsumen.konsumen','stock_kirim.barang','jumlah','stock_kirim.note'); 
     var $column_search = array('stock_kirim.tanggal','stock_kirim.nota','konsumen.konsumen','stock_kirim.barang','jumlah','stock_kirim.note'); 
     var $order = array('stock_kirim.id' => 'desc'); 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            

        private function _get_datatables_query($tabel)
    {
        
        $this->db->select("stock_kirim.id,stock_kirim.tanggal as tanggal,stock_kirim.nota,konsumen.konsumen,stock_kirim.barang,sum(stock_kirim.jumlah) as jumlah,stock_kirim.note");
        $this->db->from($tabel);

        $this->db->join('laba_rugi', 'laba_rugi.id = stock_kirim.id_labarugi');
        $this->db->join('konsumen', 'konsumen.id = laba_rugi.id_konsumen');
        $this->db->group_by('stock_kirim.nota');
       
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
            $items = str_replace(array('stock_kirim.','konsumen.' ), '', $item);
                
              if(!empty($_POST[$items])) // if datatable send POST for search
            {
                

                if($i===0) // first loop
                {
                     // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

                    $this->db->where("DATE(stock_kirim.tanggal)", $_POST[$items]);
                }
                else
                {
                    $this->db->like('LOWER('.$item.')', strtolower($_POST[$items]));
                }
 
               
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
    
   function jumlahkirim($id_labarugi){
    $this->db->select('sum(jumlah) as jumlah');
    $this->db->from('stock_kirim');
    $this->db->where('id_labarugi',$id_labarugi);
     $query = $this->db->get();
        return $query->row();
   }

}