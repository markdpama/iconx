
<?php if($data) { ?>
	<?php foreach($data as $v ) {?>
			<li id="<?php echo $v['id']; ?>" class="message_box" >
				<div  align="left">
					<a data-id="<?php echo $v['id']; ?>" class="show-content second" href="javascript:void(0)" id="showFullContent-<?php echo $v['id']; ?>" >
				</div>
			</li>
	<?php 
<?php } ?>	