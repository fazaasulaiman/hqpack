<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Master_model extends CI_Model {
     var $table = 'akun';
     var $column_order = array(null,'kode','kpm','alamat');
     var $order_barang = array(null,'kode','nama','produksi','jual'); 
     var $cari_barang = array('kode','nama','produksi','jual'); 
     var $column_search = array('kode','kpm','alamat'); 
     var $order = array('id' => 'desc'); 
            public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            public function cekbarang($kode,$nama){
                $this->db->select('*');
                $this->db->from('barang');
                $this->db->where('kode', $kode);
                $this->db->or_where('nama', $nama);
                $query=$this->db->get();
                if ($query->num_rows() > 0){
                    return 1;
                }else{
                    return 0;
                }

            }
            function cekupload($tgl1,$tgl2){
                $this->db->select('*');
                $this->db->from('upload');
                $this->db->where('tgl1', $tgl1);
                $this->db->where('tgl2', $tgl2);
                $query=$this->db->get();
                if ($query->num_rows() > 0){
                    return 1;
                }else{
                    return 0;
                }

            }
            public function cek($kode){
                $this->db->select('*');
                $this->db->from('kpm');
                $this->db->where('kode', $kode);
                $query=$this->db->get();
                if ($query->num_rows() > 0){
                    return 1;
                }else{
                    return 0;
                }

            }
            public function cekgudang($id_barang,$jumlah){
                $this->db->select('*');
                $this->db->from('gudang');
                $this->db->where('id_barang', $id_barang);
                $this->db->where('stok>=', $jumlah);
                $query=$this->db->get();
                if ($query->num_rows() > 0){
                    return 1;
                }else{
                    return 0;
                }
            }
            public function cekkpm($id_barang,$jumlah){
                $id=$this->session->userdata('ID');
                $this->db->select('*');
                $this->db->from('stock_cabang');
                $this->db->where('id_barang', $id_barang);
                $this->db->where('stock>=', $jumlah);
                $query=$this->db->get();
                if ($query->num_rows() > 0){
                    return 1;
                }else{
                    return 0;
                }
            }
            public function pkm(){
                
                $this->db->select('*');
                $this->db->from('kpm');;
                $this->db->where('level', 1);
                return $query=$this->db->get()->result();
               
            }
            public function runbarang(){
                $this->db->select('id,nama,kode');
                $this->db->from('barang');
                return $query=$this->db->get()->result();
            }

    public function tambah($data,$tabel){
                $this->db->insert($tabel, $data);
                if($tabel=='barang'){
                 return $this->db->insert_id();
                }
            
            }
    public function hps($id,$tabel){
                $this->db->where('id', $id);
                $this->db->delete($tabel);
            }
   
    public function get($id,$tabel){
                $this->db->from($tabel);
                $this->db->where('id',$id);
                $query = $this->db->get();
                return $query->row();
            }
      public function getnota($nota,$tabel){

                $this->db->from($tabel);
                $this->db->where('nota',$nota);
                $query = $this->db->get();
                return $query->row();
            }
          public function gettemplate($where,$tabel,$type=null){

                $this->db->from($tabel);
                $this->db->where($where);
                $query = $this->db->get();
                if (!is_null($type)) {
                    return  $query->result();
                }else{
                     return $query->row();
                }
            }
             public function hpstemplate($where,$tabel){
                $this->db->where($where);
                $this->db->delete($tabel);
            }   
        public function getbarangfromnota($nota,$tabel){
                $this->db->from($tabel);
                $this->db->where('nota',$nota);
                $query = $this->db->get();
                return $query->result();
            }
     public function updup($data,$tgl1,$tgl2)
     {

     $this->db->update('upload', $data, array('tgl1' => $tgl1,'tgl2' => $tgl2,));
    return $this->db->affected_rows();
    }
    
    public function update($where,$data,$tabel)
     {

    $this->db->update($tabel, $data, $where);
    return $this->db->affected_rows();
    }
    
        private function _get_datatables_query($tabel)
    {   
        $this->column_search = $this->db->list_fields($tabel);
        $temp = $this->column_search;
        array_unshift($temp , null);
        $this->column_order = $temp;
   

        $this->db->select("*");
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
            if(!empty($_POST[$item])) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like('LOWER('.$item.')', strtolower($_POST[$item]));
                }
                else
                {
                    $this->db->like('LOWER('.$item.')', strtolower($_POST[$item]));
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
                $this->db->where('nota',$cluase);
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
    public function barangjasa($param){
                
        $this->db->select('*');
        $this->db->from('barangjasa');
        $this->db->like('nama', $param);
        return $query=$this->db->get()->result();
       
    }
    public function sugest($param){
                
        $this->db->select('*');
        $this->db->from($param['tabel']);
        $this->db->like('LOWER(nama)', strtolower($param['query']));
        return $query=$this->db->get()->result();
       
    }
    public function sugestkonsumen($param){
                
        $this->db->select('*');
        $this->db->from('konsumen');
        $this->db->like('konsumen', $param);
        return $query=$this->db->get()->result();
       
    }
    public function sugestnota($param){
                
        $this->db->select('nota');
        $this->db->distinct();
        $this->db->from('laba_rugi');
        $this->db->like('nota', $param);
        return $query=$this->db->get()->result();
       
    }
     public function sugesthargadistributor($param,$search = null){
             
        $this->db->select('*');
        $this->db->from('hargadistributor');
        $this->db->where('distributor', $param);
        if (!is_null($search)) {
            $this->db->like("CONCAT(barangjasa, ' ' ,warna,' ' ,merk)", $search);
        }
        return $query=$this->db->get()->result();
       
    }
    public function checksum($table){
       
        $query = $this->db->query("CHECKSUM TABLE {$table}"); 
        return $query->result_array();
    }
    public function pricelistorder($table,$key){
        $this->db->select('size_kertas,jumlah_order,insheet,plano,margin,id');
        $this->db->from('pricelist_order');
        
            $this->db->where($key['column'], $key['value']);
        
       
       $query = $this->db->get();
        return $query->result();
    }
    public function pldetail($table,$key){
        $this->db->select('pricelist_order.size_kertas,pricelist_order.jumlah_order,pricelist_order.insheet,pricelist_order.plano,pricelist_order.margin,price_list.nama_produk,price_list.produk_konsumen,price_list.warna');
        $this->db->from('pricelist_order');
        $this->db->join('price_list', 'price_list.id = pricelist_order.id_pricelist');
            $this->db->where($key['column'], $key['value']);
        
       
       $query = $this->db->get();
        return $query->result();
    }
    public function hitungpl($type,$key){
        if ($type =='hitung') {
            $this->db->select('sum( hargadistributor.harga*pricelist_distributor.jumlah) as subtotal');
        }
        if ($type =='tampil') {
            $this->db->select('hargadistributor.distributor,hargadistributor.barangjasa,hargadistributor.size,hargadistributor.ketebalan,hargadistributor.harga,pricelist_distributor.jumlah,pricelist_distributor.jenis');
        }
        $this->db->from('pricelist_distributor');
        $this->db->join('hargadistributor', 'hargadistributor.id = pricelist_distributor.id_hargadistributor');
        $this->db->where($key['column'], $key['value']);
        $query = $this->db->get();
        if ($type =='hitung') {
             return $query->row();
        }
        if ($type =='tampil') {
             return $query->result_array();
        }
       
    }
    public function detailSend($nota){
        
    }

}