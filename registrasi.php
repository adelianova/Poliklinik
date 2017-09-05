<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registrasi extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('registrasi_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formRegistrasi(){
		$data['data']=$this->registrasi_m->getKodeRegistrasi();
		$this->load->view('transaksi/formRegistrasi',$data);
	}
	
	public function getListRegistrasi(){
		$data['rows']=$this->registrasi_m->getListRegistrasi('rows');
		$data['total']=$this->registrasi_m->getListRegistrasi('total');
		echo json_encode($data);
		
	}
	
	public function simpanRegistrasi(){
		$data=$this->registrasi_m->simpanRegistrasi();
		echo json_encode($data);
	}
	
	public function hapusRegistrasi(){
		$data=$this->registrasi_m->hapusRegistrasi();
		echo json_encode($data);
	}
	public function getStatus(){
		$data=$this->registrasi_m->getStatus();
		echo json_encode($data);
	}
	public function getIDPasien(){
		$data=$this->registrasi_m->getIDPasien();
		echo json_encode($data);
	}
}