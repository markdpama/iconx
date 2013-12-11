<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>	
	<title>The Flip Page of IconX</title>		
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<meta name='description' content='Barako' />
	<meta name="author" content="jhoana">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script src="<?php echo base_url(); ?>_assets/js/jquery-1.8.0.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_assets/css/flip/jquery.jscrollpane.custom.css?<?php echo time(); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_assets/css/flip/bookblock.css?<?php echo time(); ?>" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/flip/magnific-popup.css?<?php echo time(); ?>"> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_assets/css/flip/custom.css?<?php echo time(); ?>" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/stylesheet.css?<?php echo time(); ?>" type="text/css" />
	<link href="<?php echo base_url(); ?>_assets/css/jquery.mCustomScrollbar.css?<?php echo time(); ?>" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/flippage.css?<?php echo time(); ?>" type="text/css" />
	<script src="<?php echo base_url(); ?>_assets/js/flip/modernizr.custom.79639.js"></script>
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>_assets/images/favicon.png">

	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery-ui-1.10.3.custom.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/js/jquery-ui/themes/base/jquery.ui.all.css?<?php echo time(); ?>" type="text/css" />
	
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
	<div id="flippage" class="bb-custom-wrapper " style="position: absolute; top: 0;left:0;">	
		<div id="bb-bookblock" class="bb-bookblock" >
		<?php foreach($data as $p ) { ?>	
			<div class="bb-item" id="item<?php echo $p['id']; ?>" >
				<div class="article-image"  style="background-image:url('<?php echo base_url(); ?>_assets/images/articles/<?php echo $p['images']; ?>');background-repeat:no-repeat;background-size:cover;height:100%;">
					<div class="flip-bg">
							<div class="flip-aticle-holder">
								<!--<span class="flip-category">Gadgets</span>-->
								<span class="flip-date"><?php echo date("F d, Y", strtotime($p['publish_up'])); ?></span>
								<div class="flip-title-holder">
									<h1 class="flip-title">
										<a href="<?php echo base_url(); ?>articles/get_article_full_flip/<?php echo $p['id']; ?>" class="ajax-popup-link">
										<!--<a href="#test" class="ajax-popup-link">-->
											<?php 
											$string = $p['title'];
											echo character_limiter($string, 50);
											?>
										</a>
									</h1>	
								</div>
								<span class="flip-byline">by <span class="flip-author"><?php echo $p['created_by']; ?></span></span>
							</div>
					</div>	
					
				</div>
			</div>
		<?php } ?>

		</div>
		<div class="flip-header">
			<!-- BEGIN HEADER -->
			<div id="header" class="clearfix">
				<!-- ICONX LOGO -->
				<a id="iconx" href="<?php echo base_url(); ?>" class="marque" title="Home">
					<img id="logo" src="<?php echo base_url(); ?>_assets/images/iconx-logo.png" alt="logo" />
				</a>
				<!-- END LOGO -->
		
				<!-- Globe Logo -->
				<?php /*
				<a id="globe" href="<?php echo base_url(); ?>" title="home">
					<img id="globe_lobe" src="<?php echo base_url(); ?>_assets/images/logo_globeNEW_72x27.png"/>
				</a>
				*/ ?>
				<div class="icons_holder">
					<?php /*
					<div class="icons">
						<img class="marque" title="Logout" src="<?php echo base_url(); ?>_assets/images/icon_logout.png" alt="Logout" />
					</div>						
					<div class="icons">
						<img class="marque" title="Search" src="<?php echo base_url(); ?>_assets/images/icon_search.png" alt="Search" />
					</div>
					*/ ?>
					<a id="globe" target="_blank" href="http://www.globe.com.ph" class="marque" title="www.globe.com.ph">
						<img id="globe_lobe" src="<?php echo base_url(); ?>_assets/images/logo_globeNEW_72x27.png"/>
					</a>					
				</div>
			</div>
			<!-- END HEADER -->		
		</div>
		<a style="" class="close-flip" href="<?php echo base_url(); ?>" onclick=""  >
			<img  src="<?php echo base_url(); ?>_assets/images/close-white-gray.png" title="Close" />
		</a>		
		<nav class="left">
			<span id="bb-nav-prev" ></span>
		</nav>
		<nav class="right">
			<span id="bb-nav-next" ></span>
		</nav>
	</div>					
