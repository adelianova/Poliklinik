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
							"id":1241,
							"text":"Retur Obat",
							"url":"transaksi_retur",
							"akses":true
						},{
							"id":1242,
							"text":"Stok Obat",
							"url":"transaksi_obat",
							"akses":true
					}]
					}]
					
					},
					{
					"id":13,
					"text":"Laporan",
					"state":"open",
					"children":[{
						"id":13,
						"text":"Stock",
						"state":"open",
						"children":[{
							"id":131,
							"text":"Masuk",
							"url":"laporan_masuk",
							"akses":true
						},{
							"id":132,
							"text":"Resep",
							"url":"laporan_keluar",
							"akses":true
							
						},{
							"id":132,
							"text":"Retur",
							"url":"laporan_retur",
							"akses":true
							
						}]
					},{
						"id":132,
						"text":"Pemeriksaan",
						"url":"laporan_pemeriksaan",
						"akses":true
						
					}]
					}
					
					
					]
					

		';
	}
	
	
	
	
}