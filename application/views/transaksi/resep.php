	
<table id="datagrid-m_resep" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/resep/getListResep';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_resep" width="100" sortable="true" hidden="true">ID RESEP</th>
					<th field="id_periksa" width="100" sortable="true">KODE PERIKSA</th>
					<th field="nama" width="100" sortable="true">NAMA PASIEN</th>
					<th field="nama_dokter" width="100" sortable="true">NAMA DOKTER</th>
				</tr>
			</thead>
		</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addResep()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" id="edit" data-options="iconCls:'icon-edit'" onClick="editResep()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeResep()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;padding-top:-10px;">
				<tr>
					<td >
					<input name='tgl_awal' id='tgl_awal' prompt="Dari tanggal" style="padding:3px;width:40%"/>	
					</td>
					<td >
					<input name='tgl_akhir' id='tgl_akhir' prompt="Sampai tanggal" style="padding:3px;width:40%"/>	
					</td>
					<a href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkan();">Tampilkan Data</a>
				</tr>
				</tr>
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="sresep" class="easyui-searchbox" style="width:250px" 
				searcher="cariresep" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='NAMA'>NAMA PASIEN</div>
					<div name='nama_dokter'>NAMA DOKTER</div>
				</div>  
			</div>
		</div>

	<div id="dialog-m_resep" class="easyui-dialog" style="width:500px; height:350px; padding: 10px 20px" 
		closed="true" buttons="#dialog-buttons" iconCls="icon-user">
	</div>
		
		<!-- Dialog Button -->
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpanResep();">Simpan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-m_resep').dialog('close');">Batal</a>
	</div>
		
		<!-- Dialog Button -->
		
<script>
	
	
	function cariresep(value,name){
		
		$('#datagrid-m_resep').datagrid('load', { "searchKey": name, "searchValue": value });
	}
	
	function addResep(){
		$('#dialog-m_resep').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/resep/formResep',
			title:'Tambah Resep',
			onLoad:function(){
				
				$('#form_resep').form('clear');
				$('#form_resep #edit').val('');
			}
			});
	}
	
	function editResep(){
		
        var row = $('#datagrid-m_resep').datagrid('getSelected');
        console.log(row);
		if(row){
		
		$('#dialog-m_resep').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/resep/formResep',
			title:'Edit Resep',
			onLoad:function(){
				
				
				$('#form_resep').form('clear');
				$('#form_resep #edit').val('1');
				$('#form_resep').form('load',row);	
				$('#datagrid-m_ini').datagrid('load',{id_resep:row.id_resep});
				
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
		
	}
	
	function simpanResep(){
		id_periksa = $('#id_periksa').combogrid("getValue");
		kode_dokter = $('#kode_dokter').combogrid("getValue");
		$.messager.progress({
                title:'',
                msg:'Simpan Resep...',
				text:''
        });
		$('#form_resep').form('submit',{
			url: '<?php echo site_url('resep/simpanResep'); ?>/'+id_periksa+"/"+kode_dokter,
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
						$('#dialog-m_resep').dialog('close');
						$('#datagrid-m_resep').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		});
	}
	
	
    function removeResep(){
		var row = $('#datagrid-m_resep').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini',function(r){
				if (r){
					$.post('<?php echo site_url('resep/hapusResep'); ?>',{id_resep:row.id_resep},function(result){
						if (!result.error){
							$('#datagrid-m_resep').datagrid('reload');
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

		$('#datagrid-m_resep').datagrid('load',{"tgl_awal" : tgl_awal, "tgl_akhir" : tgl_akhir});
	}

	$('#tgl_awal').datebox({
		dateFormat:'dd-MM-yy',
		formatter:function(date){
			var d = date.getDate();
			var y = date.getFullYear();
			var m = date.getMonth()+1;

			return String((d<10?('0'+d):d))+'-'+String((m<10?('0'+m):m))+'-'+y;
		},
		parser:function(s){

		}
	});

	$('#tgl_akhir').datebox({
		dateFormat:'yy-MM-dd',
		formatter:function(date){
			var d = date.getDate	();
			var y = date.getFullYear();
			var m = date.getMonth()+1;

			return String((d<10?('0'+d):d))+'-'+String((m<10?('0'+m):m))+'-'+y;
		},
		parser:function(s){
			
		}
	});
</script>