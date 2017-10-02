<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_pemeriksaan extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('laporan_pemeriksaan_m'));
    }    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	public function getListLaporanPemeriksaan(){
		$data['rows']=$this->laporan_pemeriksaan_m->getListLaporanPemeriksaan('rows');
		$data['total']=$this->laporan_pemeriksaan_m->getListLaporanPemeriksaan('total');
		echo json_encode($data);
	}	
	public function cetakLaporan($tgl_awal="",$tgl_akhir="")
	{
		$TGL_MULAI = @str_replace("~", "/", $tgl_awal);
		$TGL_SELESAI = @str_replace("~", "/", $tgl_akhir);
		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-L');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">PDAM Malang - Laporan Pemeriksaan, PAGE {PAGENO} dari {nbpg}</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>';
		if($TGL_MULAI=='' ){
		$html.="
		<div style='font-size:20px; font-weight:bold; text-align:center'>Laporan Pemeriksaan <br/> Periode(".date('d-m-Y')." sampai ".date('d-m-Y').")</div>"; 			
		}else{
		$html.="
		<div style='font-size:20px; font-weight:bold; text-align:center'>Laporan Pemeriksaan <br/> Periode(".$tgl_awal." sampai ".$tgl_akhir.")</div>";
 		}
		$html .='
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
		  <tr>
			<td width="10%" align="center"><strong>Kode Pasien</strong></td>
			<td width="10%" align="center"><strong>Nama Pasien</strong></td>
			<td width="10%" align="center"><strong>Tanggal Periksa</strong></td>
			<td width="8%" align="center"><strong>Keluhan</strong></td>
			<td width="10%" align="center"><strong>Kode Dokter</strong></td>
			<td width="10%" align="center"><strong>Nama Dokter</strong></td>
		  </tr>';

		$no=1;
		$data = $this->laporan_pemeriksaan_m->getLaporan($TGL_MULAI,$TGL_SELESAI);
		foreach($data as $row){
		$html .='  
		  <tr>
			<td>'.$row->kode_pasien.'</td>
			<td>'.$row->nama.'</td>
			<td>'.$row->tgl_periksa.'</td>
			<td>'.$row->keluhan.'</td>
			<td>'.$row->kode_dokter.'</td>
			<td>'.$row->nama_dokter.'</td>
		</tr>';
		$no++;
		}
		$html .= '</table>';
		
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		//echo $html;
	}			
}