$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
smscost();
function smscost(curl='') {
    //alert('test');
    // body...
    if(curl=='')
        curl=paurl;
    $("#sms_cost_table").DataTable({
        destroy:true,
        
        "searching": false,
        "ajax": {
            "url":curl,
            "dataSrc": "",
            "type": 'GET',
        },
      
        
        columns: [
            { data: 'country' },
            { data: 'ccode' },
            { data: 'currencyname' },
            { data: 'currency' },
            { data: 'smscost' },
            { data: 'smsfee' },
                     
        ]
      
    });
}

