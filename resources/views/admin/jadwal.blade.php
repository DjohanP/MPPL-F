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
		<div class="col-md-11">
			<div class="box box-primary">
				<div class="box-body no-padding">
					<div id="calendar"></div>
	            </div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                	<h4 class="modal-title">Default Modal</h4>
              	</div>
              	<form method="post" action="{{url('/kelolajadwal')}}">
	              	<div class="modal-body">
	                	<div class="form-group">
	                    	<label>Lokasi Lapangan</label>
	                      	<select class="form-control" name="lokasi_lapangan" required>
	                      		<option selected value="-1" disabled>Pilih Lokasi Lapangan</option>
	                      		@foreach($all_lokasi as $x)
	                      			<option value="{{$x->id}}">{{$x->nama_lokasi}}</option>
	                      		@endforeach
	                      	</select>
	                  	</div>
	                    <input type="text" id="tggl" name="tanggal" hidden />
	                  	<div class="form-group">
	                    	<label>Jam Mulai</label>
	                      	<input type="time" class="form-control" name="mulai" required />
	                  	</div>
	                  	<div class="form-group">
	                    	<label>Jam Akhir</label>
	                      	<input type="time" class="form-control" name="akhir" required />
	                  	</div>
	                	{{csrf_field()}}
	              	</div>
	              	<div class="modal-footer">
	                	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	                	<button type="submit" class="btn btn-primary">Save changes</button>
	              	</div>
              	</form>
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
	      		@foreach($all_jadwal as $x)
	      			{
				        title          : '{{App\lokasi::find($x->lokasi_id)->nama_lokasi}} berakhir {{$x->akhir}}',
				        start          : new Date({{substr($x->tanggal,0,4)}},{{substr($x->tanggal,5,2)-1}}, {{substr($x->tanggal,8,2)}},{{substr($x->mulai,0,2)}},0),
				        end            : new Date({{substr($x->tanggal,0,4)}},{{substr($x->tanggal,5,2)-1}}, {{substr($x->tanggal,8,2)}},{{substr($x->akhir,0,2)}},0),
				        allDay         : false,
				        backgroundColor: '#f56954', //red
				        borderColor    : '#f56954' //red
		        	},
	      		@endforeach
	        // 	{
	        //   		title          : 'Click for Google',
	        //   		start          : new Date(y, m, 28),
	        //   		end            : new Date(y, m, 29),
	        //   		url            : 'http://google.com/',
	        //   		backgroundColor: '#3c8dbc', //Primary (light-blue)
	        //   		borderColor    : '#3c8dbc' //Primary (light-blue)
	        // 	}
	      	],
	      	editable  : false,
	      	droppable : false, // this allows things to be dropped onto the calendar !!!
	      	selectable: true,
            selectHelper: true,
            select: function(start, end) {
                // Display the modal.
                // You could fill in the start and end fields based on the parameters
                $('.modal').modal('show');
                document.getElementById("tggl").value = moment(start).format();
            },
	      	drop : function (date, allDay) { // this function is called when something is dropped
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