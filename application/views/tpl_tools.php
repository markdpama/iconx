<div class="pop-up-modal">
	<div class="link_title">Tools</div>
	<div class="link_listing">
		<ul class="list-link">	
		<?php //foreach($data as $p ) { ?>
				<li class="overflow_visible" >
					<div  align="">
						<a class="show-content" target="_blank" title="Dash2" href="https://dash2.globe.com.ph/DesktopForms/Home.aspx"  >
							<div class="img_thumb link_border">
								<img class="thumb" src="<?php echo base_url(); ?>_assets/images/tools/tile_image_dash.jpg" title="Dash2" />
							</div>
							Dash2
						</a>
					</div>
				</li>
				<!--<li class="overflow_visible" >
					<div  align="">
						<a class="show-content" target="_blank" title="Information Security Corner" href="#"  >
							<div class="img_thumb link_border">
								<img class="thumb" width="" src="<?php echo base_url(); ?>_assets/images/tools/tile_image_globecomph.jpg" title="Information Security Corner" />
							</div>
						</a>
					</div>
				</li>-->
				<li class="overflow_visible" >
					<div  align="">
						<a class="show-content" target="_blank" title="IT Service Management" href="http://myitservices/arsys/shared/login.jsp?/arsys/home"  >
							<div class="img_thumb link_border">
								<img class="thumb" src="<?php echo base_url(); ?>_assets/images/tools/tile_image_itservicemanagementl.jpg" title="IT Service Management" />
							</div>
							IT Service Management
						</a>
					</div>
				</li>
				<!--<li class="overflow_visible" >
					<div  align="">
						<a class="show-content" target="_blank" title="LookUP (KMS)" href="http://myitservices/arsys/shared/login.jsp?/arsys/home"  >
							<div class="img_thumb link_border">
								<img class="thumb" width="" src="<?php echo base_url(); ?>_assets/images/tools/tile_image_itservicemanagementl.jpg" title="LookUP (KMS)" />
							</div>
						</a>
					</div>
				</li>-->
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