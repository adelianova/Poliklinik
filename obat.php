<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Obat extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('obat_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formObat(){
		$data['data']=$this->obat_m->getKodeObat();
		$this->load->view('admin/master/formObat',$data);
	}
	
	public function getListObat(){
		$data['rows']=$this->obat_m->getListObat('rows');
		$data['total']=$this->obat_m->getListObat('total');
		echo json_encode($data);
		
	}
	
	public function simpanObat(){
		$data=$this->obat_m->simpanObat();
		echo json_encode($data);
	}
	
	public function hapusObat(){
		$data=$this->obat_m->hapusObat();
		echo json_encode($data);
	}
	
	

	
	
	
    
}