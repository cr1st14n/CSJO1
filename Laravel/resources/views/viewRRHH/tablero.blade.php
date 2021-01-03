@extends('layouts.recHumLay')
@section('head1')
@endsection
@section('refUbi')
    <ol class="breadcrumb">
        <li><a href="#">Tablero</a></li>
        <li class="active">Inicio</li>
    </ol>
@endsection
@section('content')
<div id="main">
				<div class="tabbable">
						
						<div class="tab-content">
								<div class="row">
								
										<div class="col-lg-8" >
												<div id="calendar"></div>
										</div>
										<!-- //content > row > col-lg-8 -->
										
										<div class="col-lg-4">
												
												<hr>
														<a class="btn btn-inverse" data-toggle="modal" href="#md-add-event"><i class="fa fa-plus"></i></a>
														<button class="btn btn-inverse slide-trash"><i class="fa fa-trash-o"></i></button>
										</div>
										<!-- //content > row > col-lg-4 -->
										
								</div>
								<!-- //content > row-->
						</div>
						<!-- //tab-content -->
				</div>
				<!-- //tabbable -->
				

		</div>
@endsection
@section('scripts')
    <!-- <script type="text/javascript" src="{{ asset('/asincrono/recHum.js') }}"></script> -->
    <script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.js')}}"></script>
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet" />
    <script>
	$(document).ready(function() {	

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$("#addEvent").submit(function(event){
			event.preventDefault();
			if($("#event_title").val()){
				var events=$('<span class="external-event  label" data-color="'+$("#color_select").val()+'">'+$("#event_title").val() +'</span>');
				events.css({'background-color': $("#color_select").val() || "#CCC" , 'margin-right': "3px"});
				$("#external-events").append(events);
				$("#external-events span.external-event").draggable({
					zIndex: 999,
					revert: true,     
					revertDuration: 0 ,
					drag: function() { $("#slide-trash").addClass("active") },
					stop: function() { $("#slide-trash").removeClass("active") }
				});
				$(this)[0].reset();
				$('#md-add-event').modal('hide');
			}else{
				$.notific8('Please enter <strong>event  title</strong> ',{ life:5000, theme:"danger" ,heading:"ERROR :);" });
				$("#event_title").focus();
			}
		});
		$('#external-events span.external-event').draggable({
				zIndex: 999,
				revert: true,     
				revertDuration: 0 ,
				drag: function() { $("#slide-trash").addClass("active") },
				stop: function() { $("#slide-trash").removeClass("active") }
		});
		
	    $( "#slide-trash" ).droppable({
		 accept: "#external-events span.external-event , .fc-event",
		 hoverClass: "active-hover",
		 drop: function( event, ui ) {
			 ui.draggable.remove();
			 $(this).removeClass( "active" );
		 }
	    });
		var isElemOverDiv = function(draggedItem, dropArea) {
			// Prep coords for our two elements
			var a = $(draggedItem).offset;	
			a.right = $(draggedItem).outerWidth + a.left;
			a.bottom = $(draggedItem).outerHeight + a.top;
			
			var b = $(dropArea).offset;
			a.right = $(dropArea).outerWidth + b.left;
			a.bottom = $(dropArea).outerHeight + b.top;
		
			// Compare
			if (a.left >= b.left
				&& a.top >= b.top
				&& a.right <= b.right
				&& a.bottom <= b.bottom) { return true; }
			return false;
		}
		$('#calendar').fullCalendar({
/*			    eventClick: function(calEvent, jsEvent, view) {
			
				  alert('Event: ' + calEvent._id);
				  alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
				  alert('View: ' + view.name);
				$(this).fullCalendar('removeEvents',calEvent._id);
				  // change the border color just for fun
				//  $(this).css('border-color', 'red');
			
			    },*/
			eventDragStop: function(event, jsEvent, ui, view) {			
				var x = isElemOverDiv(ui, $('#slide-trash'));
				alert(x);			
				if (x) {
					alert("delete");
					$('#calendar').fullCalendar('removeEvents', event.id);
				}			
			},
			header: {
				left: 'title',
				center: '',
				right: ''
			},
			editable: true,
			droppable: true, 
			events: [
				{
					title: 'despedida',
					start: new Date(y, m, 1),
					end: new Date(y, m, 2),
					color:"#f37864"
				},
				{
					title: 'promocion',
					start: new Date(y, m, d-10),
					end: new Date(y, m, d-7),
					color:"#1bc6b0"
				},
				{
					title: 'tiraje',
					start: new Date(y, m, d, 10, 30),
					allDay: false,
					color:"#7ace30"
				},
				{
					title: 'cumpleaños',
					start: new Date(y, m, d-5, 19, 0),
					end: new Date(y, m, d-4, 22, 30),
					allDay: false,
					color:"#ffcc33"
				},
				{
					title: 'casiyta',
					start: new Date(y, m, d, 12, 15),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					color:"#62707d"
				}
			],
			drop: function(date, allDay) { 
                        var  copiedEventObject = {
                                title: $(this).text(),
                                start: date,
                                allDay: allDay,
                                color: $(this).css('background-color')
                            };
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				$(this).remove();
			}
		});
		$(".change-view").click(function(){
			 var data=$(this).data();
			$('#calendar').fullCalendar( 'changeView', data.view ); 
		});
		$(".change-today").click(function(){
			$('#calendar').fullCalendar( 'today' );
		});
		$(".change").click(function(){
			  var data=$(this).data();
			$('#calendar').fullCalendar( data.change );
		});
		
	});

</script>
@endsection
