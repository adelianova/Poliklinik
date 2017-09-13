
<table id="datagrid-m_periksa" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/laporan_obat/getListLaporanObat';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="kode_obat" width="100" sortable="true">KODE OBAT</th>
					<th field="nama" width="100" sortable="true">NAMA OBAT</th>
					<th field="qty_masuk" width="100" sortable="true">MASUK</th>		
					<th field="qty_keluar" width="100" sortable="true">KELUAR</th>
					<th field="tgl" width="100" sortable="true">TANGGAL</th>
					
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;float:left;padding-top:-10px;">
				<tr>
					<td class='label_form'>Pilih Tanggal</td>
					<td >
					<input name='tgl_awal' id='tgl_awal' prompt="Dari tanggal" style="padding:3px;width:40%"/>	
					</td>
					<td >
					<input name='tgl_akhir' id='tgl_akhir' prompt="Sampai tanggal" style="padding:3px;width:40%"/>	
					</td>
					<a href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkan();">Tampilkan Data</a>

				</tr>
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="speriksa" class="easyui-searchbox" style="width:250px" 
				searcher="cariperiksa" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='id_periksa'>ID</div>
					<div name='nama'>NAMA PASIEN</div>
					<div name='nama_dokter'>NAMA DOKTER</div>
				</div>  
			</div>
		</div>
<script>
	
	
	function cariperiksa(value,name){
		
		$('#datagrid-m_periksa').datagrid('load', { "searchKey": name, "searchValue": value });
	}

	function tampilkan() {
		var tgl_awal = $('#tgl_awal').datebox('getValue');
		var tgl_akhir = $('#tgl_akhir').datebox('getValue');

		$('#datagrid-m_periksa').datagrid('load',{"tgl_awal" : tgl_awal, "tgl_akhir" : tgl_akhir});
	}

	$('#tgl_awal').datebox({
		dateFormat:'yy-MM-dd',
		formatter:function(date){
			var y = date.getFullYear();
			var m = date.getMonth()+1;
			var d = date.getDate();

			return y+'-'+String((m<10?('0'+m):m))+'-'+String((d<10?('0'+d):d));
		},
		parser:function(s){

		}
	});

	$('#tgl_akhir').datebox({
		dateFormat:'yy-MM-dd',
		formatter:function(date){
			var y = date.getFullYear();
			var m = date.getMonth()+1;
			var d = date.getDate	();

			return y+'-'+String((m<10?('0'+m):m))+'-'+String((d<10?('0'+d):d));
		},
		parser:function(s){
			
		}
	});
	
</script>