<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>

	
    <h1>Login Details </h1>
    <p>Hello {{ $details['first_name'].''.$details['last_name'] }},</p>
    <p> Your login details are mentioned below </p>
    <p>Email {{ $details['email'] }}</p>
    <p>Password {{ $details['password'] }}</p>
   
    <p>Thank you</p>
</body>
</html>