<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

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
                $this->load->model(array('Master_model','Laporan_model'));
            }
    public function index(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==1 ){
        $this->cart->destroy();
        $data['view'] = 'Req/request';
        $data['js'] = base_url().'production/js/web/request.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
   
    }
     public function laporan(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $this->cart->destroy();
        $data['view'] = 'Req/laporan';
        $data['js'] = base_url().'production/js/web/lapreq.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
     public function barang(){
        $query  = $this->Master_model->runbarang();
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->id, 'name' => $value->nama,'kode' => $value->kode);
        }
        echo json_encode($data);
    }
    public function addbarang(){
            $data = array(
            'id'    => $this->input->post('id'),
            'qty'   => $this->input->post('jumlah'),
            'price'   => 0,
            'name'  => $this->input->post('barang'),
            'kode'  => $this->input->post('kode')
            );
            $this->cart->insert($data);
            echo json_encode(array('status' => true,
                            'data' => $this->cart->contents(),
                            'total_item' => $this->cart->total_items()
                        )
                );   
    }
    public function addreq(){
        $tabel='request';
        $noreq='req'.$this->session->userdata('NAMA').strtotime(date("Y-m-d H:i:s"));
        $carts =  $this->cart->contents();
        if ($carts) {
            foreach($carts as $key => $cart){
                $data = array(
                    'noreq' => $noreq,
                    'id_kpm'=>$this->session->userdata('ID'),
                    'id_barang' => $cart['id'],
                    'jumlah' => $cart['qty'],
                    'tgl'=>date("Y-m-d H:i:s"),
                    'status'=>'request'
                );
                $this->Master_model->tambah($data,$tabel);
                }
                echo json_encode(array('status'=>true));
        }else{

            echo json_encode(array('status'=>false,
                                'ket'=>'Harap masukan barang terlebih dahulu'));
        }
    $this->cart->destroy();
    }
    public function deletebarang($rowid){
        if($this->cart->remove($rowid)) {
            $data=array(
                'status'=>true,
                'jumlah'=>$this->cart->total_items()
                );
            echo json_encode($data);
        }else{
            $data=array('status'=>false);
            echo json_encode($data);
        }
    }
    public function runreq()
    {
            $tabel='request';
            $list = $this->Laporan_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->noreq;
                $row[] = $query->tgl;
                $row[] = $query->kpm;
                $row[] = $query->kode;
                $row[] = $query->nama;
                $row[] = $query->jumlah;
                if($query->status=='request'){
                     $row[] ='<span class="label label-warning">'.$query->status.'</span>';
                }else{
                     $row[] ='<span class="label label-success">'.$query->status.'</span>';
                }
                if($query->status=='request'){
                $row[] = '<a class="btn btn-primary" onclick="ok('."'".$query->id."'".','."'".$query->nama."'".')"  title="kirim"><i class="fa fa-truck"></i></a>';
                  }else{
                    $row[] ='';

                  }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Laporan_model->count_all($tabel),
                        "recordsFiltered" => $this->Laporan_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
     public function ok()
    {;
        $tabel='request';
        $data=array(
            'status'=>'dikirim',
            );
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array('status'=>true));
    }
   
}