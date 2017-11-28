@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Staff</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('staff.update',$staff->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-3  ">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $staff->title }}" required autofocus>

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
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $staff->first_name }}" required >

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
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $staff->last_name }}" required >

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
                                <input id="job_title" type="text" class="form-control" name="job_title" value="{{ $staff->job_title }}" required >

                                @if ($errors->has('job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3  ">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $staff->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3  ">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-3">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $staff->mobile }}" required >

                                @if($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                        <div class="form-group{{ $errors->has('landline') ? ' has-error' : '' }}">
                            <label for="landline" class="col-md-3">Landline Number</label>

                            <div class="col-md-6">
                                <input id="landline" type="text" class="form-control" name="landline" value="{{ $staff->landline}}" required >

                                @if($errors->has('landline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="" class="col-md-3  ">Status</label>

                            <div class="col-md-6">
                                @foreach(Helper::Status() as $status)
                                    @php
                                        $checked= "";
                                        if($staff->status==$status->id ):
                                        
                                            $checked= "checked";
                                        
                                        endif;
                                    @endphp
                                    <label class="radio-inline">  
                                        <input id="" type="radio"  name="status" value="{{ $status->id  }}" {{$checked}} required >
                                        {{$status->title}}
                                    </label>
                                @endforeach
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                                
                            <label for="" class="col-md-3  ">System Admin</label>
                            <div class="col-md-6">
                                @foreach(Helper::Permission() as $permission)

                                    @php
                                       $getPermission    =   explode(',',$staff->permission);
                                        $checked= "";
                                        if(in_array($permission->id,$getPermission )):
                                        
                                            $checked= "checked";
                                       
                                        endif;
                                    @endphp
                                    @if($permission->type=='radio')
                                     <div class="checkbox">
                                        <label class="radio-inline">
                                            
                                            {{$permission->title}}
                                        </label><br>
                                        @foreach($permission->childs as $child)
                                        @php 
                                        $checked= "";
                                        if(in_array($child->id,$getPermission) ):
                                        
                                            $checked= "checked";
                                         
                                         endif;
                                         @endphp
                                         <label class="radio-inline">  
                                            <input id="" type="radio"  name="permission[{{$permission->id}}]" value="{{ $child->id  }}" {{$checked}} >
                                            {{$child->title}}
                                         </label>
                                         @endforeach
                                    </div>
                                    @else
                                    <div class="checkbox">
                                        <label>
                                            <input id="" type="checkbox"  name="permission[{{$permission->id}}]" value="{{ $permission->id  }}" {{$checked}}  >
                                            {{$permission->title}}
                                        </label>
                                    </div>
                                    @endif
                                    
                                @endforeach
                                @if ($errors->has('permission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                @endif
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
@endsection
