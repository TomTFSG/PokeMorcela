<?php
session_start();
$_SESSION["battle"] = null;



$_SESSION['poke'][3] = [
    'Tomada com Asas' => [
        'img' => 'zapdos.png',
        'maxHp' => 270,
        'hp'   => 270,
        'defeated' => false,
        'moves' => [
            ['ZAP' => 50],
            ['Garfo na Tomada' => 60],
            ['Bzzt' => 70],
            ['Relimpango'=> 90],
        ]
    ]
];
$evolvedPokemon = reset($_SESSION['poke'][3]);
$evolvedImg = $evolvedPokemon['img'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMORCELA</title>
    <link href="../css/basic.css" rel="stylesheet">
    <link href="../css/choice.css" rel="stylesheet">
</head>
<body>
    <h1> YOU WIN !!</h1>
    <h3>YOU CAPTURED TOMADA VOADORA!</h3>
    <img src="img/<?= $evolvedImg ?>" alt="<?= $next ?>">

    <a href="gym_8.php"><button>Continue</button></a>
</body>