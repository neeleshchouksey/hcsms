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
                    
                    @foreach(Helper::ReminderDays() as $day)
                        @php
                            $activeClass="";
                            if(in_array($day->id,$patientGetServiceDays)):
                                $activeClass = "btn-success";
                   
                            endif;
                        @endphp
                        <div class="form-group">
                            <div class="col-xs-3">
                                <input type="button" class="form-control days {{$activeClass}} input-lg" name="days" data-value="{{$day->id}}" value="{{strtoupper($day->abbr)}}">
                            </div>
                        </div>
                        
                    @endforeach
                    <div class="form-group">
                        <div class="col-xs-3">
                            <input type="button" class="form-control day-all  input-lg" name="days"  value="All">
                        </div>
                    </div>
                       
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <h5>What time should we send reminders</h5>
                        <p>On what day we should request a reading
                        <br>
                        simply
                    </div>
                     @foreach(Helper::ReminderTimes() as $time)
                        @php
                            $activeClass="";
                            if(in_array($time->id,$patientGetServicetime)):
                                $activeClass = "btn-success";
                            endif;
                        @endphp
                        <div class="form-group">
                            <div class="col-xs-4">
                                <input type="button" class="form-control input-lg time {{$activeClass}}" name="time" data-value="{{$time->id}}" value="{{strtoupper($time->abbr)}}">
                            </div>

                        </div>

                    @endforeach
                     <div class="clearfix"></div>
                    <div class="form-group">
                        <h5>How long do you want reminder</h5>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 text-center" >
                          <div class="text-center" style="min-height:100px;border:1px solid black;font-size:24px;padding:5%;">Ongoing</div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6" style="margin:2% auto;">
                          <input type="text" class="form-control ongoing input-lg" name="ongoing" value="{{$patientService->period}}">
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
                        @if($patientService->status==0)
                            <input type="button" class="btn col-xs-6 col-xs-offset-3 start btn-primary" value="START">
                        @else
                            <input type="button" class="btn col-xs-6 col-xs-offset-3 stop btn-primary" value="STOP">
                        @endif
                    </div>

                </form>