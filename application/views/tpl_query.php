<?php foreach($data as $p ) {?>
		<li id="<?php echo $p['id']; ?>" data-date="<?php echo preg_replace('/[^a-zA-Z0-9]/', "" ,$p['publish_up']); ?>" class="message_box" >
			<div  align="left">
				<a data-id="<?php echo $p['id']; ?>" class="show-content <?php echo $ctr; ?>" href="javascript:void(0)" id="showFullContent-<?php echo $p['id']; ?>" >
					<span class="metanews middle_title"><?php echo date("F d, Y", strtotime($p['publish_up'])); ?></span>
					<div class="img_thumb">
						<img class="thumb" src="<?php echo base_url(); ?>_assets/images/articles/thumbnails/<?php echo $p['images']; ?>" />
					</div>
					<?php $countSubtitle = strlen($p['subtitle']);?>							<div class=" title title-news <?php echo ($countSubtitle == 0 ? 'middle_title': 'middle_pos'); ?>">
						<?php echo character_limiter(stripcslashes($p['title']),58);  ?>
					</div>
					<div class=" sub_title sub_title-news">
						<?php 
							$string = stripcslashes($p['subtitle']);
							echo character_limiter($string, 60);
						?>
					</div>
				</a>
			</div>
		</li>
<?php }	?>