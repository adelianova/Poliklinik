<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_pemeriksaan extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('laporan_pemeriksaan_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	public function getListLaporanPemeriksaan(){
		$data['rows']=$this->laporan_pemeriksaan_m->getListLaporanPemeriksaan('rows');
		$data['total']=$this->laporan_pemeriksaan_m->getListLaporanPemeriksaan('total');
		echo json_encode($data);
		
	}
	
}