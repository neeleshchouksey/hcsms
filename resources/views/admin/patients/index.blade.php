@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Patients</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
          
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Patients List</h3>
                <div class="pull-right">
                    <select name="languages" class="filter">
                        <option value="">Patient Languages</option>
                        @foreach(Helper::patientsLanguages() as $language)
                            <option value="{{$language->id}}">{{$language->title}}</option>
                        @endforeach
                    </select>
                    <select name="practices" class="filter">
                        <option value="">Practice Name</option>
                        @foreach(Helper::practices() as $practice)
                                <option value="{{$practice->id}}">{{$practice->name}}</option>
                        @endforeach
                    </select>
                    <label>Active Reminders <input type="checkbox" name="activeReminder" class="filter"></label>
                </div>
                <!-- <a href="{{url('admin/languages/create')}}" class="btn btn-success pull-right"> Add New </a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="customer_list_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Number</th>
                            <th>Language</th>
                            <th>Practice Name</th>
                            <th>Active Reminders</th>
                            <th>Last Message Sent</th>
                            <!-- <th>Next Message Due</th> -->
                            <th>Total Message Sent</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

<div id="profileDetailsPopup" class="modal  fade">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">Patient information</h4>
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
    
    var url         =    "{{url('admin/patients/ajax/load')}}";
  
  </script>
   

    <script src="{{ asset('js/admin/patients/patient.js') }}"></script>
@endpush
@endsection