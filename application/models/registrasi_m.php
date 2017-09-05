<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registrasi_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListRegistrasi($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode_registrasi';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		$this->db->select("a.kode_registrasi,a.kode_pasien,a.keluhan, b.status");
		$this->db->from("tbl_periksa a");
		$this->db->join("TBL_M_STATUS_REGISTRASI b","a.id_status_registrasi = b.id_status_registrasi");
		
    	/*$this->db->select(" kode_registrasi,kode_pasien,keluhan,id_status_registrasi ");
		$this->db->from("tbl_periksa");*/
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
	
	function getKodeRegistrasi(){
		return $this->db->query("select dbo.getIDRegistrasi() as kode_registrasi")->row_array();
	}
	
	function simpanRegistrasi(){
		$edit=$this->input->post('edit');
		$kode_registrasi=$this->input->post('kode_registrasi');
		$kode_pasien=$this->input->post('kode_pasien');
		$keluhan=$this->input->post('keluhan');
		$id_status_registrasi=$this->input->post('id_status_registrasi');

		if($edit==''){
			$data=$this->getKodeRegistrasi();
			$arr=array(
				'kode_registrasi'=>$data['kode_registrasi'],
				'kode_pasien'=>$kode_pasien,
				'keluhan'=>$keluhan,
				'id_status_registrasi'=>$id_status_registrasi
			);
			
			$r=$this->db->insert('tbl_periksa',$arr);
			
		}else{
			$arr=array(
				'kode_pasien'=>$kode_pasien,
				'keluhan'=>$keluhan,
				'id_status_registrasi'=>$id_status_registrasi
			);
			$this->db->where("kode_registrasi='".$kode_registrasi."'");
			$r=$this->db->update('tbl_periksa',$arr);
		
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
	
	
	function hapusRegistrasi(){
		$kode_registrasi=$this->input->post('kode_registrasi');
		$this->db->where("kode_registrasi='".$kode_registrasi."'");	
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
	
	function getStatus(){
        return $this->db->query(" select id_status_registrasi, status FROM TBL_M_STATUS_REGISTRASI")->result_array();
    }
	function getIDPasien(){
         return $this->db->query(" select kode_pasien,nama FROM TBL_M_PASIEN")->result_array();
    }
	
}