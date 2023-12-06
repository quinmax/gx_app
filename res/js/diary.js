const diary = 
{
	selectDiary(id)
	{
		console.log('Diary Id: ' + id);

		this.setCookie('diary_uid', id, 1);

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
