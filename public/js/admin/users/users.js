showUsers();

  
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$(document).on('click', 'a.delete_user', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    if(confirm('Are you sure want to delete this ??')){
      $.post({
          type: $this.data('method'),
          url: $this.attr('href')
      }).done(function (data) {
         alert('Record Deleted Successfully');
          showUsers();
          console.log(data);
      });
    }
});

function showUsers() {
    // body...
    //$(document).ready(function() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url,
        
        success: function(d) {
          //alert(d);
            $('#users_list_table').DataTable({
                destroy:true,
                dom: "Bfrtip",
                data: d.records,
                columns: d.columns
            });
            $('.user-toggle').bootstrapToggle();
        }
    });

}
$(document).on('click','#delete-user',function(e){
  e.preventDefault();
  //alert('test');
   if(confirm('Are you sure want to delete this user ??')){
      $('#deleteUser').submit();
   }
})
