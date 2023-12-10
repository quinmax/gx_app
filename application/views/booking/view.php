<?php
// Get booking start time and split into date and time
$start_time = $view_record->start_time;
$bits = explode("T", $start_time);
$get_date = $bits[0];
$get_time = $bits[1];
?>
<div class="form_container">

	<div class="title mb_sml"><i class="fa-regular fa-calendar-check fa_col_primary pr_med"></i>View Booking</div>

	<!-- Show data -->
	<div class="form_view_container">

		<!-- Row 1 -->
		<!-- Entity name, diary name & booking #  -->
		<div class="view_group">
			<div class="label">Entity</div>
			<div class="data">Entity ID: <?php echo $view_record->entity_uid; ?></div>
		</div>

		<div class="view_group">
			<div class="label">Diary</div>
			<div class="data"><?php echo $diary_name; ?></div>
		</div>

		<div class="view_group">
			<div class="label">Booking #</div>
			<div class="data"><?php echo $view_record->uid; ?></div>
		</div>

		<!-- Row 2 -->
		<!-- Booking Status, Booking Type, Treating Doctor  -->
		<div class="view_group">
			<div class="label">Booking Status</div>
			<div class="data"><?php echo $booking_status[$view_record->booking_status_uid]; ?></div>
		</div>

		<div class="view_group">
			<div class="label">Booking Type</div>
			<div class="data"><?php echo $booking_types[$view_record->booking_type_uid]; ?></div>
		</div>
		
		<div class="view_group">
			<div class="label">Treating Doctor</div>
			<div class="data">Dr T Reating</div>
		</div>

		<!-- Row 3 -->
		<!-- Date, time & duration  -->
		<div class="view_group">
			<div class="label">Date</div>
			<div class="data"><?php echo $get_date; ?></div>
		</div>

		<div class="view_group">
			<div class="label">Start Time</div>
			<div class="data"><?php echo $get_time; ?></div>
		</div>
		
		<div class="view_group">
			<div class="label">Duration</div>
			<div class="data"><?php echo $view_record->duration; ?> minutes</div>
		</div>

		<!-- Row 4 -->
		<!-- Patient #, Patient Name & Debtor Name  -->
		<div class="view_group">
			<div class="label">Patient #</div>
			<div class="data"><?php echo $view_record->patient_uid; ?></div>
		</div>

		<div class="view_group">
			<div class="label">Patient Name</div>
			<div class="data"><?php echo $view_record->patient_name . ' ' . $view_record->patient_surname; ?></div>
		</div>
		
		<div class="view_group">
			<div class="label">Debtor Name</div>
			<div class="data"><?php echo $view_record->debtor_name . ' ' . $view_record->debtor_surname; ?></div>
		</div>

		<!-- Row 5 -->
		<!-- Reason  -->
		<div class="view_group" style="grid-column: span 3";>
			<div class="label">Patient #</div>
			<div class="data"><?php echo $view_record->reason; ?></div>
		</div>

		<!-- Row 6 -->
		<!-- Invoice # & Booking created by  -->
		<div class="view_group">
			<div class="label">Invoice #</div>
			<div class="data"><?php echo $view_record->invoice_nr; ?></div>
		</div>

		<div class="view_group">
			<div class="label">Booking created by</div>
			<div class="data">User Id: <?php echo $view_record->patient_uid; ?></div>
		</div>
		
		<div class="view_group">
			<div class="label">&nbsp;</div>
			<div class="data">&nbsp;</div>
		</div>

	</div>

	<!-- Show debtor information links -->
	<div class="sub_title mt_med">Debtor Information</div>
	<div style="display: flex; align-items: center; justify-content: flex-start; width: 100%">
		<div class="view_btn mr_med" onclick="booking.getViewDebtorGeneral()"><i class="fa-regular fa-eye fa_col_primary mr_sml"></i>General Information</div>
		<div class="view_btn mr_med" onclick="booking.getViewDebtorPatients()"><i class="fa-regular fa-eye fa_col_primary mr_sml"></i>Patients</div>
		<div class="view_btn mr_med" onclick="booking.getViewDebtorDoctorHistory()"><i class="fa-regular fa-eye fa_col_primary mr_sml"></i>Doctor History</div>
		<div class="view_btn mr_med" onclick="booking.getViewPatientHistory()"><i class="fa-regular fa-eye fa_col_primary mr_sml"></i>Patient History</div>
	</div>
	
	<!-- Show patient information -->
	<div class="sub_title mt_med">Patient Information</div>
	<div style="display: flex; align-items: center; justify-content: flex-start; width: 100%">
		<div class="view_btn mr_med" onclick="booking.getViewPatientGeneral()"><i class="fa-regular fa-eye fa_col_primary mr_sml"></i>General Information</div>
	</div>

	<!-- Form close button -->
	<div class="mt_lrg">
		<div class="action_button mr_med" onclick="closeForm()">Close</div>
	</div>
	
	<!-- Close icon -->
	<div class="close_btn" onclick="closeForm()"><i class="fa-regular fa-circle-xmark"></i></div>
	
</div>
