<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>welcome</title>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="w3-container w3-padding-32" style="text-align: center; min-height: 80vh;">
            <h1 class="w3-jumbo w3-text-indigo">Bienvenue sur notre site</h1>
            <p class="w3-large">connectez vous pour acceder à votre espace travail</p>
            <a href="{{ route('login') }}" class="w3-button w3-indigo w3-large w3-round">Se connecter</a>
        </div>
    </body>  
</html>
