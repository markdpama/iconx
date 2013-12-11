<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery.js"></script> 	
<script src="<?php echo base_url(); ?>_assets/js/jquery.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		
		function last_msg_funtion() 
		{ 
		   
		   //alert("test");
           var ID=$(".message_box:last").attr("id");
			//$('div#last_msg_loader').html('<img src="bigLoader.gif">');
			//$.post("load_data.php?action=get&last_msg_id="+ID,
			//$.post("http://localhost/filament/barako/iconx-barako/articles/get_latest_news_second/"+ID,
			$.post("<?php echo site_url('articles/get_latest_news_second/'); ?>/"+ID,
			$("#test").serialize(),
			function(data){
				if (data != "") {
				$(".message_box:last").after(data);			
				}
				$('div#last_msg_loader').empty();
			});
			
		};  
		
		$('#latest').bind('scroll', function(){
			if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight){
				alert('end reached');
				last_msg_funtion();
			}
		});
		
	});
	</script>
<form id="test"></form>
<div id="latest" style="height:50px; overflow:auto;" class="nano">
	<?php echo $page; ?>
	<?php echo $testing; ?>
</div>
