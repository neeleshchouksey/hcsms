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
                            @foreach(Helper::Service() as $service)
                                <th>{{$service->data}}</th>
                            @endforeach
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
<div id="SetSmsMessage" class="modal  fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">Set Message</h4>
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
    
    var url         =    "{{url('admin/language/ajax/load')}}";
    var smsTypeUrl  =    "{{url('admin/sms-message-types')}}"
    var messageUrl  =    "{{url('admin/sms-language-message')}}"
  </script>
   

    <script src="{{ asset('js/admin/language/language.js') }}"></script>
@endpush
@endsection