<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

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
    
	public function index()
	{   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==1 ){
		$data['view'] = 'Upload/upload';
		$data['js'] = base_url().'production/js/web/upload.js'; 
		$this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
	}
    public function laporan()
    {   
      if($this->session->userdata('LOGIN')=='TRUE' && $this->session->userdata('LEVEL')==2 ){
        $data['view'] = 'Upload/laporan';
        $data['js'] = base_url().'production/js/web/lapupload.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
 public function runupload()
    {
            $tabel='upload';
            $list = $this->Laporan_model->get_datatables($tabel);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->tgl;
                $row[] = $query->kpm;
                $row[] = $query->tgl1;
                $row[] = $query->tgl2;
                $row[] = ' <a target="_blank" href="'.base_url().'production/upload/'.$query->transfer.'"><i class="fa fa-file-archive-o  fa-2x"></i></a>';
                $row[] = ' <a target="_blank" href="'.base_url().'production/upload/'.$query->transaksi.'"><i class="fa fa-file-archive-o  fa-2x"></i></a>';
                $row[] = ' <a target="_blank" href="'.base_url().'production/upload/'.$query->item.'"><i class="fa fa-file-archive-o  fa-2x"></i></a>';
                if ($query->foc==null) {
                $row[]='';
                }else{
                  $row[] = ' <a target="_blank" href="'.base_url().'production/upload/'.$query->foc.'"><i class="fa fa-file-archive-o  fa-2x"></i></a>';  
                }
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="hapus('."'".$query->id."'".','."'".$query->transfer."'".','."'".$query->transaksi."'".','."'".$query->item."'".','."'".$query->foc."'".')" title="hilang"><i class="fa fa-check-square"></i> Hapus</a></ul></div>';
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
    function hapus(){
        $id=$this->input->post('id');
        $transaksi=$this->input->post('transaksi');
        $transfer=$this->input->post('transfer');
        $item=$this->input->post('item');
        $foc=$this->input->post('foc');
        $tabel='upload';
        if ($foc!='') {
           $data=array($transfer,$transaksi,$item,$foc);
            
        }else{
            $data=array($transfer,$transaksi,$item);
        }
        for ($i=0; $i <sizeof($data) ; $i++) { 
            unlink('./production/upload/'.$data[$i]);  
        }
       
        $this->Master_model->hps($id,$tabel);
        echo json_encode(array("status" => TRUE));
        exit();  
    }
    public function upload()
    {
        $kode=$this->session->userdata('NAMA');
        $id=$this->session->userdata('ID');
        $tgl1=$this->input->post('tgl1');
        $tgl2=$this->input->post('tgl2');
        $transaksi=$this->input->post('transaksi');
        $item=$this->input->post('lain');
        $transfer=$this->input->post('transfer');
        $foc=$this->input->post('foc');
         if ($transfer !== "")
            {
             $config = array(
                'upload_path'  => "./production/upload/",
                'allowed_types' => 'pdf|jpg',
                'file_name' => $kode.'transfer'.$tgl1.'-'.$tgl2,
                'overwrite' => true
                );
            $this->upload->initialize($config);
            if($this->upload->do_upload('transfer')==false){
                echo json_encode(array('status'=>false,'ket'=>'transfer'.$this->upload->display_errors()));
                exit();
            } 
            $transfer=$this->upload->file_name;
            }
        if ($transaksi !== "")
            {
             $config = array(
                'upload_path'  => "./production/upload/",
                'allowed_types' => 'pdf',
                'file_name' => $kode.'transaksi'.$tgl1.'-'.$tgl2,
                'overwrite' => true
                );
            $this->upload->initialize($config);
            $this->upload->do_upload('transaksi');
            if($this->upload->do_upload('transaksi')==false){
                echo json_encode(array('status'=>false,'ket'=>'penjualan transaksi'.$this->upload->display_errors()));
                exit();
            } 

            $transaksi=$this->upload->file_name;
            }
        if ($item !== "")
            {
             $config = array(
                'upload_path'  => "./production/upload/",
                'allowed_types' => 'pdf',
                'file_name' => $kode.'item'.$tgl1.'-'.$tgl2,
                'overwrite' => true
                );
            $this->upload->initialize($config);
            if($this->upload->do_upload('lain')==false){
                echo json_encode(array('status'=>false,'ket'=>'penjulan item'.$this->upload->display_errors()));
                exit();
            } 
            $item=$this->upload->file_name;
            
            }
        if (strlen($_FILES['foc']['name']) > 0)
            {
             $config = array(
                'upload_path'  => "./production/upload/",
                'allowed_types' => 'rar|zip',
                'file_name' => $kode.'foc'.$tgl1.'-'.$tgl2,
                'overwrite' => true
                );
            $this->upload->initialize($config);
            if($this->upload->do_upload('foc')==false){
                echo json_encode(array('status'=>false,'ket'=>'FOC'.$this->upload->display_errors()));
                exit();
            } 
            $foc=$this->upload->file_name;
            
            }
         $data = array(
                        'tgl' =>date('Y-m-d'),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2, 
                        'transfer' => $transfer,
                        'transaksi'=>$transaksi,
                        'item'=>$item,
                        'foc'=>$foc,
                        'id_kpm'=>$id
                        );
        $cek=$this->Master_model->cekupload($tgl1,$tgl2);
        if($cek==1){
            $this->Master_model->updup($data,$tgl1,$tgl2);
        }else{
          $this->Master_model->tambah($data,'upload');  
        }
        echo json_encode(array('status'=>true));
        exit();
    }

}
