<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .msg{
        text-decoration: underline;
    }
    .mail{
        padding: 10px;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .img{
        width: 200px;
    }
</style>
<body>
    <div class="mail">
        <div class="content">
            Bonjour <b>Administrateur</b><br>
            <span>Vous venez de recevoir un message de {{$lastName}} {{$firstName}}</span><br>
            <p>L'object du mail est: {{$subject}}</p>
            <b class="msg">Message</b>
            <p>{{$message}}</p>
        </div>
        <div>
            <img class="img" src="http://127.0.0.1:8000/images/test.png?34dc7f43f9c225985eda5a17fdda7a74" alt="">
        </div>
    </div>
</body>
</html>