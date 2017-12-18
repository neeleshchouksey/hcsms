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
</style>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Patient</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('patient.update',$patient->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-3">Patient Reference</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ $patient->ref_code }}" required autofocus>

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
                                <input id="name" type="text" class="form-control" name="name" value="{{ $patient->name }}" required >

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
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $patient->mobile }}" required >

                                @if($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-3">Language</label>

                            <div class="col-md-6">

                                <select name="language" class="form-control">
                                    <option value="">Select Language</option>
                                    @foreach(Helper::languages() as $language)
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
                        </div>
                        
                         
                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-3">Notes</label>

                            <div class="col-md-6">
                                <textarea id="note" type="text" class="form-control" name="note"  required >{{ $patient->note }}</textarea>

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

                                    <input id="" type="checkbox"  name="agree" value="1"   {{$checkedAgree}}>
                                    Please tick to confirm patient has agreed to receive reminders from HealthCheckSms
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <h3>Set remindars</h3>

                    </div>
                     @php
                        $j = 1
                     @endphp
                     @foreach(Helper::Service() as $service)
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
                <h4 class="modal-title text-xs-center">Set Reminder</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@push('scripts')

  <script type="text/javascript">
    
    var  url        =     "{{url('patient-service')}}";
    var durl        =     "{{url('patient-service-days')}}";
    var turl        =     "{{url('patient-service-time')}}";

    var messageUrl  =     "{{url('reminder-sms')}}";

  </script>
   

    <script src="{{ asset('js/patient/patient-reminder.js') }}"></script>
@endpush
@endsection
