 <div class='exampleCalendar'></div>   
<script>

@if($requestType==1)
    var repeatingEvents = {{Helper::getPatientScheduledMessages($patient)}};
@else
    var repeatingEvents = {{Helper::getPatientScheduledMessages($patientService->patient,$services)}};
@endif

//emulate server
var getEvents = function( start, end ){
    return repeatingEvents;
}

$('.exampleCalendar').fullCalendar({
    defaultDate: moment(),
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    },
    defaultView: 'month',
    minTime: '08:00',
    maxTime: '22:00',
     duration: { week: 2 },
    eventRender: function(event, element, view){
        if(event.repeats==1){
            console.log(event.start.format());
            var theDate = event.start.format('YYYY-MM-DD');
            var excludedDate = event.startDate;
            var excludedTomorrrow = new Date(excludedDate);
            var totalWeeks = moment(theDate).diff(moment(excludedDate), 'weeks');
            var totalDays = moment(theDate).diff(moment(excludedDate), 'days');
            if(totalDays<0){
                return false;
            }
            
            if(totalWeeks%event.repeat_freq!=0)
                return false;
             //if the date is in between August 29th at 00:00 and August 30th at 00:00 DO NOT RENDER
          
                return (event.ranges.filter(function(range){
                    return (event.start.isBefore(range.end) &&
                            event.end.isAfter(range.start));
                }).length)>0;
        }
    },
    events: function( start, end, timezone, callback ){
        var events = getEvents(start,end); //this should be a JSON request
        
        callback(events);
    },
});
</script>
