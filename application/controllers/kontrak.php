<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kontrak extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('kontrak_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formKontrak(){
		$data['data']=$this->kontrak_m->getKodeKontrak();
		$this->load->view('admin/master/formKontrak',$data);
	}
	
	public function getListKontrak(){
		$data['rows']=$this->kontrak_m->getListKontrak('rows');
		$data['total']=$this->kontrak_m->getListKontrak('total');
		echo json_encode($data);
		
	}
	
	public function simpanKontrak(){
		$data=$this->kontrak_m->simpanKontrak();
		echo json_encode($data);
	}
	
	public function hapusKontrak(){
		$data=$this->kontrak_m->hapusKontrak();
		echo json_encode($data);
	}
	 public function getKodeDokter(){
        $data=$this->kontrak_m->getKodeDokter();
		echo json_encode($data);
    }
    
}