@extends('layouts.app')

@section('content')
<style type="text/css">
.custom-border{
    border: 1px solid grey;
    padding: 5px 0px;
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

                        <div class="form-group{{ $errors->has('service') ? ' has-error' : '' }}">
                            <label for="" class="col-md-3  ">Services</label>

                            <div class="col-md-6">
                                @foreach(Helper::Service() as $service)
                                    @php
                                        $getService     =   explode(',',$patient->services);
                                        $checked= "";
                                        if(in_array($service->id,$getService)):
                                        
                                            $checked= "checked";
                                        
                                        endif;
                                    @endphp
                                    <label class="checkbox">  
                                        <input id="" type="checkbox"  name="service[]" value="{{ $service->id  }}" {{$checked}}  >
                                        {{$service->name}}
                                    </label>
                                @endforeach
                                @if ($errors->has('service'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('service') }}</strong>
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
                     @foreach(Helper::Service() as $service)
                     <div class="col-md-6 custom-border">
                            <div class="col-md-7">
                                <h4>{{$service->name}}</h4>
                                Remindar set for mon,wed  & fri at 8am and 7 pm
                            </div>
                            <div class="col-md-offset-2 col-md-3">
                                <input type="checkbox"  data-toggle="toggle"><br><br>
                                <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button>
                            </div>

                    </div>
                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>When show we ask for BP readings?</label>
                </div>
                <div class="form-group">
                    <label>
                        On what days should we request a reading?
                        <br>
                        Simply press to select or unselect
                    </label>
          
                </div>
                <div class="form-group">
                    @foreach(Helper::ReminderDays() as $day)
                        @php
                            $activeClass="";
                            if($day->isdefault==1):
                                $activeClass = "btn-success";
                   
                            endif;
                        @endphp
                        <button class="btn days col-md-4 {{$activeClass}}">{{strtoupper($day->abbr)}}</button>
                    @endforeach
                </div>  
                <div class="form-group">
                    <label>
                         What Time should we send reminder?
                        <br>
                        We suggest asking the patient what works best for them.
                    </label>
                </div>  
                <div class="form-group">
                    @foreach(Helper::ReminderTimes() as $time)
                        @php
                            $activeClass="";
                            if($time->isdefault==1):
                                $activeClass = "btn-success";
                            endif;
                        @endphp
                        <button class="btn time col-md-4 {{$activeClass}}">{{strtoupper($time->abbr)}}</button>
                    @endforeach
                </div> 
                <div class="form-group">
                    <label>
                         How long you want to monitor for?
                     
                    </label>
                </div>  
                
                <div class="form-group">
                   <div class="col-md-6"><button class="btn btn-default"><h1>Ongoing</h1></button></div>
                   <div class="col-md-6"></div>
                </div>  
            </div>
         
        </div>

    </div>
</div>
<script type="text/javascript">
    $('#toggle-demo').bootstrapToggle('off');
    $(document).on('click','.days',function(){
        if($(this).hasClass('btn-success')){
           $(this).removeClass('btn-success');
        }
        else{
            $(this).addClass('btn-success');
        }
    });
     $(document).on('click','.time',function(){
        if($(this).hasClass('btn-success')){
           $(this).removeClass('btn-success');
        }
        else{
            $(this).addClass('btn-success');
        }
    });
</script>
@endsection
