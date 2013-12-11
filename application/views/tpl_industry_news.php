<form id="news"></form>
<div class="section-nav">
	<ul class="tab">
		<li class="iclose"></li>
		<li class="icontribute" onclick="showiContributeNews()">iCONTRIBUTE	</li>
		<li class="active industry-active" onclick="showIndustryNews()">INDUSTRY NEWS</li>
		<li class="kaglobe" onclick="showKaGlobeNews()">KA-GLOBE NEWS</li>
	</ul>
</div>
<div class="bg-middle blue_bg">
<div class="top_shadow_dark"></div>
	<?php if($data) { ?>
		<div id="latest" class="latest">
			<ul class="list-news list-view">
			<?php foreach($data->item as $p ) {?>
				<?php $dc = $p->children('http://purl.org/dc/elements/1.1/'); ?>
					<li id=""class="message_box" >
						<div  align="left">
							<a target="_blank" href="<?php echo $p->link; ?>">
								<span class="metanews middle_title"><?php echo date("F d, Y", strtotime($dc->date)); ?></span>
								<!--<div class="img_thumb">
									<img class="thumb" src="" />
								</div>-->
								<div class=" title title-news middle_pos no-padding"><?php echo $p->title; ?></div>
								<div class=" sub_title sub_title-news no-padding"><?php echo character_limiter($dc->description, 60); ?></div>
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
	
		function last_msg_funtion() 
		{ 

           var ID=$(".message_box:last").attr("data-date");
           var moveTo=$(".message_box:last").attr("id");
		   //alert(moveTo);
			$('div#last_msg_loader').html('<img src="<?php echo base_url(); ?>_assets/images/loader.gif">');
			$.post("<?php echo site_url('articles/get_latest_news_second/'); ?>/"+ID,
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
							 $(".arrow-products").css("display", "none");
							 $(".arrow-products-white").css("display", "none");
							 $(".arrow-news-white").css("display", "block");
							}
					   });      
					});
				}
				$('div#last_msg_loader').empty();
				$("#latest").mCustomScrollbar("destroy");
				$("#latest").mCustomScrollbar({
					scrollButtons:{
						enable:true
					},
					scrollInertia:50
				});
				$("#latest").mCustomScrollbar("scrollTo","bottom");
				
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
				//last_msg_funtion();		
			}
		}

		$('.first').bind('click', function(){
			
		   $.ajax({
				url : '<?php echo base_url(); ?>articles/get_article/'+$(this).attr('data-id'),
				dataType: "html",
				success: function(result){
				 $("#middle-content").addClass("hide");
				 $(".close-content").css("display", "block");
				 $(".close-content").removeClass("close-pos-up");
				 $(".close-content").addClass("close-pos");
				 $(".close-middle").removeClass("close-pos-up");
				 $(".close-middle").addClass("close-pos");
				 $(".close-content").css("visibility", "visible");
				 $("#full-content").addClass("full-content show white_bg margin-top_12px");
				 $("#full-content").removeClass("hide");
				 $("#middle-content").removeClass("show");
				 $("#middle-content").addClass("hide");
				 loading(); 
				  $(".full-content").fadeIn(1000, function() {
					$("#full-content").html(result);
					loading_complete();
				 });  
				 $(".arrow-products").css("display", "none");
				 $(".arrow-products-white").css("display", "none");
				 $(".arrow-news-white").css("display", "block");
				}
		   });         
		}); 		
	});
</script>