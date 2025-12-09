<?php
session_start();
$_SESSION["battle"] = null;



$_SESSION['poke'][4] = [
    'Frango Mal Assado' => [
        'img' => 'moltres.png',
        'maxHp' => 270,
        'hp'   => 270,
        'defeated' => false,
        'moves' => [
            ['Piu Piu' => 50],
            ['Passar Pelas Brasas' => 60],
            ['Cagar Ovos' => 70],
            ['Forno a 180o'=> 90],
        ]
    ]
];
$evolvedPokemon = reset($_SESSION['poke'][4]);
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
    <h3>YOU CAPTURED FRANGO MAL ASSADO!</h3>
    <img src="img/<?= $evolvedImg ?>" alt="<?= $next ?>">

    <a href="mewtwo.php"><button>Continue</button></a>
</body>