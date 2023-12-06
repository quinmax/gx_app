const validate = 
{
	bookingDate(errCtr)
	{
		let fieldItem = document.getElementById("booking_date");
		let fieldGroup = document.getElementById("fg_date");
		let fieldError = document.getElementById("err_date");

		if (fieldItem.value.trim().length == 0)
		{
			fieldGroup.style.backgroundColor = "#FFEBEE";
			fieldGroup.style.border = "1px solid #EF9A9A";
			fieldGroup.style.borderRadius = "8px";
			fieldGroup.style.padding = "10px";

			fieldError.style.display = "flex";

			errCtr++;
		}
		else 
		{
			fieldGroup.style = "";
			fieldError.style.display = "none";
		}

		return errCtr;
	}, 

	startTime(errCtr)
	{
		let fgStartTime = document.getElementById("fg_start_time");
		let errStartTime = document.getElementById("err_start_time");
		const fieldItems = [ "ts_1", "ts_2", "ts_3", "ts_4", "ts_5", "ts_6", "ts_7", "ts_8", "ts_9", "ts_10" ];
		let bgCtr = 0;

		for (let i = 0; i < 10; i++)
		{
			let btn = document.getElementById(fieldItems[i]);
			
			if (btn.style.backgroundColor === "white")
			{
				bgCtr++;
			}
		}

        if (bgCtr == 8)
        {
            errCtr++;

			fgStartTime.style.backgroundColor = "#FFEBEE";
			fgStartTime.style.border = "1px solid #EF9A9A";
			fgStartTime.style.borderRadius = "8px";
			fgStartTime.style.padding = "10px";

			errStartTime.style.display = "flex";
        } 
		else 
		{
			fgStartTime.style = "";
			errStartTime.style.display = "none";
		}

		return errCtr;
	},

	duration(errCtr)
	{
		let fgDuration = document.getElementById("fg_duration");
		let errDuration = document.getElementById("err_duration");
		const fieldItems = [ "dr_1", "dr_2", "dr_3", "dr_4" ];
		let bgCtr = 0;

		for (let i = 0; i < 4; i++)
		{
			let btn = document.getElementById(fieldItems[i]);
			
			if (btn.style.backgroundColor === "white")
			{
				bgCtr++;
			}
		}

        if (bgCtr == 4)
        {
            errCtr++;

			fgDuration.style.backgroundColor = "#FFEBEE";
			fgDuration.style.border = "1px solid #EF9A9A";
			fgDuration.style.borderRadius = "8px";
			fgDuration.style.padding = "10px";

			errDuration.style.display = "flex";
        } 
		else 
		{
			fgDuration.style = "";
			errDuration.style.display = "none";
		}

		return errCtr;
	},

	type(errCtr)
	{
		let fgType = document.getElementById("fg_type");
		let errType = document.getElementById("err_type");
		const fieldItems = [ "bt_1", "bt_2", "bt_3", "bt_4" ];
		let bgCtr = 0;

		for (let i = 0; i < 4; i++)
		{
			let btn = document.getElementById(fieldItems[i]);
			
			if (btn.style.backgroundColor === "white")
			{
				bgCtr++;
			}
		}

        if (bgCtr == 4)
        {
            errCtr++;

			fgType.style.backgroundColor = "#FFEBEE";
			fgType.style.border = "1px solid #EF9A9A";
			fgType.style.borderRadius = "8px";
			fgType.style.padding = "10px";

			errType.style.display = "flex";
        } 
		else 
		{
			fgType.style = "";
			errType.style.display = "none";
		}

		return errCtr;
	},

	patient(errCtr)
	{
		let patient = document.getElementById("patient");
		let fgPatient = document.getElementById("fg_patient");
		let errPatient = document.getElementById("err_patient");

		if (patient.value == 0)
        {
            errCtr++;

			fgPatient.style.backgroundColor = "#FFEBEE";
			fgPatient.style.border = "1px solid #EF9A9A";
			fgPatient.style.borderRadius = "8px";
			fgPatient.style.padding = "10px";

			errPatient.style.display = "flex";
        } 
		else 
		{
			fgPatient.style = "";
			errPatient.style.display = "none";
		}
		
		return errCtr;
	},

	reason(errCtr)
	{
		let reason = document.getElementById("reason");
		let fgReason = document.getElementById("fg_reason");
		let errReason = document.getElementById("err_reason");

		if (reason.value.trim() == "")
        {
            errCtr++;

			fgReason.style.backgroundColor = "#FFEBEE";
			fgReason.style.border = "1px solid #EF9A9A";
			fgReason.style.borderRadius = "8px";
			fgReason.style.padding = "10px";

			errReason.style.display = "flex";
        } 
		else 
		{
			fgReason.style = "";
			errReason.style.display = "none";
		}
		
		return errCtr;
	},
}
