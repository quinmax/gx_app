const HOME =  
{
	testSpiner()
	{
		console.log('Home');
		spinner();
	},

	fetchApiData()
	{
		spinner();

		let apiUrl = "https://opentdb.com/api.php?amount=10&type=multiple";
		let formData = {  };
		
		sendData(apiUrl, formData)
		.then(result => 
		{ 
			this.showData(result);
		})
	},
	
	showData(result)
	{	
		spinner();

		// Do JSON parse

		console.log(result);
	}
}

