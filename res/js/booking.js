const booking = 
{
	startTime: "",
	duration: "",
	bookingType: "",

	getView: function()
    {
        let formData = { };
		
        let phpUrl = baseUrl + "booking/view";

        sendData(phpUrl, formData)
        .then(result => { this.setBookingView(result, 0); });
    },

	setBookingView: function(ajaxData)
    {
        showFormOverlay();
        
        let formOverlay = document.getElementById("form_overlay");
        formOverlay.innerHTML = "";
        formOverlay.innerHTML = ajaxData;

        document.onkeydown=function(evt)
		{
            var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
            if(keyCode == 27)
            {
                closeForm();
            }
            if(keyCode == 13)
            {
				closeForm();
            }
        }
    },

	getViewDebtorGeneral: function()
    {
        let formData = { };
		
        let phpUrl = baseUrl + "booking/view_debtor_general";
        
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewDebtorPatients: function()
    {
        let formData = { };
		
        let phpUrl = baseUrl + "booking/view_debtor_patients";
        
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewDebtorDoctorHistory: function()
    {
        let formData = { };
		
        let phpUrl = baseUrl + "booking/view_debtor_doctor_history";
        
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewPatientHistory: function()
    {
        let formData = { };
		
        let phpUrl = baseUrl + "booking/view_debtor_patient_history";
        
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	getViewPatientGeneral: function()
    {
        let formData = { };
		
        let phpUrl = baseUrl + "booking/view_patient_general";
        
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
    },

	setViewInfo: function(ajaxData,)
    {
        showViewOverlay();
        
        let viewOverlay = document.getElementById("view_overlay");
        viewOverlay.innerHTML = "";
        viewOverlay.innerHTML = ajaxData;

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
        let formData = { };
		
        let phpUrl = baseUrl + "booking/add";
        
        sendData(phpUrl, formData)
        .then(result => { this.setForm(result, 1); });
    },

	getEdit: function()
    {
        let formData = { };
		
        let phpUrl = baseUrl + "booking/edit";
        
        sendData(phpUrl, formData)
        .then(result => { this.setForm(result, 2); });
    },

	setForm: function(ajaxData, mode)
    {
        showFormOverlay();
        
        let formOverlay = document.getElementById("form_overlay");
        formOverlay.innerHTML = "";
        formOverlay.innerHTML = ajaxData;

		let startPicker = new Litepicker({ 
            element: document.getElementById('booking_date')
        });

        document.onkeydown=function(evt)
		{
            var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
            if(keyCode == 27)
            {
                closeForm();
            }
            if(keyCode == 13)
            {
				switch (mode)
				{
					case 0:
						closeForm();
					break;
					case 1:
						booking.save();
					break;
					case 2:
						booking.update();
					break;
				}
            }
        }

		this.clearTimeSlots();
		this.clearDuration();
		this.clearType();
    },

	setReason()
	{
		let reason = document.getElementById("reason");
		let reason_select = document.getElementById("reason_select");

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
		spinner();

		const entityUid = this.getCookie("entity_uid");
		const diaryUid = this.getCookie("diary_uid");
		// Type
		const bookingTypeUid = this.bookingType;
		// Status
		const bookingStatusUid = 1;
		// Start time
		const getBookingDate = document.getElementById("booking_date").value;
		const getBookingTime = this.startTime;
		const start_time = getBookingDate + "T" + getBookingTime;
		// Duration
		const duration = this.duration;
		// Patient uid
		let selectedPatient = patient.value;
		let bits = selectedPatient.split("@@");
		const patientUid = bits[1];
		// Reason
		const reason = document.getElementById("reason").value;
		// Cancelled
		const cancelled = false;

		let phpUrl = baseUrl + "booking/save_booking";
		let formData = { 'entity_uid': entityUid, "diary_uid": diaryUid, "booking_type_uid": bookingTypeUid, "booking_status_uid": bookingStatusUid, "start_time": start_time, "duration": duration, "patient_uid": patientUid, "reason": reason, "cancelled": cancelled };
			
		sendData(phpUrl, formData)
		.then(result => 
		{ 
			spinner();
			response = JSON.parse(result);
			
			if (response.status == "OK")
			{
				closeForm();
				router.booking_list();
			} 
			else 
			{
				console.log('There was an error');
			}
		});
		
		// console.log('Entity uis: ' + entityUid + " Diary uid " + diaryUid + " Type " + bookingTypeUid + " status " + bookingStatusUid + " start time " + start_time + " duration " + duration + "patient uid " + patientUid + "reason " + reason + " cancelled " + cancelled );
	},

	update()
	{
		console.log('Update Form');
	},

	deleteBooking()
	{
		DayPilot.Modal.confirm("Are you sure you want to delete this booking ?", { theme: "modal_flat" })
        .then(function(args) 
        {
            if (args.result) 
            {
                spinner();

                let formData = { "loc_id": loc_id };
                let phpUrl = baseUrl + "manage_locations/delete";
    
            sendData(phpUrl, formData)
            .then(result => 
            {
                setTimeout( function() { spinner(); ROUTER.manage_locations(); },  sysMsgDelay);
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
		this.clearTimeSlots();

		const timeSlot = document.getElementById("ts_" + id);

		timeSlot.style.backgroundColor = "var(--app-secondary)";
		timeSlot.style.color = "white";

		switch (id)
		{
			case 1:
				this.startTime = "08:00";
			break;
			case 2:
				this.startTime = "09:00";
			break;
			case 3:
				this.startTime = "10:00";
			break;
			case 4:
				this.startTime = "11:00";
			break;
			case 5:
				this.startTime = "12:00";
			break;
			case 6:
				this.startTime = "13:00";
			break;
			case 7:
				this.startTime = "14:00";
			break;
			case 8:
				this.startTime = "15:00";
			break;
			case 9:
				this.startTime = "16:00";
			break;
			case 10:
				this.startTime = "17:00";
			break;
		}
		
	},

	clearTimeSlots()
	{
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
		this.clearDuration();

		const timeSlot = document.getElementById("dr_" + id);

		timeSlot.style.backgroundColor = "var(--app-secondary)";
		timeSlot.style.color = "white";

		switch (id)
		{
			case 1:
				this.duration = "15";
			break;
			case 2:
				this.duration = "30";
			break;
			case 3:
				this.duration = "45";
			break;
			case 4:
				this.duration = "60";
			break;
		}
	},

	clearDuration()
	{
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
		this.clearType();

		const timeSlot = document.getElementById("bt_" + id);

		timeSlot.style.backgroundColor = "var(--app-secondary)";
		timeSlot.style.color = "white";

		switch (id)
		{
			case 1:
				this.bookingType = 1;
			break;
			case 2:
				this.bookingType = 2;
			break;
			case 3:
				this.bookingType = 3;
			break;
			case 4:
				this.bookingType = 4;
			break;
		}
	},

	clearType()
	{
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
		let bits = patientIndex.split("@@");
		let patientUid = bits[0];

		let formData = { 'patient_uid': patientUid };
		
        let phpUrl = baseUrl + "booking/view_add_patient_info";
        
        sendData(phpUrl, formData)
        .then(result => { this.setViewInfo(result, 0); });
	},

	getPatientDebtor(patientIndex)
	{
		let debtorName = document.getElementById("debtor_name");
		let bits = patientIndex.split("@@");
		let debtorUid = bits[1];

		console.log('Debtor id: ' + debtorUid);

		if (debtorUid != undefined)
		{
			let formData = { 'debtor_uid': debtorUid };
		
			let phpUrl = baseUrl + "booking/get_patient_debtor";
			
			sendData(phpUrl, formData)
			.then(result => 
			{ 
				console.log('Result: ' + result);
				debtorName.value = result;
			});
		} 
		else 
		{
			debtorName.value = "";
		}

		
	}
}
