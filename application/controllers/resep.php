<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resep extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('resep_m'));
		$this->load->model(array('obat_m'));
    }
    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	
	public function formResep(){
		$data['data']=$this->resep_m->getKodeResep();
		$data['tbl']=$this->resep_m->getKodeResep();
		$this->load->view('transaksi/formResep',$data);
	}

	public function list_obat(){
		$data['tbl'] = $this->resep_m->tblResep();
		echo json_encode($data);
	}
	
	public function getListResep(){
		$data['rows']=$this->resep_m->getListResep('rows');
		$data['total']=$this->resep_m->getListResep('total');
		echo json_encode($data);
		
	}

	public function getListDetail(){
		$data=$this->resep_m->kodeResep();
		echo json_encode($data);
		
	}
	public function getListObat(){
		$data['rows']=$this->obat_m->getListObat('rows');
		$data['total']=$this->obat_m->getListObat('total');
		echo json_encode($data);
	}
    public function getKodeObat(){
        $data=$this->resep_m->getIDObat();
		echo json_encode($data);
    }
     public function getIDRegistrasi(){
        $data=$this->resep_m->getIDRegistrasi();
		echo json_encode($data);
    }
	public function simpanResep($id_periksa="", $kode_dokter=""){
		$data=$this->resep_m->simpanResep($id_periksa, $kode_dokter);
		echo json_encode($data);
	}

	public function simpanTambah($id_resep=""){
		$data=$this->resep_m->simpanTambah($id_resep);
		echo json_encode($data);
	}
	
	public function hapusResep(){
		$data=$this->resep_m->hapusResep();
		echo json_encode($data);
	}

	public function hapusTambah(){
		$data=$this->resep_m->hapusTambah();
		echo json_encode($data);
	}
	public function getIDPeriksa(){
        $data=$this->resep_m->getIDPeriksa();
		echo json_encode($data);
    }
    public function getIDObat(){
        $data=$this->resep_m->getIDObat();
		echo json_encode($data);
    }
	public function getIDDokter(){
        $data=$this->resep_m->getIDDokter();
		echo json_encode($data);
    }
    public function formTambah($id_resep=""){
    	$data['id_resep'] = $id_resep;
        $data['data']=$this->resep_m->getIDRegistrasi();
		$this->load->view('transaksi/formTambah', $data);
	}

	public function kodeResep(){
		$data=$this->resep_m->kodeResep();
		echo json_encode($data);
	}
}