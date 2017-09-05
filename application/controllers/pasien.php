<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pasien extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('pasien_m'));
    }
    
    /*public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }*/
	
	public function formPasien(){
		//$data['data']=$this->pasien_m->getKodePasien();
		$this->load->view('admin/master/formPasien');
	}
	
	public function getListPasien(){
		$data['rows']=$this->pasien_m->getListPasien('rows');
		$data['total']=$this->pasien_m->getListPasien('total');
		echo json_encode($data);
		
	}
	
	public function simpanPasien(){
		$data=$this->pasien_m->simpanPasien();
		echo json_encode($data);
	}
	
	public function hapusPasien(){
		$data=$this->pasien_m->hapusPasien();
		echo json_encode($data);
	}
	
    public function getStatus(){
        $data=$this->pasien_m->getStatus();
		echo json_encode($data);
    }
	

	
	
	
    
}