<!DOCTYPE html>
<html>
<head>
    <title>MediMate Health Statement Form</title>
</head>
<body>
<h1>{{ $details['title'] }}</h1>
<p>{{ $details['body'] }}</p>
<a href="{{ $details['form_url'] }}">Open Form</a>

<p>Thank you</p>
<p>MediMate</p>
<hr>
<p>If you’re having trouble clicking the "Open Form" link, copy and paste the URL below into your web browser:</p>
<a href="{{ $details['form_url'] }}">{{ $details['form_url'] }}</a>
</body>
</html>
