@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

        
<div class="row m_b15">
    <div class="col-md-12">
        <div class="box">

            <div class="box-body">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <div class="">
                            <div class="box-header">
                                <h3 class="box-title">Add New User</h3>
                            </div>
                        
                            <form action="{{route('users.store')}}" method="post">  
                                {{ csrf_field() }}
                                <div class="box-body">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td><strong>First Name</strong></td>
                                  <td>:</td>
                                  <td>
                                    <input type="text" class="form-control" name="first_name"  value="{{old('first_name')}}">
                                    @if ($errors->has('first_name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('first_name') }}</strong>
                                      </span>
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Last Name</strong></td>
                                  <td>:</td>
                                  <td>
                                    <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}">
                                    @if ($errors->has('last_name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('last_name') }}</strong>
                                      </span>
                                    @endif
                                  </td>
                                </tr>
                                  <tr>
                                  <td><strong>Email</strong></td>
                                  <td>:</td>
                                  <td>
                                   <input type="text" class="form-control" name="email"  value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                    @endif
 
                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Mobile</strong></td>
                                  <td>:</td>
                                  <td>
                                   <input type="text" class="form-control" name="mobile"  value="{{old('mobile')}}">
                                    @if ($errors->has('mobile'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('mobile') }}</strong>
                                      </span>
                                    @endif
 
                                  </td>
                                </tr>
                               
                                <tr>
                                  <td><strong>Password</strong></td>
                                  <td>:</td>
                                  <td>
                                        <input type="password" class="form-control" name="password" value="" >
                                         @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                        @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Confirm Password</strong></td>
                                  <td>:</td>
                                  <td>
                                    <input type="password" class="form-control" name="password_confirmation" value="" >
                                     @if ($errors->has('password_confirmation'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                                      </span>
                                    @endif
                                  </td>
                                </tr>
                               <tr>
                                  <td><strong>Job Title</strong></td>
                                  <td>:</td>
                                  <td>
                                   <input type="text" class="form-control" name="job_title"  value="{{old('job_title')}}">
                                    @if ($errors->has('job_title'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('job_title') }}</strong>
                                      </span>
                                    @endif
 
                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Status</strong></td>
                                  <td>:</td>
                                  <td>
                                    @foreach(Helper::adminStatus() as $status)
                                   <label class="radio-inline"><input type="radio" name="status" value="{{$status->id}}" @if(old('status')==$status->id) checked @endif>{{$status->name}}</label>
                                   @endforeach
                                    @if ($errors->has('status'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('status') }}</strong>
                                      </span>
                                    @endif
 

                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Notes</strong></td>
                                  <td>:</td>
                                  <td>
                                   <textarea  class="form-control" name="notes"  >{{old('notes')}}</textarea>
                                    @if ($errors->has('notes'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('notes') }}</strong>
                                      </span>
                                    @endif
 
                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Permissions</strong></td>
                                  <td>:</td>
                                  <td>
                                    @foreach(Helper::adminPermissions() as $permissions)
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="permissions[]" @if(!empty(old('permissions')) && in_array($permissions->id,old('permissions'))) checked @endif value="{{$permissions->id}}">{{$permissions->label}}</label>
                                        </div>
                                   
                                   @endforeach
                                    @if ($errors->has('permissions'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('permissions') }}</strong>
                                      </span>
                                    @endif
 

                                  </td>
                                </tr>

                              </tbody>
                            </table>
                            <input type="submit" id="submit-all" class="btn btn-info pull-right m_t10" name="submit" value="Submit">
                          </div>
                            </form>
                           
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
    </div>
</div>

@endsection