<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_m extends MY_Model {
    public $limit;
	public $offset;
	
    function __construct(){
        parent::__construct();
    }
	
	
	
    function cekLogin($username,$password) {
		$query=$this->db->query(
		"select b.nip,
		 b.full_name as nama,
         b.passwd as password
         from v_employee_all b
		 where b.nip='".$username."' and b.passwd='".$password."'"
		)->row();
		
        return $query;
    }

    function getKontrak($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_kontrak';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		
    	$this->db->select("a.id_kontrak,a.kode_dokter,a.nomor,convert(varchar(10),a.mulai_kontrak,105) as mulai_kontrak,convert(varchar(10),a.selesai_kontrak,105) as selesai_kontrak,a.keterangan,b.nama_dokter,
			DateDiff (MONTH,GETDATE(),a.SELESAI_KONTRAK) as 'sisa_kontrak'");
		$this->db->from("tbl_kontrak_dokter a");
		$this->db->join("TBL_M_DOKTER b","a.kode_dokter = b.kode_dokter");
		$this->db->where("DateDiff (MONTH,GETDATE(),a.SELESAI_KONTRAK)<='2'");

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

	function getExpired($jenis){
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$this->limit = $rows;
		$this->offset = $offset;
		 $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_dtl_stock';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';

    	$this->db->select("a.id_dtl_stock,a.id_stock,a.id_obat,a.qty,a.tgl_expired,DATEDIFF (MONTH,GETDATE(),a.tgl_expired) as sisa_waktu,b.nama");
		$this->db->from("TBL_DETAIL_STOCK a");
		$this->db->join("TBL_M_OBAT b","b.id_obat = a.id_obat");
		$this->db->where("DATEDIFF (MONTH,GETDATE(),a.tgl_expired) <= '2'");

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

    /*function getKontrak(){
    	return $this->db->query("
		select a.id_kontrak,a.kode_dokter,a.nomor,convert(varchar(10),a.mulai_kontrak,105) as mulai_kontrak,convert(varchar(10),a.selesai_kontrak,105) as selesai_kontrak,a.keterangan,b.nama_dokter,
		DateDiff (MONTH,GETDATE(),a.SELESAI_KONTRAK) as 'sisa_kontrak' 
		from tbl_kontrak_dokter a 
		join TBL_M_DOKTER b on a.kode_dokter = b.kode_dokter 
		where DateDiff (MONTH,GETDATE(),a.SELESAI_KONTRAK)<='2'
		")->row_array();
    }
	*/
	function getDefaultMenu(){
		return '
				[{
					"id":11,
					"text":"Master",
					"state":"open",
					"children":[{
						"id":111,
						"text":"Dokter",
						"url":"admin_master_dokter",
						"akses":true
						
					},{
						"id":112,
						"text":"Surat Kontrak Dokter",
						"url":"admin_master_kontrak",
						"akses":true
						
					},{
						"id":113,
						"text":"Obat",
						"url":"admin_master_obat"	,
						"akses":true
					},{
						"id":114,
						"text":"Pasien",
						"url":"admin_master_pasien",
						"akses":true
						
					},{
						"id":115,
						"text":"Supplier",
						"url":"admin_master_supplier",
						"akses":true
						
					},{
						"id":116,
						"text":"Penyakit",
						"url":"admin_master_penyakit",
						"akses":true
					}
					]
					},{
					"id":12,
					"text":"Transaksi",
					"state":"open",
					"children":[{
						"id":121,
						"text":"Registrasi",
						"url":"transaksi_registrasi",
						"akses":true
					},{
						"id":122,
						"text":"Pemeriksaan",
						"url":"transaksi_periksa",
						"akses":true
					},{
						"id":123,
						"text":"Resep",
						"url":"transaksi_resep",
						"akses":true
					},{
						"id":124,
						"text":"Obat",
						"state":"open",
						"children":[{
							"id":1242,
							"text":"Stok Obat",
							"url":"transaksi_obat",
							"akses":true
						},{
							"id":1241,
							"text":"Retur Obat",
							"url":"transaksi_retur",
							"akses":true
					}]
					}]
					
					},
					{
					"id":13,
					"text":"Laporan",
					"state":"open",
					"children":
					[{
						"id":131,
						"text":"Stock",
						"state":"open",
						"children":[{
							"id":1311,
							"text":"Masuk",
							"url":"laporan_masuk",
							"akses":true
						},{
							"id":1312,
							"text":"Resep",
							"url":"laporan_keluar",
							"akses":true
							
						},{
							"id":1313,
							"text":"Retur",
							"url":"laporan_retur",
							"akses":true
					}]
					},
					{
						"id":14,
						"text":"Pemeriksaan",
						"state":"open",
						"children":[{
							"id":141,
							"text":"Pegawai",
							"url":"laporan_pemeriksaan",
							"akses":true
						},{
							"id":142,
							"text":"Non Pegawai",
							"url":"laporan_nonpegawai",
							"akses":true
							
						}]						
					},{
						"id":15,
						"text":"Stok Obat Bulanan",
						"url":"laporan_rekab",
						"akses":true
					}]
				}]
					

		';
	}
	
	
	
	
}