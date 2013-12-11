<div class="full-content" >
	<div class="section-nav">
		<div class="album_name">
			<?php echo $albumInfo['album_name']; ?>
			<!--<div class="album_desc"><i><?php echo $albumInfo['album_desc']; ?></i></div>-->
		</div>	
		<ul class="tab">
			<li class="iclose"></li>
		</ul>
	</div>
	<div class="bg-middle blue_bg">
	<div class="top_shadow_dark"></div>

	<?php if($data) { ?>
	<div class="bg-middle">
		<div id="photo-listing" class="photo-listing">
			<ul class="list-photos">	
			<?php foreach($data as $p ) { ?>
					<li id="<?php echo $p['photo_id']; ?>" class="message_box <?php echo (count($data) > 14 ? "more" :""); ?>" >
						<div  align="">
							<a class="show-content" rel="photo_gallery" title="<?php echo $p['photo_caption']; ?>"
								href="<?php echo base_url(); ?>photos/get_photo_info/<?php echo $p['photo_id']; ?>" 
								id="showFullContent-<?php echo $p['photo_id']; ?>" data-id="<?php echo $p['photo_id']; ?>" >
								<span class="metanews middle_title"><?php //echo date("F d, Y", strtotime($p['published'])); ?></span>
								<div class="img_thumb">
									<img class="thumb" src="<?php echo base_url(); ?>_assets/images/photos/<?php echo $p['photo_thumb_filename']; ?> " />
									<img class="display-none" src="<?php echo base_url(); ?>_assets/images/photos/<?php echo $p['photo_filename']; ?> " />
								</div>
							</a>
						</div>
					</li>
			<?php }	?>
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
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("a[rel=photo_gallery]").fancybox({	
			'autoScale'		: false,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'titlePosition' : 'over',
			'scrolling'   	: 'no',
			onComplete:  function(e){ 
				 if(isChrome==false) {
          			 	$('html').getNiceScroll().remove();
						 $("html, body").css("overflow", "hidden");
				 }else{
					$("html, body").css("overflow", "hidden");
				 }
			},
			scrollOutside: false,
			helpers: {
				overlay: {
				  locked: true,
				  closeClick: false
				 }
           	},
			onClosed : function() {
				
				 if(isChrome==false) {
           				 $('html').niceScroll();
						 $('html').attr('style', 'overflow: hidden !important;');
				 }else{
				 $("html, body").css("overflow", "auto");
				 }
			},
			'hideOnOverlayClick' : false,
			'titleFormat'	: function(title, currentArray, currentIndex, currentOpts) {
				return '<p id="fancybox-title-over"><span class="title">&nbsp;'+title+'</span> <span class="count">' + (currentIndex + 1) + ' / ' + currentArray.length + '</span></p>';
			}	
		}).hover(function() {
				$("div#fancybox-overlay").click(function(e) {
					$("body").bind("click","null");
					e.stopPropagation();
					e.preventDefault();
				});
		});
			
	<?php if( count($data) > 14 ) { ?>
		$(".photo-listing").mCustomScrollbar({
			scrollButtons:{
				enable:true,
				scrollSpeed: "auto"
			},
			scrollInertia:50	
		});	
	<?php } ?>
	});
</script>
<!--onclick=""-->