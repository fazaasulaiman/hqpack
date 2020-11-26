<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Pricelistdistributor_model extends CI_Model {
 	
 	 var $column_order = array(null,'jenis','distributor','barangjasa','jumlah','harga','total'); 
     var $column_search = array('jenis','distributor','barangjasa','jumlah','harga','total'); 
     var $order = array('pricelist_distributor.id' => 'desc'); 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            

        private function _get_datatables_query($tabel)
    {
        
        $this->db->select("pricelist_distributor.id,pricelist_distributor.jumlah,pricelist_distributor.jenis,hargadistributor.distributor,hargadistributor.barangjasa,hargadistributor.harga");
        $this->db->from($tabel);
        $this->db->join('hargadistributor', 'hargadistributor.id = pricelist_distributor.id_hargadistributor');
      
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
          
            if(!empty($_POST[$item])) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                     // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    if (!empty($_POST[$item])) {
                        $tgl = explode('|',$_POST[$item]);
                        $this->db->where("DATE(tanggal) BETWEEN '$tgl[0]' and '$tgl[1]'");
                    }else{
                     $this->db->like($item, $_POST[$item]);   
                    }
                    
                }
                elseif ($item == 'status') {

                    $this->db->where($item, $_POST[$item]); 
                }else{
                    $this->db->like($item, $_POST[$item]);
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
 
    function get_datatables($tabel,$where)
    {
        
        $this->_get_datatables_query($tabel);
        $this->db->where('id_plorder',$where);
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
    public function konsumeninvoice($nota){
        $this->db->select("konsumen.konsumen, konsumen.alamat, invoice.nota,invoice.total,invoice.tanggal");
        $this->db->from('invoice');
        $this->db->join('konsumen', 'konsumen.id = invoice.id_konsumen');
        $this->db->where('invoice.nota',$nota);
        $query = $this->db->get();
        return $query->result_array();

    }
    public function transaksi($nota){
        $this->db->select('tanggal,keterangan,kredit,catatan');
        $this->db->from('transaksiinvoice');
        $this->db->where('nota',$nota);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function item($nota){
        $this->db->select('barang,qty,harga,penjualan');
        $this->db->from('laba_rugi');
        $this->db->where('nota',$nota);
        $query = $this->db->get();
        return $query->result_array();
    }
    function detaildistributor($tabel,$where)
    {
        
        $this->_get_datatables_query($tabel);
        $this->db->where('id_pricelist',$where);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

   

}