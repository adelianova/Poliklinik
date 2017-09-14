<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Masuk extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('masuk_m'));
    }    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	public function getListMasuk(){
		$data['rows']=$this->masuk_m->getListMasuk('rows');
		$data['total']=$this->masuk_m->getListMasuk('total');
		echo json_encode($data);
	}
		
}