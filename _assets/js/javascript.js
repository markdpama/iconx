var news_isopen = false;
var prod_prom_isopen = false;
var videos_isopen = false;
var photos_isopen = false;
var trend_isopen = false;
var openContent = 0;
var isChrome = navigator.userAgent.match(/Chrome\/\d+/) !== null; 
var bodyWidth = getWidth();
var mobile = device();
var timeoutID;

function loading(){
	//$('#dvLoading').show();
	//$("#middle-content").append("<div id='dvLoading'></div>");
	$('<div class="myloader" ><img style="width:100%" src="_assets/images/myloader.gif" alt="Loading..." /></div>').appendTo("#middle-content");
	$('<div class="myloader" ><img style="width:100%" src="_assets/images/myloader.gif" alt="Loading..." /></div>').appendTo("#full-content");
	$('#dvLoading').fadeOut(100);
	//alert('Loading...');
}
function loading_complete(){
	//$('#dvLoading').fadeOut(100);
	//e.preventDefault();
	$('.myloader').remove();
	$('.myloader').fadeOut(100);
	//alert('Loading...');
}

function loadCssFile(filename) {
	var fileref=document.createElement('link');
	fileref.setAttribute('rel', 'stylesheet');
	fileref.setAttribute('type', 'text/css');
	fileref.setAttribute('href', filename);
	document.getElementsByTagName("head")[0].appendChild(fileref);
}

function loadJsFile(filename) {
    var js = document.createElement("script");
	//alert(filename);
    js.type = "text/javascript";
    js.src = filename;

    document.body.appendChild(js);
}

function closeMiddle() {
	//alert('Close');
	$("#latest").html("");
	$("#full-content").html("");
	$("#middle-content").html("");
	$(".slidingDiv").slideUp(700, function() {
		news_isopen = false;
		prod_prom_isopen = false;
		videos_isopen = false;
		photos_isopen = false;
		trend_isopen = false;
	});
}

function delayedClose() {
  timeoutID = window.setTimeout(closeFullContent, 100);
}

function closeFullContent() {
	//alert(listView);
	$(".arrow-news-white").css("display", "none");
	$(".arrow-products-white").css("display", "none");
	$(".arrow-trend-white").css("display", "none");
	//$("#full-content").fadeOut(1000, function() {
		
	$("#full-content").html("");
	
	//});
	$("#middle-content").css("visibility", "visible");
	$(".close-middle").addClass("close-pos");
	$(".close-content").css("visibility", "hidden");
	$("#full-content").removeClass("show");
	$("#full-content").addClass("hide");
	$("#middle-content").removeClass("hide");
	$("#middle-content").addClass("show");
	$(".close-middle").css("display", "block");
	 window.clearTimeout(timeoutID);
}

