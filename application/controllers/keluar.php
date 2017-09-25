<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Keluar extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        $this->data->metadata = $this->template->get_metadata();
		$this->data->judul=$this->template->get_judul();
		$this->load->model(array('keluar_m'));
    }    
    public function index() {

		if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
		redirect(site_url('main'));
    }
	public function getListKeluar(){
		$data['rows']=$this->keluar_m->getListKeluar('rows');
		$data['total']=$this->keluar_m->getListKeluar('total');
		echo json_encode($data);
	}
	public function cetakLaporan($tgl_awal="",$tgl_akhir="")
	{
		$tgl_awal = @str_replace("~", "/", $tgl_awal);
		$tgl_akhir = @str_replace("~", "/", $tgl_akhir);
		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-L');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">PDAM Malang - Laporan Obat Keluar, PAGE {PAGENO} dari {nbpg}</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>
		<div style="font-size:20px; font-weight:bold; text-align:center">Laporan Obat Keluar</div>';
		$html .='
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
		  <tr>
			<td width="10%" align="center"><strong>Kode Obat</strong></td>
			<td width="10%" align="center"><strong>Nama Obat</strong></td>
			<td width="10%" align="center"><strong>Satuan</strong></td>
			<td width="8%" align="center"><strong>Jumlah</strong></td>
			<td width="10%" align="center"><strong>ID Periksa</strong></td>
			<td width="10%" align="center"><strong>Tanggal Keluar</strong></td>
		  </tr>';

		$no=1;
		$data = $this->keluar_m->getLaporan($TGL_MULAI,$TGL_SELESAI);
		foreach($data as $row){
		$html .='  
		  <tr>
			<td>'.$row->kode_obat.'</td>
			<td>'.$row->nama.'</td>
			<td>'.$row->satuan.'</td>
			<td>'.$row->qty.'</td>
			<td>'.$row->id_periksa.'</td>
			<td>'.$row->tgl_periksa.'</td>
		</tr>';
		$no++;
		}
		$html .= '</table>';
		
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		//echo $html;
	}			
}