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
            <td>{{$latestReading->bg_number.'/'.$latestReading->sm_number}}</td>
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
    <table id="serviceHistoryTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date </th>
                <th>Time</th>
                <th>Reading</th>
                <th>Note</th>
                <th>Included</th>
                
                
         
            </tr>
        </thead>
        <tbody>
            @php
                $data  = array();
                $i=1;
            @endphp
            @foreach($patientService->receiveMessage()->orderBy('created_at','ASC')->get() as $message)
                <tr>
                    <td>{{$message->created_at->format('d-m-Y')}}</td>
                    <td>{{$message->created_at->format('H:i')}}</td>
                    <td>{{$message->body}}</td>
                    <td>{{$message->remindMessage->parentSmsType->label}}</td>
                    <td><input type="checkbox" class="excludedMesssage" ></td>
                </tr>
                @php
                    $messageData =  array(
                                        'rownum'=>$i,
                                        'date'=>$message->created_at->format('d/m/Y H:i'),
                                        'bg_number'=>$message->bg_number,
                                        'sm_number'=>$message->sm_number
                                    );

                    array_push($data, $messageData);
                    $i++;
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
          ykeys: ['bg_number','sm_number'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['SYS', 'DIA'],
          lineColors: ['#3097D1','orangered'],
         parseTime:false,
         smooth:true,axes:"y"
          
        });
    });
</script>
@endif