@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  	<link rel="stylesheet" href="{{asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
@endsection
@section('judul')
	Kelola Jadwal
@endsection
@section('dimana')
	<li class="active">Kelola Jadwal</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-body no-padding">
					<div id="calendar"></div>
	            </div>
			</div>
		</div>
	</div>
@endsection
@section('addjs')
	<script src="{{asset('bower_components/moment/moment.js')}}"></script>
	<script src="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
	<script>
	  	$(function () {
	    	function init_events(ele) {
	      		ele.each(function () {
	        		var eventObject = {
	          			title: $.trim($(this).text()) // use the element's text as the event title
	        		}
	        		$(this).data('eventObject', eventObject)
	        		$(this).draggable({
	          			zIndex        : 1070,
	          			revert        : true, // will cause the event to go back to its
	          			revertDuration: 0  //  original position after the drag
	        		})
				})
	    	}
			init_events($('#external-events div.external-event'))
	    	var date = new Date()
	    	var d    = date.getDate(),
	        	m    = date.getMonth(),
	        	y    = date.getFullYear()
	    	$('#calendar').fullCalendar({
		    	header    : {
		        	left  : 'prev,next today',
		        	center: 'title',
		        	right : 'month'
		      	},
		      	buttonText: {
			        today: 'today',
			        month: 'month'
		      	},
		      //Random default events
	      		events    : [
		        {
			        title          : 'All Day Event',
			        start          : new Date(y, m, 1),
			        backgroundColor: '#f56954', //red
			        borderColor    : '#f56954' //red
		        },
		        {
		          title          : 'Long Event',
		          start          : new Date(y, m, d - 5),
		          end            : new Date(y, m, d - 2),
		          backgroundColor: '#f39c12', //yellow
		          borderColor    : '#f39c12' //yellow
		        },
	        	{
		          	title          : 'Meeting',
		          	start          : new Date(y, m, d, 10, 30),
		          	allDay         : false,
		          	backgroundColor: '#0073b7', //Blue
		          	borderColor    : '#0073b7' //Blue
		        },
	        	{
	          		title          : 'Lunch',
	          		start          : new Date(y, m, d, 12, 0),
	          		end            : new Date(y, m, d, 14, 0),
	          		allDay         : false,
	          		backgroundColor: '#00c0ef', //Info (aqua)
	          		borderColor    : '#00c0ef' //Info (aqua)
	        	},
	        	{
	          		title          : 'Birthday Party',
	          		start          : new Date(y, m, d + 1, 19, 0),
	          		end            : new Date(y, m, d + 1, 22, 30),
	          		allDay         : false,
	          		backgroundColor: '#00a65a', //Success (green)
	          		borderColor    : '#00a65a' //Success (green)
	        	},
	        	{
	          		title          : 'Click for Google',
	          		start          : new Date(y, m, 28),
	          		end            : new Date(y, m, 29),
	          		url            : 'http://google.com/',
	          		backgroundColor: '#3c8dbc', //Primary (light-blue)
	          		borderColor    : '#3c8dbc' //Primary (light-blue)
	        	}
	      	],
	      	editable  : false,
	      	droppable : false, // this allows things to be dropped onto the calendar !!!
	      	drop      : function (date, allDay) { // this function is called when something is dropped
							// retrieve the dropped element's stored Event Object
					        var originalEventObject = $(this).data('eventObject')

					        // we need to copy it, so that multiple events don't have a reference to the same object
					        var copiedEventObject = $.extend({}, originalEventObject)

					        // assign it the date that was reported
					        copiedEventObject.start           = date
					        copiedEventObject.allDay          = allDay
					        copiedEventObject.backgroundColor = $(this).css('background-color')
					        copiedEventObject.borderColor     = $(this).css('border-color')
							// render the event on the calendar
					        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
					        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

					        // is the "remove after drop" checkbox checked?
					        if ($('#drop-remove').is(':checked')) {
					          // if so, remove the element from the "Draggable Events" list
					          $(this).remove()
					        }
						}
	    })
	  })
	</script>
@endsection
http://jsfiddle.net/milz/fotLoLy9/