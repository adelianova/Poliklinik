	<form id="form_periksa" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>ID Periksa</td>
						<td>
						<select name='id_periksa' id='id_periksa' required="true" class="easyui-combogrid" style="width:100%" data-options="
			                    panelWidth: 500,
			                    idField: 'id_periksa',
			                    url:'<?php echo base_url();?>index.php/periksa/getIDPeriksa',
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
						<td>
							<input name='kode_dokter' id='kode_dokter' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/periksa/getKodeDokter',
                                        valueField:'kode_dokter',
                                        textField:'nama_dokter'
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Pasien</td>
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
					</tr>
					<tr>
						<td class='label_form'>Diagnosa</td>
						<td >
						<textarea cols='40' rows='3' name='diagnosa' id='diagnosa' 
							style='padding:3px' class='easyui-validatebox textarea'  
							data-options="required:true"></textarea>
						</td>
					</tr>
					 <tr>
						<td class='label_form'>Status Registrasi</td>
                        <td>
							<input name='id_status_registrasi' id='id_status_registrasi' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/periksa/getStatus',
                                        valueField:id_status_registrasi,
                                        textField:'id_status_registrasi',
                                        onLoadSuccess : function(){
						                                        $(this).combobox('select','Periksa');
						                                        }
                                        "/>
						</td>
					</tr>
			</table>
		</form>
	
	