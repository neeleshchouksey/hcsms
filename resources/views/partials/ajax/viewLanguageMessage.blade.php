<table class="table table-striped table-bordered">
	<tr>
		<th width="10%">Reminder Section</th>
		<th width="10%">Message Name</th>
		<th>English Message</th>
		@if($language->id!=1)
			<th width="40%">{{$language->title}} Message</th>
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