<?php add_thickbox(); ?>
<?php
	add_action('admin_menu', 'setTags_menu');
	function setTags_menu() {
    	add_menu_page('SetTags','SetTags', 'manage_options', 'mkit','mkit_options_page');
	}
	
	function mkit_options_page(){
	?>
	<script type="text/javascript" src="../wp-content/plugins/setTags/js/jquery.js"></script>
	<script type="text/javascript" src="../wp-content/plugins/setTags/js/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../wp-content/plugins/setTags/js/datatables/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="../wp-content/plugins/setTags/js/bootstrap/css/bootstrap.css"/>

	<link rel="stylesheet" type="text/css" href="../wp-content/plugins/setTags/js/datatables/css/jquery.dataTables.css"/>


	<div class="wrap">
		<table class="table table-striped table-bordered dtable" >
			<thead>
				<tr>
				
				<td> 作 者 </td>
				<td> 标 题 </td>
				<td> 类 别 </td>
				<td> 内 容 </td>
				<td> 关键字 </td>
				<td>添加时间</td>
				<td> 域 名</td>
				<td>图片统计</td>
				<td>uuid</td>
				<td>添加标签</td>
				<td> 等 级 </td>
				<td> 确 认 </td>
				</tr>
			</thead>
			<tbody></tbody>
		</table>		
	</div>

	<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			//alert("manPage");
			initDataTable();
		});
      function initDataTable() {
		oTable = $('.dtable').DataTable({
		"dom": '<"top">rt<"bottom"ip><"clear">',
		//"sAjaxSource" : '../wp-content/plugins/setTags/include/query.php',	
		"ajax": {
			"type": "GET",
			"url": "../wp-content/plugins/setTags/include/query.php",
			"data": function(d) {
				// d.relateid = $('#relateid').val(),
				// d.clearstatus = $('#clearStatus').val();
			}
		},
		"processing": true,
        "serverSide": true,
		"ordering": true,
		"aLengthMenu": [5, 10, 20, 40 ],
		"iDisplayLength" : 10,
		"oLanguage": {
			"sUrl": "../wp-content/plugins/setTags/js/datatable.cn.txt"
		},
		"aoColumns": [
					//{"mDataProp":null},
		            {"mDataProp":"author"},
		            {"mDataProp":"title"},
		  			{"mDataProp":"app_category"},
		  			{"mDataProp":"content"},
		  			{"mDataProp":"keywords"},
		  			{"mDataProp":"add_time"},
		  			{"mDataProp":"domain"},
		  			{"mDataProp":"image_count"},
		  			{"mDataProp":"uuid"},
		  			{"mDataProp":null},
		  			{"mDataProp":null},
		  			{"mDataProp":null}
		  		],
		"columnDefs": [{
					"render": function (data, type, row) {
						return '<a class="thickbox"  title="文章内容" href="../wp-content/plugins/setTags/include/page.php?uuid='+row.uuid+'&TB_iframe=true&width=750&height=600" >点击查看</a>';
		        	   },
		        	   "targets": 3
				},{
					"render": function (data, type, row) {
						return '<a class="thickbox"  title="关键字" href="../wp-content/plugins/setTags/include/keywords.php?uuid='+row.uuid+'&TB_iframe=true&width=600&height=300" >查看关键字</a>';
		        	   },
		        	   "targets": 4
				},{
					"render": function (data, type, row) {
		        		  return  data + '<input type="hidden" id="uuid" name="uuid"  value="'+data+'"/>';
		        	   },
		        	   "targets": 8
				},{
		  			"render": function (data, type, row) {
		  				if (row.tags != null) { 
		  					return  '<input type="text" id="tags_'+row.uuid+'"  value="'+row.tags+'"/>';
		  				}
		        		  return  '<input type="text" id="tags_'+row.uuid+'"  value=""/>';
		        	   },
		        	   "targets": 9
		  		},{

		  			"render": function (data, type, row) {
		  				if(row.level == 2){
		  					return  '<select id="level_'+row.uuid+'"> <option value ="1">HOT</option> <option value ="2" selected="selected">NORMAL</option> </select>';
		  				}
		        		  return  '<select id="level_'+row.uuid+'"> <option value ="1">HOT</option> <option value ="2" >NORMAL</option> </select>';
		        	   },
		        	   "targets": 10
		  		},{
		  			"render": function (data, type, row) {
		        		  return  '<input type="button"  name="sub"  onclick="postData(\''+row.uuid+'\')" value="确认" class="btn btn-success btn-sm"/>';
		        	   },
		        	   "targets": 11
		  		}
		   	]
		});
	// //前台添加序号
	// oTable.on('draw.dt',function() {
	// 	oTable.column(0).nodes().each(function(cell, i) {
	//         cell.innerHTML = i + 1;
	//     });
	// }).draw();

}


//提交数据
function postData(uuid){
	var tags = $("#tags_"+uuid).val();
	var level = $("#level_"+uuid).val();
	var str = '{'+'"uuid":"'+uuid+'",'+'"tags":"'+$("#tags_"+uuid).val()+'",'+'"level":"'+$("#level_"+uuid).val()+'"}'; 
	$.ajax({
		cache:false,
		type:"POST",
		url:"../wp-content/plugins/setTags/include/update.php",
		data:{"info":str},
		async:true,
		error: function(request) {
			alert("error");
        },
        success: function(data) {
        	oTable.ajax.reload();
        }
});
}
</script>
<?php
	}
?>