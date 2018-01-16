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
        curl=url;
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
    var curl   = url+'?'+filter;
    showPatients(curl);
});