<div class="col-md-12">
    <div id="myfirstchart"></div>
</div>
<div class="col-md-12">
    <table class="table table-bordered">
        <tr>
            <td>Average (all times)</td>
            <td>{{$averages->allTimeAverage}}</td>
            <td> </td>
        </tr>
        <tr>
            <td>Latest Reading</td>
            <td>{{$averages->latestReading}}</td>
            <td>{{$latestReading->created_at->format('d-m-Y H:i')}}</td>
        </tr>
        
    </table>

    <h5>Averages</h5>

    <table class="table table-bordered">
        <tr>
            <td>Last 5 reading</td>
            <td>{{$averages->lastFiveReading}}</td>
            <td>Last 5 days</td>
            <td> {{$averages->lastFiveDays}}</td>
        </tr>
        <tr>
            <td>Last 10 Readings</td>
            <td>{{$averages->lastTenReading}}</td>
            <td>Last 10 Days</td>
             <td> {{$averages->lastTenDays}}</td>
        </tr>
        <tr>
            <td>Last 20 Readings</td>
            <td>{{$averages->lastTwenReading}}</td>
            <td>Last 20 days</td>
            <td> {{$averages->lastTwenDays}}</td>
        </tr>
        <tr>
            <td>Last 30 Readings</td>
            <td>{{$averages->lastThirReading}}</td>
            <td>Last 30 days</td>
             <td> {{$averages->lastThirDays}}</td>
        </tr>
    </table>
    @if($patientService->service_id==1)

      <table id="" class="table table-bordered table-striped">
         <thead>
            <tr>
                <th>Date </th>
                <th>Morning</th>
                <th>Evening</th>
                <th>Average</th>
              </tr>
            </thead>
            <tbody>
              @foreach($patientService->receiveMessage()->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as cdate"))->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))->get() as $minmax)
                @php
                  $morningReading     =   $patientService->receiveMessage()
                                          ->select(DB::raw('(min(bg_number)+min(sm_number)) as reading,body,bg_number,sm_number'))
                                          ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"),$minmax->cdate)

                                          ->whereHas('remindMessage',function($q){
                                              $q->where('time_id','<=',6);
                                          })
                                          ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))->first();

                  $eveningReading          =   $patientService->receiveMessage()
                                          ->select(DB::raw('(min(bg_number)+min(sm_number)) as reading,body,bg_number,sm_number'))
                                          ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"),$minmax->cdate)
                                          
                                          ->whereHas('remindMessage',function($q){
                                              $q->where('time_id','>',6);
                                          })
                                          ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))->first();
                  $mreading     = '';
                  $ereading     = '';
                  if($morningReading){
                    $mreading = $morningReading->body;

                  } 
                  else{
                    $mreading   = "";
                  }
                  if($eveningReading){
                    $ereading = $eveningReading->body;
                    
                  } 
                  else{
                    $ereading   = "";
                  }
                  if($morningReading && $eveningReading){
                    $baverageReading = ceil(($morningReading->bg_number+$eveningReading->bg_number)/2);
                    $saverageReading =  ceil(($morningReading->sm_number+$eveningReading->sm_number)/2);
                    $averageReading   = $baverageReading.' '.$saverageReading;


                  }
                  else if($morningReading){
                    $baverageReading = ($morningReading->bg_number);
                    $saverageReading = ($morningReading->sm_number);
                    $averageReading   = $baverageReading.' '.$saverageReading;
                  }
                  else if($eveningReading){
                    $baverageReading = ($eveningReading->bg_number);
                    $saverageReading = ($eveningReading->sm_number);
                    $averageReading   = $baverageReading.' '.$saverageReading;
                  }
                  else{
                    $averageReading = "";
                  }
                @endphp
                <tr>
                  <td>{{date('D d-m',strtotime($minmax->cdate))}}</td>
                  <td>{{$mreading}}</td>
                  <td>{{$ereading}}</td>
                  <td>{{ $averageReading}}</td>
                </tr>
              @endforeach
            </tbody>
      </table>
    @endif
    <table id="serviceHistoryTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date </th>
                <th>Time</th>
                <th>Reading</th>

                @if(request()->is('patient-service')==1)

                    <th>Note</th>
                    <th>Included</th>
                    
                @endif
               
                
                
         
            </tr>
        </thead>
        <tbody>
            @php
                $data       =   array();
                $i          =   1;
                $disabled   =   '';

                if(request()->is('history/*')==1)
                 $disabled = 'disabled';
             
            @endphp
            @foreach($patientService->receiveMessage()->orderBy('created_at','ASC')->get() as $message)
                @php
                    /* define empty variable*/
                    $selectIncluded     =   '';

                    /* check if included value is one or not*/
                    if($message->included=1)
                        $selectIncluded = 'checked';

                @endphp
                <tr>
                    <td>{{$message->created_at->format('d-m-Y')}}</td>
                    <td>{{$message->created_at->format('H:i')}}</td>
                    <td>{{$message->body}}</td>

                    @if(request()->is('patient-service')==1)

                        <td>{{$message->remindMessage->parentSmsType->label}}</td>
                    
                        <td><input type="checkbox" class="excludedMesssage" {{$selectIncluded}} value="{{$message->message_id}}"  {{$disabled}}></td>

                    @endif
                </tr>
                @php
                    if($message->included==1):
                        if($patientService->service_id==1):

                            $labels   =   array('SYS','DIa');
                            $ykeys    =   array('bg_number','sm_number');

                            $messageData =  array(
                                            'rownum'=>$i,
                                            'date'=>$message->created_at->format('d/m/Y H:i'),
                                            'bg_number'=>$message->bg_number,
                                            'sm_number'=>$message->sm_number
                                        );
                        else:

                            $messageData =  array(
                                            'rownum'=>$i,
                                            'date'=>$message->created_at->format('d/m/Y H:i'),
                                            'target'=>$message->body,
                                            
                                        );
                            $labels   =   array('SYS');
                            $ykeys    =   array('target');

                        endif;

                        array_push($data, $messageData);
                        $i++;
                    endif;
                @endphp
            @endforeach
          
        </tbody>
        
    </table>
   
</div>
@if(!empty($data))
 @php
    $data = json_encode($data);
    
    @endphp
<script type="text/javascript">
    $('#getBPHistoryModal').on('shown.bs.modal', function () {
        $( "#myfirstchart" ).empty();
        new Morris.Line({
          // ID of the element in which to draw the chart.
          element: 'myfirstchart',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: <?=$data?>,
          // The name of the data record attribute that contains x-values.
          xkey: 'date',
          // A list of names of data record attributes that contain y-values.
          ykeys: <?=json_encode($ykeys)?>,
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: <?=json_encode($labels)?>,
          lineColors: ['#3097D1','orangered'],
          parseTime:false,
          smooth:true,
          axes:"y"
          
        });
    });
   // $('#getBPHistoryModal .serviceHistory').change(function(){
          new Morris.Line({
          // ID of the element in which to draw the chart.
          element: 'myfirstchart',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: <?=$data?>,
          // The name of the data record attribute that contains x-values.
          xkey: 'date',
          // A list of names of data record attributes that contain y-values.
          ykeys: <?=json_encode($ykeys)?>,
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: <?=json_encode($labels)?>,
          lineColors: ['#3097D1','orangered'],
         parseTime:false,
         smooth:true,axes:"y"
          
        });
   // });
</script>
@endif