<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class stock_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }

function getListStock($ini){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_DTL_STOCK';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		
    	$this->db->select(" ID_DTL_STOCK,ID_STOCK,ID_OBAT,QTY,HARGA_SATUAN,TOTAL,TGL_EXPIRED ");
		$this->db->from("TBL_DETAIL_STOCK");
		if($searchKey<>''){
		$this->db->where($searchKey." like '%".$searchValue."%'");	
		}
		$this->db->order_by($sort,$order);
		if($ini=='total'){
		$hasil=$this->db->get ('')->num_rows();
		}else{
		$hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
		}
	    return $hasil;	
	}
}