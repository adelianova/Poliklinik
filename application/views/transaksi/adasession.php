
	

<!--

	<form id="form_tambah" method="post" novalidate>
				<input type='hidden' name='edit' id='edit' value=''/>
				<table width='350px' class='dialog-form' >
                    <tr>
						<td class='label_form'>Nama Obat</td>
                        <td>
							<input name='kode_obat' id='kode_obat' class='easyui-combobox' required="true"  style="padding:3px;width:90%" data-options="
                                        url:'<?php echo base_url();?>index.php/resep/getKodeObat',
                                        valueField:'kode_obat',
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
						<td class='label_form'>Dosis</td>
						<td >
						<textarea cols='40' rows='3' name='dosis' id='dosis' 
							style='padding:3px' class='easyui-validatebox textarea'  
							data-options="required:true"></textarea>
						</td>
					</tr>
					
			</table>
					<div id="dialog-buttons">
						<!--<input  class="easyui-linkbutton" iconCls="icon-ok" type="submit" name="button" id="button" onclick="ini()" value=" O K ">-->
						<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" type="submit" name="button" value="OK" id="button" onclick="simpan()">Simpan</a>
						<!--<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:jQuery('#dialog-m_tambah').dialog('close');">Batal</a> -->
					</div>
		</form>
		
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#work").html("aaa");
		})
	function simpan(){


		$('#dialog-m_tambah').dialog('close');
		/*
		$.messager.progress({
                title:'',
                msg:'Simpan Resep...',
				text:''
         });
			
		$('#form_tambah').form('submit',{
			url: '<?php echo site_url('resep/simpanResep'); ?>',
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
						$('#dialog-m_tambah').dialog('close');
						$('#datagrid-m_tambah').datagrid('reload');
						$.messager.alert('INFO',result.msg,'info');
				
					
					}
					
			}
		}); */
	}

	function ini(){
		<?php
			$kode_obat=$this->input->post('kode_obat');
			$qty=$this->input->post('qty');
			$dosis=$this->input->post('dosis');

			session_start();
			// contoh array 
			$item =array(
					'kode_obat'=>$kode_obat,
					'qty'=>$qty,
					'dosis'=>$dosis,
				);
			$this->session->set_userdata('item', $item); 
			// selipkan array kedalam session
			$_SESSION['item'] = $item;
		?>
	}

	</script>

-->