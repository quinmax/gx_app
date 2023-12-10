<div class="form_container">

	<div class="title mb_sml"><i class="fa-solid fa-plus fa_col_primary pr_med"></i>Edit Booking</div>

	<!-- Holding container -->
	<div class="form_addedit_container">
		
		<!-- Date: 1 line -->
		<div id="fg_date" class="form_group">
			<div class="label">Date</div>
			<div class="data"><?php echo form_input('booking_date', $start_date, 'id="booking_date" style="width: 275px;"'); ?></div>

			<!-- Validation error -->
			<div id="err_date" class="form_error">Please enter a date</div>

		</div>

		<!-- Select a booking time -->
		<!-- Row 1 -->
		<div id="fg_start_time" class="form_group">

			<div class="label">Select a start time</div>
			<div class="form_five_columns">
				<div id="ts_1" class="<?php echo $time_class[0]; ?>" onclick="booking.selectTimeSlot(1)">08:00</div>
				<div id="ts_2" class="<?php echo $time_class[1]; ?>" onclick="booking.selectTimeSlot(2)">09:00</div>
				<div id="ts_3" class="<?php echo $time_class[2]; ?>" onclick="booking.selectTimeSlot(3)">10:00</div>
				<div id="ts_4" class="<?php echo $time_class[3]; ?>" onclick="booking.selectTimeSlot(4)">11:00</div>
				<div id="ts_5" class="<?php echo $time_class[4]; ?>" onclick="booking.selectTimeSlot(5)">12:00</div>
			</div>

			<!-- Row 2 -->
			<div class="form_five_columns mt_med">
				<div id="ts_6" class="<?php echo $time_class[5]; ?>" onclick="booking.selectTimeSlot(6)">13:00</div>
				<div id="ts_7" class="<?php echo $time_class[6]; ?>" onclick="booking.selectTimeSlot(7)">14:00</div>
				<div id="ts_8" class="<?php echo $time_class[7]; ?>" onclick="booking.selectTimeSlot(8)">15:00</div>
				<div id="ts_9" class="<?php echo $time_class[8]; ?>" onclick="booking.selectTimeSlot(9)">16:00</div>
				<div id="ts_10" class="<?php echo $time_class[9]; ?>" onclick="booking.selectTimeSlot(10)">17:00</div>
			</div>

			<!-- Validation error -->
			<div id="err_start_time" class="form_error">Please select a start time</div>

		</div>

		<!-- Select Duration -->
		<div id="fg_duration" class="form_group">
			<div class="label">Duration (Minutes)</div>
			<div class="form_four_columns">
				<div id="dr_1" class="<?php echo $duration_class[0]; ?>" onclick="booking.selectDuration(1)">15</div>
				<div id="dr_2" class="<?php echo $duration_class[1]; ?>" onclick="booking.selectDuration(2)">30</div>
				<div id="dr_3" class="<?php echo $duration_class[2]; ?>" onclick="booking.selectDuration(3)">45</div>
				<div id="dr_4" class="<?php echo $duration_class[3]; ?>" onclick="booking.selectDuration(4)">60</div>
			</div>

			<!-- Validation error -->
			<div id="err_duration" class="form_error">Please select the duration</div>
		</div>

		<!-- Select Booking Type -->
		<div id="fg_type"  class="form_group">
			<div class="label">Booking Type</div>
			<div class="form_four_columns">
				<div id="bt_1" class="<?php echo $type_class[0]; ?>" onclick="booking.selectType(1)">Consultation</div>
				<div id="bt_2" class="<?php echo $type_class[1]; ?>" onclick="booking.selectType(2)">Follow Up</div>
				<div id="bt_3" class="<?php echo $type_class[2]; ?>" onclick="booking.selectType(3)">Meeting</div>
				<div id="bt_4" class="<?php echo $type_class[3]; ?>" onclick="booking.selectType(4)">Out of office</div>
			</div>

			<!-- Validation error -->
			<div id="err_type" class="form_error">Please select a booking type</div>

		</div>

		<!-- Patient and Debtor fields: 2 columns -->
		<div class="form_two_columns">
			<div>
				<div id="fg_patient" class="form_group">
					<div class="label">Patient</div>
					<div class="data">
						<?php 
						echo form_dropdown('patient', $patient_list, '1@@3', 'id="patient" style="width: 100%" ondblclick="booking.viewPatientDetail(this.value)" onchange="booking.getPatientDebtor(this.value)"'); ?>
					</div>
					
					<div style="font-size: 1rem; font-style: italic; text-transform: none">(Double click on selected patient to view details)</div>
					
					<!-- Validation error -->
					<div id="err_patient" class="form_error">Please select a patient</div>

				</div>
			</div>
			<div>
				<div class="form_group">
					<div class="label">Debtor (Confirm)</div>
					<div class="data"><?php echo form_input('debtor_name', $debtor_name, 'id="debtor_name" style="width: 100%"'); ?></div>
				</div>
			</div>
		</div>

		<!-- Reason: Dropdown for a quick select and or user can input a reason -->
		<div class="form_one_column">
			<div id="fg_reason" class="form_group">
				<!-- <div> -->
					<div class="label">Reason for booking</div>
					<div class="data">
						<?php 
						$reasons = array('0' => 'Please select...', '1' => 'Cold/Flu', '2' => 'Injury', '3' => 'Not feeling well', '4' => 'Breathing problem', '5' => 'Other');
						echo form_dropdown('reason_select', $reasons, '0', 'id="reason_select" style="width: 100%" onchange="booking.setReason()"'); ?>
					</div>

					<!-- Validation error -->
					<div id="err_reason" class="form_error">Please select or enter a reason</div>

					<?php echo form_input('reason', $reason, 'id="reason" style="margin-top: 5px; width: 100%" placeholder="Enter reason"'); ?>
			</div>


		</div>
		
		<!-- Form buttons: 4 columns (1fr auto auto 1fr) -->
		<div class="form_button_bar mt_lrg">
			<div>
				<!-- Hidden fields used for storing edit id and for selecting time and duration -->
				<?php echo form_input('booking_uid', $uid, 'id="booking_uid" style="display: none"'); ?>
				<?php echo form_input('set_time', $set_time, 'id="set_time" style="display: none"'); ?>
				<?php echo form_input('set_duration', $set_duration, 'id="set_duration" style="display: none"'); ?>
			</div>
			<div class="action_button" onclick="booking.editValidate()">Update</div>
			<div class="action_button" onclick="closeForm()">Close</div>
			<div>&nbsp;</div>
		</div>

	</div>

	<!-- Close icon: top right -->
	<div class="close_btn" onclick="closeForm()"><i class="fa-regular fa-circle-xmark"></i></div>

</div>
