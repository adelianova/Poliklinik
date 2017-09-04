<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dokter_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListDokter($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode_dokter';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		
    	$this->db->select(" kode_dokter,nama_dokter,alamat_dokter,telp,email,spesialisasi,keterangan ");
		$this->db->from("tbl_m_dokter");
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
	
	function getKodeDokter(){
		return $this->db->query("select dbo.getIDDokter() as kode_dokter")->row_array();
	}
	
	function simpanDokter(){
		$edit=$this->input->post('edit');
		$kode_dokter=$this->input->post('kode_dokter');
		$nama=$this->input->post('nama_dokter');
		$alamat=$this->input->post('alamat_dokter');
		$telp=$this->input->post('telp');
		$email=$this->input->post('email');
		$spesialisasi=$this->input->post('spesialisasi');
		$keterangan=$this->input->post('keterangan');
		
		if($edit==''){
			$data=$this->getKodeDokter();
			$arr=array(
				'kode_dokter'=>$data['kode_dokter'],
				'nama_dokter'=>$nama,
				'alamat_dokter'=>$alamat,
				'telp'=>$telp,
				'email'=>$email,
				'spesialisasi'=>$spesialisasi,
				'keterangan'=>$keterangan
			);
			
			$r=$this->db->insert('tbl_m_dokter',$arr);
			
		}else{
			$arr=array(
				'nama_dokter'=>$nama,
				'alamat_dokter'=>$alamat,
				'telp'=>$telp,
				'email'=>$email,
				'spesialisasi'=>$spesialisasi,
				'keterangan'=>$keterangan
			);
			$this->db->where("kode_dokter='".$kode_dokter."'");
			$r=$this->db->update('tbl_m_dokter',$arr);
		
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
	
	
	function hapusDokter(){
		$kode_dokter=$this->input->post('kode_dokter');
		$this->db->where("kode_dokter='".$kode_dokter."'");	
		$r=$this->db->delete('tbl_m_dokter');
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
	
	
	
	
}