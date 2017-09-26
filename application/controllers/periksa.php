<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Periksa extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('periksa_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formPeriksa(){
		$data['data']=$this->periksa_m->getIDPeriksa();
		$this->load->view('transaksi/formPeriksa',$data);
	}
	
	public function getListPeriksa(){
		$data['rows']=$this->periksa_m->getListPeriksa('rows');
		$data['total']=$this->periksa_m->getListPeriksa('total');
		echo json_encode($data);
		
	}
	
	public function simpanPeriksa(){
		$data=$this->periksa_m->simpanPeriksa();
		echo json_encode($data);
	}
	
	public function hapusPeriksa(){
		$data=$this->periksa_m->hapusPeriksa();
		echo json_encode($data);
	}
	
	 public function getKodePasien(){
        $data=$this->periksa_m->getKodePasien();
		echo json_encode($data);
    }
     public function getIDPeriksa(){
        $data=$this->periksa_m->getIDPeriksa();
		echo json_encode($data);
    }
    public function getKodeDokter(){
        $data=$this->periksa_m->getKodeDokter();
		echo json_encode($data);
    }
    public function getKodePenyakit(){
        $data=$this->periksa_m->getKodePenyakit();
		echo json_encode($data);
    }
    public function getIDPenyakit(){
        $data=$this->periksa_m->getIDPenyakit();
		echo json_encode($data);
    }
}