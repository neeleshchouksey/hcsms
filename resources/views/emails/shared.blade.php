<!DOCTYPE html>
<html>
<head>
<title>Shared History</title>
</head>
<body>

Hello <br><br>
{{$patientService->patient->name}} has shared their {{$patientService->serviceData->data}} History with you.<br><br>
Please click this link to view<br>
{{url($patientService->token)}}<br><br>

Best regards<br><br>



{{env('APP_NAME')}}
<br><br>
</body>
</html>