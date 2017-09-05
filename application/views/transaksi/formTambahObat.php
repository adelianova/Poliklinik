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
							<input name='tgl_expired' id='tgl_expired' class='easyui-validatebox textbox' required="true" type="number" style="padding:3px;width:90%"/>
						</td>
					</tr>

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
						<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" onClick="editTambah()">Edit</a>&nbsp;
			        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeTambah()">Remove</a>&nbsp;
							 
					</div>
			</table>
		</form>