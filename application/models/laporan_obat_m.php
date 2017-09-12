<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_obat_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListLaporanObat($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_obat';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		$tgl_awal=isset($_POST['tgl_awal']) ? strval($_POST['tgl_awal']) : '';
		$tgl_akhir=isset($_POST['tgl_akhir']) ? strval($_POST['tgl_akhir']) : '';
		$this->db->select("a.id_obat,a.nama,a.tgl,a.qty as qty_masuk, b.qty as qty_keluar");
		$this->db->from("tbl_detail_stock a");
		$this->db->join("tbl_detail_resep b","a.id_obat = b.id_obat");
		if($searchKey<>''){
		$this->db->where($searchKey." like '%".$searchValue."%'");	
		}

		if($tgl_awal<>''&&$tgl_akhir<>''){
			$this->db->where("tgl between '".$tgl_awal."' AND '".$tgl_akhir."'");
		}


		$this->db->order_by($sort,$order);
		
		if($jenis=='total'){
		$hasil=$this->db->get ('')->num_rows();
		}else{
		$hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
		}
		
	    return $hasil;	
	}
}