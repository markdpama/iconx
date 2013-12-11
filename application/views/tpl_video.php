
<div class="full-content" >
	<div class="section-nav">
		<ul class="tab">
			<li class="iclose">
		
			</li>
		</ul>
	</div>
	<div class="bg-middle blue_bg">
	<div class="top_shadow_dark"></div>
		<div id="fullContentHolder">
			<div id="fullData" class="fullData">
				<section id="video-page">
				<?php if($type == 'youtube-link') { ?>
					<?php $get_yid = str_replace('http://www.youtube.com/watch?v=', '', $video); ?>			
					<iframe width="640" height="361" src="//www.youtube.com/embed/<?php echo $get_yid; ?>?rel=0" frameborder="0" allowfullscreen></iframe>					
				<?php } else { ?>
					<video id="example_video_1" class="video-js vjs-default-skin custom-video-player" controls preload="none" width="640" height="361"
					  poster="<?php echo base_url().'_assets/videos/thumb/'.$thumb; ?>"
					  data-setup="{}">
						<source src="<?php echo base_url().'_assets/videos/'.$video; ?>" type='<?php echo $mime_type; ?>' />
					</video>
				<?php } ?>
					
				</section>
				<div id="video-content">
					<!--<div class="video-comment-count">(467) comments</div>-->
					<div class="video-title">
					<?php 
						echo character_limiter($title,50);
					?>
					</div>
					<!--<div class="video-description">
					<?php 
						//echo character_limiter($description, 80).'read more';
					?>
					</div>-->
				</div>
			</div>
		</div>
		<div class="bottom_shadow_dark"></div>
	</div>
	<div id="last_msg_loader"></div>
</div>
<script type="text/javascript">
	/*$("#fullData").mCustomScrollbar({
		scrollButtons:{
			enable:true
		},
		theme:"dark-thick"
	});*/
</script>