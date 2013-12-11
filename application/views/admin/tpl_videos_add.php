<div id="<?php echo $page; ?>-container" class="content">
	<div id="tools">
		<a href="javascript: void(0);" id="btn_add_video" >
			<img width="20" class="g_icon" src="<?php echo base_url(); ?>_assets/images/admin/save.png" />Save Video</a>
		<div class="clearboth"></div>
	</div>	
	<div class="clearboth"></div>
	
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text">New Video</div>
	</div>
	
	<form id="form_add_video" class="form">
		<table class="table">
			<tr>
				<td valign="top">
					<div class="item">
						<div class="label">Video URL</div>
						<div class="input">				
							<div class="radio">
								<input id="video-type" type="radio" name="video-type" value="local-upload" class="video-type" checked />Upload Video
							</div>
							<div class="radio">
								<input id="video-type" type="radio" name="video-type" value="youtube-link" class="video-type"/>YouTube URL	
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="clearboth"></div>
					</div>
					<div class="clearboth"></div>					
					<div id="youtube-link" class="">
						<div class="item">
							<div class="label">YouTube URL</div>
							<div class="input">
								<input 	class="inputtext video" 
										type="text" 
										name="youtube-url" />							
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="clearboth"></div>
						<div id="youtube-info" class="">
							<div class="item">
								<div class="label">Video</div>
								<div class="input">
									<div id="video_upload_wrapper" class="width200 height100 bg_ccc align-center">
									</div>			
								</div>
								<div class="clearboth"></div>
							</div>
							<div class="clearboth"></div>
							<div class="item">
								<div class="label">Thumbnail Image</div>
								<div class="input thumb_image">
									<div id="thumb_image_wrapper" class="width200 height100 bg_ccc align-center">	</div>		
								</div>
								<input type="hidden" value="" name="featured_image_name" id="featured_image_name">
								<div class="clearboth"></div>
							</div>	
							
							<div class="item">
								<div class="label">Title</div>
								<div class="input">
									<input 	class="inputtext title" 
											type="text" 
											name="title" />					
								</div>
								<div class="clearboth"></div>
							</div>
							<div class="item">
								<div class="label">Description</div>
								<div class="input">
									<textarea class="inputtext description textarea"  
												name="description" 
												id="description"
												data-required="1"></textarea>
									
								</div>
								<div class="clearboth"></div>
							</div>							
						</div>							
					</div>
					<div class="clearboth"></div>	
					<div id="local-upload" class="">
						<div class="item">
							<div class="label">Video</div>
							<div class="input">
								<div id="video_upload_wrapper" class="width200 height100 bg_ccc align-center"></div>
								<a id="video_upload">Upload Video</a><div id="v_upload_result"></div>							
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="clearboth"></div>
						<div class="item">
							<div class="label">Thumbnail Image</div>
							<div class="input thumb_image">
								<div id="thumb_image_wrapper" class="width200 height100 bg_ccc align-center">	</div>
								<a id="change_thumb_image">Upload image</a><div id="upload_result"></div>						
							</div>
							<input type="hidden" value="" name="featured_image_name" id="featured_image_name">
							<div class="clearboth"></div>
						</div>	
						
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
							<div class="label">Description</div>
							<div class="input">
								<textarea class="inputtext description textarea"  
											name="description" 
											id="description"
											data-required="1"></textarea>
								
							</div>
							<div class="clearboth"></div>
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
							<div class="label">Uploaded by</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										name="uploaded_by"
										value="<?php echo $this->session->userdata('first_name')." ". $this->session->userdata('last_name') ; ?>"
										data-required="1" />					
							</div>
							<div class="clearboth"></div>
						</div>	
					</div>
					<input type="hidden" value="" data-required="1" data-represent="thumb_image_wrapper" name="thumb_image_name" id="thumb_image_name">
					<input type="hidden" value="" data-required="1" data-represent="video_upload_wrapper" name="video_upload_name" id="video_upload_name">
					<input type="hidden" value="" name="type" id="type">
					<input type="hidden" value="" name="mime_type" id="mime_type">
				</td>	
			</tr>	
		</table>
	</form>
