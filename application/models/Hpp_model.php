<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Hpp_model extends CI_Model {
 	 var $table = 'followup';
 	 var $column_order = array(null,'hpp.tanggal', 'hpp.distributor','barang','hpp.qty','hpp.harga','hpp.jumlah'); 
     var $column_search = array('hpp.tanggal', 'hpp.distributor','barang','hpp.qty','hpp.harga','hpp.jumlah'); 
     var $order = array('hpp.id' => 'desc'); 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            

        private function _get_datatables_query($tabel)
    {
        
        
        $this->db->select("hpp.id,hpp.tanggal, hpp.distributor,(CASE WHEN (hpp.barang_manual IS NULL) THEN hpp.barang ELSE hpp.barang_manual END) as barang,hpp.qty,hpp.harga,hpp.jumlah");
        $this->db->from($tabel);
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
 
    function get_datatables($tabel,$cluase = null)
    {
        
        $this->_get_datatables_query($tabel);
        if (!is_null($cluase)) {
                $this->db->where('hpp.id_labarugi',$cluase);
            }
        if($_POST['length'] != -1){
              
            $this->db->limit($_POST['length'], $_POST['start']);
        }
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
    public function getedit($id,$tabel){

        $this->db->select("konsumen.konsumen, laba_rugi.*");
        $this->db->from($tabel);
        $this->db->join('konsumen', 'konsumen.id = laba_rugi.id_konsumen');
        $this->db->where('laba_rugi.id',$id);
        $query = $this->db->get();
        return $query->row();
    }
    public function penjualan($data){
        $tgl1 = $data['tgl1'];
        $tgl2 = $data['tgl2'];

        $this->db->select('sum(laba_kotor) as penjualan');
        $this->db->from('laba_rugi');
        $this->db->where('status','Fix');
        $this->db->where("DATE(tanggal) BETWEEN '$tgl1' and '$tgl2'");
        $query = $this->db->get();
        return $query->row();
    }
     public function kategoribeban($data){
        $tgl1 = $data['tgl1'];
        $tgl2 = $data['tgl2'];

        $this->db->select('kategori');
        $this->db->from('beban');
        $this->db->where("DATE(tanggal) BETWEEN '$tgl1' and '$tgl2'");
        $this->db->group_by('kategori');
        $this->db->order_by('kategori');
        $query = $this->db->get();
        return $query->result_array();
    }
     public function textbeban($data){
        $tgl1 = $data['tgl1'];
        $tgl2 = $data['tgl2'];

        $this->db->select('kategori, keterangan, jumlah');
        $this->db->from('beban');
        $this->db->where("DATE(tanggal) BETWEEN '$tgl1' and '$tgl2'");
        $this->db->order_by('kategori');
        $query = $this->db->get();
        return $query->result();
    }

}