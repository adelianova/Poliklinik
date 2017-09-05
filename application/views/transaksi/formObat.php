	<form id="form_obat" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>ID Stock</td>
						<td >
							<input name='id_stock' id='id_stock' readonly='true' 
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
                                textField:'ID_TRANSAKSI',
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
		</form>
	
	