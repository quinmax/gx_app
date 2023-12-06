Edit booking
<div class="form_container">

	<div class="title mb_sml"><i class="fa-solid fa-plus fa_col_primary pr_med"></i>Create Booking</div>

	<!-- Holding container -->
	<div class="form_addedit_container">
		
		<!-- Date: 1 line -->
		<div class="form_group">
			<div class="label">Date</div>
			<div class="data"><?php echo form_input('booking_date', '', 'id="booking_date" style="width: 275px;"'); ?></div>
		</div>

		<!-- Available: Time slots - Taken slots are greyed out, available are white with black border, blue when selected -->
		<!-- Row 1 -->
		<div class="form_group">

			<div class="label">Available Time Slots</div>
			<div class="form_eight_columns">
				<div class="btn_on">08:00</div>
				<div class="btn_on">08:30</div>
				<div class="btn_off">09:30</div>
				<div class="btn_off">10:30</div>
				<div class="btn_on">11:00</div>
				<div class="btn_on">11:30</div>
				<div class="btn_off">12:00</div>
				<div class="btn_on">12:30</div>
			</div>

			<!-- Row 2 -->
			<div class="form_eight_columns mt_med">
				<div class="btn_on">13:00</div>
				<div class="btn_on">13:30</div>
				<div class="btn_on">14:00</div>
				<div class="btn_on">14:30</div>
				<div class="btn_off">15:00</div>
				<div class="btn_on">15:30</div>
				<div class="btn_on">16:00</div>
				<div class="btn_on">16:30</div>
			</div>

		</div>

		<!-- Duration: All buttons available, blue when selected -->
		<div class="form_group">
			<div class="label">Duration (Minutes)</div>
			<div class="form_four_columns">
				<div class="btn">15</div>
				<div class="btn">30</div>
				<div class="btn">45</div>
				<div class="btn">60</div>
			</div>
		</div>

		<!-- Booking Type: All buttons available, blue when selected -->
		<div class="form_group">
			<div class="label">Booking Type</div>
			<div class="form_four_columns">
				<div class="btn">Consultation</div>
				<div class="btn">Follow Up</div>
				<div class="btn">Meeting</div>
				<div class="btn">Out of office</div>
			</div>
		</div>

		<!-- Patient and Debtor fields: 2 columns -->
		<div class="form_two_columns">
			<div>
				<div class="form_group">
					<div class="label">Patient</div>
					<div class="data">
						<?php 
						$patients = array('0' => 'Please select...', '1' => 'Harry Potter', '2' => 'John Snow', '3' => 'Mary Poppins');
						echo form_dropdown('patient', $patients, '0', 'style="width: 100%"'); ?>
					</div>
				</div>
			</div>
			<div>
				<div class="form_group">
					<div class="label">Debtor (Confirm)</div>
					<div class="data"><?php echo form_input('debtor', 'I will auto-populate', 'style="width: 100%"'); ?></div>
				</div>
			</div>
		</div>

		<!-- Reason: Dropdown for a quick select and or user can input a reason -->
		<div class="form_one_column">
			<div>
				<div class="form_group">
					<div class="label">Reason for booking</div>
					<div class="data">
						<?php 
						$reasons = array('0' => 'Please select...', '1' => 'Cold/Flu', '2' => 'Injury', '3' => 'Not feeling well', '4' => 'Breathing problem', '5' => 'Other');
						echo form_dropdown('reason_select', $reasons, '0', 'style="width: 100%"'); ?>
					</div>
				</div>
			</div>
			<div class="mt_med">
				<?php echo form_input('debtor', '', 'style="width: 100%" placeholder="Enter reason"'); ?>
			</div>
			<div>&nbsp;</div>
		</div>
		
		<!-- Form buttons: 4 columns (1fr auto auto 1fr) -->
		<div class="form_button_bar">
			<div>&nbsp;</div>
			<div class="action_button" onclick="booking.update()">Update</div>
			<div class="action_button" onclick="closeForm()">Close</div>
			<div>&nbsp;</div>
		</div>

	</div>

	<!-- Close icon -->
	<div class="close_btn" onclick="closeForm()"><i class="fa-regular fa-circle-xmark"></i></div>

</div>
