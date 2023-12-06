<div class="form_container">

	<div class="title mb_sml"><i class="fa-regular fa-calendar-check fa_col_primary pr_med"></i>View Booking</div>

	<!-- Show data -->
	<div class="form_view_container">

		<!-- Row 1 -->
		<!-- Entity name, diary name & booking #  -->
		<div class="view_group">
			<div class="label">Entity</div>
			<div class="data">Med Center Sandton</div>
		</div>

		<div class="view_group">
			<div class="label">Diary</div>
			<div class="data">Dr A B Claus</div>
		</div>

		<div class="view_group">
			<div class="label">Booking #</div>
			<div class="data">A123</div>
		</div>

		<!-- Row 2 -->
		<!-- Booking Status, Booking Type, Treating Doctor  -->
		<div class="view_group">
			<div class="label">Booking Status</div>
			<div class="data">Booked</div>
		</div>

		<div class="view_group">
			<div class="label">Booking Type</div>
			<div class="data">Consultation</div>
		</div>
		
		<div class="view_group">
			<div class="label">Treating Doctor</div>
			<div class="data">Dr Parker</div>
		</div>

		<!-- Row 3 -->
		<!-- Date, time & duration  -->
		<div class="view_group">
			<div class="label">Date</div>
			<div class="data">2023-12-04</div>
		</div>

		<div class="view_group">
			<div class="label">Start Time</div>
			<div class="data">08:00</div>
		</div>
		
		<div class="view_group">
			<div class="label">Duration</div>
			<div class="data">15 minutes</div>
		</div>

		<!-- Row 4 -->
		<!-- Patient #, Patient Name & Debtor Name  -->
		<div class="view_group">
			<div class="label">Patient #</div>
			<div class="data">HP00023</div>
		</div>

		<div class="view_group">
			<div class="label">Patient Name</div>
			<div class="data">Harry Potter</div>
		</div>
		
		<div class="view_group">
			<div class="label">Debtor Name</div>
			<div class="data">Bruce Wayne</div>
		</div>

		<!-- Row 5 -->
		<!-- Reason  -->
		<div class="view_group" style="grid-column: span 3";>
			<div class="label">Patient #</div>
			<div class="data">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, voluptate quo ex saepe laborum ipsam. Iste placeat praesentium cumque laborum architecto ex vel. Laboriosam voluptates ut optio tenetur, iusto eaque.</div>
		</div>

		<!-- Row 6 -->
		<!-- Invoice # & Booking created by  -->
		<div class="view_group">
			<div class="label">Invoice #</div>
			<div class="data">HP00023</div>
		</div>

		<div class="view_group">
			<div class="label">Booking created by</div>
			<div class="data">Harry Potter</div>
		</div>
		
		<div class="view_group">
			<div class="label">&nbsp;</div>
			<div class="data">&nbsp;</div>
		</div>

	</div>

	<!-- Show debtor information links -->
	<div class="sub_title mt_med">Debtor Information</div>
	<div style="display: flex; align-items: center; justify-content: flex-start; width: 100%">
		<div class="alt_button mr_med" onclick="booking.getViewDebtorGeneral()"><i class="fa-regular fa-eye fa_col_white mr_sml"></i>General Information</div>
		<div class="alt_button mr_med" onclick="booking.getViewDebtorPatients()"><i class="fa-regular fa-eye fa_col_white mr_sml"></i>Patients</div>
		<div class="alt_button mr_med" onclick="booking.getViewDebtorDoctorHistory()"><i class="fa-regular fa-eye fa_col_white mr_sml"></i>Doctor History</div>
		<div class="alt_button mr_med" onclick="booking.getViewPatientHistory()"><i class="fa-regular fa-eye fa_col_white mr_sml"></i>Patient History</div>
	</div>
	
	<!-- Show patient information -->
	<div class="sub_title mt_med">Patient Information</div>
	<div style="display: flex; align-items: center; justify-content: flex-start; width: 100%">
		<div class="alt_button mr_med" onclick="booking.getViewPatientGeneral()"><i class="fa-regular fa-eye fa_col_white mr_sml"></i>General Information</div>
	</div>

	<!-- Form close button -->
	<div class="mt_lrg">
		<div class="action_button mr_med" onclick="closeForm()"><i class="fa-regular fa-circle-xmark fa_col_white pr_sml"></i>Close</div>
	</div>
	
	<!-- Close icon -->
	<div class="close_btn" onclick="closeForm()"><i class="fa-regular fa-circle-xmark"></i></div>
</div>
