@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>

                <div class="panel-body">
                    
         
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title pull-left">Patient Members</h3>
              <a href="{{route('patient.create')}}" class="btn btn-success pull-right"> Add New </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="patient_list_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Code </th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Last Update</th>
                  <th>Action</th>
                 
                </tr>
                </thead>
                <tbody>
                  
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

  <script type="text/javascript">
    
    var url = "{{url('patient/ajax/load')}}";
  </script>
   

    <script src="{{ asset('js/patient/patient.js') }}"></script>
@endpush
@endsection
