<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaksi_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListStock($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_transaksi';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		$this->db->select("a.id_suplier,a.id_stock,a.id_transaksi,convert(varchar(10),a.tgl,105) as tgl,a.no_faktur,a.keterangan, b.nama,c.transaksi");
		$this->db->from("tbl_stock a");
		$this->db->join("TBL_M_SUPPLIER b","a.id_suplier = b.id_suplier");
		$this->db->join("TBL_M_TRANSAKSI c","a.id_transaksi = c.id_transaksi");
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

	function getListDetail($jenis){
    	$id_stock=$this->input->post('id_stock');
		 return $this->db->query("select id_dtl_stock,id_stock,id_obat,qty,harga_satuan,total,convert(varchar(10),tgl_expired,105) as tgl_expired FROM TBL_DETAIL_STOCK where id_stock = '".$id_stock."'")->result_array();
	}


	function getKodeTransaksi(){
		return $this->db->query("select dbo.getIDTransaksi() as id_transaksi")->row_array();
	}

	function getIDStock(){
		return $this->db->query("select dbo.getIDStock() as id_stock")->row_array();
	}

	function getIDDtlStock(){
		return $this->db->query("select dbo.getIDDtlStock() as id_dtl_stock")->row_array();
	}

	function simpanTransaksi(){
		$edit=$this->input->post('edit');
		$id_stock=$this->input->post('id_stock');
		$id_suplier=$this->input->post('id_suplier');
		$id_transaksi=$this->input->post('id_transaksi');
		$tgl=$this->input->post('tgl');
		$no_faktur=$this->input->post('no_faktur');
		$keterangan=$this->input->post('keterangan');
		
		if($edit==""){
			$data=$this->getIDStock();
			$arr=array(
				'id_suplier'=>$id_suplier,
				'id_transaksi'=>$id_transaksi,
				'tgl'=>date('Y-m-d',strtotime($tgl)),
				'no_faktur'=>$no_faktur,
				'keterangan'=>$keterangan,
			);
			$r=$this->db->insert('TBL_STOCK',$arr);
		}else{
			$arr=array(
				'id_suplier'=>$id_suplier,
				'id_transaksi'=>$id_transaksi,
				'tgl'=>date('Y-m-d',strtotime($tgl)),
				'no_faktur'=>$no_faktur,
				'keterangan'=>$keterangan,
			);
			$this->db->where("id_stock='".$id_stock."'");
			$r=$this->db->update('TBL_STOCK',$arr);
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

	function simpanObat($id_stock=""){
		$edit=$this->input->post('edit');
		$id_dtl_stock=$this->input->post('id_dtl_stock');
		$id_obat=$this->input->post('id_obat');
		$qty=$this->input->post('qty');
		$harga_satuan=$this->input->post('harga_satuan');
		$total=$this->input->post('total');
		$tgl_expired=$this->input->post('tgl_expired');
		
		if($edit==''){
			$data=$this->getIDDtlStock();
			$arr=array(
				'id_obat'=>$id_obat,
				'id_stock'=>$id_stock,
				'qty'=>$qty,
				'harga_satuan'=>$harga_satuan,
				'total'=>$total,
				'tgl_expired'=>date('Y-m-d',strtotime($tgl_expired)),
			);
			$r=$this->db->insert('TBL_DETAIL_STOCK',$arr);
		}else{
			$arr=array(
				'id_obat'=>$id_obat,
				'id_stock'=>$id_stock,
				'qty'=>$qty,
				'harga_satuan'=>$harga_satuan,
				'total'=>$total,
				'tgl_expired'=>date('Y-m-d',strtotime($tgl_expired)),
			);
			$this->db->where("id_dtl_stock='".$id_dtl_stock."'");
			$r=$this->db->update('TBL_DETAIL_STOCK',$arr);
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
	
	
	function removeTransaksi(){
		$id_stock=$this->input->post('id_stock');
		$this->db->where("id_stock='".$id_stock."'");	
		$r=$this->db->delete('tbl_stock');
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
	
	function removeTambah(){
		$id_dtl_stock=$this->input->post('id_dtl_stock');
		$this->db->where("id_dtl_stock='".$id_dtl_stock."'");	
		$r=$this->db->delete('TBL_DETAIL_STOCK');
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

	function getListIDTransaksi(){
         return $this->db->query(" select ID_TRANSAKSI,TRANSAKSI FROM TBL_M_TRANSAKSI")->result_array();
    }
    function getIDSuplier(){
         return $this->db->query(" select * FROM TBL_M_SUPPLIER")->result_array();
    }

    function getHanyaIDStock(){
         return $this->db->query(" select id_stock FROM TBL_STOCK")->result_array();
    }
}	