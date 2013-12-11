	function device() {
		var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
		var isiPhone = /iphone/i.test(navigator.userAgent.toLowerCase());
		var isiPod = /ipod/i.test(navigator.userAgent.toLowerCase());
		var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
		var isBlackBerry = /blackberry/i.test(navigator.userAgent.toLowerCase());
		var isWebOS = /webos/i.test(navigator.userAgent.toLowerCase());
		var isWindowsPhone = /windows phone/i.test(navigator.userAgent.toLowerCase());
		var mobile = false;
		
		if (isAndroid)
		{
		  //alert('android');
		  return mobile = true;
		 }else if (isiPhone)
		{
		  //alert('iPhone');
		  return mobile = true;
		}else if (isiPod)
		{
		  //alert('iPod');
		  return mobile = true;
		}else if (isiDevice)
		{
		  //alert('isiDevice');
		  return mobile = true;
		}else if (isBlackBerry)
		{
		 // alert('isBlackBerry');
		  return mobile = true;
		}else if (isWebOS)
		{
		  //alert('isWindowsPhone');
		  return mobile = true;
		}else{
			return mobile = false;
		}
		
		return mobile;
	}
	function getWidth() {
		if (self.innerWidth) {
		   return self.innerWidth;
		}
		else if (document.documentElement && document.documentElement.clientHeight){
			return document.documentElement.clientWidth;
		}
		else if (document.body) {
			return document.body.clientWidth;
		}
		return 0;
	}
	
	function closeContent() {
		$("#full-content").innerHTML = "";
		$('#full-content').attr('style', 'height: 543px !important; top: 0px  !important; overflow-y:hidden; background-color:#ccc; z-index: 9999 !important; display:none !important; width: 865px !important;border-radius:9px;');
		$('#full-content').animate({height: "height: 0px;" }, 530);
	}
	function closeMiddle() {
		var bodyWidth = getWidth();
		//$("#content").empty();
		if(bodyWidth >= 900){

			$('#middle').hide(500); 
			//$('.nicescroll-rails').hide(500); 
			
			$('#middle').attr('style', 'top: 0px !important; display:none !important; position: absolute !important; width: 0px !important;');
			$('#middle').animate({height: "0px" }, 900);
			
			$('#tile7').animate({top: "290px" }, 500);
			$('#tile7').attr('style', 'left: 0px !important;');
			
			$('#tile8').animate({top: "290px" }, 500);
			$('#tile8').attr('style', 'left: 10px !important;');
			
			$('#tile2').animate({top: "290px" }, 500);
			$('#tile2').attr('style', 'left: 20px !important;');
			
			$('#tile9').animate({top: "435px" }, 500);
			$('#tile9').attr('style', 'left: 320px !important;');
			
			$('#tile10').animate({top: "290px" }, 500);
			$('#tile10').attr('style', 'left: 580px !important;');
			
			$('#tile11').animate({top: "435px" }, 500);
			$('#tile11').attr('style', 'left: 0px !important;');
			
			$('#tile12').animate({top: "435px" }, 500);
			$('#tile12').attr('style', 'left: 160px;');
			
			$('#content-mos').attr('style', 'height: 580px !important;');	
			
			fixedTileDesktop();
		}
		news_isopen = false;
		prod_prom_isopen = false;
	}
	
	function showMiddle() {
		
		var bodyWidth = getWidth();
		var active = true;
		if(bodyWidth >= 900){
		
			$("#middle").fadeIn();
			$('#middle').attr('style', 'top: 300px  !important; display:block !important; position: absolute !important; width: 865px !important; ');
			//$('#middle').animate({height: "495px" }, 1200);
			
			
			$('#tile7').animate({top: "830px" }, 500);
			$('#tile7').attr('style', 'left: 0px !important;');
			
			$('#tile8').animate({top: "830px" }, 500);
			$('#tile8').attr('style', 'left: -5px !important;');
			
			$('#tile2').animate({top: "830px" }, 500);
			$('#tile2').attr('style', 'left: -10px !important;');

			$('#tile9').animate({top: "975px" }, 500);
			$('#tile9').attr('style', 'left: 290px !important; position:absolute;');
			
			$('#tile10').animate({top: "830px" }, 500);
			$('#tile10').attr('style', 'left: 580px !important; position:absolute;');
			
			$('#tile11').animate({top: "975px" }, 500);
			$('#tile11').attr('style', 'left: 0px !important; position:absolute;');
			
			$('#tile12').animate({top: "975px" }, 500);
			$('#tile12').attr('style', 'left: 145px !important;  position:absolute;');
			
			$('#content-mos').attr('style', 'height: 1175px !important;');	
			
			

			//fixedTileMiddle();
		}
		return active;
	}
	
	function fixedTileDesktop() {
			//alert(getWidth());
			var bodyWidth = getWidth();
			
			if(bodyWidth >= 900){
				//alert(bodyWidth);
				//force tile position
				$('#tile2').attr(
					'style', 
					'position: absolute !important;top: 290px;left: 435px !important;'
					);
				$('#tile3').attr(
					'style', 
					'position: absolute !important;top: 0px;left: 435px !important;'
					);
				$('#tile4').attr(
					'style', 
					'position: absolute !important;top: 0px;left: 580px !important;'
					);
				$('#tile5').attr(
					'style', 
					'position: absolute !important;top: 145px;left: 435px !important;'
					);				
				$('#tile6').attr(
					'style', 
					'position: absolute !important;top: 145px;left: 580px !important;'
					);
				$('#tile8').attr(
					'style', 
					'position: absolute !important;top: 290px;left: 290px !important;'
					);
				$('#tile9').attr(
					'style', 
					'position: absolute !important;top: 435px;left: 290px !important;'
					);
				$('#tile10').attr(
					'style', 
					'position: absolute !important;top: 290px;left: 580px !important;'
					);
				$('#tile11').attr(
					'style', 
					'position: absolute !important;top: 435px;left: 0px !important;'
					);
				$('#tile12').attr(
					'style', 
					'position: absolute !important;top: 435px;left: 145px !important;'
					);
			}
	
	}
	
	function fixedTileMiddle() {
			//alert(0);
			var bodyWidth = getWidth();
			//alert(bodyWidth);
			if(bodyWidth >= 900){
				//alert(bodyWidth);
				//force tile position
				$('#tile9').attr(
					'style', 
					'position: absolute !important;top: 820px;left: 320px !important;overflow: hidden;'
					);
				$('#tile10').attr(
					'style', 
					'position: absolute !important;left: 640px;overflow: hidden;'
					);
				$('#tile11').attr(
					'style', 
					'position: absolute !important;top: 820px;left: 0px !important;overflow: hidden;'
					);
				$('#tile12').attr(
					'style', 
					'position: absolute !important;top: 820px;left: 160px !important;overflow: hidden;'
					);
			}
	
	}

