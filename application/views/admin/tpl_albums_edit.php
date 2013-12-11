<div id="<?php echo $page; ?>-container" class="content">

	<div id="tools">
		<a href="javascript: void(0);" id="btn_edit_album" >
			<img width="20" class="g_icon" src="<?php echo base_url(); ?>_assets/images/admin/save.png" />Save Changes</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text">Edit <?php echo $page; ?> - <?php echo $album_details['album_name']; ?></div>
	</div>
	
	<form id="form_edit_album" class="form">
		<input type="hidden" name="album-id" value="<?php echo $album_details['album_id']; ?>" />
		<table class="table">
			<tr>
				<td>		
					<div class="item">
						<div class="label">Album Name</div>
						<div class="input">
							<input 	class="inputtext title" 
									type="text" 
									name="album-name" 
									data-required="1"
									value="<?php echo $album_details['album_name']; ?>" />					
						</div>
						<div class="clearboth"></div>
					</div>
					<div class="item">
						<div class="label">Album Description</div>
						<div class="input">
							<textarea	class="textarea title" 
										name="album-desc"><?php echo $album_details['album_desc']; ?></textarea>
						</div>
						<div class="clearboth"></div>
					</div>
					
					<div class="clearboth"></div>
					
					<div class="clearboth">
						<div class="item">
							<div class="label" id="album-photos-label">Photos <span id="album-photos-note">(Uploaded photos are automatically saved to the album. Deleted photos are automatically deleted from the album.)</span></div>
							<div class="clearboth"></div>
						</div>
						<div class="clearboth"></div>
						<div class="item-content">
							<div class="photos-list-wrapper">
								<script src="<?php echo $this->config->base_url(); ?>_assets/js/jquery_file_upload/vendor/jquery.ui.widget.js" type="text/javascript"></script>
								<script src="<?php echo $this->config->base_url(); ?>_assets/js/jquery_file_upload/jquery.iframe-transport.js" type="text/javascript"></script>
								<script src="<?php echo $this->config->base_url(); ?>_assets/js/jquery_file_upload/jquery.fileupload.js" type="text/javascript"></script>
								<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>_assets/js/jquery_file_upload/css/jquery.fileupload-ui.css">
								
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-success fileinput-button">
									<i class="icon-plus icon-white"></i>
									<span>Select files...</span>
									<!-- The file input field used as target for the file upload widget -->
									<input id="fileupload" type="file" name="files" multiple>
								</span>
								
								<br>
								<br>
								<!-- The global progress bar -->
								<div id="progress">
									<div class="bar"></div>
								</div>
								<br>
								
								<div id="file-upload-results-wrapper">
								</div>
								<br/>
								
								<div class="line-divider-1">&nbsp;</div>
								
								<div id="added-photos-list-wrapper">
									<?php if( isset($photos) && count($photos) > 0 ){ ?>
										<?php foreach( $photos as $photo ){ ?>
											<div class="uploaded-photo-item" id="uploaded-photo-item-<?php echo $photo['photo_id']; ?>">
												<div class="photo-item-top-overlay" id="photo-item-top-overlay-<?php echo $photo['photo_id']; ?>" data-file-id="<?php echo $photo['photo_id']; ?>">
													<img src="<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_delete_white.png'; ?>" class="remove-upload-photo-item" id="remove-upload-photo-item-<?php echo $photo['photo_id']; ?>" title="Delete photo" data-file-id="<?php echo $photo['photo_id']; ?>" data-photos="<?php echo $photo['photo_filename'] . '|' . $photo['photo_thumb_filename']; ?>" />
													<a href="<?php echo $this->config->base_url() . 'admin/photos/edit_photo/' . $photo['photo_id']; ?>"><img src="<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_edit_white.png'; ?>" title="Edit photo" class="edit-upload-photo-item" id="edit-upload-photo-item-<?php echo $photo['photo_id']; ?>" /></a>
													<div class="clearboth"></div>
													<div class="top-overlay-photo-details">
														<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $photo['photo_filename']; ?>">
															<tr>
																<td class="label" title="<?php echo $photo['photo_filename']; ?>">
																	Filename:
																</td>
																<td class="value" title="<?php echo $photo['photo_filename']; ?>">
																	<?php echo $photo['photo_short_filename']; ?>
																</td>
															</tr>
														</table>
														<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $photo['photo_thumb_filename']; ?>">
															<tr>
																<td class="label" title="<?php echo $photo['photo_thumb_filename']; ?>">
																	Thumbnail:
																</td>
																<td class="value" title="<?php echo $photo['photo_thumb_filename']; ?>">
																	<?php echo $photo['photo_short_thumb_filename']; ?>
																</td>
															</tr>
														</table>
														<?php if( trim($photo['photo_short_caption']) != '' ){ ?>
															<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $photo['photo_caption']; ?>">
																<tr>
																	<td class="label" title="<?php echo $photo['photo_caption']; ?>">
																		Caption:
																	</td>
																	<td class="value" title="<?php echo $photo['photo_caption']; ?>">
																		<?php echo $photo['photo_short_caption']; ?>
																	</td>
																</tr>
														<?php }else{ ?>
															<table cellpadding="0" cellspacing="0" border="0" class="table" title="-None-">
																<tr>
																	<td class="label" title="-None-">
																		Caption:
																	</td>
																	<td class="value" title="-None-">
																		-None-
																	</td>
																</tr>
														<?php } ?>
														</table>
														<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo date('Y-m-d', strtotime($photo['date_uploaded'])); ?>">
															<tr>
																<td class="label" title="<?php echo date('Y-m-d', strtotime($photo['date_uploaded'])); ?>">
																	Date Uploaded:
																</td>
																<td class="value" title="<?php echo $photo['date_uploaded']; ?>">
																	<?php echo date('Y-m-d', strtotime($photo['date_uploaded'])); ?>
																</td>
															</tr>
														</table>
														<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $photo['uploaded_by']; ?>">
															<tr>
																<td class="label" title="<?php echo $photo['uploaded_by']; ?>">
																	Uploaded By:
																</td>
																<td class="value" title="<?php echo $photo['uploaded_by']; ?>">
																	<?php echo $photo['short_uploaded_by']; ?>
																</td>
															</tr>
														</table>
														<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo ucwords($photo['photo_status']); ?>">
															<tr>
																<td class="label" title="<?php echo ucwords($photo['photo_status']); ?>">
																	Status:
																</td>
																<td class="value" title="<?php echo ucwords($photo['photo_status']); ?>">
																	<?php echo ucwords($photo['photo_status']); ?>
																</td>
															</tr>
														</table>
														<table cellpadding="0" cellspacing="0" border="0" class="table" title="<?php echo $photo['photo_sort']; ?>">
															<tr>
																<td class="label" title="<?php echo $photo['photo_sort']; ?>">
																	Sort:
																</td>
																<td class="value" title="<?php echo $photo['photo_sort']; ?>">
																	<?php echo $photo['photo_sort']; ?>
																</td>
															</tr>
														</table>
													</div>
												</div>
												<input type="hidden" name="photosfilenames[]" value="<?php echo $photo['photo_filename']; ?>|<?php echo $photo['photo_thumb_filename']; ?>" />
												<div class="photo-wrapper">
													<img src="<?php echo $this->config->base_url(); ?>_assets/images/photos/<?php echo $photo['photo_thumb_filename']; ?>" title="<?php echo $photo['photo_caption']; ?>" onError="imgError(this, '<?php echo $this->config->base_url() . '_assets/images/admin/broken-img.png'; ?>');" />
												</div>
												<div class="photo-text-wrapper">
													<?php echo $photo['photo_short_filename']; ?>
												</div>
												<div class="clearboth"></div>
											</div>
										<?php } ?>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>		
				</td>	
				<td width="200" class="published-info-wrapper">
					<div id="published-info">
						<div class="item">
							<div class="label pub_date">Publish Date</div>
							<div class="input">
								<input 	class="inputtext dpicker" 
										type="text" 
										id="album-publish-date" 
										name="album-publish-date"
										data-required="1" />
										
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="item">
							<div class="label">Status</div>
							<div class="input">
								<select class="select" name="album-status">
									<option data-required="1" value="published" <?php if( $album_details['album_status'] == 'published' ){ echo 'selected="selected"'; } ?>>Published</option>
									<option data-required="1" value="unpublished" <?php if( $album_details['album_status'] == 'unpublished' ){ echo 'selected="selected"'; } ?>>Unpublished</option>
									<option data-required="1" value="draft" <?php if( $album_details['album_status'] == 'draft' ){ echo 'selected="selected"'; } ?>>Draft</option>
								</select>				
							</div>
						</div>								
						<div class="item">
							<div class="label">Created by</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										name="album-created-by"
										id="album-created-by"
										value="<?php echo $album_details['album_created_by']; ?>"
										data-required="1" />					
							</div>
							<div class="clearboth"></div>
						</div>								
						<div class="item">
							<div class="label">Album Sort</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										onkeypress="return isNumber(event)" 
										name="album-sort" 
										maxlength="9" 
										data-required="1" 
										data-non-zero="1" 
										data-is-number="1" 
										data-name="Album Sort"
										value="<?php echo $album_details['album_sort']; ?>" />					
							</div>
							<div class="clearboth"></div>
						</div>						
						<div class="item">
							<div class="label height29">Featured image</div>
							<div class="input cover_image">
								<div id="album-cover-top-overlay">
									<input type="hidden" value="<?php echo $album_details['album_cover']; ?>" name="old-cover-image-name" id="old-cover-image-name" />
									<input type="hidden" value="<?php echo $album_details['album_cover_thumb']; ?>" name="old-cover-thumb-image-name" id="old-cover-thumb-image-name" />
									<img src="<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_delete_white.png'; ?>" id="remove-cover-image-item" title="Remove photo" />
								</div>
								<div id="cover_image_wrapper">
									<input type="hidden" value="<?php echo $album_details['album_cover']; ?>" name="cover-image-name" id="cover-image-name" />
									<input type="hidden" value="<?php echo $album_details['album_cover_thumb']; ?>" name="cover-thumb-image-name" id="cover-thumb-image-name" />
									<img src="<?php echo $this->config->base_url() . '_assets/images/photos/' . $album_details['album_cover_thumb']; ?>" title="<?php echo $album_details['album_cover_thumb']; ?>" alt="<?php echo $album_details['album_cover_thumb']; ?>" class="cover_image" onError="imgError(this, '<?php echo $this->config->base_url() . '_assets/images/admin/broken-img.png'; ?>');" />
								</div>
								<a id="change_cover_image">Upload image</a><div id="upload_result"></div>						
							</div>
							<div class="clearboth"></div>
						</div>	
						<div class="clearboth"></div>
					</div>						
				</td>	
			</tr>	
		</table>
	</form>
</div>
<script type="text/javascript">
	<?php $timestamp = time();?>
	
	$(function() {
		$('#fileupload').fileupload({
			url: '<?php echo $this->config->base_url(); ?>admin/albums/multiple_photos_upload_edit',
			dataType : 'json',
			formData: {
				'timestamp' 	: '<?php echo $timestamp;?>',
				'token'     	: '<?php echo md5('unique_salt' . $timestamp);?>',
				'albumid'		: '<?php echo $album_details['album_id'];?>',
				'uploaded_by'	: $('#album-created-by').val()
			},
			start: function(e){
				$('#file-upload-results-wrapper').html('');
				$('#progress .bar').css(
					'width',
					'0%'
				);
			},
			done: function (e, data) {
				$.each(data.result.files, function (index, file) {
					if(file.status == 'success' ){
						var uploaded_photo_item_string = '<div class="uploaded-photo-item" id="uploaded-photo-item-' + file.id + '">';
							uploaded_photo_item_string += '<div class="photo-item-top-overlay" id="photo-item-top-overlay-' + file.id + '" data-file-id="' + file.id + '">';
								uploaded_photo_item_string += '<img src="' + '<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_delete_white.png'; ?>"' + ' class="remove-upload-photo-item" id="remove-upload-photo-item-' + file.id + '" title="Delete photo" data-file-id="' + file.id + '" />';
								uploaded_photo_item_string += '<a href="' + '<?php echo $this->config->base_url() . 'admin/photos/edit_photo/'; ?>' + file.id + '"><img src="' + '<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_edit_white.png'; ?>' + '" title="Edit photo" class="edit-upload-photo-item" id="edit-upload-photo-item-' + file.id + '" /></a>';
								uploaded_photo_item_string += '<div class="clearboth"></div>';
								uploaded_photo_item_string += '<div class="top-overlay-photo-details">';
									uploaded_photo_item_string += '<table cellpadding="0" cellspacing="0" border="0" class="table" title="' + file.filename + '">';
										uploaded_photo_item_string += '<tr>';
											uploaded_photo_item_string += '<td class="label" title="' + file.filename + '">';
												uploaded_photo_item_string += 'Filename:';
											uploaded_photo_item_string += '</td>';
											uploaded_photo_item_string += '<td class="value" title="' + file.filename + '">';
												uploaded_photo_item_string += shortenStringWithEllipsis(file.filename, 10);
											uploaded_photo_item_string += '</td>';
										uploaded_photo_item_string += '</tr>';
									uploaded_photo_item_string += '</table>';
									uploaded_photo_item_string += '<table cellpadding="0" cellspacing="0" border="0" class="table" title="' + file.thumbfilename + '">';
										uploaded_photo_item_string += '<tr>';
											uploaded_photo_item_string += '<td class="label" title="' + file.thumbfilename + '">';
												uploaded_photo_item_string += 'Thumbnail:';
											uploaded_photo_item_string += '</td>';
											uploaded_photo_item_string += '<td class="value" title="' + file.thumbfilename + '">';
												uploaded_photo_item_string += shortenStringWithEllipsis(file.thumbfilename, 10);
											uploaded_photo_item_string += '</td>';
										uploaded_photo_item_string += '</tr>';
									uploaded_photo_item_string += '</table>';
									uploaded_photo_item_string += '<table cellpadding="0" cellspacing="0" border="0" class="table" title="-None-">';
										uploaded_photo_item_string += '<tr>';
											uploaded_photo_item_string += '<td class="label" title="-None-">';
												uploaded_photo_item_string += 'Caption:';
											uploaded_photo_item_string += '</td>';
											uploaded_photo_item_string += '<td class="value" title="-None-">';
												uploaded_photo_item_string += '-None-';
											uploaded_photo_item_string += '</td>';
										uploaded_photo_item_string += '</tr>';
									uploaded_photo_item_string += '</table>';
									uploaded_photo_item_string += '<table cellpadding="0" cellspacing="0" border="0" class="table" title="' + file.dateuploaded + '">';
										uploaded_photo_item_string += '<tr>';
											uploaded_photo_item_string += '<td class="label" title="' + file.dateuploaded + '">';
												uploaded_photo_item_string += 'Date Uploaded:';
											uploaded_photo_item_string += '</td>';
											uploaded_photo_item_string += '<td class="value" title="' + file.dateuploaded + '">';
												uploaded_photo_item_string += file.dateuploaded;
											uploaded_photo_item_string += '</td>';
										uploaded_photo_item_string += '</tr>';
									uploaded_photo_item_string += '</table>';
									uploaded_photo_item_string += '<table cellpadding="0" cellspacing="0" border="0" class="table" title="' + file.uploadedby + '">';
										uploaded_photo_item_string += '<tr>';
											uploaded_photo_item_string += '<td class="label" title="' + file.uploadedby + '">';
												uploaded_photo_item_string += 'Uploaded By:';
											uploaded_photo_item_string += '</td>';
											uploaded_photo_item_string += '<td class="value" title="' + file.uploadedby + '">';
												uploaded_photo_item_string += shortenStringWithEllipsis(file.uploadedby, 10);
											uploaded_photo_item_string += '</td>';
										uploaded_photo_item_string += '</tr>';
									uploaded_photo_item_string += '</table>';
									uploaded_photo_item_string += '<table cellpadding="0" cellspacing="0" border="0" class="table" title="Draft">';
										uploaded_photo_item_string += '<tr>';
											uploaded_photo_item_string += '<td class="label" title="Draft">';
												uploaded_photo_item_string += 'Status:';
											uploaded_photo_item_string += '</td>';
											uploaded_photo_item_string += '<td class="value" title="Draft">';
												uploaded_photo_item_string += 'Draft';
											uploaded_photo_item_string += '</td>';
										uploaded_photo_item_string += '</tr>';
									uploaded_photo_item_string += '</table>';
									uploaded_photo_item_string += '<table cellpadding="0" cellspacing="0" border="0" class="table" title="0">';
										uploaded_photo_item_string += '<tr>';
											uploaded_photo_item_string += '<td class="label" title="0">';
												uploaded_photo_item_string += 'Sort:';
											uploaded_photo_item_string += '</td>';
											uploaded_photo_item_string += '<td class="value" title="0">';
												uploaded_photo_item_string += file.sort;
											uploaded_photo_item_string += '</td>';
										uploaded_photo_item_string += '</tr>';
									uploaded_photo_item_string += '</table>';
								uploaded_photo_item_string += '</div>';
							uploaded_photo_item_string += '</div>';
							uploaded_photo_item_string += '<input type="hidden" name="photosfilenames[]" value="' + file.filename + '|' + file.thumbfilename + '" />';
							uploaded_photo_item_string += '<div class="photo-wrapper">';
								uploaded_photo_item_string += '<img src="' + '<?php echo $this->config->base_url(); ?>' + '_assets/images/photos/' + file.thumbfilename + '" title="' + file.filename + '" />';
							uploaded_photo_item_string += '</div>';
							uploaded_photo_item_string += '<div class="photo-text-wrapper">';
							uploaded_photo_item_string += shortenStringWithEllipsis(file.filename, 10);
							uploaded_photo_item_string += '</div>';
							uploaded_photo_item_string += '<div class="clearboth"></div>';
						uploaded_photo_item_string += '</div>'
						
						$('#added-photos-list-wrapper').append(uploaded_photo_item_string);
						
						$('#remove-upload-photo-item-' + file.id).click(function(){
							var photo_id = $(this).attr('data-file-id');
							
							delete_photo(photo_id);
						});
						
						setTimeout(function () {
							displayNotification("success", "New photo successfully added.");
						}, 500);
					}
					if(file.status == 'error' ){
						var file_upload_result_string = '';
						file_upload_result_string += '<div class="file-upload-result-item" id="file-upload-result-item-' + file.id + '">';
							file_upload_result_string += file.msg;
						file_upload_result_string += '</div>';
						
						$('#file-upload-results-wrapper').append(file_upload_result_string);
					}
				});
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress .bar').css(
					'width',
					progress + '%'
				);
			},
			fail: function (e, data) {
				//alert(data.errorThrown+'x');
				//alert(data.textStatus+'y');
				//alert(data.jqXHR+'z');
			}
		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
</script>
<script type="text/javascript" language="javascript">
	function delete_photo(photo_id){
		if( confirm('Are you sure you want to delete this photo?') ){
			displayNotification("message", "Working...");
			$.ajax({
				url: "<?php echo base_url(); ?>admin/albums/process_delete_photo_from_album",
				type: "POST",
				data: {photo_id : photo_id},
				success: function(response, textStatus, jqXHR){
					setTimeout(function () {
						var ajax_result = $.parseJSON(response);
						
						if( ajax_result.status == 'success' ){
							$('#uploaded-photo-item-' + photo_id).remove();
							displayNotification("success", "Photo successfully deleted from the album.");
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
	}
	
	$(document).ready(function(){
		$('.remove-upload-photo-item').click(function(){
			var photo_id = $(this).attr('data-file-id');
			
			delete_photo(photo_id);
		});
		
		$('#album-cover-top-overlay, #remove-cover-image-item').mouseover(function(){
			var cover_contents = $('#cover_image_wrapper').html();
			cover_contents = $.trim(cover_contents);
			
			if( cover_contents != '' ){
				$('#album-cover-top-overlay').addClass('hover');
				//$('#album-cover-top-overlay').attr('title', 'Remove photo');
			}
		});
		$('#album-cover-top-overlay, #remove-cover-image-item').mouseout(function(){
			$('#album-cover-top-overlay').removeClass('hover');
			//$('#album-cover-top-overlay').attr('title', '');
		});
		$('#remove-cover-image-item').click(function(){
			if( $('#album-cover-top-overlay').hasClass('hover') ){
				if( confirm("Do you want to remove this photo?") ){
					$('#cover_image_wrapper').html('');
					$('#album-cover-top-overlay').removeClass('hover');
					//$('#album-cover-top-overlay').attr('title', '');
				}
			}
		});
		
		$( "#album-publish-date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
		<?php if( trim($album_details['album_publish_date']) != '' && date('Y-m-d', strtotime($album_details['album_publish_date'])) != '1970-01-01'){ ?>
			$( "#album-publish-date" ).datepicker("setDate", "<?php echo date('Y-m-d', strtotime($album_details['album_publish_date'])); ?>");
		<?php } ?>
		
		$("#btn_edit_album").click(function(){
			if (validate_form("form_edit_album")) {
				displayNotification("message", "Working...");
				$.ajax({
					url: "<?php echo base_url(); ?>admin/albums/process_edit",
					type: "POST",
					data: $("#form_edit_album").serialize(),
					success: function(response, textStatus, jqXHR){
						setTimeout(function () {
							$("#main-wrapper").html(response);
							if (typeof history.pushState != 'undefined') { window.history.pushState("object or string", "Title", "<?php echo base_url(); ?>admin/albums/"); }
							displayNotification("success", "Album successfully updated.");
						}, 500);
					},
					error: function(jqXHR, textStatus, errorThrown){
						displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
					}
				});
			}
		});
		
		var btnUpload=$('#change_cover_image');
		var mestatus=$('#upload_result');
		var files=$('#cover_image_wrapper');
		new AjaxUpload( btnUpload, {
			action: '<?php echo base_url(); ?>admin/albums/upload_album_cover_image',
			name: 'cover_image',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
					mestatus.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				displayNotification("message", "Working...");
			},
			onComplete: function(file, response){
				var data = jQuery.parseJSON(response);
				files.html('');
				if(data.status==="success"){
					var album_cover_string = '<input type="hidden" value="' + data.filename + '" name="cover-image-name" id="cover-image-name">';
					album_cover_string += '<input type="hidden" value="' + data.thumbfilename + '" name="cover-thumb-image-name" id="cover-thumb-image-name">';
					album_cover_string += '<img src="<?php echo base_url(); ?>_assets/images/photos/'+data.thumbfilename+'" title="' + data.filename + '" alt="' + data.filename + '" class="cover_image" />';
					
					$('#cover_image_wrapper').append(album_cover_string);
					displayNotification("success", data.msg);
				} else{
					displayNotification("error", data.msg);
				}
			}
		});
	});
</script>