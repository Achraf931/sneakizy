<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Bonjour</h1>
<h2>Voici un récapitulatif de votre commande</h2>

@foreach($products as $product)
    <div>
        <img style="width: 100px; border-radius: 10px" src="{{$product['product']['image']}}" alt="{{$product['product']['name']}}">
        <h3>{{$product['product']['name']}}</h3>
        <p>{{$product['product']['color']}}</p>
        <p>{{$product['product']['price']}}€</p>
    </div>
@endforeach
</body>
</html>
