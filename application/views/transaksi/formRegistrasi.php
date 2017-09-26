	<form id="form_registrasi" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
				
					<tr>
						<td class="label_form">NOMER ANTRI</td>
						<td>
							<input readonly="true" type="number" name="antri" id="antri" value="<?php echo $antrian; ?>">
						</td>
					</tr>
					<tr>
						<td class='label_form'>Kode Registrasi</td>
						<td>
							<input name='kode_registrasi' id='kode_registrasi' readonly='true' 
							class='easyui-validatebox textbox' style='padding:3px;width:90%' type="text" value='<?php echo $data['kode_registrasi'];?>'/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Pasien</td>
                        <td>
							<input name='kode_pasien' id='kode_pasien' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/registrasi/getIDPasien',
                                        valueField:'kode_pasien',
                                        textField:'nama'
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Keluhan</td>
						<td >
							<input name='keluhan' id='keluhan' type="text" class='easyui-validatebox textbox' required="true"  style="padding:3px;width:90%"/>
						</td>
					</tr>
                   
                    <tr>
						<td class='label_form'>Status Registrasi</td>
                        <td>
							<input name='id_status_registrasi' id='id_status_registrasi' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/registrasi/getStatus',
                                        valueField:'id_status_registrasi',
                                        textField:'id_status_registrasi',
                                        onLoadSuccess : function(){
                                        $(this).combobox('select','Antri');
                                        }
                                        "/>
						</td>
					</tr>

			</table>

		</form>
	
	