function showNewsListView(){
	if( news_isopen == false ){
		
		if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
			$("html, body").animate({
			scrollTop: $("#tile6").offset().top
			}, 700);
		}else{
			$("html, body").css("overflow", "hidden");
		}
		$("#full-content").css("visibility", "hidden");
		$("#middle-content").css("visibility", "visible");
		$("#middle-content").addClass("show blue_bg margin-top_12px");
		$("#middle-content").removeClass("hide margin-bottom_12px");
		$(".slidingDiv").removeClass("blue_bg");
		$(".arrow-news").css("display", "block");
		$(".close-middle").css("display", "block");
		$(".close-content").removeClass("close-pos-up");	
		$(".close-content").addClass("close-pos");
		$(".close-middle").removeClass("close-pos-up");
		$(".close-middle").addClass("close-pos");
		$(".arrow-products").css("display", "none");
		$(".arrow-photos").css("display", "none");
		$(".arrow-products-white").css("display", "none");
		$(".arrow-news-white").css("display", "none");
		$(".arrow-videos").css("display", "none");
		$(".arrow-trend-white").css("display", "none");
		$(".arrow-trend").css("display", "none");
		$("#full-content").removeClass("show");
		$("#full-content").addClass("hide");
		$(".slidingDiv").slideDown(700, function() {
			$("#latest").html("");
			$("#full-content").html("");
			$("#middle-content").html("");
			loading(); 
			$.ajax({
				 url : 'articles/news',
				 dataType: "html",
				 success: function(result){
				  $("#middle-content").fadeIn(100, function() {
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
					  loading_complete();
				  });
				 }
			});
			news_isopen = true;
			prod_prom_isopen = false;
			videos_isopen = false;
			photos_isopen = false;
			trend_isopen = false;
		});  
		
	} else {
		$("#latest").html("");
		$("#full-content").html("");
		$("#middle-content").html("");
		$(".slidingDiv").slideUp(700, function() {
			news_isopen = false;
			prod_prom_isopen = false;
			videos_isopen = false;
			photos_isopen = false;
			trend_isopen = false;
			$(".arrow-news").css("display", "none");
			$(".arrow-products").css("display", "none");
			$(".arrow-photos").css("display", "none");
			$(".arrow-videos").css("display", "none");
			$(".arrow-trend-white").css("display", "none");
			$(".arrow-trend").css("display", "none");
		});
	}
}
function showKaGlobeNews(){
		
		if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
			$("html, body").animate({
			scrollTop: $("#tile6").offset().top
			}, 700);
		}else{
			$("html, body").css("overflow", "hidden");
		}
		$("#full-content").css("visibility", "hidden");
		$("#middle-content").css("visibility", "visible");
		$("#middle-content").addClass("show blue_bg margin-top_12px");
		$("#middle-content").removeClass("hide margin-bottom_12px");
		$(".slidingDiv").removeClass("blue_bg");
		$(".arrow-news").css("display", "block");
		$(".close-middle").css("display", "block");
		$(".close-content").removeClass("close-pos-up");	
		$(".close-content").addClass("close-pos");
		$(".close-middle").removeClass("close-pos-up");
		$(".close-middle").addClass("close-pos");
		$(".arrow-products").css("display", "none");
		$(".arrow-photos").css("display", "none");
		$(".arrow-products-white").css("display", "none");
		$(".arrow-news-white").css("display", "none");
		$(".arrow-videos").css("display", "none");
		$(".arrow-trend-white").css("display", "none");
		$(".arrow-trend").css("display", "none");
		$("#full-content").removeClass("show");
		$("#full-content").addClass("hide");
		$(".slidingDiv").slideDown(700, function() {
			$("#latest").html("");
			$("#full-content").html("");
			$("#middle-content").html("");
			loading(); 
			$.ajax({
				 url : 'articles/news',
				 dataType: "html",
				 success: function(result){
				  $("#middle-content").fadeIn(100, function() {
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
					  loading_complete();
					  openContent = 0;
				  });
				 }
			});

		});  
		
}
function showIndustryNews(){
		
		if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
			$("html, body").animate({
			scrollTop: $("#tile6").offset().top
			}, 700);
		}else{
			$("html, body").css("overflow", "hidden");
		}
		$("#full-content").css("visibility", "hidden");
		$("#middle-content").css("visibility", "visible");
		$("#middle-content").addClass("show blue_bg margin-top_12px");
		$("#middle-content").removeClass("hide margin-bottom_12px");
		$(".slidingDiv").removeClass("blue_bg");
		$(".arrow-news").css("display", "block");
		$(".close-middle").css("display", "block");
		$(".close-content").removeClass("close-pos-up");	
		$(".close-content").addClass("close-pos");
		$(".close-middle").removeClass("close-pos-up");
		$(".close-middle").addClass("close-pos");
		$(".arrow-products").css("display", "none");
		$(".arrow-photos").css("display", "none");
		$(".arrow-products-white").css("display", "none");
		$(".arrow-news-white").css("display", "none");
		$(".arrow-videos").css("display", "none");
		$(".arrow-trend-white").css("display", "none");
		$(".arrow-trend").css("display", "none");
		$("#full-content").removeClass("show");
		$("#full-content").addClass("hide");
		$(".slidingDiv").slideDown(700, function() {
			$("#latest").html("");
			$("#full-content").html("");
			$("#middle-content").html("");
			loading(); 
			$.ajax({
				 url : 'articles/industry_news',
				 dataType: "html",
				 success: function(result){
				  $("#middle-content").fadeIn(100, function() {
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
					  loading_complete();
				  });
				 }
			});

		});  
		
}
function showiContributeNews(){
		
		if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
			$("html, body").animate({
			scrollTop: $("#tile6").offset().top
			}, 700);
		}else{
			$("html, body").css("overflow", "hidden");
		}
		$("#full-content").css("visibility", "hidden");
		$("#middle-content").css("visibility", "visible");
		$("#middle-content").addClass("show blue_bg margin-top_12px");
		$("#middle-content").removeClass("hide margin-bottom_12px");
		$(".slidingDiv").removeClass("blue_bg");
		$(".arrow-news").css("display", "block");
		$(".close-middle").css("display", "block");
		$(".close-content").removeClass("close-pos-up");	
		$(".close-content").addClass("close-pos");
		$(".close-middle").removeClass("close-pos-up");
		$(".close-middle").addClass("close-pos");
		$(".arrow-products").css("display", "none");
		$(".arrow-photos").css("display", "none");
		$(".arrow-products-white").css("display", "none");
		$(".arrow-news-white").css("display", "none");
		$(".arrow-videos").css("display", "none");
		$(".arrow-trend-white").css("display", "none");
		$(".arrow-trend").css("display", "none");
		$("#full-content").removeClass("show");
		$("#full-content").addClass("hide");
		$(".slidingDiv").slideDown(700, function() {
			$("#latest").html("");
			$("#full-content").html("");
			$("#middle-content").html("");
			loading(); 
			$.ajax({
				 url : 'articles/icontribute_news',
				 dataType: "html",
				 success: function(result){
				  $("#middle-content").fadeIn(100, function() {
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
					  loading_complete();
				  });
				 }
			});

		});  
		
}
function showProductListView(){
	if( prod_prom_isopen == false ){				   
		
		if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
			$("html, body").animate({
			scrollTop: $("#tile6").offset().top
			}, 700);
		}else{
			$("html, body").css("overflow", "hidden");
		}
		$("#full-content").css("visibility", "hidden");
		$("#middle-content").css("visibility", "visible");
		$("#middle-content").addClass("blue_bg margin-top_12px");
		$("#middle-content").removeClass("show margin-bottom_12px");
		$("#middle-content").removeClass("hide");
		$(".slidingDiv").removeClass("blue_bg");
		$(".close-middle").css("display", "block");
		$(".close-middle").removeClass("close-pos-up");
		$(".close-middle").addClass("close-pos");
		$(".close-content").removeClass("close-pos-up");
		$(".close-content").addClass("close-pos");
		$(".arrow-products").css("display", "block");
		$(".arrow-news").css("display", "none");
	    $(".arrow-photos").css("display", "none");
	    $(".arrow-videos").css("display", "none");
	    $(".arrow-products-white").css("display", "none");
	    $(".arrow-news-white").css("display", "none");
	    $(".arrow-trend-white").css("display", "none");
	    $(".arrow-trend").css("display", "none");
		$("#full-content").removeClass("show");
		$("#full-content").addClass("hide");
		$(".slidingDiv").slideDown(700, function() {
			$("#latest").html("");
			$("#full-content").html("");
			$("#middle-content").html("");
			loading(); 
			$.ajax({
				 url : 'articles/product_and_promos',
				 dataType: "html",
				 success: function(result){
				  $("#middle-content").fadeIn(100, function() {
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
					  loading_complete();
				  });
				 }
			});
			prod_prom_isopen = true;
		    news_isopen = false;
		    videos_isopen = false;
		    photos_isopen = false;
		    trend_isopen = false;
		});  
	} else {
		$("#latest").html("");
		$("#full-content").html("");
		$("#middle-content").html("");
	   $(".slidingDiv").slideUp(700, function() {
		   prod_prom_isopen = false;
		   news_isopen = false;
		   videos_isopen = false;
		   photos_isopen = false;
		   trend_isopen = false;
		   $(".arrow-news").css("display", "none");
		   $(".arrow-products").css("display", "none");
		   $(".arrow-photos").css("display", "none");
		   $(".arrow-videos").css("display", "none");
		   $(".arrow-trend-white").css("display", "none");
		   $(".arrow-trend").css("display", "none");
		});
	}
}

