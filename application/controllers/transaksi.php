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
	
	public function getListTransaksi(){
		$data['rows']=$this->transaksi_m->getListTransaksi('rows');
		$data['total']=$this->transaksi_m->getListTransaksi('total');
		echo json_encode($data);
	}
	public function getListResepTransaksi(){
		$data['rows']=$this->transaksi_m->getListResepTransaksi('rows');
		$data['total']=$this->transaksi_m->getListResepTransaksi('total');
		echo json_encode($data);
	}
	
	public function simpanTransaksi(){
		$data=$this->transaksi_m->simpanTransaksi();
		echo json_encode($data);
	}
	
	public function hapusTransaksi(){
		$data=$this->transaksi_m->hapusTransaksi();
		echo json_encode($data);
	}
    
}