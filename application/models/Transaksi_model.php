 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Transaksi_model extends CI_Model {
 	 
        	public function __construct() {
                parent::__construct();
                $this->load->database();
                
            }
            
           
            public function runbarang(){
               
                $id=$this->session->userdata('ID');
                $this->db->select('barang.*,stock_cabang.stock as stok');
                $this->db->from('barang');
                $this->db->join('stock_cabang', 'stock_cabang.id_barang= barang.id');
                $this->db->where('stock_cabang.id_kpm', $id);
                $this->db->where('stock_cabang.stock >0');
                return $query=$this->db->get()->result();
            }
            
            public function cek($id_barang,$jumlah){
                $id=$this->session->userdata('ID');
                $this->db->select('*');
                $this->db->from('stock_cabang');
                $this->db->where('stock_cabang.id_kpm', $id);
                $this->db->where('stock_cabang.id_barang', $id_barang);
                $this->db->where('stock_cabang.stock>=', $jumlah);
                $query=$this->db->get();
                if ($query->num_rows() > 0){
                    return 1;
                }else{
                    return 0;
                }
            }
            public function get($id){
                $nama=$this->session->userdata('NAMA');
                $this->db->select('transaksi_penjualan.*,transaksi_data.*,barang.nama,barang.kode');
                $this->db->from('transaksi_penjualan');
                $this->db->join('transaksi_data', 'transaksi_penjualan.id = transaksi_data.id_penjualan');
                $this->db->join('barang', 'barang.id = transaksi_data.id_barang');
                $this->db->where('transaksi_penjualan.id',$id);
                return $this->db->get()->result();
            }

	
}