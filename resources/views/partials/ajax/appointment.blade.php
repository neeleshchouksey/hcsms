<form role="form" class="form-horizontal" id="appointment" method="POST" action="{{url('patient-appointment')}}">
    <div id="appterrors"></div>
    {{ csrf_field() }}
    <input type="hidden" name="patient" value="{{$patient->id}}">
    <input type="hidden" name="service" value="{{$service->id}}">
    <div class="col-md-6">
        <div class="form-group">

            <label class="col-xs-4">Date</label>
            <div class="col-xs-8">
                <input type="text" id="start_date" class="form-control" name="appt_date" value="">
            </div>
        </div>
        <div class="form-group">

            <label class="col-xs-4">Time</label>
            <div class="col-xs-8">
                
                <select id="appt_time" class="form-control" name="appt_time">
                    <option value="">Selected Time</option>
                    @foreach($times as $time)
                        <option value="{{$time->id}}">{{$time->abbr}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">

            <label class="col-xs-4">Location</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="location"  value="">
            </div>
        </div>
         <div class="form-group">

            <label class="col-xs-4">With</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="with"  value="">
            </div>
        </div>
        <div class="form-group">

            <label class="col-xs-4">Include Map Link</label>
            <div class="col-xs-8">
                <div class="checkbox">
                    <label><input type="checkbox" name="map" value="1"></label>
                </div>
            </div>
        </div>
       
        <div class="form-group">

            <label class="col-xs-4">Patient Postcode</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="patient_postcode"  value="">
            </div>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <label class="col-xs-4">Location Postcode</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="location_postcode"  value="">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label>Reminders</label>
                <div class="checkbox">
                    <label><input type="checkbox" class="selectAll" checked value="">All</label>
                </div>
                @foreach($service->smsTypes as $reminders)
                    <div class="checkbox">
                        <label><input type="checkbox" class="reminders" checked name="reminders[]" value="{{$reminders->id}}">{{$reminders->label}}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <button type="button"  class="btn add-appointment btn-primary">
                    Add
                </button>
            </div>
             <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    View Messages
                </button>
            </div>
        </div>
    </div>
</form>
<div class="col-md-12">
    <h4>Appointment Message Log</h4>
    <h5>Sender Id : {{$patient->doctor->name}}</h5>
    <h5>Appointments:</h5>
    <table id="appointment_log_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="12%">Date </th>
                <th>Time</th>
                <th>With</th>
                <th>Location</th>
                <th>Rs</th>
                <th>R7</th>
                <th>R3</th>
                <th>R1</th>
                <th>R0</th>
                <th>Action</th>
         
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            @php
                $reminders =  explode(',',$appointment->reminders);
            @endphp
            <tr>
                <td width="12%">{{$appointment->appt_date}}</td>
                <td>{{$appointment->apptTimeData->title}}</td>
                <td>{{$appointment->with}}</td>
                <td>{{$appointment->location}}</td>
                @foreach($service->smsTypes as $serviceReminders)
                    @php
                        $checked ='';
                        if(in_array($serviceReminders->id,$reminders)){
                            $checked = 'checked';
                        }
                    @endphp
                    <td><input type="checkbox" disabled {{$checked}} ></td>
                @endforeach
                <td><a href="javascript:void(0);" class="editAppointment" action="{{url('patient-appointment/'.$appointment->id.'/edit')}}">Edit</a> <a>view log</a> <a href="">Cancel</a></td>
         
            </tr>
            @endforeach
          
        </tbody>
        
    </table>
</div>