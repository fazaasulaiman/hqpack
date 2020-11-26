<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
                $this->load->model(array('Laporan_model'));
            }
    public function penjualan(){
    	if($this->session->userdata('LOGIN')=='TRUE'){
        $this->cart->destroy();
        $data['view'] = 'Laporan/lappenjualan';
        $data['js'] = base_url().'production/js/web/lappenjualan.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
    public function retur(){
        if($this->session->userdata('LOGIN')=='TRUE'){
        $this->cart->destroy();
        $data['view'] = 'Laporan/lapretur';
        $data['js'] = base_url().'production/js/web/lapretur.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
    public function labarugi(){
        if($this->session->userdata('LOGIN')=='TRUE' and $this->session->userdata('LEVEL')==2){
        $this->cart->destroy();
        $data['view'] = 'Laporan/labarugi';
        $data['js'] = base_url().'production/js/web/labarugi.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }
    }
    
    function getangka(){
        $angka=0;
        $tgl1=$this->input->post('tgl1');
        $tgl2=$this->input->post('tgl2');
        $kpm=$this->input->post('id');
        $pengeluaran=$this->Laporan_model->pengeluaran($tgl1,$tgl2,$kpm);
        $kotor=$this->Laporan_model->kotor($tgl1,$tgl2,$kpm);
        if($kotor){
            foreach ($kotor as $query) {
                $angka = $angka+$query->kotor;
        }
        $data=array(
            'status'=>true,
            'rusak'=>$pengeluaran->Rusak,
            'foc'=>$pengeluaran->FOC,
            'hilang'=>$pengeluaran->Hilang,
            'kotor'=>$angka,
            );
        echo json_encode($data);
        }else{
            $data=array(
            'status'=>false
            );
        echo json_encode($data);

        }
        
    }
    public function runlaporan(){
    	$tabel=$this->uri->segment(3);
    	$list=$this->Laporan_model->get_datatables($tabel);
    	$data = array();
    	$no = $_POST['start'];
    	if($tabel=='transaksi_data'){
    		 foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->tgl;
                if ($this->session->userdata('LEVEL')==2) {
                $row[] = $query->kpm;
                } 
                $row[] = $query->id_penjualan;
                $row[] = $query->kode;
                $row[] = $query->nama;
                $row[] = $query->jumlah;
                $row[] = 'Rp'.number_format($query->harga_item);
                $row[] = 'Rp'.number_format($query->tot_harga);
            $data[] = $row;
        	}
    	}
    	if($tabel=='transaksi_penjualan'){
    		foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
               
                $row[] = $query->tgl;
                $row[] = $query->kpm; 
                $row[] = $query->id;
                $row[] = 'Rp'.number_format($query->tunai);
                $row[] = 'Rp'.number_format($query->atm);
                $row[] = 'Rp'.number_format($query->vocher);
                $row[] = 'Rp'.number_format($query->totdiskon);
                $row[] = 'Rp'.number_format($query->jumlahlr);
                $row[] = 'Rp'.number_format($query->totproduksi);
                $row[] = 'Rp'.number_format($query->kotor);
            $data[] = $row;
        	}
    	}    
            if($tabel=='transaksi_retur'){
             foreach ($list as $query) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $query->date;
                $row[] = $query->kpm; 
                $row[] = $query->id_penjualan;
                $row[] = $query->nama;
                $row[] = $query->jumlah;
                $row[] = $query->retur;

            $data[] = $row;
            }
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
    //analitik
    function analitik(){
         if($this->session->userdata('LOGIN')=='TRUE' and $this->session->userdata('LEVEL')==2){
        $this->cart->destroy();
        $data['view'] = 'Laporan/analitik';
        $data['js'] = base_url().'production/js/web/analitik.js'; 
        $this->load->view('index',$data);
        }else{
            redirect('Beranda','refresh');
        }

    }
    function analkotorkpm(){
        $angka1=$angka2=0;
        $tgl1=$this->input->post('tgl1');
        $kpm1=$this->input->post('id1');
        $tgl2=$this->input->post('tgl2');
        $kpm2=$this->input->post('id2');
        for ($i=1; $i <=2 ; $i++) { 
            if($i==1){
             $kotor=$this->Laporan_model->kotorchartkpm($tgl1,$tgl2,$kpm1); 
               if($kotor){
                    foreach ($kotor as $query) {
                        $angka1 = $angka1+$query->kotor;
                        }
                    }
            }else{
                $kotor=$this->Laporan_model->kotorchartkpm($tgl1,$tgl2,$kpm2); 
                if($kotor){
                    foreach ($kotor as $query) {
                        $angka2 = $angka2+$query->kotor;
                        }
                    }
            }
            
        }
        $data=array(
            'status'=>true,
            'angka1'=>$angka1,
            'angka2'=>$angka2
            );
        echo json_encode($data); 

    }
    function kotorkpm($tgl1,$tgl2,$kpm1,$kpm2){
        $angka1=$angka2=0;
        for ($i=1; $i <=2 ; $i++) { 
            if($i==1){
             $kotor=$this->Laporan_model->kotorchartkpm($tgl1,$tgl2,$kpm1); 
               if($kotor){
                    foreach ($kotor as $query) {
                        $angka1 = $angka1+$query->kotor;
                        }
                    }
            }else{
                $kotor=$this->Laporan_model->kotorchartkpm($tgl1,$tgl2,$kpm2); 
                if($kotor){
                    foreach ($kotor as $query) {
                        $angka2 = $angka2+$query->kotor;
                        }
                    }
            }
            
        }
        $data=array(
            'angka1'=>$angka1,
            'angka2'=>$angka2
            );
        return $data;

    }
    function analkotortahun(){
        $jan=$feb=$mar=$apr=$mei=$jun=$jul=$agus=$sept=$okt=$nov=$des=0;
        $tahun=$this->input->post('tahun');
        $kpm=$this->input->post('id'); 
        
        
        for ($i=1; $i<=12 ; $i++) { 
         $kotor=$this->Laporan_model->kotorcharttahun($i,$tahun,$kpm);
         switch ($i) {
                case 1:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $jan = $jan+$query->kotor;
                            }
                        }
                    break;
                case 2:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $feb = $feb+$query->kotor;
                            }
                        }
                    break;
                case 3:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $mar = $mar+$query->kotor;
                            }
                        }
                    break;
                case 4:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $apr = $apr+$query->kotor;
                            }
                        }
                    break;
                case 5:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $mei = $mei+$query->kotor;
                            }
                        }
                    break;
                case 6:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $jun = $jun+$query->kotor;
                            }
                        }
                    break;
                case 7:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $jul = $jul+$query->kotor;
                            }
                        }
                    break;
                case 8:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $agus = $agus+$query->kotor;
                            }
                        }
                    break;
                case 9:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $sept = $sept+$query->kotor;
                            }
                        }
                    break;
                case 10:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $okt = $okt+$query->kotor;
                            }
                        }
                    break;
                case 11:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $nov = $nov+$query->kotor;
                            }
                        }
                    break;
                case 12:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $des = $des+$query->kotor;
                            }
                        }
                    break;
            }   

        }  
        $data=array(
            'status'=>true,
            'jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'mei'=>$mei,'jun'=>$jun,'jul'=>$jul,
            'agus'=>$agus,'sept'=>$sept,'okt'=>$okt,'nov'=>$nov,'des'=>$des
            );
        
        
           echo json_encode($data);   
        
    }
    function kotortahun($tahun,$kpm){
        $jan=$feb=$mar=$apr=$mei=$jun=$jul=$agus=$sept=$okt=$nov=$des=0;
        $tahun=$tahun;
        $kpm=$kpm; 
        for ($i=1; $i<=12 ; $i++) { 
         $kotor=$this->Laporan_model->kotorcharttahun($i,$tahun,$kpm);
         switch ($i) {
                case 1:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $jan = $jan+$query->kotor;
                            }
                        }
                    break;
                case 2:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $feb = $feb+$query->kotor;
                            }
                        }
                    break;
                case 3:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $mar = $mar+$query->kotor;
                            }
                        }
                    break;
                case 4:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $apr = $apr+$query->kotor;
                            }
                        }
                    break;
                case 5:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $mei = $mei+$query->kotor;
                            }
                        }
                    break;
                case 6:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $jun = $jun+$query->kotor;
                            }
                        }
                    break;
                case 7:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $jul = $jul+$query->kotor;
                            }
                        }
                    break;
                case 8:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $agus = $agus+$query->kotor;
                            }
                        }
                    break;
                case 9:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $sept = $sept+$query->kotor;
                            }
                        }
                    break;
                case 10:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $okt = $okt+$query->kotor;
                            }
                        }
                    break;
                case 11:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $nov = $nov+$query->kotor;
                            }
                        }
                    break;
                case 12:
                    if($kotor){
                        foreach ($kotor as $query) {
                            $des = $des+$query->kotor;
                            }
                        }
                    break;
            }   

        }  
        $data=array(
            'status'=>true,
            'jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'mei'=>$mei,'jun'=>$jun,'jul'=>$jul,
            'agus'=>$agus,'sept'=>$sept,'okt'=>$okt,'nov'=>$nov,'des'=>$des
            );
           return $data;   
        
    }
    function bersihtahun(){
        $jan=$feb=$mar=$apr=$mei=$jun=$jul=$agus=$sept=$okt=$nov=$des=0;
        $tahun=$this->input->post('tahun');
        $kpm=$this->input->post('id');
        for ($i=1; $i <12 ; $i++) { 
            $bersih=$this->Laporan_model->bersihtahun($i,$tahun,$kpm);
            switch ($i) {
                case 1:
                    if($bersih){
                            $jan =$bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 2:
                    if($bersih){
                            $feb = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 3:
                    if($bersih){
                            $mar =$bersih->Rusak+$bersih->FOC+$bersih->Hilang; 
                        }
                    break;
                case 4:
                    if($bersih){
                            $apr = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 5:
                    if($bersih){
                            $mei = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 6:
                    if($bersih){
                            $jun = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 7:
                    if($bersih){
                            $jul = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 8:
                    if($bersih){
                            $agus = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 9:
                    if($bersih){
                            $sept = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 10:
                    if($bersih){
                            $okt = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 11:
                    if($bersih){
                            $nov = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
                case 12:
                    if($bersih){
                            $des = $bersih->Rusak+$bersih->FOC+$bersih->Hilang;
                        }
                    break;
            } 

        }
        $kotor=$this->kotortahun($tahun,$kpm);
        $data=array(
            'status'=>true,
            'jan'=>$kotor['jan']-$jan,'feb'=>$kotor['feb']-$feb,'mar'=>$kotor['mar']-$mar,'apr'=>$kotor['apr']-$apr,'mei'=>$kotor['mei']-$mei,'jun'=>$kotor['jun']-$jun,'jul'=>$kotor['jul']-$jul,'agus'=>$kotor['agus']-$agus,'sept'=>$kotor['sept']-$sept,'okt'=>$kotor['okt']-$okt,'nov'=>$kotor['nov']-$nov,'des'=>$kotor['des']-$des
            );
        echo json_encode($data);

    }
    function bersihkpm(){
        $angka1=$angka2=0;
        $tgl1=$this->input->post('tgl1');
        $kpm1=$this->input->post('id1');
        $tgl2=$this->input->post('tgl2');
        $kpm2=$this->input->post('id2');
        for ($i=1; $i <=2 ; $i++) { 
            if($i==1){
             $bersih=$this->Laporan_model->bersihkpm($tgl1,$tgl2,$kpm1); 
               if($bersih){
                        $angka1 = $bersih->Rusak+$bersih->Hilang+$bersih->FOC;
                        } 
            }else{
                $bersih=$this->Laporan_model->bersihkpm($tgl1,$tgl2,$kpm2); 
                if($bersih){
                        $angka2 = $bersih->Rusak+$bersih->Hilang+$bersih->FOC;
                        } 
                }
        }
        $kotor=$this->kotorkpm($tgl1,$tgl2,$kpm1,$kpm2);
        $data=array(
            'status'=>true,
            'angka1'=>$kotor['angka1']-$angka1,
            'angka2'=>$kotor['angka2']-$angka2,
            );
        echo json_encode($data);
            
    }
}