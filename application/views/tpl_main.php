<!DOCTYPE html>
<html lang="en">
	<head>	
		<title>IconX</title>		
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<meta name='description' content='IconX' />
		<meta name="author" content="jhoana">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<script src="<?php echo base_url(); ?>_assets/js/jquery-1.8.0.min.js" type="text/javascript"></script>
		
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/stylesheet.css?<?php echo time(); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/<?php echo $page; ?>.css?<?php echo time(); ?>" type="text/css" />
		<link href="<?php echo base_url(); ?>_assets/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/validate_form.js" ></script>	
		<script src="<?php echo base_url(); ?>_assets/js/jquery.mCustomScrollbar.concat.min.js" ></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>_assets/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>_assets/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_assets/js/fancybox/jquery.fancybox-1.3.4.css?<?php echo time(); ?>" media="screen" />  
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/photos.css?<?php echo time(); ?>" type="text/css" />

		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery-ui-1.10.3.custom.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/js/jquery-ui/themes/base/jquery.ui.all.css?<?php echo time(); ?>" type="text/css" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>_assets/images/favicon.png">		
		<script type="text/JavaScript">
			function killCopy(e){
				return false
			}
			function reEnable(){
				return true
			}
			document.onselectstart=new Function ("return false")
			if (window.sidebar){
				document.onmousedown=killCopy
				document.onclick=reEnable
			}
			/*
			function clearData(){
			window.clipboardData.setData('text','') 
			}
			function ccd(){
			if(clipboardData){
			clipboardData.clearData();
			}
			}
			setInterval("ccd();", 1000);*/
			if(document.all) window.onbeforeprint=new Function("window.location='';"); 
		</script>
	</head>	
	<body ondragstart="return false;" onselectstart="return false;" oncontextmenu="return false;" >
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-43587703-3', 'globetel.com');
		  ga('send', 'pageview');

		</script>
		<div id="bodypat">
			<div id="container">
				<!-- BEGIN HEADER -->
				<div id="header" class="clearfix">
					<!-- ICONX LOGO -->
					<a id="iconx" href="<?php echo base_url(); ?>" class="marque" title="Home">
						<img id="logo" src="_assets/images/iconx-logo.png" alt="iconX" />
					</a>
					<!-- END LOGO -->
					<!-- Globe Logo -->
					<?php /*
					<a id="globe" href="<?php echo base_url(); ?>" title="home">
						<img id="globe_lobe" src="_assets/images/logo_globeNEW_72x27.png" alt="Globe" />
					</a>
					*/ ?>
					<div class="icons_holder">
						<?php /*<!--
						<div class="icons">
							<img class="marque" title="Logout" src="<?php echo base_url(); ?>_assets/images/icon_logout.png" alt="Logout" />
						</div>						
						<div class="icons">
							<img class="marque" title="Search" src="<?php echo base_url(); ?>_assets/images/icon_search.png" alt="Search" />
						</div>
						*/ ?>
						<a id="globe" target="_blank" href="http://www.globe.com.ph" class="marque" title="www.globe.com.ph">
							<img id="globe_lobe" src="_assets/images/logo_globeNEW_72x27.png" alt="Globe" />
						</a>
					</div>
				</div>
				<!-- END HEADER -->
				<div id="content">
					<div id="dvLoading"></div>
					<?php echo $content; ?>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<script src="<?php echo base_url(); ?>_assets/js/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>_assets/js/MetroJs.lt.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>_assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="<?php echo base_url(); ?>_assets/js/javascript.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>_assets/js/smoothscroll.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>_assets/js/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url(); ?>_assets/js/jquery.nicescroll.plus.js"></script>
		<script type="text/javascript">
			
			$(document).ready(function(){
				//alert(isChrome);
				if(isChrome==true) {
					//alert('chrome to.');
					loadCssFile('<?php echo base_url(); ?>_assets/css/scrollbar-chrome.css');

				} else {
					//alert('hindi chrome to.');
					// Load Scrollbar
					$("html").niceScroll({styler:"fb",cursorcolor:"#000"});
				}
				$(".slidingDiv").addClass("blue_bg");
				//$("body").mCustomScrollbar();

				$(".slidingDiv").hide(700);
				$(".show_hide").show(700);

				
				/*$('.show_hide').click(function(){
					
					$(".slidingDiv").slideToggle(700);
					
				});*/
				$(".marque").tooltip({
					position: {
						my: 'left center',
						at: 'right+10 center',
						using: function( position, feedback ) {
							$( this ).css( position );
							$( "<div>" )
							.addClass( "icon-tools" )
							.addClass( feedback.vertical )
							.addClass( feedback.horizontal )
							.appendTo( this );
						}
					}
				});				
			});
			
		</script>
	</body>
</html>
