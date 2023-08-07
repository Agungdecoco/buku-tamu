<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Verify email</h1>

    <p>Please verify your email address by clicking the link in the mail we just sent you. Thanks!</p>

    <form action="{{ route('verification.request') }}" method="post">
        <button type="submit">Request a new link</button>
    </form>
</body>

</html>
