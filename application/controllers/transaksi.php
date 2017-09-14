<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaksi extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('transaksi_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formTransaksi(){
		$data['data']=$this->transaksi_m->getKodeTransaksi();
		$data['tbl']=$this->transaksi_m->getKodeTransaksi();
		$this->load->view('transaksi/formObat',$data);
	}
	
	public function getListStock(){
		$data['rows']=$this->transaksi_m->getListStock('rows');
		$data['total']=$this->transaksi_m->getListStock('total');
		echo json_encode($data);
	}
	
	public function getListDetail(){
		$data=$this->transaksi_m->getListDetail();
		echo json_encode($data);
	}
	

	public function simpanTransaksi(){
		$data=$this->transaksi_m->simpanTransaksi();
		echo json_encode($data);
	}

	public function simpanObat($id_stock=""){
		$data=$this->transaksi_m->simpanObat($id_stock);
		echo json_encode($data);
	}
	public function removeTransaksi(){
		$data=$this->transaksi_m->removeTransaksi();
		echo json_encode($data);
	}

	public function removeTambah(){
		$data=$this->transaksi_m->removeTambah();
		echo json_encode($data);
	}
    
    public function getListIDTransaksi(){
    	$data=$this->transaksi_m->getListIDTransaksi();
		echo json_encode($data);
    }

    public function formObat(){
    	$data['data']=$this->transaksi_m->getIDStock();
		$this->load->view('transaksi/formObat', $data);
	}
	public function formTambahObat($id_stock="",$id_dtl_stock=""){
		$data['id_stock'] = $id_stock;
		$data['id_dtl_stock'] = $id_dtl_stock;
    	$data['data']=$this->transaksi_m->getIDStock();
    	$data['data']=$this->transaksi_m->getIDDtlStock();
		$this->load->view('transaksi/formTambahObat', $data);
	}
	public function getIDSuplier(){
    	$data=$this->transaksi_m->getIDSuplier();
		echo json_encode($data);
    }
}