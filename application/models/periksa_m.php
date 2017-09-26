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
		$tgl_awal=isset($_POST['tgl_awal']) ? strval($_POST['tgl_awal']) : '';
		$tgl_akhir=isset($_POST['tgl_akhir']) ? strval($_POST['tgl_akhir']) : '';
		$this->db->select("a.id_periksa,a.kode_registrasi,a.kode_dokter,a.kode_pasien,a.id_penyakit,a.kode_penyakit,convert(varchar(10),a.tgl_periksa,105) as tgl_periksa,a.keluhan,a.diagnosa, b.nama_dokter,c.nama,d.penyakit");
		$this->db->from("TBL_PERIKSA a");
		$this->db->join("TBL_M_DOKTER b","a.kode_dokter = b.kode_dokter");
		$this->db->join("TBL_M_PASIEN c","a.kode_pasien = c.kode_pasien");
		$this->db->join("TBL_M_PENYAKIT d","a.kode_penyakit = d.kode_penyakit");
		if($searchKey<>''){
		$this->db->where($searchKey." like '%".$searchValue."%'");	
		}else if($tgl_awal<>''&&$tgl_akhir<>''){
			$this->db->where("tgl_periksa between '".$tgl_awal."' AND '".$tgl_akhir."'");
		}
		else {
			$this->db->where("convert(varchar(10),a.tgl_periksa,112)= '".date('Ymd')."'");
		}

		
		$this->db->order_by($sort,$order);
		
		if($jenis=='total'){
		$hasil=$this->db->get ('')->num_rows();
		}else{
		$hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
		}
		
	    return $hasil;	
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
			$arr=array(
				'kode_dokter'=>$kode_dokter,
				'kode_pasien'=>$kode_pasien,
				'id_penyakit'=>$id_penyakit,
				'kode_penyakit'=>$kode_penyakit,
				'tgl_periksa'=>date('Y-m-d',strtotime($tgl_periksa)),
				'diagnosa'=>$diagnosa,
				'id_status_registrasi'=>$id_status_registrasi
			);
			$this->db->where("id_periksa='".$id_periksa."'");
			$r=$this->db->update('TBL_PERIKSA',$arr);
			
		}else{
			$arr=array(
				'kode_dokter'=>$kode_dokter,
				'kode_pasien'=>$kode_pasien,
				'id_penyakit'=>$id_penyakit,
				'kode_penyakit'=>$kode_penyakit,
				'tgl_periksa'=>date('Y-m-d',strtotime($tgl_periksa)),
				'diagnosa'=>$diagnosa,
				'id_status_registrasi'=>$id_status_registrasi
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
  	function getIDPeriksa(){
		 return $this->db->query("select a.kode_pasien,a.nama,b.id_periksa FROM TBL_M_PASIEN a JOIN TBL_PERIKSA b ON a.kode_pasien=b.kode_pasien where kode_dokter is null (select id_periksa from TBL_PERIKSA)")
		 ->result_array();
	}
}