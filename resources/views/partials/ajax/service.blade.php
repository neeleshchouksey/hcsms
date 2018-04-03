@if($service->id<4)
   
        <div class="img_section hidden-xs hidden-sm">
            <div class="icon_wrapper_event">
                <i class="fa fa-star-o" aria-hidden="true"></i>
            </div>
            <div class="img_wrapper1">

                <img src="{{asset('images/'.$service->image)}}" alt="img" class="img-responsive">
            </div>
            <div class="event_icon1">
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

                    @endphp
                @endif
                <h2>
                    <a href="#">{{$service->name}}</a> 
                    <div class="pull-right med_rightmargin20">
                    <input type="checkbox" class="service-toggle " service="{{$service->id}}" patient="{{$patient->id}}" {{$checked}} data-toggle="toggle">
                </div>
                </h2>
               
               <p>  Remindar set for</p>
                <p>
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    On

                    @if($patient->reminderService()->where('service_id',$service->id)->exists()==1)

                        @php
                            
                           
                            $dayCount = $patient->reminderService()->where('service_id',$service->id)->first()->reminderDays()->count();
                            $i=0;
                        @endphp
                        @foreach($patient->reminderService()->where('service_id',$service->id)->first()->reminderDays()->orderBy('day_id','asc')->get() as $day)
                            {{ucfirst($day->dayData->title)}}

                            @php
                                if($i==$dayCount-2 ):
                                    echo "&";
                                elseif($i<$dayCount && $i!=$dayCount-1):
                                    echo ","; 
                                endif;
                                $i++;
                            @endphp
                        @endforeach
                       
                    @else
                        Monday & Friday
                    @endif
                       
                </p>
                <p>
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                     at 
                    @if($patient->reminderService()->where('service_id',$service->id)->exists()==1)
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
                         8am  and 7pm 
                    @endif
                </p>
                <p>
                    @if($service->ishistory==1)
                        <a class=" getBPHistory" data-toggle="modal" service="{{$service->id}}" patient="{{$patient->id}}" >History|</a>

                    @endif 
                    <a class="editService" data-toggle="modal" service="{{$service->id}}" patient="{{$patient->id}}" >Edit</a>
                </p>
            </div>
        </div>
   
    
   
@else
    
        <div class="img_section hidden-xs hidden-sm position-relative">
            <div class="icon_wrapper_event">
                <i class="fa fa-star-o" aria-hidden="true"></i>
            </div>
            <div class="img_wrapper1">

                <img src="{{asset('images/'.$service->image)}}" alt="img" class="img-responsive">
            </div>
            <div class="event_icon1">
                <h2>
                    <a href="#">{{$service->name}}</a> 
                    <button class="btn btn-success pull-right med_rightmargin20 manageService" data-toggle="modal" service="{{$service->id}}" patient="{{$patient->id}}" >Manage</button>
                </h2>
               <p> Upcomming events</p>
                @foreach($patient->appointments()->where('status',1)->limit(4)->get() as $appointment)
                    <p><i class="fa fa-calendar-o" aria-hidden="true"></i> {{$appointment->appt_date}} with {{$appointment->with}}</p>
                @endforeach
               
            </div>
             <div class="event_bottom_wrapper">
                   <span>{{$patient->appointments()->where('status',1)->count()}} Appointments Due</span>
                                                <a href="#" class="pull-right">View All <i class="fa fa-long-arrow-right"></i></a>
                                                </div>
        </div>
    
@endif