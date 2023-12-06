const router = 
{
	diary_list()
	{
		window.location.assign(baseUrl + "diary/list_/");
	}, 

	booking_list()
    {
        window.location.assign(baseUrl + "booking/list_/");
    },

	booking_add()
    {
        window.location.assign(baseUrl + "booking/add/");
    },

	logout()
	{
		window.location.assign(baseUrl + "login");
	}
}
