

$('.service-toggle').bootstrapToggle();
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$('.service-toggle').change(function() {
      //alert($(this).prop('checked'));
          var status  = 0;
          var data    = {
              service:$(this).attr('service'),
              patient:$(this).attr('patient'),
              status:status,
              stop:0,
              action:'update'    
          };
          if($(this).prop('checked')==true){
            status =1;
            data = {
              service:$(this).attr('service'),
              patient:$(this).attr('patient'),
              status:status,
              start:0,
              action:'update'    
          };
          }
          $.post({
            type: 'post',
            url: url
          },data
          ).done(function (data) {
              //$('#ModalLoginForm .modal-body').html(data);
              //$('#ModalLoginForm').modal('show');
              patient();
            
          });

});
$(document).on('click','.editService',function(){
    $.post({
      type: 'post',
      url: url
    },
    {
        service:$(this).attr('service'),
        patient:$(this).attr('patient'),
        status:0,
        action:'edit'    
    }).done(function (data) {
        $('#ModalLoginForm .modal-body').html(data);
        $('#ModalLoginForm').modal('show');
        $('#start_date').datepicker({format: 'mm/dd/yyyy'});
        $("#start_date").datepicker("setDate", new Date());
    
    });
});
$(document).on('click','.days',function(){
  var service = $('.service').val();
    if($(this).hasClass('btn-success')){
        $(this).removeClass('btn-success');

        $.post({
          type: 'post',
          url:  durl
        },{
            service :   service,
            patient :   $('.patient').val(),
            day     :   $(this).attr('data-value'),
            action  :   'edit'
        }).done(function (data) {
             $('.service_'+service).html(data);  
             $('.service-toggle').bootstrapToggle();
        });
    }
    else{
        $(this).addClass('btn-success');
        //alert($('.service').val());
        $.post({
          type: 'post',
          url:  durl
        },{
            service :   $('.service').val(),
            patient :   $('.patient').val(),
            day     :   $(this).attr('data-value'),
            action  :   'add'
        }).done(function (data) {
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();   
        });
    }
    var selectedLength =  $('.days.btn-success').length;
    console.log(selectedLength);
    console.log($('.days').hasClass('btn-success').length);
    var daysLength =  $('.days').length;
    if(selectedLength==daysLength){
      $('.day-all').addClass('btn-success');
    }
   else {
      $('.day-all').removeClass('btn-success');
    }
});
$(document).on('click','.day-all',function(){
  var service = $('.service').val();
  var days= $(".days").map(function() {
   return $(this).attr('data-value');
}).get();
    if($(this).hasClass('btn-success')){
        $(this).removeClass('btn-success');
        $('.days').removeClass('btn-success');
        
        $.post({
          type: 'post',
          url:  durl
        },{
            service :   service,
            patient :   $('.patient').val(),
            day     :   days,
            action  :   'edit'
        }).done(function (data) {
             $('.service_'+service).html(data);  
             $('.service-toggle').bootstrapToggle();
        });
    }
    else{
        $(this).addClass('btn-success');
        $('.days').addClass('btn-success');
        //alert($('.service').val());
        $.post({
          type: 'post',
          url:  durl
        },{
            service :   $('.service').val(),
            patient :   $('.patient').val(),
            day     :   days,
            action  :   'add'
        }).done(function (data) {
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();   
        });
    }
});
 $(document).on('click','.time',function(){
    var service  =   $('.service').val();
    if($(this).hasClass('btn-success')){
       $(this).removeClass('btn-success');
       
        $.post({
          type: 'post',
          url:  turl
        },{
            service :   service,
            patient :   $('.patient').val(),
            time_id :   $(this).attr('data-value'),
            action  :   'delete'
        }).done(function (data) {
          //$(this).attr('data-value')   
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();   
        });
    }
    else{
        $(this).addClass('btn-success');

        $.post({
          type: 'post',
          url:  turl
        },{
            service :   service,
            patient :   $('.patient').val(),
            time_id :   $(this).attr('data-value'),
            action  :   'add'
        }).done(function (data) {
          //$(this).attr('data-value')   
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();   
        });
    }
});
 $(document).on('click','.duration',function(){
    
     $('.duration').removeClass('btn-success');

     $(this).addClass('btn-success');

        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          duration:   $(this).attr('data-value'),
          action:'update'    
        }).done(function (data) {
          
        });
    
 });
 $(document).on('change','.perweek',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          
          perweek :   $(this).val(),
          action:'update'    
        }).done(function (data) {
         
          
        });
    
 });
