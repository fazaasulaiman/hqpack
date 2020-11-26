<?php
class Command extends CI_Controller {

    public function __construct () {
        parent::__construct();
        // Limit it to CLI requests only using built-in CodeIgniter function
        }
    public function message(){
        echo "hello";
    }
    public function update(){
        $sql = "SELECT id,nota FROM laba_rugi";

        $labarugi = $this->db->query($sql)->result(); 
        foreach ($labarugi as $item) {
           $this->db->update('hpp',array('id_labarugi' => $item->id ),  array('nota' => $item->nota));
           echo "sukses add id_labarugi ". $item->id.PHP_EOL;
        }
    }
    public function sendMail()
    {
            $data = $this->Email->send();
            if(empty($data)){
            	 return false;
            }
            $this->email->initialize($this->config->item('email'));
		    //konfigurasi pengiriman
		    $this->email->from($this->config->item('email')['smtp_user'],$data['email']);
		    $this->email->to($this->config->item('email')['emailto']);
		    //$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');
		    $this->email->subject("Email dari Website Kantor");
		    $body = $this->load->view('Email/pengaduan.php',$data,TRUE);
		    $this->email->message($body);

			$data['status'] = $this->email->send(FALSE);

			$data['log'] = $this->email->print_debugger();

		    $this->Email->save($data);
		    echo "email success send";
    }
    public function botLogs(){

      /*  $fh= fopen(FCPATH.'/application/logs/alo.txt', 'r');

        
while ($line = fgets($fh)) {
  echo $line;
}
fclose($fh);
        exit();*/

        $token = "447835374:AAHy1YzuQWm3kfhwXa7wOmr8WtWsowFdCK8";

    $data = [

        'chat_id' => '343714133',
        'document' => FCPATH.'/application/logs/alo.txt',
    ];

    $send = "https://api.telegram.org/bot$token/sendDocument?" . http_build_query($data);
    var_dump($send);
        $request = file_get_contents($send);
        $result = json_decode($request, true);
        var_dump($result);
        exit();

           
        /*$files    = directory_map('./application/logs/',1);
        
        foreach ($files as $file) {
            
            if (strpos($file, 'log-') !== false) {
        
                $log = file_get_contents('./application/logs/'.$file, FILE_USE_INCLUDE_PATH, null); 
                $lines = explode("\n", $log); 

                $content =   implode("\n", array_slice($lines, 1));
                $data['log'] = $content;
                if($this->sendTele($data['log'])){

                    var_dump(unlink('./application/logs/'.$file));
                }
                
            }
        }*/
    }

    public function sendTele($text){
         $token = "447835374:AAHy1YzuQWm3kfhwXa7wOmr8WtWsowFdCK8";

    $data = [

        'chat_id' => '343714133',
        'document' => './application/logs/alo.txt',
    ];

    $send = "https://api.telegram.org/bot$token/sendDocument?" . http_build_query($data);
        $request = file_get_contents($send);
        $result = json_decode($request, true);

        
    
    if ($result['ok'] == 1) {
             echo 'succes send message'.PHP_EOL;
             return true;
    }
    return false;
    }
    
}