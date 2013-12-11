<div id="<?php echo $page; ?>-container" class="content">

	<div id="tools">
		<a href="javascript: void(0);" id="btn_edit_photo" >
			<img width="20" class="g_icon" src="<?php echo base_url(); ?>_assets/images/admin/save.png" />Save Changes</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text">Edit <?php echo $page; ?> - <?php echo $photo_details['photo_filename']; ?></div>
	</div>
	
	<form id="form_edit_photo" class="form">
		<input type="hidden" name="photo-id" value="<?php echo $photo_details['photo_id']; ?>" />
		<input type="hidden" name="albumid" value="<?php echo $photo_details['albumid']; ?>" />
		<table class="table">
			<tr>
				<td class="form-first-col">		
					<div class="item">
						<div class="label">Photo Caption</div>
						<div class="input">
							<input 	class="inputtext title" 
									type="text" 
									name="photo-caption" 
									data-required="1"
									value="<?php echo $photo_details['photo_caption']; ?>" />					
						</div>
						<div class="clearboth"></div>
					</div>	
					<div class="item">
						<div class="label">Photo</div>
						<div class="input">
							<input type="hidden" name="old-photo-filename" value="<?php echo $photo_details['photo_filename']; ?>" />
							<input type="hidden" name="old-photo-thumb-filename" value="<?php echo $photo_details['photo_thumb_filename']; ?>" />
							<div class="img-photo-wrapper" id="upload-img-photo-wrapper">
								<input type="hidden" name="photo-filename" value="<?php echo $photo_details['photo_filename']; ?>" />
								<input type="hidden" name="photo-thumb-filename" value="<?php echo $photo_details['photo_thumb_filename']; ?>" />
								<img src="<?php echo $this->config->base_url() . '_assets/images/photos/' . $photo_details['photo_filename']; ?>" class="img-photo" onError="imgError(this, '<?php echo $this->config->base_url() . '_assets/images/admin/broken-img.png'; ?>');" />
								<div class="clearboth"></div>
							</div>
							<div class="clearboth"></div>
							<div class="center"><a id="change_photo">Upload image</a><div id="upload_result"></div></div>
						</div>
						<div class="clearboth"></div>
					</div>	
				</td>	
				<td width="200" class="published-info-wrapper">
					<div id="published-info">
						<div class="item">
							<div class="label pub_date">Date uploaded</div>
							<div class="input">
								<input 	class="inputtext dpicker" 
										type="text" 
										id="date-uploaded" 
										name="date-uploaded"
										data-required="1" />
										
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="item">
							<div class="label">Status</div>
							<div class="input">
								<select class="select" name="photo-status">
									<option data-required="1" value="published" <?php if( $photo_details['photo_status'] == 'published' ){ echo 'selected="selected"'; } ?>>Published</option>
									<option data-required="1" value="unpublished" <?php if( $photo_details['photo_status'] == 'unpublished' ){ echo 'selected="selected"'; } ?>>Unpublished</option>
									<option data-required="1" value="draft" <?php if( $photo_details['photo_status'] == 'draft' ){ echo 'selected="selected"'; } ?>>Draft</option>
								</select>				
							</div>
						</div>								
						<div class="item">
							<div class="label">Uploaded by</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										name="uploaded-by"
										value="<?php echo $photo_details['uploaded_by']; ?>"
										data-required="1" />					
							</div>
							<div class="clearboth"></div>
						</div>								
						<div class="item">
							<div class="label">Photo Sort</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										onkeypress="return isNumber(event)" 
										name="photo-sort" 
										maxlength="9" 
										data-required="1" 
										data-non-zero="1" 
										data-is-number="1" 
										data-name="Photo Sort"
										value="<?php echo $photo_details['photo_sort']; ?>" />					
							</div>
							<div class="clearboth"></div>
						</div>						
						<div class="item">
							<div class="label height29">Thumbnail</div>
							<div class="input cover_image">
								<div class="photo-thumb-wrapper">
									<img src="<?php echo $this->config->base_url() . '_assets/images/photos/' . $photo_details['photo_thumb_filename'];?>" class="photo-thumb" id="img-photo-thumb" onError="imgError(this, '<?php echo $this->config->base_url() . '_assets/images/admin/broken-img.png'; ?>');" />
								</div>
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
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$( "#date-uploaded" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
		<?php if( trim($photo_details['date_uploaded']) != '' && date('Y-m-d', strtotime($photo_details['date_uploaded'])) != '1970-01-01'){ ?>
			$( "#date-uploaded" ).datepicker("setDate", "<?php echo date('Y-m-d', strtotime($photo_details['date_uploaded'])); ?>");
		<?php } ?>
		
		$("#btn_edit_photo").click(function(){
			if (validate_form("form_edit_photo")) {
				displayNotification("message", "Working...");
				$.ajax({
					url: "<?php echo base_url(); ?>admin/photos/process_edit",
					type: "POST",
					data: $("#form_edit_photo").serialize(),
					success: function(response, textStatus, jqXHR){
						setTimeout(function () {
							$("#main-wrapper").html(response);
							if (typeof history.pushState != 'undefined') { window.history.pushState("object or string", "Title", "<?php echo base_url(); ?>admin/albums/edit_album/<?php echo $photo_details['albumid']; ?>"); }
							displayNotification("success", "Photo successfully updated.");
						}, 500);
					},
					error: function(jqXHR, textStatus, errorThrown){
						displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
					}
				});
			}
		});
		
		var btnUpload=$('#change_photo');
		var mestatus=$('#upload_result');
		var files=$('#upload-img-photo-wrapper');
		new AjaxUpload( btnUpload, {
			action: '<?php echo base_url(); ?>admin/photos/upload_photo',
			name: 'photo_image',
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
					var photo_string = '<input type="hidden" name="photo-thumb-filename" value="' + data.filename + '" />';
					photo_string += '<input type="hidden" name="photo-filename" value="' + data.filename + '" />';
					photo_string += '<img src="<?php echo base_url(); ?>_assets/images/photos/'+data.filename+'" title="' + data.filename + '" alt="' + data.filename + '" class="img-photo" />';
					photo_string += '<div class="clearboth"></div>';
					
					$('#upload-img-photo-wrapper').html(photo_string);
					
					$('#img-photo-thumb').attr('src', '<?php echo base_url(); ?>_assets/images/photos/'+data.thumbfilename);
					
					displayNotification("success", data.msg);
				} else{
					displayNotification("error", data.msg);
				}
			}
		});
	});
</script>