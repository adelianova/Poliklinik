	
<table id="datagrid-m_retur" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/retur/getListRetur';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_retur" width="100" sortable="true" hidden="true">ID RETUR</th>
					<th field="no_retur" width="100" sortable="true">NO RETUR</th>
					<th field="tgl" width="100" sortable="true">TANGGAL</th>
					<th field="petugas" width="100" sortable="true">PETUGAS</th>
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addRetur()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editRetur()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeRetur()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="sretur" class="easyui-searchbox" style="width:250px" 
				searcher="cariRetur" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='id_retur'>ID</div>
					<div name='tgl'>Tanggal</div>
					<div name='no_retur'>No Retur</div>
					<div name='petugas'>Petugas</div>
				</div>  
			</div>
		</div>
		<div id="dialog-m_retur" class="easyui-dialog" style="width:800px; height:500px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
		</div>
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpanRetur();">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_retur').dialog('close');">Batal</a>
	</div>
		
<<script>
	
	
	function cariRetur(value,name){
		
		$('#datagrid-m_retur').datagrid('load', { "searchKey": name, "searchValue": value });
	}
	
	function addRetur(){
		$('#dialog-m_retur').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/retur/formRetur',
			title:'Tambah Transaksi Retur Obat',
			onLoad:function(){
				
				$('#form_retur').form('clear');
				$('#form_retur #edit').val('');
			}
			});
	}
	
	function editRetur(){
		
        var row = $('#datagrid-m_retur').datagrid('getSelected');
        console.log(row);
		if(row){
		
		$('#dialog-m_retur').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/retur/formRetur',
			title:'Edit Retur',
			onLoad:function(){
				
				
				$('#form_retur').form('clear');
				$('#form_retur #edit').val('1');
				$('#form_retur').form('load',row);	
				$('#datagrid-m_detail').datagrid('load',{id_retur:row.id_retur});
				
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
		
	}
	
	function simpanRetur(){
		$.messager.progress({
                title:'',
                msg:'Simpan Retur...',
				text:''
         });
			
		$('#form_retur').form('submit',{
			url: '<?php echo site_url('retur/simpanRetur'); ?>',
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
						$('#dialog-m_retur').dialog('close');
						$('#datagrid-m_retur').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		});
	}
	
    function removeRetur(){
		var row = $('#datagrid-m_retur').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini',function(r){
				if (r){
					$.post('<?php echo site_url('retur/removeRetur'); ?>',{id_retur:row.id_retur},function(result){
						if (!result.error){
							$('#datagrid-m_retur').datagrid('reload');
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