const login = 
{
	checkLogin()
	{
		spinner();

		let credOne = document.getElementById("cred_1").value.trim();
		let credTwo = document.getElementById("cred_2").value.trim();

        let formData = { "cred_1": credOne, "cred_2": credTwo };

        let phpUrl = baseUrl + "login/do_login";
        
        sendData(phpUrl, formData)
        .then(result => 
        {
            spinner();

			const loginResponse = JSON.parse(result);
			
			if (loginResponse.status === "AUTH_FAILED:CREDENTIALS")
			{
				console.log('FAIL');
			}
			else 
			{
				const uid = loginResponse.data.uid;
				
				this.setCookie('uid', uid, 1);
				this.setCookie('entity_uid', "1", 1);
				
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
