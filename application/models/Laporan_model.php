<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Laporan_model extends CI_Model {
 	 var $table = 'akun';
 	 var $column_order = array(null,'kpm','password','kode','pass','alamat','barang','jual','produksi');
     var $order_upload= array(null,'upload.tgl','kpm.kode','upload.tgl1','upload.tgl2',null,null,null,null);
     var $order_lapretur = array(null,'transaksi_dataretur.tgl','kpm.kode','transaksi_dataretur.id','barang.nama','(transaksi_data.jumlah + transaksi_dataretur.jumlah)','transaksi_dataretur.jumlah'); 
    var $order_penjualan = array(null,'transaksi_penjualan.tgl','kpm.kode','transaksi_penjualan.id','transaksi_penjualan.tunai', 'transaksi_penjualan.atm', 'transaksi_penjualan.vocher','sum( transaksi_data.diskon )','transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )','sum( transaksi_data.jumlah * transaksi_data.produksi )','(
transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )
) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher )'); 
    var $order_data=array(null,'transaksi_data.tgl','kpm.kode','transaksi_data.id_penjualan','barang.kode','barang.nama','transaksi_data.jumlah','transaksi_data.harga_item','transaksi_data.tot_harga');
    var $order_req=array(null,'request.noreq','request.tgl','kpm.kode','barang.kode','barang.nama','request.jumlah','request.status');
     var $column_search = array('kpm','password','kode','pass','alamat','barang','jual','produksi');
     var $order = array('id' => 'desc'); 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            
         function pengeluaran($tgl1,$tgl2,$kpm){
            $this->db->select("sum(CASE WHEN alasan = 'FOC' THEN hargaselisih else 0 END ) AS FOC,
            sum(CASE WHEN alasan = 'Rusak' THEN hargaselisih else 0 END ) AS Rusak,
            sum(CASE WHEN alasan = 'Hilang' THEN hargaselisih else 0 END ) AS Hilang");
            $this->db->from('korekkpm');
            $this->db->where("DATE(tgl) BETWEEN '$tgl1' and '$tgl2'");
            $this->db->where('id_kpm', $kpm);
            return $this->db->get()->row();
         }
         function kotor($tgl1,$tgl2,$kpm){
            $this->db->select('transaksi_penjualan.id_kpm, (transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher ) AS kotor');
            $this->db->from('transaksi_penjualan');
            $this->db->join('transaksi_data', 'transaksi_penjualan.id = transaksi_data.id_penjualan');
            $this->db->join('kpm', 'kpm.id = transaksi_penjualan.id_kpm');
            
            $this->db->where("DATE(transaksi_penjualan.tgl) BETWEEN '$tgl1' and '$tgl2'");
            $this->db->where('transaksi_penjualan.id_kpm', $kpm);
            $this->db->group_by('transaksi_penjualan.id');
            return $this->db->get()->result();
            
         } 
         function bersihtahun($bulan,$tahun,$kpm){
            $this->db->select("sum(CASE WHEN alasan = 'FOC' THEN hargaselisih else 0 END ) AS FOC,
            sum(CASE WHEN alasan = 'Rusak' THEN hargaselisih else 0 END ) AS Rusak,
            sum(CASE WHEN alasan = 'Hilang' THEN hargaselisih else 0 END ) AS Hilang");
            $this->db->from('korekkpm');
            $this->db->where("month( tgl )=$bulan");
            $this->db->where("year( tgl )=$tahun");
            $this->db->where('id_kpm', $kpm);
            return $this->db->get()->row();

         }
         function bersihkpm($tgl1,$tgl2,$kpm){
            $this->db->select("sum(CASE WHEN alasan = 'FOC' THEN hargaselisih else 0 END ) AS FOC,
            sum(CASE WHEN alasan = 'Rusak' THEN hargaselisih else 0 END ) AS Rusak,
            sum(CASE WHEN alasan = 'Hilang' THEN hargaselisih else 0 END ) AS Hilang");
            $this->db->from('korekkpm');
            $this->db->where("DATE(tgl) BETWEEN '$tgl1' and '$tgl2'");
            $this->db->where('id_kpm', $kpm);
            return $this->db->get()->row();

         }
         function kotorcharttahun($bulan,$tahun,$kpm){
            $this->db->select('transaksi_penjualan.id_kpm, (transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher ) AS kotor');
            $this->db->from('transaksi_penjualan');
            $this->db->join('transaksi_data', 'transaksi_penjualan.id = transaksi_data.id_penjualan');
            $this->db->join('kpm', 'kpm.id = transaksi_penjualan.id_kpm');
            $this->db->where("month( transaksi_penjualan.tgl )=$bulan");
            $this->db->where("year( transaksi_penjualan.tgl )=$tahun");
            $this->db->where('transaksi_penjualan.id_kpm', $kpm);
            $this->db->group_by('transaksi_penjualan.id');
            return $this->db->get()->result();
            
         } 
         function kotorchartkpm($tgl1,$tgl2,$kpm){
            $this->db->select('transaksi_penjualan.id_kpm, (transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher ) AS kotor');
            $this->db->from('transaksi_penjualan');
            $this->db->join('transaksi_data', 'transaksi_penjualan.id = transaksi_data.id_penjualan');
            $this->db->join('kpm', 'kpm.id = transaksi_penjualan.id_kpm');
            $this->db->where("DATE(transaksi_penjualan.tgl) BETWEEN '$tgl1' and '$tgl2'");
            $this->db->where('transaksi_penjualan.id_kpm', $kpm);
            $this->db->group_by('transaksi_penjualan.id');
            return $this->db->get()->result();
            
         } 
    
        private function _get_datatables_query($tabel)
    {
        $id=$this->session->userdata('ID');
        $level=$this->session->userdata('LEVEL');
        if ($tabel=='transaksi_data') {
            if($this->input->post('tgl') and $this->input->post('tgl2'))
                {
                    $tgl1=$this->input->post('tgl');
                    $tgl2=$this->input->post('tgl2');
                    $this->db->where("DATE(transaksi_data.tgl) BETWEEN '$tgl1' and '$tgl2'");
                }
            if($this->input->post('barang'))
                {
                    $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                }
             if($this->input->post('kpm'))
                {
                    $this->db->like('transaksi_data.id_kpm',$this->input->post('kpm')); 
                }
            $this->db->select("transaksi_data.*,barang.nama,barang.kode,kpm.kode as kpm");
            $this->db->from($tabel);
            $this->db->join('barang', 'barang.id = transaksi_data.id_barang');
            $this->db->join('kpm', 'kpm.id = transaksi_data.id_kpm');
            if ($level==1) {
            $this->db->like('transaksi_data.id_kpm',$id); 
            }
             
        }
        if ($tabel=='request') {
            if($this->input->post('barang'))
                {
                    $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                }
             if($this->input->post('kpm'))
                {
                    $this->db->like('kpm.kode',$this->input->post('kpm')); 
                }
            $this->db->select("request.*,barang.nama,barang.kode,kpm.kode as kpm");
            $this->db->from($tabel);
            $this->db->join('barang', 'barang.id = request.id_barang');
            $this->db->join('kpm', 'kpm.id = request.id_kpm');
             
        }
        if ($tabel=='upload') {
             if($this->input->post('kpm'))
                {
                    $this->db->like('kpm.kode',$this->input->post('kpm')); 
                }
            $this->db->select("upload.*,kpm.kode as kpm");
            $this->db->from($tabel);
            $this->db->join('kpm', 'kpm.id = upload.id_kpm');
             
        }
        if ($tabel=='transaksi_retur') {
            if($this->input->post('tgl') and $this->input->post('tgl2'))
                {
                    $tgl1=$this->input->post('tgl');
                    $tgl2=$this->input->post('tgl2');
                    $this->db->where("DATE(transaksi_data.tgl) BETWEEN '$tgl1' and '$tgl2'");
                }
            if($this->input->post('barang'))
                {
                    $this->db->like('LOWER(barang.nama)',strtolower($this->input->post('barang'))); 
                }
            if($this->input->post('kpm'))
                {
                    $this->db->like('transaksi_dataretur.id_kpm',$this->input->post('kpm')); 
                }
            $this->db->select(" transaksi_dataretur.id,transaksi_dataretur.tgl as date, transaksi_dataretur.id_penjualan, kpm.kode AS kpm, transaksi_dataretur.id_barang, barang.nama,(transaksi_data.jumlah + transaksi_dataretur.jumlah)  AS jumlah, transaksi_dataretur.jumlah AS retur");
            $this->db->from('transaksi_dataretur');
            $this->db->join('barang', 'barang.id = transaksi_dataretur.id_barang');
            $this->db->join('kpm', 'kpm.id = transaksi_dataretur.id_kpm');
            $this->db->join('transaksi_data', 'transaksi_dataretur.id_penjualan = transaksi_data.id_penjualan
AND transaksi_dataretur.id_barang = transaksi_data.id_barang');
            if ($level==1) {
            $this->db->like('transaksi_dataretur.id_kpm',$id); 
            }
             
        }
        if ($tabel=='transaksi_penjualan') {
            if($this->input->post('tgl') and $this->input->post('tgl2'))
                {
                    $tgl1=$this->input->post('tgl');
                    $tgl2=$this->input->post('tgl2');
                    $this->db->where(" DATE(transaksi_penjualan.tgl) BETWEEN '$tgl1' and '$tgl2'");
                }
            if($this->input->post('nota'))
                {
                    $this->db->like('LOWER(transaksi_penjualan.id)',strtolower($this->input->post('nota'))); 
                }
            if($this->input->post('kpm'))
                {
                    $this->db->like('transaksi_penjualan.id_kpm',$this->input->post('kpm')); 
                }
            $this->db->select('kpm.kode as kpm,transaksi_penjualan.id,transaksi_penjualan.tgl, transaksi_penjualan.tunai, transaksi_penjualan.atm, transaksi_penjualan.vocher, sum( transaksi_data.diskon ) AS totdiskon,transaksi_penjualan.tot_harga - sum( transaksi_data.diskon ) AS jumlahlr, sum( transaksi_data.jumlah * transaksi_data.produksi ) AS totproduksi, (
transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )
) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher ) AS kotor');
            $this->db->from($tabel);
            $this->db->join('transaksi_data', 'transaksi_penjualan.id = transaksi_data.id_penjualan');
            $this->db->join('kpm', 'kpm.id = transaksi_penjualan.id_kpm');

            if ($level==1) {
            $this->db->where('transaksi_penjualan.id_kpm', $id);
            }
            $this->db->group_by('transaksi_penjualan.id');
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
            if ($tabel=='transaksi_retur'){
                $this->db->order_by($this->order_lapretur[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }elseif ($tabel=='transaksi_penjualan') {
               $this->db->order_by($this->order_penjualan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }elseif ($tabel=='transaksi_data') {
               $this->db->order_by($this->order_data[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
            elseif ($tabel=='request') {
               $this->db->order_by($this->order_req[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
             elseif ($tabel=='upload') {
               $this->db->order_by($this->order_upload[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
            else{
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
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