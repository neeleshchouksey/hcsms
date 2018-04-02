@extends('layouts.app')

@section('content')
 <div class="med_tittle_section">
        <div class="med_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="med_tittle_cont_wrapper">
                        <div class="med_tittle_cont">
                            <h1>Dashboard</h1>
                            <ol class="breadcrumb">
                                <li><a href="{{url('/')}}">Home</a>
                                </li>
                                <li>Patients</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="dashboard-wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Patient</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('patient.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-3">Patient Reference</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

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
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >

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
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required >

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
                                            if($language->id==old('language'))
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
                                <textarea id="note" type="text" class="form-control" name="note"  required >{{ old('note') }}</textarea>

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
                                    <input id="" type="checkbox"  name="agree" value="1"   >
                                    Please tick to confirm patient has agreed to receive reminders from HealthCheckSms
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
