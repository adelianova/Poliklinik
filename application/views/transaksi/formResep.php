	<form id="form_resep" method="post" novalidate>
				<input type='hidden'  name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>ID Resep</td>
						<td>
							<input name='id_resep' id='id_resep' readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value="<?php echo $data['id_resep'];?>"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>ID Periksa</td>
						<td>
						<select name='id_periksa' id='id_periksa' required="true" class="easyui-combogrid" style="width:100%" data-options="
			                    panelWidth: 500,
			                    idField: 'id_periksa',
			                    url:'<?php echo base_url();?>index.php/resep/getIDPeriksa',
			                    method: 'get',
			                    valueField:'id_periksa',
                                textField:'nama',
			                    columns: [[
				                        {field:'id_periksa',title:'ID',width:50},
				                        {field:'kode_pasien',title:'Kode Pasien',width:100},
				                        {field:'nama',title:'Nama',width:120,align:'right'},
                    			]]
			                ">
			            </select>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Dokter</td>
						<td >
							<select name='kode_dokter' id='kode_dokter' required="true" class="easyui-combogrid" style="width:100%" data-options="
			                    panelWidth: 500,
			                    idField: 'kode_dokter',
			                    url:'<?php echo base_url();?>index.php/resep/getIDDokter',
			                    method: 'get',
			                    valueField:'kode_dokter',
                                textField:'nama_dokter',
			                    columns: [[
				                        {field:'kode_dokter',title:'ID',width:50},
				                        {field:'nama_dokter',title:'Kode Pasien',width:100}
                    			]]
			                ">
			            </select>
						</td>
					</tr>

					<div id="dialog-m_tambah" class="easyui-dialog" style="width:410px; height:250px; padding: 10px 20px" 
					closed="true" iconCls="icon-user">
					</div>
					<table id="datagrid-m_ini" title="Resep Obat" toolbar="#tb" iconCls="icon-save" class="easyui-datagrid scrollbarx" 
<<<<<<< HEAD
					style="width:100%;height:220px;" 
=======
					style="width:100%;height:200px;" 
>>>>>>> de5ff204c2924a947884ec8d32a117d42c1fd952
					data-options="
					url:'<?php echo base_url().'index.php/resep/kodeResep/';?>'
					">
					    <thead>

					    <!--<?php echo ltrim($data['id_resep']);?>-->
					        <tr>
					            <th field="KODE_OBAT" width="100">Kode Obat</th>
					            <th field="NAMA" width="100">Nama Obat</th>
					            <th field="QTY" width="100" align="right">Quantity</th>
					            <th field="DOSIS" width="100" align="right">Dosis</th>
					            <th field="ID_DETAIL_RESEP" width="100" align="right" hidden="true">ID</th>
					        </tr>
					    </thead>
					    <tbody>
						</tbody>
					</table>
					<div id="tb">
					    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addTambah()">Tambah</a>&nbsp;
						<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editTambah()">Edit</a>&nbsp;
			        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeTambah()">Remove</a>&nbsp;
					</div>
		</form>

<script type="text/javascript">
		$(field="ID_DETAIL_RESEP").each(function(){
			$(this).hide()
			console.log(this);
		})
function addTambah(){
	var id_resep = $('#datagrid-m_resep').datagrid('getSelected');
		$('#dialog-m_tambah').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/resep/formTambah/'+id_resep.id_resep,
			title:'Tambah Obat',
			onLoad:function(){
				$('#form_tambah').form('clear');
				$('#form_tambah #edit').val('');
			},
			onClose: function(){
				
			 $('#dialog-m_ini').datagrid('reload');
			}
			});
	}
function editTambah(){
        var row = $('#datagrid-m_ini').datagrid('getSelected');
        console.log(row);
		if(row){
		$('#dialog-m_tambah').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/resep/formTambah',
			title:'Edit Resep Obat',
			onLoad:function(){
				$('#form_tambah').form('clear');
				$('#form_tambah #edit').val('1');
				$('#form_tambah').form('load',row);	
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
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


function removeTambah(){
		var row = $('#datagrid-m_ini').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini',function(z){
				if (z){
					$.post('<?php echo site_url('resep/hapusTambah'); ?>',{id_detail_resep:row.ID_DETAIL_RESEP},function(result){
						console.log(result)
						if (!result.error){
							$('#datagrid-m_ini').datagrid('reload');
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




	
	