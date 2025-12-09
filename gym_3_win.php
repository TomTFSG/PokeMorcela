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
    $previous="Pru";
    $next="El Pru";
    $_SESSION['poke'][1] = [
            'El Pru' => [
                'img' => 'elpru.png',
                'maxHp' => 200,
                'hp'   => 200,
                'defeated' => false,
                'moves' => [
                    ['Cagada Real' => 30],
                    ['Voo do Princepe' => 25],
                    ['CACAW' => 35],
                    ['Drone do Governo'=> 40],
                ]
            ]
        ];
}
elseif($_SESSION["newPoke"] == 'rato'){
    $previous="Roberto";
    $next="Robertozao";
    $_SESSION['poke'][1] = [
            'Robertozao'=> [
                'img'=> 'robertozao.png',
                'maxHp' => 200,
                'hp'   => 200,
                'defeated' => false,
                'moves' => [
                    ['REEEEE' => 30],
                    ['Peste Negra com Diarreia' => 25],
                    ['Dentado nos Gluteos' => 35],
                    ['Poder dos Esgotos' => 40],
                ]
            ]
        ];
}
elseif($_SESSION["newPoke"] == 'gun'){
    $previous="Glock";
    $next="AK-47";
    $_SESSION['poke'][1] = [
            'AK-47' => [
                'img'=> 'ak47.png',
                'maxHp'=> 200,
                'hp'   => 200,
                'defeated' => false,
                'moves' => [
                    ['RATATATATATATATA' => 30],
                    ['Balazio na Testa' => 35],
                    ['Orgulho de Mikhail' => 35],
                    ['Metralhada Sovietica' => 40],
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

    <a href="gym_4.php"><button>Continue</button></a>
</body>