<div class="col-md-7">
    <h4>{{$service->name}}</h4>
    Remindar set for
    @php
        $checked= "";

    @endphp 

    @if($patient->reminderService()->where('service_id',$service->id)->exists()==1)

        @php
            
            if($patient->reminderService()->where('service_id',$service->id)->first()->status==1):
                $checked = 'checked';
            else:
                $checked = '';
            endif;

            $dayCount = $patient->reminderService()->where('service_id',$service->id)->first()->reminderDays()->count();
            $i=0;
        @endphp
        @foreach($patient->reminderService()->where('service_id',$service->id)->first()->reminderDays as $day)
            {{$day->dayData->abbr}}

            @php
                if($i==$dayCount-2 ):
                    echo "&";
                elseif($i<$dayCount && $i!=$dayCount-1):
                    echo ","; 
                endif;
                $i++;
            @endphp
        @endforeach
        at 
        @php
            $timeCount = $patient->reminderService()->where('service_id',$service->id)->first()->reminderTime()->count();
            $i=0;
        @endphp
        @foreach($patient->reminderService()->where('service_id',$service->id)->first()->reminderTime as $time)
            {{$time->timeData->title}} 
             @php
               
                if($i==$timeCount-2 ):
                    echo "and";
                elseif($i<$timeCount && $i!=$timeCount-1):
                    echo ","; 
                endif;
                $i++;
            @endphp
        @endforeach
    @else
        mon & fri at 8:00 Am  and 7:00 PM 
    @endif
       

</div>
<div class="col-md-offset-2 col-md-3">
    <input type="checkbox" class="service-toggle" service="{{$service->id}}" patient="{{$patient->id}}" {{$checked}} data-toggle="toggle"><br><br>
    <button class="btn btn-success  editService" data-toggle="modal" service="{{$service->id}}" patient="{{$patient->id}}" >Edit</button>
 </div>