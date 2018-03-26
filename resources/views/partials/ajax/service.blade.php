@if($service->id<4):

    <div class="col-md-6 col-sm-6 col-xs-6">
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
            @foreach($patient->reminderService()->where('service_id',$service->id)->first()->reminderDays()->orderBy('day_id','asc')->get() as $day)
                {{ucfirst($day->dayData->abbr)}}

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
            @foreach($patient->reminderService()->where('service_id',$service->id)->first()->reminderTime()->orderBy('time_id','asc')->get() as $time)
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
            mon & fri at 8am  and 7pm 
        @endif
           

    </div>
    <div class="col-md-6 col-xs-6">
        <div class="col-md-offset-6 col-md-6 col-xs-offset-6 col-xs-6 col-sm-offset-6 col-sm-6">
        <input type="checkbox" class="service-toggle pull-right" service="{{$service->id}}" patient="{{$patient->id}}" {{$checked}} data-toggle="toggle">
        </div>
        <br><br>
        @if($service->ishistory==1)
            <button class="btn btn-success pull-left col-md-6 col-sm-6  col-xs-6 getBPHistory" data-toggle="modal" service="{{$service->id}}" patient="{{$patient->id}}" >History</button>
        @endif 
       <button class="btn btn-success pull-right col-md-5 col-sm-5  col-xs-5 editService" data-toggle="modal" service="{{$service->id}}" patient="{{$patient->id}}" >Edit</button>
     </div>
@else:
        <div class="col-md-6 col-sm-6 col-xs-6">
            <h4>{{$service->name}}</h4>
            Live Appointments:{{$patient->appointments->where('status',1)->count()}}
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
           
                <button class="btn btn-success pull-right  manageService" data-toggle="modal" service="{{$service->id}}" patient="{{$patient->id}}" >Manage</button>
            
            
        </div>
@endif