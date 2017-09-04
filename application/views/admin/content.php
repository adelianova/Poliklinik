    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="en" />
		<meta name="robots" content="noindex,nofollow" />
		<script type="text/javascript"> 
			var base_url = "<?php print base_url(); ?>";	
		</script>
		<link rel="shortcut icon" href="<?php echo base_url().'asset/img/admin/favicon.ico';?>"/>
		
		<?php echo @$metadata; ?>
		<title><?php echo @$judul; ?></title>
		<style>
	.layout-panel-center .panel-title{
		text-align:right;
		padding-right:10px;
	}
	</style>

	</head>
	<body class="easyui-layout dashboard" style="overflow-y: hidden" scroll="no">
	<div data-options="region:'north',border:false" style="height:55px;background:#a1caf4;padding:10px; background-image:url(<?php echo base_url();?>asset/img/admin/banner.png); background-repeat:no-repeat; background-position:center left;">
		   <div class="tagNameArea">
		 	<span>Logged, <strong style="color:#2c3e50;"><?php echo $this->session->userdata('name');?>&nbsp;&nbsp;&nbsp;</strong></span> 
			<a href="javascript:void(0)" id="mb" class="easyui-menubutton settingButton" data-options="menu:'#set'">&nbsp;&nbsp;<i class="icon-user">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>&nbsp; &nbsp; Setting &nbsp; </a>
			<div id="set" style="width:150px;">
				<div data-options="iconCls:'icon-unlock'"><a href='javascript:void(0)' onClick='logout()'>Log Out</a></div>
			</div>
		</div>
    	
    </div>    
	<div region="west" split="true" title="Navigator" style="width:250px;" class='content_main'>
	<ul id='tree-menu' class="easyui-tree" style='padding:10px' animate="true" lines="true">
	</ul>
    </div>
    <div id="content" region="center" title=""  class='content_footer' style='overflow:hidden'> 
	    <div id='content_tab' class="easyui-tabs isinya" border='false' fit="true" cache='false'>
        <div id='isi_content' title="Main Content" style='overflow:hidden' iconCls='icon-paper'>
		</div>
		</div>
    </div>
	<div data-options="region:'south',border:false" style="background:#2980b9; color:#ecf0f1; padding:10px; text-align:center;">SIM PDAM Kota Malang</div>
	
	</body>
</html>
<script>
	$(function(){
		$('#tree-menu').tree({    
		animate:true,
		url:base_url+'index.php/user/getDefaultMenu',
		onClick: function open1(node){
			var login='';
			$.ajax({
				url:base_url+'index.php/user/isLogin',
				async:false,
				success:function(result){
					login=result;
					
				}
			});
			if(login=='1'){
			if(node.akses==true){
			
			$('#content_tab').tabs("close", 0);
			$('.easyui-dialog').dialog('destroy');
			$('.datagrid-toolbar').remove();
			$('#content_tab').tabs('add', {
				
					title: node.text,
					iconCls:node.iconCls,	
					cache:false,
					href:base_url+'index.php/dashboard/load_page/'+node.url
					
				
			});
			}
			}else{
			window.location=base_url+'index.php/login';
			}
			
		
		}
		});
		

	});
		
	function logout(){
		window.location=base_url+'index.php/logout';
		return false;
	}
</script>