<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Beranda_model extends CI_Model {
 	
        	public function __construct() {
                parent::__construct();
                $this->load->database();
            }
            
         function getkotor(){
            $id=$this->session->userdata('ID');
            $this->db->select('sum( a.kotor ) as totkotor');
            if ($this->session->userdata('LEVEL')==1) {
                 $this->db->from("(SELECT (transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher ) AS kotor FROM transaksi_penjualan
                JOIN transaksi_data ON transaksi_penjualan.id = transaksi_data.id_penjualan
                where transaksi_data.id_kpm=$id
                GROUP BY transaksi_penjualan.id) a");
            }else {
                $this->db->from("(SELECT (transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher ) AS kotor FROM transaksi_penjualan
                JOIN transaksi_data ON transaksi_penjualan.id = transaksi_data.id_penjualan
                GROUP BY transaksi_penjualan.id) a");
            }
           
            return $this->db->get()->row();
         }
         function terlaris(){

            $this->db->select('sum( a.kotor ) as kotor, a.kode');
            $this->db->from("(SELECT (transaksi_penjualan.tot_harga - sum( transaksi_data.diskon )) - ( sum( transaksi_data.jumlah * transaksi_data.produksi ) + transaksi_penjualan.vocher ) AS kotor, kpm.kode
                FROM transaksi_penjualan
                JOIN transaksi_data ON transaksi_penjualan.id = transaksi_data.id_penjualan
                JOIN kpm ON kpm.id = transaksi_penjualan.id_kpm
                GROUP BY transaksi_penjualan.id)a");
            $this->db->group_by('a.kode');
            $this->db->order_by('kotor', 'desc');
            $this->db->limit(1);
            return $this->db->get()->row();
         }   
         function singkat(){
            $id=$this->session->userdata('ID');
            $this->db->select("(SELECT count( kpm.id )FROM kpm WHERE level !=2) AS kpm,
             sum( hargaselisih ) AS korek");
            $this->db->from('korekkpm');
            if ($this->session->userdata('LEVEL')==1) {
                 $this->db->where('id_kpm', $id);
            }
           
            return $this->db->get()->row();
         }
         function chart(){
            $id=$this->session->userdata('ID');
            $this->db->select('count( transaksi_data.id_barang ) as jumlah, barang.nama');
            $this->db->from('transaksi_data');
            $this->db->join('barang', 'barang.id =  transaksi_data.id_barang');
            if ($this->session->userdata('LEVEL')==1) {
                $this->db->where('transaksi_data.id_kpm',$id);
            }
            $this->db->group_by('id_barang');
            $this->db->order_by('count( id_barang )', 'desc');
            $this->db->limit(5);
            return $this->db->get()->result();

         }
        

}