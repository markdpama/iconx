<div id="<?php echo $page; ?>-container" class="content">
	<div id="tools">
		<a href="<?php echo base_url(); ?>admin/videos/add_video">
			<img width="20" class="g_icon add-button" src="<?php echo base_url(); ?>_assets/images/admin/add.png" />Add Video</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text"><?php echo $page; ?></div>
	</div>

	<?php if( $videos ) { ?>
	<table class="table" id="data-info">
		<thead>
			<tr>
				<th class="width600">Title</th>
				<th class="width100">Type</th>
				<th class="width100">Uploaded by</th>
				<th class="width75">Status</th>
				<th class="width75">Likes</th>
				<th class="width82">Dislikes</th>
				<!--<th class="width100">Last Edited</th>-->
				<th class="width50"  data-datatable='{"bSortable":false}' ></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $videos as $p_video ) { ?>
			<tr class="data-tr">
				<td><?php echo character_limiter($p_video['title'], 50); ?></td>
				<td><?php echo $p_video['type']; ?></td>
				<td><?php echo $p_video['uploaded_by']; ?></td>
				<td class="align-center"><?php echo $p_video['status']; ?></td>
				<td class="align-center"><?php echo $p_video['likes']; ?></td>
				<td class="align-center"><?php echo $p_video['dislikes']; ?></td>
				<!--<td><?php echo $p_video['modified']; ?></td>-->
				<!-- actions -->
				<td class="width90" align="center">
					<a 	href="<?php echo base_url(); ?>admin/videos/edit_video/<?php echo $p_video['id']; ?>"
						class="tableicon"
						title="Edit Video">
						<img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_edit.png" />
					</a>	
					<a 	href=""
						class="tableicon"
						style="position: relative;"
						title="Video Comments">
						<img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_comment.png" />
						<span class="comment_count">0</span> 
					</a>	
					<a 	href="javascript:void(0);" 
						class="btn_delete_video tableicon" 
						title="Delete Video"
						data-video-id="<?php echo $p_video['id']; ?>"
						data-video-thumb="<?php echo $p_video['thumb']; ?>"
						data-video-file="<?php echo $p_video['video']; ?>" >
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
		//"aaSorting": [[ 4, "desc" ]],
		"aoColumns": oTableSettings.aoColumns
	});	
	
	tableHover();
	
});		

$(".btn_delete_video").click(function(){
	var video_id 	= $(this).attr('data-video-id');
	var video_file 	= $(this).attr('data-video-file');
	var video_thumb = $(this).attr('data-video-thumb');
	if (confirm("Are you sure you want to delete this video?")) {
		displayNotification("message", "Working...");
		$.ajax({
			url: "<?php echo base_url(); ?>admin/videos/process_delete",
			type: "POST",
			data: "video_id="+video_id+"&video_file="+video_file+"&video_thumb="+video_thumb,
			success: function(response, textStatus, jqXHR){
				setTimeout(function () {
					$("#main-wrapper").html(response);
					displayNotification("success", "Video deleted.");
				}, 500);
			},
			error: function(jqXHR, textStatus, errorThrown){
				displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
			}
		});		
	}
});
</script>