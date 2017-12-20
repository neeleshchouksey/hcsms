showCustomers();
function showCustomers() {
    alert('test');
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
            { data: 'title' },
            { data: 'first' },
            { data: 'last' },
            { data: 'job' },
          
            { data: 'action'}
         
        ]
      
    });
}