<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Labarugi_model extends CI_Model {
 	 var $table = 'followup';
 	 var $column_order = array(null,'tanggal','nota','konsumen','barang','hpp','qty','harga','penjualan','laba_kotor','status','progress'); 
     var $column_search = array('laba_rugi.tanggal','laba_rugi.nota','konsumen.konsumen','laba_rugi.barang','laba_rugi.hpp','laba_rugi.qty','laba_rugi.harga','laba_rugi.penjualan','laba_rugi.laba_kotor','invoice.status'); 
     var $order = array('id' => 'desc'); 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            

        private function _get_datatables_query($tabel)
    {
        
        $this->db->select("konsumen.konsumen, laba_rugi.*,invoice.status as progress");
        $this->db->from($tabel);
        $this->db->join('konsumen', 'konsumen.id = laba_rugi.id_konsumen');
        $this->db->join('invoice', 'invoice.nota = laba_rugi.nota');
        if ($_POST['tanggal'] == '|') {
            $_POST['tanggal'] = '';
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
          
            if(!empty($_POST[$item])) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                     // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    if (!empty($_POST[$item])) {
                        $tgl = explode('|',$_POST[$item]);
                        $this->db->where("DATE(laba_rugi.tanggal) BETWEEN '$tgl[0]' and '$tgl[1]'");
                    }else{
                     $this->db->like($item, $_POST[$item]);   
                    }
                    
                }
                elseif ($item == 'status') {

                    $this->db->where('laba_rugi.status', $_POST[$item]); 
                }elseif ($item == 'progress') {

                    $this->db->where('invoice.status', $_POST[$item]); 
                }
                else{
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

        $this->db->select('sum(laba_kotor) as kotor, sum(penjualan) as penjualan, sum(hpp) as hpp');
        $this->db->from('laba_rugi');
        $this->db->where('status','Fix');
        $this->db->where("DATE(tanggal) BETWEEN '$tgl1' and '$tgl2'");
        $query = $this->db->get();
        return $query->row();
    }
     public function chartMonth($data,$klaus = null){
       
        $data = explode('-', $data);
        $year = $data[0];
        $month = $data[1];
        $this->db->select('sum(laba_kotor) as kotor, sum(penjualan) as penjualan, sum(hpp) as hpp');
        $this->db->from('laba_rugi');
        $this->db->where('status','Fix');
        $this->db->where("YEAR(tanggal)",$year);
        if (!is_null($klaus)) {
           $this->db->where("MONTH(tanggal)",$month);
        }
        
        $query = $this->db->get();
        return $query->row();
    }
     public function chartBeban($data,$klaus = null){
       
        $data = explode('-', $data);
        $year = $data[0];
        $month = $data[1];
        $this->db->select('sum(jumlah) as pengeluaran');
        $this->db->from('beban');
        $this->db->where("YEAR(tanggal)",$year);
        if (!is_null($klaus)) {
            $this->db->where("MONTH(tanggal)",$month);
        }
        
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

    public function rankPenjualan(){
        $this->db->select('konsumen.konsumen, sum(laba_rugi.penjualan) as penjualan');
        $this->db->from('laba_rugi');
        $this->db->join('konsumen', 'konsumen.id = laba_rugi.id_konsumen');
        $this->db->group_by('laba_rugi.id_konsumen');
        $this->db->order_by('penjualan','desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    public function rankLaba(){
        $this->db->select('konsumen.konsumen, sum(laba_rugi.laba_kotor) as laba');
        $this->db->from('laba_rugi');
        $this->db->join('konsumen', 'konsumen.id = laba_rugi.id_konsumen');
        $this->db->Where('laba_rugi.status','Fix');
        $this->db->group_by('laba_rugi.id_konsumen');
        $this->db->order_by('laba','desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
     public function rankAktivitas(){
        $this->db->select('konsumen.konsumen, count(laba_rugi.id_konsumen) as aktivitas');
        $this->db->from('laba_rugi');
        $this->db->join('konsumen', 'konsumen.id = laba_rugi.id_konsumen');
        $this->db->group_by('laba_rugi.id_konsumen');
        $this->db->order_by('aktivitas','desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }

}