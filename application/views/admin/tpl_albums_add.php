<div id="<?php echo $page; ?>-container" class="content">

	<div id="tools">
		<a href="javascript: void(0);" id="btn_add_album" >
			<img width="20" class="g_icon" src="<?php echo base_url(); ?>_assets/images/admin/save.png" />Save Album</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text">New <?php echo $page; ?></div>
	</div>
	
	<form id="form_add_album" class="form">
		<table class="table">
			<tr>
				<td>		
					<div class="item">
						<div class="label">Album Name</div>
						<div class="input">
							<input 	class="inputtext title" 
									type="text" 
									name="album-name" 
									data-required="1" />					
						</div>
						<div class="clearboth"></div>
					</div>
					<div class="item">
						<div class="label">Album Description</div>
						<div class="input">
							<textarea	class="textarea title" 
										name="album-desc"></textarea>
						</div>
						<div class="clearboth"></div>
					</div>
					
					
					<div class="clearboth"></div>
					
					<div style="clearboth">
						<div class="item">
							<div class="label" id="album-photos-label">Photos <span id="album-photos-note">(Successfully uploaded and saved photos will be renamed.)</span></div>
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
								
								<div id="added-photos-list-wrapper"></div>
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
									<option data-required="1" value="published" selected="selected">Published</option>
									<option data-required="1" value="unpublished">Unpublished</option>
									<option data-required="1" value="draft">Draft</option>
								</select>				
							</div>
						</div>								
						<div class="item">
							<div class="label">Created by</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										name="album-created-by"
										value="<?php echo $this->session->userdata('first_name')." ". $this->session->userdata('last_name') ; ?>"
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
										data-name="Album Sort" />
							</div>
							<div class="clearboth"></div>
						</div>						
						<div class="item">
							<div class="label height29">Featured image</div>
							<div class="input cover_image">
								<div id="album-cover-top-overlay">
									<img src="<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_delete_white.png'; ?>" id="remove-cover-image-item" title="Remove photo" />
								</div>
								<div id="cover_image_wrapper">
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
			url: '<?php echo $this->config->base_url(); ?>admin/albums/multiple_photos_upload',
			dataType : 'json',
			formData: {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
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
					if( file.status == 'success' ){
						var uploaded_photo_item_string = '<div class="uploaded-photo-item" id="uploaded-photo-item-' + file.id + '">';
							uploaded_photo_item_string += '<div class="photo-item-top-overlay" id="photo-item-top-overlay-' + file.id + '" data-file-id="' + file.id + '" title="' + file.filename + '">';
								uploaded_photo_item_string += '<img src="' + '<?php echo $this->config->base_url() . '_assets/images/admin/global_icon_delete_white.png'; ?>' + '" class="remove-upload-photo-item" id="remove-upload-photo-item-' + file.id + '" title="Remove photo" data-file-id="' + file.id + '" data-photos="' + file.filename + '|' + file.thumbfilename + '" />';
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
						
						var file_upload_result_string = '';
						file_upload_result_string += '<div class="file-upload-result-item" id="file-upload-result-item-' + file.id + '">';
							file_upload_result_string += file.msg;
						file_upload_result_string += '</div>';
						
						$('#file-upload-results-wrapper').append(file_upload_result_string);
						
						$('#remove-upload-photo-item-' + file.id).click(function(){
							$('#file-upload-results-wrapper').html('');
							$('#progress .bar').css(
								'width',
								'0%'
							);
							
							var file_id = $(this).attr('data-file-id');
							
							if( confirm("Do you want to remove this photo?") ){
								var photos = $(this).attr('data-photos');
								
								displayNotification("message", "Working...");
								$.ajax({
									url: "<?php echo base_url(); ?>admin/albums/delete_unsaved_uploaded_photos",
									type: "POST",
									data: { photos : photos },
									success: function(response, textStatus, jqXHR){
										setTimeout(function () {
											$('#uploaded-photo-item-' + file_id).remove();
										}, 500);
									},
									error: function(jqXHR, textStatus, errorThrown){
										$('#uploaded-photo-item-' + file_id).remove();
									}
								});
								displayNotification("success", "The photo was successfully deleted and won't be saved in the album.");
							}
						});
						
						setTimeout(function () {
							displayNotification("success", "New photo successfully uploaded.");
						}, 500);
					}
					if( file.status == 'error' ){
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
	$(document).ready(function(){
		$('#album-cover-top-overlay, #remove-cover-image-item').mouseover(function(){
			var cover_contents = $('#cover_image_wrapper').html();
			cover_contents = $.trim(cover_contents);
			
			if( cover_contents != '' ){
				$('#album-cover-top-overlay').addClass('hover');
				//$('#album-cover-top-overlay').attr('title', 'Remove image');
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
				}
			}
		});
		
		$( "#album-publish-date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
		$( "#album-publish-date" ).datepicker("setDate", "<?php echo date('Y-m-d'); ?>");
	
		$("#btn_add_album").click(function(){
			if (validate_form("form_add_album")) {
				displayNotification("message", "Working...");
				$.ajax({
					url: "<?php echo base_url(); ?>admin/albums/process_add",
					type: "POST",
					data: $("#form_add_album").serialize(),
					success: function(response, textStatus, jqXHR){
						setTimeout(function () {
							$("#main-wrapper").html(response);
							if (typeof history.pushState != 'undefined') { window.history.pushState("object or string", "Title", "<?php echo base_url(); ?>admin/albums/"); }
							displayNotification("success", "New album successfully added.");
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