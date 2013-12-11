<?php if($data) { ?>

		<?php foreach($data as $album ) { ?>
				<li id="<?php echo $album['album_id']; ?>"  data-date="<?php echo preg_replace('/[^a-zA-Z0-9]/', "" ,$album['album_publish_date']); ?>" class="message_box" >
					<div  align="left">
						<a data-id="<?php echo $album['album_id']; ?>" class="show-content second" href="javascript:void(0)" id="showFullContent-<?php echo $album['album_id']; ?>" >
							<span class="metanews middle_title"><?php echo date("F d, Y", strtotime($album['album_publish_date'])); ?></span>
							<div class="img_thumb">
								<img class="thumb" src="<?php echo base_url(); ?>_assets/images/photos/<?php echo $album['album_cover_thumb']; ?> " />
							</div>
							<div class=" title title-news <?php echo (empty($album['album_desc']) ?  'middle_title': 'middle_pos'); ?>">
								<?php echo character_limiter($album['album_name'], 58); ?>
							</div>
							<div class=" sub_title sub_title-news">
								<?php echo character_limiter($album['album_desc'], 60); ?>
							</div>
						</a>
					</div>
				</li>
		<?php }	?>

<?php }	?>	
