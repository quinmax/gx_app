const diary = 
{
	selectDiary(id, diaryName)
	{
		this.setCookie('diary_uid', id, 1);
		this.setCookie('diary_name', diaryName, 1);

		router.booking_list();
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
