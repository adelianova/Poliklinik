<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Keluar_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	function getListKeluar($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'NAMA';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		$tgl_awal=isset($_POST['tgl_awal']) ? strval($_POST['tgl_awal']) : '';
		$tgl_akhir=isset($_POST['tgl_akhir']) ? strval($_POST['tgl_akhir']) : '';
		$this->db->select("a.kode_obat,a.nama,a.satuan,b.qty,c.id_resep,convert(varchar(10),d.tgl_periksa,105) as tgl_periksa");
		$this->db->from("TBL_M_OBAT a");
		$this->db->join("TBL_DETAIL_RESEP b","a.kode_obat = b.kode_obat ");
		$this->db->join("TBL_RESEP c","b.id_resep = c.id_resep");
		$this->db->join("TBL_PERIKSA d","c.id_periksa = d.id_periksa");
		if($searchKey<>''){
		$this->db->where($searchKey." like '%".$searchValue."%'");	
		}

		if($tgl_awal<>''&&$tgl_akhir<>''){
			$this->db->where("tgl_periksa between '".$tgl_awal."' AND '".$tgl_akhir."'");
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