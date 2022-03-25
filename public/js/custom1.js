jQuery(document).ready(function() {
	/*jQuery('#forget-password').click(function (){
		jQuery('#signin-form').hide();
		jQuery('#forget-form').show();
	});

	jQuery('#signin').click(function () {
		jQuery('#signin-form').show();
		jQuery('#forget-form').hide();
	})*/

	function count_request() {
		jQuery.ajax({
			type: "GET",
			url: '/count-friend-request',
			success: function(data){
				if(data > 0) {
					jQuery('#friend-request-count').show();
					jQuery('#friend-request-count span').text('('+data+')');
				}
			}
		});
	}

	//setInterval(count_request,2000);

	function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	jQuery('#sign_up_button').click(function(event) {
		event.preventDefault();
		console.log('asdas');
		var month = jQuery('#month').val();
		var day = jQuery('#day').val();
		var month = jQuery('#year').val();
		var email = jQuery('#email').val();
		var password = jQuery('#password').val();
		var agreemnt = jQuery('#agreemnt').val();

		var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+jQuery/;
		console.log('email',email);
		if(email == '') {
			console.log('sadsads');
			jQuery('#email_error strong').text('Please Enter Your Email');
		} else if (!validateEmail(email)) {
			console.log('sadsads asdsads');
			jQuery('#email_error strong').text('Please Enter Valid Email');
		} else {
			jQuery('#email_error strong').text('');
		}
		if(password == '') {
			jQuery('#pass_error strong').text('Please Enter Your Password');
		} else if(password.length < 5) {
			jQuery('#pass_error strong').text('Password Length Must Be Greater Than 6');
		} else {
			jQuery('#pass_error strong').text('');
		}
		if(month == '' || day == '' || year == '') {
			jQuery('#birth_error strong').text('Please Enter Your Birthdate');
		} else {
			jQuery('#birth_error strong').text('');
		}
		if(!jQuery('#agreemnt').is(":checked")) {
			jQuery('#agreemnt_error strong').text('Please Check Terms');
		} else {
			jQuery('#agreemnt_error strong').text('');
		}

		if(email != '' && password !='' && month != '' && day !='' && year != '' && jQuery('#agreemnt').is(":checked") && validateEmail(email)) {
			jQuery('#create-account-from').submit();
		}
	});

	jQuery('#search-button').click(function(event) {
		event.preventDefault();
		var sex = jQuery('#sex').val();
		var month = jQuery('#month').val();
		var day = jQuery('#day').val();
		var year = jQuery('#year').val();

		if(sex != '' && month != '' && day != '' && year !='') {
			jQuery('#home-search-form').submit();
		}
	});

	jQuery('#account-save').click(function(event) {
		event.preventDefault();
		var password = jQuery('#password').val();
		var confirm_password = jQuery('#confirm_password').val();
		var full_name = jQuery('#full_name').val();
		var pattern = /^[a-zA-Z0-9]/;
		if(full_name == '') {
			jQuery('#full_name_error strong').text('Please Enter Your Name');
		} else if(!full_name.match(pattern)) {
			jQuery('#full_name_error strong').text('Please Enter Alphanumeric characters');
		} else {
			jQuery('#full_name_error strong').text('');
		}
		if(password == '' && confirm_password == '' && full_name != '') {
			jQuery('#account-form').submit();
		} else {
			if(password != '' || confirm_password != '') {
				if(confirm_password != password){
					jQuery('#password_error strong').text('Password Does Not Match');
				} 
				if(password.length < 5) {
					jQuery('#password_error strong').text('Password Length Must Be Greater Than 6');
				}
			}

			if(password.length > 5 && full_name != '' && password == confirm_password) {
				jQuery('#account-form').submit();
			} 
		}
	});

	jQuery('#sign-in-btn').click(function(event) {
		event.preventDefault();
		var password = jQuery('#signin-form #login-password').val();
		var email = jQuery('#signin-form #login-email').val();
		var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+jQuery/;
		if(email == '') {
			jQuery('#signin-form #email_error').text('Please Enter Your Email');
		} else if (!validateEmail(email)) {
			jQuery('#signin-form #email_error').text('Please Enter Valid Email');
		} else {
			jQuery('#signin-form #email_error').text('');
		}
		if(password == '') {
			jQuery('#signin-form #pass_error').text('Please Enter Your Password');
		} else {
			jQuery('#signin-form #pass_error').text('');
		}

		if(email != '' && password !='') {
			jQuery('#signin-form').submit();
		}
	});	


	jQuery('#forget-pass-btn').click(function(event) {
		event.preventDefault();
		var email = jQuery('#forget-form #forget-email').val();
		var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+jQuery/;

		if(email == '') {
			jQuery('#forget-form #email_error').text('Please Enter Your Email');
		} else if (!validateEmail(email)) {
			jQuery('#forget-form #email_error').text('Please Enter Valid Email');
		} else {
			jQuery('#forget-form #email_error').text('');
			jQuery('#forget-form').submit();
		}
	});	

	jQuery('#admin-login-btn').click(function(event) {
		event.preventDefault();
		var email = jQuery('#admin-login-form #email').val();
		var password = jQuery('#admin-login-form #password').val();

		var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+jQuery/;

		if(email == '') {
			jQuery('#admin-login-form #email_error').text('Please Enter Your Email');
		} else if(!validateEmail(email)) {
			jQuery('#admin-login-form #email_error').text('Please Enter Valid Email');
		} else {
			jQuery('#admin-login-form #email_error').text('');
		}	

		if(password == '') {
			jQuery('#admin-login-form #pass_error').text('Please Enter Your Password');
		} else {
			jQuery('#admin-login-form #pass_error').text('');
		}

		if(email != '' && password != '' && validateEmail(email)) {
			jQuery('#admin-login-form').submit();
		}
	});

	jQuery('.inbox').click(function(event) {
		jQuery('tr.sent').hide();
		jQuery('tr.inbox').show();
		jQuery('.tab-menu li').removeClass('active');
		jQuery('.tab-menu .inbox').addClass('active');
	});

	jQuery('.sent').click(function(event) {
		jQuery('tr.inbox').hide();
		jQuery('tr.sent').show();
		jQuery('.tab-menu li').removeClass('active');
		jQuery('.tab-menu .sent').addClass('active');
	});

	jQuery("body").on('keyup','#search-box33',function(){
		if(jQuery(this).val() !='') {
			jQuery.ajax({
				type: "GET",
				url: "/getFriends/"+jQuery(this).val(),
				beforeSend: function(){
					jQuery("#search-box33").css("background","#FFF url({{ url('public/img/LoaderIcon.gif') }}) no-repeat 165px");
				},
				success: function(data){
					if(data) {
						jQuery("#suggesstion-box").show();
						jQuery("#suggesstion-box").html(data);
						jQuery("#search-box33").css("background","#FFF");
						if(jQuery('#suggesstion-box #search-cafe-result li').length <= 0) {
							jQuery("#suggesstion-box").hide();
						}
					}
				}
			});
		}
	});

	jQuery('body').on('click','#suggesstion-box #search-cafe-result li',function(event) {
		jQuery('#my_message #to').val(jQuery(this).data('id'));
		jQuery('#my_message #search-box33').val(jQuery(this).data('email'));
		jQuery("#suggesstion-box").html('');
	});

	jQuery('body').on('click','#send-message',function(e) {
		e.preventDefault();
		var sub = jQuery('#my_message #subject').val();
		var msg = jQuery('#my_message #msg').val();
		var to = jQuery('#my_message #search-box33').val();
		var to_input = jQuery('#my_message #to').val();
		if(to == '') {
			jQuery('#to_error').text('Please enter a valid email');
		} else {
			jQuery('#to_error').text('');
		}
		if(sub == '') {
			jQuery('#subject_error').text('Please enter a subject');
		} else {
			jQuery('#subject_error').text('');
		}
		if(msg == '') {
			jQuery('#msg_error').text('Please enter your message');
		}

		if(to != '' && to_input == '') {
			jQuery('#to_error').text('You can not send message to this user');
		} else {
			jQuery('#to_error').text('');
		}
		if(to != '' && sub != '' && msg !='' && to_input != '') {
			jQuery('#send-message-form').submit();
		}
	});

	jQuery('#chat-send-msg').click(function(event) {
		event.preventDefault();
		if(jQuery('#chat-msg').val() == '') {
			jQuery('#chat-msg-error').text("Please enter a message");
		} else {
			jQuery('#chat-conversation').submit();
		}
	});

	jQuery('#chat-page .sent').click(function(event) {
		localStorage.setItem('mailbox_page','sent');
	});

	var getPageName = localStorage.getItem('mailbox_page');
	if(getPageName != '' || getPageName != null || getPageName != undefined) {
		jQuery('#mailbox_page .sent').click();
		localStorage.removeItem('mailbox_page');

	}


	jQuery('#profile-page input[type="checkbox"]').click(function() {
		var name = jQuery(this).attr('name');
		jQuery('#'+name).val('');
		jQuery('input[name="'+name+'"]:checked').each(function() {
			let old_text = jQuery('#'+name).val() ? jQuery('#'+name).val() + ', ' : '';
			jQuery('#'+name).val(old_text + jQuery(this).val());
		})
	});

	jQuery("#profile-page #search-box").keyup(function(){
		jQuery.ajax({
			type: "GET",
			url: "/getCafes/"+jQuery(this).val(),
				//data: jQuery(this).val(),
				beforeSend: function(){
					jQuery("#search-box").css("background","#FFF url({{ url('public/img/LoaderIcon.gif') }}) no-repeat 165px");
				},
				success: function(data){
					jQuery("#suggesstion-box").show();
					jQuery("#suggesstion-box").html(data);
					jQuery("#search-box").css("background","#FFF");
				}
			});
	});

	jQuery('body').on('click','#profile-page #suggesstion-box li',function(event) {
		jQuery('#search-box').val(jQuery(this).data('location'));
		jQuery('#search-cafe').val(jQuery(this).data('zip-code'));
		jQuery('#suggesstion-box').remove();
	});

	jQuery('.btn-circle').on('click',function(){
		jQuery('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
		jQuery(this).addClass('btn-info').removeClass('btn-default').blur();
	});

	jQuery('.next-step, .prev-step').on('click', function (e){
		var id = jQuery(this).attr('href');
		jQuery('.process-step button').removeClass('btn-info').addClass('btn-default');
		jQuery('.process-step [href="'+id+'"]').addClass('btn-info').removeClass('btn-default');
		jQuery('.process-step [href="'+id+'"]').removeAttr('disabled');
		jQuery('.process-step [href="'+id+'"]').tab('show');		
	});

});


