$(document).ready(function() {

	jQuery.validator.setDefaults({
		debug: true,
		success: "valid"
	});

	var formCreate = $("#formCreateEvent");

	formCreate.validate({
		rules: {
			createTitle: {
				required: true
			},
			createStartTime: {
				required: true
			},
			createEndTime: {
				required: true
			}
		},

		messages: {
			createTitle: {
				required: "<span style='font-family: calibri'>The Title field is empty</span>"
			},
			createStartTime: {
				required: "<span style='font-family: calibri'>The Start Time field is empty</span>"
			},
			createEndTime: {
				required: "<span style='font-family: calibri'>The End Time field is empty</span>"
			},
		}
	});

	$('#external-events ').each(function() {
		var eventDate;

		$.ajax({
			url:'avr/get_all_approved',
			type: 'GET',
			dataType: 'json',
			success: function(result){
				$('#displayApproved').val(result[0].Approved);
			},
			error: function(xhr, status, msg){
				alert("Database Error");
			}
		});	

		$.ajax({
			url:'avr/get_all_canceled',
			type: 'GET',
			dataType: 'json',
			success: function(result){
				$('#displayCanceled').val(result[0].Canceled);
			},
			error: function(xhr, status, msg){
				alert("Database Error");
			}
		});

		$( "#startDate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: true,
			dateFormat: 'yy-mm-dd',
		});

		$( "#endDate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: true,
			dateFormat: 'yy-mm-dd',
		});

		$('#btnDisplay').click(function(){
			eventDate = {
				startDate: 	$('#startDate').val(),
				endDate: 	$('#endDate').val(),
			};

			$.ajax({
				url: 'avr/get_display_approved',
				type: 'POST',
				data: eventDate,
				dataType: 'json',
				success: function(result){
					$('#displayApproved').val(result[0].Approved);
				},
				error: function(xhr, status, msg){
					alert("Database Error");
				}
			});

			$.ajax({
				url: 'avr/get_display_canceled',
				type: 'POST',
				data: eventDate,
				dataType: 'json',
				success: function(result){
					$('#displayCanceled').val(result[0].Canceled);
				},
				error: function(xhr, status, msg){
					alert("Database Error");
				}
			});
		});


		$('#btnAll').click(function(){
			$.ajax({
				url:'avr/get_all_approved',
				type: 'GET',
				dataType: 'json',
				success: function(result){
					$('#displayApproved').val(result[0].Approved);
				},
				error: function(xhr, status, msg){
					alert("Database Error");
				}
			});	

			$.ajax({
				url:'avr/get_all_canceled',
				type: 'GET',
				dataType: 'json',
				success: function(result){
					$('#displayCanceled').val(result[0].Canceled);
				},
				error: function(xhr, status, msg){
					alert("Database Error");
				}
			});
		});
	});

	$('#calendar').fullCalendar({

		theme: true,
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listMonth'
		},
			navLinks: true, // can click day/week names to navigate views
			selectable: true,
			selectHelper: true,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			allDayDefault: false,
			events: 'avr/event',
			timeFormat: 'h(:mm)t',
			slotEventOverlap: false,
			
			select: function(start, end, jsEvent, view) {
				
				var idEvent;
				var title;
				var emp_id;
				var emp_name;
				var department;
				var position;
				var cont_no;
				var startDay = moment(start).format('YYYY-MM-DD');
				var endDay = moment(end.subtract(1,'days')).format('YYYY-MM-DD');
				

				$('#createStartDay').val(start.format('YYYY-MM-DD'));
				$('#createEndDay').val(end.format('YYYY-MM-DD'));

				$('#datepairExample .time').timepicker({
					'showDuration': true,
					'timeFormat': 'g:ia',
					'minTime': '7:00am',
					'maxTime': '10:00pm',
				});

				$('#datepairExample').datepair();

				$("#btnCreate").click(function(){
					var eventData;
					if(formCreate.valid() === false){
						
					}else{
						eventData = {
							idEvent: 	$('#createIdEvent').val(),
							title: 		$('#createTitle').val(),
							department: $('#createDepartment').val(),
							cont_no: 	$('#createCont_no').val(),
							startDay: 	startDay + "T" + $('#createStartTime').val(),
							endDay: 	endDay + "T" + $('#createEndTime').val(),
							startDate: 	startDay,
							endDate: 	endDay,
						};


						var str1 = eventData.startDay;
						var str2 = eventData.endDay;
						var n1 = str1.includes("pm");
						var n2 = str2.includes("pm");

						if(n2 == true){
							var pt = moment(eventData.endDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.endDay=pt;
						} if(n1 == true ){
							var at = moment(eventData.startDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.startDay=at;
						}


						$.ajax({
							url: 'avr/create_event_prompt',
							type: 'POST',
							data: eventData,
							success: function(result){
								
								$('#modalCreateEvent').modal('toggle');
								location.reload();
							},
							error: function(xhr, status, msg){
								alert("Database Error");
							}
						});
					}

				});

				$('#modalCreateEvent').modal({
					backdrop: 'static',
					keyboard: false,
				});

				$('#btnClose').click(function(){
					location.reload();
				});
				
				$('#calendar').fullCalendar('unselect');

			},
			eventDrop: function(event, delta, revertFunc){
				var id = event.id;
				var title = event.title;
				var startDay = event.start.format();
				var endDay = event.end.format();
				var startDate = event.start.format('YYYY-MM-DD');
				var endDate = event.start.format('YYYY-MM-DD');
				var yellow = "rgb(255, 255, 0)";
				var red = "rgb(255, 0, 0)";

				var eventData = {
					idEvent: 	id,
					title: 		title,
					startDay: 	startDay,
					endDay: 	endDay,
					startDate: 	startDate,
					endDate: 	endDate,
				};

				$.ajax({
					url: 'avr/update',
					type: 'POST',
					data: eventData,
					success: function(result){
						
					},
					error: function(xhr, status, msg){
						
					}
				});
			},
			eventClick: function(event, jsEvent, view) {

				var id = event.id;
				var title = event.title;
				var emp_id = event.emp_id;
				var emp_name = event.emp_name;
				var department = event.department;
				var position = event.position;
				var cont_no = event.cont_no;
				var startDay = moment(event.start).format('YYYY-MM-DD');
				var endDay = moment(event.end).format('YYYY-MM-DD');
				var startTime = moment(event.start).format('h:mm a');
				var endTime = moment(event.end).format('h:mm a');
				var eventData;
				var yellow = "rgb(255, 255, 0)";
				var red = "rgb(255, 0, 0)";

				$('#modalExistEvent').modal({
					backdrop: 'static',
					keyboard: false,
				});

				$('#title').val(title);
				$('#department').val(department);
				$('#cont_no').val(cont_no);
				$('#displayStartDay').val(event.start.format('YYYY-MM-DD'));
				$('#displayStartTime').val(event.start.format('h:mm a'));
				$('#displayEndDay').val(event.end.format('YYYY-MM-DD'));
				$('#displayEndTime').val(event.end.format('h:mm a'));
				$('#datepairExample .time').timepicker({
					'showDuration': true,
					'timeFormat': 'g:ia',
					'minTime': '7:00am',
					'maxTime': '10:00pm',
				});

				$('#datepairExample').datepair();

				if($(this).css('background-color') == yellow){
					
					$('#btnProceed').show();
					$('#btnProceed').click(function(){
						eventData = {
							idEvent: 	id,
							title: 		$('#title').val(),
							department: $('#department').val(),
							cont_no:	$('#cont_no').val(),
							startDay: 	startDay + "T" + $('#displayStartTime').val(),
							endDay: 	endDay + "T" + $('#displayEndTime').val(),
							startDate: 	startDay,
							endDate: 	endDay,
						}

						var str1 = eventData.startDay;
						var str2 = eventData.endDay;
						var n1 = str1.includes("pm");
						var n2 = str2.includes("pm");

						if(n2 == true){
							var pt = moment(eventData.endDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.endDay=pt;
						} if(n1 == true ){
							var at = moment(eventData.startDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.startDay=at;
						}

						$.ajax({
							url:'avr/proceed_event_prompt',
							type: 'POST',
							data: eventData,
							success: function(result){
								
								location.reload();
							},
							error: function(xhr, status, msg){
								alert("Database Error");
							}
						});
					});

					$('#btnDelete').click(function(){

						var eventData = {
							idEvent: id
						}

						$.ajax({
							url:'avr/delete',
							type: 'POST',
							data: eventData,
							success: function(result){
								location.reload();
							},
							error: function(xhr, status, msg){
								alert("Database Error");
							}
						});
					});

				}else{
					document.getElementById('btnProceed').style.visibility = 'hidden';
					$('#btnDelete').attr('value', 'Cancel');	
					$('#btnDelete').attr('id', 'btnCanceled');
				}

				if($(this).css('background-color') == red){
					$('#title').attr('readonly', true);
					$('#department').attr('readonly', true);
					$('#cont_no').attr('readonly', true);
					$('#displayEndDay').attr('readonly', true);
					$('#displayStartTime').attr('readonly', true);
					$('#displayEndTime').attr('readonly', true);
					document.getElementById('btnCanceled').style.visibility = 'hidden';
					document.getElementById('btnSave').style.visibility = 'hidden';
				}else{



					$('#btnCanceled').click(function(){
						eventData = {
							idEvent: 	id,
							title: 		$('#title').val(),
							department: $('#department').val(),
							cont_no:	$('#cont_no').val(),
							startDay: 	startDay + "T" + $('#displayStartTime').val(),
							endDay: 	endDay + "T" + $('#displayEndTime').val(),
							startDate: 	startDay,
							endDate: 	endDay,
						}

						var str1 = eventData.startDay;
						var str2 = eventData.endDay;
						var n1 = str1.includes("pm");
						var n2 = str2.includes("pm");

						if(n2 == true){
							var pt = moment(eventData.endDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.endDay=pt;
						} if(n1 == true ){
							var at = moment(eventData.startDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.startDay=at;
						}

						$.ajax({
							url:'avr/cancel_event_prompt',
							type: 'POST',
							data: eventData,
							success: function(result){

								location.reload();
							},
							error: function(xhr, status, msg){
								alert("Database Error");
							}
						});
					});

					$('#btnSave').click(function(){
						eventData = {
							idEvent: 	id,
							title: 		$('#title').val(),
							department: $('#department').val(),
							cont_no:	$('#cont_no').val(),
							startDay: 	startDay + "T" + $('#displayStartTime').val(),
							endDay: 	$('#displayEndDay').val() + "T" + $('#displayEndTime').val(),
							startDate: 	startDay,
							endDate: 	$('#displayEndDay').val(),
						}

						var str1 = eventData.startDay;
						var str2 = eventData.endDay;
						var n1 = str1.includes("pm");
						var n2 = str2.includes("pm");

						if(n2 == true){
							var pt = moment(eventData.endDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.endDay=pt;
						} if(n1 == true ){
							var at = moment(eventData.startDay, ["YYYY-MM-DD h:mm A"]).format("YYYY-MM-DD HH:mm");
							eventData.startDay=at;
						}

						$.ajax({
							url:'avr/updateModal',
							type: 'POST',
							data: eventData,
							success: function(result){

								location.reload();
							},
							error: function(xhr, status, msg){
								alert("Database Error");
							}
						});

					});	
				}

				$('#btnClosed').click(function(){
					location.reload();
				});

			},
			
		});
});

