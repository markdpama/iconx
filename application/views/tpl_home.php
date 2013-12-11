<script type="text/javascript">
	
	// ADDING THE FOREIGN OBJECT FOR BROWSERS NOT SUPPORTING CSS3 MASKS
	// <foreignObject width="100%" height="100%" style="mask: url(#mask);">\
	// </foreignObject>\
	function head () {
	    if (window.SVGForeignObjectElement) {
	        document.write('\
	            <svg width="430px" height="285px">\
	                <defs>\
	                    <mask id="mask" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse">\
	                        <image width="430px" height="285px" xlink:href="<?php echo base_url(); ?>_assets/images/border_9px.png"/>\
	                    </mask>\
	                </defs>\
	        ');
	    }
	}
	function foot () {
	    if (window.SVGForeignObjectElement) {
	        document.write('\
	            </svg>\
	        ');
	    }
	}
	
</script>
<div class="hide" >
	<img src="<?php echo base_url(); ?>_assets/images/bg_repeat.jpg" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/bg_repeat_white.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/close-gray.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/close-white-gray.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/icon_kaglobe_flipview_27x27.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/icon_kaglobe_listview_27x27.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/shadow-bottom.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/shadow-bottom-dark.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/shadow-bottom-light.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/shadow-top.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/shadow-top-dark.png" alt="" />
	<img src="<?php echo base_url(); ?>_assets/images/shadow-top-light.png" alt="" />
</div>

