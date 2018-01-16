
<form class="form-horizontal" action="">
    <input type="hidden" name="service"  class="service" value="{{$service}}">
    <input type="hidden" name="language"  class="language" value="{{$language->id}}">

    <div class="form-group">
        <label class="col-sm-2" for="email">Sms Types</label>
        @if($language->id!=1)
            <label class="col-sm-5" for="email">English</label>
            <label class="col-sm-5" for="email">{{$language->title}}</label>
        @else
            <label class="col-sm-10" for="email">{{$language->title}}</label>
        @endif
       
    </div>
    @foreach($serviceSmsTypes as $message)
        @php
            $languageMessage            =   $message->languageMessage()->where('language_id',$language->id)->first();
            $defaultLanguageMessage     =   $message->languageMessage()->where('language_id',1)->first();
            $textMessage = '';
            $smsUserAdded = '';
            if(!empty($languageMessage)):
                $textMessage = $languageMessage['message'];
                if($languageMessage['role']==2)
                    $smsUserAdded  =  $languageMessage->smsUser;

            endif;

            $defaultTextMessage = '';
            if(!empty($defaultLanguageMessage))
                $defaultTextMessage = $defaultLanguageMessage['message'];
        @endphp

    
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">{{$message->label}}:</label>
            @if($language->id!=1)
                <div class="col-sm-5">
                    <textarea  class="form-control" readonly>{{$defaultTextMessage}}</textarea>
                    
                </div>
                <div class="col-sm-5">
                    <textarea  class="form-control smsLangMessage" data-smslang="{{$message->id}}" name="smsMessage[{{$message->name}}]">{{$textMessage}}</textarea>
                    @if(!empty($smsUserAdded))
                        Added by: {{$smsUserAdded->name}}, on {{$languageMessage->created_at->format('d-m-Y')}},
                        @if($languageMessage->verified_by==0) 
                            <span class="verified_by"> 
                                Verify : <input type="checkbox" class="languageMessageVerify" value="{{route('sms-language-message.update',$languageMessage->id)}}">
                            </span>
                        @else
                            Verified by: {{$languageMessage->adminUser->name}}
                        @endif
                    @endif
                </div>
            @else
                <div class="col-sm-10">
                    <textarea  class="form-control smsLangMessage" data-smslang="{{$message->id}}" name="smsMessage[{{$message->name}}]">{{$textMessage}}</textarea>
                    
                </div>
                
                    
               
            @endif
        </div>
    @endforeach
  
</form>