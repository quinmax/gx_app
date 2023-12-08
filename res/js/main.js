const baseUrl = window.location.protocol + "//" + window.location.hostname + "/gx_app/";

function include(file) 
{ 
    var script  = document.createElement('script'); 
    script.src  = file; 
    script.type = 'text/javascript'; 
    script.defer = true; 
    
    document.getElementsByTagName('head').item(0).appendChild(script); 
}

include(baseUrl + "res/js/router.js");
include(baseUrl + "res/js/login.js");
include(baseUrl + "res/js/diary.js");
include(baseUrl + "res/js/booking.js");
include(baseUrl + "res/js/validate.js");
include(baseUrl + "res/js/home.js");

async function sendData(phpUrl, formData) 
{	
	let result = "error";
	try 
	{
		const response = await fetch(phpUrl, { method: "POST", body: JSON.stringify(formData), headers: {"Content-type": "text/plain; charset=UTF-8"} });

		if (response)
		{
			result = await response.text();
		}
	} 
	catch(error) 
	{
		console.log('Api error: ' + error);
	}
    
    return result;
}

function init()
{
	console.log('Init');
}

function spinner()
{
    let loader = document.getElementById("loader");
    let mode = loader.style.display;
    
    if (mode == "block")
    {
        loader.style.display ="none";
    }
    else 
    {
        loader.style.display ="block";
    }
}

function showFormOverlay()
{
    let viewOverlay = document.getElementById("form_overlay");

    viewOverlay.style.display = "flex";
}

function hideFormOverlay()
{
    let viewOverlay = document.getElementById("form_overlay");

    viewOverlay.style.display = "none";
    viewOverlay.innerHTML = '';
}

function showViewOverlay()
{
    let viewOverlay = document.getElementById("view_overlay");

    viewOverlay.style.display = "flex";
}

function hideViewOverlay()
{
    let viewOverlay = document.getElementById("view_overlay");

    viewOverlay.style.display = "none";
    viewOverlay.innerHTML = '';
}

function closeForm()
{
    hideFormOverlay();
}

function closeViewForm()
{
    hideViewOverlay();
}

init();
