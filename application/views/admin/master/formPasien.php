	<form id="form_pasien" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>Kode Pasien</td>
						<td>
							<input name='kode_pasien' id='kode_pasien' readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value=""/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Nama</td>
						<td >
							<input name='nama' id='nama' class='easyui-validatebox textbox' required="true"  style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Alamat</td>
						<td >
							<textarea cols='40' rows='3' name='alamat' id='alamat' 
							style='padding:3px' class='easyui-validatebox textarea'  
							data-options="required:true"></textarea>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Telp</td>
						<td >
							<input name='telp' id='telp' class='easyui-validatebox textbox' required="true"  style="padding:3px;width:90%"/>
						</td>
					</tr><tr>
						<td class='label_form'>Email</td>
						<td >
							<input name='email' id='email' class='easyui-validatebox textbox' required="true"  style="padding:3px;width:90%"/>
						</td>
					</tr>
                    <!--<div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
                        <div style="margin-bottom:20px">
                            <select class="easyui-combogrid" style="width:100%" data-options="
                                panelWidth: 500,
                                idField: 'itemid',
                                textField: 'productname',
                                url: 'datagrid_data1.json',
                                method: 'get',
                                columns: [[
                                    {field:'',title:'Item ID',width:80},
                                    {field:'productname',title:'Product',width:120},
                                    {field:'listprice',title:'List Price',width:80,align:'right'},
                                    {field:'unitcost',title:'Unit Cost',width:80,align:'right'},
                                    {field:'attr1',title:'Attribute',width:200},
                                    {field:'status',title:'Status',width:60,align:'center'}
                                ]],
                                fitColumns: true,
                                label: 'Penanggung Jawab :',
                                labelPosition: 'top'
                            ">
                            </select>
                        </div>
                    </div>-->
                    <tr>
						<td class='label_form'>Status Pasien</td>
                        <td>
							<input name='id_status_pasien' id='id_status_pasien' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/pasien/getStatus',
                                        valueField:'id_status_pasien',
                                        textField:'status_pasien'
                                        
                                        "/>
						</td>
					</tr>
                        <!--<tr class="easyui-panel" >
                            <td class='label_form'>Status Pasien</td>
                            <td style="padding:3px;width:90%">
                                <input class="easyui-combobox" name="language" style="width:100%;" data-options="
                                        url:'combobox_data1.json',
                                        method:'get',
                                        valueField:'id_group',
                                        textField:'group',
                                        panelHeight:'auto',
                                        label: 'Language:',
                                        labelPosition: 'top'
                                        " required="true">
                            </td>
                        </tr>-->
			</table>
		</form>
	
	