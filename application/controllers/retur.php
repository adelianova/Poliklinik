<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Retur extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('retur_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	public function getListRetur(){
		$data['rows']=$this->retur_m->getListRetur('rows');
		$data['total']=$this->retur_m->getListRetur('total');
		echo json_encode($data);
	}
	
	public function getListDetail(){
		$data=$this->retur_m->getListDetail();
		echo json_encode($data);
	}
	

	public function simpanRetur(){
		$data=$this->retur_m->simpanRetur();
		echo json_encode($data);
	}

	public function simpanTambahRetur($id_retur=""){
		$data=$this->retur_m->simpanTambahRetur($id_retur);
		echo json_encode($data);
	}
	public function removeRetur(){
		$data=$this->retur_m->removeRetur();
		echo json_encode($data);
	}

	public function removeTambahRetur(){
		$data=$this->retur_m->removeTambahRetur();
		echo json_encode($data);
	}
    
    public function getListIDRetur(){
    	$data=$this->retur_m->getListIDRetur();
		echo json_encode($data);
    }
    public function formRetur(){
    	$data['data']=$this->retur_m->getIDRetur();
		$this->load->view('transaksi/formRetur', $data);
	}
	public function formTambahRetur($id_retur=""){
		$data['id_retur'] = $id_retur;
    	$data['data']=$this->retur_m->getIDRetur();
		$this->load->view('transaksi/formTambahRetur', $data);
	}
	public function getDtlStock(){
    	$data=$this->retur_m->getDtlStock();
		echo json_encode($data);
    }
}