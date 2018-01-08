@foreach($reminderServices as $reminder)
	@php
	        /**
        * Check sms message is exist in selected language or not
        *
        * @var        <type>
        */
       $smsMessage  = $reminder->languageMessage->where('language_id',$language_id)->first();

        /**
        * if sms message is not exists in 
        * patient preffered language
        * then find english language message
        * for send sms
        */
        if(empty($smsMessage)){
          /**
           * Initialize ennglish language id for 
           * language_id variable
           *
           * @var        integer
           */
          $language_id  =1;
          /**
           * get english langeuage sms type object for database
           *
           * @var        <type>
           */
          $smsMessage  = $reminder->languageMessage->where('language_id',$language_id)->first();
        }
        /**
        * get message object of preferred language
        *
        * @var        <type>
        */
       


	@endphp
<tr>
	<td>{{$reminder->name}}</td>
	<td>{{$smsMessage->message}}</td>
</tr>
@endforeach