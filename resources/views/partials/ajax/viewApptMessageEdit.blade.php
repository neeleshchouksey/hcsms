@foreach($patientAppointment->apptReminders as $reminder)
<tr>

	
	
	
	<td>{{$reminder->smsTypeData->label}}</td>

	<td>{{Helper::getSmsActuallMessage($patientAppointment,'appointment',$reminder->smsTypeData->name,$patientAppointment->patient->language_id)}}</td>


</tr>
@endforeach