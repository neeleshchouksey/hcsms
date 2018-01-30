$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
showPatients();
function showPatients(curl='') {
    //alert('test');
    // body...
    if(curl=='')
        curl=paurl;
    $("#customer_list_table").DataTable({
        destroy:true,
        "ajax": {
            "url":curl,
            "dataSrc": "",
            "type": 'GET',
        },
      
        "order": [[ 0, "desc" ]],
        columns: [
            { data: 'name' },
            { data: 'phone' },
            { data: 'language' },
            { data: 'practice' },

            { data: 'reminders' },
            { data: 'lastMessage' },
            
            { data: 'totalMessage' },
          
          
            { data: 'action'}
         
        ]
      
    });
}

$(document).on('click','.profile-popup',function(){
    var userid  =   $(this).attr('data-user');
   
      $.post(
        {
            type: 'get',
            url: userid
        },
        {action:'profile-popup'}
    )
    .done(
        function (data) {
           
                $('#profileDetailsPopup .modal-body').html(data);
                $('#profileDetailsPopup').modal('show'); 
                //alert('test');
           
          
        }
    )
    .fail(
        function(data) {

            console.log(data.responseJSON.errors);

          
        }
    );
});
$(document).on('change','.filter',function(){
    
    var filter = $('.filter').serialize();
    var curl   = paurl+'?'+filter;
    showPatients(curl);
});
$(document).on('click','.editReminderPopup',function(){
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
        $('#profileDetailsPopup').modal('hide'); 
        $('#editReminderPopup .modal-body').html(data);
        $('#editReminderPopup').modal('show');
        $('#start_date').datepicker({format: 'mm/dd/yyyy'});
        $("#start_date").datepicker("setDate", new Date());
    
    });
});
 $('#editReminderPopup').on('hidden.bs.modal', function () {
 $('#profileDetailsPopup').modal('show');
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

// bs target fields


$(document).on('change','.target',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service        :   $('.service').val(),
          patient        :   $('.patient').val(),
          target  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });

$(document).on('change','.bslowalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service        :   $('.service').val(),
          patient        :   $('.patient').val(),
          bslowalert     :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });

$(document).on('change','.bsverylowalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service        :   $('.service').val(),
          patient        :   $('.patient').val(),
          bsverylowalert  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });

$(document).on('change','.bshighalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service        :   $('.service').val(),
          patient        :   $('.patient').val(),
          bshighalert    :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });

$(document).on('change','.bsveryhighalert',function(){

        $.post({
          type: 'post',
          url: url
        },
        {
          service        :   $('.service').val(),
          patient        :   $('.patient').val(),
          bsveryhighalert  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          
        });
    
 });

$(document).on('change','.patientData',function(){

        var patientData = $('#patientData').serializeArray();
        var purl        = $('#patientData').attr('action');
        $.post({
          type: 'post',
          url: purl
        },
        patientData).done(function (data) {
          $('.ongoing').removeClass('btn-success');
          $('#formerrors').empty();
          
        })
        .fail(function(data) {
          console.log(data.responseJSON.errors);
          if( data.status === 422 ) {
                                var errors = data.responseJSON.errors;
                                errorHtml='<div class="errors"><ul>';
                                $.each( errors, function( key, value ) {
                                     errorHtml += '<li>' + value[0] + '</li>';
                               });
                                errorHtml += '</ul></div>';
                                $( '#formerrors' ).html( errorHtml );

                          }
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
        $( "#myfirstchart" ).empty();
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
$(document).on('click','.view-message-dairy-service',function(){
     
      $.post({
        type: 'post',
        url: url
    },
    {
      service   :   $('.service').val(),
      patient   :   $('.patient').val(),
      action    :   'getScheduledSmsMessage'
    })
    .done(function (data) {

        $('#viewSchduledMessageLogService .modal-body').html(data);
        
        $('#ModalLoginForm').modal('hide'); 
        $('#viewSchduledMessageLogService').modal('show');   
    })
    .fail(function (data) {

    });
 });
 $('#viewSchduledMessageLogService').on('hidden.bs.modal', function () {
  $('#ModalLoginForm').modal('show'); 
 });
 var modalName   = '';
$(document).on('click','.view-reminder-messages',function(e){
        alert('test');
        e.preventDefault();
        var appt = $(this);
        
        
        var purl        = viewMessage+'/'+$('.service').val()+'/'+$('.patient').val();
      
        $.post({
          type: 'get',
          url: purl
        },{action:'getapptlog'}).done(function (data) {
         
            modalName = 'ModalLoginForm';
           
          
          
          $('#viewApptMessageLog .modal-body').html(data);
            $('#'+modalName).modal('hide');
            $('#viewApptMessageLog').modal('show');
        })
        .fail(function (data) {
          
        });

    
 });
 $('#viewApptLog,#viewApptMessageLog').on('hidden.bs.modal', function () {
  $('#'+modalName).modal('show');
 });