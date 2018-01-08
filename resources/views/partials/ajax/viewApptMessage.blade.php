<table id="" class="table table-bordered table-striped">
    <thead>
        <tr>
            
            <th>Reminder</th>
            <th>English</th>
            @if($language->id!=1)
            	<th width="40%">{{$language->title}}</th>
            @endif
     
        </tr>
    </thead>
    <tbody>
      
    
		@foreach($reminderServices as $reminder)

			@php
			    /**
		        * Check sms message is exist in selected language or not
		        *
		        * @var        <type>
		        */
		       $smsMessage  = $reminder->languageMessage->where('language_id',$language->id)->first();
		       $title = '';
		       if(!empty($smsMessage))
		       $title  = $smsMessage->message;
		        /**
		        * if sms message is not exists in 
		        * patient preffered language
		        * then find english language message
		        * for send sms
		        */
		       
		        $language_id  =		1;
	          	/**
	           	* get english langeuage sms type object for database
	           	*
	           	* @var        <type>
	           	*/
	          	$defaultSmsMessage  = $reminder->languageMessage->where('language_id',$language_id)->first();

			@endphp
			<tr>
				<td>{{$reminder->name}}</td>
				<td>{{$defaultSmsMessage->message}}</td>
				 @if($language->id!=1)
            		<th>{{$title}}</th>
            	@endif
			</tr>
		@endforeach
	</tbody>
    
</table>