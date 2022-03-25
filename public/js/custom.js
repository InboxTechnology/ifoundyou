jQuery(document).ready(function() {
	/*jQuery('#forget-password').click(function (){
		jQuery('#signin-form').hide();
		jQuery('#forget-form').show();
	});

	jQuery('#signin').click(function () {
		jQuery('#signin-form').show();
		jQuery('#forget-form').hide();
	})*/

	jQuery('.return_url_btn').on('click',function(e){
		localStorage.setItem('return_url',jQuery(this).attr('returnurl'));
	})

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
		var month = jQuery('#month').val();
		var day = jQuery('#day').val();
		var month = jQuery('#year').val();
		var firstname = jQuery('#name').val();
		var email = jQuery('#email').val();
		var password = jQuery('#password').val();
		var agreemnt = jQuery('#agreemnt').val();
		var continent = jQuery('#registercountries').val();
		var cities = jQuery('#cities').val();
		var locations = jQuery('#locations').val();
		var states = jQuery('#states').val();
		var country = jQuery('#europecountries').val();
		var zip_code = jQuery('#zip_code').val();
		var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+jQuery/;
		
		if( firstname == '' ) {
			jQuery('#name_error strong').text('Please Enter Your First name');
		} else {
			jQuery('#name_error strong').text('');
		}

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
		if(continent == '') {
			jQuery('#continent_error strong').text('Please Select Country');
		}
		else {
			jQuery('#continent_error strong').text('');
		}
		if(continent == 'Europe'){
			if(country == '') 
			{
				jQuery('#country_error strong').text('Please Select Another Country');
				return false;
			}
			else 
			{
				jQuery('#country_error strong').text('');
				if(cities == '')
				{
					jQuery('#city_error strong').text('Please Select City');
					return false;
				}
				else
				{
					jQuery('#city_error strong').text('');
					if(locations == '')
					{
						jQuery('#location_error strong').text('Please Choose Cafe Location');
						return false;
					}
					else
					{
						jQuery('#location_error strong').text('');
					}
				}
			}
		}




		if(continent == 'England' || continent == 'Canada')
		{
			if(cities == '') 
			{
				jQuery('#city_error strong').text('Please Select City');
				return false;
			}
			else 
			{
				jQuery('#city_error strong').text('');
				if(locations == '')
				{
					jQuery('#location_error strong').text('Please Choose Cafe Location');
					return false;
				}
				else
				{
					jQuery('#location_error strong').text('');
					
				}
			}
		}


		if(continent == 'USA')
		{
			if( zip_code == '' ) {
				jQuery('#zip_code_error strong').text('Please Enter Zipcode');
			}
			else {
				jQuery('#zip_code_error strong').text('');

				if( jQuery('#locations option').length > 1 && locations == '' )
				{
					jQuery('#location_error strong').text('Please Choose Cafe Location');
					return false;
				}
				else
				{
					jQuery('#location_error strong').text('');
				}
			}

			if(states == '')
			{
				jQuery('#state_error strong').text('Please Select State');
				return false;
			}
			else
			{
				jQuery('#state_error strong').text('');
				if(cities == '')
				{
					jQuery('#city_error strong').text('Please Select City');
					return false;
				}
				else
				{
					jQuery('#city_error strong').text('');
					/*if(locations == '')
					{
						jQuery('#location_error strong').text('Please Choose Cafe Location');
						return false;
					}
					else
					{
						jQuery('#location_error strong').text('');
					}*/
				}
			}
		}





		if(!jQuery('#agreemnt').is(":checked")) {
			jQuery('#agreemnt_error strong').text('Please Check Terms');
		} else {
			jQuery('#agreemnt_error strong').text('');
		}

		if(continent != '' && email != '' && password !='' && month != '' && day !='' && year != '' && jQuery('#agreemnt').is(":checked") && validateEmail(email)) {
			jQuery('#create-account-from').submit();
		}
	});

	jQuery('#search-button').click(function(e) {
		e.preventDefault();
		jQuery('#error').hide();
		var first_name = jQuery('#fname').val();
		console.log(first_name);
		// var last_name = jQuery('#lname').val();
		// var continent = jQuery('#registercountries').val();
		// var location = jQuery('#location').val();
		// if(first_name == '') {
		// 	//jQuery('#fname').after("<div id='error'> This field is empty! </div>")
		// 	console.log("first name is empty");
		// }else{
		// 	jQuery('#error').hide();
		// }
		// if (last_name == '') {
		// 	//jQuery('#lname').after("<div id='error'> This field is empty! </div>")
		// 	console.log("last name is empty");
		// }else{
		// 	jQuery('#error').hide();
		// }
		// if (continent == '') {
		// 	//jQuery('#registercountries').after("<div id='error'> This field is empty! </div>")
		// 	console.log("continet name is empty");
		// }else{
		// 	jQuery('#error').hide();
		// }
		// if (location == '') {
		// 	//jQuery('#location').after("<div id='error'> This field is empty! </div>")
		// 	console.log("location name is empty");
		// }else{
		// 	jQuery('#error').hide();
		// }
		if (first_name != '') {
			jQuery('#error').hide();
			jQuery('#home-search-form').submit();			
		}else{
			// jQuery('#fname').after("<div id='error'> This field is empty! </div>")
		}
	});


	jQuery('#account-save').click(function(event) {
		event.preventDefault();
		// var password = jQuery('#password').val();
		// var confirm_password = jQuery('#confirm_password').val();
		var full_name = jQuery('#full_name').val();
		var continent = $('#registeredcountries').val();
		var cityname = $('#cityname').val();
		var locations = $('#locations').val();
		var europecountries = $('#europecountries').val();
		var usastates = $('#usastates').val();
		var pattern = /^[a-zA-Z0-9]/;

			if(full_name == '') {
				jQuery('#full_name_error strong').text('Please Enter Your Name');
			} else if(!full_name.match(pattern)) {
				jQuery('#full_name_error strong').text('Please Enter Alphanumeric characters');
			} else {
				jQuery('#full_name_error strong').text('');
			}
			if(continent == 'England' || continent == 'Canada')
			{
				if(cityname == '')
				{
					jQuery('#cityname_error strong').text('Please Select City');
				}
				else
				{
					jQuery('#cityname_error strong').text('');
					if(locations == '')
					{
						jQuery('#locations_error strong').text('Please Select Cafe Location');
					}
					else
					{
						jQuery('#locations_error strong').text('');
					}
				}
			}
			if(continent == 'USA')
			{
				if(usastates == '')
				{
					jQuery('#usastates_error strong').text('Please Select State');
					return false;
				}
				else
				{	
					jQuery('#usastates_error strong').text('');
					if(cityname == '')
					{
						jQuery('#cityname_error strong').text('Please Select City');
						return false;
					}
					else
					{
						jQuery('#cityname_error strong').text('');
						if(locations == '')
						{
							jQuery('#locations_error strong').text('Please Select Cafe Location');
						}
						else
						{
							jQuery('#locations_error strong').text('');
						}
					}
				}
			}
			if(continent == 'Europe')
			{
				if(europecountries == '')
				{	
					jQuery('#europe_error strong').text('Please Select Country');
					return false;
				}
				else
				{
					jQuery('#europe_error strong').text('');
					if(cityname == '')
					{
						jQuery('#cityname_error strong').text('Please Select City');
					}
					else
					{
						jQuery('#cityname_error strong').text('');
						if(locations == '')
						{
							jQuery('#locations_error strong').text('Please Select Cafe Location');
						}
						else
						{
							jQuery('#locations_error strong').text('');
						}
					}
				}
			}

			if( full_name != '' && continent !='' && cityname !='' && locations != '')
			{
				jQuery('#account-form').submit();
			}
			/*else
			{
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
			}*/
		
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

	// var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	// (function(){
	// 	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	// 	s1.async=true;
	// 	s1.src='https://embed.tawk.to/5bec300470ff5a5a3a72283d/default';
	// 	s1.charset='UTF-8';
	// 	s1.setAttribute('crossorigin','*');
	// 	s0.parentNode.insertBefore(s1,s0);
	// 	})();


	// var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	// (function(){
	// 	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	// 	s1.async=true;
	// 	s1.src='https://embed.tawk.to/5bec300470ff5a5a3a72283d/default';
	// 	s1.charset='UTF-8';
	// 	s1.setAttribute('crossorigin','*');
	// 	s0.parentNode.insertBefore(s1,s0);
	// })();



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

	$("#submit_contact").click(function(){
  		var email=$("#email").val();
  		var subject=$("#subject").val();
  		var message=$("#message").val();
  		var atpos = email.indexOf("@");
  		var dotpos = email.lastIndexOf(".");
          
  		if(email=="" || subject=="" || message=="" || (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length))
  		{
    		if(email=="")
    		{
      			$("#error_email").html("Email is required");
    		}
    		else
    		{
      			if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
      			{
        			$("#error_email").html("Not a valid e-mail address");
      			}
      			else
     			{
        			$("#error_email").html("");
      			}
    		}
    		if(subject=="")
    		{
      			$("#error_subject").html("Subject is required");
    		}
    		else
    		{
    			$("#error_subject").html("");
    		}
    		if(message=="")
    		{
     			$("#error_message").html("Message is required");
    		}
    		else
    		{
      			$("#error_message").html("");
    		}
    		return false;
  		}
  		else
  		{
    		return true;
  		}         
   });

	jQuery(document).on('change','#image',function(){
		var property1 = document.getElementById("image").files[0];
        var image_name = property1.name;
        var image_extension = image_name.split(".").pop().toLowerCase();
        if(jQuery.inArray(image_extension, ['gif','png','jpg','jpeg']) == -1)
        {
            alert("Invalid Image File");
            return false;
        }  
        var image_size = property1.size;	
        if(image_size > 5000000)
        {
            alert("Please select file less than 5MB");
            return false;
        }
        else
        {
            var file_data = $('#image').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
            	headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
            	url:'/user/change-user-image',
                type:"POST",
                cache: false,
                contentType: false,
                processData: false,
                data :form_data,
                beforeSend:function(){
                    $(".loader").show();
                },
                success:function(data){
                    $(".loader").hide();
                    $('.uploaded_image').attr('src','/public/img/'+data);
                    $('#image_success').html('Photo uploaded successfully.');
                }
			});
     	}

	});
	jQuery('#match-btn').on('click',function(){
		localStorage.setItem('match-menu','match-menu');
	})



	
	// var initESW = function(gslbBaseURL) {
	// embedded_svc.settings.displayHelpButton = true; //Or false
	// embedded_svc.settings.language = ''; //For example, enter 'en' or 'en-US'

	// //embedded_svc.settings.defaultMinimizedText = '...'; //(Defaults to Chat with an Expert)
	// //embedded_svc.settings.disabledMinimizedText = '...'; //(Defaults to Agent Offline)

	// //embedded_svc.settings.loadingText = ''; //(Defaults to Loading)
	// //embedded_svc.settings.storageDomain = 'yourdomain.com'; //(Sets the domain for your deployment so that visitors can navigate subdomains during a chat session)

	// // Settings for Chat
	// //embedded_svc.settings.directToButtonRouting = function(prechatFormData) {
	// // Dynamically changes the button ID based on what the visitor enters in the pre-chat form.
	// // Returns a valid button ID.
	// //};
	// //embedded_svc.settings.prepopulatedPrechatFields = {}; //Sets the auto-population of pre-chat form fields
	// //embedded_svc.settings.fallbackRouting = []; //An array of button IDs, user IDs, or userId_buttonId
	// //embedded_svc.settings.offlineSupportMinimizedText = '...'; //(Defaults to Contact Us)

	// embedded_svc.settings.enabledFeatures = ['LiveAgent'];
	// embedded_svc.settings.entryFeature = 'LiveAgent';

	// embedded_svc.init(
	// 'https://na174.salesforce.com',
	// 'https://ifoundyou.force.com/liveAgentSetupFlow',
	// gslbBaseURL,
	// '00D6g000003QrbH',
	// 'Chat_Team',
	// {
	// baseLiveAgentContentURL: 'https://c.la1-c2-ia5.salesforceliveagent.com/content',
	// deploymentId: '5726g000000DOI8',
	// buttonId: '5736g000000DOiI',
	// baseLiveAgentURL: 'https://d.la1-c2-ia5.salesforceliveagent.com/chat',
	// eswLiveAgentDevName: 'Chat_Team',
	// isOfflineSupportEnabled: true,
	// }
	// );
	// };

	// if (!window.embedded_svc) {
	// 	var s = document.createElement('script');
	// 	// s.async=true;
	// 	// s.setAttribute('crossorigin','*');
	// 	// s.append('Access-Control-Allow-Headers: x-requested-with ' );
	// 	s.setAttribute('src', 'https://na174.salesforce.com/embeddedservice/5.0/esw.min.js');

	// 	s.onload = function() {
	// 	initESW(null);
	// 	};
	// 	document.body.appendChild(s);
	// } else {
	// 	initESW('https://service.force.com');
	// }


	jQuery('#sign_up_button2').click(function(event) {
		event.preventDefault();
		var month = jQuery('#month').val();
		var day = jQuery('#day').val();
		var month = jQuery('#year').val();
		var firstname = jQuery('#name').val();
		var email = jQuery('#email').val();
		var password = jQuery('#password').val();
		// var agreemnt = jQuery('#agreemnt').val();
		// var continent = jQuery('#registercountries').val();
		// var cities = jQuery('#cities').val();
		// var locations = jQuery('#locations').val();
		// var states = jQuery('#states').val();
		// var country = jQuery('#europecountries').val();
		// var zip_code = jQuery('#zip_code').val();
		var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+jQuery/;
		
		if( firstname == '' ) {
			jQuery('#name_error strong').text('Please Enter Your First name');
		} else {
			jQuery('#name_error strong').text('');
		}

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
		// if(continent == '') {
		// 	jQuery('#continent_error strong').text('Please Select Country');
		// }
		// else {
		// 	jQuery('#continent_error strong').text('');
		// }
		// if(continent == 'Europe'){
		// 	if(country == '') 
		// 	{
		// 		jQuery('#country_error strong').text('Please Select Another Country');
		// 		return false;
		// 	}
		// 	else 
		// 	{
		// 		jQuery('#country_error strong').text('');
		// 		if(cities == '')
		// 		{
		// 			jQuery('#city_error strong').text('Please Select City');
		// 			return false;
		// 		}
		// 		else
		// 		{
		// 			jQuery('#city_error strong').text('');
		// 			if(locations == '')
		// 			{
		// 				jQuery('#location_error strong').text('Please Choose Cafe Location');
		// 				return false;
		// 			}
		// 			else
		// 			{
		// 				jQuery('#location_error strong').text('');
		// 			}
		// 		}
		// 	}
		// }




		// if(continent == 'England' || continent == 'Canada')
		// {
		// 	if(cities == '') 
		// 	{
		// 		jQuery('#city_error strong').text('Please Select City');
		// 		return false;
		// 	}
		// 	else 
		// 	{
		// 		jQuery('#city_error strong').text('');
		// 		if(locations == '')
		// 		{
		// 			jQuery('#location_error strong').text('Please Choose Cafe Location');
		// 			return false;
		// 		}
		// 		else
		// 		{
		// 			jQuery('#location_error strong').text('');
					
		// 		}
		// 	}
		// }


		// if(continent == 'USA')
		// {
		// 	if( zip_code == '' ) {
		// 		jQuery('#zip_code_error strong').text('Please Enter Zipcode');
		// 	}
		// 	else {
		// 		jQuery('#zip_code_error strong').text('');

		// 		if( jQuery('#locations option').length > 1 && locations == '' )
		// 		{
		// 			jQuery('#location_error strong').text('Please Choose Cafe Location');
		// 			return false;
		// 		}
		// 		else
		// 		{
		// 			jQuery('#location_error strong').text('');
		// 		}
		// 	}

		// 	if(states == '')
		// 	{
		// 		jQuery('#state_error strong').text('Please Select State');
		// 		return false;
		// 	}
		// 	else
		// 	{
		// 		jQuery('#state_error strong').text('');
		// 		if(cities == '')
		// 		{
		// 			jQuery('#city_error strong').text('Please Select City');
		// 			return false;
		// 		}
		// 		else
		// 		{
		// 			jQuery('#city_error strong').text('');
		// 			/*if(locations == '')
		// 			{
		// 				jQuery('#location_error strong').text('Please Choose Cafe Location');
		// 				return false;
		// 			}
		// 			else
		// 			{
		// 				jQuery('#location_error strong').text('');
		// 			}*/
		// 		}
		// 	}
		// }





		// if(!jQuery('#agreemnt').is(":checked")) {
		// 	jQuery('#agreemnt_error strong').text('Please Check Terms');
		// } else {
		// 	jQuery('#agreemnt_error strong').text('');
		// }

		if(email != '' && password !=''  ) {
			jQuery('#create-account-from2').submit();
		}
	});
});