function showVideoListView(){
	if( videos_isopen == false ){
		
		if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
			$("html, body").animate({
			scrollTop: $("#flip-view-news").offset().top
			}, 700);
		}else{
			$("html, body").css("overflow", "hidden");
		}
		$("#middle-content").css("visibility", "visible");
		$("#middle-content").addClass("show blue_bg margin-bottom_12px");
		$("#middle-content").removeClass("margin-top_12px hide arrow-top-margin");
		$(".slidingDiv").removeClass("blue_bg");
		$(".arrow-videos").css("display", "block");
		$(".close-middle").css("display", "block");
		$(".close-middle").css("display", "block");
		$(".close-middle").removeClass("close-pos");
		$(".close-middle").addClass("close-pos-up");
		$(".close-content").addClass("close-pos-up");
		$(".close-content").removeClass("close-pos");
		$(".arrow-news").css("display", "none");
		$(".arrow-products").css("display", "none");
		$(".arrow-photos").css("display", "none");
		$(".arrow-products-white").css("display", "none");
		$(".arrow-news-white").css("display", "none");
		$(".arrow-trend-white").css("display", "none");
		$(".arrow-trend").css("display", "none");
		$("#full-content").removeClass("show margin-top_12px");
		$("#full-content").addClass("hide");
		$(".slidingDiv").slideDown(700, function() {
			$("#latest").html("");
			$("#full-content").html("");
			$("#middle-content").html("");
			loading(); 
			$.ajax({
				 url : 'videos/',
				 dataType: "html",
				 success: function(result){
				  $("#middle-content").fadeIn(100, function() {
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
					  loading_complete();
				  });
				 }
			});
			videos_isopen = true;
			news_isopen = false;
			prod_prom_isopen = false;
			photos_isopen = false;
			trend_isopen = false;
		}); 
	
	}else{
		$("#latest").html("");
		$("#full-content").html("");
		$("#middle-content").html("");
		$(".slidingDiv").slideUp(700, function() {
			videos_isopen = false;
			news_isopen = false;
			prod_prom_isopen = false;
			photos_isopen = false;
			trend_isopen = false;
			$(".arrow-news").css("display", "none");
			$(".arrow-products").css("display", "none");
			$(".arrow-photos").css("display", "none");
			$(".arrow-videos").css("display", "none");
			$(".arrow-trend-white").css("display", "none");
			$(".arrow-trend").css("display", "none");
		});
	}
}

