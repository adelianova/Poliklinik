<table id="datagrid-m_periksa" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/periksa/getListPeriksa';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_periksa" width="100" sortable="true">ID</th>
					<th field="kode_registrasi" width="100" sortable="true">KODE REGISTRASI</th>
					<th field="nama_dokter" width="100" sortable="true">NAMA DOKTER</th>
					<th field="nama" width="100" sortable="true">NAMA PASIEN</th>
					<th field="id_penyakit" width="100" sortable="true">ID PENYAKIT</th>
					<th field="penyakit" width="100" sortable="true">PENYAKIT</th>
					<th field="tgl_periksa" width="100" sortable="true">TANGGAL PERIKSA</th>		
					<th field="keluhan" width="100" sortable="true">KELUHAN</th>
					<th field="diagnosa" width="150" sortable="true">DIAGNOSA</th>
					
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editPeriksa()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removePeriksa()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="speriksa" class="easyui-searchbox" style="width:250px" 
				searcher="cariperiksa" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='id_periksa'>ID</div>
					<div name='nama_dokter'>DOKTER</div>
					<div name='nama'>NAMA PASIEN</div>
					<div name='tgl_periksa'>TANGGAL</div>
				</div>  
			</div>
		</div>
		<div id="dialog-m_periksa" class="easyui-dialog" style="width:410px; height:350px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
		</div>
		
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpanPeriksa();">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_periksa').dialog('close');">Batal</a>
	</div>
		
<script>
	
	
	function cariperiksa(value,name){
		
		$('#datagrid-m_periksa').datagrid('load', { "searchKey": name, "searchValue": value });
	}	
	function editPeriksa(){
		
        var row = $('#datagrid-m_periksa').datagrid('getSelected');

		if(row){
		
		$('#dialog-m_periksa').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/periksa/formPeriksa',
			title:'Edit Pemeriksaan',
			onLoad:function(){
				
				
				$('#form_periksa').form('clear');
				$('#form_periksa #edit').val('1');
				$('#form_periksa').form('load',row);	
				
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
		
	}
	
	function simpanPeriksa(){
		$.messager.progress({
                title:'',
                msg:'Simpan Pemeriksaan...',
				text:''
         });
			
		$('#form_periksa').form('submit',{
			url: '<?php echo site_url('periksa/simpanPeriksa'); ?>',
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
						$('#dialog-m_periksa').dialog('close');
						$('#datagrid-m_periksa').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		});
	}
	
	
    function removePeriksa(){
		var row = $('#datagrid-m_periksa').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini',function(r){
				if (r){
					$.post('<?php echo site_url('periksa/hapusPeriksa'); ?>',{id_periksa:row.id_periksa},function(result){
						if (!result.error){
							$('#datagrid-m_periksa').datagrid('reload');
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