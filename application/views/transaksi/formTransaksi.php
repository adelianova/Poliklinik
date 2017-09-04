	<form id="form_transaksi" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>ID Transaksi</td>
						<td>
							<input name='id_transaksi' id='id_transaksi' readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value="<?php echo $data['id_transaksi'];?>"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Keterangan</td>
						<td >
							<input name='transaksi' id='transaksi' class='easyui-validatebox textbox' required="true"  style="padding:3px;width:90%"/>
						</td>
					</tr>

					<tr>
						<td class='label_form'>Resep</td>
						<td>
						<select name='id_resep' id='id_resep' required="true" class="easyui-combogrid" style="width:100%" data-options="
			                    panelWidth: 500,
			                    idField: 'ID_RESEP',
			                    url:'<?php echo base_url();?>index.php/transaksi/getListResepTransaksi',
			                    method: 'get',
			                    valueField:'ID_RESEP',
                                textField:'ID_RESEP',
			                    columns: [[
				                        {field:'ID_RESEP',title:'ID RESEP',width:50},
				                        {field:'ID_PERIKSA',title:'ID PERIKSA',width:100},
				                        {field:'KODE_DOKTER',title:'KODE DOKTER',width:120,align:'right'},
                    			]]
			                ">
			            </select>
						</td>
					</tr>
					
			</table>

			<!--<table id="datagrid-m_itu" title="RESEP TRANSAKSI OBAT" class="easyui-datagrid scrollbarx" 
			style="width:auto; height: auto;" 
			data-options="
			url:'<?php echo base_url().'index.php/transaksi/getListResepTransaksi';?>',
			rownumbers:true,pagination:true,border:false,
			striped:true,fit:true,fitColumns:true,
			singleSelect:true,collapsible:false">
				<thead>
					<tr>
						<th field="ID_RESEP" width="100">ID RESEP</th>
						<th field="ID_PERIKSA" width="100">ID PERIKSA</th>
						<th field="KODE_DOKTER" width="100">KODE DOKTER</th>
			           	
					</tr>
				</thead>
			</table>
			-->
		</form>
	
	