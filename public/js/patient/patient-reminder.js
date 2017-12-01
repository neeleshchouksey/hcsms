
$('.service-toggle').bootstrapToggle();
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$('.service-toggle').change(function() {
      //alert($(this).prop('checked'));
          var status  = 0;
          if($(this).prop('checked')==true){
            status =1;
          }
          $.post({
            type: 'post',
            url: url
          },
          {
              service:$(this).attr('service'),
              patient:$(this).attr('patient'),
              status:status,
              start:0,
              action:'update'    
          }).done(function (data) {
              //$('#ModalLoginForm .modal-body').html(data);
              //$('#ModalLoginForm').modal('show');
            
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
  $(document).on('blur','.ongoing',function(){
    
    
    
        $.post({
          type: 'post',
          url: url
        },
        {
          service :   $('.service').val(),
          patient :   $('.patient').val(),
          period  :   $(this).val(),
          action:'update'    
        }).done(function (data) {
          
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
          start  :   $(this).val(),
          status : 1,
          action:'update'    
        }).done(function (data) {
          start.removeClass('start').addClass('stop').val('STOP');
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();   
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
          stop.removeClass('stop').addClass('start').val('START');
          $('.service_'+service).html(data);   
          $('.service-toggle').bootstrapToggle();
        });
    
});