	<form id="form_kontrak" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>ID Kontrak</td>
						<td >
							<input name='id_kontrak' id='id_kontrak' readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value="<?php echo $data['id_kontrak'];?>"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Kode Dokter</td>
						<td>
							<input name='kode_dokter' id='kode_dokter' class='easyui-validatebox textbox' required="true"  style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Nomor</td>
						<td >
							<input name='nomor' id='nomor' class='easyui-validatebox textbox' required="true"  style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Mulai Kontrak</td>
						<td >
							<input name='mulai_kontrak' id='mulai_kontrak' class='easyui-datetimebox' style="padding:3px;width:90%"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Selesai Kontrak</td>
						<td >
							<input name='selesai_kontrak' id='selesai_kontrak' class='easyui-datetimebox' style="padding:3px;width:90%"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Keterangan</td>
						<td >
							<textarea cols='40' rows='3' name='keterangan' id='keterangan' 
							style='padding:3px' class='easyui-validatebox textarea'  
							data-options="required:true"></textarea>
						</td>
					</tr>
					
			</table>
		</form>
	
	