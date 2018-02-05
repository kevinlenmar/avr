
<div style="margin-left: 30px">
	<div class="row">
		
		<?php echo validation_errors(); ?>
		<?php echo form_open('avr/create')?>
			<div class="form-group" style="margin-top: 10px;"">
				<input type="text" name="title" id="title" class="form-control" placeholder="Untitled Event" style="width: 400px"></div>
					<div style="margin-top: 10px">
						<input type="text" name="from_date" style="width: 100px" class="pull-left">
						<input type="text" name="from_time" style="width: 100px; margin-left: 5px;">
						to
						<input type="text" name="to_date" style="width: 100px;">
						<input type="text" name="to_time" style="width: 100px;">
					</div>
					<div style="margin-top: 10px;" >
						<input type="checkbox" name="all_day" style="margin-right: 5px">All day
						<input type="checkbox" name="all_day" style="margin-right: 5px; margin-left: 5px">Repeat
					</div>
					<div style="margin-top: 10px;" >
						<input type="text" name="id" class="form-control pull-left" style="width: 200px" placeholder="Employee ID">
						<input type="text" name="name" class="form-control" style="width: 200px" placeholder="Employee Name">
						<input type="text" name="department" class="form-control" style="width: 500px" placeholder="Department">
						<input type="text" name="cont_no" class="form-control" style="width: 200px" placeholder="Contact No.">
					</div>
				<button type="button" class="btn btn-danger">Create</a>
			</div>
		</form>
	</div>
</div>