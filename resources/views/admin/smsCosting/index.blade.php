@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Sms Costing</h1>
@stop

@section('content')
<style type="text/css">
#editReminderPopup {
    overflow-y:scroll;
}</style>

<div class="row">
    <div class="col-xs-12">
          
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sms Costing</h3>
                
                <a href="{{url('admin/sms-costing/export')}}" class="btn btn-success pull-right"> Export Csv </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="sms_cost_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Country Name</th>
                            <th>Country Code</th>
                            <th>Currency Name</th>
                            <th>Currency Code</th>
                            <th>Sms Cost</th>
                            <th>Sms Fee</th>
                            
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
    
 var paurl       =    "{{url('admin/sms-costing/ajax')}}";
  </script>
   

    <script src="{{ asset('js/admin/sms-cost/sms-cost.js') }}"></script>
@endpush
@endsection