<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_obat extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('laporan_obat_m'));
    }    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	public function getListLaporanObat(){
		$data['rows']=$this->laporan_obat_m->getListLaporanObat('rows');
		$data['total']=$this->laporan_obat_m->getListLaporanObat('total');
		echo json_encode($data);
	}	
}