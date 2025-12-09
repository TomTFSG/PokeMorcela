<?php
session_start();
$_SESSION["battle"] = null;



$_SESSION['poke'][2] = [
    'Piriquito Congelado' => [
        'img' => 'articuno.png',
        'maxHp' => 270,
        'hp'   => 270,
        'defeated' => false,
        'moves' => [
            ['Tras um Casaco' => 50],
            ['Artico-Uno' => 60],
            ['Piu-Piu Refrigerante' => 70],
            ['Briole do Caralho'=> 90],
        ]
    ]
];
$evolvedPokemon = reset($_SESSION['poke'][2]);
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
    <h3>YOU CAPTURED PIRIQUITO CONGELADO!</h3>
    <img src="img/<?= $evolvedImg ?>" alt="<?= $next ?>">

    <a href="gym_6.php"><button>Continue</button></a>
</body>