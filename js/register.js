var Index = function () {};

//Bind all events
Index.prototype = function() {
	
	//Send User Data to Register
	var RegisterUser = function() {
     
		var name = $("#name").val().trim();
		var email = $("#email").val().trim();
		var phone_no = $("#phone-no").val().trim();
	 
		if(empty(name))
		{
			$("#name").focus();return false;
		}
		else if(empty(email))
		{
			$("#email").focus();return false;
		}
		else if(!MainApp.ValidateEmailfunction(email))
		{
			$("#email").focus();return false;
		}
		else if(empty(phone_no))
		{
			$("#phone-no").focus();
			return false;
		}	
		else if(isNaN(phone_no))
		{
			$("#phone-no").focus();
			return false;
		}	
		else
		{
			var postdata = "name="+name;
				postdata+= "&email="+email;
				postdata+= "&phone_no="+phone_no;
			
			
			$.ajax({
					type: "POST",	 
					url: Host.host_path+"RegisterUser",   
					data:postdata,	
					error:AjaxErrorMessage,				 
					success: function (response)
					{
						try
						{
							response = eval('(' +  response + ')');
							if(response.resp_code=='0')
							{
								
							}
							else if(response.resp_code=='-1')
							{
								alert(response.data);
								return false;
							}
						}
						catch(err)
						{
							txt= err.message;
							alert(txt+" An error occured. Please reload the page..!");
						}
					}	
				});
			
		}
		
		
    };
	
	//SignIn user
	var DoSignInUser = function() {
		
		var username = $("#login-username").val().trim();
		var password = $("#login-password").val().trim();
		
	 
		if(empty(username))
		{
			$("#login-username").focus();return false;
		}
		else if(empty(password))
		{
			$("#login-password").focus();return false;
		}
		else
		{
			var postdata = "username="+username;
				postdata+= "&password="+btoa(password);
			
			
			$.ajax({
					type: "POST",	 
					url: Host.host_path+"DoSignInUser",   
					data:postdata,	
					error:AjaxErrorMessage,				 
					success: function (response)
					{
						try
						{
							response = eval('(' +  response + ')');
							if(response.resp_code=='0')
							{
								
							}
							else if(response.resp_code=='-1')
							{
								alert(response.data);
								return false;
							}
						}
						catch(err)
						{
							txt= err.message;
							alert(txt+" An error occured. Please reload the page..!");
						}
					}	
				});
			
		}
		
		
    };
	
	
	var DoPasswordReset = function() {
		
		var username = $("#fp-username").val().trim();
		
	 
		if(empty(username))
		{
			$("#fp-username").focus();return false;
		}
		else if(!MainApp.ValidateEmailfunction(username))
		{
			$("#fp-username").focus();return false;
		}
		else
		{
			var postdata = "username="+username;
			
			$.ajax({
					type: "POST",	 
					url: Host.host_path+"DoPasswordReset",   
					data:postdata,	
					error:AjaxErrorMessage,				 
					success: function (response)
					{
						try
						{
							response = eval('(' +  response + ')');
							if(response.resp_code=='0')
							{
								alert(response.data);
							}
							else if(response.resp_code=='-1')
							{
								alert(response.data);
								return false;
							}
						}
						catch(err)
						{
							txt= err.message;
							alert(txt+" An error occured. Please reload the page..!");
						}
					}	
				});
			
		}
		
		
    };

	return {
		// constructor:Index,
		Init : function (){
			
			//bind Register event
			$("#btn-signup").on('click', function(event){
				event.preventdefault();
				RegisterUser();
			});
			
			//bind Signin event
			$("#btn-login").on('click', function(event){
				event.preventdefault();
				DoSignInUser();
			});
			
			//bind Forgot Password event
			$("#btn-fp").on('click', function(event){
				event.preventdefault();
				DoPasswordReset();
			});
		}
	}
  
 
}();

