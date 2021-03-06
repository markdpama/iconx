<div class="section-nav">
	<div class="page_title" >PRODUCTS AND PROMOS</div>
	<ul class="tab">
		<li class="iclose">
		</li>
	</ul>
</div>
<div class="bg-middle blue_bg">
<div class="top_shadow_dark"></div>
<?php if($data) { ?>
	<div id="latest" class="latest">
		<ul class="list-news list-view">
		<?php foreach($data as $p ) {?>
				<li id="<?php echo $p['id']; ?>" data-date="<?php echo preg_replace('/[^a-zA-Z0-9]/', "" ,$p['publish_up']); ?>" class="message_box" >
					<div  align="left">
						<a data-id="<?php echo $p['id']; ?>" class="show-content <?php echo $ctr; ?>" href="javascript:void(0)" id="showFullContent-<?php echo $p['id']; ?>" >
							<span class="metanews middle_title"><?php echo date("F d, Y", strtotime($p['publish_up'])); ?></span>
							<div class="img_thumb">
								<img class="thumb" src="<?php echo base_url(); ?>_assets/images/articles/thumbnails/<?php echo $p['images']; ?>" />
							</div>
							<?php 
								$countTitle = strlen($p['title']); 
								$countSubtitle = strlen($p['subtitle']);
							?>
							<div class=" title title-news <?php echo ($countSubtitle == 0 ? 'middle_title': 'middle_pos'); ?>">
								<?php echo ($countTitle > 60 ? stripcslashes(substr(stripcslashes($p['title']),0,58)).'...' : stripcslashes($p['title']));  ?>
							</div>
							<div class=" sub_title sub_title-news <?php //echo ($countSubtitle != 0 ? 'middle_pos': ''); ?>">
								<?php echo ($countSubtitle > 65 ? stripcslashes(substr($p['subtitle'],0,60)).'...' : stripcslashes($p['subtitle']));  ?>
								<?php 
								$string = $p['subtitle'];	
								echo character_limiter($string, 60);
								?>
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
<form id="news"></form>
<script type="text/javascript">
	$(document).ready(function(){
		var scrollCount = 0;
		function last_msg_funtion(ID,moveTo) 
		{ 
			$('div#last_msg_loader').html('<img src="<?php echo base_url(); ?>_assets/images/loader.gif">');
			$.post("<?php echo site_url('articles/get_product_and_promos_second/'); ?>/"+ID,
			$("#news").serialize(),
			function(data){
				if (data != "") {
					$(".message_box:last").after(data);
					$('.second').bind('click', function(){
						//var a = $(this).attr('data-id');
						//alert(a);
					   $.ajax({
							url : '<?php echo base_url(); ?>articles/get_article/'+$(this).attr('data-id'),
							dataType: "html",
							success: function(result){
							 $("#middle-content").addClass("hide");
							 $(".close-content").css("display", "block");
							 $(".close-content").css("visibility", "visible");
							 $("#full-content").addClass("full-content show white_bg margin-top_12px");
							 $("#full-content").removeClass("hide");
							 $("#middle-content").removeClass("show");
							 $("#middle-content").addClass("hide");
							 loading(); 
							  $(".full-content").fadeIn(300, function() {
								$("#full-content").html(result);
								loading_complete();
							 });  
							 $(".arrow-products").css("display", "block");
							 $(".arrow-products-white").css("display", "block");
							 $(".arrow-news-white").css("display", "none");
							}
					   });      
					});
					$('div#last_msg_loader').empty();
					$("#latest").mCustomScrollbar("update");
				}
			});
			
			
			
		};  
		$("#latest").mCustomScrollbar({
			scrollButtons:{
				enable:true,
				scrollSpeed: "auto"
			},
			scrollInertia:50,
			callbacks:{
				onTotalScroll:function(){ 
					OnTotalScroll(); 
				}
			}
		});
		function OnTotalScroll(){
			var ID=$(".message_box:last").attr("data-date");
			var moveTo=$(".message_box:last").attr("id");
			var lastItem=$("#showFullContent-"+ moveTo).attr("data-id");
			scrollCount++;
			//alert(scrollCount);
			if(scrollCount == 1){
				last_msg_funtion(ID,moveTo);
				scrollCount = 0;
			}
		}
		$('.first').bind('click', function(){
		//$(".first").click(function () {
			$.ajax({
				url : '<?php echo base_url(); ?>articles/get_article/'+$(this).attr('data-id'),
				dataType: "html",
				success: function(result){
				 $("#middle-content").addClass("hide");
				 $(".close-content").css("display", "block");
				 $(".close-content").css("visibility", "visible");
				 $("#full-content").addClass("full-content show white_bg margin-top_12px");
				 $("#full-content").removeClass("hide");
				 $("#middle-content").removeClass("show");
				 $("#middle-content").addClass("hide");
				 loading(); 
				  $(".full-content").fadeIn(300, function() {
					$("#full-content").html(result);
					loading_complete();
				 });  
				 $(".arrow-products").css("display", "block");
				 $(".arrow-products-white").css("display", "block");
				 $(".arrow-news-white").css("display", "none");
				}
		    }); 
		}); 		
	});
</script>