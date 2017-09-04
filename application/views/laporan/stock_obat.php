	
<table id="datagrid-m_stock" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php/stock_obat/getListStock';?>',
		toolbar:'#toolbar',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_detail_stock" width="100" sortable="true">ID DETAIL STOCK</th>
					<th field="id_stock" width="100" sortable="true">ID STOCK</th>
					<th field="id_obat" width="100" sortable="true">ID OBAT</th>
					<th field="qty" width="100" sortable="true">QUANTITY</th>
					<th field="harga_satuan" width="100" sortable="true">HARGA SATUAN</th>
					<th field="total" width="100" sortable="true">TOTAL</th>
					<th field="tgl_expired" width="100" sortable="true">TANGGAL EXPIRED</th>
				</tr>
			</thead>
</table>
		
		<div id="toolbar" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addResep()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" id="edit" data-options="iconCls:'icon-edit'" onClick="editResep()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeResep()">Remove</a>&nbsp;
				 
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="sstockobat" class="easyui-searchbox" style="width:250px" 
				searcher="caristockobat" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='id_detail_stock'>ID</div>
				</div>  
			</div>
		</div>
<script>
	
	
	function caristockobat(value,name){
		
		$('#datagrid-m_stock').datagrid('load', { "searchKey": id_detail_stock, "searchValue": value });
	}

</script>