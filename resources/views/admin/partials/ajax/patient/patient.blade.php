<table class="table table-bordered table-striped">
                        
   
    <tr>
        <td width="20%">Patient Reference</td>
        <td >{{$patient->code}}</td>
    </tr>
    <tr>
        <td>Patient Name</td>
        <td >{{$patient->name}}</td>
    </tr>
    <tr>
        <td>Mobile Number</td>
        <td >{{$patient->mobile}}</td>
    </tr>
    <tr>
        <td>Post Code</td>
        <td >{{$patient->code}}</td>
    </tr>
    
    <tr>
        <td>Language</td>
        <td >{{$patient->language->title}}</td>
    </tr>
    <tr>
        <td>Notes</td>
        <td >{{$patient->note}}</td>
    </tr>
   
</table>
   