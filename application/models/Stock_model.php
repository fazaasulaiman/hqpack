<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Stock_model extends CI_Model {
 	 var $table = 'barang';
 	 var $column_order = array(null,'max(add_gudang.tgl)','barang.kode','barang.nama','gudang.stok','barang.produksi','barang.jual','gudang.stok','add_gudang.tgl'); 
     var $order_korekg = array(null,'korekgudang.tgl','barang.kode','barang.nama','barang.produksi','korekgudang.stokkompi','korekgudang.stoknyata','korekgudang.selisih','korekgudang.hargaselisih','korekgudang.alasan',null);
      var $order_korekkpm = array(null,'korekkpm.tgl','kpm.kode','barang.kode','barang.nama','barang.produksi','korekkpm.stokkompi','korekkpm.stoknyata','korekkpm.selisih','korekkpm.hargaselisih','korekkpm.alasan',null);
     var $order_cabang = array(null,'kpm.kode','barang.kode','barang.nama','stock_cabang.stock','barang.produksi','barang.jual');
     
     var $order_penjualan = array(null,'transaksi_penjualan.id','transaksi_penjualan.tot_item','transaksi_penjualan.tot_harga','transaksi_penjualan.tgl',null); 
     var $column_search = array('barang.nama','barang.kode','barang.produksi','barang.jual','gudang.stok','add_gudang.tgl'); 
     var $order = array('id' => 'desc'); 

        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            
    public function suggest(){
        if ($this->session->userdata('LEVEL')==2) {
        $this->db->select('barang.*,gudang.stok');
        $this->db->from('barang');
        $this->db->join('gudang', 'gudang.id_barang = barang.id');
        }
        else{
            $id=$this->session->userdata('ID');
            $this->db->select('barang.*,stock_cabang.stock as stok');
            $this->db->from('barang');
            $this->db->join('stock_cabang', 'stock_cabang.id_barang= barang.id');
            $this->db->where('stock_cabang.id_kpm', $id);
        }
        
        return $this->db->get()->result();
    }
        private function _get_datatables_query($tabel)
    
    {
     if($tabel=='barang'){
        if($this->input->post('barang'))
                    {
                        $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                    }
        if($this->input->post('tgl'))
                    {
                        $this->db->where('tgl', $this->input->post('tgl'));
                    }
        $this->db->select('barang. * , gudang.stok, max(add_gudang.tgl) as tgl');
        $this->db->from($tabel);
        $this->db->join('gudang', 'barang.id = gudang.id_barang');
        $this->db->join('add_gudang', 'barang.id = add_gudang.id_barang', 'left');
        $this->db->group_by('barang.id');
     }
     if($tabel=='transaksi_penjualan'){
        $id=$this->session->userdata('ID');
        if($this->input->post('kode'))
                    {
                        $this->db->like('LOWER(transaksi_penjualan.id)',strtolower($this->input->post('kode'))); 
                    }
        if($this->input->post('tgl') and $this->input->post('tgl2'))
                {
                    $tgl1=$this->input->post('tgl');
                    $tgl2=$this->input->post('tgl2');
                    $this->db->where("transaksi_penjualan.tgl BETWEEN '$tgl1' and '$tgl2'");
                }
                $this->db->select('transaksi_penjualan.id,transaksi_penjualan.tot_item,transaksi_penjualan.tot_harga,transaksi_penjualan.tgl,transaksi_retur.id as retur');
        $this->db->from($tabel);
        $this->db->join('transaksi_retur', 'transaksi_penjualan.id = transaksi_retur.id_penjualan', 'left');
        $this->db->where('transaksi_retur.id is NULL');
        $this->db->like('transaksi_penjualan.id_kpm',$id);
     }
     if($tabel=="stock_cabang"){
            if($this->input->post('barang'))
                {
                    $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                }
            if($this->input->post('kpm'))
                {
                    $this->db->like('stock_cabang.id_kpm',strtolower($this->input->post('kpm'))); 
                }
        $this->db->select('stock_cabang.*,barang.nama,barang.kode,barang.produksi,barang.jual,kpm.kode as kpm');
        $this->db->from('stock_cabang');
        $this->db->join('barang', 'barang.id = stock_cabang.id_barang');
        $this->db->join('kpm', 'kpm.id = stock_cabang.id_kpm');
        if ($this->session->userdata('LEVEL')==1) {
        $id=$this->session->userdata('ID');
        $this->db->where('stock_cabang.id_kpm', $id);
        }
     }
     if($tabel=='korekkpm'){
        $id=$this->session->userdata('ID');
        if($this->input->post('barang'))
                {
                    $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                }
        if($this->input->post('tgl') and $this->input->post('tgl2'))
                {
                    $tgl1=$this->input->post('tgl');
                    $tgl2=$this->input->post('tgl2');
                    $this->db->where("korekkpm.tgl BETWEEN '$tgl1' and '$tgl2'");
                }
        if($this->input->post('alasan'))
                {
                    $this->db->where('korekkpm.alasan',$this->input->post('alasan')); 
                }
        if($this->input->post('kpm'))
                {
                    $this->db->where('korekkpm.id_kpm',$this->input->post('kpm')); 
                }
        $this->db->select('korekkpm.*, barang.nama,barang.kode,kpm.kode as kpm');
        $this->db->from($tabel);
        $this->db->join('barang', 'barang.id = korekkpm.id_barang');
        $this->db->join('kpm', 'kpm.id = korekkpm.id_kpm');
        if ($this->session->userdata('LEVEL')==1) {
        $this->db->where('korekkpm.id_kpm',$id);
        }
     }
     if($tabel=='korekgudang'){
        if($this->input->post('barang'))
                {
                    $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                }
        if($this->input->post('tgl') and $this->input->post('tgl2'))
                {
                    $tgl1=$this->input->post('tgl');
                    $tgl2=$this->input->post('tgl2');
                    $this->db->where("korekgudang.tgl BETWEEN '$tgl1' and '$tgl2'");
                }
        if($this->input->post('alasan'))
                {
                    $this->db->where('korekgudang.alasan',$this->input->post('alasan')); 
                }
       
        $this->db->select('korekgudang.*, barang.nama,barang.kode');
        $this->db->from($tabel);
        $this->db->join('barang', 'barang.id = korekgudang.id_barang');
     }
        
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
            if($tabel=='korekgudang'){
            $this->db->order_by($this->order_korekg[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }elseif($tabel=='stock_cabang'){
             $this->db->order_by($this->order_cabang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }elseif($tabel=='korekkpm'){
            $this->db->order_by($this->order_korekkpm[$_POST['order']['0']['column']], $_POST['order']['0']['dir']); 
            }elseif($tabel=='barang'){
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']); 
            
            }
            else{
           $this->db->order_by($this->order_penjualan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
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

}