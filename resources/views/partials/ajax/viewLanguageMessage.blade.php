<table class="table table-striped table-bordered">
	<tr>
		<th>Reminder Section</th>
		<th>Message Name</th>
		<th>English Message</th>
		@if($language->id!=1)
			<th>{{$language->title}} Message</th>
		@endif
		
		
	</tr>
	@foreach($smsTypes as $sms)
		@php
			$defaultLanguage 		=	$sms->languageMessage()->where('language_id',1)->first();
			$selectedLanguage 		=	$sms->languageMessage()->where('language_id',$language->id)->first();
			$textMessage 			= 	'Translation Pending';
			
			if(!empty($selectedLanguage))
				$textMessage 		=	$selectedLanguage->message;
		@endphp
		<tr>
			<td>{{$sms->parentService->name}}</td>
			<td>{{$sms->label}}</td>
			<td>{{$defaultLanguage->message}}</td>

			@if($language->id!=1)
				<td>{{$textMessage}} </td>
			@endif
		
			
		
		</tr>
	@endforeach
</table>