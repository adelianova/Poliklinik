<table id="datagrid-m_resep" title="" class="easyui-datagrid scrollbarx" 
		style="width:auto; height: auto;" 
		data-options="
		url:'<?php echo base_url().'index.php//';?>',
		toolbar:'#buttonaction',rownumbers:true,pagination:true,border:false,
		striped:true,fit:true,fitColumns:true,
		singleSelect:true,collapsible:false">
			<thead>
				<tr>
					<th field="id_obat" width="100" sortable="true">ID OBAT</th>
					<th field="kode_obat" width="100" sortable="true">KODE OBAT</th>
					<th field="nama" width="100" sortable="true">NAMA OBAT</th>
					<th field="qty" width="100" sortable="true">QUANTITY</th>
				</tr>
			</thead>
		</table>
		
		<div id="buttonaction" style='padding:5px;height:25px'>
			<div style="display:inline;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onClick="addStock()">Add</a>&nbsp;
			<a href="javascript:void(0)" class="easyui-linkbutton" id="edit" data-options="iconCls:'icon-edit'" onClick="editStock()">Edit</a>&nbsp;
        	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onClick="removeStock()">Remove</a>&nbsp;
			</div>
			<div style="display:inline;float:right;padding-top:-10px;">
				<input id="sstock" class="easyui-searchbox" style="width:250px" 
				searcher="caristock" prompt="Ketik disini" menu="#muser"></input>  
				<div id="muser" style="width:150px"> 
					<div name='id_stock'>ID STOCK</div>
				</div>  
			</div>
		</div>