	<form id="form_tambah_obat" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >

					<tr>
						<td>
							<input name='id_dtl_stock' id='id_dtl_stock' type="hidden" readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" >	
						</td>
					</tr>
					<tr>
						<td>
							<input name='id_stock' id='id_stock' type="hidden" readonly='true' 
							class='easyui-validatebox textbox' style="padding:3px;width:90%" value="<?php echo $id_stock;?>"/>	
						</td>
					</tr>
					<tr>
						<td class='label_form'>Nama Obat</td>
                        <td>
							<input name='id_obat' id='id_obat' class='easyui-combobox' required="true"  style="padding:3px;width:101%" data-options="
                                        url:'<?php echo base_url();?>index.php/resep/getKodeObat',
                                        valueField:'id_obat',
                                        textField:'nama'
                                        
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Quantity</td>
						<td >
							<input name='qty' id='qty' class='easyui-validatebox textbox' required="true" onkeyup="hitung()" type="number" style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Harga SATUAN</td>
						<td >
							<input name='harga_satuan' id='harga_satuan' class='easyui-validatebox textbox' onkeyup="hitung()" type="number" style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Total</td>
						<td >
							<input name='total' id='total' class='easyui-validatebox textbox' type="number" readonly="true" style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Tanggal Expired</td>
						<td >
							<input name='tgl_expired' id='tgl_expired' class='easyui-datebox' style="padding:3px;width:93%"/>	
						</td>
					</tr>

					
			</table>
			<div id="standalone" style="float: right;margin-top: 10px;">
						<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" type="submit" name="button" value="OK" id="button" onclick="simpanObat()">Simpan</a>
					</div>
		</form>
<script language="javascript">
	function hitung(){
		var b=document.getElementById("qty").value;
		var c=document.getElementById("harga_satuan").value;
		var hasil=parseInt(b)*parseInt(c);
		document.getElementById("total").value=hasil;
	}	

	function simpanObat(){
		$.messager.progress({
                title:'',
                msg:'Simpan Transaksi Obat...',
				text:''
         });
			
		$('#form_tambah_obat').form('submit',{
			url: '<?php echo site_url('transaksi/simpanObat/'.$id_stock); ?>',
			onSubmit: function(){ 
				var isValid = $(this).form('validate');
				if (!isValid){
					$.messager.progress('close');
					return $(this).form('validate');
				}
			},
			success: function(result){
				$.messager.progress('close');
				var result = eval('('+result+')');
					if(result.error){
						$.messager.alert('INFO',result.msg,'info');
					}else{
						$('#datagrid-m_detail').datagrid('reload');
						$('#dialog-m_tambah').dialog('close');
						$.messager.alert('INFO',result.msg,'info');
					}
			}
		});
	}
</script> 
