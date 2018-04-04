@extends('layouts.app')

@section('content')
  <div class="med_tittle_section patient_home_title">
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
        <div class="col-md-12 ">

                    
         
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title pull-left">Patient Members</h3>
              <a href="{{route('patient.create')}}" class="btn btn-success pull-right"> Add New </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive table">
              <table id="patient_list_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Code </th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Language</th>
                  <th>Last Update</th>

                  <th>Action</th>
                 
                </tr>
                </thead>
                <tbody>
                  
                </tbody>
                
              </table>
              </div>
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
