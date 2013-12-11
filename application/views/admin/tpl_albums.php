<div id="<?php echo $page; ?>-container" class="content">
	<div id="tools">
		<a href="<?php echo base_url(); ?>admin/albums/add_album">
			<img width="20" class="g_icon add-button" src="<?php echo base_url(); ?>_assets/images/admin/add.png" />Create New Album
		</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text"><?php echo $page; ?></div>
	</div>
	
	<div class="albums-wrapper">
		<div class="albums-inner-wrapper">
			<div class="clearboth"></div>
			<?php if( $albums ) { ?>
				<?php foreach( $albums as $album ) { ?>
					<div class="album-wrapper" id="album-wrapper-<?php echo $album['album_id']; ?>">
						<div class="clearboth"></div>
						<div class="album-top-overlay" id="album-top-overlay-<?php echo $album['album_id']; ?>" data-album-id="<?php echo $album['album_id']; ?>">
							<img src="<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_delete_white.png'; ?>" title="Delete album" class="album-delete-button" id="album-delete-button-<?php echo $album['album_id']; ?>" data-album-id="<?php echo $album['album_id']; ?>" />
							<a href="<?php echo $this->config->base_url() . 'admin/albums/edit_album/' . $album['album_id']; ?>"><img src="<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_edit_white.png'; ?>" title="Edit album" class="album-edit-button" id="album-edit-button-<?php echo $album['album_id']; ?>" /></a>
							<div class="clearboth"></div>
							<div class="top-overlay-album-details">
								<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $album['album_name']; ?>">
									<tr>
										<td class="label" title="<?php echo $album['album_name']; ?>">
											Name:
										</td>
										<td class="value" title="<?php echo $album['album_name']; ?>">
											<?php echo $album['album_short_name']; ?>
										</td>
									</tr>
								</table>
								<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $album['album_desc']; ?>">
									<tr>
										<td class="label" title="<?php echo $album['album_desc']; ?>">
											Desc:
										</td>
										<td class="value" title="<?php echo $album['album_desc']; ?>">
											<?php echo $album['album_short_desc']; ?>
										</td>
									</tr>
								</table>
								<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo ucwords($album['album_status']); ?>">
									<tr>
										<td class="label" title="<?php echo ucwords($album['album_status']); ?>">
											Status:
										</td>
										<td class="value" title="<?php echo ucwords($album['album_status']); ?>">
											<?php echo ucwords($album['album_status']); ?>
										</td>
									</tr>
								</table>
								<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $album['album_formated_publish_date']; ?>">
									<tr>
										<td class="label" title="<?php echo $album['album_formated_publish_date']; ?>">
											Pub. Date:
										</td>
										<td class="value" title="<?php echo $album['album_formated_publish_date']; ?>">
											<?php echo $album['album_formated_publish_date']; ?>
										</td>
									</tr>
								</table>
								<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $album['album_created_by']; ?>">
									<tr>
										<td class="label" title="<?php echo $album['album_created_by']; ?>">
											Created By:
										</td>
										<td class="value" title="<?php echo $album['album_created_by']; ?>">
											<?php echo $album['album_short_created_by']; ?>
										</td>
									</tr>
								</table>
								<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $album['album_sort']; ?>">
									<tr>
										<td class="label" title="<?php echo $album['album_sort']; ?>">
											Sort:
										</td>
										<td class="value" title="<?php echo $album['album_sort']; ?>">
											<?php echo $album['album_sort']; ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="album-cover">
							<img src="<?php echo $this->config->base_url() . '_assets/images/photos/' . $album['album_cover_thumb']; ?>" onError="imgError(this, '<?php echo $this->config->base_url() . '_assets/images/admin/broken-img.png'; ?>');" />
						</div>
						<div class="clearboth"></div>
						<div class="album-details">
							<table cellpadding="0" cellspacing="0" border="0" class="table first-row">
								<tr>
									<td class="table-td-label-col album-name-label">
										Name:
									</td>
									<td class="table-td-value-col album-name" title="<?php echo $album['album_desc']; ?>">
										<?php echo $album['album_short_name']; ?>
									</td>
								</tr>
							</table>
							<table cellpadding="0" cellspacing="0" border="0" class="table second-row">
								<tr>
									<td class="table-td-label-col album-photos-count-label">
										Photo(s):
									</td>
									<td class="table-td-value-col album-photos-count">
										<?php echo $album['photos_count']; ?>
									</td>
								</tr>
							</table>
						</div>
						<div class="clearboth"></div>
					</div>
				<?php } ?>
			<?php } else { ?> 
				<div>
					No albums added yet.
				</div>
			<?php } ?>
			<div class="clearboth"></div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$('.album-delete-button').click(function(){
			if( confirm('Are you sure you want to delete this album and its photos?') ){
				var album_id = $(this).attr('data-album-id');
				
				displayNotification("message", "Working...");
				$.ajax({
					url: "<?php echo base_url(); ?>admin/albums/process_delete",
					type: "POST",
					data: { album_id : album_id },
					success: function(response, textStatus, jqXHR){
						setTimeout(function () {
							var ajax_result = $.parseJSON(response);
							
							if( ajax_result.status == 'success' ){
								$("#main-wrapper").html(ajax_result.content);
								
								$('#album-wrapper-' + album_id).remove();
								
								displayNotification("success", "Album successfully deleted.");
							}else{
								displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
							}
						}, 500);
					},
					error: function(jqXHR, textStatus, errorThrown){
						displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
					}
				});
			}
		});
	});
</script>