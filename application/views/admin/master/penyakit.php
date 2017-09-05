	
<table id="datagrid-m_penyakit" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/penyakit/getListPenyakit';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_penyakit" width="100" sortable="true">ID PENYAKIT</th>
					<th field="kode_penyakit" width="100" sortable="true">KODE</th>
					<th field="penyakit" width="100" sortable="true">PENYAKIT</th>
					
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<!-- <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addPenyakit()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editPenyakit()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removePenyakit()">Remove</a>&nbsp; -->
				 
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="spenyakit" class="easyui-searchbox" style="width:250px" 
				searcher="caripenyakit" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='penyakit'>NAMA PENYAKIT</div>
				</div>  
			</div>
		</div>
		<div id="dialog-m_penyakit" class="easyui-dialog" style="width:410px; height:350px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
		</div>
		
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpanPenyakit();">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_dokter').dialog('close');">Batal</a>
	</div>
		
<script>
	
	
	function caripenyakit(value,name){
		
		$('#datagrid-m_penyakit').datagrid('load', { "searchKey": name, "searchValue": value });
	}
	
	function addPenyakit(){
		
			
		$('#dialog-m_penyakit').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/penyakit/formPenyakit',
			title:'Tambah Penyakit',
			onLoad:function(){
				$('#form_penyakit').form('clear');
				
				
				$('#form_penyakit #edit').val('');

						

			}
			});
		

	}
	
	function editPenyakit(){
		
        var row = $('#datagrid-m_penyakit').datagrid('getSelected');

		if(row){
		
		$('#dialog-m_penyakit').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/penyakit/formPenyakit',
			title:'Edit Penyakit',
			onLoad:function(){
				
				
				$('#form_penyakit').form('clear');
				$('#form_penyakit #edit').val('1');
				$('#form_penyakit').form('load',row);	
				
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
		
	}
	
	function simpanPenyakit(){
		$.messager.progress({
                title:'',
                msg:'Simpan Master Penyakit...',
				text:''
         });
			
		$('#form_penyakit').form('submit',{
			url: '<?php echo site_url('penyakit/simpanPenyakit'); ?>',
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
						$('#dialog-m_penyakit').dialog('close');
						$('#datagrid-m_penyakit').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		});
	}
	
	
    function removePenyakit(){
		var row = $('#datagrid-m_penyakit').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini',function(r){
				if (r){
					$.post('<?php echo site_url('penyakit/hapusPenyakit'); ?>',{kode_penyakit:row.kode_penyakit},function(result){
						if (!result.error){
							$('#datagrid-m_penyakit').datagrid('reload');
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