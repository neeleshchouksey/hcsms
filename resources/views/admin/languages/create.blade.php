@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Languages</h1>
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
                                <h3 class="box-title">Add New Language</h3>
                            </div>
                        
                            <form action="{{route('languages.store')}}" method="post">  
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Title</strong></td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" class="form-control" name="title"  required>
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