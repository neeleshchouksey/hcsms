@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Staff</div>

                <div class="panel-body">
                    
         
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title pull-left">Staff Members</h3>
              <a href="{{route('staff.create')}}" class="btn btn-success pull-right"> Add New </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="staff_list_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title </th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Job Title</th>
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
    
    var url = "{{url('staff/ajax/load')}}";
  </script>
   

    <script src="{{ asset('js/staff/staff.js') }}"></script>
@endpush
@endsection