<script src="<?php echo base_url(); ?>_assets/js/flip/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(); ?>_assets/js/flip/jquery.jscrollpane.min.js"></script>
<script src="<?php echo base_url(); ?>_assets/js/flip/jquerypp.custom.js"></script>
<script src="<?php echo base_url(); ?>_assets/js/flip/jquery.bookblock.js"></script>
<script src="<?php echo base_url(); ?>_assets/js/flip/page.js"></script>
<script src="<?php echo base_url(); ?>_assets/js/flip/jquery.magnific-popup.js"></script> 
<script src="<?php echo base_url(); ?>_assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	
<script>
	$(function() {

			Page.init();

	});
	$(document).ready(function() {
		$('.ajax-popup-link').magnificPopup({
			type: 'ajax',
			midClick: true,
			removalDelay: 500,
			mainClass: 'my-mfp-zoom-in'
		});
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
    <style type="text/css">
      /* Styles for dialog window */
      #small-dialog {
        background: white;
        padding: 20px 30px;
        text-align: left;
        max-width: 400px;
        margin: 40px auto;
        position: relative;
      }


      /**
       * Fade-zoom animation for first dialog
       */
      
      /* start state */
      .my-mfp-zoom-in .zoom-anim-dialog {
        opacity: 0;

        -webkit-transition: all 0.2s ease-in-out; 
        -moz-transition: all 0.2s ease-in-out; 
        -o-transition: all 0.2s ease-in-out; 
        transition: all 0.2s ease-in-out; 



        -webkit-transform: scale(0.8); 
        -moz-transform: scale(0.8); 
        -ms-transform: scale(0.8); 
        -o-transform: scale(0.8); 
        transform: scale(0.8); 
      }

      /* animate in */
      .my-mfp-zoom-in.mfp-ready .zoom-anim-dialog {
        opacity: 1;

        -webkit-transform: scale(1); 
        -moz-transform: scale(1); 
        -ms-transform: scale(1); 
        -o-transform: scale(1); 
        transform: scale(1); 
      }

      /* animate out */
      .my-mfp-zoom-in.mfp-removing .zoom-anim-dialog {
        -webkit-transform: scale(0.8); 
        -moz-transform: scale(0.8); 
        -ms-transform: scale(0.8); 
        -o-transform: scale(0.8); 
        transform: scale(0.8); 

        opacity: 0;
      }

      /* Dark overlay, start state */
      .my-mfp-zoom-in.mfp-bg {
        opacity: 0;
        -webkit-transition: opacity 0.3s ease-out; 
        -moz-transition: opacity 0.3s ease-out; 
        -o-transition: opacity 0.3s ease-out; 
        transition: opacity 0.3s ease-out;
      }
      /* animate in */
      .my-mfp-zoom-in.mfp-ready.mfp-bg {
        opacity: 0.8;
      }
      /* animate out */
      .my-mfp-zoom-in.mfp-removing.mfp-bg {
        opacity: 0;
      }



      /**
       * Fade-move animation for second dialog
       */
      
      /* at start */
      .my-mfp-slide-bottom .zoom-anim-dialog {
        opacity: 0;
        -webkit-transition: all 0.2s ease-out;
        -moz-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;

        -webkit-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        -moz-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        -ms-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        -o-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );

      }
      
      /* animate in */
      .my-mfp-slide-bottom.mfp-ready .zoom-anim-dialog {
        opacity: 1;
        -webkit-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        -moz-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        -ms-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        -o-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
      }

      /* animate out */
      .my-mfp-slide-bottom.mfp-removing .zoom-anim-dialog {
        opacity: 0;

        -webkit-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        -moz-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        -ms-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        -o-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
      }

      /* Dark overlay, start state */
      .my-mfp-slide-bottom.mfp-bg {
        opacity: 0;

        -webkit-transition: opacity 0.3s ease-out; 
        -moz-transition: opacity 0.3s ease-out; 
        -o-transition: opacity 0.3s ease-out; 
        transition: opacity 0.3s ease-out;
      }
      /* animate in */
      .my-mfp-slide-bottom.mfp-ready.mfp-bg {
        opacity: 0.8;
      }
      /* animate out */
      .my-mfp-slide-bottom.mfp-removing.mfp-bg {
        opacity: 0;
      }
    </style>
	</body>
</html>
