<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Suple_model extends CI_Model {
 	 var $table = 'barang';
 	 var $column_order = array(null,'kirim_cabang.tgl','kpm.kode','barang.nama','barang.produksi','barang.jual','kirim_cabang.jum_kirim','kirim_cabang.tgltrima','kirim_cabang.jum_selisih','kirim_cabang.jum_terima','kirim_cabang.ket'); 
     var $column_search = array('barang.nama','barang.kode','barang.produksi','barang.jual','gudang.stok','add_gudang.tgl'); 
     var $order = array('id' => 'desc'); 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
        private function _get_datatables_query($tabel)
    
    {

        if($this->input->post('barang'))
                {
                    $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                }
        if($this->input->post('kpm'))
                {
                    $this->db->like('kirim_cabang.id_kpm',$this->input->post('kpm')); 
                }
        if($this->input->post('tgl') and $this->input->post('tgl2'))
                {
                    $tgl1=$this->input->post('tgl');
                    $tgl2=$this->input->post('tgl2');
                    $this->db->where("kirim_cabang.tgl BETWEEN '$tgl1' and '$tgl2'");
                }
        if($this->input->post('ket'))
                {
                    $this->db->where('kirim_cabang.ket',$this->input->post('ket')); 
                }
        if($this->session->userdata('LEVEL')==2){
             $this->db->select('kirim_cabang.*, barang.nama,barang.kode,kpm.kode,');
            $this->db->from($tabel);
            $this->db->join('barang', 'barang.id = kirim_cabang.id_barang');
            $this->db->join('kpm', 'kpm.id = kirim_cabang.id_kpm');
            $this->db->where('kpm.level', 1);

        }
        if($this->session->userdata('LEVEL')==1){
            $id=$this->session->userdata('ID');
            $this->db->select('kirim_cabang.*, barang.nama,kpm.kode,kpm.kpm');
            $this->db->from($tabel);
            $this->db->join('barang', 'barang.id = kirim_cabang.id_barang');
            $this->db->join('kpm', 'kpm.id = kirim_cabang.id_kpm');
            $this->db->where('kpm.level', 1);
            $this->db->where('kpm.id', $id);

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
    public function get($id,$tabel){
        $this->db->select('barang.kode,barang.nama,kirim_cabang.id,kirim_cabang.jum_kirim,kirim_cabang.tgl');
        $this->db->from('barang');
        $this->db->join('kirim_cabang', 'barang.id = kirim_cabang.id_barang');
        $this->db->where('kirim_cabang.id', $id);
        return $this->db->get()->row();
    }

}