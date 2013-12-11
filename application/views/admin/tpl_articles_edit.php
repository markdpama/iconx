<div id="<?php echo $page; ?>-container" class="content">

	<div id="tools">
		<a href="javascript: void(0);" id="btn_edit_article" >
			<img width="20" width="20" class="g_icon" src="<?php echo base_url(); ?>_assets/images/admin/save.png" />Save Changes</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text">Edit <?php echo $page; ?> - <?php echo $title; ?></div>
	</div>
	
	<form id="form_edit_article" class="form">
		<table class="table">
			<tr>
				<td>		
					<div class="item">
						<div class="label">Title</div>
						<div class="input">
							<input 	class="inputtext title" 
									type="text" 
									name="title"
									value="<?php echo htmlspecialchars($title); ?>"
									data-required="1" />					
						</div>
						<div class="clearboth"></div>
					</div>
					<div class="item">
						<div class="label">Subtitle</div>
						<div class="input">
							<input 	class="inputtext title" 
									type="text" 
									name="subtitle"
									value="<?php echo htmlspecialchars($subtitle); ?>"/>					
						</div>
						<div class="clearboth"></div>
					</div>
					<div class="item">
						<div class="label">Category</div>
						<div class="input">					
							<select class="select" data-required="1" id="category" name="category">
								<option value="0">Select category</option>
								<option value="3" <?php echo ( $catid == 3? 'selected="selected"' : '' ); ?>>News</option>
								<option value="4" <?php echo ( $catid == 4? 'selected="selected"' : '' ); ?>>Our Product and Promos</option>
								<option value="5" <?php echo ( $catid == 5? 'selected="selected"' : '' ); ?>>iContribute</option>
							</select>
						</div>
						<div class="clearboth"></div>
					</div>
					
					<div class="clearboth"></div>
					
					<div style="clearboth">
						<div class="item">
							<div class="label">Article Content</div>
							<div class="clearboth"></div>
						</div>
						
						<div class="insert-img-btn">
							<input type="button" class="inputbutton" value="Insert Image"/>
							<div class="insert-img-icon"><img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_assets.png" /></div>
						</div>
						
						<div class="clearboth"></div>
					
						<div class="item-content">
							<textarea name="content" id="content"><?php echo $fulltext; ?></textarea>
						</div>
					</div>					
				</td>	
				<td width="200" class="published-info-wrapper">
					<div id="published-info">
						<div class="item">
							<div class="label pub_date">Publish Date</div>
							<div class="input">
								<input type="text" id="datepicker" name="published" size="30" value="<?php echo $publish_up; ?>" class="inputtext dpicker"  />										
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="item">
							<div class="label">Status</div>
							<div class="input">
								<select class="select" name="status">
									<option data-required="1" value="published" <?php echo ( $status == "published"? 'selected="selected"' : '' ); ?>>Published</option>
									<option data-required="1" value="unpublished" <?php echo ( $status == "unpublished"? 'selected="selected"' : '' ); ?>>Unpublished</option>
									<option data-required="1" value="draft" <?php echo ( $status == "draft"? 'selected="selected"' : '' ); ?>>Draft</option>
								</select>				
							</div>
						</div>								
						<div class="item">
							<div class="label">Created by</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										name="author_name"
										value="<?php echo $created_by; ?>"
										data-required="1" />					
							</div>
							<div class="clearboth"></div>
							<input type="hidden" name="post_id" id="post_id" value="<?php echo $id; ?>" />	
						</div>

						<div class="item">
							<div class="label height29">Featured image</div>
							<div class="input featured_image">
								<div id="featured_image_wrapper">
									<img height="100" id="article_image" src="<?php echo base_url(); ?>_assets/images/articles/thumbnails/<?php echo $images; ?>"/>
								</div>
								<a id="change_item_image">Change featured image</a><div id="upload_result"></div>						
							</div>
							<div class="clearboth"></div>
							<input type="hidden" data-required="1" data-asset="1" value="<?php echo $images; ?>" name="featured_image_name" id="featured_image_name">
						</div>	
						
					</div>						
				</td>	
			</tr>	
		</table>

 

	</form>
</div>
<script type="text/javascript" language="javascript">
<?php
//date_default_timezone_set('Asia/Manila');
?>
	$(document).ready(function(){

		$('#datepicker').datepicker({ dateFormat: 'yy-mm-dd <?php echo date("H:i:s"); ?>' });
	});	
	$("#btn_edit_article").click(function(){
		tinyMCE.triggerSave();
		if (validate_form("form_edit_article")) {
			displayNotification("message", "Working...");
			$.ajax({
				url: "<?php echo base_url(); ?>admin/articles/process_edit",
				type: "POST",
				data: $("#form_edit_article").serialize(),
				success: function(response, textStatus, jqXHR){
					setTimeout(function () {
						$("#main-wrapper").html(response);
						if (typeof history.pushState != 'undefined') { window.history.pushState("object or string", "Title", "<?php echo base_url(); ?>admin/articles/"); }
						displayNotification("success", "Article successfully edited.");
					}, 500);
				},
				error: function(jqXHR, textStatus, errorThrown){
					displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
				}
			});
		}
	});
	
	$(function(){
		var btnUpload=$('#change_item_image');
		var mestatus=$('#upload_result');
		var files=$('#featured_image_wrapper');
		new AjaxUpload( btnUpload, {
			action: '<?php echo base_url(); ?>admin/articles/upload_image',
			name: 'article_image',
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
					$('#featured_image_wrapper').append('<img src="<?php echo base_url(); ?>_assets/images/articles/thumbnails/'+data.filename+'" alt="" width="100" />');
					$('#featured_image_name').val(data.filename);
					displayNotification("success", data.msg);
				} else{
					displayNotification("error", data.msg);
				}
			}
		});

	
		var btnInsert=$('.insert-img-btn');
		new AjaxUpload( btnInsert, {
			action: '<?php echo base_url(); ?>admin/articles/insert_image',
			name: 'insert_image',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
					//mestatus.text('Only JPG, PNG or GIF files are allowed');
					alert('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				displayNotification("message", "Working...");
			},
			onComplete: function(file, response){
				var insert_data = jQuery.parseJSON(response);
				if(insert_data.status==="success"){
					tinymce.activeEditor.execCommand('mceInsertContent', false, '<img src="../'+insert_data.filename+'">');
					displayNotification("success", insert_data.msg);
				} else{
					displayNotification("error", insert_data.msg);
				}
			}
		});	
		
	});
</script>	
