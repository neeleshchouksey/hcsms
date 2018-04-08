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
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url":curl,
           
            "type": 'get',

       
        },
      
       "ordering": false,
        columns: [
            { data: 'date' },
            { data: 'time' },
            { data: 'patient' },
            { data: 'practice' },

            { data: 'status' },
            { data: 'language' },
            { data: 'message' },
            { data: 'country' },
            { data: 'mparts' },
            { data: 'mfees' },
            { data: 'action'}
        ]
      
    });
}

$(document).on('click','.profile-popup',function(){
    var userid          =   $(this).attr('data-user');
    var serviceType     =   $(this).attr('service-type');
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
                $('#profileDetailsPopup .modal-body table tbody').append('<tr><td>Service</td><td>'+serviceType+'</td></tr>');
                $('#profileDetailsPopup').modal('show'); 
     
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