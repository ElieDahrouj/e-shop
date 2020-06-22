<!doctype html>
<html>
< lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    h3{
        text-decoration: underline;
    }
    .total{
        border-top:1px solid gray;
    }
    .info{
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 125px);
        display: grid;
        justify-content: flex-start;
        margin-bottom: 10px;
    }
    img{
        width: 13%;
    }
    h5{
        margin: 0;
    }
    img{
        width: 13%;
    }
    body{
        padding: 5px;
    }
</style>
<body>
Bonjour <b>Admin</b><br>
<p>Un Client vient de passer une commander sur notre site, Voici les informations de la commande.</p>
Nom du client <b>{{$firstName ?? ''}}</b><br>
<h3>Adresse de facturation</h3>
<span> <b>{{ $address}}</b></span>
<span><b>{{$postal}}</b></span>
<span>{{$city}}</span>
<br><br>

<h3>Récapitulatifs des produits commandés</h3>
<?php $total = 0; ?>
@foreach($dataSession['basket'] as $values)
    <h5>{{$values['product']['name']}}</h5>
    <img src="{{$values['product']['image']}}" alt="">
    <div class="info">
        <span>Taille: <b>{{  $values['size'] }}</b></span>
        <span>Quantité: <b>{{  $values['quantity'] }}</b></span>
        <span>Prix: <b>{{  $values['product']['price'] }}</b></span>
    </div>
    <?php $total += $values['product']['price']  * $values['quantity']?>
@endforeach

<div class="total">
    <b>Total: {{$total}} €</b>
</div>
</body>
</html>