function showPhotoListView(){
	if( photos_isopen == false ){
		
		if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
			$("html, body").animate({
			scrollTop: $("#flip-view-news").offset().top
			}, 700);
		}else{
			$("html, body").css("overflow", "hidden");
		}
		$("#middle-content").css("visibility", "visible");
		$("#middle-content").addClass("show blue_bg margin-bottom_12px");
		$("#middle-content").removeClass("margin-top_12px hide arrow-top-margin");
		$(".slidingDiv").removeClass("blue_bg");
		$(".arrow-videos").css("display", "none");
		$(".arrow-news").css("display", "none");
		$(".arrow-products").css("display", "none");
		$(".arrow-photos").css("display", "block");
		$(".close-middle").css("display", "block");
		$(".close-middle").removeClass("close-pos");
		$(".close-middle").addClass("close-pos-up");
		$(".close-content").addClass("close-pos-up");
		$(".close-content").removeClass("close-pos");
		$(".arrow-products-white").css("display", "none");
		$(".arrow-news-white").css("display", "none");
		$(".arrow-trend-white").css("display", "none");
		$(".arrow-trend").css("display", "none");
		$("#full-content").removeClass("show");
		$("#full-content").addClass("hide");
		$(".slidingDiv").slideDown(700, function() {
			$("#latest").html("");
			$("#full-content").html("");
			$("#full-content").css("visibility", "hidden");
			$("#full-content").removeClass("hide margin-top_12px");
			$("#middle-content").html("");
			loading(); 
			$.ajax({
				 url : 'photos/albumlist',
				 dataType: "html",
				 success: function(result){
				  $("#middle-content").fadeIn(100, function() {
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
					  loading_complete();
				  });
				 }
			});
			videos_isopen = false;
			news_isopen = false;
			prod_prom_isopen = false;
			photos_isopen = true;
			trend_isopen = false;
		});
	}else{
		$("#latest").html("");
		$("#full-content").html("");
		$("#middle-content").html("");
		$(".slidingDiv").slideUp(700, function() {
			// Animation complete.
			videos_isopen = false;
			news_isopen = false;
			prod_prom_isopen = false;
			photos_isopen = false;
			trend_isopen = false;
			$(".arrow-news").css("display", "none");
			$(".arrow-products").css("display", "none");
			$(".arrow-photos").css("display", "none");
			$(".arrow-videos").css("display", "none");
			$(".arrow-trend-white").css("display", "none");
			$(".arrow-trend").css("display", "none");
		});
	}
}
function kenburnShowContent(dataId){
	
	//alert(bodyWidth);
	if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
		$("html, body").animate({
		scrollTop: $("#tile6").offset().top
		}, 700);
	}else{
			$("html, body").css("overflow", "hidden");
		}
	$(".slidingDiv").removeClass("blue_bg");
	//$(".slidingDiv").addClass("blue_bg");
	$("#full-content").addClass("full-content show white_bg margin-top_12px");
	$("#middle-content").removeClass("margin-bottom_12px");
	$("#full-content").removeClass("hide");
	$(".full-content").css("display", "block");
    //$("#middle-content").removeClass("show");
    //$("#middle-content").addClass("hide");
	$(".close-content").removeClass("close-pos-up");	
    $(".close-content").addClass("close-pos");
	$(".close-middle").removeClass("close-pos-up");
	$(".close-middle").addClass("close-pos");
	$("#full-content").css("visibility", "visible");
	$("#middle-content").css("visibility", "hidden");
	$("#middle-content").addClass( "arrow-top-margin" );
	$(".arrow-news-white").css("display", "block");
	$(".arrow-news").css("display", "block");
	$(".close-content").css("display", "block");
	$(".close-content").css("visibility", "visible");
	$(".arrow-products").css("display", "none");
	$(".arrow-products-white").css("display", "none");
	$(".arrow-photos").css("display", "none");
	$(".arrow-up-white").css("display", "none");
	$(".arrow-videos").css("display", "none");
	$(".arrow-trend-white").css("display", "none");
	$(".arrow-trend").css("display", "none");
	//alert(openContent);
	if(openContent == 0 || openContent != dataId){
		
		$(".slidingDiv").slideDown(500, function() {
				$("#middle-content").html("");
				$("#full-content").html("");
				loading();
				$.ajax({
					url : 'articles/get_article/'+dataId,
					dataType: "html",
					success: function(result){
					$("#full-content").removeClass("hide");
					$("#full-content").addClass("show");
					$(".full-content").fadeIn(300, function() {
						$("#full-content").removeClass("white_bg");
						$(".full-content").html(result);
						loading_complete();
						
						$.ajax({
							 url : 'articles/news',
							 dataType: "html",
							 success: function(result){
							 // $("#middle-content").fadeIn(100, function() {
								  $("#middle-content").html(result);
								  $(".slidingDiv").removeClass("blue_bg");
							 // });
							 }
						});
						news_isopen = false;
						prod_prom_isopen = false;
						videos_isopen = false;
						photos_isopen = false;
						trend_isopen = false;
						openContent = 0;

					 });

					}
				});  

		});
		
		
	}
}

