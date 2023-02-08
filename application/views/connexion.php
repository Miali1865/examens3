<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form action="./bonjour/accueil" method="get">
        <p>Nom : <input type="text" name="nom"></p>
        <p>Plat: <input type="text" name="plat"></p>
        <p>Boisson <input type="text" name="boisson"></p>
        <p><input type="submit" value="Valider"></p>
    </form>
</body>
</html>