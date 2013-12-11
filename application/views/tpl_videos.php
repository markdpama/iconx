<form id="videos"></form>
<div class="section-nav">
	<div class="page_title" >VIDEO GALLERY</div>
	<ul class="tab">
		<li class="iclose">
			
		</li>
	</ul>
</div>
<div class="bg-middle blue_bg">
<div class="top_shadow_dark"></div>
<?php if($data) { ?>
<div class="bg-middle">
	<div id="latest" class="latest">
		<ul class="list-news list-view">
		<?php foreach($data as $v ) {?>
				<li id="<?php echo $v['id']; ?>" class="message_box" >
					<div  align="left">
						<a data-id="<?php echo $v['id']; ?>" class="show-content first" href="javascript:void(0)" id="showFullContent-<?php echo $v['id']; ?>" >
							<span class="metanews middle_title"><?php //echo date("F d, Y", strtotime($v['published'])); ?></span>
							<div class="img_thumb">
								
								<?php 
										$style = '';
										$marginLeft = 0;
										$marginTop = 0;
									if($v['type'] == 'youtube-link'){
										$thumbnail = $v['thumb'];
										$marginLeft = 0;
										$marginTop = 0;
										$height = '100%';
										$style="";
									}else{
										$thumbnail =base_url().'_assets/videos/thumb/'.$v['thumb'];
										$height = 'auto';
										list($width, $height, $type, $attr) = getimagesize($thumbnail);
										
										if($width > 100){
											$marginLeft = '-'.(($width-100)/2);
										}elseif($width == 100){
											$marginLeft = 0;
										}elseif($width < 100){
											$marginLeft = ((100-$width)/2);
										}
										
										if($height > 70){
											//$marginTop = intval((($height-70)/30));
											$marginTop =0;
										}elseif($height == 70){
											$marginTop = 0;
										}elseif($height < 70){
											$marginTop = intval(((70-$height)/9));
										}
									}	
										$style='height:'.$height.'; overflow:hidden !important; border-radius:0 !important;margin:auto;margin-top:'.$marginTop.'px;';
							
								?>
								<img class="thumb" style="<?php echo $style;?>" src="<?php echo $thumbnail;?> " />
								
								<div class="play_button"></div>
							</div>
							<?php $countTitle = strlen($v['title']); ?>
							<div class=" title title-news <?php echo ($countTitle == 0 ? 'middle_title': 'middle_pos'); ?>">
								<?php echo character_limiter($v['title'], 58); ?>
							</div>
							<div class=" sub_title sub_title-news">
								<?php echo character_limiter($v['description'], 60); ?>
							
							</div>
							
						</a>
					</div>
				</li>
		<?php }	?>
		
				<li>
					<p><a id="loadMoreVideos" href="javascript:void(0)" style="display:none;color:#FFF">Load More Videos...</a></p>
				</li>
	
		</ul>
	</div>

<?php } else {	?>	
	<div class="nodata">
		<div class="icon"></div>No data to display
	</div>
<?php } ?>	
<div class="bottom_shadow_dark"></div>
</div>
	<div id="last_msg_loader"></div>
<script type="text/javascript">
	$(document).ready(function(){
		var scrollCount = 0;
		function last_msg_funtion(ID) { 
           
           if(!ID){ 
				var ID=$(".message_box:last").attr("id");
			}
			$('div#last_msg_loader').html('<img src="<?php echo base_url(); ?>_assets/images/loader.gif">');
			$.post("<?php echo site_url('videos/get_videos_second/'); ?>/"+ID,
			$("#videos").serialize(),
			function(data){
				if (data != "") {
					$(".message_box:last").after(data);
					
					$('#loadMoreVideos').show();
					
					$('.second').bind('click', function(){
						
					   $.ajax({
							url : '<?php echo base_url(); ?>videos/get_video/'+$(this).attr('data-id'),
							dataType: "html",
							success: function(result){
							 //alert(result)
							 $(".full-content").css("box-shadow", "none");
							 $(".full-content").css("-webkit-box-shadow", "none");
							 $(".full-content").css("-moz-box-shadow", "none");
							 $('#full-content').height(518);
							 $("#middle-content").addClass("hide");
							 $(".close-middle").css("display", "none");
							 $(".close-content").css("display", "block");
							 $(".close-content").addClass("close-pos");
							 $(".close-content").css("visibility", "visible");
							 $("#full-content").addClass("full-content show blue_bg margin-bottom_12px");
							 $("#full-content").removeClass("hide margin-top_12px");
							 $("#middle-content").removeClass("show");
							 $("#middle-content").addClass("hide");
							  $(".full-content").fadeIn(300, function() {
								$("#full-content").html(result);
							 }); 
				 
							}
					   });      
					})
				}else{
					$('#loadMoreVideos').hide();
				}
				$('div#last_msg_loader').empty();
				$("#latest").mCustomScrollbar("destroy");
				$("#latest").mCustomScrollbar({
					scrollButtons:{
						enable:true
					},
					scrollInertia:50
				});
				$("#latest").mCustomScrollbar("scrollTo","bottom");
			});
			
			
		};  
		
		$('#loadMoreVideos').live('click', function(){
			//var ID = $(this).attr("data-id");
			var ID = $('ul.list-news').find(".message_box:last").attr("id");
			last_msg_funtion(ID);
		});
			
		$("#latest").mCustomScrollbar({
			scrollButtons:{
				enable:true,
				scrollSpeed: "auto"
			},
			scrollInertia:50,
			callbacks:{
				onTotalScroll:function(){ OnTotalScroll(); }
			}
		});
		function OnTotalScroll(){
			scrollCount += 1
			//alert(scrollCount);
			if(scrollCount == 1){
				last_msg_funtion();		
			}	
		}
		$('.first').bind('click', function(){
			//alert('Play Video');
		   $.ajax({
				url : '<?php echo base_url(); ?>videos/get_video/'+$(this).attr('data-id'),
				dataType: "html",
				success: function(result){
				 //alert(result)
				 $(".full-content").css("box-shadow", "none");
				 $(".full-content").css("-webkit-box-shadow", "none");
				 $(".full-content").css("-moz-box-shadow", "none");
				 $('#full-content').height(518);
				 $("#middle-content").addClass("hide");
				 $(".close-content").css("display", "block");
				 $(".close-content").css("visibility", "visible");
				 $(".close-content").removeClass("close-pos");
				 $(".close-content").addClass("close-pos-up");
				 $("#full-content").addClass("full-content show white_bg margin-bottom_12px");
				 $("#full-content").removeClass("hide margin-top_12px");
				 $("#middle-content").removeClass("show");
				 $("#middle-content").addClass("hide");
				  $(".full-content").fadeIn(300, function() {
					$("#full-content").html(result);
					loading_complete();
				 });  
				 
				}
		   });         
		}); 		
	});
</script>
