@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Profile</h1>
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
                          <h3 class="box-title">Edit Profile</h3>
                        </div>
                        
                        
                        <form action="{{url('admin/profile')}}" method="post" id="loading_location_form" enctype="multipart/form-data">
                          
                        {{ csrf_field() }}
                         
                          <div class="box-body">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td><strong>First Name</strong></td>
                                  <td>:</td>
                                  <td>
                                    <input type="text" class="form-control" name="first_name" value="{{Auth::guard('admin')->user()->first_name}}" required>
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
                                    <input type="text" class="form-control" name="last_name" value="{{Auth::guard('admin')->user()->last_name}}" required>
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
                                   <input type="text" class="form-control" name="email" value="{{Auth::guard('admin')->user()->email}}" required>
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
                                   <input type="text" class="form-control" name="mobile" value="{{Auth::guard('admin')->user()->mobile}}" required>
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
                                        <input type="password" class="form-control" name="newpassword" value="" >
                                         @if ($errors->has('newpassword'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('newpassword') }}</strong>
                                          </span>
                                        @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Confirm Password</strong></td>
                                  <td>:</td>
                                  <td>
                                    <input type="password" class="form-control" name="confirmpassword" value="" >
                                     @if ($errors->has('confirmpassword'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('confirmpassword') }}</strong>
                                      </span>
                                    @endif
                                  </td>
                                </tr>
                               <tr>
                                  <td><strong>Job Title</strong></td>
                                  <td>:</td>
                                  <td>
                                   <input type="text" class="form-control" name="job_title" value="{{Auth::guard('admin')->user()->job_title}}" required>
                                    @if ($errors->has('job_title'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('job_title') }}</strong>
                                      </span>
                                    @endif
 
                                  </td>
                                </tr>
                                <tr>
                                  <td><strong>Notes</strong></td>
                                  <td>:</td>
                                  <td>
                                   <textarea  class="form-control" name="notes"  required>{{Auth::guard('admin')->user()->notes}}</textarea>
                                    @if ($errors->has('notes'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('notes') }}</strong>
                                      </span>
                                    @endif
 
                                  </td>
                                </tr>

                              </tbody>
                            </table>
                            <input type="submit" id="submit-all" class="btn btn-info pull-right m_t10" name="submit" value="Submit">
                          </div>
                        </form>
                      
                        <div class="clear-fix">
                          
                        </div>
                      </div>
                    </div>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
          
            
          
       

  <!-- /.content-wrapper -->
@endsection