<div id="tile_holder" class="clearfix">
	<div id="tile1" class="tile xlarge margin-bottom_0px">
		<script> 
			//head();
		
		</script>
		<div id="kenburns-slideshow">
			<div id="kenburns-description">
				<!--<h1 id="status">Loading Images..</h1>-->
				<div id="slide-title"></div>
			</div>
		</div>
		<script>
			//foot();
			
		</script>
	
		<div id="view-holder" >
			<a href="javascript:void(0)" id="list-view" class="smoothScroll view-icon show_hide">
				<img src="<?php echo base_url(); ?>_assets/images/icon_kaglobe_listview_27x27.png" class="marque" alt="List View" title="List View" />
			</a>
			<a href="<?php echo base_url(); ?>flippage/news" id="flip-view-news" class="view-icon">
				<img src="<?php echo base_url(); ?>_assets/images/icon_kaglobe_flipview_27x27.png" class="marque" alt="Flip View" title="Flip View" />
			</a>
		</div>	
	</div>
	
	<!--Start Social -->
	<a target="_blank" href="https://socialnetwork.globe.com.ph">
		<div id="tile3" class="tile small live" data-mode="flip" data-direction="horizontal" data-stops="100%" data-speed="400" data-delay="6000">	
			<div class="live-front social">
				<img class="live-img" src="<?php  echo base_url(); ?>_assets/images/tiles/tile-social.png" alt="Social" />
			</div>
			<div class="live-back social">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-gsn.png" alt="Social" />
			</div>			
		</div>
	</a>
	<!--End Social -->
	
	<!--Start Portus -->
	<a target="_blank" href="https://globehr.globe.com.ph/node/257">
		<div id="tile4" class="tile medium live" data-stack="true" data-stops="0,100%" data-speed="750" data-delay="5000">
			<div class="live-front portus">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-portus.png" alt="Everything Portus" />
			</div>
			<div class="live-back portus">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-globe-portus.jpg" alt="Everything Portus" />
			</div>
		</div>
	</a>
	<!--End Portus -->
	
	<!--Start Talk2 Ka-Globe -->
	<a target="_blank" href="http://icon/talk2ka-globe">
		<div id="tile5" class="tile small live" data-mode="flip" data-stops="100%" data-speed="300" data-delay="8000">
			<div class="live-front talk2-kaglobe">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-talk2-kaglobe.png" alt="Talk2 Ka-Globe" />
			</div>
			<div class="live-back talk2-kaglobe">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/talk2kaglobe-icon.jpg" alt="Talk2 Ka-Globe" />
			</div>
			
		</div>
	</a>
	<!--End Talk2 Ka-Globe -->
	
	<!--Start Product and Promos -->
	<div id="tile6" class="tile medium live pointer" data-stops="0,100%" data-speed="750" data-delay="6150">
		<div class="live-front prod-proms">
			<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-prod-proms.png" alt="Our Product and Promos" />
		</div>
		<div class="live-back prod-proms">
			<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/products&promos.jpg" alt="Our Product and Promos" />
		</div>
		<div id="product-view-holder" >
			<a href="javascript:void(0)" id="product-list-view" class="smoothScroll view-icon show_hide">
				<img src="<?php echo base_url(); ?>_assets/images/icon_kaglobe_listview_27x27.png" class="marque" alt="List View" title="List View" />
			</a>
			<a href="<?php echo base_url(); ?>flippage/product_and_promos" id="product-flip-view" class="scroll view-icon">
				<img src="<?php echo base_url(); ?>_assets/images/icon_kaglobe_flipview_27x27.png" class="marque" alt="Flip View" title="Flip View" />
			</a>
		</div>
	</div>
	<!--End Product and Promos -->
	
	<!--Sliding Panel -->
	<div class="slidingDiv clearfix tile exclude" id="slidingDiv" style="display:none;">
		<a href="javascript:void(0)" onclick="closeMiddle();" class="close-middle marque" title="Close" style="display:none;" ></a>
	    <a href="javascript:void(0)" onclick="delayedClose();" class="close-content marque" title="Close" style="display:none;" ></a>
		<div class="arrow-news-white"></div>
		<div class="arrow-products-white"></div>
		<div class="arrow-up arrow-news"></div>
		<div class="arrow-up arrow-products"></div>
		<div id="middle-content" class="exclude">
			<div class="arrow-top-margin" ></div>		
		</div>
		<div class="arrow-down arrow-videos"></div>
		<div class="arrow-down arrow-photos"></div>
		<div class="arrow-trend-white"></div>
		<div class="arrow-down arrow-trend"></div>
		<div id="full-content" class="exclude">
			
		</div>
	</div>
	<!--End Sliding Panel -->

	<!--Start peoplesoft -->
	<a target="_blank" href="https://ps.hrmall.com.ph:4430/psp/hcprd/EMPLOYEE/HRMS/h/?cmd=login&errorCode=106&languageCd=ENG">
		<div id="tile7" class="tile medium live" data-stops="0,100%" data-speed="350" data-delay="2500">
			<div class="live-front peoplesoft">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-peoplesoft.png" alt="PeopleSoft" />
			</div>
			<div class="live-back peoplesoft">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/ops-icon.png" alt="PeopleSoft" />
			</div>
		</div>
	</a>
	<!--End peoplesoft -->
	
	<!--Start Photos -->
	<a href="javascript:void(0)" class="smoothScroll photos" >
		<div id="tile8" class="tile small purple"  data-stops="0,25%,50%,75%,100%" data-speed="3000" data-delay="0" data-direction="horizontal" data-stack="true">
			<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-photos.png" alt="Photos" />
		</div>
	</a>
	<!--End Photos -->
	
	<!--Start videos -->
	<a href="javascript:void(0)" class="smoothScroll videos" >
		<div id="tile2" class="tile small live" data-mode="flip" data-direction="horizontal" data-stops="100%" data-speed="250" data-delay="7000">
		<?php foreach($latest_video as $v ) {?>
		<?php 
			if($v['type'] == 'youtube-link'){
				$thumbnail = $v['thumb'];
				$style="";
			}else{
				$thumbnail =base_url().'_assets/videos/thumb/'.$v['thumb'];
				list($width, $height, $type, $attr) = getimagesize($thumbnail);
				
				if($width > 140){
					$marginLeft = '-'.(($width-140)/2);
				}elseif($width == 140){
					$marginLeft = 0;
				}elseif($width < 140){
					$marginLeft = ((140-$width)/2);
				}
				
				if($height > 140){
					$newHeight = (($height/2)-12);
					$marginTop = ($newHeight/2);
				}elseif($height == 140){
					$marginTop = 0;
				}elseif($height < 140){
					$marginTop = ((140-$height)/2);
				}
				
				$style='height:auto; border-radius:0 !important;margin:auto; z-index: 0 !important; margin-left:0px;margin-top:'.$marginTop.'px;';
			}
		?>
		<?php }	?>
			<div class="live-front peoplesoft" style="overflow:hidden;">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-videos.png" alt="Videos"/>
			</div>
			<div class="live-back" style="background-color:#000; overflow:hidden; border-radius:9px !important; position:relative !important;">
				<img class="live-img" style="<?php echo $style;?>" src="<?php echo $thumbnail;?>" alt="Latest Videos" />
			</div>
		</div>
	</a>
	<!--End  videos  -->
	
	<div id="tile0" class="tile medium">
	</div>
	
	<!--Start Linkout -->
	<a href="<?php echo base_url(); ?>links/linkouts" class="pop-up">
		<div id="tile11" class="tile small blue linkouts"  data-mode="flip" data-direction="horizontal" data-stops="100%" data-speed="750" data-delay="4500">
			<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-linkout.png" alt="Link Out" />
		</div>
	</a>
	<!--End Linkout -->
	
	<!--Start Your HR -->
	<a  target="_blank" href="https://globehr.globe.com.ph">
		<div id="tile12" class="tile small live" data-mode="flip" data-direction="horizontal" data-stops="100%" data-speed="150" data-delay="3500">
			<div class="live-front your-hr">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-your-hr.png" alt="Your HR" />
			</div>
			<div class="live-back your-hr">
				<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/your-hr.jpg" alt="Your HR" />
			</div>				
		</div>
	</a>
	<!--End Your HR -->
	
	<!--Start Tools -->
	<a href="<?php echo base_url(); ?>links/tools" class="pop-up">
		<div id="tile9" class="tile medium tools"  data-stops="0,25%,50%,75%,100%" data-speed="3000" data-delay="0" data-direction="horizontal" data-stack="true">
			<img class="live-img" src="<?php echo base_url(); ?>_assets/images/tiles/tile-tools.png" alt="Tools"/>
		</div>
	</a>
	<!--End Tools -->
	
	<!--Start Most Read today -->
	<div id="tile10" class="tile large blue trend exclude" data-stack="true">
		<div class="most-read">
			<div class="tile-text dark-blue most-read">MOST READ TODAY</div>
			<div id="trend_holder">
				<ul class="trending">			
				<?php if( $news ) { ?>
				 <?php foreach ( $news as $a ) { ?>
					 <li  class="article">
					  <span><?php echo date("m.d.Y", strtotime($a['publish_up'])); ?></span>
						<a href="javascript:void(0)" class="smoothScroll" onclick="trendShowContent(<?php echo $a['id']; ?>);"> 
							<?php echo character_limiter($a['title'],20); ?>
						 <?php if($a['subtitle'] != ""){ ?>
							<p>
								<i><?php echo character_limiter($a['subtitle'],20); ?></i>
							</p>
						 <?php } ?>
						</a>
					 </li>
				 <?php } ?>
				<?php } ?>
				</ul>
				<span class="tile-read-more">MORE</span>
			</div>
		</div>
	</div>
	<!--End Most Read today  -->
