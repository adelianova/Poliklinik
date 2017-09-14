	<table id="datagrid-m_masuk" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/masuk/getListMasuk';?>',
		toolbar:'#toolbar1',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="ID_STOCK" width="100" hidden="true" sortable="true">ID STOCK</th>
					<th field="TGL" width="100" sortable="true">TANGGAL MASUK</th>
					<th field="KODE_OBAT" width="100" sortable="true">KODE OBAT</th>
					<th field="NAMA" width="100" sortable="true">NAMA OBAT</th>		
					<th field="SATUAN" width="100" sortable="true">SATUAN</th>
					<th field="HARGA_SATUAN" width="100" sortable="true">HARGA SATUAN</th>
					<th field="QTY" width="100" sortable="true">QUANTITY</th>
					<th field="TOTAL" width="100" sortable="true">TOTAL</th>
					
				</tr>
			</thead>
	</table>

<div id="toolbar1" style='padding:5px;height:25px'>
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
					<a class="easyui-linkbutton" data-options="iconCls:'icon-print'" onClick="cetakLaporan()"  style="color: #fff">CETAK PDF</a>
				</tr>
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="smasuk" class="easyui-searchbox" style="width:250px" 
				searcher="carimasuk" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='nama'>Nama Obat</div>
					<div name='TGL'>Tanggal Masuk</div>
				</div>  
			</div>
		</div>
<script>
	
	
	function carimasuk(value,name){
		
		$('#datagrid-m_masuk').datagrid('load', { "searchKey": name, "searchValue": value });
	}

	function tampilkan() {
		var tgl_awal = $('#tgl_awal').datebox('getValue');
		var tgl_akhir = $('#tgl_akhir').datebox('getValue');

		$('#datagrid-m_masuk').datagrid('load',{"tgl_awal" : tgl_awal, "tgl_akhir" : tgl_akhir});
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

	function cetakLaporan(){
        var tgl_awal = $('#tgl_awal').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        var tgl_akhir = $('#tgl_akhir').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        PopupCenter("http://localhost/poliklinik/index.php/masuk/cetakLaporan/"+tgl_awal+"/"+tgl_akhir+"/");
    }
	
</script>