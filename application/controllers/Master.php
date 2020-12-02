<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
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
                $this->load->model(array('Master_model','User_model','Follow_model','Labarugi_model','Hpp_model','Invoice_model','Pricelistdistributor_model','Stockkirim_model'));
            }
    public function login()
    {
         
        $this->load->view('login');
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('Master/login');
    }
    public function masuk(){
                $this->User_model->login();
            }
    
    public function index()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Pengaturan/analitik';
        $data['js'] = base_url().'production/js/web/master.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
    public function kpm()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Pengaturan/kpm';
        $data['js'] = base_url().'production/js/web/master.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
    public function vbarang()
    {  
     if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){ 
        $data['view'] = 'Pengaturan/barang';
        $data['js'] = base_url().'production/js/web/masterbarang.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
    public function vsupplier()
    {   
        $data['view'] = 'Pengaturan/supplier';
        $data['js'] = base_url().'production/js/web/master.js'; 
        $this->load->view('index',$data);
    }
    public function anggota(){
                    $tabel='kpm';
                    $kode='kpm'.$this->input->post('kode');
                    $cek=$this->Master_model->cek($kode);
                    if($cek==0){
                    $data = array(
                    'kode' => 'kpm'.$this->input->post('kode'),
                    'kpm' => $this->input->post('kpm'),
                    'pass' => md5($this->input->post('pass')),
                    'level' => 1,
                    'alamat' =>  $this->input->post('alamat'),
                    );
                    $this->Master_model->tambah($data,$tabel);
                    echo json_encode(array("status" => TRUE));
                    exit(); 
                    }else{
                    echo json_encode(array("status" => false,'ket'=>'kode KPM tidak boleh sama'));
                            exit(); 
                    } 
            
    }
     public function checktable($table=null){
                 $data = $this->Master_model->checksum($table);

                 echo json_encode(array('status' => true, 'checksum' => $data[0]['Checksum'] ));
                  exit(); 
                 
       

    }
   
    public function barang(){
                    $tabel='barang';
                    $kode=$this->input->post('kode');
                    $nama=$this->input->post('nama');
                    $cek=$this->Master_model->cekbarang($kode,$nama);
                    if($cek==0){
                    $data = array(
                    'kode' =>  $this->input->post('kode'),
                    'nama' =>  $this->input->post('nama'),
                    'produksi' =>  $this->input->post('produksi'),
                    'jual' =>  $this->input->post('jual')
                    );
                     $id=$this->Master_model->tambah($data,$tabel);
                     $tabel2='gudang';
                     $data2 = array(
                                'id_barang' =>  $id
                                );
                      $this->Master_model->tambah($data2,$tabel2);
                    echo json_encode(array("status" => TRUE));
                                exit(); 

                    }else{
                    echo json_encode(array("status" => false,'ket'=>'kode barang atau nama barang tidak boleh sama'));
                                exit(); 

                    }
       

    }

    public function runbarang(){
                $data = $this->Master_model->runbarang();
                foreach($data as $barang){
                $barangs[] = $barang;  
                }
                echo json_encode($barangs);
    }
    public function sugestbarang(){
        $query  = $this->Master_model->runbarang();
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->id, 'name' => $value->nama.', '.$value->kode);
        }
        echo json_encode($data);
    }
    public function sugestkpm(){
        $query  = $this->Master_model->pkm();
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->id, 'name' => $value->kode);
        }
        echo json_encode($data);
    }
    
    public function runanggota()
    {
            $tabel='kpm';
            $list = $this->Master_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->kode;
                $row[] = $query->kpm;
                $row[] = $query->alamat;
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->kode."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function hpsanggota($id)
    {
                $tabel='kpm';
                $this->Master_model->hps($id,$tabel);
                echo json_encode(array("status" => TRUE));
        
    }
    public function getanggota($id)
    {
                $tabel='kpm';
                $data=$this->Master_model->get($id,$tabel);
                echo json_encode($data);
        
    }
     public function upanggota()
     {
                $tabel='kpm';
                    $data = array(
                    'kode' => $this->input->post('kode'),
                    'kpm' => $this->input->post('kpm'),
                    'pass' => md5($this->input->post('pass')),
                    'alamat' =>  $this->input->post('alamat'),
                    );
                $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
                echo json_encode(array("status" => TRUE));
                     exit(); 
       
    }
    public function runsupplier()
    {
        
            $list = $this->Master_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->barang;
                $row[] = $query->hp;
                $row[] = $query->alamat;
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all(),
                        "recordsFiltered" => $this->Master_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function hpssupplier($id)
    {
                $tabel='supplier';
                $this->Master_model->hps($id,$tabel);
                echo json_encode(array("status" => TRUE));
        
    }
    public function getsupplier($id)
    {
                $tabel='supplier';
                $data=$this->Master_model->get($id,$tabel);
                echo json_encode($data);
        
    }
     public function upsupplier()
     {
                    $tabel='supplier';
                    $data = array(
                    'nama' => $this->input->post('nama'),
                    'id_barang' => $this->input->post('id_barang'),
                    'alamat' =>  $this->input->post('alamat'),
                    'hp' =>  $this->input->post('hp')
                    );
                $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
                echo json_encode(array("status" => TRUE));
                     exit(); 
    }
    public function tampilbarang()
    {
            $tabel='barang';
            $list = $this->Master_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->kode;
                $row[] = $query->nama;
                $row[] = 'Rp'.number_format($query->produksi);
                $row[] = 'Rp'.number_format($query->jual);
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->kode."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function hpsbarang($id)
    {
                $tabel='barang';
                $this->Master_model->hps($id,$tabel);
                echo json_encode(array("status" => TRUE));
        
    }
    public function getbarang($id)
    {
                $tabel='barang';
                $data=$this->Master_model->get($id,$tabel);
                echo json_encode($data);
        
    }
     public function upbarang()
     {
                $tabel='barang';
                    $data = array(
                    'kode' =>  $this->input->post('kode'),
                    'nama' =>  $this->input->post('nama'),
                    'produksi' =>  $this->input->post('produksi'),
                    'jual' =>  $this->input->post('jual')
                    );
                $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
                echo json_encode(array("status" => TRUE));
                     exit(); 
       
    }
    // mulai dari sini punya mas haki package
    public function konsumen()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Pengaturan/konsumen';
        $data['js'] = base_url().'production/js/web/masterkonsumen.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
    public function addkonsumen(){
        $tabel='konsumen';
        
        $data = $this->input->post();
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
       
            
    }
    public function runkonsumen()
    {
            $tabel='konsumen';
            $list = $this->Master_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = '';
                $row[] = $no;
                $row[] = $query->konsumen;
                $row[] = $query->pemilik;
                $row[] = '+62'.$query->telp;
                $row[] = $query->email;
                $row[] = $query->instagram;
                $row[] = $query->facebook;
                $row[] = $query->alamat;
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->konsumen."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function getkonsumen($id)
    {
                $tabel='konsumen';
                $data=$this->Master_model->get($id,$tabel);
                echo json_encode($data);
        
    }
    public function upkonsumen()
     {
        $tabel='konsumen';
        $data = $this->input->post();
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
     public function hpskonsumen($id)
    {
        $tabel='konsumen';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }

    public function masterdata()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Pengaturan/masterdata';
        $data['js'] = base_url().'production/js/web/masterdata.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
    public function addmasterdata($tabel){
        $data = $this->input->post();  
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
       
            
    }
     public function runmasterdata($tabel)
    {
          
            $list = $this->Master_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = '<a href="#hapus" onclick="hapus('."'".$query->nama."'".','."'".$query->id."'".','."'".$tabel."'".')" title="habus"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>';
                $row[] = $no;
                $row[] = $query->nama;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
      public function hpsmasterdata($namatabel)
    {
        $item = explode(':', $namatabel);
     
        $tabel= $item[0];
        $id = $item[1];
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
    public function distributor()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Pengaturan/distributor';
        $data['js'] = base_url().'production/js/web/distributor.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
    public function sugestbarangjasa(){
        $param = $this->input->get('search');
        $query  = $this->Master_model->barangjasa($param);
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->nama, 'text' => $value->nama);
        }
        echo json_encode($data);
    }
    public function adddistributor(){
        $tabel='distributor';
        
        $data = $this->input->post();
       
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
           
    }
    public function rundistributor()
    {
            $tabel='distributor';
            $list = $this->Master_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = '';
                $row[] = $no;
                $row[] = $query->nama;
                $row[] = $query->pemilik;
                $row[] = $query->barangjasa;
                $row[] = '+62'.$query->telp;
                $row[] = $query->email;
                $row[] = $query->instagram;
                $row[] = $query->facebook;
                $row[] = $query->website;
                $row[] = $query->alamat;
                $row[] = $query->note;
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->nama."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function getdistributor($id)
    {
        $tabel='distributor';
        $data=$this->Master_model->get($id,$tabel);
        echo json_encode($data);
        
    }
     public function hpsdistributor($id)
    {
        $tabel='distributor';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
    public function updistributor()
     {
        $tabel='distributor';
        $data = $this->input->post();
        
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
     public function hargadistributor()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Pengaturan/hargadistributor';
        $data['js'] = base_url().'production/js/web/hargadistributor.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
    public function sugest($tabel){
        $param['query'] = $this->input->get('search');
        $param['tabel'] = $tabel;
        $query  = $this->Master_model->sugest($param);
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->nama, 'text' => $value->nama);
        }
        echo json_encode($data);
    }
    public function addhargadistributor(){
        $tabel='hargadistributor';
        $data = $this->input->post();
        $data['updated_on'] = date("Y-m-d", strtotime($data['updated_on']));
        $data['harga'] = str_replace(',','.',str_replace('.', '', $data['harga']));
        if (!empty($data['id_produk'])) {
          $data['id_produk'] = $data['id_produk'].$data['id_produk2'];  
        }
        unset($data["id_produk2"]);

        
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
           
    }
    public function runhargadistributor()
    {
            $tabel='hargadistributor';
            $list = $this->Master_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = '';
                $row[] = $no;
                $row[] = $query->distributor;
                $row[] = $query->barangjasa;
                $row[] = $query->warna;
                $row[] = $query->merk;
                $row[] = $query->size;
                $row[] = $query->ketebalan;
                $char = explode('.',$query->harga);
                if (!empty($char[1])) {
                    $row[] = number_format($query->harga,strlen($char[1]),',','.');
                }else{
                    $row[] = number_format($query->harga,0,'','.'); 
                }
                
                $row[] = $query->satuan;
                $row[] =  date("d M Y",  strtotime($query->created_on));
                $row[] =  date("d M Y",  strtotime($query->updated_on));
                $row[] = $query->id_produk;
                $row[] = $query->keterangan;
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->distributor."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function gethargadistributor($id)
    {
        $tabel='hargadistributor';
        $data=$this->Master_model->get($id,$tabel);
        $data->updated_on = date("d M Y",  strtotime($data->updated_on));
        echo json_encode($data);
        
    }
    public function uphargadistributor()
     {
        $tabel='hargadistributor';
        $data = $this->input->post();
        $data['warna'] = !empty($data['warna']) ? $data['warna'] : NULL;
        $data['merk'] = !empty($data['merk']) ? $data['merk'] : NULL;
        $data['size'] = !empty($data['size']) ? $data['size'] : NULL;
        $data['ketebalan'] = !empty($data['ketebalan']) ? $data['ketebalan'] : NULL;
        $data['satuan'] = !empty($data['satuan']) ? $data['satuan'] : NULL;
        $data['updated_on'] = date("Y-m-d", strtotime($data['updated_on']));
        $data['harga'] = str_replace(',','.',str_replace('.', '', $data['harga']));
    
        if (!empty($data['id_produk'])) {
           $arr = explode('-', $data['id_produk']);
           
          $data['id_produk'] =  $arr[0].$data['id_produk2'];  
        }
        unset($data["id_produk2"]);
      
   
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
     public function hpshargadistributor($id)
    {
        $tabel='hargadistributor';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
     public function followup($id = null)
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
       
        $data['view'] = 'Pengaturan/followup';
        $data['js'] = base_url().'production/js/web/followup.js'; 
        $data['laba_rugi'] = $this->Labarugi_model->getedit($id,'laba_rugi');
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
     public function sugestkonsumen(){
        $param = $this->input->get('search');
        $query  = $this->Master_model->sugestkonsumen($param);
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->id, 'text' => $value->konsumen);
        }
        echo json_encode($data);
    }
    public function sugestnota(){
        $param = $this->input->get('search');
        $query  = $this->Master_model->sugestnota($param);
        $data = array();
        foreach ($query as $key => $value) 
        {
            $data[] = array('id' => $value->nota, 'text' =>  $value->nota);
        }
        echo json_encode($data);
    }
     public function addfollowup(){
        $tabel='followup';
        $data = $this->input->post();

        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
           
    }
    public function runfollowup()
    {
            $tabel='followup';
            $list = $this->Follow_model->get_datatables($tabel);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
              
                $row[] = $no;
                $row[] = $query->konsumen;
                $row[] = $query->barang;
              /*  $row[] = date("d M Y",  strtotime($query->tgl_order));
                $row[] = date("d M Y",  strtotime($query->next_order));*/
                $row[] = date("Y-m-d",  strtotime($query->tgl_order));
                $row[] = date("Y-m-d",  strtotime($query->next_order));

                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->konsumen."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Follow_model->count_all($tabel),
                        "recordsFiltered" => $this->Follow_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function getfollowup($id)
    {
        $tabel='followup';
        $data=$this->Follow_model->get($id,$tabel);
        $data->next_order = date("Y-m-d",  strtotime($data->next_order));
        $data->tgl_order = date("Y-m-d",  strtotime($data->tgl_order));

        echo json_encode($data);
        
    }
    public function upfollowup()
     {
        $tabel='followup';
        $data = $this->input->post();
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
      public function hpsfollowup($id)
    {
        $tabel='followup';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
     public function beban()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Pengaturan/beban';
        $data['js'] = base_url().'production/js/web/beban.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
      public function addbeban(){
        $tabel='beban';
        $data = $this->input->post();
        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
        $data['harga'] =  str_replace('.', '', $data['harga']);
        $data['jumlah'] =  str_replace('.', '', $data['jumlah']);
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
           
    }
    public function runbeban()
    {
            $tabel='beban';
             $list = $this->Master_model->get_datatables($tabel);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
              
                $row[] = $no;
              
              /*  $row[] = date("d M Y",  strtotime($query->tgl_order));
                $row[] = date("d M Y",  strtotime($query->next_order));*/
                $row[] = date("d M Y",  strtotime($query->tanggal));
                $row[] = $query->keterangan;
                $row[] = $query->kategori;
                $row[] = $query->qty;
                $row[] = number_format($query->harga,0,'','.');
                $row[] = number_format($query->jumlah,0,'','.');
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->keterangan."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function getbeban($id)
    {
        $tabel='beban';
        $data=$this->Master_model->get($id,$tabel);
        $data->tanggal = date("d M Y",  strtotime($data->tanggal));

        echo json_encode($data);
        
    }
    public function upbeban()
     {
        $tabel='beban';
        $data = $this->input->post();
        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
        $data['harga'] =  str_replace('.', '', $data['harga']);
        $data['jumlah'] =  str_replace('.', '', $data['jumlah']);
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
      public function hpsbeban($id)
    {
        $tabel='beban';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
    public function detaillaporan()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Laporan/detaillaporan';
        $data['js'] = base_url().'production/js/web/detaillaporan.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }

    }
    public function addlabarugi(){
        $tabel='laba_rugi';
        $data = $this->input->post();
        $get = $this->Master_model->getnota($data['nota'],'invoice');
        
        $data['id_konsumen'] = $get->id_konsumen;
        
        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));

        $data['harga'] =  str_replace('.', '', $data['harga']);
        $data['penjualan'] =  str_replace('.', '', $data['penjualan']);
        $newtotal= $get->total+$data['penjualan'];
        $this->Master_model->update(array('id' => $get->id), array('total' => $newtotal),'invoice');
       

        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
           
    }
    public function runlabarugi()
    {
            $tabel='laba_rugi';
             $list = $this->Labarugi_model->get_datatables($tabel);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
               
                $row[] = $no;
              
                $row[] = date("d M Y",  strtotime($query->tanggal));
                $row[] = $query->nota;
                $row[] = $query->konsumen;
                $row[] = $query->barang;
                $char1 = explode('.', $query->hpp);
                 if (!empty($char1[1]) && $char1[1] != '00' ) {
                    $row[] = number_format($query->hpp,strlen($char1[1]),',','.');
                    $total = $query->penjualan - $query->hpp;
                     $tempkotor = number_format($total,2,',','.');
                   /* $tempkotor =  number_format($query->penjualan - $query->hpp,strlen($char1[1]),',','.');*/
                }else{
                    $row[] = number_format($query->hpp,0,'','.'); 
                     $total = $query->penjualan - $query->hpp;
                    $tempkotor =  number_format($total,2,',','.');
                }

                if (!empty($char1[1]) && $char1[1] != '00' ) {
                    $kotor =  number_format($query->laba_kotor,2,',','.');
                }else{
                    $kotor =  number_format($query->laba_kotor,0,'','.');
                 
                }


                

                $row[] = number_format($query->qty,0,'','.');
                 $harga = explode('.', $query->harga);
                 if (!empty($harga[1]) && $harga[1] != '00' ) {
                    $row[] = number_format($query->harga,strlen($harga[1]),',','.');
                  
                }else{
                    $row[] = number_format($query->harga,0,'','.'); 
                }
               /* $row[] = number_format($query->harga,0,'','.');
                $row[] = number_format($query->penjualan,0,'','.');*/
                
                 $penjualan = explode('.', $query->penjualan);
                 if (!empty($penjualan[1]) && $penjualan[1] != '00' ) {
                    $row[] = number_format($query->penjualan,strlen($penjualan[1]),',','.');
                  
                }else{
                    $row[] = number_format($query->penjualan,0,'','.'); 
                }
                $row[] = $query->status != 'Edit'? $kotor : $tempkotor;
                $row[] = $query->status =='Edit' ? '<a href="#" onclick="fix('."'".$query->id."'".','."'".$query->nota."'".')"><span class="label label-warning">Edit</span></a>' : '<span class="label label-success">Fix</span>' ;
                $status = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right">';
                if ($query->status == 'Edit') {
                    $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hpp('."'".$query->id."'".','."'".$query->nota."'".')" title="HPP"><i class="fa fa-cart-plus"></i> HPP</a></li><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li>';
                }
                if ($query->status == 'Fix') {
                    $status .= '</li><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="history('."'".$query->id."'".','."'".$query->nota."'".')"  title="History"><i class="fa fa-history "></i> History</a></li>';
                }
                $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="copy('."'".$query->id."'".','."'".$query->nota."'".')" title="Copy"><i class="fa fa-copy"></i> Copy</a></li>';
                $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->nota."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>';
                $row[] = $query->progress;
                $row[] = $status;
               
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Labarugi_model->count_all($tabel),
                        "recordsFiltered" => $this->Labarugi_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function getlabarugi($id)
    {
        $tabel='laba_rugi';
        $data=$this->Labarugi_model->getedit($id,$tabel);
        $data->tanggal = date("d M Y",  strtotime($data->tanggal));

        echo json_encode($data);
        
    }
    public function hpp($nota)
    { 
    $this->load->library('user_agent');  
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            if ($this->agent->referrer()== base_url().'Master/detaillaporan' && !empty($nota)) {
                $data['view'] = 'Laporan/hpp';
                $data['js'] = base_url().'production/js/web/hpp.js'; 
                $this->load->view('index',$data);
            }
        
        }else{
            redirect($this->agent->referrer(),'refresh');
        }

    }
    public function historyhpp($id_labarugi)
    { 
    $this->load->library('user_agent');  
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            if ($this->agent->referrer()== base_url().'Master/detaillaporan' && !empty($id_labarugi)) {
                $data['view'] = 'Laporan/historyhpp';
                $data['js'] = base_url().'production/js/web/hpp.js'; 
                $this->load->view('index',$data);
            }
        
        }else{
            redirect($this->agent->referrer(),'refresh');
        }

    }
     public function uplabarugi()
     {
        $tabel='laba_rugi';
        $data = $this->input->post();

        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));

        $data['harga'] =   str_replace('.', '', $data['harga']);
        $data['penjualan'] =   str_replace('.', '', $data['penjualan']);

        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
     public function fixlabarugi($id)
     {
        $tabel='laba_rugi';
       // $data = $this->input->post();
   
        $data=$this->Labarugi_model->getedit($id,$tabel);
        $laba_kotor = $data->penjualan - $data->hpp;
        $arr = array('laba_kotor' => $laba_kotor, 'status' => 'Fix');
        
        $this->Master_model->update(array('id' => $id), $arr,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
     public function hpslabarugi($id)
    {
        $tabel='laba_rugi';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }

    public function runhpp($id_labarugi)
    {       
            $tabel='hpp';
             $list = $this->Hpp_model->get_datatables($tabel,$id_labarugi);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
              
                $row[] = $no;
                $row[] = date("d M Y",  strtotime($query->tanggal));
                $row[] = $query->distributor;
                $row[] = $query->barang;
                $row[] = $query->qty;
                $char1 = explode('.', $query->harga);
             
             if (!empty($char1[1]) && $char1[1] != '00') {
                    $row[] = number_format($query->harga,strlen($char1[1]),',','.');
                }else{
                    $row[] = number_format($query->harga,0,'','.'); 
                }
                $char2 = explode('.', $query->harga);
             if (!empty($char2[1]) && $char2[1] != '00') {
                    $row[] = number_format($query->jumlah,strlen($char2[1]),',','.');
                }else{
                    $row[] = number_format($query->jumlah,0,'','.'); 
                }
               /* $row[] = number_format($query->harga,0,'','.');
                $row[] = number_format($query->jumlah,0,'','.');*/
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$no."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }

    public function sugesthargadistributor($param){
                
        $search = $this->input->get('search');
        $query  = $this->Master_model->sugesthargadistributor(str_replace("-"," ",$param),$search);
        $data = array();
        foreach ($query as $key => $value) 
        {
            $warna = !empty($value->warna)? ' '.$value->warna :'';
            $merk = !empty($value->merk)? ' '.$value->merk :'';
            $size = !empty($value->size)? ' '.$value->size :'';
            $ketebalan = !empty($value->ketebalan)? ' '.$value->ketebalan :'';
            $char = explode('.', $value->harga);
             if (!empty($char[1])) {
                    $harga = ' Rp'.number_format($value->harga,strlen($char[1]),',','.');
                }else{
                    $harga = ' Rp'.number_format($value->harga,0,'','.'); 
                }

            $data[] = array('id' => $value->barangjasa.$warna.$merk.$size.$ketebalan, 'text' => $value->barangjasa.$warna.$merk.$size.$ketebalan.$harga);
        }
        echo json_encode($data);
    }
    public function sugesthargadistributor2($param){
                
        $search = $this->input->get('search');
        $query  = $this->Master_model->sugesthargadistributor(str_replace("-"," ",$param),$search);
        $data = array();
        foreach ($query as $key => $value) 
        {
            $warna = !empty($value->warna)? ' '.$value->warna :'';
            $merk = !empty($value->merk)? ' '.$value->merk :'';
            $size = !empty($value->size)? ' '.$value->size :'';
            $ketebalan = !empty($value->ketebalan)? ' '.$value->ketebalan :'';
            $char = explode('.', $value->harga);
             if (!empty($char[1])) {
                    $harga = ' Rp'.number_format($value->harga,strlen($char[1]),',','.');
                }else{
                    $harga = ' Rp'.number_format($value->harga,0,'','.'); 
                }

            $data[] = array('id' => $value->id, 'text' => $value->barangjasa.$warna.$merk.$size.$ketebalan.$harga);
        }
        echo json_encode($data);
    }
     public function addhpp(){
        $tabel='hpp';
        $data = $this->input->post();
        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
        $data['harga'] = str_replace(',','.',str_replace('.', '', $data['harga']));
        $data['jumlah'] =  str_replace(',','.',str_replace('.', '', $data['jumlah']));
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
           
    }
      public function hpshpp($id)
    {
        $tabel='hpp';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
     public function gethpp($id)
    {
        $tabel='hpp';
        $data=$this->Master_model->get($id,$tabel);
        $data->tanggal = date("d M Y",  strtotime($data->tanggal));
        echo json_encode($data);
        
    }
      public function uphpp()
     {
        $tabel='hpp';
        $data['barang_manual'] = NULL;
        $data = $this->input->post();
         $data['harga'] = str_replace(',','.',str_replace('.', '', $data['harga']));
        $data['jumlah'] =  str_replace(',','.',str_replace('.', '', $data['jumlah']));
        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
    public function laporan(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Laporan/laporan';
        $data['js'] = base_url().'production/js/web/laporan.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }
    }
    public function geteachbeban(){

        $data = $this->Labarugi_model->eachbeban();
        var_dump($data);
    }
    public function getLaporan(){

        $data = $this->input->post();
        $data['tgl1'] = date("Y-m-d",  strtotime($data['tgl1']));
        $data['tgl2'] = date("Y-m-d",  strtotime($data['tgl2']));
        //penjualan
        $val = $this->Labarugi_model->penjualan($data);
       
        $char1 = explode('.', $val->penjualan);
         if (!empty($char1[1]) && $char1[1] != '00') {
            $temppenjualan = number_format($val->penjualan,strlen($char1[1]),',','.');
        }else{
            $temppenjualan = number_format($val->penjualan,0,'','.'); 
        }
        $char2 = explode('.', $val->kotor);
         if (!empty($char2[1]) && $char2[1] != '00') {
            $tempkotor = number_format($val->kotor,strlen($char2[1]),',','.');
        }else{
            $tempkotor = number_format($val->kotor,0,'','.'); 
        }
        $char3 = explode('.', $val->hpp);
         if (!empty($char3[1]) && $char3[1] != '00') {
            $temphpp = number_format($val->hpp,strlen($char3[1]),',','.');
        }else{
            $temphpp = number_format($val->hpp,0,'','.'); 
        }
        is_null($val->penjualan) ? $penjualan = 0 :  $penjualan = $temppenjualan;
        is_null($val->kotor) ? $kotor = 0 :  $kotor = $tempkotor;
        is_null($val->hpp) ? $hpp = 0 :  $hpp = $temphpp;
        //ketegori
        $isi = $this->Labarugi_model->textbeban($data);
        $report =  array();
        foreach ($isi as $val) {
           /* $char1 = explode('.', $val->jumlah);
            if (!empty($char1[1]) && $char1[1] != '00') {
                    $jumlah = number_format($val->jumlah,strlen($char1[1]),',','.');
            }else{
                    $jumlah = number_format($val->jumlah,0,'','.'); 
            }*/
            $report[$val->kategori][] = ['text' => $val->keterangan, 'jumlah' => $val->jumlah];
            
            
        }
         $report['penjualan'] = $penjualan;
         $report['kotor'] = $kotor;
         $report['hpp'] = $hpp;
      
        echo json_encode(array("status" => TRUE,'report' => $report));
        exit(); 
    }
     public function chart(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Laporan/chart';
        $data['js'] = base_url().'production/js/web/chart.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        }
    }
     public function chartMonth(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data = $this->input->post();
        $data['month1'] = date("Y-m",  strtotime($data['month1']));
        $data['month2'] = date("Y-m",  strtotime($data['month2']));
        $val1 = $this->Labarugi_model->chartMonth($data['month1'],'bulan');
        $val2 = $this->Labarugi_model->chartMonth($data['month2'],'bulan');
        $beban1 = $this->Labarugi_model->chartBeban($data['month1'],'bulan');
        $beban2 = $this->Labarugi_model->chartBeban($data['month2'],'bulan');
        is_null($val1->penjualan) ? $penjualan1 = 0 :  $penjualan1 = $val1->penjualan;
        is_null($val1->kotor) ? $kotor1 = 0 :  $kotor1 = $val1->kotor;
        is_null($beban1->pengeluaran) ? $pengeluaran1 = 0 :  $pengeluaran1 = $beban1->pengeluaran;
        is_null($val2->penjualan) ? $penjualan2 = 0 :  $penjualan2 = $val2->penjualan;
        is_null($val2->kotor) ? $kotor2 = 0 :  $kotor2 = $val2->kotor;
        is_null($beban2->pengeluaran) ? $pengeluaran2 = 0 :  $pengeluaran2 = $beban2->pengeluaran;
        $chart = array();
        $chart['month1'] = array('penjualan' => $penjualan1,'kotor' => $kotor1,'bersih' => $kotor1 - $pengeluaran1 );
        $chart['month2'] = array('penjualan' => $penjualan2,'kotor' => $kotor2,'bersih' => $kotor2 - $pengeluaran2 );
        echo json_encode(array("status" => TRUE,'chart' => $chart));
        }
    }
    public function chartYear(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data = $this->input->post();
       /* var_dump($data);
        $data['year1'] = date("Y-01",  strtotime($data['year1']));
        $data['year2'] = date("Y-01",  strtotime($data['year2']));*/
        
        $val1 = $this->Labarugi_model->chartmonth($data['year1'].'-01');
        $val2 = $this->Labarugi_model->chartmonth($data['year2'].'-01');
        
        $beban1 = $this->Labarugi_model->chartBeban($data['year1'].'-01');
        $beban2 = $this->Labarugi_model->chartBeban($data['year2'].'-01');
        is_null($val1->penjualan) ? $penjualan1 = 0 :  $penjualan1 = $val1->penjualan;
        is_null($val1->kotor) ? $kotor1 = 0 :  $kotor1 = $val1->kotor;
        is_null($beban1->pengeluaran) ? $pengeluaran1 = 0 :  $pengeluaran1 = $beban1->pengeluaran;
        is_null($val2->penjualan) ? $penjualan2 = 0 :  $penjualan2 = $val2->penjualan;
        is_null($val2->kotor) ? $kotor2 = 0 :  $kotor2 = $val2->kotor;
        is_null($beban2->pengeluaran) ? $pengeluaran2 = 0 :  $pengeluaran2 = $beban2->pengeluaran;
        $chart = array();
        $chart['year1'] = array('penjualan' => $penjualan1,'kotor' => $kotor1,'bersih' => $kotor1 - $pengeluaran1 );
        $chart['year2'] = array('penjualan' => $penjualan2,'kotor' => $kotor2,'bersih' => $kotor2 - $pengeluaran2 );
        echo json_encode(array("status" => TRUE,'chart' => $chart));
        }
    }
    public function ranking(){

        $penjualan = $this->Labarugi_model->rankPenjualan();
        $aktivitas = $this->Labarugi_model->rankAktivitas();
        $labakotor = $this->Labarugi_model->rankLaba();
        $rank = array();
        
        foreach ($penjualan as $val) {
             $char1 = explode('.', $val->penjualan);
             
             if (!empty($char1[1]) && $char1[1] != '00') {
                $val->penjualan = number_format($val->penjualan,strlen($char1[1]),',','.');
            }else{
                $val->penjualan = number_format($val->penjualan,0,'','.'); 
            }

            $rank['penjualan'][] = array('konsumen' => $val->konsumen, 'penjualan' => $val->penjualan );
            
        }
         foreach ($labakotor as $val) {
             $char1 = explode('.', $val->laba);
             
             if (!empty($char1[1]) && $char1[1] != '00') {
                $val->laba = number_format($val->laba,strlen($char1[1]),',','.');
            }else{
                $val->laba = number_format($val->laba,0,'','.'); 
            }

            $rank['laba'][] = array('konsumen' => $val->konsumen, 'kotor' => $val->laba);
            
        }
        $rank['aktivitas'] = $aktivitas;
       
        echo json_encode(array("status" => TRUE,'rank' => $rank));
    }
    public function invoice(){
       if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Laporan/invoice';
        $data['js'] = base_url().'production/js/web/invoice.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        } 
    }
    public function addinvoice(){
        try { 
         $tabel='invoice';
                
                $data = $this->input->post();
                $param['query'] = $data['status'];
                $param['tabel'] = 'status_invoice';
                $status = $this->Master_model->sugest($param);
                if (empty($status)) {
                    $this->Master_model->tambah(array('nama' => $param['query']),$param['tabel']);
                }
        
                $trx = $data['trx'];
                unset($data['trx'],$data['harga'],$data['qty'],$data['barang']);
                $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
                $data['total'] = str_replace(',','.',$data['total']);
              
                
                if (!empty($data['tanggal_payment'])) {
                    $data['tanggal_payment'] =  date("Y-m-d", strtotime($data['tanggal_payment']));
                }
                $this->Master_model->tambah($data,$tabel);
                foreach ($trx as $item) {
                    $items['tanggal'] = $data['tanggal'];
                    $items['nota'] = $data['nota'];
                    $items['id_konsumen'] = $data['id_konsumen'];
                    $items['barang'] = $item['barang'];
                    $items['qty'] = $item['qty'];
                    $items['harga'] =str_replace(',','.', $item['harga']);
                    $items['penjualan'] = str_replace(',','.', $item['penjualan']);
                    $this->Master_model->tambah($items,'laba_rugi');
                }
                
                echo json_encode(array("status" => TRUE));
                exit(); 
        } catch (Exception $e) {
          //alert the user.
          var_dump($e->getMessage());
          var_dump($e->getLine());
          exit();
        }
        
       
            
    }
    public function runinvoice()
    {
            $tabel='invoice';
             $list = $this->Invoice_model->get_datatables($tabel);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
               
                $row[] = $no;
              
                $row[] = date("d M Y",  strtotime($query->tanggal));
                $row[] = $query->nota;
                $row[] = $query->konsumen;

                $char2 = explode('.', $query->total);
             if (!empty($char2[1]) && $char2[1] != '00') {
                    $row[] = number_format($query->total,strlen($char2[1]),',','.');
                }else{
                    $row[] = number_format($query->total,0,'','.'); 
                }
 
                $row[] = $query->status;
                $row[] =  !empty($query->tanggal_payment) ? date("d M Y",  strtotime($query->tanggal_payment)) : NULL;
                $row[] =  !empty($query->tanggal_deadline) ? date("d M Y",  strtotime($query->tanggal_deadline)) : NULL;
                $row[] =  $query->catatan;
                $status = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right">';
                $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="ubahstatus('."'".$query->id."'".')" title="Copy"><i class="fa fa-pencil-square"></i> Ubah Status</a></li>';
                 $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="transaksiinvoice('."'".$query->nota."'".')" title="Copy"><i class="fa fa-calculator"></i> Billing</a></li>';
                //$status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="detail('."'".$query->id."'".','."'".$query->nota."'".')" title="Copy"><i class="fa fa-info"></i> Detail</a></li>';
                $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="print('."'".$query->id."'".','."'".$query->nota."'".','."'pdf'".')" title="print"><i class="fa fa-print""></i> Print</a></li>';
                $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="print('."'".$query->id."'".','."'".$query->nota."'".','."'image'".')" title="image"><i class="fa fa-picture-o""></i> Gambar</a></li>';
                $status .= '<li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hpsinvoice('."'".$query->id."'".','."'".$query->nota."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>';
                $row[] = $status;
               
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Invoice_model->count_all($tabel),
                        "recordsFiltered" => $this->Invoice_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
     public function hpsinvoice($id)
    {
        $tabel='invoice';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
     public function getstatuspayment($id)
    {
        $tabel='invoice';
        $data = $this->Master_model->get($id,$tabel);
        echo json_encode($data);

        
    }
    public function upinvoice()
     {
        $tabel='invoice';
        $data = $this->input->post();
        if (!empty($data['tanggal'])) {
           $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
        }
        
        $param['query'] = $data['status'];
        $param['tabel'] = 'status_invoice';
        $status = $this->Master_model->sugest($param);
        if (empty($status)) {
            $this->Master_model->tambah(array('nama' => $data['status']),$param['tabel']);
        }
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
    public function transaksiinvoice($nota)
    { 
    $this->load->library('user_agent');  
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            if ($this->agent->referrer()== base_url().'Master/invoice' && !empty($nota)) {
                $data['view'] = 'Laporan/transaksiinvoice';
                $data['js'] = base_url().'production/js/web/transaksiinvoice.js'; 
                $this->load->view('index',$data);
            }
        
        }else{
            redirect($this->agent->referrer(),'refresh');
        }

    }
    public function historytransaksiinvoice($nota)
    { 
    $this->load->library('user_agent');  
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            if ($this->agent->referrer()== base_url().'Master/invoice' && !empty($nota)) {
                $data['view'] = 'Laporan/historytransaksiinvoice';
                $data['js'] = base_url().'production/js/web/transaksiinvoice.js'; 
                $this->load->view('index',$data);
            }
        
        }else{
            redirect($this->agent->referrer(),'refresh');
        }

    }
    public function runtransaksiinvoice($nota)
    {       
            $tabel='transaksiinvoice';
             $list = $this->Master_model->get_datatables($tabel,$nota);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
              
                $row[] = $no;
                $row[] = date("d M Y",  strtotime($query->tanggal));
                $row[] = $query->keterangan;
                $char1 = explode('.', $query->kredit);
                if (!empty($char1[1]) && $char1[1] != '00') {
                    $row[] = number_format($query->kredit,strlen($char1[1]),',','.');
                }else{
                    $row[] = number_format($query->kredit,0,'','.'); 
                }
                $row[] = $query->catatan;
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$no."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    public function addtransaksiinvoice(){
        $tabel='transaksiinvoice';
        $data = $this->input->post();
        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
        $data['kredit'] = str_replace(',','.',str_replace('.', '', $data['kredit']));
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
           
    }
      public function hpstransaksiinvoice($id)
    {
        $tabel='transaksiinvoice';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
     public function gettransaksiinvoice($id)
    {
        $tabel='transaksiinvoice';
        $data=$this->Master_model->get($id,$tabel);
        $data->tanggal = date("d M Y",  strtotime($data->tanggal));
        echo json_encode($data);
        
    }
      public function uptransaksiinvoice()
     {
        $tabel='transaksiinvoice';
        $data = $this->input->post();
        $data['kredit'] = str_replace(',','.',str_replace('.', '', $data['kredit']));
        $data['tanggal'] =  date("Y-m-d", strtotime($data['tanggal']));
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
    public function printinvoice($nota){

        
        $konsumen = $this->Invoice_model->konsumeninvoice($nota);
        $transaksi = $this->Invoice_model->transaksi($nota);
        $item = $this->Invoice_model->item($nota);

        $data = $konsumen;
         $data['item'] = $item;
        
       
         $totalkredit = 0;
         $i =0;
         foreach ($transaksi as $item) {
             $totalkredit = $totalkredit+$item['kredit'];
            
             $transaksi[$i]['tanggal']= date("d-m-Y", strtotime($item['tanggal']));
             $i++;

         }
         $data[0]['totalkredit'] = 'Rp'.number_format($totalkredit,2,',','.');
         $data[0]['kurangbayar'] = 'Rp'.number_format($data[0]['total']-$totalkredit,2,',','.');
         $data[0]['total'] =  'Rp'.number_format($data[0]['total'],2,',','.');

         $data[0]['tanggal'] =date("d-m-Y", strtotime($data[0]['tanggal']));
         $data['transaksi'] = $transaksi;
      
        echo json_encode(array("status" => TRUE,'data'=>$data));
        

    }
    function decimalindo($char2){
           $char = explode('.', $char2);
        if (!empty($char[1]) && $char[1] != '00') {
                $number = number_format($char2,strlen($char[1]),',','.');
            }else{
                $number = number_format($char2,0,'','.'); 
            }
        return $number;
    }
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
     public function pricelist(){
       if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Laporan/pricelist';
        $data['js'] = base_url().'production/js/web/pricelist.js'; 
        $this->load->view('index',$data);
         }else{
            redirect('Beranda','refresh');
        } 
    }
    public function runpricelist()
    {       
            $tabel='price_list';
             $list = $this->Master_model->get_datatables($tabel);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
              
                $row[] = $no;
                $row[] = $query->produk_konsumen;
                $row[] = $query->nama_produk;
                $row[] = $query->size;
                
                $row[] = $query->warna;
                $row[] = $query->bahan;
                $row[] = $query->ketebalan;
                $row[] = $query->finishing;
                $row[] = $query->prioritas;
                $row[] = $query->konsumen;
                $row[] = $query->note_konsumen;
                $row[] = $query->note;
               
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right">
                <li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="perhitungan('."'".$query->produk_konsumen."'".','."'".$query->nama_produk."'".','."'".$query->warna."'".','."'".$query->id."'".')" title="perhitungan"><i class="fa fa-percent" aria-hidden="true"></i> hitung</a></li><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="copyboard('."'".$query->id."'".')"  data-toggle="modal" title="copyboard"><i class="fa fa-clipboard "></i> Copyboard</a></li><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$no."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
     public function addpricelist(){
        $tabel='price_list';
        $data = $this->input->post();
        $data['konsumen'] = implode(';', $data['konsumen']);

        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
    }
     public function getpricelist($id)
    {
        $tabel='price_list';
        $data=$this->Master_model->get($id,$tabel);
        $data->konsumen = explode(';', $data->konsumen);
      
        echo json_encode($data);
        
    }
     public function upricelist()
     {
        $tabel='price_list';
        $data = $this->input->post();
        $data['konsumen'] = implode(';', $data['konsumen']);

        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
     public function getplcopyboard($id)
    {
        
        $tabel='price_list';
        $data=$this->Master_model->get($id,$tabel);

        if (empty($data->finishing)) {
           $data->finishing = '';
        }
         if (empty($data->note_konsumen)) {
           $data->note_konsumen = '';
        }
        $text = $data->nama_produk.', size '.$data->size.', desain: '.$data->warna.', '.$data->bahan.' '.$data->ketebalan.', '.$data->finishing."\n\n";
        $list = $this->Master_model->pricelistorder($tabel,array('column' => 'id_pricelist','value' => $id ));
        

        foreach ($list as $query) {
                $subtotal = $this->Master_model->hitungpl('hitung',array('column' => 'id_plorder','value' => $query->id ));
               
                 if (!empty($subtotal) && !is_null($subtotal->subtotal)) {
                    $totalmargin =  $subtotal->subtotal*$query->margin;
                    $total =  $totalmargin + $subtotal->subtotal;   
                    $text .=  'jumlah '.$query->jumlah_order.', harga @ '.$this->decimalindo(ceil($total/$query->jumlah_order))."\n";    

                }
               
            }

        if (!empty($data->note_konsumen)) {
            $text .= "\nNote: ".$data->note_konsumen;
        }
        

        echo json_encode($text);
        
    }
    public function pricelistorder($param){
        $this->load->library('user_agent');  
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            if ($this->agent->referrer()== base_url().'Master/pricelist' && !empty($param)) {
                $data['view'] = 'Laporan/hitungpricelist';
                $data['js'] = base_url().'production/js/web/hitungpricelist.js'; 
                $this->load->view('index',$data);
            }
        
        }else{
            redirect($this->agent->referrer(),'refresh');
        }

    }
    public function addpricelistorder(){
        $tabel='pricelist_order';
        $data = $this->input->post();
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
    }
      public function hpspricelist($id)
    {
        $tabel='price_list';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
     public function runpricelistorder($id)
    {       
            $tabel='pricelist_order';
            $list = $this->Master_model->pricelistorder($tabel,array('column' => 'id_pricelist','value' => $id ));
            $data = array();
            $no =1;
            foreach ($list as $query) {
               
                $row = array();
                $row[] = $no;
                $row[] = $query->size_kertas;
                $row[] = $query->jumlah_order;
                $row[] = $query->insheet;
                $row[] = $query->plano;
                $row[] = $query->margin;
                $subtotal = $this->Master_model->hitungpl('hitung',array('column' => 'id_plorder','value' => $query->id));
               
                if (is_null($subtotal->subtotal)) {
                    
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                }else{

                
               
                    $row[] = $this->decimalindo($subtotal->subtotal);
                    $totalmargin =  $subtotal->subtotal*$query->margin;
                    $row[] = $this->decimalindo($totalmargin);
                    $total =  $totalmargin + $subtotal->subtotal;
                    $row[] = $this->decimalindo($total);
                    $row[] =  $this->decimalindo(ceil($total/$query->jumlah_order));
                }


               $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="detail('."'".$query->id."'".')" title="Detail"><i class="fa fa-info"></i> Detail</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="distributor('."'".$no."'".','."'".$query->id."'".')" title="distributor"><i class="fa fa-truck" aria-hidden="true"></i> Distributor</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
               

            $no++;
            $data[] = $row;
        }
            
                $output = array(
                        "data" => $data
                );
              echo json_encode($output);
        
    }
    public function detailhitungpl($id){
     
        $tabel='pricelist_order';
        $header = $this->Master_model->pldetail($tabel,array('column' => 'pricelist_order.id','value' => $id ));
        $list = $this->Master_model->hitungpl('tampil',array('column' => 'id_plorder','value' => $id ));
       
        $result = [];
        $subtotal =0;
        foreach($list as $key=>$value){
            $total =$value['harga'] * $value['jumlah'] ;
            $group = $value['jenis'];
            $subtotal = $total+$subtotal;
            if(!isset($result[$group])) $result[$group ] = [];
            $value['panel'] = 'panel-default';
            $value['total'] = $this->decimalindo($total);
            $result[$group][] = $value;
        }
        $margin = floatval($header[0]->margin);
         $totalmargin = $subtotal *$margin;
         $total = $totalmargin+$subtotal;
         
         $footer = array('margin' => $margin,'subtotal'=>$this->decimalindo($subtotal),'totalmargin'=>$this->decimalindo($totalmargin ),'total'=>$this->decimalindo($total),'satuan' =>$this->decimalindo(ceil($total/$header[0]->jumlah_order)));

         $data = array('header' => $header,'body' =>$result,'footer' =>$footer );
         
         echo json_encode($data);
    }
    public function getplorder($id)
    {
        $tabel='pricelist_order';
        $data=$this->Master_model->get($id,$tabel);
      
        echo json_encode($data);
        
    }
       public function upplorder()
     {
        $tabel='pricelist_order';
        $data = $this->input->post();
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
    public function hpsplorder($id)
    {
        $tabel='pricelist_order';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
    public function pricelistdistributor($param){
        $this->load->library('user_agent');  
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            if (!empty($param)) {
                $tabel='pricelist_order';
                
                $plorder=$this->Master_model->get($param,$tabel);
                $pl=$this->Master_model->get($plorder->id_pricelist,'price_list');
                $data['plorder']['jumlah_order'] = $plorder->jumlah_order;
                $data['plorder']['insheet'] = $plorder->insheet;
                $data['plorder']['id_pricelist'] = $plorder->id_pricelist;
                $data['plorder']['id_plorder'] = $plorder->id;
                $data['plorder']['plano'] = $plorder->plano;
                $data['plorder']['text'] = $pl->produk_konsumen.' '.$pl->produk_konsumen.' '.$pl->nama_produk.' '.$pl->warna;
               
                $data['view'] = 'Laporan/pricelistdistributor';
                $data['js'] = base_url().'production/js/web/pricelist_distributor.js'; 
                $this->load->view('index',$data);
            }
        
        }else{
            redirect($this->agent->referrer(),'refresh');
        }
    }
     public function addpricelistdistributor(){
        $tabel='pricelist_distributor';
        $data = $this->input->post();
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
    }
     public function runpricelistdistributor($id)
    {       
            $tabel='pricelist_distributor';
            $list = $this->Pricelistdistributor_model->get_datatables($tabel,$id);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
              
                $row[] = $no;
                $row[] = $query->jenis;
                $row[] = $query->distributor;
                $row[] = $query->barangjasa;
                $row[] = $query->jumlah;
                $row[] =  $this->decimalindo($query->harga);
                $row[] =  $this->decimalindo($query->harga*$query->jumlah);

               
               
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right">
                <li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$no."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Pricelistdistributor_model->count_all($tabel),
                        "recordsFiltered" => $this->Pricelistdistributor_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
     public function getpricelistdistributor($id)
    {
        $tabel='pricelist_distributor';
        $data=$this->Master_model->get($id,$tabel);
        $hargadistributor=$this->Master_model->get($data->id_hargadistributor,'hargadistributor');
        $data->distributor = $hargadistributor->distributor;
        $data->harga = $hargadistributor->harga;
            $warna = !empty($hargadistributor->warna)? ' '.$hargadistributor->warna :'';
            $merk = !empty($hargadistributor->merk)? ' '.$hargadistributor->merk :'';
            $size = !empty($hargadistributor->size)? ' '.$hargadistributor->size :'';
            $ketebalan = !empty($hargadistributor->ketebalan)? ' '.$hargadistributor->ketebalan :'';
            $harga=$this->decimalindo($hargadistributor->harga);
        $data->barang =  $hargadistributor->barangjasa.$warna.$merk.$size.$ketebalan.' Rp'.$harga;

        echo json_encode($data);
        
    }
       public function uppricelist_distributor()
     {
        $tabel='pricelist_distributor';
        $data = $this->input->post();
        
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
    public function hpspricelist_distributor($id)
    {
        $tabel='pricelist_distributor';
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }
     public function inventaris(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            
               
                $data['view'] = 'Pengaturan/inventaris';
                $data['js'] = base_url().'production/js/web/inventaris.js'; 
                $this->load->view('index',$data);
            
        
        }else{
            redirect('Beranda','refresh');
        }
    }
     public function addinventaris(){
        $tabel='inventaris';
        $data = $this->input->post();
         $config = array(
                'upload_path'  => "./production/upload/inventaris",
                'allowed_types' => 'jpg|png|jpeg',
                'file_name' => $data['kode'],
                'max_size' => 1024,
                'overwrite' => true
                );
        $this->upload->initialize($config);
        if ($_FILES['foto']['size'] != 0) {
            if(!$this->upload->do_upload('foto')){
                echo json_encode(array('status'=>false,'ket'=>'Error: '.$this->upload->display_errors()));
                exit();
            }
           
            $data['foto'] = $this->upload->file_name;
        }
        
       
        $data['tanggal_pembelian'] =  date("Y-m-d", strtotime($data['tanggal_pembelian']));
        $data['pengguna'] = implode(';', $data['pengguna']);

        
        $this->Master_model->tambah($data,$tabel);
        echo json_encode(array("status" => TRUE));
        exit(); 
    }
     public function runinventaris()
    {       
        $cachekiller = time();
            $tabel='inventaris';
            $list = $this->Master_model->get_datatables($tabel);
           
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
              
                $row[] = $no;
                 $row[] = $query->kode;
                $row[] = $query->barang;
                $row[] = $query->ukuran;
                $row[] = $query->spefikasi;
                $row[] = $query->pengguna;
                $row[] = date("d M Y",  strtotime($query->tanggal_pembelian));
                $row[] = $query->jumlah;
                $row[] = $query->kondisi;
                $row[] = $query->keterangan;
                 if(!empty($query->foto)){
                        $row[] =  '<a href="'.base_url().'production/upload/inventaris/'.$query->foto.'?'.$cachekiller.'" target="_blank"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
                    }else{
                         $row[] =  '';
                    }
               

               
               
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right">
                <li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$no."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Master_model->count_all($tabel),
                        "recordsFiltered" => $this->Master_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
     public function getinventaris($id)
    {
        $tabel='inventaris';
        $data=$this->Master_model->get($id,$tabel);
        $data->tanggal_pembelian =  date("d M Y",  strtotime($data->tanggal_pembelian));
         $data->pengguna = explode(';', $data->pengguna);

        echo json_encode($data);
        
    }
       public function upinventaris()
     {
        $tabel='inventaris';
        $data = $this->input->post();
        $get=$this->Master_model->get($data['id'],$tabel);
       

         
        if ($_FILES['foto']['size'] != 0) {
            $config = array(
                'upload_path'  => "./production/upload/inventaris",
                'allowed_types' => 'jpg|png|jpeg',
                'file_name' => $get->kode,
                'max_size' => 1024,
                'overwrite' => true
                );
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('foto')){
                echo json_encode(array('status'=>false,'ket'=>'Error: '.$this->upload->display_errors()));
                exit();
            }
            $data['foto'] = $this->upload->file_name;
        }
        if ($data['kode'] != $get->kode &&  !empty($get->foto)) {
            $extension = pathinfo('./production/upload/inventaris/'.$get->foto, PATHINFO_EXTENSION);
            $data['foto'] = $data['kode'].'.'.$extension;
            rename('./production/upload/inventaris/'.$get->foto, './production/upload/inventaris/'.$data['foto']);

        }
        $data['tanggal_pembelian'] =  date("Y-m-d", strtotime($data['tanggal_pembelian']));
         $data['pengguna'] = implode(';', $data['pengguna']);
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
    public function hpsinventaris($id)
    {
        $tabel='inventaris';
        $data=$this->Master_model->get($id,$tabel);
        if(!empty($data->foto)){
            unlink('./production/upload/inventaris/'.$data->foto); 
        }
       
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }

    public function stock(){
        if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){

            
               
                $data['view'] = 'Pengaturan/stocksend';
                $data['js'] = base_url().'production/js/web/stocksend.js'; 
                $this->load->view('index',$data);
            
        
        }else{
            redirect('Beranda','refresh');
        }
    }
    public function getbarangfromnota()
    {
        $nota = $this->input->get('nota');
        $tabel='laba_rugi';
        $data=$this->Master_model->getbarangfromnota($nota,$tabel);
        $resultarr=[];
         foreach($data as $key=>$value){
         $result['id'] = $value->id;
         $result['qty'] = $value->qty;
         $result['tanggal'] = date("d M Y",  strtotime($value->tanggal));
         $result['barang'] = $value->barang;
         $konsumen=$this->Master_model->get($value->id_konsumen,'konsumen');
         $result['konsumen'] = $konsumen->konsumen;
            $data=$this->Master_model->gettemplate(array('id_labarugi' => $value->id),'stock_kirim','result');

            if (!empty($data)) {

                $sum = 0;

                foreach($data as $key=>$value){

                    if(isset($value->jumlah))   
                        $sum += $value->jumlah;
                    
                }

                $result['qty'] =  $result['qty'] - $sum;
            }
            
         $resultarr[]=$result;
        }
        echo json_encode($resultarr);
        
    }
    public function getfakturpengiriman(){

        $tgl = $this->input->get('tanggal');
        $nota = $this->input->get('nota');
        $laba_rugi=$this->Master_model->getbarangfromnota($nota,'laba_rugi');
        $konsumen = $this->Master_model->get($laba_rugi[0]->id_konsumen,'konsumen');
       
        $data=$this->Master_model->gettemplate(array('nota' => $nota,'tanggal'=>$tgl),'stock_kirim','result');

        $faktur = array('status' => true, 'tanggal' => $tgl, 'nota' =>$nota,'data' =>$data,'konsumen'=>$konsumen->konsumen,'alamat'=>$konsumen->alamat);
       echo json_encode($faktur);
    }
    public function getriawayat()
    {
        $nota = $this->input->get('nota');
        $tabel='laba_rugi';
        $data=$this->Master_model->getbarangfromnota($nota,$tabel);
        $resultarr=[];
        
         foreach($data as $key=>$value){
         $result['id'] = $value->id;
         $result['jumlah_order'] = $value->qty;
         $result['barang'] = $value->barang;
         $konsumen=$this->Master_model->get($value->id_konsumen,'konsumen');
         $namakonsumen = $konsumen->konsumen;
            $data=$this->Master_model->gettemplate(array('id_labarugi' => $value->id),'stock_kirim','result');
            $sum = 0;
         
            if (!empty($data)) {

                

                foreach($data as $key=>$value){

                    if(isset($value->jumlah))   
                        $sum += $value->jumlah;
                    
                }
               
               
            }
            $result['jumlah_kirim'] = $sum;
            $result['qty'] =  $result['jumlah_order'] - $sum;
            $resultarr[]=$result;
        }
        $stock=$this->Master_model->gettemplate(array('nota' => $nota),'stock_kirim','result');
        $riwayat = [];
        foreach ($stock as $val) {
             $group = $val->tanggal;
             
             if(!isset($riwayat[$group])) $riwayat[$group ] = [];
            
             $arr['tanggal'] = date("d M Y",  strtotime($val->tanggal)); 
             $arr['id'] = $val->id;
             $arr['id_labarugi'] = $val->id_labarugi;
             $arr['barang'] = $val->barang;
             $arr['jumlah'] = $val->jumlah;

             $riwayat[$group][] = $arr;

        }
       
          ksort($riwayat);
  

        echo json_encode(array('konsumen' => $namakonsumen,'nota' => $nota,'tabel' =>$resultarr,'riwayat' => $riwayat));
        
    }
    
    public function addstocksend(){
        date_default_timezone_set("Asia/Bangkok");
        $tabel='invoice';
        
        $data = $this->input->post();
        $laba_rugi=$this->Master_model->getbarangfromnota($data['nota'],'laba_rugi');
        $konsumen = $this->Master_model->get($laba_rugi[0]->id_konsumen,'konsumen');
       
        $trx = $data['trx'];
        $fakture=[];
        foreach ($trx as $item) {
            $jumlahkirim = $this->Stockkirim_model->jumlahkirim($item['id_labarugi']);
            $barang=$this->Master_model->get($item['id_labarugi'],'laba_rugi');
            $batas = $barang->qty - ($jumlahkirim->jumlah+$item['jumlah']);
            if ($batas<0) {
                echo json_encode(array('status' => false,'message' => 'jumlah barang '.$item['barang'].' yang diminta tidak tersedia di stock silahkan cek riwayat barang' ));
                exit();
            }
            $item['nota'] = $data['nota'];
            $item['tanggal'] = date("Y-m-d");
            $fakture[]=$item;
           
            $this->Master_model->tambah($item,'stock_kirim');
        }
        

        $faktur = array('status' => true, 'tanggal' => date("Y-m-d"), 'nota' =>$data['nota'],'data' =>$fakture,'konsumen'=>$konsumen->konsumen,'alamat'=>$konsumen->alamat);
       echo json_encode($faktur);
        exit(); 
       
            
    }
    public function runstocksend()
    {
            $tabel='stock_kirim';
            $list = $this->Stockkirim_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = date("d M Y",  strtotime($query->tanggal));
                $row[] = '<span class="nota-text">'.$query->nota.'</span> &nbsp<a class="btn btn-round btn-warning btn-xs copyboard">Copy</a>';
                $row[] = $query->konsumen;
                $row[] = $query->barang;
                $row[] = $query->jumlah;
                $row[] = $query->note;
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".')"  data-toggle="modal" href="#edit" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li><li><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapusnota('."'".$query->nota."'".','."'".$no."'".')" title="Hapus"><i class="fa fa-times"></i> Hapus</a></li></ul></div>
                      ';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Stockkirim_model->count_all($tabel),
                        "recordsFiltered" => $this->Stockkirim_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }

  public function getstock($id)
    {
        $tabel='stock_kirim';
        $data=$this->Master_model->get($id,$tabel);
        $jumlahkirim = $this->Stockkirim_model->jumlahkirim($data->id_labarugi);
        
        $barang=$this->Master_model->get($data->id_labarugi,'laba_rugi');
        $batas = ($barang->qty - $jumlahkirim->jumlah)+$data->jumlah;
        $konsumen=$this->Master_model->get($barang->id_konsumen,'konsumen');
        $data->konsumen = $konsumen->konsumen;
        $data->tanggal =  date("d M Y",  strtotime($data->tanggal));
        $data->batas = $batas;
       
        echo json_encode($data);
        
    }
       public function upstock()
     {
        $tabel='stock_kirim';
        $data = $this->input->post();
        $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
        echo json_encode(array("status" => TRUE));
             exit(); 
       
    }
    public function hpsstock()
    {
        $tabel='stock_kirim';
        $arr = $this->input->get();
        unset($arr['csrf_gentelella_token']);
        $this->Master_model->hpstemplate($arr,$tabel);
        echo json_encode(array("status" => TRUE));
        
    }      
}
