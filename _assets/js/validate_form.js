function validate_form(form_id)
{

	var proceed = true;
	var error_missing_fields = false;
	var error_email_format = false;
	var error_hex_format = false;
	var error_alpha_numeric = false;
	var error_duplicate = false;
	var error_data_match = false;
	var error_minlength = false;
	var error_matchpassword = false;
	var error_non_zero = false;
	var error_is_number = false;
	var message = "";
	var field_name = 'Some field';
	
	// check all input text & password
	$("#"+form_id+" input[type='text'], #"+form_id+" input[type='hidden'], #"+form_id+" input[type='password']").each(function(){
		$(this).css("border", "1px solid #CCCCCC");
		var this_value = $.trim($(this).val());
		
		if ($(this).attr('data-required') == 1) { 
			if (this_value == "") {
				error_missing_fields = true;
				if ($(this).attr('data-asset') == 1) {
					// when editing properties, put border on img_preview
					$(this).siblings(".img_preview").css("border", "1px solid #990000");
				} else {
					$(this).css("border", "1px solid #990000");
				}
			}
		}
		
		if ($(this).attr('data-non-zero') == 1) { 
			var tmp_data_name = $(this).attr('data-name');
			if (typeof tmp_data_name !== 'undefined' && tmp_data_name !== false) {
				field_name = tmp_data_name;
			}
			if ((this_value == '0' ) || (this_value == 0 )) {
				error_non_zero = true;
				$(this).css("border", "1px solid #990000");
			}
		}
		
		if ($(this).attr('data-is-number') == 1) { 
			var tmp_data_name = $(this).attr('data-name');
			if (typeof tmp_data_name !== 'undefined' && tmp_data_name !== false) {
				field_name = tmp_data_name;
			}
			if (!isUnsignedInteger(this_value)) {
				error_is_number = true;
				$(this).css("border", "1px solid #990000");
			}
		}
		
		if ($(this).attr('data-email') == 1) { 
			if (!isEmailValid(this_value) && (this_value != "")) {
				error_email_format = true;
				$(this).css("border", "1px solid #990000");
			}
		}
		
		if ($(this).attr('data-colorpicker') == 1) { 
			if (!isHexaColor(this_value) && (this_value != "")) {
				error_hex_format = true;
				$(this).css("border", "1px solid #990000");
			}
		}
		
		if ($(this).attr('data-alphanum') == 1) { 
			if((/[^a-zA-Z0-9 ]/.test(this_value)) && (this_value != "")) {
				error_alpha_numeric = true;
				$(this).css("border", "1px solid #990000");
			}
		}
		
		if (($(this).attr('data-unique') == 1) && 
			(!error_missing_fields) && 
			(this_value != $(this).attr('data-orig-val'))) { 
				var field = $(this).attr('data-field');
				var table = $(this).attr('data-table');
				var isUnique = checkUnique(field, this_value, table);
				
				if (isUnique == "duplicate") {
					error_duplicate = true;
					$(this).css("border", "1px solid #990000");
				}
		}
		
		if ($(this).attr('data-match')) { 
			if (this_value != $("#"+$(this).attr('data-match')).val()) {
				error_data_match = true;
				$(this).css("border", "1px solid #990000");
				$("#"+$(this).attr('data-match')).css("border", "1px solid #990000");
			}
		}
		
		if ($(this).attr('data-minlength')) { 
			if (this_value.length < $(this).attr('data-minlength')) {
				error_minlength = true;
				$(this).css("border", "1px solid #990000");
			}
		}	
		
		if ($(this).attr('data-match-password')) {
			var user_id = $(this).attr('data-user-id');
			var input_password = this_value;
			var isMatch = checkCurrentPassword(user_id, input_password);
			if (isMatch == "mismatch") {
				// mismatch = true;
				error_matchpassword = true;
				$(this).css("border", "1px solid #990000");
			}
		}
	});
	
	// check all selects
	$("#"+form_id+" select").each(function(){
		$(this).css("border", "1px solid #CCCCCC");
	
		var this_value = $(this).val();
		if ($(this).attr('data-required') == 1) { 
			if (this_value == "0") {
				error_missing_fields = true;
				$(this).css("border", "1px solid #990000");
			}
		}
	});
	
	// set error message
	if (error_missing_fields) { message = message + "Missing fields required. "; } 
	if (error_email_format) { message = message + "Email format is not valid. "; } 
	if (error_hex_format) { message = message + "Hex color format is not valid. "; } 
	if (error_alpha_numeric) { message = message + "Invalid characters detected. "; } 
	if (error_duplicate) { message = message + "Existing records for unique fields detected. "; } 
	if (error_data_match) { message = message + "Data did not match. "; } 
	if (error_minlength) { message = message + "Failed to reach minimum length of some fields. "; } 
	if (error_matchpassword) { message = message + "Current password is not correct. "; } 
	if (error_non_zero) { message = message + field_name + " shouldn't have '0' as a value. "; } 
	if (error_is_number) { message = message + field_name + " should be a number. "; } 
	
	// display error messages
	if (error_missing_fields || error_email_format || error_hex_format || error_alpha_numeric || error_duplicate || error_data_match || error_minlength || error_matchpassword || error_non_zero || error_is_number) { 
		proceed = false;
		if (form_id == "form_login") {
			$("#login_message").html(message);
		} else if (form_id == "form_register") {
			$("#register_message").html(message);
		} else {
			displayNotification("error", message); 
		}			
	}
	
	return proceed;
}

function isEmailValid(email) 
{ 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

function isHexaColor(string)
{
	var isValid = true;
	if (string[0] != "#") { isValid = false; }
	if (string.length < 7) { isValid = false; }
	
	string = string.slice(1, 6);
	if (isNaN(parseInt(string, 16))) { isValid = false; } 
	return isValid;
}

function isUnsignedInteger(s) {
  return (s.toString().search(/^[0-9]+$/) == 0);
}

function checkUnique(field, value, table)
{
	var status = "";
	$.ajax({
		url: config.base+"ajax/check_unique",
		async: false,
		type: "POST",
		data: "field="+field+"&value="+value+"&table="+table,
		success: function(response, textStatus, jqXHR){
			if (response == "unique") { status = "unique"; }
			if (response == "duplicate") { status = "duplicate"; }
		},
		error: function(jqXHR, textStatus, errorThrown){
			displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
		}
	});
	return status;
}

function checkCurrentPassword(user_id, input_password) 
{
	var status = "";
	$.ajax({
		url: config.base+"ajax/check_password",
		async: false,
		type: "POST",
		data: "user_id="+user_id+"&input_password="+input_password,
		success: function(response, textStatus, jqXHR){
			if (response == "match") { status = "match"; }
			if (response == "mismatch") { status = "mismatch"; }
		},
		error: function(jqXHR, textStatus, errorThrown){
			displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
		}
	});
	return status;
}