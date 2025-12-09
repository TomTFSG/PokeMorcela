<?php
session_start();
$_SESSION["battle"] = null;

$previous="";
$next="";
if($_SESSION["newPoke"] == null){
    echo "AQUI DEU MERDA";
    $previous="fo";
    $next="deu";
    
}
elseif($_SESSION["newPoke"] == 'pru'){
    $previous="El Pru";
    $next="Marques de Pombal";
    $_SESSION['poke'][1] = [
            'Marques de Pombal' => [
                'img' => 'marques.png',
                'maxHp' => 250,
                'hp'   => 250,
                'defeated' => false,
                'moves' => [
                    ['Caganeira Real' => 50],
                    ['Voo do Marques' => 60],
                    ['CACAW MOTHERFUCKER' => 70],
                    ['A AVE DO POVO'=> 90],
                ]
            ]
        ];
}
elseif($_SESSION["newPoke"] == 'rato'){
    $previous="Robertozao";
    $next="Rob";
    $_SESSION['poke'][1] = [
            'Rob'=> [
                'img'=> 'rob.png',
                'maxHp' => 250,
                'hp'   => 250,
                'defeated' => false,
                'moves' => [
                    ['RATADA DE MESTRE' => 50],
                    ['RRREEEEEE' => 60],
                    ['Sem Abrigo' => 70],
                    ['Tem uma Esmola?' => 90],
                ]
            ]
        ];
}
elseif($_SESSION["newPoke"] == 'gun'){
    $previous="AK-47";
    $next="Negev";
    $_SESSION['poke'][1] = [
            'Negev' => [
                'img'=> 'negev.png',
                'maxHp'=> 250,
                'hp'   => 250,
                'defeated' => false,
                'moves' => [
                    ['TRRRRRRRRRRRRRRRRRRRR' => 50],
                    ['LASER NO MID' => 60],
                    ['KIT IMBATIVEL' => 70],
                    ['Metralhada Israelita' => 90],
                ],
            ]
        ];
}
$evolvedPokemon = reset($_SESSION['poke'][1]);
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
    <h3><?= $previous ?> EVOLVED INTO <?= $next ?></h3>
    <img src="img/<?= $evolvedImg ?>" alt="<?= $next ?>">

    <a href="gym_7.php"><button>Continue</button></a>
</body>