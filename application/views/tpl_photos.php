<form id="photos"></form>
<div class="section-nav">
	<ul class="tab">
		<li class="iclose">

		</li>
		
	</ul>
</div>
<div class="bg-middle blue_bg">
<div class="top_shadow_dark"></div>
<?php// if($data) { ?>
<div class="bg-middle">
	<div id="latest" class="latest">
		<ul class="list-news list-view">
		<?php //foreach($data as $v ) {?>
				<li id="<?php //echo $v['id']; ?>" class="message_box" >
					<div  align="left">
						<a data-id="<?php //echo $v['id']; ?>" class="show-content first" href="javascript:void(0)" id="showFullContent-<?php //echo $v['id']; ?>" >
							<span class="metanews middle_title"><?php //echo date("F d, Y", strtotime($v['published'])); ?></span>
							<div class="img_thumb">
								<?php //$thumbnail = ($v['type'] == 'youtube-link'? $v['thumb'] : base_url().'_assets/videos/thumb/'.$v['thumb'] );?>
								<img class="thumb" src="<?php //echo $thumbnail;?> " />
							</div>
							<?php $countTitle = strlen($v['title']); ?>
							<div class=" title title-news <?php //echo ($countTitle == 0 ? 'middle_title': 'middle_pos'); ?>">
								Caption Here
								<?php echo character_limiter($v['title'], 58); ?>
							</div>
							<div class=" sub_title sub_title-news">
								<?php //echo character_limiter($v['description'], 60); ?>
								Short description
							</div>
							
						</a>
					</div>
				</li>
		<?php //}	?>
		</ul>
	</div>

<?php //} else {	?>	
<!--	<div class="nodata">
		<div class="icon"></div>No data to display
	</div>-->
<?php //} ?>	
<div class="bottom_shadow_dark"></div>
</div>
	<div id="last_msg_loader"></div>
<script type="text/javascript">
	$(document).ready(function(){
		
		function last_msg_funtion() { 

           var ID=$(".message_box:last").attr("id");
			$('div#last_msg_loader').html('<img src="<?php echo base_url(); ?>_assets/images/loader.gif">');
			$.post("<?php echo site_url('videos/get_videos_second/'); ?>/"+ID,
			$("#photos").serialize(),
			function(data){
				if (data != "") {
					$(".message_box:last").after(data);
					$('.second').bind('click', function(){
						
					   $.ajax({
							url : '<?php echo base_url(); ?>videos/get_video/'+$(this).attr('data-id'),
							dataType: "html",
							success: function(result){
							 //alert(result)
							 $('#full-content').attr('style', 'height: 580px !important; overflow-y: hidden; top: 0px  !important; z-index: 9999 !important; display:block !important; position: absolute !important; width: 865px !important;border-radius:9px;');
							 $("#full-content").html(result);
							 
							}
					   });      
					})
				}
				$('div#last_msg_loader').empty();
			});
			
		};  
		
		$("#latest").mCustomScrollbar({
			scrollButtons:{
				enable:true
			},
			callbacks:{
				//onScrollStart:function(){ OnScrollStart(); },
				//onScroll:function(){ OnScroll(); },
				onTotalScroll:function(){ OnTotalScroll(); }
				///onTotalScrollBack:function(){ OnTotalScrollBack(); },
				//onTotalScrollOffset:40,
				//onTotalScrollBackOffset:20,
				//whileScrolling:function(){ WhileScrolling(); } 
			}
		});
		function OnTotalScroll(){
			last_msg_funtion();		
		}
		$('.first').bind('click', function(){
			//alert('Play Video');
		   $.ajax({
				url : '<?php echo base_url(); ?>videos/get_video/'+$(this).attr('data-id'),
				dataType: "html",
				success: function(result){
				 //alert(result)
				 $('#full-content').attr('style', 'height: 580px !important; overflow-y: hidden; top: 0px  !important; z-index: 9999 !important; display:block !important; position: absolute !important; width: 865px !important;border-radius:9px;');
				 $("#full-content").html(result);
				 
				}
		   });         
		}); 		
	});
</script>