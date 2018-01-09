@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('profile') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3  ">Practice Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autofocus>

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
                                <input id="company" type="text" class="form-control" name="company" value="{{ Auth::user()->company }}" required >

                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('sender_id') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-3  ">Sender Id</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control" name="sender_id" value="{{ Auth::user()->sender_id }}"  >

                                @if ($errors->has('sender_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sender_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('appt_sender_id') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-3  ">Appointment Sender Id</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control" name="appt_sender_id" value="{{ Auth::user()->appt_sender_id }}"  >

                                @if ($errors->has('appt_sender_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('appt_sender_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-3">Post Code</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control" name="postcode" value="{{ Auth::user()->postcode }}"  >

                                @if ($errors->has('postcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3  ">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3  ">Address</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required >

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
                                            if($country->id==Auth::user()->country):
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
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->contact }}" required >

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
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
                                        $practice_ids    =   explode(',',Auth::user()->practice_id);
                                        if ( in_array($practiceType->id,$practice_ids)) :
                                            $checked= "checked";
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
                                        <input id="" type="text" class="form-control" name="keycontacts[practice_manager][name]" placeholder="Name" value="{{ $practice_manager->name }}" required >
                                        @if ($errors->has('keycontacts.practice_manager.name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.practice_manager.name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.practice_manager.phone') ? ' has-error' : '' }}">
                                        <input id="" type="text" class="form-control" name="keycontacts[practice_manager][phone]" placeholder="Number" value="{{ $practice_manager->phone }}" required >
                                        @if ($errors->has('keycontacts.practice_manager.phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.practice_manager.phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.practice_manager.email') ? ' has-error' : '' }}">
                                        <input id="" type="email" class="form-control" name="keycontacts[practice_manager][email]" placeholder="email" value="{{ $practice_manager->email }}" required >
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
                                        <input id="" type="text" class="form-control" name="keycontacts[billing_contact][name]" placeholder="Name" value="{{ $billing_contact->name }}" required >
                                        @if ($errors->has('keycontacts.billing_contact.name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.billing_contact.name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.billing_contact.phone') ? ' has-error' : '' }}">
                                        <input id="" type="text" class="form-control" name="keycontacts[billing_contact][phone]" placeholder="Number" value="{{ $billing_contact->phone }}" required >
                                        @if ($errors->has('keycontacts.billing_contact.phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('keycontacts.billing_contact.phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 {{ $errors->has('keycontacts.billing_contact.email') ? ' has-error' : '' }}">
                                        <input id="" type="email" class="form-control" name="keycontacts[billing_contact][email]" placeholder="email" value="{{ $billing_contact->email }}" required >
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
                            
                                @foreach($others as $other)
                                    @php
                                        $otherKey = 'otherkey'.$i;
                                    @endphp
                                   <div class="form-group otherKeyContact">
                                        <input id="" type="hidden" name="keycontacts[others][{{$otherKey}}][keyid]" placeholder="Title" value='{{$other->id}}' required="required" class="form-control">
                                        <div for="" class="col-md-3">
                                            <input id="" type="text" name="keycontacts[others][{{$otherKey}}][title]" placeholder="Title" value='{{$other->title}}' required="required" class="form-control">
                                        </div> 
                                        <div class="col-md-3 ">
                                            <input id="" type="text" name="keycontacts[others][{{$otherKey}}][name]" placeholder="Name" value='{{$other->name}}' required="required" class="form-control">
                                        </div> 
                                        <div class="col-md-3 ">
                                            <input id="" type="text" name="keycontacts[others][{{$otherKey}}][phone]" placeholder="Number" value='{{$other->phone}}' required="required" class="form-control">
                                        </div> 
                                        <div class="col-md-3 ">
                                            <input id="" type="email" name="keycontacts[others][{{$otherKey}}][email]" placeholder="email" value='{{$other->email}}' required="required" class="form-control">
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                           
                        </div>
                        <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-primary addMore pull-right"> Add More </a>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
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
    $('.keycontacts').append('<div class="form-group otherKeyContact"><input id="" type="hidden" name="keycontacts[others]['+otherKey+'][keyid]" placeholder="Title" value="0" required="required" class="form-control"><div for="" class="col-md-3"><input id="" type="text" name="keycontacts[others]['+otherKey+'][title]" placeholder="Title" value="" required="required" class="form-control"></div> <div class="col-md-3 "><input id="" type="text" name="keycontacts[others]['+otherKey+'][name]" placeholder="Name" value="" required="required" class="form-control"></div> <div class="col-md-3 "><input id="" type="text" name="keycontacts[others]['+otherKey+'][phone]" placeholder="Number" value="" required="required" class="form-control"></div> <div class="col-md-3 "><input id="" type="email" name="keycontacts[others]['+otherKey+'][email]" placeholder="email" value="" required="required" class="form-control"></div></div>');
    otherkeynumber++;
});
</script>
@endsection