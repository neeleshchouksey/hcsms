<form role="form" class="form-horizontal" id="appointment" method="POST" action="{{url('patient-appointment/'.$patientAppointment->id)}}">
    <div id="appterrors"></div>
    {{ csrf_field() }}
    
    <input type="hidden" name="patient" value="{{$patientAppointment->patient->id}}">
    <input type="hidden" name="service" value="{{$patientAppointment->serviceData->id}}">

    <input type="hidden" name="_method" value="put">

    <div class="col-md-6">
        <div class="form-group">

            <label class="col-xs-4">Date</label>
            <div class="col-xs-8">
                <input type="text" id="start_date" class="form-control" name="appt_date" value="{{$patientAppointment->appt_date}}">
            </div>
        </div>
        <div class="form-group">

            <label class="col-xs-4">Time</label>
            <div class="col-xs-8">
                
                <input type="text" id="end_date" class="form-control" name="appt_time" value="{{$patientAppointment->appt_time}}">
            </div>
        </div>
        <div class="form-group">

            <label class="col-xs-4">Location</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="location"  value="{{$patientAppointment->location}}">
            </div>
        </div>
         <div class="form-group">

            <label class="col-xs-4">With</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="with"  value="{{$patientAppointment->with}}">
            </div>
        </div>
       <!--  <div class="form-group">

            <label class="col-xs-4">Include Map Link</label>
            <div class="col-xs-8">
                <div class="checkbox">
                    @php
                        $checked    =  '';
                        if($patientAppointment->map_link==1)
                            $checked    =  'checked';
                    @endphp
                    <label><input type="checkbox" name="map" {{$checked}} value="1"></label>
                </div>
            </div>
        </div> -->
       
        <div class="form-group">

            <label class="col-xs-4">Patient Postcode</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="patient_postcode"  value="{{$patientAppointment->patient_code}}">
            </div>
        </div>
        
    </div>
    <div class="col-md-6">

        <div class="form-group">

            <label class="col-xs-4">Location Postcode</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="location_postcode"  value="{{$patientAppointment->location_code}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label>Reminders</label>
                @php
                    $getReminder    =       explode(',',$patientAppointment->reminders);
                    $aptReminderCount =     $patientAppointment->apptReminders->whereIn('status',[1,3])->count();
                    $reminderCount  =       $patientAppointment->serviceData->smsTypes()->where('is_reminder',1)->count();
                    $allChecked     =       '';
                    if($aptReminderCount==$reminderCount)
                        $allChecked     =       'checked';
                @endphp
                <div class="checkbox">
                    <label><input type="checkbox" class="selectAll" {{$allChecked}} value="">All</label>
                </div>

                @foreach($patientAppointment->apptReminders as $reminders)
                    @php
                        $checked     =       '';
                        if($reminders->status==1 || $reminders->status==3)
                            $checked     =       'checked'; 
                    @endphp
                    <div class="checkbox">
                        <label><input type="checkbox" class="reminders" {{$checked}} name="reminders[]" value="{{$reminders->reminder_id}}">{{$reminders->smsTypeData->label}}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <button type="button"  class="btn add-appointment btn-primary">
                    Save
                </button>
            </div>
             <div class="col-md-6">
                <button type="submit" action="{{url('appt-reminder-services/'.$patientAppointment->serviceData->id.'/'.$patientAppointment->patient->id)}}" class="btn view-reminder-messages btn-primary">
                    View Messages
                </button>
            </div>
        </div>
    </div>
</form>