function trendShowContent(dataId){
	//alert(dataId);
	
	if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
		$("html, body").animate({
		scrollTop: $("#list-view").offset().top
		}, 700);
	}else{
			$("html, body").css("overflow", "hidden");
		}
	$(".slidingDiv").removeClass("blue_bg");
	$("#full-content").addClass("full-content show white_bg margin-bottom_12px");
	$("#middle-content").removeClass("margin-top_12px");
	$("#full-content").removeClass("hide margin-top_12px");
    //$("#middle-content").removeClass("show");
    //$("#middle-content").addClass("hide");
	$("#full-content").css("visibility", "visible");
	$("#middle-content").css("visibility", "hidden");
	$("#middle-content").removeClass( "arrow-top-margin" );
	$(".arrow-news-white").css("display", "none");
	$(".close-content").css("display", "block");
	$(".close-middle").removeClass("close-pos");
	$(".close-middle").addClass("close-pos-up");
	$(".close-content").css("visibility", "visible");
	$(".close-content").removeClass("close-pos");
	$(".close-content").addClass("close-pos-up");
	$(".arrow-products").css("display", "none");
	$(".arrow-products-white").css("display", "none");
	$(".arrow-photos").css("display", "none");
	$(".arrow-up-white").css("display", "none");
	$(".arrow-videos").css("display", "none");
	$(".arrow-trend-white").css("display", "block");
	$(".arrow-trend-white").css("visibility", "visible");
	$(".arrow-trend").css("display", "block");
	if(openContent == 0 || openContent != dataId){
		
		$(".slidingDiv").slideDown(500, function() {
			$("#middle-content").html("");
			$('#full-content').height(519);
			$("#full-content").html("");
			loading();
			$.ajax({
				url : 'articles/get_article/'+dataId,
				dataType: "html",
				success: function(result){
				 $("#full-content").removeClass("hide");
				 $("#full-content").addClass("show");
				 $(".full-content").fadeIn(10, function() {
					$("#full-content").removeClass("white_bg");
					$(".full-content").html(result);
					loading_complete();
				 });

				 
				}
			});  
			$.ajax({
				 url : 'articles/news',
				 dataType: "html",
				 success: function(result){
					  $("#middle-content").html("");
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
				 }
			});
			trend_isopen = false;
			news_isopen = false;
			prod_prom_isopen = false;
			videos_isopen = false;
			photos_isopen = false;
		});
	}
}

