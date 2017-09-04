<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penyakit extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('penyakit_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	
	public function getListPenyakit(){
		$data['rows']=$this->penyakit_m->getListPenyakit('rows');
		$data['total']=$this->penyakit_m->getListPenyakit('total');
		echo json_encode($data);
		
	}/*
	
	public function simpanPenyakit(){
		$data=$this->penyakit_m->simpanPenyakit();
		echo json_encode($data);
	}
	
	public function hapusPenyakit(){
		$data=$this->penyakit_m->hapusPenyakit();
		echo json_encode($data);
	}
	*/
}