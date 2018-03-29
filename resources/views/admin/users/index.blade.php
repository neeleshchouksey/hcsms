@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
          
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Admin User List</h3>
                <a href="{{url('admin/users/create')}}" class="btn btn-success pull-right"> Add New </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="users_list_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Job title</th>
                            <th>Mobile</th>
                            <th>Date Added</th>
                            <th>Added By</th>
                            <th>Status</th>
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

@push('scripts')

  <script type="text/javascript">
    
    var url         =    "{{url('admin/user/ajax/load')}}";
    
  </script>
   

    <script src="{{ asset('js/admin/users/users.js') }}"></script>
@endpush
@endsection