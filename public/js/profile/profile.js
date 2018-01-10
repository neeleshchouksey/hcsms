$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$(document).on('change','.profileUpdate',function(){

    var patientData = $('#profileUpdate').serializeArray();
    var purl        = $('#profileUpdate').attr('action');
    console.log(patientData);
    $.post(
        {
            type: 'post',
            url: purl
        },
        patientData
    )
    .done(
        function (data) {
            
            $('#formerrors').empty();
          
        }
    )
    .fail(
        function(data) {

            console.log(data.responseJSON.errors);

            if( data.status === 422 ) {
                
                var errors = data.responseJSON.errors;
                errorHtml='<div class="errors"><ul>';

                $.each( errors, 
                        function( key, value ) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        }
                    );

                errorHtml += '</ul></div>';
                $( '#formerrors' ).html( errorHtml );

            }
        }
    );
    
 });
$(document).on('change','.keyUpdate',function(){
    var parentDiv   =   $(this).closest('.otherKeyContact');
    var keyData     =   parentDiv.find('input').serializeArray();
    //alert(keyData);
    console.log(keyData);
     $.post(
        {
            type: 'post',
            url:  keyUrl
        },
        keyData
    )
    .done(
        function (data) {
            
            $('#formerrors').empty();
            parentDiv.html(data);
        }
    )
    .fail(
        function(data) {

            console.log(data.responseJSON.errors);

            if( data.status === 422 ) {
                
                var errors = data.responseJSON.errors;
                errorHtml='<div class="errors"><ul>';

                $.each( errors, 
                        function( key, value ) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        }
                    );

                errorHtml += '</ul></div>';
                $( '#formerrors' ).html( errorHtml );

            }
        }
    );
});
