	<form id="form_tambah_obat" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >

					<tr>
						<td class='label_form'>ID STOCK</td>
						<td>
							<input name='id_stock' id='id_stock' readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value="<?php echo $data['id_stock'];?>"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Nama Obat</td>
                        <td>
							<input name='id_obat' id='id_obat' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/resep/getKodeObat',
                                        valueField:'id_obat',
                                        textField:'nama'
                                        
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Quantity</td>
						<td >
							<input name='qty' id='qty' class='easyui-validatebox textbox' required="true" type="number" style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Harga SATUAN</td>
						<td >
							<input name='harga_satuan' id='harga_satuan' class='easyui-validatebox textbox' required="true" type="number" style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Total</td>
						<td >
							<input name='total' id='total' class='easyui-validatebox textbox' required="true" type="number" style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Tanggal Expired</td>
						<td >
							<input name='tgl_expired' id='tgl_expired' class='easyui-datetimebox' style="padding:3px;width:90%"/>	
						</td>
					</tr>

					
			</table>
		</form>