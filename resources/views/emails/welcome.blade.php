<!DOCTYPE html>
<html>
<head>
<title>Welcome Email</title>
</head>
<body>

Dear {{$user['name']}},<br><br>

Welcome to Health Check SMS, the specialised system to help medical professionals to remind patients about important issues.<br><br>

You can login at: {{url('login')}}<br><br>

Your username is: {{$user['name']}}.<br><br>

Once logged in, you can easily send automated reminders in multiple languages.<br><br>

If you need any help or would like to request a special feature, please let us know.<br><br>

Best regards<br><br>

Health Check SMS<br><br>

www.healthchecksms.com
<br><br>
</body>
</html>
