<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resep_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListResep($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_resep';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		
    	$this->db->select("a.id_resep,a.id_periksa,a.kode_dokter, b.nama_dokter, d.NAMA");
		$this->db->from("tbl_resep a");
		$this->db->join("tbl_m_dokter b","a.kode_dokter = b.kode_dokter");
		$this->db->join("TBL_PERIKSA c","a.id_periksa = c.id_periksa");
		$this->db->join("TBL_M_PASIEN d","c.kode_pasien = d.kode_pasien");
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

	function getListTambah(){
		return $this->db->query(" select ID_OBAT,QTY,DOSIS,ID_DETAIL_RESEP FROM TBL_DETAIL_RESEP")->result_array();

	}
	
	function getKodeResep(){
		return $this->db->query("select dbo.getIDResep() as id_resep")->row_array();
	}
	function getDetailResep(){
		return $this->db->query("select dbo.getIDDetailResep() as id_detail_resep")->row_array();
	}
	function simpanResep($id_periksa="", $kode_dokter=""){
		$edit=$this->input->post('edit');
		$id_resep=$this->input->post('id_resep');
		//$id_periksa=$this->input->post('id_periksa');
		//$kode_dokter=$this->input->post('kode_dokter');

		if($edit==''){
			$data=$this->getKodeResep();
			$arr=array(
				'id_periksa'=>$id_periksa,
				'kode_dokter'=>$kode_dokter,
			);

			$r=$this->db->insert('TBL_RESEP',$arr);		
		}else{
			$arr=array(
				'id_periksa'=>$id_periksa,
				'kode_dokter'=>$kode_dokter,
			);
			$this->db->where("id_resep='".$id_resep."'");
			$r=$this->db->update('TBL_RESEP',$arr);
		
		}
		
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']="Data Resep Berhasil disimpan";
			
		}else{
			$result['error']=true;
			$result['msg']="Data Resep Gagal disimpan";
			
		}
		
		return $result;
	}
	
	function simpanTambah($id_resep=""){
		$edit=$this->input->post('edit');
		$id_detail_resep=$this->input->post('ID_DETAIL_RESEP');
		$id_obat=$this->input->post('ID_OBAT');
		$qty=$this->input->post('QTY');
		$dosis=$this->input->post('DOSIS');

		if($edit==''){
			$data=$this->getDetailResep();
			$arr=array(
				
				'ID_RESEP'=>$id_resep,
				'ID_OBAT'=>$id_obat,
				'QTY'=>$qty,
				'DOSIS'=>$dosis,
			);

			$z=$this->db->insert('TBL_DETAIL_RESEP',$arr);		
		}else{
			$arr=array(
				'ID_OBAT'=>$id_obat,
				'QTY'=>$qty,
				'DOSIS'=>$dosis,
			);
			$this->db->where("id_detail_resep='".$id_detail_resep."'");
			$z=$this->db->update('TBL_DETAIL_RESEP',$arr);
		
		}
		
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']="Data Resep berhasil disimpan";
		}else{
			$result['error']=true;
			$result['msg']="Data Resep gagal disimpan";
	
		}
		return $result;
	}

	function tblResep(){
		//$resep = $this->getKodeResep();
		$data =  $this->db->query("select * FROM TBL_DETAIL_RESEP where ID_RESEP ")->result_array();
		$return = "";
		foreach ($data as $resp) {
			$return .= "<tr>";
				$return .= "<td>{$resp['ID_OBAT']}</td>";
				$return .= "<td>{$resp['QTY']}</td>";
				$return .= "<td>{$resp['DOSIS']}</td>";
			$return .= "</tr>";
		}
		return $return;

	}
	function hapusResep(){
		$id_resep=$this->input->post('id_resep');
		$this->db->where("id_resep='".$id_resep."'");	
		$r=$this->db->delete('tbl_resep');
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
	function hapusTambah(){
		$id_detail_resep=$this->input->post('id_detail_resep');
		$this->db->where("ID_DETAIL_RESEP='".$id_detail_resep."'");	
		$z=$this->db->delete('tbl_detail_resep');
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

	function getIDPeriksa(){
		 return $this->db->query("select a.kode_pasien,a.nama,b.id_periksa FROM TBL_M_PASIEN a JOIN TBL_PERIKSA b ON a.kode_pasien=b.kode_pasien")
		 ->result_array();
	}
    function getIDObat(){
         return $this->db->query(" select id_obat,kode_obat,nama,satuan FROM TBL_M_OBAT")->result_array();
    }
	function getIDDokter(){
         return $this->db->query(" select kode_dokter,nama_dokter FROM TBL_M_DOKTER")->result_array();
    }
	function getIDRegistrasi(){
         return $this->db->query(" select kode_registrasi FROM TBL_PERIKSA")->result_array();
    }
    function kodeResep(){
    	$id_resep=$this->input->post('id_resep');
		 return $this->db->query("select a.ID_OBAT,a.QTY,a.DOSIS,a.ID_DETAIL_RESEP,b.NAMA FROM TBL_DETAIL_RESEP a JOIN TBL_M_OBAT b ON a.ID_OBAT=b.KODE_OBAT where a.id_resep = '".$id_resep."'")->result_array();
    	//return $this->db->query("select * FROM TBL_DETAIL_RESEP where id_resep='".$id_resep."'")->result_array();
    }
}