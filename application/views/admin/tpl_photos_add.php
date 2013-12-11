<div id="<?php echo $page; ?>-container" class="content">

	<div id="tools">
		<a href="javascript: void(0);" id="btn_add_article" ><img class="g_icon" src="<?php echo base_url(); ?>" />Save Article</a>
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
						<div class="label">Category</div>
						<div class="input">					
							<select class="select" data-required="1" id="category" name="category">
								<option value="0" selected="selected">Select category</option>
								<option value="3" selected="selected">News</option>
								<option value="4" selected="selected">Industry News</option>
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
					<!--
						<div class="insert-img-btn">
							<input type="button" class="inputbutton" value="Insert Image"/>
							<div class="insert-img-icon"><img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_assets.png" /></div>
						</div>								
					-->
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
										data-required="1" />					
							</div>
							<div class="clearboth"></div>
						</div>
						<div class="item">
							<div class="label">Status</div>
							<div class="input">
								<select class="select" name="status">
									<option data-required="1" value="1" selected="selected">Published</option>
									<option data-required="1" value="0">Unpublished</option>
									<option data-required="1" value="2">Draft</option>
								</select>				
							</div>
						</div>								
						<div class="item">
							<div class="label">Created by</div>
							<div class="input">
								<input 	class="inputtext" 
										type="text" 
										name="author_name" 
										data-required="1" />					
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
$("#btn_add_article").click(function(){
	tinyMCE.triggerSave();
	if (validate_form("form_add_article")) {
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
	}
});
</script>	