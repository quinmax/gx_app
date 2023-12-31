<?php
$reports = array('0' => 'Please select...', '1' => 'Bookings (Today)', '2' => 'Bookings (Week)', '3' => 'Bookings (Month)', '4' => 'Available time slots')
?>
<div class="main_container">

	<!-- Load topbar for bookings page  -->
	<?php $this->load->view($topbar); ?>

	<div class="main_content">

		<!-- Page bar: Entity name, Diary name and report list for this page -->
		<div class="page_bar mb_med">
			<div class="entity_name"><i class="fa-solid fa-house-medical fa_col_secondary pr_sml"></i><?php echo $entity_name; ?> | <i class="fa-solid fa-user-doctor fa_col_secondary pr_sml pl_sml"></i><?php echo $diary_name; ?></div>
			<div class="report_container">	
				<!-- Reports for this page -->
				<div><i class="fa-solid fa-print fa_col_secondary pr_sml"></i>Reports</div>
				<div><?php echo form_dropdown('a', $reports, ''); ?></div>
			</div>
		</div>

		<!-- Bookings list data grid -->
		<div class="data_bar">
			<div class="title mb_sml"><?php echo $title; ?></div>

			<!-- Select a date -->
			<div class="actions">
			<div><i class="fa-solid fa-print fa_col_secondary pr_sml"></i>Select a date</div>
			<div><?php echo form_input('booking_filter_date', $booking_filter_date, 'id="booking_filter_date" style="width: 100px;"'); ?></div>
			</div>

			<!-- Button: cretate booking -->
			<div class="actions">
				<div class="action_button" onclick="booking.getAdd()"><i class="fa-solid fa-plus fa_col_white pr_sml"></i>Create Booking</div>
			</div>
		</div>

		<!-- Datagrid: bookings start -->
		<div class="datagrid_container">
			
			<div class="datagrid_wrapper" style="grid-template-columns: 50px repeat(10, auto) 40px 40px; column-gap: 5px;">

				<!-- Datagrid: Column titles -->
				<div class="col_title" title="View booking details">View</div>
				<div class="col_title">ID</div>
				<div class="col_title">Type</div>
				<div class="col_title">Status</div>
				<div class="col_title">Date</div>
				<div class="col_title">Time</div>
				<div class="col_title">Duration</div>
				<div class="col_title">Patient Name</div>
				<div class="col_title">Reason</div>
				<div class="col_title">Debtor Name</div>
				<div class="col_title center">Cancelled</div>
				<div class="col_title center" title="Edit this booking"><i class="fa-regular fa-pen-to-square"></i></div>
				<div class="col_title center" title="Delete this booking"><i class="fa-regular fa-trash-can"></i></div>

				<!-- Datagrid: data/records -->
				<?php
				if (count($records) == 0)
				{
					echo "<div style='grid-column: span 13'>No bookings found</div>";
				}
				else 
				{
					foreach($records as $row)
					{
						// Get start date and time and get date and time
						$get_booking_date = $row->start_time;
						$date_time = explode("T", $get_booking_date);

						// Get the booking status name
						$get_booking_status_id = $row->booking_status_uid;
						$booking_status_name = $booking_status[$get_booking_status_id];

						// Get the booking type
						$get_booking_type_id = $row->booking_type_uid;
						$booking_type = $booking_types[$get_booking_type_id];

						// Has booking been deleted/cancelled ?
						$get_cancelled = $row->cancelled;
						if ($get_cancelled == 1)
						{
							$cancelled = "<span class='is_cancelled'>Y</span>";
						} 
						else 
						{
							$cancelled = "<span class='not_cancelled'>N</span>";
						}

						echo "<div class='data_row' onclick='booking.getView(`$row->uid`)'>";
							echo "<div class='datagrid_wrapper cell center' title='View booking details'><i class='fa-regular fa-eye fa_col_secondary'></i></div>";
							echo "<div class='datagrid_wrapper cell'>" . $row->uid . "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $booking_type. "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $booking_status_name . "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $date_time[0] . "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $date_time[1] . "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $row->duration . "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $row->patient_name . ' ' . $row->patient_surname . "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $row->reason . "</div>";
							echo "<div class='datagrid_wrapper cell'>" . $row->debtor_name . ' ' . $row->debtor_surname . "</div>";
							echo "<div class='datagrid_wrapper cell center'>" . $cancelled . "</div>";
						echo "</div>";
						echo "<div class='datagrid_wrapper cell center c_p' title='Edit this booking' onclick='booking.getEdit(`$row->uid`)'><i class='fa-regular fa-pen-to-square'></i></div>";
						echo "<div class='datagrid_wrapper cell center c_p' title='Delete this booking' onclick='booking.deleteBooking(`$row->uid`)'><i class='fa-regular fa-trash-can'></i></div>";
					}
				}
				?>
				
			</div>

		</div>

	</div>

</div>

<!-- Date picker for selecting booking date -->
<script>
const picker = new Litepicker({ element: document.getElementById('booking_filter_date') });
picker.on('selected', () => {
	booking.setFilter();
});
</script>
