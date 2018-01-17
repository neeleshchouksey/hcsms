<table class="table table-striped table-bordered">
	<tr>
		<th>Reminder Section</th>
		<th>Message Name</th>
		<th width="30%">English Message</th>
		
		<th width="30%">{{$language->title}} Message</th>
		<th>Action</th>
		
	</tr>
	@foreach($smsTypes as $sms)
		@php
			$defaultLanguage 		=	$sms->languageMessage()->where('language_id',1)->first();
					
		@endphp
		<tr>
			<td>{{$sms->parentService->name}}</td>
			<td>{{$sms->label}}</td>
			<td>{{$defaultLanguage->message}}</td>
			
			<td class="languageData">
				
				<textarea name="message" class="input form-control"></textarea>
				<input name="service_id"  type="hidden" class="input" value="{{$sms->parentService->id}}"/>
				<input name="language_id" type="hidden" class="input" value="{{$language->id}}"/>
				<input name="sms_type_id" type="hidden" class="input" value="{{$sms->id}}"/>
				<input name="action" type="hidden" class="input" value="addLanguageMessage"/>
			</td>
			<td>
				<button class="btn btn-success saveLanguageMessage">Save</button>
			</td>
		
		</tr>
	@endforeach
</table>