function moreShowContent(){

	if((mobile==false) ||((mobile==true) && (bodyWidth >= 865)) ){
		$("html, body").animate({
		scrollTop: $("#list-view").offset().top
		}, 700);
	}else{
			$("html, body").css("overflow", "hidden");
		}
	$("#middle-content").html("");
	$(".slidingDiv").removeClass("blue_bg");
	$("#middle-content").addClass("blue_bg");
	//$("#full-content").addClass("full-content show white_bg margin-bottom_12px");
	$("#middle-content").removeClass("margin-top_12px");
	//$("#full-content").removeClass("hide margin-top_12px");
    $("#middle-content").removeClass("hide");
    $("#middle-content").addClass("show");
	$("#full-content").css("visibility", "hidden");
	$("#middle-content").css("visibility", "hidden");
	$("#middle-content").removeClass( "arrow-top-margin" );
	$(".arrow-news-white").css("display", "none");
	$(".close-middle").css("display", "block");
	$(".close-content").css("display", "none");
	$(".close-middle").removeClass("close-pos");
	$(".close-middle").addClass("close-pos-up");
	$(".close-content").css("visibility", "visible");
	$(".close-content").removeClass("close-pos");
	$(".close-content").addClass("close-pos-up");
	$(".arrow-products").css("display", "none");
	$(".arrow-products-white").css("display", "none");
	$(".arrow-photos").css("display", "none");
	$(".arrow-up-white").css("display", "none");
	$(".arrow-videos").css("display", "none");
	$(".arrow-trend-white").css("visibility", "hidden");
	$(".arrow-trend").css("display", "block");
	//if(openContent == 0 || openContent != dataId){
		
		$(".slidingDiv").slideDown(500, function() {
			
			
			/*$.ajax({
				url : 'articles/get_article/'+dataId,
				dataType: "html",
				success: function(result){
				$("#full-content").html("");
				loading();
			
				 $(".full-content").fadeIn(10, function() {
					$("#full-content").removeClass("white_bg");
					$(".full-content").html(result);
					loading_complete();
				 });

				 
				}
			}); */
				 $("#full-content").addClass("hide");
				 $("#full-content").removeClass("show");
			$.ajax({
				 url : 'articles/news',
				 dataType: "html",
				 success: function(result){
					  $("#middle-content").html("");
					  $("#middle-content").html(result);
					  $(".slidingDiv").removeClass("blue_bg");
				 }
			});
			trend_isopen = true;
			news_isopen = false;
			prod_prom_isopen = false;
			videos_isopen = false;
			photos_isopen = false;
		});
	//}
}

function showContent(articleID){
	/* //alert(articleID);
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("full-content").innerHTML = xmlhttp.responseText;
		}
	  }
	xmlhttp.open("POST", "articles/get_article/" + articleID ,true);
	xmlhttp.send();
	
	*/
	loading();
	$('#full-content').load('articles/get_article/' + articleID, function() {
	 loading_complete();	
	});
	return true;
}


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
	

$(document).ready(function(){
	
	var mobile = device();
	//alert(mobile);
	if(mobile==true){
		$("*").removeClass("marque");
	}
	
	/*$(window).keyup(function(e){
      if(e.keyCode == 44){
       // $("body").hide();
	   setInterval("window.clipboardData.clearData()",20);
	   alert('Screenshot Prohibited!');
      }

    }); */

	//Create a function for tiles
	function matrix_tiles_init() {
		/* //Allow effects when hovering on tiles
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
		});*/

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
	
	}//end matrix_tiles_init();
	
	matrix_tiles_init(); //run the function when page is ready
	
});
	

