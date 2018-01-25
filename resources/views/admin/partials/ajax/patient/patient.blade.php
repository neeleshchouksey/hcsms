<table class="table table-bordered table-striped">
                        
   
    <tr>
        <td width="20%">Patient Reference</td>
        <td >{{$patient->code}}</td>
    </tr>
    <tr>
        <td>Patient Name</td>
        <td >{{$patient->name}}</td>
    </tr>
    <tr>
        <td>Mobile Number</td>
        <td >{{$patient->mobile}}</td>
    </tr>
    <tr>
        <td>Post Code</td>
        <td >{{$patient->code}}</td>
    </tr>
    
    <tr>
        <td>Language</td>
        <td >{{$patient->language->title}}</td>
    </tr>
    <tr>
        <td>Notes</td>
        <td >{{$patient->note}}</td>
    </tr>
   
</table>
@php
    $services   = $patient->reminderService()->where('status',1)->get();
@endphp
@if(count($services)!=0)
    <table class="table table-bordered table-striped">
        <tr>
            <th>Services</th>
            <th>Days & Times</th>
            <th>Action</th>
        </tr>
        @foreach($services as $service)
            <tr>
                <td>{{$service->serviceData->name}}</td>
                <td>
                    Remindar set for
                    @php
                        $checked= "";

                    @endphp 


                    @php
                        
                       

                        $dayCount = $service->reminderDays()->count();
                        $i=0;
                    @endphp
                    @foreach($service->reminderDays()->orderBy('day_id','asc')->get() as $day)
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
                        $timeCount =$service->reminderTime()->count();
                        $i=0;
                    @endphp
                    @foreach($service->reminderTime()->orderBy('time_id','asc')->get() as $time)
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
                   
                </td>
                <td>
                    <a href="javascript:void(0);" class="editReminderPopup" service="{{$service->service_id}}" patient="{{$service->patient_id}}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
@endif