@extends('layouts.app')

@section('content')
<style type="text/css">
.custom-border{
    border: 1px solid grey;
    padding: 5px 0px;
}
.modal-footer{
    border-top: none;
}
option.separator {
    margin-top:8px;
    border-top:1px solid #666;
    padding:0;
}
.errors {
    color:red;
}
.font-bolder{
    font-weight: bolder;
}
</style>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Patient</div>

                <div class="panel-body">
                    <div id="formerrors"></div>
                    <form class="form-horizontal" method="POST" id="patientData" action="{{ route('patient.update',$patient->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <input type='hidden' class="messagePatientLog" name="messagePatientLog" value="{{$patient->id}}"/>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-3">Patient Reference</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control patientData" name="code" value="{{ $patient->ref_code }}" required autofocus>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3  ">Patient Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control patientData" name="name" value="{{ $patient->name }}" required >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
          

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-3">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control patientData" name="mobile" value="{{ $patient->mobile }}" required >

                                @if($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-3  ">Post Code</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control patientData" name="postcode" value="{{ $patient->postcode }}"  >

                                @if ($errors->has('postcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-3">Language</label>

                            <div class="col-md-6">
                                @php
                                    $languages = Helper::languages();
                                @endphp
                                <select name="language" class="language patientData form-control">
                                    <option value="">Select Language</option>
                                    
                                    @foreach($languages as $language)
                                        @php
                                            $languageSelected='';
                                            if($language->id==$patient->language_id)
                                                $languageSelected='selected';
                                        @endphp
                                        <option value="{{$language->id}}" {{$languageSelected}}>{{$language->title}}</option>

                                    @endforeach
                                    
                                </select> 

    

                                @if($errors->has('language'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('language') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">  
                                <a href="javascript:void(0);" class="addLanguagePopup">Add</a>  
                                <span>| </span>
                                <a href="javascript:void(0);" class="viewLanguagePopup">View</a>
                            </div>
                        </div>
                        
                         
                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-3">Notes</label>

                            <div class="col-md-6">
                                <textarea id="note" type="text" class="form-control patientData" name="note"  required >{{ $patient->note }}</textarea>

                                @if($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                  
                        <div class="form-group">
                            <div class="col-md-12 ">
                                <label class="checkbox-inline">  
                                    @php 
                                        $checkedAgree ='';
                                        if($patient->agree==1)
                                        $checkedAgree = 'checked';
                                    @endphp

                                    <input id="" type="checkbox"  class="patientData" name="agree" value="1"   {{$checkedAgree}}>
                                    Please tick to confirm patient has agreed to receive reminders from HealthCheckSms
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                           <!--  <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div> -->
                        </div>
                    </form>
                    <div class="col-md-12">
                        <h3 class="pull-left">Set remindars</h3>
                        <span class="pull-right">
                            <button class="btn btn-primary view-message-dairy" patient-id="{{$patient->id}}"> 
                                View Message Diary
                            </button>
                        </span>

                    </div>
                     @php
                        $j = 1
                     @endphp

                     @foreach(Helper::serviceBasedOnPracticeType() as $service)
                     <div class="col-md-6 service_{{$service->id}} custom-border">
                            
                        @include('partials.ajax.service')
                    </div>
                    @if($j%2==0)
                        <div class="clearfix"></div>
                    @endif
                    @php
                     $j++
                    @endphp
                    @endforeach
                   
                    <div class="clearfix"></div>

                    <div class="col-md-12">
                        <h3 >Sms Logs</h3>
                        <span class="filter1 pull-right">
                            Show 
                            <input type="checkbox" id="showSentMessage"     name="showSentMessage" value="1">
                            Sent
                            <input type="checkbox" id="showReceivedMessage" name="showReceivedMessage" value="1">
                            Received
                        </span>
                        <div class="clearfix"></div>
                        <table id="message_log_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="12%">Sent </th>
                                    <!-- <th>Day</th> -->
                                    <th>To</th>
                                    <th>From</th>
                                    <th>Message</th>
                                    <th>Service</th>
                                    <!-- <th>Action</th> -->
                             
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                            
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal  fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title pull-left text-xs-center">Set Reminder</h4>
                <span class="pull-right" style="margin-right:5%;">{{$timezone}}</span>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal HTML Markup -->
<div id="replySmsModal" class="modal  fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">View Reply</h4>
            </div>
            <div class="modal-body">
              
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date </th>
                            <th>Time</th>
                            <th>To</th>
                            <th>From</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                    
                </table>
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal HTML Markup -->
<div id="getBPHistoryModal" class="modal  fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">View History
                </h4>
            </div>

            <div class="modal-body">
                
                <div class="serviceHistory">

                </div>
               
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal HTML Markup -->
<div id="manageServiceModal" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">Manage Appointments
                    <div class="pull-right" style="margin-right: 2%;">
                        <label>Sender Id:</label>
                       <!--  <input type="text" name="sender_id" class="doctorSenderId" value="{{$patient->doctor->sender_id}}"> -->
                       {{$patient->doctor->appt_sender_id}}
                    </div>
                </h4>
            </div>

            <div class="modal-body">

            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal HTML Markup -->
<div id="viewApptLog" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">
                    View Appointment Message Log
                </h4>
            </div>

            <div class="modal-body">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date </th>
                            <th>Time</th>
                            <th>Reminder</th>
                            <th>Message</th>
                            <th>Status</th>
                  
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                    
                </table>
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal HTML Markup -->
<div id="viewApptLog" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">
                    View Appointment Message Log
                </h4>
            </div>

            <div class="modal-body">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date </th>
                            <th>Time</th>
                            <th>Reminder</th>
                            <th>Message</th>
                            <th>Status</th>
                  
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                    
                </table>
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@include('modals.viewApptMessageLog')
<div id="addLanguagePopupView" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">
                    Add Language
                </h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="col-md-12 font-bolder ">
                        <p>
                            If you would like us to send messages in a language that we do not yet offer, please complete the form below:
                        </p>
                       
                        <div class="form-group">
                            <label for="mobile" class="col-md-4">Name of Language</label>
                            <div class="col-md-6">
                                <input class="form-control addLanguage"  type="text">
                            </div>
                             <!-- <div class="col-md-2">
                                <button>Add</button>
                            </div> -->
                        </div>
                        <p>
                            We will usually add the translations within 5 working days.
                        </p>
                        <p>
                            If this is very urgent, please email support@healthchecksms.com
                        </p>
                    </div> 
                    
                </form>
                <div class="clearfix"></div>
                <div class="col-md-12 addLanguageMessagesData">

                </div>
                <div class="col-md-12 showLanguageMessagesData">

                </div>
            </div>
            <div class="modal-footer text-xs-center">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="viewLanguagePopupView" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">
                    View Language
                </h4>
            </div>

            <div class="modal-body">
                <div class="col-md-12 font-bolder ">
                    <p class="font-bolder"> 
                       Good communication is important, 
                       which is why we send messages in the 
                       patients preferred language whenever possible.
                    </p>
                    <p class="">
                        We currently offer {{$languages->count()}} languages, 
                        and are adding more based on customer feedback and languages selected.
                        
                    </p>
                    <p>
                        If you select a language that is not yet fully translated, 
                        we will send messages in English until the translation is complete.
                    </p>
                    <p>
                        You can request or add a new one here:
                        <a href="javascript:void(0);" class="addLanguagePopup">Add New</a>
                    </p>
                    <p>
                        <span style="width:50%;" >or view existing one below or search here : 
                        <select name="language" style="width:25%;" class="showLanguageServiceMessages showLanguageMessages1">
                            <option value="">Select Language</option>
                            
                            @foreach($languages as $language)
                               
                                <option value="{{$language->id}}">{{$language->title}}</option>

                            @endforeach
                            
                        </select> 
                        <select name="service"  style="width:25%"  class=" showLanguageServiceMessages showServiceMessages">
                            <option value="">Select Service</option>
                            
                            @foreach(Helper::Service() as $service)
                               
                                <option value="{{$service->id}}">{{$service->name}}</option>

                            @endforeach
                            
                        </select> 
                    </p>
                    <div class="showLanguageMessagesData">

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="viewSchduledMessageLog" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">
                    View Appointment Message Log
                </h4>
            </div>

            <div class="modal-body">
               
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@include('modals.viewSheduleService')
@push('scripts')

  <script type="text/javascript">
    
    var  url        =     "{{url('patient-service')}}";
    var  updUrl     =     "{{url('update-info')}}";
    var durl        =     "{{url('patient-service-days')}}";
    var turl        =     "{{url('patient-service-time')}}";

    var messageUrl  =     "{{url('reminder-sms')}}";
    var replyUrl    =     "{{url('receive-sms/ajax')}}";

  </script>
    <script src="{{ asset('js/patient/patient-reminder.js') }}"></script>

@endpush


@endsection
