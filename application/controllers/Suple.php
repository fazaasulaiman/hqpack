<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suple extends CI_Controller {

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
                $this->load->model(array('Suple_model','Master_model'));
            }
	public function index()
	{   
    if($this->session->userdata('LOGIN')=='TRUE'){
		$data['view'] = 'Suple/kirim';
		$data['js'] = base_url().'production/js/web/kirim.js'; 
		$this->load->view('index',$data);
        }else{
            redirect('Master/login','refresh');
        }

	}
   
	public function kirimpkm(){
                    $tabel='kirim_cabang';
					$data = array(
                    'tgl' => date('Y-m-d'),
                    'id_kpm' =>  $this->input->post('id_kpm'),
                    'id_barang' => $this->input->post('id_barang'),
                    'jum_kirim' =>  $this->input->post('jumlah'),
                    'jual' =>  $this->input->post('jual'),
                    'produksi' =>  $this->input->post('produksi')
                    );
                    $this->Master_model->tambah($data,$tabel);
                    echo json_encode(array("status" => TRUE));
                    exit();  
            
	}
    public function konfir(){
        $tabel='kirim_cabang';
        $status=$this->input->post('status');
        if($status=='OK'){
            $terima=$this->input->post('kirim');
        }
        if($status!='OK'){
            $terima=$this->input->post('terima');
        }

        $selisih=$this->input->post('kirim')-$terima;
        $data=array(
            'tgltrima'=> date('Y-m-d'),
            'ket'=>$status,
            'jum_terima'=>$terima,
            'jum_selisih'=>$selisih
            );
         $this->Master_model->update(array('id' => $this->input->post('id')), $data,$tabel);
         echo json_encode(array("status" => TRUE));
         exit(); 
    }
    public function get(){
        $tabel='kirim_cabang';
        $id=$this->uri->segment(3);
        $data=$this->Suple_model->get($id,$tabel);
        echo json_encode($data);
        exit();
    }
	public function runspengiriman()
    {
            $tabel='kirim_cabang';
            $list = $this->Suple_model->get_datatables($tabel);
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
                $row[] = 'Rp'.number_format($query->jual);
                $row[] = $query->jum_kirim;
                $row[] = $query->tgltrima;
                $row[] = $query->jum_terima;
                $row[] = $query->jum_selisih;
                if($query->ket=='OK'){
                     $row[] ='<span class="label label-success">'.$query->ket.'</span>';
                }elseif ($query->ket=='Jumlah Tidak Sesuai') {
                     $row[] ='<span class="label label-warning">'.$query->ket.'</span>';
                }else{
                     $row[] ='<span class="label label-danger">'.$query->ket.'</span>';
                }
                if($this->session->userdata('LEVEL')==1 && $query->ket ==null){
                $row[] = '<div class="btn-group"><a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right"><li role="presentation"><a role="menuitem" data-toggle="modal" tabindex="-1"  onclick="ok('."'".$query->id."'".','."'".$query->jum_kirim."'".','."'".$query->nama."'".')" title="hilang"><i class="fa fa-check-square"></i> OK</a></li><li role="presentation"><a role="menuitem" tabindex="-1"  onclick="edit('."'".$query->id."'".','."'Rusak'".')" data-toggle="modal" title="rusak"><i class="fa fa-chain-broken"></i>Lainnya</a></li></ul></div>';
                }else{
                   $row[] =''; 
                }
                
                
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Suple_model->count_all($tabel),
                        "recordsFiltered" => $this->Suple_model->count_filtered($tabel),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
        
    }
    
}