</div>

 <?php 

if( $news ) {
	$titles = ''; 
	$images = ''; 
	foreach ( $news as $n ) {
		//$titles .= "'<div class=ken_img onclick=kenburnShowContent(".$n['id'].");></div><a onclick=kenburnShowContent(".$n['id']."); href=javascript:void(0); class=smoothScroll >".character_limiter($n['title'],25)."</a>',"; 
		//-- add escape for single&double quote mark- 120613
		$article_title = addslashes($n['title']);
		$titles .= "'<div class=ken_img onclick=kenburnShowContent(".$n['id'].");></div><a onclick=kenburnShowContent(".$n['id']."); href=javascript:void(0); class=smoothScroll >".character_limiter($article_title,25)."</a>',"; 
		$images .= '"'.base_url().'_assets/images/articles/'.$n['images'].'",'; 
	}
}
?>
<script type="text/javascript" src="<?php echo base_url(); ?>_assets/js/kenburns.js"></script>
<script type="text/javascript">
	
	// INSERT TITLES HERE
	var titles = [
				  	<?php echo substr($titles,0,-1); ?>

				  ];

	// FLAG FOR INIT FUNCTION			  
	var isCalled = false;

	$(document).ready(function(){
		
		 // INSERT IMAGES HERE
	    $('#kenburns-slideshow').Kenburns({
	    	images: [
	    		<?php echo substr($images,0,-1); ?>

	    	],
	    	scale:0.75,
	    	duration:8000,
	    	fadeSpeed:20, //-- mark 120613 - change 1200 to 20
	    	ease3d:'cubic-bezier(0.445, 0.050, 0.550, 0.950)',

	    	onSlideComplete: function(){
	    		isCalled = false;
	    		restartAtts();
	    		$('#slide-title').html(titles[this.getSlideIndex()]);
	    	},
	    	onLoadingComplete: function(){
	    		//$('#status').html("Loading Complete");
	    		restartAtts();
	    	}

	    });
		

	    // ANIMATION INIT
	    function restartAtts(){
	    	if(!isCalled){
		    	$('#kenburns-description').fadeOut(500, initCallForTitle);
		    	$('#kenburns-description').css('bottom', '-40px');
		    	$('#slide-title').css({
		    		'left': '150px',
		    		'opacity': '0'
		    	});
		    	isCalled = true;
	    	}
	    }
	    // ANIMATION START
	    function initCallForTitle(){

	    	$('#kenburns-description').show().delay(300).animate({
	    		'bottom': '0px'
	    	}, 500, function(){
	    		$('#slide-title').delay(300).animate({
	    			'left': '20px',
	    			'opacity': '1'
	    		});
	    	});
	    }
		
		
		$("#list-view").click(function () {
			showNewsListView();
		});
		
		$("#product-list-view ,.prod-proms ").click(function () {
			showProductListView();
		});
		$(".videos").click(function () {
			showVideoListView();
		});
		
		$(".photos").click(function () {
			showPhotoListView()
		});
		
		$(".tile-read-more").click(function () {
			moreShowContent()
		});
		
		var n = 0;
		$(".slidingDiv, .photos, .ken_img, .videos, .prod-proms, #product-list-view, #list-view, .smoothScroll, #kenburns-slideshow, #fancybox-wrap, #fancybox-close, .most-read, body div#fancybox-overlay, body div#fancybox-tmp").mouseenter(function() {
			n = 0;

		}).mouseleave(function() {
			n = 1;
		});

		/*$("html").click(function(){ 
		if (n == 1) {
			//alert("clickoutside");
			closeMiddle();
		}
		});*/
		
		$("a.pop-up").fancybox({ 
			'autoScale'  : false,
			'scrolling'   : 'no',
			onComplete:  function(e){    
				 if(isChrome==false) {
          			 	$('html').getNiceScroll().remove();
						 $("html, body").css("overflow", "hidden");
				 }else{
					$("html, body").css("overflow", "hidden");
				 }
			},
			scrollOutside: false,
			helpers: {
				overlay: {
					locked: true,
					closeClick: false
				}
			},
			onClosed : function() {
				if(isChrome==false) {
           				 $('html').niceScroll();
						 $('html').attr('style', 'overflow: hidden !important;');
				 }else{
				 $("html, body").css("overflow", "auto");
				 }
			},
			'hideOnOverlayClick' : false,
		}).hover(function() {
			$("div#fancybox-overlay").click(function(e) {
				$("body").bind("click","null");
				e.stopPropagation();
				e.preventDefault();
			});
		});	
	});

</script>
