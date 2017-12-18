
<form class="form-horizontal" action="">
    <input type="hidden" name="service"  class="service" value="{{$service}}">
    <input type="hidden" name="language"  class="language" value="{{$language}}">
    @foreach($serviceSmsTypes as $message)
        @php
            $languageMessage    =   $message->languageMessage()->where('language_id',$language)->first();
            $textMessage = '';
            if(!empty($languageMessage))
                $textMessage = $languageMessage['message'];
        @endphp
       
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">{{$message->label}}:</label>
            <div class="col-sm-10">
                <textarea  class="form-control smsLangMessage" data-smslang="{{$message->id}}" name="smsMessage[{{$message->name}}]">{{$textMessage}}</textarea>
                
            </div>
        </div>
    @endforeach
  
</form>