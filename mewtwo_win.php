<?php
session_start();
$_SESSION["battle"] = null;



$_SESSION['poke'][5] = [
    'MewDois' => [
        'img' => 'mewtwo.png',
        'maxHp' => 300,
        'hp'   => 300,
        'defeated' => false,
        'moves' => [
            ["Pewewewewewewe" => 100],
            ["Reeeee" => 85],
            ["Ataque Mental todo Mamado" => 75],
            ["Skidaddle Skidoodle Your Dick Is Now a Noodle" => 100],
        ]
    ]
];
$evolvedPokemon = reset($_SESSION['poke'][5]);
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
    <h3>YOU CAPTURED MEWDOIS!</h3>
    <img src="img/<?= $evolvedImg ?>" alt="<?= $next ?>">

    <a href="elite4_1.php"><button>Continue</button></a>
</body>