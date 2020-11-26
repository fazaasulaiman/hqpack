<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

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
                $this->load->model(array('Stock_model','Master_model'));
            }
	public function index()
	{   
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
		$data['view'] = 'Stock/gudang';
		$data['js'] = base_url().'production/js/web/stock.js'; 
		$this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }

	}
    public function kpm(){
       if($this->session->userdata('LOGIN')=='TRUE'){
        $data['view'] = 'Stock/kpm';
        $data['js'] = base_url().'production/js/web/stockkpm.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        } 
    }
    public function korekg()
    {   
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Stock/koreksi';
        $data['js'] = base_url().'production/js/web/korek.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }

    }
     public function korekkpm()
    {   
        if($this->session->userdata('LOGIN')=='TRUE'){
        $data['view'] = 'Stock/koreksikpm';
        $data['js'] = base_url().'production/js/web/korekkpm.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }

    }
    public function sugestbarang(){
        $query  = $this->Stock_model->suggest();
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->id, 'name' => $value->nama.', '.$value->kode,'produksi'=>$value->produksi,'stok'=>$value->stok,'jual'=>$value->jual);
        }
        echo json_encode($data);
    }
	public function korekgudang(){
                    $tabel='korekgudang';
                    $id_barang=$this->input->post('id');
                    $nyata=$this->input->post('stoknyata');
                    if($nyata<=$this->input->post('stokkompi')){

                    //$cek=$this->Master_model->cekgudang($id_barang,$nyata);
                      //  if ($cek==1) {
                            $data = array(
                        'id_barang' => $this->input->post('id'),
                        'tgl' => date('Y-m-d'),
                        'stokkompi' =>  $this->input->post('stokkompi'),
                        'stoknyata' =>  $this->input->post('stoknyata'),
                        'selisih' =>  $this->input->post('selisih'),
                        'hargaselisih' =>  $this->input->post('hargaselisih'),
                        'alasan' =>  $this->input->post('alasan'),
                        'ket' =>  $this->input->post('ket'),
                        'produksi' =>  $this->input->post('produksi'),
                        );
                        $this->Master_model->tambah($data,$tabel);
                        echo json_encode(array("status" => TRUE));
                        exit();    
                        // }else{
                        //    echo json_encode(array("status" => false,'ket'=>'silahkan reload halaman ini terlebih dahulu'));exit();   }
                     
                }else{
                    echo json_encode(array("status" => false,'ket'=>'Stok nyata harus lebih kecil atau sama dengan stok yang ada komputer'));
                    exit();    
                }
					
            
	}
    public function koreksikpm(){
                    $tabel='korekkpm';
                     $id_barang=$this->input->post('id');
                    $nyata=$this->input->post('stoknyata');
                if($this->input->post('stoknyata')<=$this->input->post('stokkompi')){
                    //$cek=$this->Master_model->cekkpm($id,$nyata);
                     //   if ($cek==1) {
                            $data = array(
                            'id_barang' => $this->input->post('id'),
                            'id_kpm' => $this->session->userdata('ID'),
                            'tgl' => date('Y-m-d'),
                            'stokkompi' =>  $this->input->post('stokkompi'),
                            'stoknyata' =>  $this->input->post('stoknyata'),
                            'selisih' =>  $this->input->post('selisih'),
                            'hargaselisih' =>  $this->input->post('hargaselisih'),
                            'alasan' =>  $this->input->post('alasan'),
                            'ket' =>  $this->input->post('ket'),
                            'produksi' =>  $this->input->post('produksi'),
                            );
                            $this->Master_model->tambah($data,$tabel);
                            echo json_encode(array("status" => TRUE));
                            exit();
                        //}else{
                        //    echo json_encode(array("status" => false,'ket'=>'silahkan reload halaman ini terlebih dahulu'));

                        //} 
                }else{
                    echo json_encode(array("status" => false,'ket'=>'Stok nyata harus lebih kecil atau sama dengan stok yang ada komputer'));
                    exit();
                }
            
    }
    public function addgudang(){
                $tabel='add_gudang';
                    $data = array(
                    'id_barang' =>$this->input->post('id'),
                    'tgl' => date('Y-m-d'),
                    'jumlah' =>$this->input->post('jumlah')
                    );
                   
                    if($data['id_barang']){
                    $this->Master_model->tambah($data,$tabel);
                    echo json_encode(array("status" => TRUE));
                    exit();  
                    }else
                    {
                        echo json_encode(array('status'=>false,'ket'=>'Maaf Barang Tidak Tersedia'));
                    }
                   

    }
    
	public function runstock()
    {
            $tabel='barang';
            $list = $this->Stock_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->tgl;
                $row[] = $query->kode;
                $row[] = $query->nama;
                $row[] = $query->stok;
                $row[] = 'Rp'.number_format($query->produksi);
                $row[] = 'Rp'.number_format($query->jual);
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
    public function stokkpm()
    {
            $tabel='stock_cabang';
            $list = $this->Stock_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->kpm;
                $row[] = $query->kode;
                $row[] = $query->nama;
                $row[] = $query->stock;
                $row[] = 'Rp'.number_format($query->produksi);
                $row[] = 'Rp'.number_format($query->jual);
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
    public function runkorekg()
    {
            $tabel='korekgudang';
            $list = $this->Stock_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->tgl;
                $row[] = $query->kode;
                $row[] = $query->nama;
                $row[] = 'Rp'.number_format($query->produksi);
                $row[] = $query->stokkompi;
                $row[] = $query->stoknyata;
                $row[] = $query->selisih;
                $row[] = 'Rp'.number_format($query->hargaselisih);
                if($query->alasan=='Hilang'){
                $row[] ='<span class="label label-danger">'.$query->alasan.'</span>';
                }
                if($query->alasan=='Rusak'){
                $row[] ='<span class="label label-warning">'.$query->alasan.'</span>';
                }
                
                $row[] = $query->ket;
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
    public function runkorekkpm()
    {
            $tabel='korekkpm';
            $list = $this->Stock_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->tgl;
                $row[] = $query->kpm;
                $row[] = $query->kode;
                $row[] = $query->nama;
                $row[] = 'Rp'.number_format($query->produksi);
                $row[] = $query->stokkompi;
                $row[] = $query->stoknyata;
                $row[] = $query->selisih;
                $row[] = 'Rp'.number_format($query->hargaselisih);
                if($query->alasan=='Hilang'){
                $row[] ='<span class="label label-danger">'.$query->alasan.'</span>';
                }
                if($query->alasan=='Rusak'){
                $row[] ='<span class="label label-warning">'.$query->alasan.'</span>';
                }
                 if($query->alasan=='FOC'){
                $row[] ='<span class="label label-primary">'.$query->alasan.'</span>';
                }
                if($query->alasan=='Kembali Ke Pusat'){
                $row[] ='<span class="label label-success">'.$query->alasan.'</span>';
                }
                
                $row[] = $query->ket;
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
    

}
