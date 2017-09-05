	<form id="form_periksa" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>ID Periksa</td>
						<td>
							<input name='id_periksa' id='id_periksa' readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value="<?php echo $data['id_periksa'];?>"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Kode Dokter</td>
						<td>
							<input name='kode_dokter' id='kode_dokter' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/periksa/getKodeDokter',
                                        valueField:'kode_dokter',
                                        textField:'nama_dokter'
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Kode Pasien</td>
						<td >
							<input name='kode_pasien' id='kode_pasien' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/periksa/getKodePasien',
                                        valueField:'kode_pasien',
                                        textField:'nama'
                                        
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>ID Penyakit</td>
						<td >
							<input name='id_penyakit' id='id_penyakit' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/periksa/getIDPenyakit',
                                        valueField:'id_penyakit',
                                        textField:'penyakit'
                                        
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Kode Penyakit</td>
						<td >
							<input name='kode_penyakit' id='kode_penyakit' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/periksa/getKodePenyakit',
                                        valueField:'kode_penyakit',
                                        textField:'penyakit'
                                        
                                        "/>
						</td>
					</tr><tr>
						<td class='label_form'>Tanggal Periksa</td>
						<td >
							<input name='tgl_periksa' id='tgl_periksa' class='easyui-datetimebox' style="padding:3px;width:90%"/>	
						</td>
					</tr><!-- 
					<tr>
						<td class='label_form'>Keluhan</td>
						<td >
							<textarea cols='40' rows='3' name='keluhan' id='keluhan' 
							style='padding:3px' class='easyui-validatebox textarea'  
							data-options="required:true"></textarea>
						</td>
					</tr> -->
					<tr>
						<td class='label_form'>Diagnosa</td>
						<td >
						<textarea cols='40' rows='3' name='diagnosa' id='diagnosa' 
							style='padding:3px' class='easyui-validatebox textarea'  
							data-options="required:true"></textarea>
						</td>
					</tr>
					
			</table>
		</form>
	
	