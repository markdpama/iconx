<div class="pop-up-modal">
	<div class="link_title">Linkouts</div>
	<div class="link_listing">
		<ul class="list-link">	
		<?php //foreach($data as $p ) { ?>
				<li  >
					<div  align="">
						<a class="show-content" target="_blank" title="Ayala Coop" href="http://www.ayalacoop.com/index.php?/home"  >
							<div class="img_thumb link_border">
								<img class="thumb" src="<?php echo base_url(); ?>_assets/images/linkouts/tile_image_ayalacoopl.jpg" title="Ayala Coop" />
							</div>
							Ayala Coop
						</a>
					</div>
				</li>
				<li >
					<div  align="">
						<a class="show-content" target="_blank" title="Official Globe Website" href="http://www.globe.com.ph"  >
							<div class="img_thumb link_border">
								<img class="thumb" src="<?php echo base_url(); ?>_assets/images/linkouts/tile_image_globecomph.jpg" title="Official Globe website" />
							</div>
							Official Globe Website
						</a>
					</div>
				</li>
				<li  >
					<div  align="">
						<a class="show-content" target="_blank" title="careers@globe" href="http://www.careers.globe.com.ph"  >
							<div class="img_thumb link_border">
								<img class="thumb" src="<?php echo base_url(); ?>_assets/images/linkouts/tile_image_careers.jpg" title="careers@globe" />
							</div>
							careers@globe
						</a>
					</div>
				</li>
		<?php // }	?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		$(".list-link").mCustomScrollbar({
			scrollButtons:{
				enable:true,
				scrollSpeed: "auto"
			},
			scrollInertia:50	
		});	

	});
</script>