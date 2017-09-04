	
<table id="datagrid-m_transaksi" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/transaksi/getListTransaksi';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_transaksi" width="100" sortable="true">ID TRANSAKSI</th>
					<th field="transaksi" width="100" sortable="true">KETERANGAN TRANSAKSI</th>
					<th field="id_resep" width="100" sortable="true">ID RESEP</th>
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addTransaksi()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editTransaksi()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeTransaksi()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="stransaksi" class="easyui-searchbox" style="width:250px" 
				searcher="cariTransaksi" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='id_transaksi'>ID</div>
				</div>  
			</div>
		</div>
		<div id="dialog-m_transaksi" class="easyui-dialog" style="width:420px; height:200px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
		</div>
		
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick='simpanTransaksi();'>Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_transaksi').dialog('close');">Batal</a>
	</div>
		
<script type="text/javascript"> 
	function cariTransaksi(value,id_transaksi){
		$('#datagrid-m_transaksi').datagrid('load', { "searchKey": id_transaksi, "searchValue": value });
	}
	
	function addTransaksi(){
		$('#dialog-m_transaksi').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/transaksi/formTransaksi',
			title:'Tambah Transaksi',
			onLoad:function(){
				$('#form_transaksi').form('clear');
				$('#form_transaksi #edit').val('');
			}
			});
	}
	
	function editTransaksi(){
        var row = $('#datagrid-m_transaksi').datagrid('getSelected');
		if(row){
		$('#dialog-m_transaksi').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/transaksi/formTransaksi',
			title:'Edit Transaksi',
			onLoad:function(){
				$('#form_transaksi').form('clear');
				$('#form_transaksi #edit').val('1');
				$('#form_transaksi').form('load',row);	
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
	}
	
	function simpanTransaksi(){
		$.messager.progress({
                title:'',
                msg:'Simpan Master Transaksi...',
				text:''
         });
			
		$('#form_transaksi').form('submit',{
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
					$.post('<?php echo site_url('transaksi/hapusTransaksi'); ?>',{id_transaksi:row.id_transaksi},function(result){
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
</script>