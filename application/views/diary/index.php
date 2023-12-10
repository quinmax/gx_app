<?php
$reports = array('0' => 'Please select...', '1' => 'All bookings (by date)', '2' => 'Average bookings per day', '3' => 'Average length of booking')
?>
<div class="main_container">

	<!-- Load topbar for diary list page  -->
	<?php $this->load->view($topbar); ?>

	<div class="main_content">

		<!-- Page bar: Entity name and report list for this page -->
		<div class="page_bar mb_med">
		<div class="entity_name"><i class="fa-solid fa-house-medical fa_col_secondary pr_sml"></i><?php echo $entity_name; ?><?php echo $entity_name; ?></div>
			<div class="report_container">
				<div><i class="fa-solid fa-print fa_col_secondary pr_med"></i>Reports</div>
				<div><?php echo form_dropdown('a', $reports, ''); ?></div>
			</div>
		</div>

		<!-- Datagrid: Diary list start -->
		<div class="datagrid_container">

			<div class="title mb_sml">Select a diary</div>
			<div class="datagrid_wrapper" style="grid-template-columns: 50px 100px 1fr 1fr auto auto; column-gap: 5px;">

				<!-- Datagrid: Column titles -->
				<div class="col_title">View</div>
				<div class="col_title">ID</div>
				<div class="col_title">Diary Name</div>
				<div class="col_title">Treating Doctor</div>
				<div class="col_title">Service Center ID</div>
				<div class="col_title">Active</div>

				<!-- Datagrid: data/records -->
				<?php
				foreach($records as $row)
				{
					$active = 'N';
					if ($row->disabled) { $active = 'Y';}

					echo "<div class='data_row' title='Click to view diary bookings' onclick='diary.selectDiary($row->uid, `$row->name`)'>";
						echo "<div class='datagrid_wrapper cell center' title='View booking details'><i class='fa-regular fa-eye fa_col_secondary'></i></div>";
						echo "<div class='datagrid_wrapper cell'>" . $row->uid . "</div>";
						echo "<div class='datagrid_wrapper cell'>" . $row->name ."</div>";
						echo "<div class='datagrid_wrapper cell'>" . $row->treating_doctor_uid ."</div>";
						echo "<div class='datagrid_wrapper cell'>" . $row->service_center_uid ."</div>";
						echo "<div class='datagrid_wrapper cell center'>" . $active ."</div>";
					echo "</div>";

				}
				?>

			</div>

		</div>

	</div>

</div>
