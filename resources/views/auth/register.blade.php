@extends('layouts.app')

@section('content')
  <div class="med_tittle_section">
        <div class="med_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="med_tittle_cont_wrapper">
                        <div class="med_tittle_cont">
                            <h1>Register</h1>
                            <ol class="breadcrumb">
                                <li><a href="{{url('/')}}">Home</a>
                                </li>
                                <li>Register</li>
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
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3  ">Practice Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-3  ">Company Name</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" required >

                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3  ">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-3  ">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-3  ">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required >

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-3  ">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required >

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                            <label for="job_title" class="col-md-3  ">Job Title</label>

                            <div class="col-md-6">
                                <input id="job_title" type="text" class="form-control" name="job_title" value="{{ old('job_title') }}" required >

                                @if ($errors->has('job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3  ">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-3  ">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3  ">Address</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="address" value="{{ old('address') }}" required >

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3  ">Country</label>

                            <div class="col-md-6">

                                <select class="form-control" name="country" id="country">
                                    <option value="">Select Country</option>
                                    @foreach(Helper::Countries() as $country)
                                        @php
                                            $selectedCountry  = "";
                                            if($country->id==old('country')):
                                                $selectedCountry = "selected";
                                            elseif($country->id==826):
                                                $selectedCountry = "selected";
                                            endif;


                                        @endphp
                                        <option value="{{$country->id}}" {{$selectedCountry}}>{{$country->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-3  ">Contact Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required >

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('landline') ? ' has-error' : '' }}">
                            <label for="landline" class="col-md-3">Landline Number</label>

                            <div class="col-md-6">
                                <input id="landline" type="text" class="form-control" name="landline" value="{{ old('landline') }}" required >

                                @if($errors->has('landline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('practice_type') ? ' has-error' : '' }}">
                            <label for="" class="col-md-3  ">Practice Type</label>

                            <div class="col-md-6">
                                @foreach(Helper::PracticeTypes() as $practiceType)
                                    @php
                                        $checked= "";
                                        if(old('practice_type')!==null):
                                        if (in_array($practiceType->id,old('practice_type'))) :
                                            $checked= "checked";
                                        endif;
                                        endif;
                                    @endphp
                                    <label class="checkbox-inline">  
                                        <input id="" type="checkbox"  name="practice_type[]" value="{{ $practiceType->id  }}" {{$checked}}  >
                                        {{$practiceType->name}}
                                    </label>
                                @endforeach
                                @if ($errors->has('practice_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('practice_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="keycontacts">
                            <div class="form-group">
                                
                             <label for="" class="col-md-3  ">Key Contacts</label>
                            </div>
                            <div class="form-group">

                                    <label for="" class="col-md-3">Practice Manager</label>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.practice_manager.name') ? ' has-error' : '' }}">
                                        <input id="" type="text" class="form-control" name="keycontacts[practice_manager][name]" placeholder="Name" value="{{ old('keycontacts.practice_manager.name') }}" required >
                                        @if ($errors->has('keycontacts.practice_manager.name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.practice_manager.name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.practice_manager.phone') ? ' has-error' : '' }}">
                                        <input id="" type="text" class="form-control" name="keycontacts[practice_manager][phone]" placeholder="Number" value="{{ old('keycontacts.practice_manager.phone') }}" required >
                                        @if ($errors->has('keycontacts.practice_manager.phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.practice_manager.phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.practice_manager.email') ? ' has-error' : '' }}">
                                        <input id="" type="email" class="form-control" name="keycontacts[practice_manager][email]" placeholder="email" value="{{ old('keycontacts.practice_manager.email') }}" required >
                                        @if ($errors->has('keycontacts.practice_manager.email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.practice_manager.email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                
                            </div>
                            <div class="form-group">

                                    <label for="" class="col-md-3">Billing Contact</label>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.billing_contact.name') ? ' has-error' : '' }}">
                                        <input id="" type="text" class="form-control" name="keycontacts[billing_contact][name]" placeholder="Name" value="{{ old('keycontacts.billing_contact.name') }}" required >
                                        @if ($errors->has('keycontacts.billing_contact.name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.billing_contact.name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.billing_contact.phone') ? ' has-error' : '' }}">
                                        <input id="" type="text" class="form-control" name="keycontacts[billing_contact][phone]" placeholder="Number" value="{{ old('keycontacts.billing_contact.phone') }}" required >
                                        @if ($errors->has('keycontacts.billing_contact.phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.billing_contact.phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.billing_contact.email') ? ' has-error' : '' }}">
                                        <input id="" type="email" class="form-control" name="keycontacts[billing_contact][email]" placeholder="email" value="{{ old('keycontacts.billing_contact.email') }}" required >
                                        @if ($errors->has('keycontacts.billing_contact.email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.billing_contact.email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                            </div>
                             @php
                             $i=1;
                            @endphp
                            @if(null !== old('keycontacts.others'))
                                @foreach(old('keycontacts.others') as $others)
                                    @php
                                        $otherKey = 'otherkey'.$i;
                                    @endphp
                                   <div class="form-group otherKeyContact">
                                        <div for="" class="col-md-3">
                                            <input id="" type="text" name="keycontacts[others][{{$otherKey}}][title]" placeholder="Title" value='{{old("keycontacts.others.$otherKey.title")}}' required="required" class="form-control">
                                        </div> 
                                        <div class="col-md-3 ">
                                            <input id="" type="text" name="keycontacts[others][{{$otherKey}}][name]" placeholder="Name" value='{{old("keycontacts.others.$otherKey.name")}}' required="required" class="form-control">
                                        </div> 
                                        <div class="col-md-3 ">
                                            <input id="" type="text" name="keycontacts[others][{{$otherKey}}][phone]" placeholder="Number" value='{{old("keycontacts.others.$otherKey.phone")}}' required="required" class="form-control">
                                        </div> 
                                        <div class="col-md-3 ">
                                            <input id="" type="email" name="keycontacts[others][{{$otherKey}}][email]" placeholder="email" value='{{old("keycontacts.others.$otherKey.email")}}' required="required" class="form-control">
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-primary addMore pull-right"> Add More </a>
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
@section('jsscript')
<script type="text/javascript">
var otherkeynumber = $('.otherKeyContact').length+1;
$(document).on('click','.addMore',function(e){
    var otherKey = 'otherkey'+otherkeynumber;
    $('.keycontacts').append('<div class="form-group otherKeyContact"><div for="" class="col-md-3"><input id="" type="text" name="keycontacts[others]['+otherKey+'][title]" placeholder="Title" value="" required="required" class="form-control"></div> <div class="col-md-3 "><input id="" type="text" name="keycontacts[others]['+otherKey+'][name]" placeholder="Name" value="" required="required" class="form-control"></div> <div class="col-md-3 "><input id="" type="text" name="keycontacts[others]['+otherKey+'][phone]" placeholder="Number" value="" required="required" class="form-control"></div> <div class="col-md-3 "><input id="" type="email" name="keycontacts[others]['+otherKey+'][email]" placeholder="email" value="" required="required" class="form-control"></div></div>');
    otherkeynumber++;
});
</script>
@endsection