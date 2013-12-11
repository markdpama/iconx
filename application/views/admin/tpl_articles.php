<div id="<?php echo $page; ?>-container" class="content">
	<div id="tools">
		<a href="<?php echo base_url(); ?>admin/articles/add_article">
			<img width="20" class="g_icon add-button" src="<?php echo base_url(); ?>_assets/images/admin/add.png" />Add Article</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text"><?php echo $page; ?></div>
	</div>

	<?php if( $articles ) { ?>
	<table class="table" id="data-info">
		<thead>
			<tr>
				<th class="width600">Title</th>
				<th class="width100">Category</th>
				<th class="width100">Created by</th>
				<th class="width75">Status</th>
				<th class="width100">Publish Date</th>
				<!--<th class="width100">Last Edited</th>-->
				<th class="width90"  data-datatable='{"bSortable":false}' ></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $articles as $p_article ) { ?>
			<tr class="data-tr">
				<td><?php echo character_limiter($p_article['title'] , 50); ?></td>
				<td><?php echo $category[$p_article['catid']]['title']; ?></td>
				<td><?php echo $p_article['created_by']; ?></td>
				<td class="align-center"><?php echo $p_article['status']; ?></td>
				<td  class="align-center"><?php echo $p_article['publish_up']; ?></td>
				<!--<td><?php echo $p_article['modified']; ?></td>-->
				<!-- actions -->
				<td class="width90" align="center">
					<a 	href="<?php echo base_url(); ?>admin/articles/edit_article/<?php echo $p_article['id']; ?>"
						class="tableicon"
						title="Edit Article">
						<img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_edit.png" />
					</a>	
					<a 	href=""
						class="tableicon"
						style="position: relative;"
						title="Article Comments">
						<img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_comment.png" />
						<span class="comment_count">0</span> 
					</a>	
					<a 	href="javascript:void(0);" 
						class="btn_delete_post tableicon" 
						title="Delete Article"
						data-post-id="<?php echo $p_article['id']; ?>" >
						<img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_delete.png" />
					</a>
					<div class="h_clearboth"></div>
				</td>								
			</tr>
			<?php  } ?>
		</tbody>			
	</table>		
	
	<?php } else { ?> 
	
		<table class="table">		
			<tr>
				<td class="nodata">
					<div class="nodata">
						<div class="icon"></div>No data to display
					</div>
				</td>
			</tr>	
		</table>
		
<?php } ?>		
</div>
<script type="text/javascript" language="javascript">

$(document).ready(function(){
	zebraTable();
	var $table = $('#data-info');
	var oTableSettings = {};
		oTableSettings.aoColumns = [];
		 
		$('thead th', $table).each(function(){
			var obj = $(this);
			var obj_d   = obj.data("datatable");       
			 
			if(obj_d && obj_d.bSortable !== undefined){
				oTableSettings.aoColumns.push({"bSortable": obj_d.bSortable });
			}else{
				oTableSettings.aoColumns.push(null);
			}
			 
		})
	oTable = $table.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 4, "desc" ]],
		"aoColumns": oTableSettings.aoColumns
	});
	
	tableHover();
});		

$(".btn_delete_post").click(function(){
	var post_id = $(this).attr('data-post-id');
	if (confirm("Are you sure you want to delete this article?")) {
		displayNotification("message", "Working...");
		$.ajax({
			url: "<?php echo base_url(); ?>admin/articles/process_delete",
			type: "POST",
			data: "post_id="+post_id,
			success: function(response, textStatus, jqXHR){
				setTimeout(function () {
					$("#main-wrapper").html(response);
					displayNotification("success", "Article deleted.");
				}, 500);
			},
			error: function(jqXHR, textStatus, errorThrown){
				displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
			}
		});		
	}
});
</script>