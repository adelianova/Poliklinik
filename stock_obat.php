<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class stock_obat extends MY_Controller {

    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('stock_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	public function getListStock(){
		$data['rows']=$this->stock_m->getListStock('rows');
		$data['total']=$this->stock_m->getListStock('total');
		echo json_encode($data);
		
	}
}