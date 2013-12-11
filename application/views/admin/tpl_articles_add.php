<div id="<?php echo $page; ?>-container" class="content">

	<div id="tools">
		<a href="javascript: void(0);" id="btn_add_article" >
			<img width="20" class="g_icon" src="<?php echo base_url(); ?>_assets/images/admin/save.png" />Save Article</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text">New <?php echo $page; ?></div>
	</div>
	
	<form id="form_add_article" class="form">
		<table class="table">
			<tr>
				<td>		
					<div class="item">
						<div class="label">Title</div>
						<div class="input">
							<input 	class="inputtext title" 
									type="text" 
									name="title" 
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
									value=""/>					
						</div>
						<div class="clearboth"></div>
					</div>					
					<div class="item">
						<div class="label">Category</div>
						<div class="input">					
							<select class="select" data-required="1" id="category" name="category">
								<option value="0" selected="selected">Select category</option>
								<option value="3">News</option>
								<option value="4">Our Product and Promos</option>
								<option value="5">iContribute</option>
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
							<textarea name="content" id="content"></textarea>
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
										id="published" 
										name="published"
										data-required="1"
										onfocus="if (this.value == '<?php echo date("Y-m-d H:i:s"); ?>') {this.value = '';}"
										onblur="if (this.value == '') {this.value = '<?php echo date("Y-m-d H:i:s"); ?>';}"
										value="<?php echo date("Y-m-d H:i:s"); ?>"/>
										
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="item">
							<div class="label">Status</div>
							<div class="input">
								<select class="select" name="status">
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
										name="author_name"
										value="<?php echo $this->session->userdata('first_name')." ". $this->session->userdata('last_name') ; ?>"
										data-required="1" />					
							</div>
							<div class="clearboth"></div>
						</div>	

						<div class="item">
							<div class="label height29">Featured image</div>
							<div class="input featured_image">
								<input data-required="1" data-asset="1" type="hidden" value="" name="featured_image_name" id="featured_image_name">
								<div id="featured_image_wrapper"  class="img_preview" >
									<img height="100" id="article_image" src=""/>
								</div>
								<a id="change_item_image">Upload image</a><div id="upload_result"></div>						
							</div>
							<div class="clearboth"></div>
							
						</div>	
					</div>						
				</td>	
			</tr>	
		</table>
	</form>
</div>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$( "#published" ).datepicker();	
		$( "#published" ).datepicker( "option", "dateFormat", "yy-mm-dd <?php echo date("H:i:s"); ?>");		
	});	
	$("#btn_add_article").click(function(){
		tinyMCE.triggerSave();
		//if (validate_form("form_add_article")) {
			displayNotification("message", "Working...");
			$.ajax({
				url: "<?php echo base_url(); ?>admin/articles/process_add",
				type: "POST",
				data: $("#form_add_article").serialize(),
				success: function(response, textStatus, jqXHR){
					setTimeout(function () {
						$("#main-wrapper").html(response);
						if (typeof history.pushState != 'undefined') { window.history.pushState("object or string", "Title", "<?php echo base_url(); ?>admin/articles/"); }
						displayNotification("success", "New article successfully added.");
					}, 500);
				},
				error: function(jqXHR, textStatus, errorThrown){
					displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
				}
			});
		//}
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
					$('#featured_image_wrapper').append('<img src="<?php echo base_url(); ?>_assets/images/articles/thumbnails/'+data.filename+'" alt="Featured Image" height="100" />');
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
