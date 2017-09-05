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
		$this->load->view('transaksi/formTransaksi',$data);
	}
	
	public function getListStock(){
		$data['rows']=$this->transaksi_m->getListStock('rows');
		$data['total']=$this->transaksi_m->getListStock('total');
		echo json_encode($data);
	}
	
	public function simpanTransaksi(){
		$data=$this->transaksi_m->simpanTransaksi();
		echo json_encode($data);
	}
	
	public function removeTransaksi(){
		$data=$this->transaksi_m->removeTransaksi();
		echo json_encode($data);
	}
    
    public function getListIDTransaksi(){
    	$data=$this->transaksi_m->getListIDTransaksi();
		echo json_encode($data);
    }

    public function formAnu(){
    	$data['data']=$this->transaksi_m->getIDStock();
		$this->load->view('transaksi/formAnu', $data);
	}
	public function getIDSuplier(){
    	$data=$this->transaksi_m->getIDSuplier();
		echo json_encode($data);
    }
}
