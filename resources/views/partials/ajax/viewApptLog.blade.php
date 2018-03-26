@foreach($patientAppointment->apptReminders as $reminder)
<tr>

	@php 
		/***
		* numeric digit from reminder name
		*/
	 	$day  = 	(int) preg_replace('/\D/', '',$reminder->smsTypeData->name);

	 	/***
	 	* change appointment date format
	 	*/
	 	$date = DateTime::createFromFormat('d/m/Y', $patientAppointment->appt_date);

     	$date = $date->format('Y-m-d');

     	/***
     	* substract reminder name numeric digit
     	* day from appointment date and find 
     	* remider sent date
     	*/
	 	$reminderDate = \Carbon\Carbon::parse($date)->subDay($day)->format('d/m/Y');

	 	/***
	 	* check reminder status 
	 	* if status is 3 then find
	 	* find reminder send date form
	 	* reminder sent log
	 	*/
	 	if($reminder->status==3){

	 		/***
	 		* find latest message of send reminder
	 		* in send reminder log
	 		*/
	 		$reminderMessage = $patientAppointment->reminderMessage()->where('sms_type_id',$reminder->reminder_id)->latest()->first();
	 	
	 		/***
	 		* if reminder sms log is not emty
	 		* then set reminder sms log created date
	 		* reminder date
	 		*/
	 		if(!empty($reminderMessage))
	 			$reminderDate = $reminderMessage->created_at->format('d/m/Y');
	 	}
	 	/***
	 	* else check if reminder id equals to 34 and
	 	* status is equal to not active then set reminder
	 	* create date as reminder sent date
	 	*/
	 	elseif($reminder->status==2 && $reminder->reminder_id==34)
	 		$reminderDate = $reminder->created_at->format('d/m/Y');
	@endphp

	<td>{{$reminderDate}}</td>
	
	<td>{{date('H:i A',strtotime($patientAppointment->appt_time))}}</td>
	
	<td>{{$reminder->smsTypeData->label}}</td>

	<td>{{Helper::getSmsActuallMessage($patientAppointment,'appointment',$reminder->smsTypeData->name,$patientAppointment->patient->language_id)}}</td>

	<td>{{$reminder->statusData->name}}</td>
</tr>
@endforeach