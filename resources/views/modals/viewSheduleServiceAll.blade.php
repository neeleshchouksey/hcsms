<div id="viewSchduledMessageLog" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title pull-left text-xs-center">
                    View Appointment Message Log
                </h4>
                <span class="pull-right">
                    @foreach(Helper::Service() as $service)
                        <label>
                            <input type="checkbox" value="{{$service->id}}" checked class="scheduledMessageFilter" />
                            {{$service->data}}
                        </label>
                    @endforeach
                </span>
            </div>

            <div class="modal-body">
               
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->