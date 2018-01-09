@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>
                <div class="panel-body">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title pull-left">Appointments</h3>
             
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td width="40%">Practice Name</td>
                                    <td>{{$patient->doctor->name}}</td>
                                </tr>
                                 <tr>
                                    <td>Practice Address</td>
                                    <td>{{$patient->doctor->address}}</td>
                                </tr>
                                 <tr>
                                    <td>Practice Contact Number</td>
                                    <td>{{$patient->doctor->contact}}</td>
                                </tr>
                            </table>
                            <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th>Time</th>
                                        <th>Location</th>
                                        <th>With</th>
                                        <th>Options</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patient->appointments()->where('status',1)->get() as $appointment)

                                        <tr>
                                            <td>{{$appointment->appt_date}}</td>
                                            <td>{{$appointment->timeData->abbr}}</td>
                                            <td>{{$appointment->location}}</td>
                                            <td>{{$appointment->with}}</td>
                                            <td>
                                                @if($appointment->location_code!='')
                                                <a href="https://www.google.com/maps/search/?api=1&query={{$appointment->location_code}}">Map</a>
                                                @endif
                                                @if($appointment->location_code!='' && $appointment->patient_code!='')
                                                    |  <a href="https://www.google.com/maps/dir/?api=1&origin={{$appointment->patient_code}}&destination={{$appointment->location_code}}&travelmode=car">Direction</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                      
                                </tbody>
                    
                            </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

 
@endpush
@endsection
