
$(document).on('change','.profileUpdate',function(){

    var patientData = $('#profileUpdate').serializeArray();
    var purl        = $('#profileUpdate').attr('action');

    $.post(
        {
            type: 'post',
            url: purl
        },
        patientData
    )
    .done(
        function (data) {
            $('.ongoing').removeClass('btn-success');
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