$(document).on('change','.period',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          ongoing :   0,
          period  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });
$(document).on('change','.maxbp',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          
          maxbp  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });
$(document).on('change','.minbp',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          minbp  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });
$(document).on('change','.lowalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          lowalert:   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });

$(document).on('change','.highalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service    :   $('.service').val(),
          patient    :   $('.patient').val(),
          highalert  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });
$(document).on('change','.verylowalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service     :   $('.service').val(),
          patient     :   $('.patient').val(),
          verylowalert:   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });

$(document).on('change','.veryhighalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service        :   $('.service').val(),
          patient        :   $('.patient').val(),
          veryhighalert  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });
$(document).on('click','.getBPHistory',function(){

  //$('#getBPHistoryModal').modal('show');
   $.post({
      type: 'post',
      url: url
    },
    {
        service:$(this).attr('service'),
        patient:$(this).attr('patient'),
        action:'serviceHistory'    
    }).done(function (data) {
        $('#getBPHistoryModal .serviceHistory').html(data);

         $("#serviceHistoryTable").DataTable();
        $('#getBPHistoryModal').modal('show');
    
    });
});
$(document).on('click','.start',function(){
        var start     =   $(this);
        var service   =   $('.service').val();
        $.post({
          type: 'post',
          url: url
        },
        {
          service :   service,
          patient :   $('.patient').val(),
          start  :   $('#start_date').val(),
          status : 1,
          action:'update'    
        }).done(function (data) {
          $('.startParent').hide();
          $('.stopParent').show();
//          start.removeClass('start').addClass('stop').val('STOP');
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();   
          patient();
        });
    
});
$(document).on('click','.stop',function(){
        var stop      =   $(this);
        var service   =   $('.service').val();
        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          stop    :   $(this).val(),
          status  :   0,
          action  :   'update'    
        }).done(function (data) {
          $('.startParent').show();
          $('.stopParent').hide();
          //stop.removeClass('stop').addClass('start').val('START');
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();
          patient();
        });
    

});

$(document).on('click','.send_test_message',function(){

    var  patient_service_id   =   $('.patient_service').val();

    $.post({
      type  :   'post',
      url   :   messageUrl
    },
    {
      patient_service_id:patient_service_id
    }).done(function (data) {
      patient();
      });

});


patient();
  function patient(queryString='') {
    // body...
   // alert('test123');
   var patient_id = $('.messagePatientLog').val();
    $("#message_log_table").DataTable({
    destroy:true,
    "ajax": {
          "url":messageUrl+'/ajax/'+patient_id+queryString,
          "dataSrc": "records",
          "type": 'GET',
      },
      
      "order": [],
      columns: [
          { data: 'day' },
          { data: 'to' },
          { data: 'from' },
          { data: 'message' },
          { data: 'service' },
         
         
      ]
      
  });
  }
$(document).on('click','.messageReply',function(){
    var messageId     =   $(this).attr('id');
//    alert(messageId);
     $.post({
          type: 'post',
          url: replyUrl
        },
        {
          message_id :   messageId,

        }).done(function (data) {
          $('#replySmsModal tbody').html(data);
          $('#replySmsModal').modal('show');
          
        });
    
    
});
$(document).on('click','#showSentMessage,#showReceivedMessage',function(){
  var params = {};

  if($('#showSentMessage').prop('checked')==true){
      params['sent']= 1;
  }
  if($('#showReceivedMessage').prop('checked')==true){
      //params.push({received : 1});
      params['received']= 1;
  }
  if(params!=''){
 var str = '?'+$.param( params );
 patient(str);
}
console.log(params.length);
});
