	
<table id="datagrid-m_registrasi" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/registrasi/getListRegistrasi';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="kode_registrasi" width="100" sortable="true">KODE REGISTRASI</th>
					<th field="kode_pasien" width="100" sortable="true">KODE PASIEN</th>	
					<th field="keluhan" width="100" sortable="true">KELUHAN</th>
					<th field="status" width="150" sortable="true">STATUS</th>
					
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addRegistrasi()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editRegistrasi()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeRegistrasi()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="sregistrasi" class="easyui-searchbox" style="width:250px" 
				searcher="cariregistrasi" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='kode_registrasi'>KODE REGISTRASI</div>
					<div name='kode_pasien	'>KODE PASIEN</div>
					<div name='status'>STATUS</div>
				</div>  
			</div>
		</div>
		<div id="dialog-m_registrasi" class="easyui-dialog" style="width:410px; height:350px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
		</div>
		
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpanRegistrasi();">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_registrasi').dialog('close');">Batal</a>
	</div>
		
<script>
	
	
	function cariregistrasi(value,name){
		
		$('#datagrid-m_registrasi').datagrid('load', { "searchKey": name, "searchValue": value });
	}
	
	function addRegistrasi(){
		
			
		$('#dialog-m_registrasi').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/registrasi/formRegistrasi',
			title:'Tambah Registrasi',
			onLoad:function(){
				$('#form_registrasi').form('clear');
				$('#form_registrasi #edit').val('');

						

			}
			});
		

	}
	
	function editRegistrasi(){
		
        var row = $('#datagrid-m_registrasi').datagrid('getSelected');

		if(row){
		
		$('#dialog-m_registrasi').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/registrasi/formRegistrasi',
			title:'Edit Registrasi',
			onLoad:function(){
				
				
				$('#form_registrasi').form('clear');
				$('#form_registrasi #edit').val('1');
				$('#form_registrasi').form('load',row);	
				
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
		
	}
	
	function simpanRegistrasi(){
		$.messager.progress({
                title:'',
                msg:'Simpan Registrasi...',
				text:''
         });
			
		$('#form_registrasi').form('submit',{
			url: '<?php echo site_url('registrasi/simpanRegistrasi'); ?>',
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
						$('#dialog-m_registrasi').dialog('close');
						$('#datagrid-m_registrasi').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		});
	}
	
	
    function removeRegistrasi(){
		var row = $('#datagrid-m_registrasi').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini ?',function(r){
				if (r){
					$.post('<?php echo site_url('registrasi/hapusRegistrasi'); ?>',{kode_registrasi:row.kode_registrasi},function(result){
						if (!result.error){
							$('#datagrid-m_registrasi').datagrid('reload');
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