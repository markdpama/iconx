<div class="full-content white_bg">
	<div class="top_shadow"></div>
		
		<div id="fullContentHolder">
			<div class="social">
				<ul class="social_links">
					<li><img src="<?php echo base_url(); ?>_assets/images/facebook.png" title=" Share Facebook" /></li>
					<li><img src="<?php echo base_url(); ?>_assets/images/twitter.png" title=" Twitter" /></li>
					<li><img src="<?php echo base_url(); ?>_assets/images/googleplus.png" title="Google +" /></li>
					<li><img src="<?php echo base_url(); ?>_assets/images/comment.png" title=" Comment" /></li>
					<li></li>
				</ul>
			</div>
			<div id="fullData" class="fullData">
				<div class="right_side">
					<div class="thumb_img">
						<img class="thumb" src="<?php echo base_url(); ?>_assets/images/articles/medium/<?php echo $images; ?>" />
					</div>
					<?php if($random_art) { ?>
						<div class="related_article">OTHER ARTICLES</div>
						<ul class="related" style="list-style:none;">
							<?php foreach($random_art as $other_article ) {?>
							<li class="related_article_list" onclick="kenburnShowContent('<?php echo $other_article['id']; ?>');">
								<?php echo $other_article['title']; ?><br />
								<i><?php echo $other_article['subtitle']; ?></i>
							</li>
							<?php }	?>
						</ul>
					<?php }	?>
				</div>
				<div class="left_side">
					<div class="title"><?php echo $title; ?></div>
					<div class="subtitle"><?php echo $subtitle; ?></div>
					
					<div class="author"><?php echo $created_by; ?><span class="publish_up"><?php echo date("m/d/y H:ma", strtotime($publish_up)); ?></span></div>
					<div class="fulltext">
					<?php  echo str_replace('../../../', base_url(), $fulltext);?>
					</div>
				</div>
			</div>
		</div>
	<div class="bottom_shadow"></div>
</div>
<script type="text/javascript">
	//alert('loaded');
	openContent = '<?php echo $id; ?>';
	//alert(openContent);
	$("#fullData").mCustomScrollbar({
		scrollButtons:{
			enable:true
		},
		scrollInertia:50,
		theme:"dark-thick"
	});
</script>