</div>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$("#published").datepicker();	
		$("#published").datepicker( "option", "dateFormat", "yy-mm-dd <?php echo date("H:i:s"); ?>");	
		$("#youtube-link").hide();
		$("#youtube-info").hide();
		$('input[name=type]').val('local');
		
		$(".video-type").click(function(){
			if($(this).val() === "youtube-link"){
				$("#youtube-link").show("slow");
				$("#local-upload").hide("slow");
				
				$('input[name=type]').val('youtube-link');
				$('input[name=youtube-url]').val('');
				$('#youtube-info #video_upload_wrapper').html('');
				$('input[name=title]').val('');
				$('textarea[name=description]').val('');
				$('input[name=featured_image_name]').val('');
				$('#thumb_image_wrapper').html('');			
				$('input[name=thumb_image_name]').val('');			
				$('input[name=published]').val('');
				$('input[name=uploaded_by]').val('');
			
			} else {
				
				$("#youtube-link").hide("slow");
				$("#local-upload").show("slow");
				$("#youtube-info").hide("slow");
				
				$('input[name=uploaded_by]').val('<?php echo $this->session->userdata('first_name')." ". $this->session->userdata('last_name') ; ?>');
				$('input[name=type]').val('local');
				$('input[name=youtube-url]').val('');
				$('#youtube-info #video_upload_wrapper').html('');
				$('input[name=title]').val('');
				$('textarea[name=description]').val('');
				$('input[name=featured_image_name]').val('');
				$('#thumb_image_wrapper').html('');			
				$('input[name=thumb_image_name]').val('');		
				$('input[name=published]').val('');
				
			}
		});	
		
		$("input[name=youtube-url]").focusout(function(){
			
			if($(this).val() != "") {
				var get_id = $(this).val();
				var id = get_id.replace('http://www.youtube.com/watch?v=', '');
					id = get_id.replace('https://www.youtube.com/watch?v=', '');
					
                $.ajax({
                        url: "http://gdata.youtube.com/feeds/api/videos/"+id+"?v=2&alt=jsonc",
                        dataType: "jsonp",
                        success: function (data) { parseresults(data); }
                });
			}
		});
		
	});	
	$("#btn_add_video").click(function(){
		tinyMCE.triggerSave();
		if (validate_form("form_add_video")) {
			displayNotification("message", "Working...");
			$.ajax({
				url: "<?php echo base_url(); ?>admin/videos/process_add",
				type: "POST",
				data: $("#form_add_video").serialize(),
				success: function(response, textStatus, jqXHR){
					setTimeout(function () {
						$("#main-wrapper").html(response);
						if (typeof history.pushState != 'undefined') { window.history.pushState("object or string", "Title", "<?php echo base_url(); ?>admin/videos/"); }
						displayNotification("success", "New Video successfully added.");
					}, 500);
				},
				error: function(jqXHR, textStatus, errorThrown){
					displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
				}
			});
		}
	});
	
	$(function(){
		var btnUpload	= $('#local-upload #change_thumb_image');
		var mestatus	= $('#local-upload #upload_result');
		var files		= $('#local-upload #thumb_image_wrapper');
		new AjaxUpload( btnUpload, {	
			action: '<?php echo base_url(); ?>admin/videos/upload_thumb_image',
			name: 'thumb_image',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
					//mestatus.text('Only JPG, PNG or GIF files are allowed');
					displayNotification("error", 'Only JPG, PNG or GIF files are allowed');
					return false;
				}
				displayNotification("message", "Working...");
			},
			onComplete: function(file, response){
				var data = jQuery.parseJSON(response);
				alert("image"+response);
				files.html('');
				if(data.status==="success"){
					var image_tag = '<img src="<?php echo base_url(); ?>_assets/videos/thumb/'+data.filename+'" alt="Video Thumbnails" height="100" />';
					$('#local-upload #thumb_image_wrapper').append(image_tag);
					$('input[name=thumb_image_name]').val(data.filename);
						
					displayNotification("success", data.msg);
				} else{
					displayNotification("error", data.msg);
				}
			}
		});
		
	
		var btnUploadVideo	= $('#local-upload #video_upload');
		var v_mestatus		= $('#local-upload #v_upload_result');
		var v_files			= $('#local-upload #video_upload_wrapper');
		new AjaxUpload( btnUploadVideo, {	
			action: '<?php echo base_url(); ?>admin/videos/upload_video',
			name: 'video_file',
			onSubmit: function(file, ext){
				 if (! (ext && /^(mp4|mov|avi|flv|mpg|3gp|rm|wmv)$/.test(ext))){ 
					//mestatus.text('Only "mp4", "mov", "avi", "flv","mpg", "wmv", "3gp" or "rm" files are allowed');
					displayNotification("error", 'Only "mp4", "mov", "avi", "flv","mpg", "wmv", "3gp" or "rm" files are allowed.');
					return false;
				}
				displayNotification("message", "Working...");
			},
			onComplete: function(file, response){
				alert("video"+response);
				var data = jQuery.parseJSON(response);
				v_files.html('');
				if(data.status==="success"){
					var video_tag = '<video width="200" height="100" controls>';
						video_tag += '<source type="'+data.file_type+'" src="../../_assets/videos/'+data.filename+'">';
						video_tag += 'Your browser does not support the video tag.';
						video_tag += '</video>';
						
					$('#local-upload #video_upload_wrapper').append(video_tag);
					$('input[name=mime_type]').val(data.file_type);
					$('input[name=video_upload_name]').val(data.filename);
					displayNotification("success", data.msg);
				} else{
					displayNotification("error", data.msg);
				}
			}
		});	

	});
	
	function parseresults(info) {
	
		$("#youtube-info").show("slow");
		$('#youtube-info #video_upload_wrapper').html('');
		$('input[name=title]').val('');
		$('textarea[name=description]').val('');
		$('input[name=featured_image_name]').val('');
		$('#thumb_image_wrapper').html('');			
		$('input[name=thumb_image_name]').val('');			
		$('input[name=published]').val('');
		$('input[name=uploaded_by]').val('');

		
		var video_tag = '<iframe id="youtube-url-frame" width="200" height="100" ';
			video_tag += 'src="http://www.youtube.com/embed/'+info.data.id+'" frameborder="0" allowfullscreen>';
			video_tag += '</iframe>';
		$('#youtube-info #video_upload_wrapper').append(video_tag);
		$('input[name=video_upload_name]').val('http://www.youtube.com/watch?v='+info.data.id);
		$('input[name=title]').val(info.data.title);
		$('textarea[name=description]').val(info.data.description);
		$('input[name=featured_image_name]').val(info.data.thumbnail.sqDefault);
		var image_tag = '<img src="'+info.data.thumbnail.sqDefault+'" alt="Video Thumbnails" height="100" />';
		$('#thumb_image_wrapper').append(image_tag);			
		$('input[name=thumb_image_name]').val(info.data.thumbnail.sqDefault);
		
		$('input[name=published]').val(info.data.uploaded);
		$('input[name=uploaded_by]').val(info.data.uploader);			

	}
</script>