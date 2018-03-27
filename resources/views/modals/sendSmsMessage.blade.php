<!-- Modal HTML Markup -->
<div id="sendSmsMessageModel" class="modal  fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-xs-center">
                    Send Sms
                </h4>
            </div>

            <div class="modal-body">
                <div id="sendMessageErrors"></div>
                <form class="form-horizontal" method="post" action="{{url('send-simple-sms')}}" id="sendMessagePatient">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="sendto">Send TO:</label>
                    <p class=" col-sm-10" style="margin-top:1%;">
                      {{$patient->name}} ({{$patient->mobile}})
                    </p>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="message">Message:</label>
                    <div class="col-sm-10"> 
                      <textarea class="form-control" id="message" name="message" placeholder="Enter Message"></textarea>
                    </div>
                  </div>
                 <input type="hidden" name="patient_id" value="{{$patient->id}}">
                  <div class="form-group"> 
                    <label class="control-label col-sm-10" style="font-size:13px;">The message you type here will not be translated into the patient language.</label>
                    <div class=" col-sm-2">
                      <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                  </div>
                </form>
               
            </div>
            <div class="modal-footer text-xs-center">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->