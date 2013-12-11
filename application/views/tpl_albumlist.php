<form id="photos"></form>
<div class="section-nav">
	<div class="page_title" >PHOTO ALBUMS</div>
	<ul class="tab">
		<li class="iclose">

		</li>
	</ul>
</div>
<div class="bg-middle blue_bg">
<div class="top_shadow_dark"></div>
<?php if($data) { ?>
<div class="bg-middle">
	<div id="latest" class="latest">
		<ul class="list-photo list-view">
		<?php foreach($data as $album ) { ?>
				<li id="<?php echo $album['album_id']; ?>" data-date="<?php echo preg_replace('/[^a-zA-Z0-9]/', "" ,$album['album_publish_date']); ?>" class="message_box" >
					<div  align="left">
						<a data-id="<?php echo $album['album_id']; ?>" class="show-content first" href="javascript:void(0)" id="showFullContent-<?php echo $album['album_id']; ?>" >
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
<script type="text/javascript">
	$(document).ready(function(){
		var scrollCount = 0;
		function last_msg_funtion() { 

           var ID=$(".message_box:last").attr("data-date");
			$('div#last_msg_loader').html('<img src="<?php echo base_url(); ?>_assets/images/loader.gif">');
			$.post("<?php echo site_url('photos/albumlist_second/'); ?>/"+ID,
			$("#photos").serialize(),
			function(data){
				if (data != "") {
					$(".message_box:last").after(data);
					$('.second').bind('click', function(){
						$("#full-content").html('');
						loading(); 
					   $.ajax({
							url : '<?php echo base_url(); ?>photos/get_photos/'+$(this).attr('data-id'),
							dataType: "html",
							success: function(result){
							 //alert(result)
							 $("#middle-content").addClass("hide");
							 $(".close-content").css("display", "block");
							 $(".close-content").css("visibility", "visible");
							 $("#full-content").addClass("full-content show blue_bg margin-bottom_12px");
							 $("#full-content").removeClass("hide white_bg");
							 $("#middle-content").removeClass("show");
							 $("#middle-content").addClass("hide");
							  $(".full-content").fadeIn(300, function() {
								$("#full-content").html(result);
								loading_complete();
							 });  
							 
							}
					   });      
					})
				}
				$('div#last_msg_loader').empty();
				$("#latest").mCustomScrollbar("destroy");
				$("#latest").mCustomScrollbar({
					scrollButtons:{
						enable:true
					},
					scrollInertia:50
				});
				$("#latest").mCustomScrollbar("scrollTo","#"+ID);
			});
			
		};  
		
		$("#latest").mCustomScrollbar({
			scrollButtons:{
				enable:true,
				scrollSpeed: "auto"
			},
			scrollInertia:50,			
			callbacks:{
				onTotalScroll:function(){ OnTotalScroll(); }
			}
		});
		function OnTotalScroll(){
			scrollCount += 1
			//alert(scrollCount);
			if(scrollCount == 1){
				last_msg_funtion();		
			}	
		}
		$('.first').bind('click', function(){
			
			loading(); 
			
		   $.ajax({
				url : '<?php echo base_url(); ?>photos/get_photos/'+$(this).attr('data-id'),
				dataType: "html",
				success: function(result){
				 $("#full-content").html('');
				 $('#full-content').height(518);
				 $("#middle-content").addClass("hide");
				 $(".close-content").css("display", "block");
				 $(".close-content").css("visibility", "visible");
				 $(".close-content").removeClass("close-pos");
				 $(".close-content").addClass("close-pos-up");
				 $("#full-content").addClass("full-content show blue_bg margin-bottom_12px");
				 $("#full-content").removeClass("hide white_bg margin-top_12px");
				 $("#middle-content").removeClass("show");
				 $("#middle-content").addClass("hide");
				  $(".full-content").fadeIn(1000, function() {
					$("#full-content").html(result);
					loading_complete();
				 });  
				 
				}
		   });         
		}); 		
	});
</script>