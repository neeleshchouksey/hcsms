showLanguage();

  
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$(document).on('click', 'a.delete_language', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    //if(confirm('Are you sure want to delete this ??')){
      $.post({
          type: $this.data('method'),
          url: $this.attr('href')
      }).done(function (data) {
         // alert('Record Deleted Successfully');
          showLanguage();
          console.log(data);
      });
    //}
});
$(document).on('click','.setSmsMessage',function(){
  var service   =   $(this).attr('data-service');
  var language  =   $(this).attr('data-language');
  
  $.post({
      type  :   'post',
      url   :   smsTypeUrl
  },
  {
    service   :   service,
    language  :   language
  }).done(function (data){

      if(data!=''){

        $('#SetSmsMessage .modal-body').html(data);
        $('#SetSmsMessage').modal('show');
  
      }
      
  });
});
$(document).on('change','.smsLangMessage',function(){
  var service   =   $('.service').val();
  var language  =   $('.language').val();
  var smsType   =   $(this).attr('data-smslang');
  var message   =   $(this).val();
  
  $.post({
      type  :   'post',
      url   :   messageUrl
  },
  {
    service   :   service,
    language  :   language,
    smsType   :   smsType,
    message   :   message
  }).done(function (data){
     showLanguage();
      
  });
});
function showLanguage() {
    // body...
    //$(document).ready(function() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url,
        
        success: function(d) {
          //alert(d);
            $('#language_list_table').DataTable({
                destroy:true,
                dom: "Bfrtip",
                data: d.records,
                columns: d.columns
            });
        }
    });

}
$(document).on('click','.showOnTop',function(){
    var language_id   =   $(this).val();
    //alert(language_id);
   $.post({
        type:'put',
        url: curl+'/'+language_id
    },
    {
       action:'showOnTop'
    }).done(function (data) {
       // alert('Record Deleted Successfully');
        showLanguage();
        console.log(data);
    });
});
$(document).on('change','.languageMessageVerify',function(){
  var language_id   =   $(this).val();
  var  verify       =   $(this);
  $.post({
      type  :   'put',
      url   :   language_id
  },{
    action:'update'
  }
 ).done(function (data){
     verify.closest('.verified_by').html(data);
      
  });
});