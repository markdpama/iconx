<div id="<?php echo $page; ?>-container" class="content">
	<div class="pagelabel">
		<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
		<div class="pagelabel_text"><?php echo $page; ?></div>
	</div>
	<table class="table">
		<tr>
			<td class="">
				<p class="text">*Hourly Update</p>			
				<div id="server-report">
					<iframe scrolling="no" src="http://iconx.globetel.com/report/index.html"></iframe>
				</div>
				<div class="insert-img-btn">
					<a class="inputbutton" alt="View Statistics" href="<?php echo base_url(); ?>admin/reports/server_statistics"/>
					<!--<div class="insert-img-icon"><img src="<?php echo base_url(); ?>_assets/images/admin/global_icon_assets.png" /></div>-->View Full Statistics
					</a>
				</div>
			</td>
		</tr>			
	</table>
	<div class="box width500">
		<div class="pagelabel">
			<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
			<div class="pagelabel_text">Recently Added Articles</div>
		</div>
		<table class="table">
			<?php foreach( $articles as $a ) {?>
			<tr>
				<td class=""><?php echo character_limiter( $a['art_title'] ,30 ); ?></td>
				<td class=""><?php echo character_limiter( $a['cat_title'], 20); ?></td>
			</tr>
			<?php } ?>		
		</table>
	</div>		
	<div class="box width500">
		<div class="pagelabel">
			<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
			<div class="pagelabel_text">Recently Added Photo Album</div>
		</div>
		<table class="table">
			<?php foreach( $articles as $a ) {?>
			<tr>
				<td class=""><?php echo character_limiter( $a['art_title'] ,30 ); ?></td>
				<td class=""><?php echo character_limiter( $a['cat_title'], 20); ?></td>
			</tr>
			<?php } ?>				
		</table>
	</div>
	<div class="clearboth"></div>
	<!--
	<div class="box width500">
		<div class="pagelabel">
			<div class="pagelabel_icon"><img src="<?php echo base_url(); ?>_assets/images/admin/generic.png"></div>
			<div class="pagelabel_text">Recent comments</div>
		</div>
		<table class="table">
			<tr>
				<td class="">Comment 1</td>
				<td class="">2013-07-09 09:17:15</td>
			</tr>			
			<tr>
				<td class="">Comment 2</td>
				<td class="">2013-07-09 09:17:15</td>
			</tr>
			<tr>
				<td class="">Comment 3</td>
				<td class="">2013-07-09 09:17:15</td>
			</tr>			
		</table>
	</div>
	-->
</div>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$('#summary-report').load('http://iconx/report/index.html');
	});
</script>