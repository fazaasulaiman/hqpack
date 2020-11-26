<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
            {
                parent::__construct();
                $this->load->helper(array('url','file'));
                $this->load->model(array('Master_model','Transaksi_model','Stock_model'));
            }
    public function index(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==1 ){
        $this->cart->destroy();
        $data['view'] = 'Pos/transaksi';
        $data['js'] = base_url().'production/js/web/transaksi.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
    public function retur(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==1 ){
        $data['view'] = 'Pos/retur';
        $data['js'] = base_url().'production/js/web/retur.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
    public function runpenjualan(){
        $tabel='transaksi_penjualan';
            $list = $this->Stock_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->id;
                $row[] = $query->tot_item;
                $row[] = 'Rp'.number_format($query->tot_harga);
                $row[] = $query->tgl;
                $row[] = '<a class="btn btn-xs btn-warning" href="'.base_url().'Pos/getretur/'.$query->id.'" ><i class="fa fa-retweet"></i> Retur</a>';
                
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Stock_model->count_all($tabel),
                        "recordsFiltered" => $this->Stock_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function barang(){
        $query  = $this->Transaksi_model->runbarang();
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->id, 'name' => $value->nama.',Rp.'.$value->jual,'stok' => $value->stok,'jual' => $value->jual,'kode' => $value->kode,'barang' => $value->nama,'produksi' => $value->produksi);
        }
        echo json_encode($data);
    }
    public function addbarang(){
        $cek2=1;
        $id_barang = $this->input->post('id');
        $jumlah = $this->input->post('jumlah');
        $harga = $this->input->post('harga');
        $diskon = $this->input->post('diskon');
        $barang = $this->input->post('barang');
        $kode = $this->input->post('kode');
        $produksi = $this->input->post('produksi');
        $cart=$this->cart->contents();
        $cek=$this->Transaksi_model->cek($id_barang,$jumlah);
        foreach ($cart as $item) {
               if($item['id']=$id_barang){
                $jumlah2 = $item['qty'] + $jumlah;
                $cek2=$this->Transaksi_model->cek($id_barang,$jumlah2);
               }
        }
        if($cek==1 && $cek2==1){
                $data = array(
                'id'      => $id_barang,
                'qty'     => $jumlah,
                'price'   => $harga-$diskon,
                'name'    => $barang,
                'diskon'  => $diskon,
                'kode'  => $kode,
                'produksi'  => $produksi,
            );
            $this->cart->insert($data);
            echo json_encode(array('status' => true,
                            'data' => $this->cart->contents(),
                            'total_item' => $this->cart->total_items(),
                            'total_price' => $this->cart->total()
                        )
                );
        }else{
            echo json_encode(array('status' => false,
                            'ket' => "Jumlah barang yang anda minta tidak sesuai dengan stok yang tersedia"
                        )
                );
        }
            
        
    }
    public function deletebarang($rowid){
        if($this->cart->remove($rowid)) {
            $data=array(
                'status'=>true,
                'jumlah'=>$this->cart->total_items(),
                'harga'=>$this->cart->total()
                );
            echo json_encode($data);
        }else{
            $data=array(
                'status'=>false
                );
            echo json_encode($data);
        }
    }
    public function addtransaksi(){
        $tabel='transaksi_penjualan';
        $carts =  $this->cart->contents();
        if ($carts) {
            $atm=$this->input->post('atm');
        $vocher=$this->input->post('voucher');
        $tunai=($this->cart->total())-($vocher+$atm);
        $data=array(
        'id'=>"out".$this->session->userdata('NAMA').strtotime(date("Y-m-d H:i:s")),
        'tot_item'=>$this->cart->total_items(),
        'tunai'=>$tunai,
        'atm'=>$this->input->post('atm'),
        'vocher'=>$this->input->post('voucher'),
        'tot_harga'=>$this->cart->total(),
        'tgl'=>date("Y-m-d H:i:s"),
        'id_kpm'=>$this->session->userdata('ID'),
            );
        $this->Master_model->tambah($data,$tabel);
        $this->adddatatransaksi($data['id'],$carts);
        echo json_encode(array(
                                'status'=>true
                                ));
        }else{

            echo json_encode(array(
                                'status'=>false,
                                'ket'=>'Harap masukan barang yang ingin dibeli terlebih dahulu',
                                ));
        }
        

    }
    public function adddatatransaksi($id_penjualan,$carts){
        $tabel='transaksi_data';
        foreach($carts as $key => $cart){
            $purchase_data = array(
                'id_penjualan' => $id_penjualan,
                'id_kpm'=>$this->session->userdata('ID'),
                'id_barang' => $cart['id'],
                'jumlah' => $cart['qty'],
                'harga_item' => $cart['price'],
                'tot_harga' => $cart['subtotal'],
                'tgl'=>date("Y-m-d H:i:s"),
                'diskon'=>$cart['diskon'],
                'produksi'=>$cart['produksi']
            );
            $this->Master_model->tambah($purchase_data,$tabel);
    }
    $this->cart->destroy();
    }
    /* retur */
    
    public function getretur(){
        $this->cart->destroy();
        $id=$this->uri->segment(3);
        $details=$this->Transaksi_model->get($id);
        $cart_data = $this->_process_cart($details);
        $data['carts']=$cart_data;
        $data['id_retur']="rtr".$this->session->userdata('NAMA').strtotime(date("Y-m-d H:i:s"));
        $data['id_penjualan']=$id;
        $data['detail']=$details;
        $data['view'] = 'pos/returform';
        $data['js'] = base_url().'production/js/web/retur2.js'; 
        $this->load->view('index',$data);
    

    }
    public function update_jumlah(){
        $id=$this->uri->segment(3);
        $jumlah=$this->input->post('qty');
        $data = array(
            'rowid' => $id,
            'qty'   => $jumlah
        );
        $this->cart->update($data);
        echo json_encode(
            array(
                'status'=>true,
                'data' => $this->cart->contents(),
                'total' => $this->cart->total(),
                'jumlah'=>$this->cart->total_items()
            )
        );
    }
    function addretur(){
        $tabel='transaksi_retur';
        $carts =  $this->cart->contents();
        $id_penjualan=$this->input->post('id_penjualan');
        $data=array(
        'id'=>"rtr".$this->session->userdata('NAMA').strtotime(date("Y-m-d H:i:s")),
        'id_penjualan'=>$id_penjualan,
        'is_return' => 1,
        'tot_item'=>$this->cart->total_items(),
        'tot_harga'=>$this->cart->total(),
        'date'=>date("Y-m-d H:i:s"),
            );
        $this->Master_model->tambah($data,$tabel);
        $this->dataretur($data['id'],$id_penjualan,$carts);
        echo json_encode(array(
                                'status'=>true
                                ));
       }
    function dataretur($id_retur,$id_penjualan,$carts){
        $tabel='transaksi_dataretur';
        foreach($carts as $key => $cart){
            $purchase_data = array(
                'id_retur' => $id_retur,
                'id_penjualan'=>$id_penjualan,
                'id_kpm'=>$this->session->userdata('ID'),
                'id_barang' => $cart['id'],
                'jumlah' => $cart['qty'],
                'harga_item' => $cart['price'],
                'tot_harga' => $cart['subtotal'],
                'tgl'=>date("Y-m-d H:i:s"),
                'diskon'=>$cart['diskon'],
                'produksi'=>$cart['produksi']
            );
            $this->Master_model->tambah($purchase_data,$tabel);
    }
    $this->cart->destroy();
       }   
  
   
    private function _process_cart($details){
        
            foreach($details as $key => $item){
                $data = array(
                    'id'      => $item->id_barang,
                    'qty'     => $item->jumlah,
                    'price'   => $item->harga_item,
                    'diskon' => $item->diskon,
                    'name'    => $item->nama,
                    'kode'    =>$item->kode,
                    'produksi'  =>$item->produksi,
                );
                $this->cart->insert($data);
            }
        $response = array(
                'data' => $this->cart->contents() ,
                'total_item' => $this->cart->total_items(),
                'total_price' => $this->cart->total()
            );
        return $response;
    }
       /* retur */
}