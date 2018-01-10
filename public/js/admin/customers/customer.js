$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
showCustomers();
function showCustomers() {
    //alert('test');
    // body...
    $("#customer_list_table").DataTable({
        destroy:true,
        "ajax": {
            "url":url,
            "dataSrc": "",
            "type": 'GET',
        },
      
        "order": [[ 0, "desc" ]],
        columns: [
            { data: 'company' },
            { data: 'practice' },
            { data: 'users' },
            { data: 'patients' },

            { data: 'reminders' },
            { data: 'lastMessage' },
            { data: 'nextMessage' },
            { data: 'totalMessage' },
          
          
            { data: 'action'}
         
        ]
      
    });
}
$(document).on('click','.user-popup',function(){
    var userid  =   $(this).attr('data-user');
   
      $.post(
        {
            type: 'get',
            url: userid
        },
        {action:'user-popup'}
    )
    .done(
        function (data) {
            if(data!=''){
                $('#userDetailsPopup tbody').html(data);
                 
            }
            var table = $('#staff_list_table').DataTable(); 
            if(data==''){
                 $('#staff_list_table').empty();
                 table.destroy();
                 table = $('#staff_list_table').DataTable(); 
            }
            $('#userDetailsPopup').modal('show');   
          
        }
    )
    .fail(
        function(data) {

            console.log(data.responseJSON.errors);

          
        }
    );
});
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