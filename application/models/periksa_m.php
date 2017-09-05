<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Periksa_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListPeriksa($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_periksa';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		
    	$this->db->select("id_periksa,kode_registrasi,kode_dokter,kode_pasien,id_penyakit,kode_penyakit,convert(varchar(10),tgl_periksa,105) as tgl_periksa,keluhan,diagnosa ");
		$this->db->from("tbl_periksa");
		if($searchKey<>''){
		$this->db->where($searchKey." like '%".$searchValue."%'");	
		}
		
		$this->db->order_by($sort,$order);
		
		if($jenis=='total'){
		$hasil=$this->db->get ('')->num_rows();
		}else{
		$hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
		}
		
	    return $hasil;	
	}
	
	function getKodePeriksa(){
		return $this->db->query("select dbo.getIDPeriksa() as id_periksa")->row_array();
	}
	
	function simpanPeriksa(){
		$edit=$this->input->post('edit');
		$id_periksa=$this->input->post('id_periksa');
		$kode_dokter=$this->input->post('kode_dokter');
		$kode_pasien=$this->input->post('kode_pasien');
		$id_penyakit=$this->input->post('id_penyakit');
		$kode_penyakit=$this->input->post('kode_penyakit');
		$tgl_periksa=$this->input->post('tgl_periksa');
		$keluhan=$this->input->post('keluhan');
		$diagnosa=$this->input->post('diagnosa');
		
		if($edit==''){
			$data=$this->getKodePeriksa();
			$arr=array(
				'kode_dokter'=>$kode_dokter,
				'kode_pasien'=>$kode_pasien,
				'id_penyakit'=>$id_penyakit,
				'kode_penyakit'=>$kode_penyakit,
				'tgl_periksa'=>date('Y-m-d',strtotime($tgl_periksa)),
				'diagnosa'=>$diagnosa
			);
			
			$r=$this->db->insert('TBL_PERIKSA',$arr);
			
		}else{
			$arr=array(
				'kode_dokter'=>$kode_dokter,
				'kode_pasien'=>$kode_pasien,
				'id_penyakit'=>$id_penyakit,
				'kode_penyakit'=>$kode_penyakit,
				'tgl_periksa'=>date('Y-m-d',strtotime($tgl_periksa)),
				'diagnosa'=>$diagnosa
			);
			$this->db->where("id_periksa='".$id_periksa."'");
			$r=$this->db->update('TBL_PERIKSA',$arr);
		
		}
		
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']="Data berhasil disimpan";
		}else{
			$result['error']=true;
			$result['msg']="Data gagal berhasil disimpan";
	
		}
		
		return $result;
	}
	
	
	function hapusPeriksa(){
		$id_periksa=$this->input->post('id_periksa');
		$this->db->where("id_periksa='".$id_periksa."'");	
		$r=$this->db->delete('tbl_periksa');
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']='Data berhasil dihapus';
		}else{
			$result['error']=true;
			$result['msg']='Data gagal berhasil dihapus';
		
		}
		
		return $result;
	}
	
	
	function getKodePasien(){
        return $this->db->query(" select kode_pasien,nama FROM TBL_M_PASIEN")->result_array();
    }
    function getKodeDokter(){
        return $this->db->query(" select kode_dokter,nama_dokter FROM TBL_M_DOKTER")->result_array();
    }
    function getKodePenyakit(){
        return $this->db->query(" select kode_penyakit,penyakit FROM TBL_M_PENYAKIT")->result_array();
    }
    function getIDPenyakit(){
        return $this->db->query(" select id_penyakit,penyakit FROM TBL_M_PENYAKIT")->result_array();
    }
}