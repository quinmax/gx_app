const booking = 
{
	setFilter()
	{
		// Get booking date from document
		let bookingFilterDate = document.getElementById("booking_filter_date").value;

		// Set async data
		let formData = { "booking_filter_date": bookingFilterDate };
        let phpUrl = baseUrl + "booking/set_filter";

		// Start spinner
		spinner();

		// Do async
        sendData(phpUrl, formData)
        .then(result => 
		{ 
			if (result == "OK")
			{
				// Display booking list
				router.booking_list();
			} 
			else
			{
				console.log('No records found');
			}
		});
	},

	getView: function(bookingUid)
    {
		// Set async data
        let formData = { "booking_uid": bookingUid };
        let phpUrl = baseUrl + "booking/view";

		//Start spinner
		spinner();
		
		// Do async
        sendData(phpUrl, formData)
        .then(result => 
		{ 
			// Stop spinner
			spinner();
			
			// Display the view
			this.setBookingView(result, 0); 
		});
    },

	setBookingView: function(ajaxData)
    {
		// Show hidden div
        showFormOverlay();
        
		// Set and inject returned view data
        let formOverlay = document.getElementById("form_overlay");
        formOverlay.innerHTML = "";
        formOverlay.innerHTML = ajaxData;

		// Handle keyboard events
        document.onkeydown=function(evt)
		{
            var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
            if(keyCode == 27)
            {
				// Hide div
                closeForm();
            }
            if(keyCode == 13)
            {
				// Hide div
				closeForm();
            }
        }
    },

	getViewDebtorGeneral: function()
    {
		// Set async data
        let formData = { };
        let phpUrl = baseUrl + "booking/view_debtor_general";
        
		// Do async and display the view
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewDebtorPatients: function()
    {
		// Set async data
        let formData = { };
        let phpUrl = baseUrl + "booking/view_debtor_patients";
        
		// Do async and display the view
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewDebtorDoctorHistory: function()
    {
		// Set async data
        let formData = { };
        let phpUrl = baseUrl + "booking/view_debtor_doctor_history";
        
		// Do async and display the view
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewPatientHistory: function()
    {
		// Set async data
        let formData = { };
        let phpUrl = baseUrl + "booking/view_debtor_patient_history";
        
		// Do async and display the view
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewPatientGeneral: function()
    {
		// Set async data
        let formData = { };
        let phpUrl = baseUrl + "booking/view_patient_general";
        
		// Do async and display the view
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	setViewInfo: function(ajaxData,)
    {
		// Show hidden div
        showViewOverlay();
        
		// Set and inject returned view data
        let viewOverlay = document.getElementById("view_overlay");
        viewOverlay.innerHTML = "";
        viewOverlay.innerHTML = ajaxData;

		// Handle keyboard events
        document.onkeydown=function(evt)
		{
            var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
            if(keyCode == 27)
            {
                closeViewForm();
            }
            if(keyCode == 13)
            {
				closeViewForm();
            }
        }
    },

	getAdd: function()
    {
		// Set async data
        let formData = { };
        let phpUrl = baseUrl + "booking/add";

		// Start spinner
		spinner();
        
		// Do async and display the view
        sendData(phpUrl, formData)
        .then(result => 
		{ 
			// Stop spinner
			spinner();

			// Display the view
			this.setForm(result, 1); 
		});
    },

	getEdit: function(bookingUid)
    {
		// Set async data
        let formData = { "booking_uid": bookingUid };
        let phpUrl = baseUrl + "booking/edit";

		// Start spinner
		spinner();
        
		// Do async and display the view
        sendData(phpUrl, formData)
        .then(result => 
		{ 
			// Stop spinner
			spinner();
			
			// Display the view
			this.setForm(result, 2); 
		});
    },

	setForm: function(ajaxData, mode)
    {
		// Show hidden div
        showFormOverlay();
        
		// Set and inject returned view data
        let formOverlay = document.getElementById("form_overlay");
        formOverlay.innerHTML = "";
        formOverlay.innerHTML = ajaxData;

		// Initialise date picker
		let startPicker = new Litepicker({ 
            element: document.getElementById('booking_date')
        });

		// Handle keyboard events 
        document.onkeydown=function(evt)
		{
            var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
            if(keyCode == 27)
            {
				// Hide div
                closeForm();
            }
            if(keyCode == 13)
            {
				switch (mode)
				{
					case 0:
						// Hide div
						closeForm();
					break;
					case 1:
						// Enter key was pressed on add form
						booking.save();
					break;
					case 2:
						// Enter key was pressed on edit form
						booking.update();
					break;
				}
            }
        }

		// Reset form if it is an add form
		if (mode == 1)
		{
			this.clearTimeSlots();
			this.clearDuration();
			this.clearType();
		}
    },

	setReason()
	{
		// Used to set the reason from the item selected in the dropdown. If please select is choosen the reason is cleared

		let reason = document.getElementById("reason");
		let reason_select = document.getElementById("reason_select");

		// Get text of reason dropdown
		let selected = reason_select.options[reason_select.selectedIndex].text;
		
		if (selected != 'Please select...')
		{
			reason.value = selected;
		} 
		else 
		{
			reason.value = '';
		}
	},

	addValidate()
	{
		// Validation for the add form

		let errCtr = 0;

		errCtr = validate.bookingDate(errCtr);
		errCtr = validate.startTime(errCtr);
		errCtr = validate.duration(errCtr);
		errCtr = validate.type(errCtr);
		errCtr = validate.patient(errCtr);
		errCtr = validate.reason(errCtr);

		if (errCtr == 0)
		{
			this.save();
		}
	},

	save()
	{
		const entityUid = this.getCookie("entity_uid");
		const diaryUid = this.getCookie("diary_uid");
		// Type
		const bookingTypeUid = document.getElementById("set_type").value;
		// Status
		const bookingStatusUid = 1;
		// Start time
		const getBookingDate = document.getElementById("booking_date").value;
		const getBookingTime = document.getElementById("set_time").value;
		const start_time = getBookingDate + "T" + getBookingTime;
		// Duration
		const duration = document.getElementById("set_duration").value;
		// Patient uid
		let selectedPatient = patient.value;
		let bits = selectedPatient.split("@@");
		const patientUid = bits[1];
		// Reason
		const reason = document.getElementById("reason").value;
		// Cancelled
		const cancelled = false;

		// Set async data
		let phpUrl = baseUrl + "booking/save_booking";
		let formData = { 'entity_uid': entityUid, "diary_uid": diaryUid, "booking_type_uid": bookingTypeUid, "booking_status_uid": bookingStatusUid, "start_time": start_time, "duration": duration, "patient_uid": patientUid, "reason": reason, "cancelled": cancelled };
		
		// Start spinner
		spinner();

		// Do async
		sendData(phpUrl, formData)
		.then(result => 
		{ 
			// Stop spinner
			spinner();
			
			response = JSON.parse(result);
			
			if (response.status == "OK")
			{
				// Hide div
				closeForm();
				// Return to booking list
				router.booking_list();
			} 
			else 
			{
				console.log('There was an error');
			}
		});
	},

	editValidate()
	{
		// Validation for the edit form

		let errCtr = 0;

		errCtr = validate.bookingDate(errCtr);
		errCtr = validate.patient(errCtr);
		errCtr = validate.reason(errCtr);

		if (errCtr == 0)
		{
			this.update();
		}
	},

	update()
	{
		// Get booking id of record being updated
		const bookingUid = document.getElementById("booking_uid").value;

		// Start time
		const getBookingDate = document.getElementById("booking_date").value;
		const getBookingTime = document.getElementById("set_time").value;
		const start_time = getBookingDate + "T" + getBookingTime;

		// Duration

		const duration = document.getElementById("set_duration").value;

		// Patient uid
		let selectedPatient = patient.value;
		let bits = selectedPatient.split("@@");
		const patientUid = bits[1];

		// Reason
		const reason = document.getElementById("reason").value;

		// Set async data
		let phpUrl = baseUrl + "booking/update_booking";
		let formData = { 'booking_uid': bookingUid, "start_time": start_time, "duration": duration, "patient_uid": patientUid, "reason": reason, "cancelled": false };
			
		// Start spinner
		spinner();

		// Do async
		sendData(phpUrl, formData)
		.then(result => 
		{ 
			// Stop spinner
			spinner();
			
			response = JSON.parse(result);
			
			if (response.status == "OK")
			{
				// Hide div
				closeForm();
				// return to bookling list
				router.booking_list();
			} 
			else 
			{
				console.log('There was an error');
			}
		});
	},

	deleteBooking(bookingUid)
	{
		// 3rd Party library to show popup/alert messages
		DayPilot.Modal.confirm("Are you sure you want to delete this booking ?", { theme: "modal_flat" })
        .then(function(args) 
        {
            if (args.result) 
            {
				// Start spinner
                spinner();

				// Set async data
                let formData = { "booking_uid": bookingUid };
                let phpUrl = baseUrl + "booking/delete_booking";
    
				// Do async
				sendData(phpUrl, formData)
				.then(result => 
				{
					// Stop spinner 
					spinner();

					response = JSON.parse(result);

					if (response.status == "OK")
					{
						// return to booking list
						router.booking_list();
					} 
					else 
					{
						console.log('There was an error');
					}
				});
            }
            else 
            {
                console.log("User clicked cancel");
            }
        });
	},

	getCookie(name) 
	{
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
	
		for(var i=0;i < ca.length;i++) 
		{
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}

		return null;
	},

	selectTimeSlot(id)
	{
		// Function is to select 1 time button at a time
		
		// Set all to off first
		this.clearTimeSlots();

		let setTime = document.getElementById("set_time");
		let timeSlot = document.getElementById("ts_" + id);

		timeSlot.style.backgroundColor = "var(--app-secondary)";
		timeSlot.style.color = "white";

		switch (id)
		{
			case 1:
				setTime.value = "08:00:00";
			break;
			case 2:
				setTime.value = "09:00:00";
			break;
			case 3:
				setTime.value = "10:00:00";
			break;
			case 4:
				setTime.value = "11:00:00";
			break;
			case 5:
				setTime.value = "12:00:00";
			break;
			case 6:
				setTime.value = "13:00:00";
			break;
			case 7:
				setTime.value = "14:00:00";
			break;
			case 8:
				setTime.value = "15:00:00";
			break;
			case 9:
				setTime.value = "16:00:00";
			break;
			case 10:
				setTime.value = "17:00:00";
			break;
		}
		
	},

	clearTimeSlots()
	{
		// Function is to set all time buttons off

		const timeSlots = [ "ts_1", "ts_2", "ts_3", "ts_4", "ts_5", "ts_6", "ts_7", "ts_8", "ts_9", "ts_10" ];

		timeSlots.forEach((tsName) => 
		{
			let x = document.getElementById(tsName);
			
			x.style.backgroundColor = "white";
			x.style.color = "black";
		});
	},

	selectDuration(id)
	{
		// Function is to select 1 duration button at a time

		// Set all to off first
		this.clearDuration();

		let setDuration = document.getElementById("set_duration");
		let timeSlot = document.getElementById("dr_" + id);

		timeSlot.style.backgroundColor = "var(--app-secondary)";
		timeSlot.style.color = "white";

		switch (id)
		{
			case 1:
				setDuration.value = "15";
			break;
			case 2:
				setDuration.value = "30";
			break;
			case 3:
				setDuration.value = "45";
			break;
			case 4:
				setDuration.value = "60";
			break;
		}
		
	},

	clearDuration()
	{
		// Function is to set all duration buttons off

		const timeSlots = [ "dr_1", "dr_2", "dr_3", "dr_4" ];

		timeSlots.forEach((tsName) => 
		{
			let x = document.getElementById(tsName);
			
			x.style.backgroundColor = "white";
			x.style.color = "black";
		});
	},

	selectType(id)
	{
		// Function is to select 1 booking type button at a time

		// Set all to off first
		this.clearType();

		let setType = document.getElementById("set_type");
		let timeSlot = document.getElementById("bt_" + id);

		timeSlot.style.backgroundColor = "var(--app-secondary)";
		timeSlot.style.color = "white";

		switch (id)
		{
			case 1:
				setType.value = 1;
			break;
			case 2:
				setType.value = 2;
			break;
			case 3:
				setType.value = 3;
			break;
			case 4:
				setType.value = 4;
			break;
		}
	},

	clearType()
	{
		// Function is to set all booking type buttons off

		const timeSlots = [ "bt_1", "bt_2", "bt_3", "bt_4" ];

		timeSlots.forEach((tsName) => 
		{
			let x = document.getElementById(tsName);
			
			x.style.backgroundColor = "white";
			x.style.color = "black";
		});
	},

	viewPatientDetail(patientIndex)
	{
		// This is to view the patient detail when a user double clicks on the patient dropdown field

		let bits = patientIndex.split("@@");
		let patientUid = bits[0];

		// Set async data
		let formData = { 'patient_uid': patientUid };
        let phpUrl = baseUrl + "booking/view_add_patient_info";
        
		// Do async and display view
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
	},

	getPatientDebtor(patientIndex)
	{
		// This is to fetch the debtor linked to the patients and auto add the dat to the debtor name field

		let debtorName = document.getElementById("debtor_name");
		let bits = patientIndex.split("@@");
		let debtorUid = bits[1];

		if (debtorUid != undefined)
		{
			// Set async data
			let formData = { 'debtor_uid': debtorUid };
			let phpUrl = baseUrl + "booking/get_patient_debtor";
			
			// Do async
			sendData(phpUrl, formData)
			.then(result => 
			{ 
				// Set the value of debtor anme field
				debtorName.value = result;
			});
		} 
		else 
		{
			debtorName.value = "";
		}

		
	},

	// Unit testing examples: Run npm test to view results
	addNumbers(a, b)
	{
		return a + b;
	},

	subtractNumbers(a, b)
	{
		return a - b;
	},

	showDate(dateItem)
	{
		const d = new Date();
		let result = 'Invalid date type given';

		switch(dateItem)
		{
			case 0:
				result = d.getDate();
			break;
			case 1:
				result = d.getDay();
			break;
			case 2:
				result = d.getFullYear();
			break;
			case 3:
				result = d;
			break;
		}

		return result;
	}


}

module.exports = booking;
