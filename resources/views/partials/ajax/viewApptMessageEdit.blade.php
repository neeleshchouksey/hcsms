<table id="" class="table table-bordered table-striped">
    <thead>
        <tr>
            
            <th>Reminder</th>
            <th>English</th>
            @if($patientAppointment->patient->language_id!=1)
            	<th width="40%">{{$patientAppointment->patient->language->title}}</th>
            @endif
     
        </tr>
    </thead>
@foreach($patientAppointment->apptReminders as $reminder)
<tr>

	<td>{{$reminder->smsTypeData->label}}</td>

	<td>{{Helper::getSmsActuallMessage($patientAppointment,'appointment',$reminder->smsTypeData->name,1)}}</td>

	@if($patientAppointment->patient->language_id!=1)
		

		<td>{{Helper::getSmsActuallMessage($patientAppointment,'appointment',$reminder->smsTypeData->name,$patientAppointment->patient->language_id)}}</td>
	@endif
</tr>
@endforeach