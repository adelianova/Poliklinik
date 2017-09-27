<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Retur_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListRetur($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_retur';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		$tgl_awal=isset($_POST['tgl_awal']) ? strval($_POST['tgl_awal']) : '';
		$tgl_akhir=isset($_POST['tgl_akhir']) ? strval($_POST['tgl_akhir']) : '';
		$this->db->select("a.id_retur,a.no_retur,convert(varchar(10),a.tgl,105) as tgl,a.petugas, b.nip,b.full_name as nama");
		$this->db->from("tbl_retur a");
		$this->db->join("v_employee_all b","a.petugas=b.nip");

		if($searchKey<>''){
		$this->db->where($searchKey." like '%".$searchValue."%'");	
		}else if($tgl_awal<>''&&$tgl_akhir<>''){
			$this->db->where("tgl between '".$tgl_awal."' AND '".$tgl_akhir."'");
		}
		else {
			$this->db->where("convert(varchar(10),a.tgl,112)= '".date('Ymd')."'");
		}
		
		$this->db->order_by($sort,$order);
		
		if($jenis=='total'){
		$hasil=$this->db->get ('')->num_rows();
		}else{
		$hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
		}
		
	    return $hasil;	
	}

	function getListDetail(){
    	$id_retur=$this->input->post('id_retur');
		return $this->db->query("select id_dtl_retur,id_retur,id_dtl_stock,qty,keterangan FROM TBL_DETAIL_RETUR where id_retur = '".$id_retur."'")->result_array();
	}
	function getIDRetur(){
		return $this->db->query("select dbo.getIDRetur() as id_retur")->row_array();
	}

	function getIDDtlRetur(){
		return $this->db->query("select dbo.getIDDtlRetur() as id_dtl_retur")->row_array();
	}

	function simpanRetur(){
		$edit=$this->input->post('edit');
		$id_retur=$this->input->post('id_retur');
		$no_retur=$this->input->post('no_retur');
		$tgl=$this->input->post('tgl');
		$petugas=$this->input->post('petugas');
		
		if($edit==""){
			$data=$this->getIDRetur();
			$arr=array(
				'no_retur'=>$no_retur,
				'tgl'=>date('Y-m-d',strtotime($tgl)),
				'petugas'=>$petugas,
			);
			$r=$this->db->insert('TBL_RETUR',$arr);
		}else{
			$arr=array(
				'no_retur'=>$no_retur,
				'tgl'=>date('Y-m-d',strtotime($tgl)),
				'petugas'=>$petugas,
			);
			$this->db->where("id_retur='".$id_retur."'");
			$r=$this->db->update('TBL_RETUR',$arr);
		}
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']="Data berhasil disimpan";
		}else{
			$result['error']=true;
			$result['msg']="Data gagal disimpan";
		}
		return $result;
	}

	function simpanTambahRetur($id_retur=""){
		$edit=$this->input->post('edit');
		$id_dtl_retur=$this->input->post('id_dtl_retur');
		$id_dtl_stock=$this->input->post('id_dtl_stock');
		$qty=$this->input->post('qty');
		$keterangan=$this->input->post('keterangan');
		
		if($edit==''){
			$data=$this->getIDDtlRetur();
			$arr=array(
				'id_retur'=>$id_retur,
				'id_dtl_stock'=>$id_dtl_stock,
				'qty'=>$qty,
				'keterangan'=>$keterangan,
			);
			$r=$this->db->insert('TBL_DETAIL_RETUR',$arr);
		}else{
			$arr=array(
				'id_dtl_stock'=>$id_dtl_stock,
				'qty'=>$qty,
				'keterangan'=>$keterangan,
			);
			$this->db->where("id_dtl_retur='".$id_dtl_retur."'");
			$r=$this->db->update('TBL_DETAIL_RETUR',$arr);
		}
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']="Data berhasil disimpan";
		}else{
			$result['error']=true;
			$result['msg']="Data gagal disimpan";
		}
		return $result;
	}
	
	
	function removeRetur(){
		$id_retur=$this->input->post('id_retur');
		$this->db->where("id_retur='".$id_retur."'");	
		$r=$this->db->delete('tbl_retur');
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']='Data berhasil dihapus';
		}else{
			$result['error']=true;
			$result['msg']='Data gagal dihapus';
		}
		return $result;
	}
	
	function removeTambahRetur(){
		$id_dtl_retur=$this->input->post('id_dtl_retur');
		$this->db->where("id_dtl_retur='".$id_dtl_retur."'");	
		$r=$this->db->delete('TBL_DETAIL_RETUR');
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']='Data berhasil dihapus';
		}else{
			$result['error']=true;
			$result['msg']='Data gagal dihapus';
		}
		return $result;
	}

	function getDtlStock(){
         return $this->db->query("select b.id_dtl_stock,convert(varchar(10),b.tgl_expired,105) as tgl_expired, a.nama FROM TBL_M_OBAT a inner join TBL_DETAIL_STOCK b on b.ID_OBAT=a.ID_OBAT")->result_array();
    }
    function getPetugas(){
    	return $this->db->query("select b.nip, b.full_name from v_employee_all b ")->result_array();
    }
}