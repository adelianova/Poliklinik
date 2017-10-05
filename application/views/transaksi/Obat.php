<table id="datagrid-m_transaksi" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/transaksi/getListStock';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_stock" width="100" sortable="true" hidden="true">ID STOCK</th>
					<th field="nama" width="100" sortable="true">SUPLIER</th>
					<th field="transaksi" width="100" sortable="true">TRANSAKSI</th>
					<th field="tgl" width="100" sortable="true">TANGGAL</th>
					<th field="no_faktur" width="100" sortable="true">NO FAKTUR</th>
					<th field="keterangan" width="100" sortable="true">KETERANGAN</th>
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addTransaksi()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editTransaksi()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeTransaksi()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;padding-top:-10px;">
				<tr>
					<td >
					<input name='tgl_awal' id='tgl_awal' class='easyui-datebox' prompt="Dari tanggal" style="padding:3px;width:40%"/>	
					</td>
					<td >
					<input name='tgl_akhir' id='tgl_akhir' class='easyui-datebox' prompt="Sampai tanggal" style="padding:3px;width:40%"/>	
					</td>
					<a href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkan();">Tampilkan Data</a>
				</tr>
				</tr>
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="stransaksi" class="easyui-searchbox" style="width:250px" 
				searcher="cariTransaksi" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px">
					<div name='nama'>Suplier</div>
					<div name='transaksi'>Transaksi</div>
				</div>  
			</div>
		</div>
		<div id="dialog-m_transaksi" class="easyui-dialog" style="width:570px; height:500px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
		</div>

		<!-- <div id="dialog-m_detail" class="easyui-dialog" style="width:420px; height:270px; padding: 10px 20px" 
		closed="true" buttons="#obat-buttons" iconCls="icon-user">
		</div> -->

		
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpanTransaksi();">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_transaksi').dialog('close');">Batal</a>
	</div>
		
<<script>
	
	
	function cariTransaksi(value,name){
		
		$('#datagrid-m_transaksi').datagrid('load', { "searchKey": name, "searchValue": value });
	}
	
	function addTransaksi(){
		$('#dialog-m_transaksi').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/transaksi/formObat',
			title:'Tambah Transaksi',
			onLoad:function(){
				
				$('#form_obat').form('clear');
				$('#form_obat #edit').val('');
				$('#panelGridStok').hide();
			}
			});
	}
	
	function editTransaksi(){
		
        var row = $('#datagrid-m_transaksi').datagrid('getSelected');
        console.log(row);
		if(row){
		
		$('#dialog-m_transaksi').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/transaksi/formObat',
			title:'Edit Transaksi',
			onLoad:function(){
				
				
				$('#form_obat').form('clear');
				$('#form_obat #edit').val('1');
				$('#form_obat').form('load',row);	
				$('#datagrid-m_detail').datagrid('load',{id_stock:row.id_stock});
				
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
		
	}
	
	function simpanTransaksi(){
		$.messager.progress({
                title:'',
                msg:'Simpan Transaksi...',
				text:''
         });
			
		$('#form_obat').form('submit',{
			url: '<?php echo site_url('transaksi/simpanTransaksi'); ?>',
			onSubmit: function(){ 
				var isValid = $(this).form('validate');
				if (!isValid){
					$.messager.progress('close');
					return $(this).form('validate');
				}
			},
			success: function(result){
				$.messager.progress('close');
				var result = eval('('+result+')');
					if(result.error){
						$.messager.alert('INFO',result.msg,'info');
					
					}else{
						$('#dialog-m_transaksi').dialog('close');
						$('#datagrid-m_transaksi').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		});
	}
	
    function removeTransaksi(){
		var row = $('#datagrid-m_transaksi').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini',function(r){
				if (r){
					$.post('<?php echo site_url('transaksi/removeTransaksi'); ?>',{id_stock:row.id_stock},function(result){
						if (!result.error){
							$('#datagrid-m_transaksi').datagrid('reload');
							$.messager.alert('INFO',result.msg,'info');
							} else {
							$.messager.alert('INFO',result.msg,'info');
						}
					},'json');
				}
			});
			}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
	}
	function tampilkan() {
		var tgl_awal = $('#tgl_awal').datebox('getValue');
		var tgl_akhir = $('#tgl_akhir').datebox('getValue');

		$('#datagrid-m_transaksi').datagrid('load',{"tgl_awal" : tgl_awal, "tgl_akhir" : tgl_akhir});
	}
</script>