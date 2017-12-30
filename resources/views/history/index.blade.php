@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>

                <div class="panel-body">
                    
         
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title pull-left">Bp History</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             {!!$getHistory!!}
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
