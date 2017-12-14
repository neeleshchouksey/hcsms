@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Languages</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
          
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Languages List</h3>
                <a href="{{url('admin/languages/create')}}" class="btn btn-success pull-right"> Add New </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="language_list_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>No of Patients</th>
                            <th>BPM</th>
                            <th>BSM</th>
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
    
    var url = "{{url('admin/language/ajax/load')}}";
  </script>
   

    <script src="{{ asset('js/admin/language/language.js') }}"></script>
@endpush
@endsection