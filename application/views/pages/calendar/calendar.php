<meta charset='utf-8' />

<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
	}

	#wrap {
		width: 1100px;
		margin: 0 auto;
	}

	#external-events {
		float: left;
		width: 180px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
	}

	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}

	#external-events .fc-event {
		margin: 10px 0;
		cursor: pointer;
	}

	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		float: right;
		width: 900px;
	}


</style>
</head>
<body>


	<div id='wrap'>
		<div id='external-events'>
			<p style="margin-top: 3%;">Start Date: <input type="text" id="startDate" style="width: 50%"></p>
			<p style="margin-top: -5%;">End Date:  <input type="text" id="endDate" style="width: 50%; margin-left: 3%;"></p>
			<button type="button" id="btnAll">All</button>
			<button type="button" id="btnDisplay">Display</button>
			<h4 style="margin-top: -10%;">Approved/Canceled Events</h4>
			<h4 class="pull-left">Approved:</h4>
			<input type="text" class="form-control" id="displayApproved" name="displayApproved" readonly="true" style="width: 60px;">
			<h4 class="pull-left">Canceled:</h4>
			<input type="text" class="form-control pull-left" id="displayCanceled" name="displayCanceled" readonly="true" style="width: 60px;">
		</div>
		<div id='calendar'></div>
		<div style='clear:both;'></div>
	</div>


	<div class="modal fade" id="modalCreateEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document" style="width: 700px">
			<div class="modal-content">
				<div class="modal-header bg-red">
					<h4 class="modal-title" id="myModalLabel">Create Event</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" action="" method="post" id="formCreateEvent">
						<input type="hidden" id="createIdEvent"/>
						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Title:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="createTitle" name="createTitle" placeholder="Untitled Event" required="true">
								</div>
								<label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5px">Department:</label>
								<div class="col-sm-10" style="margin-top: 5px">
									<input type="text" class="form-control" id="createDepartment" name="createDepartment" placeholder="Department">
								</div>
								<label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5px">Contact No.:</label>
								<div class="col-sm-10" style="margin-top: 5px">
									<input type="text" id="createCont_no" name="createCont_no" class="form-control" style="width: 200px" placeholder="Contact No.">
								</div>
								<div id="datepairExample">
									<label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5px">Start Date:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control pull-left" id="createStartDay" name="createStartDay" style="width: 130px; margin-top: 5px" readonly="true">
										<label for="inputEmail3" class="control-label pull-left" style="margin-left: 20px; margin-right: 20px; margin-top: 5px">Start Time:</label>
										<input type="text" class="form-control time start ui-timepicker-input" id="createStartTime" name="createStartTime" style="width: 100px; margin-top: 5px" required="true">
									</div>
									<label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5px">End Date:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control pull-left" id="createEndDay" name="createEndDay" style="width: 130px; margin-top: 5px" readonly="true">
										<label for="inputEmail3" class="control-label pull-left" style="margin-left: 20px; margin-right: 26px; margin-top: 5px">End Time:</label>
										<input type="text" class="form-control time end ui-timepicker-input" id="createEndTime" name="createEndTime" style="width: 100px; margin-top: 5px" required="true">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="height:60px;">
							<button type="submit" class="btn btn-success pull-left" id="btnCreate" style="margin-left: 460px;">Create</button>
							<button type="button" class="btn btn-default" id="btnClose" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalExistEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document" style="width: 700px">
			<div class="modal-content">
				<div class="modal-header bg-red">
					<h4 class="modal-title" id="myModalLabel">Event</h4>
				</div>

				<div class="modal-body form-horizontal">
					<?php echo form_open('/avr/update/') ?>
					<input type="hidden" id="idEvent">
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Title:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title" placeholder="Untitled Event">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5px">Department:</label>
							<div class="col-sm-10" style="margin-top: 5px">
								<input type="text" class="form-control" id="department" name="department" placeholder="Department">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 5px">Contact No.:</label>
							<div class="col-sm-10" style="margin-top: 5px">
								<input type="text" id="cont_no" name="cont_no" class="form-control" style="width: 200px" placeholder="Contact No.">
							</div>
							<div id="datepairExample">
								<label for="inputEmail3" class="col-sm-2 control-label">Start:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control pull-left" id="displayStartDay" name="displayStartDay" style="width: 200px" readonly="true">
									<input type="text" class="form-control time start ui-timepicker-input" id="displayStartTime" name="displayStartTime"  style="width: 150px">
								</div>
								<label for="inputEmail3" class="col-sm-2 control-label">End:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control pull-left" id="displayEndDay" name="displayEndDay" style="width: 200px">
									<input type="text" class="form-control time end ui-timepicker-input" id="displayEndTime" name="displayEndTime" style="width: 150px">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-warning pull-left" id="btnProceed" data-dismiss="modal" style="margin-left: 325px;">Approve</button>
				<button type="button" class="btn btn-success pull-left" id="btnSave" data-dismiss="modal">Save</button>
				<input type="button" class="btn btn-danger pull-left" id="btnDelete" data-dismiss="modal" value="Delete"/>
				<button type="button" class="btn btn-default" id="btnClosed" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

</body>
