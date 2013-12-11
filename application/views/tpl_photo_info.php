<div class="photo_info" align="center">
	<img class="thumb" height="500" src="<?php echo base_url().'_assets/images/photos/'.$photo_filename; ?>">
	<p><?php echo $photo_caption; ?></p>
</div>
<style>
	.photo_info{
		width:860px!important;
		height:500px!important;
		backgound-color:#f6f6f6!important;
	}
	.photo_info img {
		margin:0 auto;
		max-width: 100%;
		width: auto\9; /* ie8 */
	}	
</style>