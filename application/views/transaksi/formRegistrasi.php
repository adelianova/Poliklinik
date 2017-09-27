	<form id="form_registrasi" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
				
					<div>
						<input readonly="true" type="number" name="antrian" id="antrian" class="standalone2" style="padding:10px;width:25px; margin-left:75%;font-size: 13px;border-radius: 3px 3px 3px 3px;-moz-border-radius: 3px 3px 3px 3px;-webkit-border-radius: 3px 3px 3px 3px;border-color: #c0392b; padding-left: 25px" value="<?php echo $antrian; ?>">
					</div>
					
					<tr>
						<td>
							<input name='kode_registrasi' id='kode_registrasi' readonly='true' 
							class='easyui-validatebox textbox' style='padding:3px;width:90%' type="hidden" value='<?php echo $data['kode_registrasi'];?>'/>	
						</td>
					</tr>
					<tr>
						<td>
							<input name='tgl_registrasi' id='tgl_registrasi' readonly='true' class='easyui-validatebox textbox' type="hidden" style='padding:3px;width:90%'/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Pasien</td>
                        <td>
							<input name='kode_pasien' id='kode_pasien' class='easyui-combobox' required="true"  style="padding:3px;width:235px" data-options="
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
							<input name='id_status_registrasi' id='id_status_registrasi' class='easyui-combobox' required="true"  style="padding:3px;width:235px" data-options="
                                        url:'<?php echo base_url();?>index.php/registrasi/getStatus',
                                        valueField:id_status_registrasi,
                                        textField:'id_status_registrasi',
                                        onLoadSuccess : function(){
						                                        $(this).combobox('select','Antri');
						                                        }
                                        "/>
						</td>
					</tr>
			</table>

			
		</form>
	
	