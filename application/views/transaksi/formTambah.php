	<form id="form_tambah" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
					<tr>
						<td class='label_form'>Nama Obat</td>
                        <td>
							<input name='ID_OBAT' id='KODE_OBAT' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/resep/getKodeObat',
                                        valueField:'kode_obat',
                                        textField:'nama'
                                        
                                        "/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Quantity</td>
						<td >
							<input name='QTY' id='QTY' class='easyui-validatebox textbox' required="true" type="number" style="padding:3px;width:90%"/>
						</td>
					</tr>
					<tr>
						<td class='label_form'>Dosis</td>
						<td >
						<textarea cols='40' rows='3' name='DOSIS' id='DOSIS' 
							style='padding:3px' class='easyui-validatebox textarea'  
							data-options="required:true"></textarea>
						</td>
					</tr>
					
			</table>

					<div id="dialog-buttons">
						<!--<input  class="easyui-linkbutton" iconCls="icon-ok" type="submit" name="button" id="button" onclick="ini()" value=" O K ">-->
						<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" type="submit" name="button" value="OK" id="button" onclick="simpanTambah()">Simpan</a>
						<!--<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:jQuery('#dialog-m_tambah').dialog('close');">Batal</a> -->
					</div>

<script type="text/javascript">

	function simpanTambah(){
		$.messager.progress({
                title:'',
                msg:'Simpan Resep Obat...',
				text:''
         });
			
		$('#form_tambah').form('submit',{
			url: '<?php echo site_url('resep/simpanTambah/'.$id_resep);?>',
			onSubmit: function(){ 
				var isValid = $(this).form('validate');
				if (!isValid){
					$.messager.progress('close');
					return $(this).form('validate');
				}
			},
			success: function(result){
				console.log(result);
				$.messager.progress('close');
				var result = eval('('+result+')');
					if(result.error){
						$.messager.alert('INFO',result.msg,'info');
					
					}else{
						$('#dialog-m_tambah').dialog('close');
						$('#datagrid-m_ini').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
					}
			}
		});
	}
	
	

</script>
		</form>