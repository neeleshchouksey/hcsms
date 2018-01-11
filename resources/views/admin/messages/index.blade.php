@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Message Log</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
          
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Messages List</h3>
                <!-- <a href="{{url('admin/languages/create')}}" class="btn btn-success pull-right"> Add New </a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="customer_list_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Patient</th>
                            <th>Practice Name</th>
                            <th>Send Received</th>
                            <th>Language</th>
                            <th>Message</th>
                           
                            
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
                <h4 class="modal-title text-xs-center">Message information</h4>
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
    
    var url         =    "{{url('admin/messages-log/ajax/load')}}";
  
  </script>
   

    <script src="{{ asset('js/admin/messages/log.js') }}"></script>
@endpush
@endsection