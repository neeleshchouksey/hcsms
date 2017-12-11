         <style type="text/css">
         .form-group {
    margin-top: 20px;
}
.custom-row {
    margin: 10px;
}</style>
                <form role="form" method="POST" action="">
                    <div class="form-group">
                        <h5>When should we ask for BP readings</h5>
                        <p>On what day we should request a reading
                        <br>
                        simply select and unselect
                        </p>
                    </div>
                    
                    <input type="hidden" name="patient" class="patient" value="{{$patientService->patient_id}}">
                    <input type="hidden" name="service" class="service" value="{{$patientService->service_id}}">
                    <div class="form-group">
                        <div class="row custom-row">
                            @php
                                $i=1;
                            @endphp
                            @foreach(Helper::ReminderDays() as $day)
                                @php
                                    $activeClass="";
                                    if(in_array($day->id,$patientGetServiceDays)):
                                        $activeClass = "btn-success";
                           
                                    endif;
                                @endphp
                               
                                <div class="col-xs-3">
                                    <input type="button" class="form-control days {{$activeClass}} input-lg" name="days" data-value="{{$day->id}}" value="{{strtoupper($day->abbr)}}">
                                </div>
                                 @if($i%4==0)
                                    </div><div class="row custom-row">
                                @endif
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                      
                            @php
                                $allactive="";
                                if(count($patientGetServiceDays)>=7)
                                 $allactive = "btn-success";
                            @endphp
                            <!-- <div class="form-group"> -->
                                <div class="col-xs-3">
                                    <input type="button" class="form-control day-all {{$allactive}}  input-lg" name="days"  value="All">
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>   
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <h5>What time should we send reminders</h5>
                        <p>On what day we should request a reading
                        <br>
                        simply
                    </div>
                    <div class="form-group">
                        <div class="row custom-row">
                            @php
                                $i=1;
                            @endphp
                            @foreach(Helper::ReminderTimes() as $time)
                                @php
                                    $activeClass="";
                                    if(in_array($time->id,$patientGetServicetime)):
                                        $activeClass = "btn-success";
                                    endif;
                                @endphp
                                
                                <div class="col-xs-4">
                                    <input type="button" class="form-control input-lg time {{$activeClass}}" name="time" data-value="{{$time->id}}" value="{{strtoupper($time->abbr)}}">
                                </div>
                                @if($i%3==0)
                                    </div><div class="row custom-row">
                                @endif
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                    </div>

                     <div class="clearfix"></div>
                     <div class="form-group">
                       
                         <h5 for="" class="col-md-6">How often to send reminders: <br>Send every X WEEKS</h5>

                            <div class="col-md-6">
                                <input id="perweek" type="text" class="form-control perweek" name="perweek" value="{{$patientService->perweek}}" required >
                            </div>
                    </div><div class="clearfix"></div>
                    <div class="form-group">
                        <h5>How long do you want reminder</h5>
                    </div>
                    @php
                        $ongoingactive="";
                        if($patientService->ongoing==1)
                         $ongoingactive = "btn-success";
                    @endphp
                    <div class="form-group">
                        <div class="col-xs-6 text-center" >
                          <button class="text-center btn  ongoing {{$ongoingactive}}" style="min-height:100px;border:1px solid black;font-size:24px;padding:5%;">Ongoing</button> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6" style="margin:2% auto;">
                          <input type="text" class="form-control period input-lg" name="ongoing" value="{{$patientService->period}}">
                          <div class="col-md-12">
                            @foreach(Helper::ReminderDuration() as $duration)
                                @php
                                    $activeClass="";
                                    if($duration->id==$patientService->duration):
                                        $activeClass = "btn-success";
                                    endif;
                                @endphp
                                <input type="button" class=" btn duration {{$activeClass}}" name="duration" data-value="{{$duration->id}}" value="{{$duration->title}}">
                            @endforeach                        
                            
                        </div>
                       

                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="form-group text-center">
                        <h4>Note to doctor</h4>
                        <h6>Please ensure you show them to enter BP reading in one line Big Number SPACE Small number</h6>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group" style="margin:2% auto;">
                        <input type="button" class="btn  col-xs-6 btn-primary" style="margin:2% auto;" value="SEND TEST">
                        <input type="button" class="btn  col-xs-6 btn-primary" style="margin:2% auto;" value="RESULT LIVE">

                       
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        @php
                            $displayStart   =   $displayStop    =   "style=display:none";
                            if($patientService->status==0):
                                $displayStart   =   "style=display:block";
                            else:
                                $displayStop    =   "style=display:block";
                            endif 
                        @endphp
                            <div class="startParent" {{$displayStart}}>
                                <h5 class="col-md-3">Start Date</h5>
                                <div class="col-md-3">
                                    <input id="start_date" type="text" class="form-control start_date" name="start_date" value="" required >
                                </div>
                                <input type="button" class="btn col-xs-6  start btn-primary" value="START">
                            </div>
                            <div class="stopParent" {{$displayStop}}>
                                <input type="button" class="btn col-xs-6 col-xs-offset-3 stop btn-primary" value="STOP">
                            </div>
                        
                    </div>


                </form>