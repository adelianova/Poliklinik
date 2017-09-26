	<form id="form_obat" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td >
							<input name='id_stock' id='id_stock' type="hidden" readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value="<?php echo $data['id_stock'];?>"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>ID Supplier</td>
						<td>
						<select name='id_suplier' id='id_suplier' required="true" class="easyui-combobox" style="width:100%" data-options="
			                    url:'<?php echo base_url();?>index.php/transaksi/getIDSuplier',
			                    valueField:'ID_SUPLIER',
                                textField:'NAMA',
			                ">
			            </select>
						</td>
					</tr>

					<tr>
						<td class='label_form'>ID Transaksi</td>
						<td>
						<select name='id_transaksi' id='id_transaksi' required="true" class="easyui-combogrid" style="width:100%" data-options="
			                    panelWidth: 500,
			                    idField: 'ID_TRANSAKSI',
			                    url:'<?php echo base_url();?>index.php/transaksi/getListIDTransaksi',
			                    method: 'get',
			                    valueField:'ID_TRANSAKSI',
                                textField:'TRANSAKSI',
			                    columns: [[
				                        {field:'ID_TRANSAKSI',title:'ID Transaksi',width:50},
				                        {field:'TRANSAKSI',title:'Transaksi',width:100},
                    			]]
			                ">
			            </select>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Tanggal</td>
						<td >
							<input name='tgl' id='tgl' class='easyui-datetimebox' style="padding:3px;width:90%"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>NO Faktur</td>
						<td >
							<input name='no_faktur' id='no_faktur' class='easyui-validatebox textbox' required="true" type="text" style="padding:3px;width:90%"/>
						</td>
					</tr>

					<tr>
						<td class='label_form'>Keterangan</td>
						<td >
							<input name='keterangan' id='keterangan' class='easyui-validatebox textbox' required="true" type="text" style="padding:3px;width:90%"/>
						</td>
					</tr>
			</table>
			<div id="dialog-m_tambah" class="easyui-dialog" style="width:410px; height:250px; padding: 10px 20px" 
					closed="true" iconCls="icon-user">
					</div>
			<table id="datagrid-m_detail" title="" class="easyui-datagrid scrollbarx" 
					style="width:auto; height: auto;" 
					data-options="
					url:'<?php echo base_url().'index.php/transaksi/getListDetail';?>',
					toolbar:'#toolbar2',rownumbers:true,pagination:true,border:false,
					striped:true,fit:true,fitColumns:true,
					singleSelect:true,collapsible:false">
						<thead>
							<tr>
								<th field="id_dtl_stock" width="100" sortable="true">ID DETAIL STOCK</th>
								<th field="id_stock" width="100" sortable="true">ID STOCK</th>
								<th field="id_obat" width="100" sortable="true">ID OBAT</th>
								<th field="qty" width="100" sortable="true">QUANTITY</th>
								<th field="harga_satuan" width="100" sortable="true">HARGA SATUAN</th>
								<th field="total" width="100" sortable="true">TOTAL</th>
								<th field="tgl_expired" width="100" sortable="true">TANGGAL EXPIRED</th>
							</tr>
						</thead>
					</table>
					<div id="toolbar2" style='padding:5px;height:25px'>
						<div style="display:inline;">
						<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok'" onClick="iniTambah()">Tambah</a>&nbsp;
						<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editTambah()">Edit</a>&nbsp;
			        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeTambah()">Remove</a>&nbsp;
							 
					</div>
		</form>
	
<script type="text/javascript">
		$(field="ID_DETAIL_STOCK").each(function(){
			$(this).hide()
			console.log(this);
		})
function iniTambah(){
	var id_stock = $('#datagrid-m_transaksi').datagrid('getSelected');
		$('#dialog-m_tambah').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/transaksi/formTambahObat/'+id_stock.id_stock,
			title:'Tambah Obat',
			onLoad:function(){
				$('#form_tambah_obat').form('clear');
				$('#form_tambah_obat #edit').val('');
			},
			onClose: function(){
				
			 $('#dialog-m_detail').datagrid('reload');
			}
			});
	}
function editTambah(){
        var row = $('#datagrid-m_detail').datagrid('getSelected');
        console.log(row);
		if(row){
		$('#dialog-m_tambah').dialog({ 
		    closed: false, 
			cache: false, 
			modal: true, 
			href:base_url+'index.php/transaksi/formTambahObat',
			title:'Edit Obat',
			onLoad:function(){
				$('#form_tambah_obat').form('clear');
				$('#form_tambah_obat #edit').val('1');
				$('#form_tambah_obat').form('load',row);	
			}
			});
		}else{
			$.messager.alert('INFO','Pilih satu record dulu','info');
		}
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
			title:'Edit Obat',
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


function removeTambah(){
		var row = $('#datagrid-m_detail').datagrid('getSelected');
		if (row){
			$.messager.confirm('Konfirmasi', 'Anda yakin menghapus data ini',function(z){
				if (z){
					$.post('<?php echo site_url('transaksi/removeTambah'); ?>',{id_detail_stock:row.ID_DETAIL_STOCK},function(result){
						console.log(result)
						if (!result.error){
							$('#datagrid-m_detail').datagrid('reload');
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


	