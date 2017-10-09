	
<table id="datagrid-m_pasien" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto; align-items: center;" 
		data-options="
		url:'<?php echo base_url().'index.php/pasien/getListPasien';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="nip" width="80" sortable="true">NIP</th>
					<th field="nama" width="150" sortable="true">NAMA PASIEN</th>
					<th field="gender" align="center" width="70" sortable="true">Male/Female</th>
					<th field="tgl_lahir" width="100" hidden="true">TANGGAL LAHIR</th>
					<th field="alamat" width="150" sortable="true">ALAMAT</th>
					<th field="telp" width="80" sortable="true">TELP</th>
					<th field="email" width="100">EMAIL</th>		
					<th field="bagian" width="50" sortable="true">BAGIAN</th>
					<th field="status_pasien" width="80" sortable="true">STATUS PASIEN</th>
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addPasien()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editPasien()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removePasien()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="spasien" class="easyui-searchbox" style="width:250px" 
				searcher="caripasien" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='nama'>NAMA</div>
					<div name='full_name'>PENANGGUNG JAWAB</div>
				</div>  
			</div>
		</div>
		<div id="dialog-m_pasien" class="easyui-dialog" style="width:410px; height:400px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
		</div>
		
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpanPasien();">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_pasien').dialog('close');">Batal</a>
	</div>
		
<script>
	
	
	function caripasien(value,name){
		
		$('#datagrid-m_pasien').datagrid('load', { "searchKey": name, "searchValue": value });
	}
	
	function addPasien(){
		
			
		$('#dialog-m_pasien').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/pasien/formPasien',
			title:'Tambah Pasien',
			onLoad:function(){
				$('#form_pasien').form('clear');
				$('#form_pasien #edit').val('');

						

			}
			});
		

	}
	
	function editPasien(){
		
        var row = $('#datagrid-m_pasien').datagrid('getSelected');

		if(row){
		
		$('#dialog-m_pasien').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/pasien/formPasien',
			title:'Edit Pasien',
			onLoad:function(){
				
				
				$('#form_pasien').form('clear');
				$('#form_pasien #edit').val('1');
				$('#form_pasien').form('load',row);	
				
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
		
	}
	
	function simpanPasien(){
		$.messager.progress({
                title:'',
                msg:'Simpan Master Pasien...',
				text:''
         });
			
		$('#form_pasien').form('submit',{
			url: '<?php echo site_url('pasien/simpanPasien'); ?>',
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
						$('#dialog-m_pasien').dialog('close');
						$('#datagrid-m_pasien').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		});
	}
	
	
    function removePasien(){
		var row = $('#datagrid-m_pasien').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data Pasien ini ?',function(r){
				if (r){
					$.post('<?php echo site_url('pasien/hapusPasien'); ?>',{kode_pasien:row.kode_pasien},function(result){
						if (!result.error){
							$('#datagrid-m_pasien').datagrid('reload');
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