$(document).ready(function(){
	
	var mobile = device();
	//alert(mobile);
	
	//Create a function for tiles
	function matrix_tiles_init() {
	//Flexslider	
    $('.flexslider').flexslider();
	
	//Fix Masonry container width error
	function matrix_fix_masonry() {
	var screenWidth = jQuery(window).width();
	if (screenWidth < 900) {
		jQuery('#mainpage-mos').width(screenWidth);
	} else {
		jQuery('#mainpage-mos').width(900);
	}
	
	};
	matrix_fix_masonry();
	jQuery(window).resize(matrix_fix_masonry);

	//Masonry Settings
    $('#content-mos').masonry({
      itemSelector : '.tile',
      columnWidth : 150,
	  isAnimated: true,
	  isFitWidth: true
    });
	
  	//Allow effects when hovering on tiles
    $('.tile').not('.exclude').hover(function(){  
		
		if(mobile == false){

			$('.tile').not(this).addClass('fade');
			//alert('desktop');
		}
    },     
    function(){    
		var bodyWidth = getWidth();
			//alert(bodyWidth);
			if(bodyWidth >= 900){
				$('.tile').removeClass('fade');   
			}
    });
	//hover image
	//$('.tile').append('<img class="tilehover" src="_assets/images/tilehover.png" alt=" "/>');
		
	//Live-tile effects
	$(".live").liveTile({pauseOnHover: true});
	
	//hover tile
	$('.tile').hover(
		function() { 
			$('.tile-cat').fadeIn('slow'); 
		}, 
		function() {
			$('.tile-cat').hide(); 
		}
	);
	
	//Lightbox
	$("a.lightbox").click(function(){
		$(this).next(".tile-pre").addClass("tempsrc");
	});
	var lbSRC ="";
	
	$(".fancybox-overlay").bind("click", $("#fancybox-close").fancybox.close);
	$("a.lightbox").fancybox({
		/*'margin' : 0 ,
		 'modal': true,
		'overlayColor' : '#fff',
		'overlayOpacity' : '0.9',
		'speedOut': 100,
		'openEffect': 'fade',
		'scrolling': 'no',
        'closeEffect': 'fade',
		'width': '70%',
		'height': '70%',
		'cyclic' : true,
		//Lightbox iframe fix
		'onComplete': function() {
		//lbSRC = $('#fancybox-content').find('iframe').attr('src');
		lbcolor = $('#fancybox-content').find('article').attr('data-lbcolor');
		$('#fancybox-content').css('border-color',lbcolor);
		$('#fancybox-close').css('display','block');
		},
		'onClosed': function() {
		//$('.tempsrc').find('iframe').attr('src',lbSRC);
		$('.tile-pre').removeClass('tempsrc');
		$('#fancybox-content').css('border-color','#404040');
		},
		helpers:  {
			overlay: {
				locked: true
			}
		}*/
		openEffect: 'fade',
		scrolling: 'no',
		closeEffect: 'fade',
		beforeShow  : function() {

			ns.locked = !ns.locked;
		},
		afterClose  : function(){
			ns.locked = !ns.locked;
		},
		helpers: {
			media: {},
			overlay: {
				locked: true
			},
			title: {
				type: 'inside'
			}			
		}
	});
	

	//matrix_media_player();
	
	}//end matrix_tiles_init();
	
	matrix_tiles_init(); //run the function when page is ready

	
	jQuery('a.lightbox').click(function(){
		var vpWidth = jQuery(window).width();
		if ( vpWidth < 590 ) {
			jQuery('article .jp-controls-holder').css('width',(vpWidth-20) + 'px');
			var newWidth = vpWidth - 280;
			jQuery('article .jp-progress').css('width', newWidth + 'px'); 
		} else {
			jQuery('article .jp-controls-holder').css('width',570 + 'px');
			jQuery('article .jp-progress').css('width', 310 + 'px');
		}
	});
	jQuery(window).resize(function(){
		var vpWidth = jQuery('article .lb-audio').width();
		if ( vpWidth < 570 ) {
			jQuery('article .jp-controls-holder').css('width',vpWidth + 'px');
			var newWidth = vpWidth - 260;
			jQuery('article .jp-progress').css('width', newWidth + 'px'); 
		} else {
			jQuery('article .jp-controls-holder').css('width',570 + 'px');
			jQuery('article .jp-progress').css('width', 310 + 'px');
		}
	});

	
	// Fix background pattern
	var screenheight = $(window).height();
	//$('#container').css('min-height', screenheight);
});

