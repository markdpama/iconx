<div id="<?php echo $page; ?>-container">
	<h1><?php echo $page; ?></h1>
	<table id="" class="<?php echo $page; ?>-listing">
		<tr>
			<th>Title</th>
			<th>Status</th>
			<th></th>
		</tr>
		<?php foreach( $parent_categories as $p_category ) { ?>
		<tr>
			<td><?php echo $p_category['title']; ?></td>
			<td><?php echo $p_category['status']; ?></td>
			<td><?php echo $p_category['id']; ?></td>
		</tr>	
			<?php foreach( $sub_categories as $s_category ) { ?>
				<?php if( $s_category['parent_id'] == $p_category['id'] ) { ?>
				<tr>
					<td><?php echo $s_category['title']; ?></td>
					<td><?php echo $s_category['status']; ?></td>
					<td><?php echo $s_category['id']; ?></td>
				</tr>
				<?php  } ?>
			<?php  } ?>
		<?php  } ?>
	</table>
</div>