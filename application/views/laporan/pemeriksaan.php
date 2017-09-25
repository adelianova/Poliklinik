
<table id="datagrid-m_periksa" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/laporan_pemeriksaan/getListLaporanPemeriksaan';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_periksa" width="100" hidden="true" sortable="true" hidden="true">ID</th>
					<th field="kode_pasien" width="100" sortable="true" >KODE PASIEN</th>
					<th field="nama" width="100" sortable="true">NAMA PASIEN</th>
					<th field="tgl_periksa" width="100" sortable="true">TANGGAL PERIKSA</th>		
					<th field="keluhan" width="100" sortable="true">KELUHAN</th>
					<th field="kode_dokter" width="100" sortable="true">KODE DOKTER</th>
					<th field="nama_dokter" width="100" sortable="true">NAMA DOKTER</th>
					
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;float:left;padding-top:-10px;">
				<tr>
					<td class='label_form'>Pilih Tanggal</td>
					<td >
					<input name='tgl_awal' id='tgl_awal' prompt="Dari tanggal" style="padding:3px;width:30%"/>	
					</td>
					<td >
					<input name='tgl_akhir' id='tgl_akhir' prompt="Sampai tanggal" style="padding:3px;width:30%"/>	
					</td>
					<a href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkan();">Tampilkan Data</a>
					<a class="easyui-linkbutton" data-options="iconCls:'icon-print'" onClick="cetakLaporan()"  style="color: #fff">CETAK PDF</a>
				</tr>
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
	function cetakLaporan(){
        var tgl_awal = $('#tgl_awal').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        var tgl_akhir = $('#tgl_akhir').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        PopupCenter("http://localhost/poliklinik/index.php/laporan_pemeriksaan/cetakLaporan/"+tgl_awal+"/"+tgl_akhir,"LAPORAN PEMERIKSAAN","800","400");
    }
	function PopupCenter(url, title, w, h) {
        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }
</script>