<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mood Result Notif</title>
</head>

<body>
    <h1>Mood Result Notification</h1>
    <p>
        Hello, this is a notification for your moods with details:<br>
        Name: {{ $moods->user->name }}<br>
        Mood: {{ $moods->mood }}
    </p>
</body>

</html>
