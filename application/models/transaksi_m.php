<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaksi_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListTransaksi($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_transaksi';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		
    	$this->db->select(" id_transaksi,transaksi,id_resep ");
		$this->db->from("TBL_M_TRANSAKSI");
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
	
	function getListResepTransaksi($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_resep';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		
    	$this->db->select("ID_RESEP,ID_PERIKSA,KODE_DOKTER");
		$this->db->from("tbl_resep");
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
	

	function getKodeTransaksi(){
		return $this->db->query("select dbo.getIDTransaksi() as id_transaksi")->row_array();
	}
	
	function simpanTransaksi(){
		$edit=$this->input->post('edit');
		$id_transaksi=$this->input->post('id_transaksi');
		$transaksi=$this->input->post('transaksi');
		$id_resep=$this->input->post('id_resep');
		
		if($edit==''){
			$data=$this->getKodeTransaksi();
			$arr=array(
				'transaksi'=>$transaksi,
				'id_resep'=>$id_resep,
			);
			$r=$this->db->insert('TBL_M_TRANSAKSI',$arr);
		}else{
			$arr=array(
				'transaksi'=>$transaksi,
				'id_resep'=>$id_resep,
			);
			$this->db->where("id_transaksi='".$id_transaksi."'");
			$r=$this->db->update('TBL_M_TRANSAKSI',$arr);
		}
		$result=array();
		if($this->db->affected_rows()>0){
			$result['error']=false;
			$result['msg']="Data berhasil disimpan";
		}else{
			$result['error']=true;
			$result['msg']="Data gagal disimpan";
		}
		return $id_resep;
	}
	
	
	function hapusTransaksi(){
		$id_transaksi=$this->input->post('id_transaksi');
		$this->db->where("id_transaksi='".$id_transaksi."'");	
		$r=$this->db->delete('tbl_m_transaksi');
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
	
}