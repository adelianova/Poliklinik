<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supplier extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('supplier_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formSupplier(){
		$data['data']=$this->supplier_m->getKodeSupplier();
		$this->load->view('admin/master/formSupplier',$data);
	}
	
	public function getListSupplier(){
		$data['rows']=$this->supplier_m->getListSupplier('rows');
		$data['total']=$this->supplier_m->getListSupplier('total');
		echo json_encode($data);
		
	}
	
	public function simpanSuplier(){
		$data=$this->supplier_m->simpanSuplier();
		echo json_encode($data);
	}
	
	public function hapusSupplier(){
		$data=$this->supplier_m->hapusSupplier();
		echo json_encode($data);
	}
	
	

	
	
	
    
}