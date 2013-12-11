// zebra table effect
function zebraTable() { 
	$(".zebra tr:odd td").addClass("zebraodd");
	$(".zebra tr:even td").addClass("zebraeven");
	
	$(".zebra tr td").hover(function(){
		$(this).parent("tr").children("td").addClass('tr_backgroundhover'); 
	}, function(){
		$(this).parent("tr").children("td").removeClass('tr_backgroundhover'); 
	});
}
function tableHover() { 
	$("table#data-info tr.data-tr.odd td, table#data-info tr.data-tr.even td").hover(function(){
		$(this).parent("tr").children("td").addClass('tr_backgroundhover'); 
	}, function(){
		$(this).parent("tr").children("td").removeClass('tr_backgroundhover'); 
	});
}

function displayNotification(type, message)
{
	hideAllNotifications();
	switch(type) 
	{
		case "message":
			$("#message_wrapper").fadeIn(250);
			break;
		case "success":
			$("#success").html(message);
			$("#success_wrapper").fadeIn(250);
			$("._main").css("top", "37px");
			break;
		case "error":
			$("#error").html(message);
			$("#error_wrapper").fadeIn(250);
			$("._main").css("top", "37px");

			break;
		case "success_asset":
			$("#success_asset").html(message);
			$("#success_asset_wrapper").fadeIn(250);
			$("._main").css("top", "37px");

			break;
		case "message_asset":
			$("#message_asset").html(message);
			$("#message_asset_wrapper").fadeIn(250);
			$("._main").css("top", "37px");

			break;
		default:
			$("#message").html(message);
			$("#message_wrapper").fadeIn(250);
			$("._main").css("top", "37px");
	}
	return;
}

function hideAllNotifications()
{
	$(".notification").each(function(){
		$(this).hide();
	});
	$("._main").css("top", "0px");
	return;
}

function imgError(image, broken_image_url){
	image.onerror = "";
	image.src = broken_image_url;
	return true;
}

function shortenString(string, limit){
	if( string.length <= limit ){
		return string;
	}else{
		return string.substr(0, limit);
	}
}

function shortenStringWithEllipsis(string, limit){
	if( string.length <= limit ){
		return string;
	}else{
		return string.substr(0, limit) + '...';
	}
}

function isNumber(evt){
	evt =(evt)? evt : window.event;var charCode =(evt.which)? evt.which : evt.keyCode;if(charCode >31&&(charCode <48|| charCode >57)){return false;}return true;
}
