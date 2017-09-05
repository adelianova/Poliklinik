<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dokter extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('dokter_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formDokter(){
		$data['data']=$this->dokter_m->getKodeDokter();
		$this->load->view('admin/master/formDokter',$data);
	}
	
	public function getListDokter(){
		$data['rows']=$this->dokter_m->getListDokter('rows');
		$data['total']=$this->dokter_m->getListDokter('total');
		echo json_encode($data);
		
	}
	
	public function simpanDokter(){
		$data=$this->dokter_m->simpanDokter();
		echo json_encode($data);
	}
	
	public function hapusDokter(){
		$data=$this->dokter_m->hapusDokter();
		echo json_encode($data);
	}
	
	

	
	
	
    
}