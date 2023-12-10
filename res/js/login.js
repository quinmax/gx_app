const login = 
{
	checkLogin()
	{
		spinner();

		// Get creds from form
		let credOne = document.getElementById("cred_1").value.trim();
		let credTwo = document.getElementById("cred_2").value.trim();
		let loginError = document.getElementById("login_error");

        let formData = { "cred_1": credOne, "cred_2": credTwo };

        let phpUrl = baseUrl + "login/do_login";
        
        sendData(phpUrl, formData)
        .then(result => 
        {
			// Start spinner
            spinner();
			
			const loginResponse = JSON.parse(result);
			
			if (loginResponse.status === "AUTH_FAILED:CREDENTIALS")
			{
				console.log('FAIL');
				
				loginError.style.display = "flex";
			}
			else 
			{
				const uid = loginResponse.data.uid;
				
				// Set uid cookie
				this.setCookie('uid', uid, 1);
				this.setCookie('entity_uid', "1", 1);
				
				// Goto diary list
				router.diary_list();
			}
        });
	},

	logout()
	{
		this.eraseCookie('uid');
		this.eraseCookie('entity_uid');
		this.eraseCookie('diary_uid');
		this.eraseCookie('diary_name');

		router.logout();
	},

	eraseCookie(name) 
	{   
		document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	},

	setCookie(name, value, days) 
	{
		var expires = "";
		if (days) 
		{
			var date = new Date();
			date.setTime(date.getTime() + (days*24*60*60*1000));
			expires = "; expires=" + date.toUTCString();
		}
	
		document.cookie = name + "=" + (value || "")  + expires + "; path=/";
	}
}
